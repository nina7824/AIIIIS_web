<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
  

   public function index()
{
    // Check if user is logged in and is admin
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
        return redirect()->to('/login');
    }

    $db = \Config\Database::connect();
    
    // ========== STATS ==========
    $stats = [
        'total_enterprises' => $db->table('enterprises')->countAll(),
        'total_investors' => $db->table('investors')->countAll(),
        'total_matches' => $db->table('matches')->countAll(),
        'pending_verifications' => $db->table('enterprises')->where('is_verified', 0)->countAllResults(),
        'active_deals' => $db->table('deals')->where('status !=', 'completed')->where('status !=', 'cancelled')->countAllResults()
    ];

    // ========== SECTOR DISTRIBUTION ==========
    $sectorDistribution = $db->table('enterprises')
        ->select('sector, COUNT(*) as count')
        ->groupBy('sector')
        ->get()
        ->getResultArray();

    // ========== LOCATION DISTRIBUTION ==========
    $locationDistribution = $db->table('enterprises')
        ->select('location, COUNT(*) as count')
        ->groupBy('location')
        ->get()
        ->getResultArray();

    // ========== TOP RANKINGS (Distinct) ==========
    $topRankings = $db->table('enterprise_rankings')
        ->select('enterprise_rankings.*, enterprises.name as enterprise_name, enterprises.sector')
        ->join('enterprises', 'enterprises.enterprise_id = enterprise_rankings.enterprise_id')
        ->orderBy('total_score', 'DESC')
        ->groupBy('enterprise_rankings.enterprise_id')
        ->limit(10)
        ->get()
        ->getResultArray();

    // ========== CLUSTERS ==========
    $clusters = $db->table('enterprises')
        ->select('sector, location, COUNT(*) as count')
        ->groupBy('sector, location')
        ->having('COUNT(*) >', 1)
        ->get()
        ->getResultArray();

    // ========== INVESTMENT OPPORTUNITIES ==========
    $investmentOpportunities = $db->table('enterprises')
        ->select('enterprise_id, name, sector, investment_requirements')
        ->where('investment_requirements !=', '')
        ->where('investment_requirements IS NOT NULL', null, false)
        ->limit(10)
        ->get()
        ->getResultArray();

    // ========== RECENT INVESTORS ==========
    $recentInvestors = $db->table('investors')
        ->orderBy('created_at', 'DESC')
        ->limit(10)
        ->get()
        ->getResultArray();

    // ========== MATCH STATS ==========
    $matchStats = [
        'total' => $db->table('matches')->countAll(),
        'pending' => $db->table('matches')->where('status', 'pending')->countAllResults(),
        'accepted' => $db->table('matches')->where('status', 'accepted')->countAllResults(),
        'rejected' => $db->table('matches')->where('status', 'rejected')->countAllResults(),
        'introduced' => $db->table('matches')->where('status', 'introduced')->countAllResults(),
        'negotiating' => $db->table('matches')->where('status', 'negotiating')->countAllResults(),
        'closed' => $db->table('matches')->where('status', 'closed')->countAllResults(),
        'avg_score' => round($db->table('matches')->selectAvg('match_score')->get()->getRow()->match_score ?? 0, 1)
    ];

    // ========== ENGAGEMENT STATS ==========
    $engagementStats = [
        'total' => $db->table('engagements')->countAll(),
        'visits' => $db->table('engagements')->where('type', 'visit')->countAllResults(),
        'meetings' => $db->table('engagements')->where('type', 'meeting')->countAllResults(),
        'advisory' => $db->table('engagements')->where('type', 'advisory')->countAllResults(),
        'training' => $db->table('engagements')->where('type', 'training')->countAllResults(),
        'support' => $db->table('engagements')->where('type', 'support')->countAllResults(),
        'follow_up' => $db->table('engagements')->where('type', 'follow_up')->countAllResults()
    ];

    // ========== IOT DATA ==========
    $iotData = $db->table('iot_data')
        ->select('sensor_name, parameter, value, unit, timestamp, enterprise_id')
        ->orderBy('timestamp', 'DESC')
        ->limit(10)
        ->get()
        ->getResultArray();

    // ========== RECENT USERS ==========
    $recentUsers = $db->table('users')
        ->orderBy('created_at', 'DESC')
        ->limit(5)
        ->get()
        ->getResultArray();

    // ========== RECENT ENTERPRISES ==========
    $recentEnterprises = $db->table('enterprises')
        ->orderBy('created_at', 'DESC')
        ->limit(5)
        ->get()
        ->getResultArray();

    // ========== BUILD DATA ARRAY ==========
    $data = [
        'title' => 'NIRDA Dashboard — AIIIIS',
        'page_title' => 'NIRDA Dashboard',
        'user' => [
            'name' => session()->get('name'),
            'role' => session()->get('role'),
            'email' => session()->get('email'),
            'user_id' => session()->get('user_id')
        ],
        'stats' => $stats,
        'sector_distribution' => $sectorDistribution,
        'location_distribution' => $locationDistribution,
        'top_rankings' => $topRankings,
        'clusters' => $clusters,
        'investment_opportunities' => $investmentOpportunities,
        'recent_investors' => $recentInvestors,
        'match_stats' => $matchStats,
        'engagement_stats' => $engagementStats,
        'iot_data' => $iotData,
        'recent_users' => $recentUsers,
        'recent_enterprises' => $recentEnterprises
    ];

    return view('admin/dashboard', $data);
}
    // ... rest of your methods (users, enterprises, investors, matches, etc.)



    public function users()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $users = $db->table('users')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'User Management — AIIIIS',
            'page_title' => 'User Management',
            'breadcrumb' => 'Users',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'users' => $users
        ];

        return view('admin/users', $data);
    }

    public function enterprises()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $enterprises = $db->table('enterprises')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Enterprises — AIIIIS',
            'page_title' => 'Enterprises',
            'breadcrumb' => 'Enterprises',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'enterprises' => $enterprises
        ];

        return view('admin/enterprises', $data);
    }

    public function investors()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $investors = $db->table('investors')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Investors — AIIIIS',
            'page_title' => 'Investors',
            'breadcrumb' => 'Investors',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'investors' => $investors
        ];

        return view('admin/investors', $data);
    }

    public function matches()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        
        // Get all matches with enterprise and investor details
        $matches = $db->table('matches')
            ->select('matches.*, enterprises.name as enterprise_name, enterprises.sector, investors.name as investor_name, investors.type as investor_type')
            ->join('enterprises', 'enterprises.enterprise_id = matches.enterprise_id', 'left')
            ->join('investors', 'investors.investor_id = matches.investor_id', 'left')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        // Get match statistics
        $totalMatches = $db->table('matches')->countAll();
        $pendingMatches = $db->table('matches')->where('status', 'pending')->countAllResults();
        $acceptedMatches = $db->table('matches')->where('status', 'accepted')->countAllResults();
        $rejectedMatches = $db->table('matches')->where('status', 'rejected')->countAllResults();
        $introducedMatches = $db->table('matches')->where('status', 'introduced')->countAllResults();
        $negotiatingMatches = $db->table('matches')->where('status', 'negotiating')->countAllResults();
        $closedMatches = $db->table('matches')->where('status', 'closed')->countAllResults();

        // Get average match score
        $avgScore = $db->table('matches')->selectAvg('match_score')->get()->getRow()->match_score ?? 0;

        $data = [
            'title' => 'Matches — AIIIIS',
            'page_title' => 'Investment Matches',
            'breadcrumb' => 'Matches',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'matches' => $matches,
            'stats' => [
                'total' => $totalMatches,
                'pending' => $pendingMatches,
                'accepted' => $acceptedMatches,
                'rejected' => $rejectedMatches,
                'introduced' => $introducedMatches,
                'negotiating' => $negotiatingMatches,
                'closed' => $closedMatches,
                'avg_score' => round($avgScore, 1)
            ]
        ];

        return view('admin/matches', $data);
    }

    public function viewMatch($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        
        // Get match details
        $match = $db->table('matches')
            ->select('matches.*, enterprises.name as enterprise_name, enterprises.sector, enterprises.location, enterprises.contact_person, enterprises.email as enterprise_email, enterprises.phone as enterprise_phone, investors.name as investor_name, investors.type as investor_type, investors.investment_sector, investors.investment_amount_min, investors.investment_amount_max')
            ->join('enterprises', 'enterprises.enterprise_id = matches.enterprise_id', 'left')
            ->join('investors', 'investors.investor_id = matches.investor_id', 'left')
            ->where('matches.match_id', $id)
            ->get()
            ->getRowArray();

        if (!$match) {
            return redirect()->to('/admin/matches')->with('error', 'Match not found');
        }

        $data = [
            'title' => 'Match Details — AIIIIS',
            'page_title' => 'Match Details',
            'breadcrumb' => 'Matches / View',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'match' => $match
        ];

        return view('admin/match_view', $data);
    }

    public function updateMatchStatus($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $status = $this->request->getPost('status');
        $notes = $this->request->getPost('notes');

        $db = \Config\Database::connect();
        
        // Update match status
        $db->table('matches')
            ->where('match_id', $id)
            ->update([
                'status' => $status,
                'notes' => $notes,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return redirect()->to('/admin/matches')->with('success', 'Match status updated successfully');
    }

    public function deleteMatch($id)
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $db->table('matches')->where('match_id', $id)->delete();

        return redirect()->to('/admin/matches')->with('success', 'Match deleted successfully');
    }

    public function deals()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $deals = $db->table('deals')
            ->select('deals.*, enterprises.name as enterprise_name, investors.name as investor_name')
            ->join('enterprises', 'enterprises.enterprise_id = deals.enterprise_id', 'left')
            ->join('investors', 'investors.investor_id = deals.investor_id', 'left')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Deals — AIIIIS',
            'page_title' => 'Deal Tracking',
            'breadcrumb' => 'Deals',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'deals' => $deals
        ];

        return view('admin/deals', $data);
    }

    public function analytics()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        
        // Get sector distribution
        $sectorDistribution = $db->table('enterprises')
            ->select('sector, COUNT(*) as count')
            ->groupBy('sector')
            ->get()
            ->getResultArray();

        // Get monthly registrations
        $monthlyRegistrations = $db->table('users')
            ->select('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'DESC')
            ->limit(6)
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Analytics — AIIIIS',
            'page_title' => 'Analytics',
            'breadcrumb' => 'Analytics',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'sector_distribution' => $sectorDistribution,
            'monthly_registrations' => $monthlyRegistrations
        ];

        return view('admin/analytics', $data);
    }

    public function settings()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Settings — AIIIIS',
            'page_title' => 'System Settings',
            'breadcrumb' => 'Settings',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ]
        ];

        return view('admin/settings', $data);
    }

    public function updateSettings()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        // Get form data
        $siteName = $this->request->getPost('site_name');
        $siteUrl = $this->request->getPost('site_url');
        $maintenanceMode = $this->request->getPost('maintenance_mode');
        $debugMode = $this->request->getPost('debug_mode');

        // You can save these settings to a database table or config file
        // For now, we'll just show a success message
        // In a real application, you would save these to a settings table

        // Example: Save to session for demonstration
        session()->setFlashdata('success', 'Settings updated successfully!');
        
        return redirect()->to('/admin/settings');
    }
}