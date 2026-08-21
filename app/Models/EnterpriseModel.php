<?php

namespace App\Models;

use CodeIgniter\Model;

class EnterpriseModel extends Model
{
    protected $table = 'enterprises';
    protected $primaryKey = 'enterprise_id';
    protected $allowedFields = [
        'user_id', 'enterprise_name', 'name', 'sector_id', 'location',
        'contact_person', 'email', 'phone', 'products_services',
        'employees', 'revenue', 'investment_requirements', 'status',
        'is_verified', 'is_active', 'registration_number',
        'sub_sector', 'latitude', 'longitude', 'website',
        'growth_potential', 'technology_level', 'innovation_capacity',
        'environmental_sustainability', 'social_inclusion',
        'is_women_owned', 'rdb_certificate', 'description'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'array';
}