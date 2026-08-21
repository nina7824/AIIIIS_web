<?php

namespace App\Models;

use CodeIgniter\Model;

class EnterpriseClusterModel extends Model
{
    protected $table = 'enterprise_clusters';
    protected $primaryKey = 'id';
    protected $allowedFields = ['enterprise_id', 'cluster_id'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = false;
    protected $returnType = 'array';

    // Assign enterprise to cluster
    public function assign($enterpriseId, $clusterId)
    {
        // Remove existing cluster assignments for this enterprise
        $this->where('enterprise_id', $enterpriseId)->delete();
        
        if ($clusterId) {
            return $this->insert([
                'enterprise_id' => $enterpriseId,
                'cluster_id' => $clusterId
            ]);
        }
        return true;
    }

    // Get enterprise's cluster
    public function getByEnterprise($enterpriseId)
    {
        return $this->where('enterprise_id', $enterpriseId)->first();
    }

    // Get enterprises by cluster
    public function getEnterprisesByCluster($clusterId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('enterprise_clusters ec');
        $builder->select('e.*');
        $builder->join('enterprises e', 'e.enterprise_id = ec.enterprise_id');
        $builder->where('ec.cluster_id', $clusterId);
        return $builder->get()->getResultArray();
    }

    // Auto-cluster enterprises based on criteria
    public function autoCluster($criteria = 'sector')
    {
        $db = \Config\Database::connect();
        
        // Get all enterprises
        $enterprises = $db->table('enterprises')
            ->where('is_active', 1)
            ->get()
            ->getResultArray();

        // Get clusters for this type
        $clusters = $db->table('clusters')
            ->where('type', $criteria)
            ->where('is_active', 1)
            ->get()
            ->getResultArray();

        $clusterMap = [];
        foreach ($clusters as $cluster) {
            $clusterMap[$cluster['name']] = $cluster['cluster_id'];
        }

        $assignments = [];
        $newClusters = [];

        foreach ($enterprises as $enterprise) {
            $clusterName = $this->getClusterName($enterprise, $criteria);
            
            if ($clusterName && isset($clusterMap[$clusterName])) {
                // Existing cluster
                $assignments[] = [
                    'enterprise_id' => $enterprise['enterprise_id'],
                    'cluster_id' => $clusterMap[$clusterName]
                ];
            } elseif ($clusterName) {
                // New cluster needed
                if (!in_array($clusterName, $newClusters)) {
                    $newClusters[$clusterName] = [
                        'name' => $clusterName,
                        'slug' => strtolower(str_replace(' ', '-', $clusterName)),
                        'type' => $criteria,
                        'description' => 'Auto-generated cluster for ' . $criteria . ': ' . $clusterName,
                        'is_active' => 1
                    ];
                }
            }
        }

        // Create new clusters
        $clusterModel = new ClusterModel();
        foreach ($newClusters as $name => $data) {
            $clusterModel->insert($data);
            $clusterId = $clusterModel->insertID();
            $clusterMap[$name] = $clusterId;
            
            // Add enterprises to this new cluster
            foreach ($enterprises as $enterprise) {
                $clusterName = $this->getClusterName($enterprise, $criteria);
                if ($clusterName == $name) {
                    $assignments[] = [
                        'enterprise_id' => $enterprise['enterprise_id'],
                        'cluster_id' => $clusterId
                    ];
                }
            }
        }

        // Clear existing assignments for this criteria and assign new ones
        // First, get all cluster IDs for this criteria
        $existingClusters = $db->table('clusters')
            ->where('type', $criteria)
            ->get()
            ->getResultArray();
        
        $existingClusterIds = array_column($existingClusters, 'cluster_id');
        
        if (!empty($existingClusterIds)) {
            $db->table('enterprise_clusters')
                ->whereIn('cluster_id', $existingClusterIds)
                ->delete();
        }

        // Insert new assignments
        foreach ($assignments as $assignment) {
            $db->table('enterprise_clusters')->insert($assignment);
        }

        return count($assignments);
    }

    private function getClusterName($enterprise, $criteria)
    {
        switch ($criteria) {
            case ClusterModel::TYPE_SECTOR:
                return $enterprise['sector'] ?? $enterprise['sector_id'] ?? 'Uncategorized';
            case ClusterModel::TYPE_LOCATION:
                return $enterprise['location'] ?? 'Unknown Location';
            case ClusterModel::TYPE_GENDER:
                return $this->getGenderCluster($enterprise);
            case ClusterModel::TYPE_YOUTH:
                return $this->getYouthCluster($enterprise);
            case ClusterModel::TYPE_WOMEN_LED:
                return $enterprise['is_women_owned'] == 1 ? 'Women Led' : 'Not Women Led';
            case ClusterModel::TYPE_PWD:
                return $this->getPWDCluster($enterprise);
            default:
                return null;
        }
    }

    private function getGenderCluster($enterprise)
    {
        // Assume we have a gender field or determine from contact person
        return 'Gender';
    }

    private function getYouthCluster($enterprise)
    {
        // Assume we have an age or youth field
        return 'Youth';
    }

    private function getPWDCluster($enterprise)
    {
        // Assume we have a PWD field
        return 'PWD';
    }
}