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

        // ========== RECOMMENDED ENTERPRISES (AI Match Scores) ==========
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

        // ========== DEAL PROGRESS ==========
        $dealProgress = $db->table('deals')
            ->select('deals.*, enterprises.name as enterprise_name, enterprises.sector, 
                CASE 
                    WHEN deals.status = "negotiating" THEN 25
                    WHEN deals.status = "agreed" THEN 50
                    WHEN deals.status = "signed" THEN 75
                    WHEN deals.status = "completed" THEN 100
                    ELSE 10
                END as progress_percentage')
            ->join('enterprises', 'enterprises.enterprise_id = deals.enterprise_id')
            ->where('deals.investor_id', $investorId)
            ->where('deals.status !=', 'cancelled')
            ->orderBy('deals.created_at', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

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