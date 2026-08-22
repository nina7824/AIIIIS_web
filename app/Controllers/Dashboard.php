<?php
// app/Controllers/Dashboard.php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!$this->currentUser) {
            return redirect()->to('/login');
        }

        $role = $this->currentUser['role'] ?? 'guest';
        $allowedRoles = ['super_admin', 'administrator', 'nirda_expert', 'enterprise', 'investor', 'government', 'analyst'];
        
        if (!in_array($role, $allowedRoles)) {
            return redirect()->to('/login')->with('error', 'Invalid user role.');
        }

        $dashboardData = $this->getDashboardData();

        $data = [
            'title' => 'Dashboard — AIIIIS',
            'page_title' => 'Dashboard',
            'active_page' => 'dashboard',
            'user' => $this->currentUser,
            'currentUser' => $this->currentUser,
            'userMenus' => $this->userMenus,
            'menus' => $this->userMenus,
            'isSuperAdmin' => $this->isSuperAdmin(),
            'notificationCount' => $this->getNotificationCount(),
            'themePreference' => $this->currentUser['theme_preference'] ?? 'light',
            'stats' => $dashboardData['stats'],
            'recent_activity' => $dashboardData['recent_activity'],
            'quick_actions' => $dashboardData['quick_actions'],
            'widgets' => $dashboardData['widgets'],
            'user_role' => $role,
            'role_icon' => $this->getRoleIcon($role),
            'role_color' => $this->getRoleColor($role),
            // Premium features
            'premium_stats' => $dashboardData['premium_stats'] ?? [],
            'insights' => $dashboardData['insights'] ?? [],
            'notifications' => $dashboardData['notifications'] ?? [],
            'upcoming' => $dashboardData['upcoming'] ?? [],
            'top_performers' => $dashboardData['top_performers'] ?? [],
            'recent_deals' => $dashboardData['recent_deals'] ?? [],
            'matchmaking_stats' => $dashboardData['matchmaking_stats'] ?? [],
            'growth_metrics' => $dashboardData['growth_metrics'] ?? [],
            'distribution_data' => $dashboardData['distribution_data'] ?? [],
            'top_services' => $dashboardData['top_services'] ?? [],
            'trend_data' => $dashboardData['trend_data'] ?? [],
            'security_alerts' => $dashboardData['security_alerts'] ?? [],
            'verification_stats' => $dashboardData['verification_stats'] ?? [],
            'role_specific_cards' => $dashboardData['role_specific_cards'] ?? [],
        ];

        return $this->renderAdmin('dashboard/index', $data);
    }

    public function getStats()
    {
        if (!$this->currentUser) {
            return $this->response->setJSON(['error' => 'Unauthorized'])->setStatusCode(401);
        }

        $stats = $this->getSimpleStats();
        return $this->response->setJSON($stats);
    }

    // ============================================================
    // ROLE HELPERS
    // ============================================================

    private function getRoleIcon($role)
    {
        $icons = [
            'super_admin' => 'fa-crown',
            'administrator' => 'fa-user-shield',
            'nirda_expert' => 'fa-user-md',
            'enterprise' => 'fa-building',
            'investor' => 'fa-user-tie',
            'government' => 'fa-landmark',
            'analyst' => 'fa-chart-line'
        ];
        return $icons[$role] ?? 'fa-user';
    }

    private function getRoleColor($role)
    {
        $colors = [
            'super_admin' => '#8b5cf6',
            'administrator' => '#3b82f6',
            'nirda_expert' => '#10b981',
            'enterprise' => '#f59e0b',
            'investor' => '#ef4444',
            'government' => '#6366f1',
            'analyst' => '#8b5cf6'
        ];
        return $colors[$role] ?? '#6b7280';
    }

    // ============================================================
    // ROLE-SPECIFIC CARDS
    // ============================================================

    private function getRoleSpecificCards($role, $userId = null)
    {
        $cards = [];
        $db = \Config\Database::connect();

        switch ($role) {
            case 'super_admin':
                $cards[] = [
                    'label' => 'Total Users',
                    'value' => $db->table('users')->countAll() ?? 0,
                    'icon' => 'fa-users',
                    'color' => 'primary',
                    'trend' => '+12%'
                ];
                $cards[] = [
                    'label' => 'Total Deals Value',
                    'value' => '$' . number_format($db->table('deals')->selectSum('amount')->get()->getRow()->amount ?? 0),
                    'icon' => 'fa-money-bill-wave',
                    'color' => 'success',
                    'trend' => '+8%'
                ];
                $cards[] = [
                    'label' => 'Active Matches',
                    'value' => $db->table('matches')->where('status', 'active')->countAllResults() ?? 0,
                    'icon' => 'fa-handshake',
                    'color' => 'purple',
                    'trend' => '+5%'
                ];
                $cards[] = [
                    'label' => 'System Health',
                    'value' => '98%',
                    'icon' => 'fa-heartbeat',
                    'color' => 'teal',
                    'trend' => 'Stable'
                ];
                break;

            case 'administrator':
                $cards[] = [
                    'label' => 'Active Users',
                    'value' => $db->table('users')->where('is_active', 1)->countAllResults() ?? 0,
                    'icon' => 'fa-users',
                    'color' => 'primary',
                    'trend' => '+6%'
                ];
                $cards[] = [
                    'label' => 'Pending Verifications',
                    'value' => $db->table('enterprises')->where('is_verified', 0)->countAllResults() ?? 0,
                    'icon' => 'fa-clock',
                    'color' => 'warning',
                    'trend' => '-2%'
                ];
                $cards[] = [
                    'label' => 'Total Deals',
                    'value' => $db->table('deals')->countAll() ?? 0,
                    'icon' => 'fa-file-signature',
                    'color' => 'success',
                    'trend' => '+10%'
                ];
                $cards[] = [
                    'label' => 'Reports Generated',
                    'value' => $db->table('reports')->countAll() ?? 0,
                    'icon' => 'fa-chart-bar',
                    'color' => 'purple',
                    'trend' => '+4%'
                ];
                break;

            case 'nirda_expert':
                $cards[] = [
                    'label' => 'Assigned Enterprises',
                    'value' => $db->table('enterprises')->where('assigned_expert_id', $userId)->countAllResults() ?? 0,
                    'icon' => 'fa-building',
                    'color' => 'primary',
                    'trend' => 'Active'
                ];
                $cards[] = [
                    'label' => 'Pending Advisory',
                    'value' => $db->table('advisory')->where('assigned_to', $userId)->where('status', 'pending')->countAllResults() ?? 0,
                    'icon' => 'fa-comment-dots',
                    'color' => 'warning',
                    'trend' => 'Urgent'
                ];
                $cards[] = [
                    'label' => 'Verification Rate',
                    'value' => '78%',
                    'icon' => 'fa-check-circle',
                    'color' => 'success',
                    'trend' => '+5%'
                ];
                $cards[] = [
                    'label' => 'Total Advisory',
                    'value' => $db->table('advisory')->where('assigned_to', $userId)->countAllResults() ?? 0,
                    'icon' => 'fa-lightbulb',
                    'color' => 'purple',
                    'trend' => 'Completed'
                ];
                break;

            case 'enterprise':
    $enterpriseId = $this->getEnterpriseId($userId);
    // Skip the "Enterprise" card - start with empty array
    $cards = [];
    $cards[] = [
        'label' => 'My Matches',
        'value' => $enterpriseId ? $db->table('matches')->where('enterprise_id', $enterpriseId)->countAllResults() ?? 0 : 0,
        'icon' => 'fa-handshake',
        'color' => 'primary',
        'trend' => 'New'
    ];
    $cards[] = [
        'label' => 'Active Deals',
        'value' => $enterpriseId ? $db->table('deals')->where('enterprise_id', $enterpriseId)->where('status', 'active')->countAllResults() ?? 0 : 0,
        'icon' => 'fa-file-signature',
        'color' => 'success',
        'trend' => 'In Progress'
    ];
    $cards[] = [
        'label' => 'Match Score',
        'value' => rand(65, 95) . '%',
        'icon' => 'fa-star',
        'color' => 'warning',
        'trend' => 'Good'
    ];
    $cards[] = [
        'label' => 'Profile Views',
        'value' => rand(50, 500),
        'icon' => 'fa-eye',
        'color' => 'purple',
        'trend' => '+12%'
    ];
    break;

            case 'investor':
                $investorId = $this->getInvestorId($userId);
                $cards[] = [
                    'label' => 'My Matches',
                    'value' => $investorId ? $db->table('matches')->where('investor_id', $investorId)->countAllResults() ?? 0 : 0,
                    'icon' => 'fa-handshake',
                    'color' => 'primary',
                    'trend' => 'New'
                ];
                $cards[] = [
                    'label' => 'Active Deals',
                    'value' => $investorId ? $db->table('deals')->where('investor_id', $investorId)->where('status', 'active')->countAllResults() ?? 0 : 0,
                    'icon' => 'fa-file-signature',
                    'color' => 'success',
                    'trend' => 'In Progress'
                ];
                $cards[] = [
                    'label' => 'Portfolio Value',
                    'value' => '$' . number_format(rand(50000, 5000000)),
                    'icon' => 'fa-chart-line',
                    'color' => 'warning',
                    'trend' => '+8%'
                ];
                $cards[] = [
                    'label' => 'Match Quality',
                    'value' => rand(70, 95) . '%',
                    'icon' => 'fa-check-circle',
                    'color' => 'purple',
                    'trend' => 'Excellent'
                ];
                break;

            case 'government':
                $cards[] = [
                    'label' => 'Total Enterprises',
                    'value' => $db->table('enterprises')->countAll() ?? 0,
                    'icon' => 'fa-building',
                    'color' => 'primary',
                    'trend' => '+8%'
                ];
                $cards[] = [
                    'label' => 'Verified Investors',
                    'value' => $db->table('investors')->where('is_verified', 1)->countAllResults() ?? 0,
                    'icon' => 'fa-user-tie',
                    'color' => 'success',
                    'trend' => '+6%'
                ];
                $cards[] = [
                    'label' => 'Total Investment',
                    'value' => '$' . number_format($db->table('deals')->selectSum('amount')->get()->getRow()->amount ?? 0),
                    'icon' => 'fa-money-bill-wave',
                    'color' => 'warning',
                    'trend' => '+15%'
                ];
                $cards[] = [
                    'label' => 'Policy Compliance',
                    'value' => '94%',
                    'icon' => 'fa-check-double',
                    'color' => 'purple',
                    'trend' => 'Good'
                ];
                break;

            case 'analyst':
                $cards[] = [
                    'label' => 'Total Reports',
                    'value' => $db->table('reports')->countAll() ?? 0,
                    'icon' => 'fa-chart-bar',
                    'color' => 'primary',
                    'trend' => '+10%'
                ];
                $cards[] = [
                    'label' => 'Pending Reports',
                    'value' => $db->table('reports')->where('status', 'pending')->countAllResults() ?? 0,
                    'icon' => 'fa-clock',
                    'color' => 'warning',
                    'trend' => 'Action'
                ];
                $cards[] = [
                    'label' => 'Reports This Month',
                    'value' => $db->table('reports')->where('MONTH(created_at)', date('m'))->countAllResults() ?? 0,
                    'icon' => 'fa-file-alt',
                    'color' => 'success',
                    'trend' => '+5%'
                ];
                $cards[] = [
                    'label' => 'Data Accuracy',
                    'value' => '96%',
                    'icon' => 'fa-check-circle',
                    'color' => 'purple',
                    'trend' => 'Excellent'
                ];
                break;

            default:
                $cards = [];
        }

        return $cards;
    }

    // ============================================================
    // SIMPLE STATS
    // ============================================================

    private function getSimpleStats()
    {
        $role = $this->currentUser['role'] ?? 'guest';
        $userId = $this->currentUser['user_id'] ?? null;

        switch ($role) {
            case 'super_admin':
            case 'administrator':
                return $this->getAdminStats();
            case 'nirda_expert':
                return $this->getExpertStats($userId);
            case 'enterprise':
                return $this->getEnterpriseStats($userId);
            case 'investor':
                return $this->getInvestorStats($userId);
            case 'government':
                return $this->getGovernmentStats();
            case 'analyst':
                return $this->getAnalystStats();
            default:
                return ['welcome' => 'Welcome to AIIIIS'];
        }
    }

    // ============================================================
    // ROLE-SPECIFIC STATS
    // ============================================================

   private function getAdminStats()
{
    $db = \Config\Database::connect();
    $stats = [];
    $tables = $db->listTables();

    // Keep only these 12 stats
    if (in_array('users', $tables)) {
        try {
            $stats['total_users'] = (int)$db->table('users')->countAll();
            $stats['total_enterprises'] = (int)$db->table('users')->where('role', 'enterprise')->countAllResults();
            $stats['total_investors'] = (int)$db->table('users')->where('role', 'investor')->countAllResults();
        } catch (\Exception $e) {
            $stats['total_users'] = 0;
            $stats['total_enterprises'] = 0;
            $stats['total_investors'] = 0;
        }
    }

    if (in_array('enterprises', $tables)) {
        try {
            $stats['pending_verifications'] = (int)$db->table('enterprises')->where('is_verified', 0)->countAllResults();
            $stats['verified_enterprises'] = (int)$db->table('enterprises')->where('is_verified', 1)->countAllResults();
        } catch (\Exception $e) {
            $stats['pending_verifications'] = 0;
            $stats['verified_enterprises'] = 0;
        }
    }

    if (in_array('deals', $tables)) {
        try {
            $stats['total_deals'] = (int)$db->table('deals')->countAll();
            $stats['active_deals'] = (int)$db->table('deals')->where('status', 'active')->countAllResults();
        } catch (\Exception $e) {
            $stats['total_deals'] = 0;
            $stats['active_deals'] = 0;
        }
    }

    if (in_array('matches', $tables)) {
        try {
            $stats['total_matches'] = (int)$db->table('matches')->countAll();
        } catch (\Exception $e) {
            $stats['total_matches'] = 0;
        }
    }

    if (in_array('reports', $tables)) {
        try {
            $stats['total_reports'] = (int)$db->table('reports')->countAll();
        } catch (\Exception $e) {
            $stats['total_reports'] = 0;
        }
    }

    // Remove these stats:
    // - total_experts
    // - total_enterprises_db
    // - system_health
    // - Any other unwanted stats

    $stats['welcome'] = 'Welcome to the Admin Dashboard';
    $stats['role'] = 'Administrator';
    return $stats;
}
    private function getExpertStats($userId)
    {
        $db = \Config\Database::connect();
        $stats = [];
        $tables = $db->listTables();

        if (in_array('enterprises', $tables)) {
            try {
                $stats['assigned_enterprises'] = (int)$db->table('enterprises')->where('assigned_expert_id', $userId)->countAllResults();
            } catch (\Exception $e) {
                $stats['assigned_enterprises'] = 0;
            }
        }

        if (in_array('advisory', $tables)) {
            try {
                $stats['pending_advisory'] = (int)$db->table('advisory')->where('assigned_to', $userId)->where('status', 'pending')->countAllResults();
                $stats['total_advisory'] = (int)$db->table('advisory')->where('assigned_to', $userId)->countAllResults();
            } catch (\Exception $e) {
                $stats['pending_advisory'] = 0;
                $stats['total_advisory'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to the Expert Dashboard';
        $stats['role'] = 'NIRDA Expert';
        return $stats;
    }

    private function getEnterpriseStats($userId)
    {
        $db = \Config\Database::connect();
        $stats = [];
        $tables = $db->listTables();

        $enterpriseId = null;
        if (in_array('enterprises', $tables)) {
            try {
                $enterprise = $db->table('enterprises')->select('enterprise_id, enterprise_name')->where('user_id', $userId)->get()->getRowArray();
                $enterpriseId = $enterprise['enterprise_id'] ?? $enterprise['id'] ?? null;
                $stats['enterprise_name'] = $enterprise['enterprise_name'] ?? 'My Enterprise';
            } catch (\Exception $e) {
                $enterpriseId = null;
            }
        }

        if ($enterpriseId && in_array('matches', $tables)) {
            try {
                $stats['matches'] = (int)$db->table('matches')->where('enterprise_id', $enterpriseId)->countAllResults();
            } catch (\Exception $e) {
                $stats['matches'] = 0;
            }
        }

        if ($enterpriseId && in_array('deals', $tables)) {
            try {
                $stats['deals'] = (int)$db->table('deals')->where('enterprise_id', $enterpriseId)->countAllResults();
                $stats['active_deals'] = (int)$db->table('deals')->where('enterprise_id', $enterpriseId)->where('status', 'active')->countAllResults();
            } catch (\Exception $e) {
                $stats['deals'] = 0;
                $stats['active_deals'] = 0;
            }
        }

        if (in_array('advisory', $tables)) {
            try {
                $stats['advisory_requests'] = (int)$db->table('advisory')->where('enterprise_id', $enterpriseId)->countAllResults();
                $stats['pending_advisory'] = (int)$db->table('advisory')->where('enterprise_id', $enterpriseId)->where('status', 'pending')->countAllResults();
            } catch (\Exception $e) {
                $stats['advisory_requests'] = 0;
                $stats['pending_advisory'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to your Enterprise Dashboard';
        $stats['role'] = 'Enterprise';
        return $stats;
    }

    private function getInvestorStats($userId)
    {
        $db = \Config\Database::connect();
        $stats = [];
        $tables = $db->listTables();

        $investorId = null;
        if (in_array('investors', $tables)) {
            try {
                $investor = $db->table('investors')->select('investor_id, full_name')->where('user_id', $userId)->get()->getRowArray();
                $investorId = $investor['investor_id'] ?? $investor['id'] ?? null;
                $stats['investor_name'] = $investor['full_name'] ?? 'My Profile';
            } catch (\Exception $e) {
                $investorId = null;
            }
        }

        if ($investorId && in_array('matches', $tables)) {
            try {
                $stats['matches'] = (int)$db->table('matches')->where('investor_id', $investorId)->countAllResults();
            } catch (\Exception $e) {
                $stats['matches'] = 0;
            }
        }

        if ($investorId && in_array('deals', $tables)) {
            try {
                $stats['deals'] = (int)$db->table('deals')->where('investor_id', $investorId)->countAllResults();
                $stats['active_deals'] = (int)$db->table('deals')->where('investor_id', $investorId)->where('status', 'active')->countAllResults();
            } catch (\Exception $e) {
                $stats['deals'] = 0;
                $stats['active_deals'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to your Investor Dashboard';
        $stats['role'] = 'Investor';
        return $stats;
    }

    private function getGovernmentStats()
    {
        $db = \Config\Database::connect();
        $stats = [];
        $tables = $db->listTables();

        if (in_array('enterprises', $tables)) {
            try {
                $stats['total_enterprises'] = (int)$db->table('enterprises')->countAll();
                $stats['verified_enterprises'] = (int)$db->table('enterprises')->where('is_verified', 1)->countAllResults();
                $stats['pending_enterprises'] = (int)$db->table('enterprises')->where('is_verified', 0)->countAllResults();
                $stats['total_sectors'] = (int)$db->table('enterprises')->distinct()->select('sector')->countAllResults();
            } catch (\Exception $e) {
                $stats['total_enterprises'] = 0;
                $stats['verified_enterprises'] = 0;
                $stats['pending_enterprises'] = 0;
                $stats['total_sectors'] = 0;
            }
        }

        if (in_array('investors', $tables)) {
            try {
                $stats['total_investors'] = (int)$db->table('investors')->countAll();
                $stats['verified_investors'] = (int)$db->table('investors')->where('is_verified', 1)->countAllResults();
            } catch (\Exception $e) {
                $stats['total_investors'] = 0;
                $stats['verified_investors'] = 0;
            }
        }

        if (in_array('deals', $tables)) {
            try {
                $stats['total_deals'] = (int)$db->table('deals')->countAll();
                $stats['total_investment'] = (float)$db->table('deals')->selectSum('amount')->get()->getRow()->amount ?? 0;
            } catch (\Exception $e) {
                $stats['total_deals'] = 0;
                $stats['total_investment'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to the Government Dashboard';
        $stats['role'] = 'Government';
        return $stats;
    }

    private function getAnalystStats()
    {
        $db = \Config\Database::connect();
        $stats = [];
        $tables = $db->listTables();

        if (in_array('reports', $tables)) {
            try {
                $stats['total_reports'] = (int)$db->table('reports')->countAll();
                $stats['reports_this_month'] = (int)$db->table('reports')->where('MONTH(created_at)', date('m'))->where('YEAR(created_at)', date('Y'))->countAllResults();
                $stats['reports_pending'] = (int)$db->table('reports')->where('status', 'pending')->countAllResults();
            } catch (\Exception $e) {
                $stats['total_reports'] = 0;
                $stats['reports_this_month'] = 0;
                $stats['reports_pending'] = 0;
            }
        }

        if (in_array('analytics', $tables)) {
            try {
                $stats['analytics_data'] = (int)$db->table('analytics')->countAll();
            } catch (\Exception $e) {
                $stats['analytics_data'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to the Analyst Dashboard';
        $stats['role'] = 'Analyst';
        return $stats;
    }

    // ============================================================
    // DASHBOARD DATA
    // ============================================================

    private function getDashboardData()
    {
        $role = $this->currentUser['role'] ?? 'guest';
        $userId = $this->currentUser['user_id'] ?? null;

        $commonData = [
            'distribution_data' => $this->getDistributionData(),
            'top_services' => $this->getTopServices(),
            'trend_data' => $this->getTrendData(),
            'security_alerts' => $this->getSecurityAlerts(),
            'verification_stats' => $this->getVerificationStats(),
            'role_specific_cards' => $this->getRoleSpecificCards($role, $userId),
        ];

        switch ($role) {
            case 'super_admin':
                return array_merge([
                    'stats' => $this->getAdminStats(),
                    'recent_activity' => $this->getAdminRecentActivity(),
                    'quick_actions' => $this->getSuperAdminQuickActions(),
                    'widgets' => $this->getAdminWidgets(),
                    'premium_stats' => $this->getSuperAdminPremiumStats(),
                    'insights' => $this->getSuperAdminInsights(),
                    'notifications' => $this->getAdminNotifications(),
                    'upcoming' => $this->getAdminUpcoming(),
                    'top_performers' => $this->getTopPerformers(),
                    'recent_deals' => $this->getRecentDeals(),
                    'matchmaking_stats' => $this->getMatchmakingStats(),
                    'growth_metrics' => $this->getGrowthMetrics(),
                ], $commonData);
            case 'administrator':
                return array_merge([
                    'stats' => $this->getAdminStats(),
                    'recent_activity' => $this->getAdminRecentActivity(),
                    'quick_actions' => $this->getAdminQuickActions(),
                    'widgets' => $this->getAdminWidgets(),
                    'premium_stats' => $this->getAdminPremiumStats(),
                    'insights' => $this->getAdminInsights(),
                    'notifications' => $this->getAdminNotifications(),
                    'upcoming' => $this->getAdminUpcoming(),
                    'top_performers' => $this->getTopPerformers(),
                    'recent_deals' => $this->getRecentDeals(),
                    'matchmaking_stats' => $this->getMatchmakingStats(),
                    'growth_metrics' => $this->getGrowthMetrics(),
                ], $commonData);
            case 'nirda_expert':
                return array_merge([
                    'stats' => $this->getExpertStats($userId),
                    'recent_activity' => $this->getExpertRecentActivity($userId),
                    'quick_actions' => $this->getExpertQuickActions(),
                    'widgets' => $this->getExpertWidgets(),
                    'premium_stats' => $this->getExpertPremiumStats($userId),
                    'insights' => $this->getExpertInsights($userId),
                    'notifications' => $this->getExpertNotifications($userId),
                    'upcoming' => $this->getExpertUpcoming($userId),
                ], $commonData);
            case 'enterprise':
                return array_merge([
                    'stats' => $this->getEnterpriseStats($userId),
                    'recent_activity' => $this->getEnterpriseRecentActivity($userId),
                    'quick_actions' => $this->getEnterpriseQuickActions(),
                    'widgets' => $this->getEnterpriseWidgets(),
                    'premium_stats' => $this->getEnterprisePremiumStats($userId),
                    'insights' => $this->getEnterpriseInsights($userId),
                    'notifications' => $this->getEnterpriseNotifications($userId),
                    'upcoming' => $this->getEnterpriseUpcoming($userId),
                    'top_performers' => $this->getTopPerformers(),
                    'recent_deals' => $this->getRecentDeals(),
                    'matchmaking_stats' => $this->getMatchmakingStats(),
                ], $commonData);
            case 'investor':
                return array_merge([
                    'stats' => $this->getInvestorStats($userId),
                    'recent_activity' => $this->getInvestorRecentActivity($userId),
                    'quick_actions' => $this->getInvestorQuickActions(),
                    'widgets' => $this->getInvestorWidgets(),
                    'premium_stats' => $this->getInvestorPremiumStats($userId),
                    'insights' => $this->getInvestorInsights($userId),
                    'notifications' => $this->getInvestorNotifications($userId),
                    'upcoming' => $this->getInvestorUpcoming($userId),
                    'top_performers' => $this->getTopPerformers(),
                    'recent_deals' => $this->getRecentDeals(),
                    'matchmaking_stats' => $this->getMatchmakingStats(),
                ], $commonData);
            case 'government':
                return array_merge([
                    'stats' => $this->getGovernmentStats(),
                    'recent_activity' => $this->getGovernmentRecentActivity(),
                    'quick_actions' => $this->getGovernmentQuickActions(),
                    'widgets' => $this->getGovernmentWidgets(),
                    'premium_stats' => $this->getGovernmentPremiumStats(),
                    'insights' => $this->getGovernmentInsights(),
                    'notifications' => $this->getGovernmentNotifications(),
                    'upcoming' => $this->getGovernmentUpcoming(),
                    'top_performers' => $this->getTopPerformers(),
                    'recent_deals' => $this->getRecentDeals(),
                ], $commonData);
            case 'analyst':
                return array_merge([
                    'stats' => $this->getAnalystStats(),
                    'recent_activity' => $this->getAnalystRecentActivity(),
                    'quick_actions' => $this->getAnalystQuickActions(),
                    'widgets' => $this->getAnalystWidgets(),
                    'premium_stats' => $this->getAnalystPremiumStats(),
                    'insights' => $this->getAnalystInsights(),
                    'notifications' => $this->getAnalystNotifications(),
                    'upcoming' => $this->getAnalystUpcoming(),
                ], $commonData);
            default:
                return array_merge([
                    'stats' => ['welcome' => 'Welcome to AIIIIS Platform'],
                    'recent_activity' => [],
                    'quick_actions' => $this->getDefaultQuickActions(),
                    'widgets' => [],
                    'premium_stats' => [],
                    'insights' => [],
                    'notifications' => [],
                    'upcoming' => [],
                ], $commonData);
        }
    }

   private function getSuperAdminQuickActions()
{
    $actions = [];

    // Comment out or remove the ones you don't want
    
    // if ($this->hasPermission('users_add')) {
    //     $actions[] = ['label' => 'Add User', 'icon' => 'fa-user-plus', 'route' => '/admin/users/create', 'color' => 'primary'];
    // }
    // if ($this->hasPermission('enterprises_add')) {
    //     $actions[] = ['label' => 'Add Enterprise', 'icon' => 'fa-building', 'route' => '/admin/enterprises/create', 'color' => 'success'];
    // }
    // if ($this->hasPermission('investors_add')) {
    //     $actions[] = ['label' => 'Add Investor', 'icon' => 'fa-user-tie', 'route' => '/admin/investors/create', 'color' => 'purple'];
    // }
    // if ($this->hasPermission('modules_manage')) {
    //     $actions[] = ['label' => 'Manage Modules', 'icon' => 'fa-cubes', 'route' => '/admin/modules', 'color' => 'teal'];
    // }
    // if ($this->hasPermission('permissions_manage')) {
    //     $actions[] = ['label' => 'Manage Permissions', 'icon' => 'fa-lock', 'route' => '/admin/permissions', 'color' => 'danger'];
    // }
    // if ($this->hasPermission('roles_manage')) {
    //     $actions[] = ['label' => 'Manage Roles', 'icon' => 'fa-user-shield', 'route' => '/admin/roles', 'color' => 'warning'];
    // }
    // if ($this->hasPermission('reports_view')) {
    //     $actions[] = ['label' => 'View Reports', 'icon' => 'fa-chart-bar', 'route' => '/admin/reports', 'color' => 'teal'];
    // }
    // if ($this->hasPermission('settings_manage')) {
    //     $actions[] = ['label' => 'System Settings', 'icon' => 'fa-cog', 'route' => '/admin/settings', 'color' => 'secondary'];
    // }

    return $actions;
}
    private function getAdminQuickActions()
    {
        $actions = [];

        if ($this->hasPermission('users_add')) {
            $actions[] = ['label' => 'Add User', 'icon' => 'fa-user-plus', 'route' => '/admin/users/create', 'color' => 'primary'];
        }
        if ($this->hasPermission('enterprises_add')) {
            $actions[] = ['label' => 'Add Enterprise', 'icon' => 'fa-building', 'route' => '/admin/enterprises/create', 'color' => 'success'];
        }
        if ($this->hasPermission('investors_add')) {
            $actions[] = ['label' => 'Add Investor', 'icon' => 'fa-user-tie', 'route' => '/admin/investors/create', 'color' => 'purple'];
        }
        if ($this->hasPermission('reports_view')) {
            $actions[] = ['label' => 'View Reports', 'icon' => 'fa-chart-bar', 'route' => '/admin/reports', 'color' => 'teal'];
        }
        if ($this->hasPermission('matchmaking_view')) {
            $actions[] = ['label' => 'Matchmaking', 'icon' => 'fa-handshake', 'route' => '/admin/matchmaking', 'color' => 'warning'];
        }

        return $actions;
    }

    private function getExpertQuickActions()
    {
        $actions = [];

        $actions[] = ['label' => 'View Enterprises', 'icon' => 'fa-building', 'route' => '/expert/enterprises', 'color' => 'primary'];
        
        if ($this->hasPermission('enterprises_verify')) {
            $actions[] = ['label' => 'Verify Enterprises', 'icon' => 'fa-check-circle', 'route' => '/expert/enterprises/verify', 'color' => 'success'];
        }
        if ($this->hasPermission('matchmaking_view')) {
            $actions[] = ['label' => 'Find Matches', 'icon' => 'fa-handshake', 'route' => '/expert/matchmaking', 'color' => 'warning'];
        }
        if ($this->hasPermission('reports_view')) {
            $actions[] = ['label' => 'View Reports', 'icon' => 'fa-chart-bar', 'route' => '/expert/reports', 'color' => 'teal'];
        }

        return $actions;
    }

    private function getEnterpriseQuickActions()
    {
        $actions = [];

        $actions[] = ['label' => 'View Profile', 'icon' => 'fa-user', 'route' => '/enterprise/profile', 'color' => 'primary'];
        
        if ($this->hasPermission('investors_view')) {
            $actions[] = ['label' => 'Browse Investors', 'icon' => 'fa-users', 'route' => '/enterprise/investor-database', 'color' => 'success'];
        }
        if ($this->hasPermission('matchmaking_view')) {
            $actions[] = ['label' => 'Find Matches', 'icon' => 'fa-handshake', 'route' => '/enterprise/matched-investors', 'color' => 'warning'];
        }
        if ($this->hasPermission('advisory_add')) {
            $actions[] = ['label' => 'Request Advisory', 'icon' => 'fa-comment-dots', 'route' => '/enterprise/advisory', 'color' => 'purple'];
        }
        if ($this->hasPermission('deals_view')) {
            $actions[] = ['label' => 'View Deals', 'icon' => 'fa-money-bill-wave', 'route' => '/enterprise/deals', 'color' => 'teal'];
        }
        if ($this->hasPermission('reports_view')) {
            $actions[] = ['label' => 'View Reports', 'icon' => 'fa-chart-bar', 'route' => '/enterprise/reports', 'color' => 'indigo'];
        }
        if ($this->hasPermission('services_view')) {
            $actions[] = ['label' => 'View Services', 'icon' => 'fa-concierge-bell', 'route' => '/enterprise/services', 'color' => 'orange'];
        }

        return $actions;
    }

   private function getInvestorQuickActions()
{
    $actions = [];

    // Remove View Profile - comment out or delete this line
    // $actions[] = ['label' => 'View Profile', 'icon' => 'fa-user', 'route' => '/investor/profile', 'color' => 'primary'];
    
    if ($this->hasPermission('matchmaking_view')) {
        $actions[] = ['label' => 'Find Matches', 'icon' => 'fa-handshake', 'route' => '/investor/matches', 'color' => 'success'];
    }
    if ($this->hasPermission('deals_view')) {
        $actions[] = ['label' => 'View Deals', 'icon' => 'fa-money-bill-wave', 'route' => '/investor/deals', 'color' => 'warning'];
    }
    if ($this->hasPermission('enterprises_view')) {
        $actions[] = ['label' => 'Browse Enterprises', 'icon' => 'fa-database', 'route' => '/investor/database', 'color' => 'purple'];
    }
    if ($this->hasPermission('reports_view')) {
        $actions[] = ['label' => 'View Reports', 'icon' => 'fa-chart-bar', 'route' => '/investor/reports', 'color' => 'indigo'];
    }

    return $actions;
}

    private function getGovernmentQuickActions()
    {
        $actions = [];

        $actions[] = ['label' => 'View Enterprises', 'icon' => 'fa-building', 'route' => '/government/enterprises', 'color' => 'primary'];
        $actions[] = ['label' => 'View Investors', 'icon' => 'fa-user-tie', 'route' => '/government/investors', 'color' => 'success'];
        
        if ($this->hasPermission('reports_view')) {
            $actions[] = ['label' => 'View Reports', 'icon' => 'fa-chart-bar', 'route' => '/government/reports', 'color' => 'warning'];
        }
        if ($this->hasPermission('analytics_view')) {
            $actions[] = ['label' => 'View Analytics', 'icon' => 'fa-chart-line', 'route' => '/government/analytics', 'color' => 'teal'];
        }
        $actions[] = ['label' => 'Policy Dashboard', 'icon' => 'fa-landmark', 'route' => '/government/policy', 'color' => 'purple'];

        return $actions;
    }

    private function getAnalystQuickActions()
    {
        $actions = [];

        if ($this->hasPermission('reports_add')) {
            $actions[] = ['label' => 'Generate Report', 'icon' => 'fa-file-alt', 'route' => '/analyst/reports/create', 'color' => 'primary'];
        }
        if ($this->hasPermission('reports_view')) {
            $actions[] = ['label' => 'View Reports', 'icon' => 'fa-chart-bar', 'route' => '/analyst/reports', 'color' => 'success'];
        }
        if ($this->hasPermission('analytics_view')) {
            $actions[] = ['label' => 'View Analytics', 'icon' => 'fa-chart-line', 'route' => '/analyst/analytics', 'color' => 'warning'];
        }
        $actions[] = ['label' => 'View Enterprises', 'icon' => 'fa-building', 'route' => '/analyst/enterprises', 'color' => 'purple'];

        return $actions;
    }

    private function getDefaultQuickActions()
    {
        return [
            ['label' => 'View Profile', 'icon' => 'fa-user', 'route' => '/profile', 'color' => 'primary'],
            ['label' => 'Settings', 'icon' => 'fa-cog', 'route' => '/settings', 'color' => 'secondary']
        ];
    }

    // ============================================================
    // PREMIUM STATS - ROLE SPECIFIC
    // ============================================================

    private function getSuperAdminPremiumStats()
    {
        $db = \Config\Database::connect();
        return [
            'total_deals_value' => $db->table('deals')->selectSum('amount')->get()->getRow()->amount ?? 0,
            'total_matches' => $db->table('matches')->countAll() ?? 0,
            'active_users' => $db->table('users')->where('is_active', 1)->countAllResults() ?? 0,
            'growth_rate' => '+15.2%',
            'conversion_rate' => '32.4%',
            'engagement_score' => '87%'
        ];
    }

    private function getAdminPremiumStats()
    {
        $db = \Config\Database::connect();
        return [
            'active_users' => $db->table('users')->where('is_active', 1)->countAllResults() ?? 0,
            'total_matches' => $db->table('matches')->countAll() ?? 0,
            'pending_reviews' => $db->table('enterprises')->where('is_verified', 0)->countAllResults() ?? 0,
        ];
    }

    private function getExpertPremiumStats($userId)
    {
        $db = \Config\Database::connect();
        return [
            'verification_rate' => '78%',
            'avg_rating' => '4.8',
            'total_advised' => $db->table('advisory')->where('assigned_to', $userId)->countAllResults() ?? 0,
        ];
    }

    private function getEnterprisePremiumStats($userId)
    {
        $db = \Config\Database::connect();
        $enterpriseId = $this->getEnterpriseId($userId);
        
        $advisoryCount = 0;
        try {
            $tables = $db->listTables();
            if ($enterpriseId && in_array('advisory', $tables)) {
                $advisoryCount = $db->table('advisory')->where('enterprise_id', $enterpriseId)->countAllResults();
            }
        } catch (\Exception $e) {
            $advisoryCount = 0;
        }
        
        return [
            'match_score' => rand(65, 95) . '%',
            'profile_views' => rand(50, 500),
            'deal_success_rate' => rand(40, 80) . '%',
            'investor_interest' => rand(10, 50),
            'advisory_sessions' => $advisoryCount,
        ];
    }

    private function getInvestorPremiumStats($userId)
    {
        $db = \Config\Database::connect();
        $investorId = $this->getInvestorId($userId);
        return [
            'investment_portfolio' => '$' . number_format(rand(50000, 5000000)),
            'roi' => rand(8, 25) . '%',
            'active_deals' => $db->table('deals')->where('investor_id', $investorId)->where('status', 'active')->countAllResults() ?? 0,
            'match_quality' => rand(70, 95) . '%',
        ];
    }

    private function getGovernmentPremiumStats()
    {
        $db = \Config\Database::connect();
        return [
            'total_investment' => $db->table('deals')->selectSum('amount')->get()->getRow()->amount ?? 0,
            'job_creation' => rand(1000, 5000),
            'sector_growth' => '+12.3%',
            'policy_compliance' => '94%',
            'investment_trend' => rand(10, 30) . '%'
        ];
    }

    private function getAnalystPremiumStats()
    {
        $db = \Config\Database::connect();
        return [
            'data_accuracy' => '96%',
            'reports_generated' => $db->table('reports')->countAll() ?? 0,
            'insights_discovered' => rand(50, 200),
            'prediction_accuracy' => rand(70, 90) . '%'
        ];
    }

    // ============================================================
    // INSIGHTS
    // ============================================================

    private function getSuperAdminInsights()
    {
        return [
            ['title' => 'User growth increased by 15% this month', 'type' => 'positive'],
            ['title' => 'Enterprise verification rate dropped by 5%', 'type' => 'negative'],
            ['title' => 'Matchmaking success rate at an all-time high', 'type' => 'positive'],
        ];
    }

    private function getAdminInsights()
    {
        return [
            ['title' => 'Active users up by 12%', 'type' => 'positive'],
            ['title' => 'Pending verifications need attention', 'type' => 'warning'],
        ];
    }

    private function getExpertInsights($userId)
    {
        return [
            ['title' => 'You have 5 pending advisory requests', 'type' => 'warning'],
            ['title' => 'Your verification rate is 78%', 'type' => 'positive'],
        ];
    }

    private function getEnterpriseInsights($userId)
    {
        $matchScore = rand(65, 95);
        return [
            ['title' => 'Your match score is ' . $matchScore . '%', 'type' => $matchScore > 80 ? 'positive' : 'warning'],
            ['title' => 'New investor matches available', 'type' => 'positive'],
        ];
    }

    private function getInvestorInsights($userId)
    {
        $matchQuality = rand(70, 95);
        return [
            ['title' => 'Match quality is ' . $matchQuality . '%', 'type' => $matchQuality > 85 ? 'positive' : 'warning'],
            ['title' => 'New deals available in your sector', 'type' => 'positive'],
        ];
    }

    private function getGovernmentInsights()
    {
        return [
            ['title' => 'Investment in agriculture sector up by 8%', 'type' => 'positive'],
            ['title' => 'Enterprise registration trending upward', 'type' => 'positive'],
        ];
    }

    private function getAnalystInsights()
    {
        return [
            ['title' => 'New data trends identified in Q3', 'type' => 'positive'],
            ['title' => '5 reports pending review', 'type' => 'warning'],
        ];
    }

    // ============================================================
    // NOTIFICATIONS
    // ============================================================

    private function getAdminNotifications()
    {
        $db = \Config\Database::connect();
        $notifications = [];
        
        try {
            $pending = $db->table('enterprises')->where('is_verified', 0)->countAllResults();
            if ($pending > 0) {
                $notifications[] = ['title' => $pending . ' enterprises pending verification', 'time' => 'Now', 'type' => 'warning'];
            }
        } catch (\Exception $e) {}
        
        if (empty($notifications)) {
            $notifications[] = ['title' => 'All systems operational', 'time' => 'Now', 'type' => 'success'];
        }
        
        return $notifications;
    }

    private function getExpertNotifications($userId)
    {
        $db = \Config\Database::connect();
        $notifications = [];
        
        try {
            $pending = $db->table('advisory')->where('assigned_to', $userId)->where('status', 'pending')->countAllResults();
            if ($pending > 0) {
                $notifications[] = ['title' => $pending . ' advisory requests pending', 'time' => 'Now', 'type' => 'warning'];
            }
        } catch (\Exception $e) {}
        
        if (empty($notifications)) {
            $notifications[] = ['title' => 'No pending advisory requests', 'time' => 'Now', 'type' => 'success'];
        }
        
        return $notifications;
    }

    private function getEnterpriseNotifications($userId)
    {
        $db = \Config\Database::connect();
        $notifications = [];
        
        try {
            $enterpriseId = $this->getEnterpriseId($userId);
            $matches = $db->table('matches')->where('enterprise_id', $enterpriseId)->countAllResults();
            if ($matches > 0) {
                $notifications[] = ['title' => $matches . ' new matches found', 'time' => 'Now', 'type' => 'success'];
            }
        } catch (\Exception $e) {}
        
        if (empty($notifications)) {
            $notifications[] = ['title' => 'No new notifications', 'time' => 'Now', 'type' => 'info'];
        }
        
        return $notifications;
    }

    private function getInvestorNotifications($userId)
    {
        $db = \Config\Database::connect();
        $notifications = [];
        
        try {
            $investorId = $this->getInvestorId($userId);
            $matches = $db->table('matches')->where('investor_id', $investorId)->countAllResults();
            if ($matches > 0) {
                $notifications[] = ['title' => $matches . ' new matches found', 'time' => 'Now', 'type' => 'success'];
            }
        } catch (\Exception $e) {}
        
        if (empty($notifications)) {
            $notifications[] = ['title' => 'No new notifications', 'time' => 'Now', 'type' => 'info'];
        }
        
        return $notifications;
    }

    private function getGovernmentNotifications()
    {
        $db = \Config\Database::connect();
        $notifications = [];
        
        try {
            $pending = $db->table('enterprises')->where('is_verified', 0)->countAllResults();
            if ($pending > 0) {
                $notifications[] = ['title' => $pending . ' enterprises pending verification', 'time' => 'Now', 'type' => 'warning'];
            }
        } catch (\Exception $e) {}
        
        if (empty($notifications)) {
            $notifications[] = ['title' => 'All systems operational', 'time' => 'Now', 'type' => 'success'];
        }
        
        return $notifications;
    }

    private function getAnalystNotifications()
    {
        $db = \Config\Database::connect();
        $notifications = [];
        
        try {
            $pending = $db->table('reports')->where('status', 'pending')->countAllResults();
            if ($pending > 0) {
                $notifications[] = ['title' => $pending . ' reports pending review', 'time' => 'Now', 'type' => 'warning'];
            }
        } catch (\Exception $e) {}
        
        if (empty($notifications)) {
            $notifications[] = ['title' => 'No pending reports', 'time' => 'Now', 'type' => 'success'];
        }
        
        return $notifications;
    }

    // ============================================================
    // UPCOMING EVENTS
    // ============================================================

    private function getAdminUpcoming()
    {
        return [
            ['title' => 'Weekly review meeting', 'date' => date('M d, Y', strtotime('+2 days'))],
            ['title' => 'Monthly report due', 'date' => date('M d, Y', strtotime('+5 days'))],
            ['title' => 'System maintenance', 'date' => date('M d, Y', strtotime('+7 days'))],
        ];
    }

    private function getExpertUpcoming($userId)
    {
        return [
            ['title' => 'Enterprise verification review', 'date' => date('M d, Y', strtotime('+1 days'))],
            ['title' => 'Advisory session scheduled', 'date' => date('M d, Y', strtotime('+3 days'))],
        ];
    }

    private function getEnterpriseUpcoming($userId)
    {
        return [
            ['title' => 'Investor match call', 'date' => date('M d, Y', strtotime('+2 days'))],
            ['title' => 'Advisory session', 'date' => date('M d, Y', strtotime('+4 days'))],
        ];
    }

    private function getInvestorUpcoming($userId)
    {
        return [
            ['title' => 'Deal review meeting', 'date' => date('M d, Y', strtotime('+1 days'))],
            ['title' => 'Matchmaking session', 'date' => date('M d, Y', strtotime('+3 days'))],
        ];
    }

    private function getGovernmentUpcoming()
    {
        return [
            ['title' => 'Policy review committee', 'date' => date('M d, Y', strtotime('+3 days'))],
            ['title' => 'Investment summit planning', 'date' => date('M d, Y', strtotime('+7 days'))],
        ];
    }

    private function getAnalystUpcoming()
    {
        return [
            ['title' => 'Quarterly report deadline', 'date' => date('M d, Y', strtotime('+5 days'))],
            ['title' => 'Data review session', 'date' => date('M d, Y', strtotime('+2 days'))],
        ];
    }

    // ============================================================
    // DASHBOARD DATA METHODS
    // ============================================================

    private function getDistributionData()
    {
        $db = \Config\Database::connect();
        $data = [];
        $colors = ['blue', 'green', 'purple', 'orange'];
        $icons = ['fa-building', 'fa-factory', 'fa-store', 'fa-warehouse'];
        $fallback = ['Agriculture', 'Manufacturing', 'Technology', 'Services'];
        
        try {
            $tables = $db->listTables();
            if (in_array('enterprises', $tables)) {
                $results = $db->table('enterprises')
                    ->select('sector, COUNT(*) as count')
                    ->where('sector IS NOT NULL')
                    ->groupBy('sector')
                    ->orderBy('count', 'DESC')
                    ->limit(4)
                    ->get()
                    ->getResultArray();
                
                if (!empty($results)) {
                    foreach ($results as $i => $item) {
                        $data[] = [
                            'name' => $item['sector'] ?? 'Other',
                            'sub' => 'Enterprises',
                            'value' => (int)$item['count'],
                            'color' => $colors[$i % count($colors)],
                            'icon' => $icons[$i % count($icons)]
                        ];
                    }
                    return $data;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting distribution data: ' . $e->getMessage());
        }
        
        foreach ($fallback as $i => $name) {
            $data[] = [
                'name' => $name,
                'sub' => 'Enterprises',
                'value' => rand(5, 25),
                'color' => $colors[$i % count($colors)],
                'icon' => $icons[$i % count($icons)]
            ];
        }
        
        return $data;
    }

    private function getTopServices()
    {
        $db = \Config\Database::connect();
        $data = [];
        $colors = ['purple', 'teal', 'orange', 'blue'];
        $icons = ['fa-concierge-bell', 'fa-tools', 'fa-chart-line', 'fa-handshake'];
        $fallback = ['Consulting', 'Training', 'Mentorship', 'Networking'];
        
        try {
            $tables = $db->listTables();
            if (in_array('services', $tables)) {
                $results = $db->table('services')
                    ->select('name, COUNT(*) as count')
                    ->where('name IS NOT NULL')
                    ->groupBy('name')
                    ->orderBy('count', 'DESC')
                    ->limit(4)
                    ->get()
                    ->getResultArray();
                
                if (!empty($results)) {
                    foreach ($results as $i => $item) {
                        $data[] = [
                            'name' => $item['name'] ?? 'Service',
                            'sub' => 'Active',
                            'value' => (int)$item['count'],
                            'color' => $colors[$i % count($colors)],
                            'icon' => $icons[$i % count($icons)]
                        ];
                    }
                    return $data;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting top services: ' . $e->getMessage());
        }
        
        foreach ($fallback as $i => $name) {
            $data[] = [
                'name' => $name,
                'sub' => 'Active',
                'value' => rand(3, 15),
                'color' => $colors[$i % count($colors)],
                'icon' => $icons[$i % count($icons)]
            ];
        }
        
        return $data;
    }

    private function getTrendData()
    {
        $data = [];
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $colors = ['#3b82f6', '#22c55e', '#8b5cf6', '#f59e0b', '#ef4444', '#06b6d4'];
        
        try {
            $db = \Config\Database::connect();
            $tables = $db->listTables();
            
            if (in_array('users', $tables)) {
                for ($i = 5; $i >= 0; $i--) {
                    $month = date('M', strtotime("-$i months"));
                    $date = date('Y-m', strtotime("-$i months"));
                    $count = $db->table('users')
                        ->where('DATE_FORMAT(created_at, "%Y-%m")', $date)
                        ->countAllResults();
                    
                    $data[] = [
                        'label' => $month,
                        'value' => $count > 0 ? $count : rand(1, 10),
                        'color' => $colors[$i % count($colors)]
                    ];
                }
                return $data;
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting trend data: ' . $e->getMessage());
        }
        
        foreach ($months as $i => $month) {
            $data[] = [
                'label' => $month,
                'value' => rand(2, 15),
                'color' => $colors[$i % count($colors)]
            ];
        }
        
        return $data;
    }

    private function getSecurityAlerts()
    {
        $db = \Config\Database::connect();
        $alerts = [];
        
        try {
            $tables = $db->listTables();
            
            if (in_array('enterprises', $tables)) {
                $pending = $db->table('enterprises')->where('is_verified', 0)->countAllResults();
                if ($pending > 0) {
                    $alerts[] = [
                        'title' => $pending . ' enterprises pending verification',
                        'time' => 'Requires action',
                        'status' => 'Pending'
                    ];
                }
            }
            
            if (in_array('investors', $tables)) {
                $pendingInv = $db->table('investors')->where('is_verified', 0)->countAllResults();
                if ($pendingInv > 0) {
                    $alerts[] = [
                        'title' => $pendingInv . ' investors pending verification',
                        'time' => 'Requires action',
                        'status' => 'Pending'
                    ];
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting security alerts: ' . $e->getMessage());
        }
        
        if (empty($alerts)) {
            $alerts[] = [
                'title' => 'All systems operational',
                'time' => 'No issues detected',
                'status' => 'OK'
            ];
        }
        
        return $alerts;
    }

    private function getVerificationStats()
    {
        $db = \Config\Database::connect();
        $stats = ['verified' => 0, 'pending' => 0];
        
        try {
            $tables = $db->listTables();
            if (in_array('enterprises', $tables)) {
                $stats['verified'] = (int)$db->table('enterprises')->where('is_verified', 1)->countAllResults();
                $stats['pending'] = (int)$db->table('enterprises')->where('is_verified', 0)->countAllResults();
            }
            
            if ($stats['verified'] == 0 && $stats['pending'] == 0) {
                $stats['verified'] = rand(5, 20);
                $stats['pending'] = rand(1, 5);
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting verification stats: ' . $e->getMessage());
            $stats['verified'] = rand(5, 20);
            $stats['pending'] = rand(1, 5);
        }
        
        return $stats;
    }

    private function getTopPerformers()
    {
        $db = \Config\Database::connect();
        $data = [];
        
        try {
            $tables = $db->listTables();
            if (in_array('enterprises', $tables)) {
                $results = $db->table('enterprises')
                    ->select('enterprise_name, rating, created_at')
                    ->where('is_verified', 1)
                    ->orderBy('rating', 'DESC')
                    ->limit(5)
                    ->get()
                    ->getResultArray();
                
                if (!empty($results)) {
                    foreach ($results as $item) {
                        $data[] = [
                            'name' => $item['enterprise_name'] ?? 'Enterprise',
                            'rating' => $item['rating'] ?? rand(3, 5),
                            'date' => $item['created_at'] ?? date('Y-m-d')
                        ];
                    }
                    return $data;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting top performers: ' . $e->getMessage());
        }
        
        $fallback = ['AgroTech Ltd', 'Green Energy Corp', 'InnovateHub', 'SmartAgri', 'EcoSolutions'];
        foreach ($fallback as $name) {
            $data[] = [
                'name' => $name,
                'rating' => rand(3, 5),
                'date' => date('Y-m-d', strtotime('-' . rand(1, 30) . ' days'))
            ];
        }
        
        return $data;
    }

    private function getRecentDeals()
    {
        $db = \Config\Database::connect();
        $data = [];
        
        try {
            $tables = $db->listTables();
            if (in_array('deals', $tables)) {
                $results = $db->table('deals')
                    ->select('title, amount, status, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit(5)
                    ->get()
                    ->getResultArray();
                
                if (!empty($results)) {
                    foreach ($results as $item) {
                        $data[] = [
                            'title' => $item['title'] ?? 'Deal',
                            'amount' => $item['amount'] ?? rand(10000, 500000),
                            'status' => $item['status'] ?? 'active',
                            'date' => $item['created_at'] ?? date('Y-m-d')
                        ];
                    }
                    return $data;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting recent deals: ' . $e->getMessage());
        }
        
        $fallback = ['Investment Round A', 'Seed Funding', 'Series B', 'Partnership Deal', 'Acquisition'];
        $statuses = ['active', 'completed', 'pending', 'negotiating'];
        foreach ($fallback as $title) {
            $data[] = [
                'title' => $title,
                'amount' => rand(10000, 500000),
                'status' => $statuses[array_rand($statuses)],
                'date' => date('Y-m-d', strtotime('-' . rand(1, 30) . ' days'))
            ];
        }
        
        return $data;
    }

    private function getMatchmakingStats()
    {
        $db = \Config\Database::connect();
        
        try {
            $tables = $db->listTables();
            if (in_array('matches', $tables)) {
                $total = $db->table('matches')->countAll();
                $active = $db->table('matches')->where('status', 'active')->countAllResults();
                $completed = $db->table('matches')->where('status', 'completed')->countAllResults();
                
                return [
                    'total' => $total,
                    'active' => $active,
                    'completed' => $completed,
                    'success_rate' => $total > 0 ? round(($completed / $total) * 100) : 0
                ];
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting matchmaking stats: ' . $e->getMessage());
        }
        
        return [
            'total' => rand(20, 100),
            'active' => rand(10, 40),
            'completed' => rand(5, 30),
            'success_rate' => rand(40, 85)
        ];
    }

    private function getGrowthMetrics()
    {
        return [
            'monthly' => '+12.5%',
            'quarterly' => '+8.3%',
            'yearly' => '+24.7%',
            'projected' => '+18.0%'
        ];
    }

    // ============================================================
    // HELPER METHODS
    // ============================================================

    private function getEnterpriseId($userId)
    {
        $db = \Config\Database::connect();
        try {
            $tables = $db->listTables();
            if (!in_array('enterprises', $tables)) {
                return null;
            }
            
            $result = $db->table('enterprises')
                ->select('enterprise_id')
                ->where('user_id', $userId)
                ->get()
                ->getRowArray();
            return $result['enterprise_id'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function getInvestorId($userId)
    {
        $db = \Config\Database::connect();
        try {
            $tables = $db->listTables();
            if (!in_array('investors', $tables)) {
                return null;
            }
            
            $result = $db->table('investors')
                ->select('investor_id')
                ->where('user_id', $userId)
                ->get()
                ->getRowArray();
            return $result['investor_id'] ?? null;
        } catch (\Exception $e) {
            return null;
        }
    }

    // ============================================================
    // RECENT ACTIVITY METHODS
    // ============================================================

    private function getAdminRecentActivity($limit = 5)
    {
        $activities = [];
        $db = \Config\Database::connect();
        
        try {
            $tables = $db->listTables();
            if (in_array('users', $tables)) {
                $users = $db->table('users')
                    ->select('name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit(3)
                    ->get()
                    ->getResultArray();
                
                foreach ($users as $user) {
                    $activities[] = [
                        'message' => 'New user registered: ' . ($user['name'] ?? 'Unknown'),
                        'time' => $user['created_at'] ?? date('Y-m-d H:i:s'),
                        'type' => 'user'
                    ];
                }
            }
        } catch (\Exception $e) {}
        
        if (empty($activities)) {
            $activities[] = [
                'message' => 'Welcome to your dashboard',
                'time' => date('Y-m-d H:i:s'),
                'type' => 'info'
            ];
        }
        
        return array_slice($activities, 0, $limit);
    }

    private function getExpertRecentActivity($userId, $limit = 5)
    {
        $activities = [];
        $db = \Config\Database::connect();
        
        try {
            $tables = $db->listTables();
            if (in_array('advisory', $tables)) {
                $advisory = $db->table('advisory')
                    ->where('assigned_to', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->limit(3)
                    ->get()
                    ->getResultArray();
                
                foreach ($advisory as $item) {
                    $activities[] = [
                        'message' => 'Advisory request: ' . ($item['title'] ?? 'New request'),
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'type' => 'advisory'
                    ];
                }
            }
        } catch (\Exception $e) {}
        
        if (empty($activities)) {
            $activities[] = [
                'message' => 'No recent advisory activity',
                'time' => date('Y-m-d H:i:s'),
                'type' => 'info'
            ];
        }
        
        return array_slice($activities, 0, $limit);
    }

    private function getEnterpriseRecentActivity($userId, $limit = 5)
    {
        $activities = [];
        $db = \Config\Database::connect();
        $enterpriseId = $this->getEnterpriseId($userId);
        
        try {
            $tables = $db->listTables();
            if ($enterpriseId && in_array('matches', $tables)) {
                $matches = $db->table('matches')
                    ->where('enterprise_id', $enterpriseId)
                    ->orderBy('created_at', 'DESC')
                    ->limit(3)
                    ->get()
                    ->getResultArray();
                
                foreach ($matches as $item) {
                    $activities[] = [
                        'message' => 'New match found',
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'type' => 'match'
                    ];
                }
            }
        } catch (\Exception $e) {}
        
        if (empty($activities)) {
            $activities[] = [
                'message' => 'Welcome to your Enterprise dashboard',
                'time' => date('Y-m-d H:i:s'),
                'type' => 'info'
            ];
        }
        
        return array_slice($activities, 0, $limit);
    }

    private function getInvestorRecentActivity($userId, $limit = 5)
    {
        $activities = [];
        $db = \Config\Database::connect();
        $investorId = $this->getInvestorId($userId);
        
        try {
            $tables = $db->listTables();
            if ($investorId && in_array('matches', $tables)) {
                $matches = $db->table('matches')
                    ->where('investor_id', $investorId)
                    ->orderBy('created_at', 'DESC')
                    ->limit(3)
                    ->get()
                    ->getResultArray();
                
                foreach ($matches as $item) {
                    $activities[] = [
                        'message' => 'New match found',
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'type' => 'match'
                    ];
                }
            }
        } catch (\Exception $e) {}
        
        if (empty($activities)) {
            $activities[] = [
                'message' => 'Welcome to your Investor dashboard',
                'time' => date('Y-m-d H:i:s'),
                'type' => 'info'
            ];
        }
        
        return array_slice($activities, 0, $limit);
    }

    private function getGovernmentRecentActivity($limit = 5)
    {
        $activities = [];
        $db = \Config\Database::connect();
        
        try {
            $tables = $db->listTables();
            if (in_array('enterprises', $tables)) {
                $enterprises = $db->table('enterprises')
                    ->select('enterprise_name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit(3)
                    ->get()
                    ->getResultArray();
                
                foreach ($enterprises as $item) {
                    $activities[] = [
                        'message' => 'Enterprise registered: ' . ($item['enterprise_name'] ?? 'Unknown'),
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'type' => 'enterprise'
                    ];
                }
            }
        } catch (\Exception $e) {}
        
        if (empty($activities)) {
            $activities[] = [
                'message' => 'Welcome to Government dashboard',
                'time' => date('Y-m-d H:i:s'),
                'type' => 'info'
            ];
        }
        
        return array_slice($activities, 0, $limit);
    }

    private function getAnalystRecentActivity($limit = 5)
    {
        $activities = [];
        $db = \Config\Database::connect();
        
        try {
            $tables = $db->listTables();
            if (in_array('reports', $tables)) {
                $reports = $db->table('reports')
                    ->select('title, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit(3)
                    ->get()
                    ->getResultArray();
                
                foreach ($reports as $item) {
                    $activities[] = [
                        'message' => 'Report generated: ' . ($item['title'] ?? 'Report'),
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'type' => 'report'
                    ];
                }
            }
        } catch (\Exception $e) {}
        
        if (empty($activities)) {
            $activities[] = [
                'message' => 'Welcome to Analyst dashboard',
                'time' => date('Y-m-d H:i:s'),
                'type' => 'info'
            ];
        }
        
        return array_slice($activities, 0, $limit);
    }

    // ============================================================
    // WIDGETS
    // ============================================================

    private function getAdminWidgets($limit = 5)
    {
        $db = \Config\Database::connect();
        $widgets = [];
        
        try {
            $tables = $db->listTables();
            if (in_array('users', $tables)) {
                $users = $db->table('users')
                    ->select('name, email, role, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($users)) {
                    $widgets['recent_users'] = $users;
                }
            }
            
            if (in_array('enterprises', $tables)) {
                $enterprises = $db->table('enterprises')
                    ->select('enterprise_name, created_at, is_verified')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($enterprises)) {
                    $widgets['recent_enterprises'] = $enterprises;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting widgets: ' . $e->getMessage());
        }
        
        return $widgets;
    }

    private function getExpertWidgets($limit = 5)
    {
        $db = \Config\Database::connect();
        $widgets = [];
        
        try {
            $tables = $db->listTables();
            if (in_array('advisory', $tables)) {
                $advisory = $db->table('advisory')
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($advisory)) {
                    $widgets['pending_advisory'] = $advisory;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting expert widgets: ' . $e->getMessage());
        }
        
        return $widgets;
    }

    private function getEnterpriseWidgets($limit = 5)
    {
        $db = \Config\Database::connect();
        $widgets = [];
        $enterpriseId = $this->getEnterpriseId($this->currentUser['user_id'] ?? null);
        
        try {
            $tables = $db->listTables();
            if ($enterpriseId && in_array('matches', $tables)) {
                $matches = $db->table('matches')
                    ->where('enterprise_id', $enterpriseId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($matches)) {
                    $widgets['my_matches'] = $matches;
                }
            }
            
            if ($enterpriseId && in_array('deals', $tables)) {
                $deals = $db->table('deals')
                    ->where('enterprise_id', $enterpriseId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($deals)) {
                    $widgets['my_deals'] = $deals;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting enterprise widgets: ' . $e->getMessage());
        }
        
        return $widgets;
    }

    private function getInvestorWidgets($limit = 5)
    {
        $db = \Config\Database::connect();
        $widgets = [];
        $investorId = $this->getInvestorId($this->currentUser['user_id'] ?? null);
        
        try {
            $tables = $db->listTables();
            if ($investorId && in_array('matches', $tables)) {
                $matches = $db->table('matches')
                    ->where('investor_id', $investorId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($matches)) {
                    $widgets['my_matches'] = $matches;
                }
            }
            
            if ($investorId && in_array('deals', $tables)) {
                $deals = $db->table('deals')
                    ->where('investor_id', $investorId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($deals)) {
                    $widgets['my_deals'] = $deals;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting investor widgets: ' . $e->getMessage());
        }
        
        return $widgets;
    }

    private function getGovernmentWidgets($limit = 5)
    {
        $db = \Config\Database::connect();
        $widgets = [];
        
        try {
            $tables = $db->listTables();
            if (in_array('enterprises', $tables)) {
                $enterprises = $db->table('enterprises')
                    ->select('enterprise_name, created_at, is_verified')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($enterprises)) {
                    $widgets['recent_enterprises'] = $enterprises;
                }
            }
            
            if (in_array('investors', $tables)) {
                $investors = $db->table('investors')
                    ->select('full_name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($investors)) {
                    $widgets['recent_investors'] = $investors;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting government widgets: ' . $e->getMessage());
        }
        
        return $widgets;
    }

    private function getAnalystWidgets($limit = 5)
    {
        $db = \Config\Database::connect();
        $widgets = [];
        
        try {
            $tables = $db->listTables();
            if (in_array('reports', $tables)) {
                $reports = $db->table('reports')
                    ->select('title, created_at, status')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                
                if (!empty($reports)) {
                    $widgets['recent_reports'] = $reports;
                }
            }
        } catch (\Exception $e) {
            log_message('error', 'Error getting analyst widgets: ' . $e->getMessage());
        }
        
        return $widgets;
    }

    // ============================================================
    // NOTIFICATION COUNT
    // ============================================================

    protected function getNotificationCount()
    {
        $db = \Config\Database::connect();
        $count = 0;
        
        try {
            $tables = $db->listTables();
            if (in_array('enterprises', $tables)) {
                $count += $db->table('enterprises')->where('is_verified', 0)->countAllResults();
            }
            if (in_array('advisory', $tables)) {
                $count += $db->table('advisory')->where('status', 'pending')->countAllResults();
            }
        } catch (\Exception $e) {
            $count = 0;
        }
        
        return $count > 0 ? $count : 0;
    }
}