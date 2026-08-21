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

        $hasPermission = $this->hasPermission('dashboard_view');
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
            'hasPermission' => $hasPermission,
            'role_icon' => $this->getRoleIcon($role),
            'role_color' => $this->getRoleColor($role)
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
    // STATS FOR EACH ROLE
    // ============================================================

    private function getAdminStats()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $stats = [];

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
                $stats['pending_verifications'] = (int)$db->table('enterprises')
                    ->where('is_verified', 0)
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['pending_verifications'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to the Admin Dashboard';
        $stats['role'] = 'Administrator';
        return $stats;
    }

    private function getExpertStats($userId)
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $stats = [];

        if (in_array('enterprises', $tables)) {
            try {
                $stats['assigned_enterprises'] = (int)$db->table('enterprises')
                    ->where('assigned_expert_id', $userId)
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['assigned_enterprises'] = 0;
            }
        }

        if (in_array('advisory', $tables)) {
            try {
                $stats['pending_advisory'] = (int)$db->table('advisory')
                    ->where('assigned_to', $userId)
                    ->where('status', 'pending')
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['pending_advisory'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to the Expert Dashboard';
        $stats['role'] = 'NIRDA Expert';
        return $stats;
    }

    private function getEnterpriseStats($userId)
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $stats = [];

        // Get enterprise ID for this user
        $enterpriseId = null;
        if (in_array('enterprises', $tables)) {
            try {
                $enterprise = $db->table('enterprises')
                    ->select('enterprise_id')
                    ->where('user_id', $userId)
                    ->get()
                    ->getRowArray();
                $enterpriseId = $enterprise['enterprise_id'] ?? $enterprise['id'] ?? null;
            } catch (\Exception $e) {
                $enterpriseId = null;
            }
        }

        if ($enterpriseId && in_array('matches', $tables)) {
            try {
                $stats['matches'] = (int)$db->table('matches')
                    ->where('enterprise_id', $enterpriseId)
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['matches'] = 0;
            }
        }

        if ($enterpriseId && in_array('deals', $tables)) {
            try {
                $stats['deals'] = (int)$db->table('deals')
                    ->where('enterprise_id', $enterpriseId)
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['deals'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to your Enterprise Dashboard';
        $stats['role'] = 'Enterprise';
        return $stats;
    }

    private function getInvestorStats($userId)
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $stats = [];

        // Get investor ID for this user
        $investorId = null;
        if (in_array('investors', $tables)) {
            try {
                $investor = $db->table('investors')
                    ->select('investor_id')
                    ->where('user_id', $userId)
                    ->get()
                    ->getRowArray();
                $investorId = $investor['investor_id'] ?? $investor['id'] ?? null;
            } catch (\Exception $e) {
                $investorId = null;
            }
        }

        if ($investorId && in_array('matches', $tables)) {
            try {
                $stats['matches'] = (int)$db->table('matches')
                    ->where('investor_id', $investorId)
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['matches'] = 0;
            }
        }

        if ($investorId && in_array('deals', $tables)) {
            try {
                $stats['deals'] = (int)$db->table('deals')
                    ->where('investor_id', $investorId)
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['deals'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to your Investor Dashboard';
        $stats['role'] = 'Investor';
        return $stats;
    }

    private function getGovernmentStats()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $stats = [];

        if (in_array('enterprises', $tables)) {
            try {
                $stats['total_enterprises'] = (int)$db->table('enterprises')->countAll();
                $stats['verified_enterprises'] = (int)$db->table('enterprises')
                    ->where('is_verified', 1)
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['total_enterprises'] = 0;
                $stats['verified_enterprises'] = 0;
            }
        }

        if (in_array('investors', $tables)) {
            try {
                $stats['total_investors'] = (int)$db->table('investors')->countAll();
            } catch (\Exception $e) {
                $stats['total_investors'] = 0;
            }
        }

        $stats['welcome'] = 'Welcome to the Government Dashboard';
        $stats['role'] = 'Government';
        return $stats;
    }

    private function getAnalystStats()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $stats = [];

        if (in_array('reports', $tables)) {
            try {
                $stats['total_reports'] = (int)$db->table('reports')->countAll();
                $stats['reports_this_month'] = (int)$db->table('reports')
                    ->where('MONTH(created_at)', date('m'))
                    ->countAllResults();
            } catch (\Exception $e) {
                $stats['total_reports'] = 0;
                $stats['reports_this_month'] = 0;
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

        switch ($role) {
            case 'super_admin':
            case 'administrator':
                return [
                    'stats' => $this->getAdminStats(),
                    'recent_activity' => $this->getAdminRecentActivity(),
                    'quick_actions' => $this->getAdminQuickActions(),
                    'widgets' => $this->getAdminWidgets()
                ];
            case 'nirda_expert':
                return [
                    'stats' => $this->getExpertStats($userId),
                    'recent_activity' => $this->getExpertRecentActivity($userId),
                    'quick_actions' => $this->getExpertQuickActions(),
                    'widgets' => $this->getExpertWidgets()
                ];
            case 'enterprise':
                return [
                    'stats' => $this->getEnterpriseStats($userId),
                    'recent_activity' => $this->getEnterpriseRecentActivity($userId),
                    'quick_actions' => $this->getEnterpriseQuickActions(),
                    'widgets' => $this->getEnterpriseWidgets()
                ];
            case 'investor':
                return [
                    'stats' => $this->getInvestorStats($userId),
                    'recent_activity' => $this->getInvestorRecentActivity($userId),
                    'quick_actions' => $this->getInvestorQuickActions(),
                    'widgets' => $this->getInvestorWidgets()
                ];
            case 'government':
                return [
                    'stats' => $this->getGovernmentStats(),
                    'recent_activity' => $this->getGovernmentRecentActivity(),
                    'quick_actions' => $this->getGovernmentQuickActions(),
                    'widgets' => $this->getGovernmentWidgets()
                ];
            case 'analyst':
                return [
                    'stats' => $this->getAnalystStats(),
                    'recent_activity' => $this->getAnalystRecentActivity(),
                    'quick_actions' => $this->getAnalystQuickActions(),
                    'widgets' => $this->getAnalystWidgets()
                ];
            default:
                return [
                    'stats' => ['welcome' => 'Welcome to AIIIIS Platform'],
                    'recent_activity' => [],
                    'quick_actions' => $this->getDefaultQuickActions(),
                    'widgets' => []
                ];
        }
    }

    // ============================================================
    // RECENT ACTIVITY
    // ============================================================

    private function getAdminRecentActivity($limit = 5)
    {
        $db = \Config\Database::connect();
        $activities = [];
        $tables = $db->listTables();

        if (in_array('users', $tables)) {
            try {
                $users = $db->table('users')
                    ->select('name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit(2)
                    ->get()
                    ->getResultArray();

                foreach ($users as $user) {
                    $activities[] = [
                        'type' => 'user',
                        'message' => 'New user registered: ' . ($user['name'] ?? 'Unknown'),
                        'time' => $user['created_at'] ?? date('Y-m-d H:i:s'),
                        'icon' => 'fa-user',
                        'color' => 'primary'
                    ];
                }
            } catch (\Exception $e) {}
        }

        if (in_array('enterprises', $tables)) {
            try {
                $enterprises = $db->table('enterprises')
                    ->select('enterprise_name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit(2)
                    ->get()
                    ->getResultArray();

                foreach ($enterprises as $item) {
                    $activities[] = [
                        'type' => 'enterprise',
                        'message' => 'New enterprise: ' . ($item['enterprise_name'] ?? 'Unknown'),
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'icon' => 'fa-building',
                        'color' => 'success'
                    ];
                }
            } catch (\Exception $e) {}
        }

        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, $limit);
    }

    private function getExpertRecentActivity($userId, $limit = 5)
    {
        $db = \Config\Database::connect();
        $activities = [];

        if (in_array('advisory', $db->listTables())) {
            try {
                $advisory = $db->table('advisory')
                    ->where('assigned_to', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();

                foreach ($advisory as $item) {
                    $activities[] = [
                        'type' => 'advisory',
                        'message' => 'Advisory: ' . ($item['title'] ?? 'New request'),
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'icon' => 'fa-comment-dots',
                        'color' => 'warning'
                    ];
                }
            } catch (\Exception $e) {}
        }

        return $activities;
    }

    private function getEnterpriseRecentActivity($userId, $limit = 5)
    {
        $db = \Config\Database::connect();
        $activities = [];

        // Get enterprise ID
        $enterpriseId = null;
        if (in_array('enterprises', $db->listTables())) {
            try {
                $enterprise = $db->table('enterprises')
                    ->select('enterprise_id')
                    ->where('user_id', $userId)
                    ->get()
                    ->getRowArray();
                $enterpriseId = $enterprise['enterprise_id'] ?? $enterprise['id'] ?? null;
            } catch (\Exception $e) {}
        }

        if ($enterpriseId && in_array('matches', $db->listTables())) {
            try {
                $matches = $db->table('matches')
                    ->where('enterprise_id', $enterpriseId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();

                foreach ($matches as $item) {
                    $activities[] = [
                        'type' => 'match',
                        'message' => 'New match found',
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'icon' => 'fa-handshake',
                        'color' => 'primary'
                    ];
                }
            } catch (\Exception $e) {}
        }

        return $activities;
    }

    private function getInvestorRecentActivity($userId, $limit = 5)
    {
        $db = \Config\Database::connect();
        $activities = [];

        // Get investor ID
        $investorId = null;
        if (in_array('investors', $db->listTables())) {
            try {
                $investor = $db->table('investors')
                    ->select('investor_id')
                    ->where('user_id', $userId)
                    ->get()
                    ->getRowArray();
                $investorId = $investor['investor_id'] ?? $investor['id'] ?? null;
            } catch (\Exception $e) {}
        }

        if ($investorId && in_array('matches', $db->listTables())) {
            try {
                $matches = $db->table('matches')
                    ->where('investor_id', $investorId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();

                foreach ($matches as $item) {
                    $activities[] = [
                        'type' => 'match',
                        'message' => 'New match found',
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'icon' => 'fa-handshake',
                        'color' => 'primary'
                    ];
                }
            } catch (\Exception $e) {}
        }

        return $activities;
    }

    private function getGovernmentRecentActivity($limit = 5)
    {
        $db = \Config\Database::connect();
        $activities = [];

        if (in_array('enterprises', $db->listTables())) {
            try {
                $enterprises = $db->table('enterprises')
                    ->select('enterprise_name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();

                foreach ($enterprises as $item) {
                    $activities[] = [
                        'type' => 'enterprise',
                        'message' => 'Enterprise registered: ' . ($item['enterprise_name'] ?? 'Unknown'),
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'icon' => 'fa-building',
                        'color' => 'success'
                    ];
                }
            } catch (\Exception $e) {}
        }

        return $activities;
    }

    private function getAnalystRecentActivity($limit = 5)
    {
        $db = \Config\Database::connect();
        $activities = [];

        if (in_array('reports', $db->listTables())) {
            try {
                $reports = $db->table('reports')
                    ->select('title, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();

                foreach ($reports as $item) {
                    $activities[] = [
                        'type' => 'report',
                        'message' => 'Report generated: ' . ($item['title'] ?? 'Report'),
                        'time' => $item['created_at'] ?? date('Y-m-d H:i:s'),
                        'icon' => 'fa-file-alt',
                        'color' => 'info'
                    ];
                }
            } catch (\Exception $e) {}
        }

        return $activities;
    }

    // ============================================================
    // QUICK ACTIONS
    // ============================================================

    private function getAdminQuickActions()
    {
        $actions = [];

        if ($this->hasPermission('users_add')) {
            $actions[] = [
                'label' => 'Add User',
                'icon' => 'fa-user-plus',
                'route' => '/admin/users/create',
                'color' => 'primary'
            ];
        }

        if ($this->hasPermission('enterprises_add')) {
            $actions[] = [
                'label' => 'Add Enterprise',
                'icon' => 'fa-building',
                'route' => '/admin/enterprises/create',
                'color' => 'success'
            ];
        }

        if ($this->hasPermission('investors_add')) {
            $actions[] = [
                'label' => 'Add Investor',
                'icon' => 'fa-user-tie',
                'route' => '/admin/investors/create',
                'color' => 'purple'
            ];
        }

        if ($this->hasPermission('reports_view')) {
            $actions[] = [
                'label' => 'View Reports',
                'icon' => 'fa-chart-bar',
                'route' => '/admin/reports',
                'color' => 'teal'
            ];
        }

        return $actions;
    }

    private function getExpertQuickActions()
    {
        $actions = [];

        $actions[] = [
            'label' => 'View Enterprises',
            'icon' => 'fa-building',
            'route' => '/expert/enterprises',
            'color' => 'primary'
        ];

        if ($this->hasPermission('enterprises_verify')) {
            $actions[] = [
                'label' => 'Verify Enterprises',
                'icon' => 'fa-check-circle',
                'route' => '/expert/enterprises/verify',
                'color' => 'success'
            ];
        }

        if ($this->hasPermission('matchmaking_view')) {
            $actions[] = [
                'label' => 'Find Matches',
                'icon' => 'fa-handshake',
                'route' => '/expert/matchmaking',
                'color' => 'warning'
            ];
        }

        return $actions;
    }

    private function getEnterpriseQuickActions()
    {
        $actions = [];

        $actions[] = [
            'label' => 'View Profile',
            'icon' => 'fa-user',
            'route' => '/enterprise/profile',
            'color' => 'primary'
        ];

        $actions[] = [
            'label' => 'Browse Investors',
            'icon' => 'fa-users',
            'route' => '/enterprise/investor-database',
            'color' => 'success'
        ];

        if ($this->hasPermission('matchmaking_view')) {
            $actions[] = [
                'label' => 'Find Matches',
                'icon' => 'fa-handshake',
                'route' => '/enterprise/matched-investors',
                'color' => 'warning'
            ];
        }

        if ($this->hasPermission('advisory_add')) {
            $actions[] = [
                'label' => 'Request Advisory',
                'icon' => 'fa-comment-dots',
                'route' => '/enterprise/advisory',
                'color' => 'purple'
            ];
        }

        return $actions;
    }

    private function getInvestorQuickActions()
    {
        $actions = [];

        $actions[] = [
            'label' => 'View Profile',
            'icon' => 'fa-user',
            'route' => '/investor/profile',
            'color' => 'primary'
        ];

        if ($this->hasPermission('matchmaking_view')) {
            $actions[] = [
                'label' => 'Find Matches',
                'icon' => 'fa-handshake',
                'route' => '/investor/matches',
                'color' => 'success'
            ];
        }

        if ($this->hasPermission('deals_view')) {
            $actions[] = [
                'label' => 'View Deals',
                'icon' => 'fa-money-bill-wave',
                'route' => '/investor/deals',
                'color' => 'warning'
            ];
        }

        $actions[] = [
            'label' => 'Browse Database',
            'icon' => 'fa-database',
            'route' => '/investor/database',
            'color' => 'purple'
        ];

        return $actions;
    }

    private function getGovernmentQuickActions()
    {
        $actions = [];

        $actions[] = [
            'label' => 'View Enterprises',
            'icon' => 'fa-building',
            'route' => '/government/enterprises',
            'color' => 'primary'
        ];

        $actions[] = [
            'label' => 'View Investors',
            'icon' => 'fa-user-tie',
            'route' => '/government/investors',
            'color' => 'success'
        ];

        if ($this->hasPermission('reports_view')) {
            $actions[] = [
                'label' => 'View Reports',
                'icon' => 'fa-chart-bar',
                'route' => '/government/reports',
                'color' => 'warning'
            ];
        }

        $actions[] = [
            'label' => 'Policy Dashboard',
            'icon' => 'fa-landmark',
            'route' => '/government/policy',
            'color' => 'purple'
        ];

        return $actions;
    }

    private function getAnalystQuickActions()
    {
        $actions = [];

        if ($this->hasPermission('reports_add')) {
            $actions[] = [
                'label' => 'Generate Report',
                'icon' => 'fa-file-alt',
                'route' => '/analyst/reports/create',
                'color' => 'primary'
            ];
        }

        if ($this->hasPermission('reports_view')) {
            $actions[] = [
                'label' => 'View Reports',
                'icon' => 'fa-chart-bar',
                'route' => '/analyst/reports',
                'color' => 'success'
            ];
        }

        if ($this->hasPermission('analytics_view')) {
            $actions[] = [
                'label' => 'View Analytics',
                'icon' => 'fa-chart-line',
                'route' => '/analyst/analytics',
                'color' => 'warning'
            ];
        }

        $actions[] = [
            'label' => 'View Enterprises',
            'icon' => 'fa-building',
            'route' => '/analyst/enterprises',
            'color' => 'purple'
        ];

        return $actions;
    }

    private function getDefaultQuickActions()
    {
        return [
            [
                'label' => 'View Profile',
                'icon' => 'fa-user',
                'route' => '/profile',
                'color' => 'primary'
            ],
            [
                'label' => 'Settings',
                'icon' => 'fa-cog',
                'route' => '/settings',
                'color' => 'secondary'
            ]
        ];
    }

    // ============================================================
    // WIDGETS
    // ============================================================

    private function getAdminWidgets($limit = 3)
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $widgets = [];

        if (in_array('users', $tables) && $this->hasPermission('users_view')) {
            try {
                $users = $db->table('users')
                    ->select('name, email, role, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($users)) {
                    $widgets['recent_users'] = $users;
                }
            } catch (\Exception $e) {}
        }

        if (in_array('enterprises', $tables) && $this->hasPermission('enterprises_view')) {
            try {
                $enterprises = $db->table('enterprises')
                    ->select('enterprise_name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($enterprises)) {
                    $widgets['recent_enterprises'] = $enterprises;
                }
            } catch (\Exception $e) {}
        }

        if (in_array('enterprises', $tables) && $this->hasPermission('enterprises_verify')) {
            try {
                $pending = $db->table('enterprises')
                    ->select('enterprise_name, created_at')
                    ->where('is_verified', 0)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($pending)) {
                    $widgets['pending_verifications'] = $pending;
                }
            } catch (\Exception $e) {}
        }

        return $widgets;
    }

    private function getExpertWidgets($limit = 3)
    {
        $db = \Config\Database::connect();
        $userId = $this->currentUser['user_id'] ?? null;
        $widgets = [];

        if (in_array('advisory', $db->listTables()) && $userId) {
            try {
                $advisory = $db->table('advisory')
                    ->where('assigned_to', $userId)
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($advisory)) {
                    $widgets['pending_advisory'] = $advisory;
                }
            } catch (\Exception $e) {}
        }

        return $widgets;
    }

    private function getEnterpriseWidgets($limit = 3)
    {
        $db = \Config\Database::connect();
        $userId = $this->currentUser['user_id'] ?? null;
        $widgets = [];

        // Get enterprise ID
        $enterpriseId = null;
        if (in_array('enterprises', $db->listTables())) {
            try {
                $enterprise = $db->table('enterprises')
                    ->select('enterprise_id')
                    ->where('user_id', $userId)
                    ->get()
                    ->getRowArray();
                $enterpriseId = $enterprise['enterprise_id'] ?? $enterprise['id'] ?? null;
            } catch (\Exception $e) {}
        }

        if ($enterpriseId && in_array('matches', $db->listTables())) {
            try {
                $matches = $db->table('matches')
                    ->where('enterprise_id', $enterpriseId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($matches)) {
                    $widgets['my_matches'] = $matches;
                }
            } catch (\Exception $e) {}
        }

        if ($enterpriseId && in_array('deals', $db->listTables())) {
            try {
                $deals = $db->table('deals')
                    ->where('enterprise_id', $enterpriseId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($deals)) {
                    $widgets['my_deals'] = $deals;
                }
            } catch (\Exception $e) {}
        }

        return $widgets;
    }

    private function getInvestorWidgets($limit = 3)
    {
        $db = \Config\Database::connect();
        $userId = $this->currentUser['user_id'] ?? null;
        $widgets = [];

        // Get investor ID
        $investorId = null;
        if (in_array('investors', $db->listTables())) {
            try {
                $investor = $db->table('investors')
                    ->select('investor_id')
                    ->where('user_id', $userId)
                    ->get()
                    ->getRowArray();
                $investorId = $investor['investor_id'] ?? $investor['id'] ?? null;
            } catch (\Exception $e) {}
        }

        if ($investorId && in_array('matches', $db->listTables())) {
            try {
                $matches = $db->table('matches')
                    ->where('investor_id', $investorId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($matches)) {
                    $widgets['my_matches'] = $matches;
                }
            } catch (\Exception $e) {}
        }

        if ($investorId && in_array('deals', $db->listTables())) {
            try {
                $deals = $db->table('deals')
                    ->where('investor_id', $investorId)
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($deals)) {
                    $widgets['my_deals'] = $deals;
                }
            } catch (\Exception $e) {}
        }

        return $widgets;
    }

    private function getGovernmentWidgets($limit = 3)
    {
        $db = \Config\Database::connect();
        $widgets = [];

        if (in_array('enterprises', $db->listTables())) {
            try {
                $enterprises = $db->table('enterprises')
                    ->select('enterprise_name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($enterprises)) {
                    $widgets['recent_enterprises'] = $enterprises;
                }
            } catch (\Exception $e) {}
        }

        if (in_array('investors', $db->listTables())) {
            try {
                $investors = $db->table('investors')
                    ->select('name, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($investors)) {
                    $widgets['recent_investors'] = $investors;
                }
            } catch (\Exception $e) {}
        }

        return $widgets;
    }

    private function getAnalystWidgets($limit = 3)
    {
        $db = \Config\Database::connect();
        $widgets = [];

        if (in_array('reports', $db->listTables())) {
            try {
                $reports = $db->table('reports')
                    ->select('title, created_at')
                    ->orderBy('created_at', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
                if (!empty($reports)) {
                    $widgets['recent_reports'] = $reports;
                }
            } catch (\Exception $e) {}
        }

        return $widgets;
    }
}