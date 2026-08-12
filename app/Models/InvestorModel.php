<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestorModel extends Model
{
    protected $table = 'investors';
    protected $primaryKey = 'investor_id';
    protected $allowedFields = [
        'user_id',
        'full_name',
        'email',
        'country',
        'id_document',
        'investment_sector',
        'preferred_enterprise_type',
        'geographic_preferences',
        'technology_interests',
        'sustainability_preferences',
        'investment_stage',
        'expected_returns',
        'investment_criteria',
        'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}