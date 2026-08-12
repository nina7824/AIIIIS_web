<?php

namespace App\Models;

use CodeIgniter\Model;

class EnterpriseModel extends Model
{
    protected $table = 'enterprises';
    protected $primaryKey = 'enterprise_id';
    protected $allowedFields = [
        'user_id',
        'enterprise_name',        // ← Added this
        'name',
        'registration_number',
        'sector',
        'sub_sector',
        'location',
        'latitude',
        'longitude',
        'contact_person',
        'email',
        'phone',
        'website',
        'products_services',
        'employees',
        'revenue',
        'growth_potential',
        'technology_level',
        'innovation_capacity',
        'environmental_sustainability',
        'social_inclusion',
        'investment_requirements',
        'is_verified',
        'status',
        'is_women_owned',
        'rdb_certificate'  // Add this if you want to store the certificate filename
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}