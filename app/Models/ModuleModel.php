<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
    protected $table = 'modules';
    protected $primaryKey = 'module_id';
    protected $allowedFields = ['parent_id', 'name', 'slug', 'icon', 'description', 'is_active', 'is_category', 'sort_order'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'array';

    /**
     * Generate slug from name
     */
    public function generateSlug($name)
    {
        // Convert to lowercase
        $slug = strtolower($name);
        // Replace spaces with underscores
        $slug = str_replace(' ', '_', $slug);
        // Remove special characters
        $slug = preg_replace('/[^a-z0-9_]/', '', $slug);
        // Remove consecutive underscores
        $slug = preg_replace('/_+/', '_', $slug);
        // Trim underscores from ends
        $slug = trim($slug, '_');
        
        // Check if slug exists and make it unique
        $originalSlug = $slug;
        $counter = 1;
        while ($this->slugExists($slug)) {
            $slug = $originalSlug . '_' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    /**
     * Get next available sort order
     */
    public function getNextSortOrder()
    {
        $max = $this->selectMax('sort_order')->get()->getRow()->sort_order;
        return ($max ?? 0) + 1;
    }

    public function slugExists($slug, $excludeId = null)
    {
        $builder = $this->where('slug', $slug);
        if ($excludeId) {
            $builder->where('module_id !=', $excludeId);
        }
        return $builder->countAllResults() > 0;
    }

    public function getModulesWithPermissions()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('modules m');
        $builder->select('m.*, 
            (SELECT COUNT(*) FROM permissions p WHERE p.module = m.slug) as permission_count,
            (SELECT name FROM modules WHERE module_id = m.parent_id) as parent_name');
        $builder->orderBy('m.sort_order', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function getCategories()
    {
        return $this->where('is_category', 1)
                    ->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }
}