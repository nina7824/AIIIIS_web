<?php
// app/Models/ModuleModel.php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
    protected $table = 'modules';
    protected $primaryKey = 'module_id';
    protected $allowedFields = [
        'name', 'slug', 'icon', 'description', 
        'is_active', 'is_category', 'parent_id', 'sort_order'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getModulesWithPermissions()
    {
        $db = \Config\Database::connect();
        return $db->table('modules m')
            ->select('m.*, 
                (SELECT COUNT(*) FROM permissions p WHERE p.module = m.slug) as permission_count,
                (SELECT name FROM modules WHERE module_id = m.parent_id) as parent_name')
            ->orderBy('m.sort_order', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getCategories()
    {
        return $this->where('is_category', 1)
                    ->where('is_active', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    public function getAllCategories()
    {
        return $this->where('is_category', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    public function getSubModules($parentId)
    {
        return $this->where('parent_id', $parentId)
                    ->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }

    public function getNextSortOrder($parentId = null)
    {
        $builder = $this->db->table($this->table);
        
        if ($parentId !== null && $parentId !== '') {
            $builder->where('parent_id', $parentId);
        } else {
            $builder->where('parent_id IS NULL');
        }
        
        $result = $builder->selectMax('sort_order')->get()->getRow();
        return ($result->sort_order ?? 0) + 1;
    }

    public function generateSlug($name)
    {
        $slug = strtolower(trim($name));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return $slug;
    }

    public function checkSlugExists($slug, $excludeId = null)
    {
        $builder = $this->where('slug', $slug);
        if ($excludeId) {
            $builder->where('module_id !=', $excludeId);
        }
        return $builder->countAllResults() > 0;
    }

    public function getModuleTree()
    {
        $modules = $this->orderBy('sort_order', 'ASC')->findAll();
        $tree = [];
        $map = [];

        foreach ($modules as $module) {
            $module['children'] = [];
            $map[$module['module_id']] = $module;
        }

        foreach ($map as $id => $module) {
            if ($module['parent_id'] === null) {
                $tree[] = &$map[$id];
            } else {
                if (isset($map[$module['parent_id']])) {
                    $map[$module['parent_id']]['children'][] = &$map[$id];
                }
            }
        }

        return $tree;
    }
}