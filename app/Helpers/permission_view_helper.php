<?php

/**
 * Permission View Helper Functions
 */

if (!function_exists('canShowSection')) {
    /**
     * Check if a section should be shown based on permissions
     */
    function canShowSection($permission)
    {
        return hasPermission($permission);
    }
}

if (!function_exists('getUserRoleBadge')) {
    /**
     * Get badge HTML for user role
     */
    function getUserRoleBadge($roleSlug)
    {
        $badges = [
            'super_admin' => '<span class="badge badge-danger">Super Admin</span>',
            'administrator' => '<span class="badge badge-primary">Admin</span>',
            'nirda_expert' => '<span class="badge badge-success">Expert</span>',
            'enterprise' => '<span class="badge badge-info">Enterprise</span>',
            'investor' => '<span class="badge badge-warning">Investor</span>',
            'government' => '<span class="badge badge-secondary">Government</span>',
            'analyst' => '<span class="badge badge-dark">Analyst</span>'
        ];

        return $badges[$roleSlug] ?? '<span class="badge badge-secondary">' . ucfirst($roleSlug) . '</span>';
    }
}

if (!function_exists('getPermissionIcon')) {
    /**
     * Get icon for a permission module
     */
    function getPermissionIcon($module)
    {
        $icons = [
            'system' => 'fa-cog',
            'dashboard' => 'fa-dashboard',
            'enterprise' => 'fa-building',
            'investor' => 'fa-users',
            'matchmaking' => 'fa-handshake',
            'deals' => 'fa-money',
            'advisory' => 'fa-commenting',
            'expert' => 'fa-user-md',
            'notifications' => 'fa-bell',
            'reports' => 'fa-chart-bar',
            'support' => 'fa-life-ring',
            'profile' => 'fa-user',
            'settings' => 'fa-cogs'
        ];

        return $icons[$module] ?? 'fa-cube';
    }
}