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
        
        // Get stats
        $totalUsers = $db->table('users')->countAll();
        $totalEnterprises = $db->table('enterprises')->countAll();
        $totalInvestors = $db->table('investors')->countAll();
        $pendingVerifications = $db->table('enterprises')->where('is_verified', 0)->countAllResults();
        $totalMatches = $db->table('matches')->countAll();
        $activeDeals = $db->table('deals')->where('status !=', 'completed')->where('status !=', 'cancelled')->countAllResults();

        // Get recent users
        $recentUsers = $db->table('users')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        // Get recent enterprises
        $recentEnterprises = $db->table('enterprises')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Admin Dashboard — AIIIIS',
            'page_title' => 'Dashboard',
            'user' => [
                'name' => session()->get('name'),
                'role' => session()->get('role'),
                'email' => session()->get('email'),
                'user_id' => session()->get('user_id')
            ],
            'stats' => [
                'total_users' => $totalUsers,
                'total_enterprises' => $totalEnterprises,
                'total_investors' => $totalInvestors,
                'pending_verifications' => $pendingVerifications,
                'total_matches' => $totalMatches,
                'active_deals' => $activeDeals
            ],
            'recent_users' => $recentUsers,
            'recent_enterprises' => $recentEnterprises
        ];

        return view('admin/dashboard', $data);
    }

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

    // public function enterprises()
    // {
    //     // Check if user is logged in and is admin
    //     if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
    //         return redirect()->to('/login');
    //     }

    //     $db = \Config\Database::connect();
    //     $enterprises = $db->table('enterprises')
    //         ->orderBy('created_at', 'DESC')
    //         ->get()
    //         ->getResultArray();

    //     $data = [
    //         'title' => 'Enterprises — AIIIIS',
    //         'page_title' => 'Enterprises',
    //         'breadcrumb' => 'Enterprises',
    //         'user' => [
    //             'name' => session()->get('name'),
    //             'role' => session()->get('role'),
    //             'email' => session()->get('email'),
    //             'user_id' => session()->get('user_id')
    //         ],
    //         'enterprises' => $enterprises
    //     ];

    //     return view('admin/enterprises', $data);
    // }

    // public function investors()
    // {
    //     // Check if user is logged in and is admin
    //     if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
    //         return redirect()->to('/login');
    //     }

    //     $db = \Config\Database::connect();
    //     $investors = $db->table('investors')
    //         ->orderBy('created_at', 'DESC')
    //         ->get()
    //         ->getResultArray();

    //     $data = [
    //         'title' => 'Investors — AIIIIS',
    //         'page_title' => 'Investors',
    //         'breadcrumb' => 'Investors',
    //         'user' => [
    //             'name' => session()->get('name'),
    //             'role' => session()->get('role'),
    //             'email' => session()->get('email'),
    //             'user_id' => session()->get('user_id')
    //         ],
    //         'investors' => $investors
    //     ];

    //     return view('admin/investors', $data);
    // }

    public function matches()
    {
        // Check if user is logged in and is admin
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'administrator') {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $matches = $db->table('matches')
            ->select('matches.*, enterprises.name as enterprise_name, investors.name as investor_name')
            ->join('enterprises', 'enterprises.enterprise_id = matches.enterprise_id', 'left')
            ->join('investors', 'investors.investor_id = matches.investor_id', 'left')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

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
            'matches' => $matches
        ];

        return view('admin/matches', $data);
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
}