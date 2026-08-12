<?php

namespace App\Controllers\Investor;

use App\Controllers\BaseController;

class Dashboard extends BaseController
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
            'match_status_distribution' => $matchStatusDistribution
        ];

        return view('investor/dashboard', $data);
    }

    public function profile()
{
    // Check if user is logged in and is investor
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
        return redirect()->to('/login');
    }

    $db = \Config\Database::connect();
    $userId = session()->get('user_id');
    
    $investor = $db->table('investors')
        ->where('user_id', $userId)
        ->get()
        ->getRowArray();

    $data = [
        'title' => 'My Profile — AIIIIS',
        'page_title' => 'My Profile',
        'user' => [
            'name' => session()->get('name'),
            'role' => session()->get('role'),
            'email' => session()->get('email'),
            'user_id' => session()->get('user_id')
        ],
        'investor' => $investor
    ];

    return view('investor/profile', $data);
}

public function editProfile()
{
    // Check if user is logged in and is investor
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
        return redirect()->to('/login');
    }

    $db = \Config\Database::connect();
    $userId = session()->get('user_id');
    
    $investor = $db->table('investors')
        ->where('user_id', $userId)
        ->get()
        ->getRowArray();

    $data = [
        'title' => 'Edit Profile — AIIIIS',
        'page_title' => 'Edit Profile',
        'breadcrumb' => 'Edit Profile',
        'user' => [
            'name' => session()->get('name'),
            'role' => session()->get('role'),
            'email' => session()->get('email'),
            'user_id' => session()->get('user_id')
        ],
        'investor' => $investor
    ];

    return view('investor/edit_profile', $data);
}

