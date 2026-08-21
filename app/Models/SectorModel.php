<?php

namespace App\Models;

use CodeIgniter\Model;

class SectorModel extends Model
{
    protected $table = 'sectors';
    protected $primaryKey = 'sector_id';
    protected $allowedFields = [
        'name',
        'slug',
        'description',
        'code',
        'parent_id',
        'is_active',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    // Get all active sectors
    public function getActiveSectors()
    {
        return $this->where('is_active', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    // Get sectors as dropdown options (key-value pair)
    public function getSectorOptions()
    {
        $sectors = $this->where('is_active', 1)
                       ->orderBy('name', 'ASC')
                       ->findAll();
        
        $options = [];
        foreach ($sectors as $sector) {
            $options[$sector['sector_id']] = $sector['name'];
        }
        return $options;
    }

    // Get sectors with enterprise counts
    public function getSectorsWithCounts()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('sectors s');
        $builder->select('s.*, COUNT(e.enterprise_id) as enterprise_count');
        $builder->join('enterprises e', 'e.sector_id = s.sector_id', 'left');
        $builder->where('s.is_active', 1);
        $builder->groupBy('s.sector_id');
        $builder->orderBy('s.name', 'ASC');
        return $builder->get()->getResultArray();
    }

    // Get sector by slug
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)
                    ->where('is_active', 1)
                    ->first();
    }

    // Get sector by name
    public function getByName($name)
    {
        return $this->where('name', $name)
                    ->where('is_active', 1)
                    ->first();
    }

