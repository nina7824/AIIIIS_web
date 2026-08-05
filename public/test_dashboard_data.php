<?php
$host = 'localhost';
$dbname = 'aiiiis_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Dashboard Data Test</h2>";
    
    // Test sector distribution
    $stmt = $pdo->query("SELECT sector, COUNT(*) as count FROM enterprises GROUP BY sector");
    $sectors = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Sector Distribution</h3>";
    echo "<pre>";
    print_r($sectors);
    echo "</pre>";
    
    // Test rankings
    $stmt = $pdo->query("SELECT er.*, e.name as enterprise_name FROM enterprise_rankings er JOIN enterprises e ON er.enterprise_id = e.enterprise_id ORDER BY total_score DESC LIMIT 5");
    $rankings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Rankings</h3>";
    echo "<pre>";
    print_r($rankings);
    echo "</pre>";
    
    // Test matches
    $stmt = $pdo->query("SELECT COUNT(*) as total, status FROM matches GROUP BY status");
    $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<h3>Match Stats</h3>";
    echo "<pre>";
    print_r($matches);
    echo "</pre>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}