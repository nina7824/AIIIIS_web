<?php

namespace App\Controllers;

class Enterprise extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Enterprises — AIIIIS',
            'active_page' => 'enterprises',
            'meta_description' => 'Enterprise directory, verification, GIS mapping, sector clusters, and ranking for Rwanda\'s industrial development.',
            'section' => 'overview'
        ];
        
        return view('enterprise', $data);
    }
    
    public function directory()
    {
        $data = [
            'title' => 'Enterprise Directory — AIIIIS',
            'active_page' => 'enterprises',
            'meta_description' => 'Comprehensive directory of registered enterprises in Rwanda.',
            'section' => 'directory'
        ];
        
        return view('enterprise', $data);
    }
    
    public function verification()
    {
        $data = [
            'title' => 'Verification Queue — AIIIIS',
            'active_page' => 'enterprises',
            'meta_description' => 'Enterprise verification and validation queue.',
            'section' => 'verification'
        ];
        
        return view('enterprise', $data);
    }
    
    public function gis()
    {
        $data = [
            'title' => 'GIS Map View — AIIIIS',
            'active_page' => 'enterprises',
            'meta_description' => 'Geographic visualization of enterprises across Rwanda.',
            'section' => 'gis'
        ];
        
        return view('enterprise', $data);
    }
    
    public function clusters()
    {
        $data = [
            'title' => 'Sector Clusters — AIIIIS',
            'active_page' => 'enterprises',
            'meta_description' => 'Industrial sector clusters and their distribution.',
            'section' => 'clusters'
        ];
        
        return view('enterprise', $data);
    }
    
    public function ranking()
    {
        $data = [
            'title' => 'Enterprise Ranking — AIIIIS',
            'active_page' => 'enterprises',
            'meta_description' => 'AI-driven ranking of enterprises based on multiple metrics.',
            'section' => 'ranking'
        ];
        
        return view('enterprise', $data);
    }
}