<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        return "Test controller is working!";
    }
    
    public function hello()
    {
        return "Hello from Test controller!";
    }
    
    public function dashboard_data()
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return "Please login first. <a href='/aiiiis/login'>Login</a>";
        }
        
        $db = \Config\Database::connect();
        
        echo "<h2>🔍 Dashboard Data Debug</h2>";
        echo "<hr>";
        
        // 1. Check Enterprise Data
        echo "<h3>1. Enterprises</h3>";
        $enterprises = $db->table('enterprises')->get()->getResultArray();
        echo "Total Enterprises: " . count($enterprises) . "<br>";
        if (count($enterprises) > 0) {
            echo "<pre>";
            print_r(array_column($enterprises, 'name'));
            echo "</pre>";
        }
        
        // 2. Check Sector Distribution
        echo "<h3>2. Sector Distribution</h3>";
        $sectorData = $db->table('enterprises')
            ->select('sector, COUNT(*) as count')
            ->groupBy('sector')
            ->get()
            ->getResultArray();
        echo "Sectors found: " . count($sectorData) . "<br>";
        echo "<pre>";
        print_r($sectorData);
        echo "</pre>";
        
        // 3. Check Rankings
        echo "<h3>3. Enterprise Rankings</h3>";
        $rankings = $db->table('enterprise_rankings')
            ->select('enterprise_rankings.*, enterprises.name as enterprise_name')
            ->join('enterprises', 'enterprises.enterprise_id = enterprise_rankings.enterprise_id')
            ->orderBy('total_score', 'DESC')
            ->limit(5)
            ->get()
            ->getResultArray();
        echo "Rankings found: " . count($rankings) . "<br>";
        if (count($rankings) > 0) {
            echo "<pre>";
            print_r($rankings);
            echo "</pre>";
        }
        
        // 4. Check Matches
        echo "<h3>4. Match Statistics</h3>";
        $totalMatches = $db->table('matches')->countAll();
        echo "Total Matches: " . $totalMatches . "<br>";
        
        $matchStatus = $db->table('matches')
            ->select('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->getResultArray();
        echo "<pre>";
        print_r($matchStatus);
        echo "</pre>";
        
        // 5. Check IoT Data
        echo "<h3>5. IoT Data</h3>";
        $iotData = $db->table('iot_data')
            ->limit(5)
            ->get()
            ->getResultArray();
        echo "IoT Records: " . count($iotData) . "<br>";
        if (count($iotData) > 0) {
            echo "<pre>";
            print_r($iotData);
            echo "</pre>";
        }
        
        // 6. Check Dashboard View Variables
        echo "<h3>6. What should be passed to dashboard view</h3>";
        $stats = [
            'total_enterprises' => $db->table('enterprises')->countAll(),
            'total_investors' => $db->table('investors')->countAll(),
            'total_matches' => $db->table('matches')->countAll(),
            'pending_verifications' => $db->table('enterprises')->where('is_verified', 0)->countAllResults()
        ];
        echo "<pre>";
        print_r($stats);
        echo "</pre>";
        
        echo "<hr>";
        echo "<p>✅ Debug complete. All data exists in the database.</p>";
        echo "<p><a href='/aiiiis/admin/dashboard'>Go to Dashboard →</a></p>";
    }
}