<?php

namespace App\Controllers\Enterprise;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        // Get enterprise profile
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();
        
        if (!$enterprise) {
            return redirect()->to('/enterprise/profile')->with('error', 'Please complete your enterprise profile first.');
        }

        $enterpriseId = $enterprise['enterprise_id'];

        // ========== STATS ==========
        $stats = [
            'profile_complete' => $this->getProfileCompletion($enterprise),
            'ranking' => $this->getEnterpriseRanking($enterpriseId),
            'total_matches' => $db->table('matches')->where('enterprise_id', $enterpriseId)->countAllResults(),
            'pending_matches' => $db->table('matches')->where('enterprise_id', $enterpriseId)->where('status', 'pending')->countAllResults(),
            'accepted_matches' => $db->table('matches')->where('enterprise_id', $enterpriseId)->where('status', 'accepted')->countAllResults(),
            'investor_interest' => $db->table('matches')->where('enterprise_id', $enterpriseId)->where('status', 'introduced')->countAllResults(),
            'total_engagements' => $db->table('engagements')->where('enterprise_id', $enterpriseId)->countAllResults(),
            'pending_requests' => $db->table('helpdesk_requests')->where('enterprise_id', $enterpriseId)->where('status', 'pending')->countAllResults(),
            'unread_notifications' => $db->table('notifications')->where('user_id', $userId)->where('is_read', 0)->countAllResults()
        ];

        // ========== INVESTOR MATCHES ==========
        $matches = $db->table('matches')
            ->select('matches.*, investors.name as investor_name, investors.type as investor_type, investors.investment_sector')
            ->join('investors', 'investors.investor_id = matches.investor_id')
            ->where('matches.enterprise_id', $enterpriseId)
            ->orderBy('match_score', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        // ========== INVESTMENT OPPORTUNITIES ==========
        $investmentOpportunities = $db->table('investment_requests')
            ->where('enterprise_id', $enterpriseId)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        // ========== ADVISORY REQUESTS ==========
        $advisoryRequests = $db->table('advisory_requests')
            ->select('advisory_requests.*, experts.name as expert_name, experts.specialization')
            ->join('experts', 'experts.expert_id = advisory_requests.expert_id', 'left')
            ->where('advisory_requests.enterprise_id', $enterpriseId)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        // ========== ENGAGEMENT HISTORY ==========
        $engagements = $db->table('engagements')
            ->select('engagements.*, experts.name as expert_name')
            ->join('experts', 'experts.expert_id = engagements.expert_id', 'left')
            ->where('engagements.enterprise_id', $enterpriseId)
            ->orderBy('date', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        // ========== NOTIFICATIONS ==========
        $notifications = $db->table('notifications')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

        // ========== HELPDESK REQUESTS ==========
        $helpdeskRequests = $db->table('helpdesk_requests')
            ->where('enterprise_id', $enterpriseId)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Enterprise Dashboard — AIIIIS',
            'page_title' => 'Enterprise Dashboard',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'enterprise' => $enterprise,
            'stats' => $stats,
            'matches' => $matches,
            'investment_opportunities' => $investmentOpportunities,
            'advisory_requests' => $advisoryRequests,
            'engagements' => $engagements,
            'notifications' => $notifications,
            'helpdesk_requests' => $helpdeskRequests
        ];

        return view('enterprise/dashboard', $data);
    }

    private function getProfileCompletion($enterprise)
    {
        $fields = ['name', 'registration_number', 'sector', 'location', 'contact_person', 'email', 'phone', 'employees', 'revenue'];
        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($enterprise[$field])) {
                $filled++;
            }
        }
        return round(($filled / count($fields)) * 100);
    }

    private function getEnterpriseRanking($enterpriseId)
    {
        $db = \Config\Database::connect();
        $ranking = $db->table('enterprise_rankings')
            ->where('enterprise_id', $enterpriseId)
            ->orderBy('ranking_date', 'DESC')
            ->get()
            ->getRowArray();
        return $ranking ? $ranking['total_score'] : 0;
    }

    public function profile()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
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
            'enterprise' => $enterprise
        ];

        return view('enterprise/profile', $data);
    }

    public function editProfile()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
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
            'enterprise' => $enterprise
        ];

        return view('enterprise/edit_profile', $data);
    }

    public function updateProfile()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');

        $data = [
            'name' => $this->request->getPost('name'),
            'registration_number' => $this->request->getPost('registration_number'),
            'sector' => $this->request->getPost('sector'),
            'sub_sector' => $this->request->getPost('sub_sector'),
            'location' => $this->request->getPost('location'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude'),
            'contact_person' => $this->request->getPost('contact_person'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'website' => $this->request->getPost('website'),
            'products_services' => $this->request->getPost('products_services'),
            'employees' => $this->request->getPost('employees') ?: 0,
            'revenue' => $this->request->getPost('revenue') ?: 0,
            'growth_potential' => $this->request->getPost('growth_potential') ?: 0,
            'technology_level' => $this->request->getPost('technology_level'),
            'innovation_capacity' => $this->request->getPost('innovation_capacity') ?: 0,
            'environmental_sustainability' => $this->request->getPost('environmental_sustainability') ?: 0,
            'social_inclusion' => $this->request->getPost('social_inclusion') ?: 0,
            'investment_requirements' => $this->request->getPost('investment_requirements'),
            'is_women_owned' => $this->request->getPost('is_women_owned') ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $db->table('enterprises')->where('user_id', $userId)->update($data);

        return redirect()->to('/enterprise/profile')->with('success', 'Profile updated successfully!');
    }

    public function investment()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return redirect()->to('/enterprise/profile')->with('error', 'Please complete your enterprise profile first.');
        }

        // Get investment requests
        $investmentRequests = $db->table('investment_requests')
            ->where('enterprise_id', $enterprise['enterprise_id'])
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        // Get investor interest
        $investorInterest = $db->table('matches')
            ->select('matches.*, investors.name as investor_name, investors.type as investor_type')
            ->join('investors', 'investors.investor_id = matches.investor_id')
            ->where('matches.enterprise_id', $enterprise['enterprise_id'])
            ->where('matches.status', 'introduced')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Investment — AIIIIS',
            'page_title' => 'Investment',
            'breadcrumb' => 'Investment',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'enterprise' => $enterprise,
            'investment_requests' => $investmentRequests,
            'investor_interest' => $investorInterest
        ];

        return view('enterprise/investment', $data);
    }

    public function submitInvestment()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return $this->response->setJSON(['success' => false, 'message' => 'Enterprise not found']);
        }

        $data = [
            'enterprise_id' => $enterprise['enterprise_id'],
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'funding_required' => $this->request->getPost('funding_required'),
            'funding_type' => $this->request->getPost('funding_type'),
            'use_of_funds' => $this->request->getPost('use_of_funds'),
            'timeline' => $this->request->getPost('timeline'),
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Handle file uploads
        $businessPlan = $this->request->getFile('business_plan');
        $financialModel = $this->request->getFile('financial_model');

        if ($businessPlan && $businessPlan->isValid() && !$businessPlan->hasMoved()) {
            $businessPlanName = 'business_plan_' . time() . '_' . $businessPlan->getClientName();
            $businessPlan->move('uploads/business_plans/', $businessPlanName);
            $data['business_plan'] = $businessPlanName;
        }

        if ($financialModel && $financialModel->isValid() && !$financialModel->hasMoved()) {
            $financialModelName = 'financial_model_' . time() . '_' . $financialModel->getClientName();
            $financialModel->move('uploads/financial_models/', $financialModelName);
            $data['financial_model'] = $financialModelName;
        }

        if ($db->table('investment_requests')->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Investment request submitted successfully!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to submit investment request']);
    }

    public function matches()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return redirect()->to('/enterprise/profile')->with('error', 'Please complete your enterprise profile first.');
        }

        $matches = $db->table('matches')
            ->select('matches.*, investors.name as investor_name, investors.type as investor_type, investors.investment_sector, investors.geographic_preferences')
            ->join('investors', 'investors.investor_id = matches.investor_id')
            ->where('matches.enterprise_id', $enterprise['enterprise_id'])
            ->orderBy('match_score', 'DESC')
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
            'enterprise' => $enterprise,
            'matches' => $matches
        ];

        return view('enterprise/matches', $data);
    }

    public function advisory()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return redirect()->to('/enterprise/profile')->with('error', 'Please complete your enterprise profile first.');
        }

        // Get experts
        $experts = $db->table('experts')
            ->where('availability', 'available')
            ->get()
            ->getResultArray();

        // Get advisory requests
        $advisoryRequests = $db->table('advisory_requests')
            ->select('advisory_requests.*, experts.name as expert_name, experts.specialization')
            ->join('experts', 'experts.expert_id = advisory_requests.expert_id', 'left')
            ->where('advisory_requests.enterprise_id', $enterprise['enterprise_id'])
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Advisory — AIIIIS',
            'page_title' => 'Advisory',
            'breadcrumb' => 'Advisory',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'enterprise' => $enterprise,
            'experts' => $experts,
            'advisory_requests' => $advisoryRequests
        ];

        return view('enterprise/advisory', $data);
    }

    public function requestAdvisory()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return $this->response->setJSON(['success' => false, 'message' => 'Enterprise not found']);
        }

        $data = [
            'enterprise_id' => $enterprise['enterprise_id'],
            'expert_id' => $this->request->getPost('expert_id'),
            'subject' => $this->request->getPost('subject'),
            'description' => $this->request->getPost('description'),
            'priority' => $this->request->getPost('priority') ?: 'medium',
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($db->table('advisory_requests')->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Advisory request submitted successfully!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to submit advisory request']);
    }

    public function helpdesk()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return redirect()->to('/enterprise/profile')->with('error', 'Please complete your enterprise profile first.');
        }

        // Get helpdesk requests
        $helpdeskRequests = $db->table('helpdesk_requests')
            ->where('enterprise_id', $enterprise['enterprise_id'])
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Helpdesk — AIIIIS',
            'page_title' => 'Helpdesk',
            'breadcrumb' => 'Helpdesk',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'enterprise' => $enterprise,
            'helpdesk_requests' => $helpdeskRequests
        ];

        return view('enterprise/helpdesk', $data);
    }

    public function submitHelpdesk()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return $this->response->setJSON(['success' => false, 'message' => 'Enterprise not found']);
        }

        $data = [
            'enterprise_id' => $enterprise['enterprise_id'],
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
            'category' => $this->request->getPost('category'),
            'priority' => $this->request->getPost('priority') ?: 'medium',
            'status' => 'open',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($db->table('helpdesk_requests')->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Helpdesk ticket submitted successfully!']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Failed to submit helpdesk ticket']);
    }

    public function notifications()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');

        // Mark all as read
        $db->table('notifications')
            ->where('user_id', $userId)
            ->update(['is_read' => 1]);

        $notifications = $db->table('notifications')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Notifications — AIIIIS',
            'page_title' => 'Notifications',
            'breadcrumb' => 'Notifications',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'notifications' => $notifications
        ];

        return view('enterprise/notifications', $data);
    }

    public function engagements()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return redirect()->to('/enterprise/profile')->with('error', 'Please complete your enterprise profile first.');
        }

        $engagements = $db->table('engagements')
            ->select('engagements.*, experts.name as expert_name')
            ->join('experts', 'experts.expert_id = engagements.expert_id', 'left')
            ->where('engagements.enterprise_id', $enterprise['enterprise_id'])
            ->orderBy('date', 'DESC')
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Engagements — AIIIIS',
            'page_title' => 'Engagements',
            'breadcrumb' => 'Engagements',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'enterprise' => $enterprise,
            'engagements' => $engagements
        ];

        return view('enterprise/engagements', $data);
    }

    public function ranking()
    {
        // Check if user is logged in and is enterprise
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'enterprise') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        
        $enterprise = $db->table('enterprises')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        if (!$enterprise) {
            return redirect()->to('/enterprise/profile')->with('error', 'Please complete your enterprise profile first.');
        }

        // Get ranking history
        $rankingHistory = $db->table('enterprise_rankings')
            ->where('enterprise_id', $enterprise['enterprise_id'])
            ->orderBy('ranking_date', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

        // Get latest ranking
        $latestRanking = $db->table('enterprise_rankings')
            ->where('enterprise_id', $enterprise['enterprise_id'])
            ->orderBy('ranking_date', 'DESC')
            ->get()
            ->getRowArray();

        $data = [
            'title' => 'My Ranking — AIIIIS',
            'page_title' => 'My Ranking',
            'breadcrumb' => 'Ranking',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'enterprise' => $enterprise,
            'latest_ranking' => $latestRanking,
            'ranking_history' => $rankingHistory
        ];

        return view('enterprise/ranking', $data);
    }
}