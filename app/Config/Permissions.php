<?php

namespace Config;

class Permissions
{
    /**
     * Default role permissions mapping
     */
    public static $defaultPermissions = [
        'super_admin' => [
            'manage_roles',
            'manage_permissions',
            'manage_users',
            'view_system_logs',
            'view_admin_dashboard',
            'view_enterprises',
            'create_enterprise',
            'edit_enterprise',
            'delete_enterprise',
            'verify_enterprise',
            'view_investors',
            'create_investor',
            'edit_investor',
            'delete_investor',
            'verify_investor',
            'view_matches',
            'create_match',
            'edit_match',
            'delete_match',
            'view_deals',
            'create_deal',
            'edit_deal',
            'delete_deal',
            'view_advisory',
            'create_advisory',
            'edit_advisory',
            'delete_advisory',
            'assign_advisory',
            'view_experts',
            'create_expert',
            'edit_expert',
            'delete_expert',
            'manage_notifications',
            'view_notifications',
            'view_reports',
            'generate_reports',
            'export_reports',
            'view_chat_history',
            'reply_to_chat',
            'manage_knowledge_base',
            'view_profile',
            'edit_profile',
            'change_password',
            'manage_settings',
            'view_settings',
            'view_expert_dashboard',
            'view_enterprise_dashboard',
            'view_investor_dashboard',
            'view_government_dashboard',
            'view_analyst_dashboard'
        ],
        'administrator' => [
            'view_admin_dashboard',
            'view_enterprises',
            'create_enterprise',
            'edit_enterprise',
            'delete_enterprise',
            'verify_enterprise',
            'view_investors',
            'create_investor',
            'edit_investor',
            'delete_investor',
            'verify_investor',
            'view_matches',
            'create_match',
            'edit_match',
            'delete_match',
            'view_deals',
            'create_deal',
            'edit_deal',
            'delete_deal',
            'view_advisory',
            'create_advisory',
            'edit_advisory',
            'delete_advisory',
            'assign_advisory',
            'view_experts',
            'create_expert',
            'edit_expert',
            'delete_expert',
            'manage_notifications',
            'view_notifications',
            'view_reports',
            'generate_reports',
            'export_reports',
            'view_chat_history',
            'reply_to_chat',
            'view_profile',
            'edit_profile',
            'change_password',
            'view_settings'
        ],
        'nirda_expert' => [
            'view_expert_dashboard',
            'view_enterprises',
            'edit_enterprise',
            'verify_enterprise',
            'view_advisory',
            'create_advisory',
            'edit_advisory',
            'assign_advisory',
            'view_notifications',
            'view_profile',
            'edit_profile',
            'change_password',
            'view_reports'
        ],
        'enterprise' => [
            'view_enterprise_dashboard',
            'view_profile',
            'edit_profile',
            'change_password',
            'view_notifications',
            'view_advisory',
            'create_advisory',
            'view_matches',
            'view_deals'
        ],
        'investor' => [
            'view_investor_dashboard',
            'view_profile',
            'edit_profile',
            'change_password',
            'view_notifications',
            'view_matches',
            'view_deals'
        ],
        'government' => [
            'view_government_dashboard',
            'view_enterprises',
            'view_investors',
            'view_reports',
            'view_notifications',
            'view_profile',
            'edit_profile',
            'change_password'
        ],
        'analyst' => [
            'view_analyst_dashboard',
            'view_reports',
            'generate_reports',
            'export_reports',
            'view_enterprises',
            'view_investors',
            'view_notifications',
            'view_profile',
            'edit_profile',
            'change_password'
        ]
    ];

    /**
     * Module definitions for UI
     */
    public static $modules = [
        'system' => [
            'label' => 'System Management',
            'icon' => 'fa-cog'
        ],
        'dashboard' => [
            'label' => 'Dashboard',
            'icon' => 'fa-dashboard'
        ],
        'enterprise' => [
            'label' => 'Enterprises',
            'icon' => 'fa-building'
        ],
        'investor' => [
            'label' => 'Investors',
            'icon' => 'fa-users'
        ],
        'matchmaking' => [
            'label' => 'Matchmaking',
            'icon' => 'fa-handshake'
        ],
        'deals' => [
            'label' => 'Deals',
            'icon' => 'fa-money'
        ],
        'advisory' => [
            'label' => 'Advisory',
            'icon' => 'fa-commenting'
        ],
        'expert' => [
            'label' => 'Experts',
            'icon' => 'fa-user-md'
        ],
        'notifications' => [
            'label' => 'Notifications',
            'icon' => 'fa-bell'
        ],
        'reports' => [
            'label' => 'Reports',
            'icon' => 'fa-chart-bar'
        ],
        'support' => [
            'label' => 'Support',
            'icon' => 'fa-life-ring'
        ],
        'profile' => [
            'label' => 'Profile',
            'icon' => 'fa-user'
        ],
        'settings' => [
            'label' => 'Settings',
            'icon' => 'fa-cogs'
        ]
    ];
}