    // Get sub-sectors (child sectors)
    public function getSubSectors($parentId)
    {
        return $this->where('parent_id', $parentId)
                    ->where('is_active', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    // Get main sectors (parent_id = 0 or null)
    public function getMainSectors()
    {
        return $this->where('parent_id', null)
                    ->orWhere('parent_id', 0)
                    ->where('is_active', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    // Get sector tree (hierarchical)
    public function getSectorTree()
    {
        $sectors = $this->where('is_active', 1)
                       ->orderBy('name', 'ASC')
                       ->findAll();
        
        return $this->buildTree($sectors);
    }

    // Build hierarchical tree
    private function buildTree($sectors, $parentId = null)
    {
        $tree = [];
        foreach ($sectors as $sector) {
            if ($sector['parent_id'] == $parentId || ($parentId === null && empty($sector['parent_id']))) {
                $children = $this->buildTree($sectors, $sector['sector_id']);
                if (!empty($children)) {
                    $sector['children'] = $children;
                }
                $tree[] = $sector;
            }
        }
        return $tree;
    }

    // Get enterprises by sector
    public function getEnterprises($sectorId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('enterprises');
        $builder->where('sector_id', $sectorId)
                ->where('is_active', 1)
                ->orderBy('name', 'ASC');
        return $builder->get()->getResultArray();
    }

    // Get sector with enterprise count
    public function getWithCount($sectorId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('sectors s');
        $builder->select('s.*, COUNT(e.enterprise_id) as enterprise_count');
        $builder->join('enterprises e', 'e.sector_id = s.sector_id', 'left');
        $builder->where('s.sector_id', $sectorId);
        $builder->groupBy('s.sector_id');
        return $builder->get()->getRowArray();
    }

    // Search sectors
    public function searchSectors($keyword)
    {
        return $this->like('name', $keyword)
                    ->orLike('description', $keyword)
                    ->orLike('code', $keyword)
                    ->where('is_active', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    // Get sectors with pagination
    public function getPaginatedSectors($perPage = 20, $search = null)
    {
        if ($search) {
            $this->groupStart()
                 ->like('name', $search)
                 ->orLike('description', $search)
                 ->orLike('code', $search)
                 ->groupEnd();
        }
        
        return $this->where('is_active', 1)
                    ->orderBy('name', 'ASC')
                    ->paginate($perPage);
    }

    // Toggle sector status
    public function toggleStatus($sectorId)
    {
        $sector = $this->find($sectorId);
        if (!$sector) {
            return false;
        }
        
        $newStatus = $sector['is_active'] == 1 ? 0 : 1;
        return $this->update($sectorId, ['is_active' => $newStatus]);
    }

    // Get sector by code
    public function getByCode($code)
    {
        return $this->where('code', $code)
                    ->where('is_active', 1)
                    ->first();
    }

    // Check if sector exists
    public function sectorExists($name, $excludeId = null)
    {
        $this->where('name', $name);
        if ($excludeId) {
            $this->where('sector_id !=', $excludeId);
        }
        return $this->first() !== null;
    }

    // Get sector statistics
    public function getStatistics()
    {
        $db = \Config\Database::connect();
        
        $stats = [
            'total' => $this->where('is_active', 1)->countAllResults(),
            'with_enterprises' => 0,
            'top_sectors' => []
        ];
        
        // Get sectors with enterprise counts
        $sectorsWithCounts = $this->getSectorsWithCounts();
        
        $stats['with_enterprises'] = count(array_filter($sectorsWithCounts, function($s) {
            return $s['enterprise_count'] > 0;
        }));
        
        // Get top 5 sectors by enterprise count
        usort($sectorsWithCounts, function($a, $b) {
            return $b['enterprise_count'] - $a['enterprise_count'];
        });
        $stats['top_sectors'] = array_slice($sectorsWithCounts, 0, 5);
        
        return $stats;
    }

    // Validate sector data before insert/update
    protected function validateData($data)
    {
        $validation = \Config\Services::validation();
        
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'slug' => 'permit_empty|alpha_dash|max_length[100]',
            'description' => 'permit_empty|max_length[500]',
            'code' => 'permit_empty|max_length[20]',
            'parent_id' => 'permit_empty|integer',
            'is_active' => 'permit_empty|integer'
        ];
        
        $validation->setRules($rules);
        
        if (!$validation->run($data)) {
            return $validation->getErrors();
        }
        
        return true;
    }

    // Override insert to generate slug if not provided
    public function insert($data = null, bool $returnID = true)
    {
        // Generate slug from name if not provided
        if (empty($data['slug']) && !empty($data['name'])) {
            $data['slug'] = $this->generateSlug($data['name']);
        }
        
        return parent::insert($data, $returnID);
    }

    // Override update to generate slug if not provided
    public function update($id = null, $data = null): bool
    {
        // Generate slug from name if not provided
        if (empty($data['slug']) && !empty($data['name'])) {
            $data['slug'] = $this->generateSlug($data['name'], $id);
        }
        
        return parent::update($id, $data);
    }

    // Generate unique slug
    private function generateSlug($name, $excludeId = null)
    {
        $slug = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $name), '-'));
        
        // Check if slug exists
        $count = $this->where('slug', $slug);
        if ($excludeId) {
            $count->where('sector_id !=', $excludeId);
        }
        $count = $count->countAllResults();
        
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }
        
        return $slug;
    }

    // Get sectors for datatable
    public function getDatatableData($limit, $offset, $search = null, $orderBy = 'sector_id', $orderDir = 'DESC')
    {
        $this->select('sector_id, name, slug, description, code, parent_id, is_active, created_at');
        
        if ($search) {
            $this->groupStart()
                 ->like('name', $search)
                 ->orLike('description', $search)
                 ->orLike('code', $search)
                 ->groupEnd();
        }
        
        return $this->orderBy($orderBy, $orderDir)
                    ->findAll($limit, $offset);
    }

    // Count datatable records
    public function getDatatableCount($search = null)
    {
        if ($search) {
            $this->groupStart()
                 ->like('name', $search)
                 ->orLike('description', $search)
                 ->orLike('code', $search)
                 ->groupEnd();
        }
        
        return $this->countAllResults();
    }
}