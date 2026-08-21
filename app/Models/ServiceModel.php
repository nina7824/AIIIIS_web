<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'service_id';
    protected $allowedFields = [
        'name', 
        'slug', 
        'icon', 
        'badge', 
        'description', 
        'chat_placeholder',
        'features',
        'whatsapp_number',
        'email_address',
        'is_active',
        'display_order'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'array';

    /**
     * Get active services ordered by display order
     */
    public function getActiveServices()
    {
        return $this->where('is_active', 1)
                    ->orderBy('display_order', 'ASC')
                    ->findAll();
    }

    /**
     * Get service by slug
     */
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)
                    ->where('is_active', 1)
                    ->first();
    }

    /**
     * Get service features as array
     */
    public function getFeaturesAsArray($serviceId)
    {
        $service = $this->find($serviceId);
        if (!$service || empty($service['features'])) {
            return [];
        }
        
        $features = json_decode($service['features'], true);
        return is_array($features) ? $features : [];
    }

    /**
     * Get services with pagination for admin
     */
    public function getPaginatedServices($perPage = 10)
    {
        return $this->orderBy('display_order', 'ASC')
                    ->paginate($perPage);
    }

    /**
     * Toggle service status
     */
    public function toggleStatus($serviceId)
    {
        $service = $this->find($serviceId);
        if (!$service) {
            return false;
        }
        
        $newStatus = $service['is_active'] == 1 ? 0 : 1;
        return $this->update($serviceId, ['is_active' => $newStatus]);
    }

    /**
     * Get service count
     */
    public function getServiceCount()
    {
        return $this->countAll();
    }

    /**
     * Get active service count
     */
    public function getActiveServiceCount()
    {
        return $this->where('is_active', 1)->countAllResults();
    }

    /**
     * Get service by ID with formatted features
     */
    public function getServiceWithFeatures($serviceId)
    {
        $service = $this->find($serviceId);
        if ($service) {
            $service['features_list'] = $this->getFeaturesAsArray($serviceId);
        }
        return $service;
    }

    /**
     * Reorder services
     */
    public function reorderServices(array $order)
    {
        foreach ($order as $index => $serviceId) {
            $this->update($serviceId, ['display_order' => $index + 1]);
        }
        return true;
    }

    /**
     * Get services by feature count
     */
    public function getServicesWithFeatureCount()
    {
        $services = $this->findAll();
        foreach ($services as &$service) {
            $features = $this->getFeaturesAsArray($service['service_id']);
            $service['feature_count'] = count($features);
        }
        return $services;
    }

    /**
     * Search services by name or description
     */
    public function searchServices($keyword)
    {
        return $this->like('name', $keyword)
                    ->orLike('description', $keyword)
                    ->where('is_active', 1)
                    ->findAll();
    }
}