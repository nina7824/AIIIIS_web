<?php

namespace App\Models;

use CodeIgniter\Model;

class ClusterModel extends Model
{
    protected $table = 'clusters';
    protected $primaryKey = 'cluster_id';
    protected $allowedFields = [
        'name', 
        'slug', 
        'description', 
        'type', 
        'criteria', 
        'location', 
        'is_active'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'array';

    // Cluster types
    const TYPE_SECTOR = 'sector';
    const TYPE_LOCATION = 'location';
    const TYPE_GENDER = 'gender';
    const TYPE_YOUTH = 'youth';
    const TYPE_WOMEN_LED = 'women_led';
    const TYPE_PWD = 'pwd';
    const TYPE_CUSTOM = 'custom';

    // Get cluster types for dropdown
    public function getTypes()
    {
        return [
            self::TYPE_SECTOR => 'Sector Based',
            self::TYPE_LOCATION => 'Location Based',
            self::TYPE_GENDER => 'Gender Based',
            self::TYPE_YOUTH => 'Youth Based',
            self::TYPE_WOMEN_LED => 'Women Led',
            self::TYPE_PWD => 'PWD Based',
            self::TYPE_CUSTOM => 'Custom'
        ];
    }

    // Get clusters by type
    public function getByType($type)
    {
        return $this->where('type', $type)->where('is_active', 1)->findAll();
    }

    // Get clusters with enterprise counts
    public function getClustersWithCounts()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('clusters c');
        $builder->select('c.*, COUNT(ec.enterprise_id) as enterprise_count');
        $builder->join('enterprise_clusters ec', 'ec.cluster_id = c.cluster_id', 'left');
        $builder->groupBy('c.cluster_id');
        $builder->orderBy('c.name', 'ASC');
        return $builder->get()->getResultArray();
    }

    // Get enterprises in a cluster
    public function getEnterprises($clusterId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('enterprise_clusters ec');
        $builder->select('e.*');
        $builder->join('enterprises e', 'e.enterprise_id = ec.enterprise_id');
        $builder->where('ec.cluster_id', $clusterId);
        return $builder->get()->getResultArray();
    }
}