public function updateProfile()
{
    // Check if user is logged in and is investor
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
        return redirect()->to('/login');
    }

    $db = \Config\Database::connect();
    $userId = session()->get('user_id');
    
    // Get form data
    $data = [
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
        'is_verified' => 0, // Needs admin verification
        'updated_at' => date('Y-m-d H:i:s')
    ];

    // Check if investor profile exists
    $existing = $db->table('investors')
        ->where('user_id', $userId)
        ->get()
        ->getRowArray();

    if ($existing) {
        // Update existing profile
        $db->table('investors')
            ->where('user_id', $userId)
            ->update($data);
        $message = 'Profile updated successfully!';
    } else {
        // Create new profile
        $data['user_id'] = $userId;
        $data['created_at'] = date('Y-m-d H:i:s');
        $db->table('investors')->insert($data);
        $message = 'Profile created successfully!';
    }

    return redirect()->to('/investor/profile')->with('success', $message);
}


    public function matches()
    {
        // Check if user is logged in and is investor
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $investor = $db->table('investors')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$investor) {
            return redirect()->to('/investor/profile')->with('error', 'Please complete your investor profile first.');
        }

        $matches = $db->table('matches')
            ->select('matches.*, enterprises.name as enterprise_name, enterprises.sector, enterprises.location, enterprises.contact_person, enterprises.email as enterprise_email, enterprises.phone as enterprise_phone')
            ->join('enterprises', 'enterprises.enterprise_id = matches.enterprise_id')
            ->where('matches.investor_id', $investor['investor_id'])
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'My Matches — AIIIIS',
            'page_title' => 'My Matches',
            'breadcrumb' => 'Matches',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'matches' => $matches
        ];

        return view('investor/matches', $data);
    }

    public function deals()
    {
        // Check if user is logged in and is investor
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $investor = $db->table('investors')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$investor) {
            return redirect()->to('/investor/profile')->with('error', 'Please complete your investor profile first.');
        }

        $deals = $db->table('deals')
            ->select('deals.*, enterprises.name as enterprise_name, enterprises.sector')
            ->join('enterprises', 'enterprises.enterprise_id = deals.enterprise_id')
            ->where('deals.investor_id', $investor['investor_id'])
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'My Deals — AIIIIS',
            'page_title' => 'My Deals',
            'breadcrumb' => 'Deals',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'deals' => $deals
        ];

        return view('investor/deals', $data);
    }

  public function search()
{
    // Check if user is logged in and is investor
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
        return redirect()->to('/login');
    }

    $db = \Config\Database::connect();
    
    // Get search parameters
    $sector = $this->request->getGet('sector');
    $location = $this->request->getGet('location');
    $minScore = $this->request->getGet('min_score');
    $search = $this->request->getGet('search');
    $minGrowth = $this->request->getGet('min_growth');
    $minInnovation = $this->request->getGet('min_innovation');
    $minSustainability = $this->request->getGet('min_sustainability');
    $womenOwned = $this->request->getGet('women_owned');
    $sortBy = $this->request->getGet('sort_by') ?? 'ranking';
    
    $query = $db->table('enterprises')
        ->select('enterprises.*, 
            enterprise_rankings.total_score,
            enterprise_rankings.growth_score,
            enterprise_rankings.innovation_score,
            enterprise_rankings.technology_score,
            enterprise_rankings.sustainability_score,
            enterprise_rankings.investment_potential_score,
            enterprise_rankings.rank_position')
        ->join('enterprise_rankings', 'enterprises.enterprise_id = enterprise_rankings.enterprise_id', 'left')
        ->where('enterprises.is_verified', 1)
        ->where('enterprises.status', 'active');

    // Filter by sector
    if ($sector) {
        $query->where('enterprises.sector', $sector);
    }
    
    // Filter by location
    if ($location) {
        $query->like('enterprises.location', $location);
    }
    
    // Filter by search term
    if ($search) {
        $query->groupStart()
            ->like('enterprises.name', $search)
            ->orLike('enterprises.sector', $search)
            ->orLike('enterprises.location', $search)
            ->orLike('enterprises.investment_requirements', $search)
            ->groupEnd();
    }
    
    // Filter by minimum ranking score
    if ($minScore) {
        $query->where('enterprise_rankings.total_score >=', $minScore);
    }
    
    // Filter by minimum growth score
    if ($minGrowth) {
        $query->where('enterprise_rankings.growth_score >=', $minGrowth);
    }
    
    // Filter by minimum innovation score
    if ($minInnovation) {
        $query->where('enterprise_rankings.innovation_score >=', $minInnovation);
    }
    
    // Filter by minimum sustainability score
    if ($minSustainability) {
        $query->where('enterprise_rankings.sustainability_score >=', $minSustainability);
    }
    
    // Filter: Women-Owned Enterprises
    if ($womenOwned) {
        $query->where('enterprises.is_women_owned', 1);
    }

    // Sorting
    switch ($sortBy) {
        case 'ranking':
            $query->orderBy('enterprise_rankings.total_score', 'DESC');
            break;
        case 'growth':
            $query->orderBy('enterprise_rankings.growth_score', 'DESC');
            break;
        case 'innovation':
            $query->orderBy('enterprise_rankings.innovation_score', 'DESC');
            break;
        case 'sustainability':
            $query->orderBy('enterprise_rankings.sustainability_score', 'DESC');
            break;
        case 'employees':
            $query->orderBy('enterprises.employees', 'DESC');
            break;
        case 'revenue':
            $query->orderBy('enterprises.revenue', 'DESC');
            break;
        case 'name':
            $query->orderBy('enterprises.name', 'ASC');
            break;
        default:
            $query->orderBy('enterprise_rankings.total_score', 'DESC');
    }

    $enterprises = $query->get()->getResultArray();

    // Get sectors for filter
    $sectors = $db->query("SELECT DISTINCT sector FROM enterprises WHERE sector IS NOT NULL AND sector != '' ORDER BY sector")->getResultArray();
    
    // Get locations for filter
    $locations = $db->query("SELECT DISTINCT location FROM enterprises WHERE location IS NOT NULL AND location != '' ORDER BY location")->getResultArray();

    $data = [
        'title' => 'Find Enterprises — AIIIIS',
        'page_title' => 'Find Enterprises',
        'breadcrumb' => 'Search',
        'user' => [
            'name' => session()->get('name'),
            'role' => session()->get('role'),
            'email' => session()->get('email'),
            'user_id' => session()->get('user_id')
        ],
        'enterprises' => $enterprises,
        'sectors' => $sectors,
        'locations' => $locations,
        'filters' => [
            'sector' => $sector,
            'location' => $location,
            'min_score' => $minScore,
            'search' => $search,
            'min_growth' => $minGrowth,
            'min_innovation' => $minInnovation,
            'min_sustainability' => $minSustainability,
            'women_owned' => $womenOwned,
            'sort_by' => $sortBy
        ]
    ];

    return view('investor/search', $data);
}
    public function portfolio()
    {
        // Check if user is logged in and is investor
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $investor = $db->table('investors')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$investor) {
            return redirect()->to('/investor/profile')->with('error', 'Please complete your investor profile first.');
        }

        // Get portfolio summary
        $portfolioSummary = $db->table('deals')
            ->select('
                COUNT(*) as total_deals,
                SUM(CASE WHEN status = "completed" THEN 1 ELSE 0 END) as completed_deals,
                SUM(CASE WHEN status = "signed" THEN 1 ELSE 0 END) as signed_deals,
                SUM(CASE WHEN status = "negotiating" THEN 1 ELSE 0 END) as negotiating_deals,
                SUM(deal_amount) as total_investment,
                AVG(deal_amount) as avg_investment
            ')
            ->where('investor_id', $investor['investor_id'])
            ->get()
            ->getRowArray();

        // Get portfolio by sector
        $portfolioBySector = $db->table('deals')
            ->select('enterprises.sector, COUNT(*) as count, SUM(deals.deal_amount) as total')
            ->join('enterprises', 'enterprises.enterprise_id = deals.enterprise_id')
            ->where('deals.investor_id', $investor['investor_id'])
            ->where('deals.status', 'completed')
            ->groupBy('enterprises.sector')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'My Portfolio — AIIIIS',
            'page_title' => 'My Portfolio',
            'breadcrumb' => 'Portfolio',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'portfolio_summary' => $portfolioSummary,
            'portfolio_by_sector' => $portfolioBySector
        ];

        return view('investor/portfolio', $data);
    }

    public function saveEnterprise()
    {
        // Check if user is logged in and is investor
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        $enterpriseId = $this->request->getPost('enterprise_id');
        
        // Get investor
        $investor = $db->table('investors')->where('user_id', $userId)->get()->getRowArray();
        
        if (!$investor) {
            return $this->response->setJSON(['success' => false, 'message' => 'Investor profile not found']);
        }

        // Check if already saved
        $existing = $db->table('saved_enterprises')
            ->where('investor_id', $investor['investor_id'])
            ->where('enterprise_id', $enterpriseId)
            ->get()
            ->getRowArray();

        if ($existing) {
            // Remove from saved
            $db->table('saved_enterprises')
                ->where('investor_id', $investor['investor_id'])
                ->where('enterprise_id', $enterpriseId)
                ->delete();
            return $this->response->setJSON(['success' => true, 'action' => 'unsaved', 'message' => 'Enterprise removed from saved list']);
        } else {
            // Add to saved
            $db->table('saved_enterprises')->insert([
                'investor_id' => $investor['investor_id'],
                'enterprise_id' => $enterpriseId,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return $this->response->setJSON(['success' => true, 'action' => 'saved', 'message' => 'Enterprise saved successfully']);
        }
    }

    public function requestIntroduction()
    {
        // Check if user is logged in and is investor
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'investor') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        $matchId = $this->request->getPost('match_id');
        
        // Get investor
        $investor = $db->table('investors')->where('user_id', $userId)->get()->getRowArray();
        
        if (!$investor) {
            return $this->response->setJSON(['success' => false, 'message' => 'Investor profile not found']);
        }

        // Update match status to introduced
        $db->table('matches')
            ->where('match_id', $matchId)
            ->where('investor_id', $investor['investor_id'])
            ->update([
                'status' => 'introduced',
                'introduced_date' => date('Y-m-d'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Introduction request sent successfully']);
    }
}