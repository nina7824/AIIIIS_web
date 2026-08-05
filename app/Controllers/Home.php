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
}