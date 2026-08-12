<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Investor extends BaseController
{
    public function index()
{
    // Check if user is logged in and is investor
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
        return redirect()->to('/login');
    }

    $db = \Config\Database::connect();
    $userId = session()->get('user_id');
    
    // Get investor profile
    $investor = $db->table('investors')
        ->where('user_id', $userId)
        ->get()
        ->getRowArray();
    
    if (!$investor) {
        return redirect()->to('/investor/profile')->with('error', 'Please complete your investor profile first.');
    }

    $investorId = $investor['investor_id'];

    // ========== STATS ==========
    $stats = [
        'total_matches' => $db->table('matches')->where('investor_id', $investorId)->countAllResults(),
        'accepted_matches' => $db->table('matches')->where('investor_id', $investorId)->where('status', 'accepted')->countAllResults(),
        'pending_matches' => $db->table('matches')->where('investor_id', $investorId)->where('status', 'pending')->countAllResults(),
        'total_deals' => $db->table('deals')->where('investor_id', $investorId)->countAllResults(),
        'active_deals' => $db->table('deals')->where('investor_id', $investorId)->where('status !=', 'completed')->where('status !=', 'cancelled')->countAllResults(),
        'total_investment' => $db->table('deals')->selectSum('deal_amount')->where('investor_id', $investorId)->get()->getRow()->deal_amount ?? 0,
        'introductions' => $db->table('matches')->where('investor_id', $investorId)->where('status', 'introduced')->countAllResults(),
        'saved_enterprises' => $db->table('saved_enterprises')->where('investor_id', $investorId)->countAllResults()
    ];

    // ========== RECOMMENDED ENTERPRISES ==========
    $recommendedEnterprises = $db->table('enterprises')
        ->select('enterprises.*, 
            enterprise_rankings.total_score,
            enterprise_rankings.growth_score,
            enterprise_rankings.innovation_score,
            enterprise_rankings.sustainability_score,
            (SELECT COUNT(*) FROM matches WHERE matches.enterprise_id = enterprises.enterprise_id) as total_matches,
            (SELECT match_score FROM matches WHERE matches.enterprise_id = enterprises.enterprise_id AND matches.investor_id = ' . $investorId . ' LIMIT 1) as match_score')
        ->join('enterprise_rankings', 'enterprises.enterprise_id = enterprise_rankings.enterprise_id', 'left')
        ->where('enterprises.is_verified', 1)
        ->where('enterprises.status', 'active')
        ->orderBy('enterprise_rankings.total_score', 'DESC')
        ->limit(10)
        ->get()
        ->getResultArray();

    // ========== MATCHES WITH SCORES ==========
    $matches = $db->table('matches')
        ->select('matches.*, enterprises.name as enterprise_name, enterprises.sector, enterprises.location, enterprises.contact_person, enterprises.email as enterprise_email, enterprises.phone as enterprise_phone, enterprises.website')
        ->join('enterprises', 'enterprises.enterprise_id = matches.enterprise_id')
        ->where('matches.investor_id', $investorId)
        ->orderBy('match_score', 'DESC')
        ->limit(10)
        ->get()
        ->getResultArray();

    // ========== INVESTMENT OPPORTUNITIES ==========
    $investmentOpportunities = $db->table('enterprises')
        ->select('enterprises.*, enterprise_rankings.total_score')
        ->join('enterprise_rankings', 'enterprises.enterprise_id = enterprise_rankings.enterprise_id', 'left')
        ->where('enterprises.is_verified', 1)
        ->where('enterprises.status', 'active')
        ->where('enterprises.investment_requirements IS NOT NULL', null, false)
        ->where('enterprises.investment_requirements !=', '')
        ->orderBy('enterprise_rankings.total_score', 'DESC')
        ->limit(10)
        ->get()
        ->getResultArray();

    // ========== SAVED ENTERPRISES ==========
    $savedEnterprises = $db->table('saved_enterprises')
        ->select('saved_enterprises.*, enterprises.name as enterprise_name, enterprises.sector, enterprises.location, enterprises.contact_person')
        ->join('enterprises', 'enterprises.enterprise_id = saved_enterprises.enterprise_id')
        ->where('saved_enterprises.investor_id', $investorId)
        ->orderBy('saved_enterprises.created_at', 'DESC')
        ->limit(10)
        ->get()
        ->getResultArray();

    // ========== INTRODUCTIONS ==========
    $introductions = $db->table('matches')
        ->select('matches.*, enterprises.name as enterprise_name, enterprises.sector, enterprises.location, enterprises.contact_person, enterprises.email as enterprise_email, enterprises.phone as enterprise_phone')
        ->join('enterprises', 'enterprises.enterprise_id = matches.enterprise_id')
        ->where('matches.investor_id', $investorId)
        ->where('matches.status', 'introduced')
        ->orderBy('matches.updated_at', 'DESC')
        ->get()
        ->getResultArray();

    // ========== DEAL PROGRESS (FIXED - Using Raw Query) ==========
    $dealProgressSql = "
        SELECT 
            deals.*, 
            enterprises.name as enterprise_name, 
            enterprises.sector,
            CASE 
                WHEN deals.status = 'negotiating' THEN 25
                WHEN deals.status = 'agreed' THEN 50
                WHEN deals.status = 'signed' THEN 75
                WHEN deals.status = 'completed' THEN 100
                ELSE 10
            END as progress_percentage
        FROM deals
        JOIN enterprises ON enterprises.enterprise_id = deals.enterprise_id
        WHERE deals.investor_id = ?
        AND deals.status != 'cancelled'
        ORDER BY deals.created_at DESC
        LIMIT 10
    ";

    $dealProgress = $db->query($dealProgressSql, [$investorId])->getResultArray();

    // ========== MATCH STATUS DISTRIBUTION ==========
    $matchStatusDistribution = $db->table('matches')
        ->select('status, COUNT(*) as count')
        ->where('investor_id', $investorId)
        ->groupBy('status')
        ->get()
        ->getResultArray();

    // ========== GET SECTORS FOR FILTER ==========
    $sectors = $db->query("SELECT DISTINCT sector FROM enterprises WHERE sector IS NOT NULL AND sector != '' ORDER BY sector")->getResultArray();
    
    // If no sectors found, provide empty array
    if (empty($sectors)) {
        $sectors = [];
    }

    $data = [
        'title' => 'Investor Dashboard — AIIIIS',
        'page_title' => 'Investor Dashboard',
        'user' => [
            'name' => session()->get('name'),
            'role' => session()->get('role'),
            'email' => session()->get('email'),
            'user_id' => session()->get('user_id')
        ],
        'investor' => $investor,
        'stats' => $stats,
        'matches' => $matches,
        'recommended_enterprises' => $recommendedEnterprises,
        'investment_opportunities' => $investmentOpportunities,
        'saved_enterprises' => $savedEnterprises,
        'introductions' => $introductions,
        'deal_progress' => $dealProgress,
        'match_status_distribution' => $matchStatusDistribution,
        'sectors' => $sectors,  // ADD THIS LINE
        'filters' => [           // ADD THIS LINE
            'sector' => '',
            'search' => ''
        ]
    ];

    return view('investor/dashboard', $data);
}

    public function getInvestor($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $investor = $db->table('investors')->where('investor_id', $id)->get()->getRowArray();

        if ($investor) {
            return $this->response->setJSON(['success' => true, 'data' => $investor]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Investor not found']);
    }

    public function store()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();

        $data = [
            'user_id' => $this->request->getPost('user_id') ?: null,
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'investment_sector' => $this->request->getPost('investment_sector'),
            'preferred_enterprise_type' => $this->request->getPost('preferred_enterprise_type'),
            'investment_amount_min' => $this->request->getPost('investment_amount_min') ?: 0,
            'investment_amount_max' => $this->request->getPost('investment_amount_max') ?: 0,
            'geographic_preferences' => $this->request->getPost('geographic_preferences'),
            'technology_interests' => $this->request->getPost('technology_interests'),
            'sustainability_preferences' => $this->request->getPost('sustainability_preferences'),
            'investment_stage' => $this->request->getPost('investment_stage'),
            'expected_returns' => $this->request->getPost('expected_returns') ?: 0,
            'investment_criteria' => $this->request->getPost('investment_criteria'),
            'is_verified' => $this->request->getPost('is_verified') ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($db->table('investors')->insert($data)) {
            $id = $db->insertID();
            return $this->response->setJSON(['success' => true, 'message' => 'Investor created successfully!', 'id' => $id]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to create investor']);
    }

    public function update($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();

        $data = [
            'user_id' => $this->request->getPost('user_id') ?: null,
            'name' => $this->request->getPost('name'),
            'type' => $this->request->getPost('type'),
            'investment_sector' => $this->request->getPost('investment_sector'),
            'preferred_enterprise_type' => $this->request->getPost('preferred_enterprise_type'),
            'investment_amount_min' => $this->request->getPost('investment_amount_min') ?: 0,
            'investment_amount_max' => $this->request->getPost('investment_amount_max') ?: 0,
            'geographic_preferences' => $this->request->getPost('geographic_preferences'),
            'technology_interests' => $this->request->getPost('technology_interests'),
            'sustainability_preferences' => $this->request->getPost('sustainability_preferences'),
            'investment_stage' => $this->request->getPost('investment_stage'),
            'expected_returns' => $this->request->getPost('expected_returns') ?: 0,
            'investment_criteria' => $this->request->getPost('investment_criteria'),
            'is_verified' => $this->request->getPost('is_verified') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($db->table('investors')->where('investor_id', $id)->update($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Investor updated successfully!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to update investor']);
    }

    public function delete($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        
        if ($db->table('investors')->where('investor_id', $id)->delete()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Investor deleted successfully!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete investor']);
    }
}