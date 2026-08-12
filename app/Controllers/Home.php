<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'AIIIIS — Industrial Innovation & Investment Intelligence System',
            'active_page' => 'dashboard',
            'meta_description' => 'Enterprise mapping, investment matchmaking, and industrial intelligence for Rwanda\'s industrial development.'
        ];
        
        return view('home', $data);
    }
    
    /**
     * Service page with chat functionality
     */
    public function service($serviceId = null)
    {
        // Define all available services
        $services = [
            'operations-followup' => [
                'id' => 'operations-followup',
                'icon' => 'fa-tasks',
                'title' => 'Operations Follow-up',
                'description' => 'Get dedicated operational monitoring and support to ensure your industrial processes run smoothly and efficiently.',
                'badge' => 'Operational Excellence',
                'features' => [
                    'Daily operations monitoring and reporting',
                    'Performance optimization recommendations',
                    'Process improvement tracking',
                    'Quality control support'
                ],
                'chat_title' => 'Operations Support Chat',
                'chat_placeholder' => 'Describe your operational challenge...'
            ],
            'business-advisor' => [
                'id' => 'business-advisor',
                'icon' => 'fa-user-tie',
                'title' => 'Business Advisor',
                'description' => 'Receive expert business advisory services to help you make informed decisions and grow your enterprise strategically.',
                'badge' => 'Strategic Growth',
                'features' => [
                    'Strategic business planning assistance',
                    'Market analysis and insights',
                    'Financial planning support',
                    'Business model optimization'
                ],
                'chat_title' => 'Business Advisory Chat',
                'chat_placeholder' => 'What business challenges can we help with?'
            ],
            'technical-support' => [
                'id' => 'technical-support',
                'icon' => 'fa-microchip',
                'title' => 'Technical Support',
                'description' => 'Access specialized technical support for your industrial machinery, systems, and technology infrastructure.',
                'badge' => 'Technical Excellence',
                'features' => [
                    'Technical troubleshooting and repair',
                    'Equipment maintenance guidance',
                    'Technology upgrade advisory',
                    'Training and skill development'
                ],
                'chat_title' => 'Technical Support Chat',
                'chat_placeholder' => 'Describe your technical issue...'
            ],
            'rd-services' => [
                'id' => 'rd-services',
                'icon' => 'fa-flask',
                'title' => 'R&D & Life Lab Services',
                'description' => 'Leverage our state-of-the-art R&D facilities and Life Lab services to drive innovation and product development.',
                'badge' => 'Innovation Hub',
                'features' => [
                    'Access to laboratory facilities',
                    'Product development support',
                    'Testing and certification services',
                    'Research partnership opportunities'
                ],
                'chat_title' => 'R&D Services Chat',
                'chat_placeholder' => 'Share your R&D needs or ideas...'
            ],
            'stem-services' => [
                'id' => 'stem-services',
                'icon' => 'fa-graduation-cap',
                'title' => 'STEM Services',
                'description' => 'Access specialized STEM programs and resources to build technical capabilities and foster innovation.',
                'badge' => 'Skills Development',
                'features' => [
                    'STEM training programs',
                    'Workshops and seminars',
                    'Technical skill development',
                    'Industry-academia collaboration'
                ],
                'chat_title' => 'STEM Services Chat',
                'chat_placeholder' => 'What skills or training do you need?'
            ],
            'investor-matchmaking' => [
                'id' => 'investor-matchmaking',
                'icon' => 'fa-handshake',
                'title' => 'Investor Matchmaking',
                'description' => 'Get matched with the right investors for your enterprise using our AI-powered matchmaking platform.',
                'badge' => 'Investment Ready',
                'features' => [
                    'AI-powered investor matching',
                    'Investment profile optimization',
                    'Investor connection facilitation',
                    'Deal tracking and support'
                ],
                'chat_title' => 'Investment Matchmaking Chat',
                'chat_placeholder' => 'Tell us about your investment needs...'
            ]
        ];
        
        // Check if service exists
        if (!isset($services[$serviceId])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Service not found');
        }
        
        $data = [
            'title' => $services[$serviceId]['title'] . ' — AIIIIS',
            'active_page' => 'services',
            'service' => $services[$serviceId],
            'meta_description' => $services[$serviceId]['description']
        ];
        
        return view('service', $data);
    }
}