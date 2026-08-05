<?php
$host = 'localhost';
$dbname = 'aiiiis_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Enterprises in Database</h2>";
    
    $stmt = $pdo->query("SELECT enterprise_id, name, registration_number, sector, is_verified, status FROM enterprises");
    $enterprises = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($enterprises) > 0) {
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>ID</th><th>Name</th><th>Registration</th><th>Sector</th><th>Verified</th><th>Status</th></tr>";
        foreach ($enterprises as $e) {
            echo "<tr>";
            echo "<td>" . $e['enterprise_id'] . "</td>";
            echo "<td>" . $e['name'] . "</td>";
            echo "<td>" . $e['registration_number'] . "</td>";
            echo "<td>" . $e['sector'] . "</td>";
            echo "<td>" . ($e['is_verified'] ? '✅ Yes' : '❌ No') . "</td>";
            echo "<td>" . $e['status'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<p><strong>Total Enterprises:</strong> " . count($enterprises) . "</p>";
        
        // Show enterprise IDs for IoT data
        echo "<h3>Enterprise IDs for IoT Data:</h3>";
        echo "<ul>";
        foreach ($enterprises as $e) {
            echo "<li>ID: " . $e['enterprise_id'] . " - " . $e['name'] . "</li>";
        }
        echo "</ul>";
        
    } else {
        echo "❌ No enterprises found!<br>";
        echo "Please insert enterprises first.";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}