<?php
$host = 'localhost';
$dbname = 'aiiiis_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>📊 AIIIIS Database Verification</h2>";
    echo "<hr>";
    
    // Get all table counts
    $tables = [
        'users' => '👤 Users',
        'enterprises' => '🏢 Enterprises',
        'investors' => '💰 Investors',
        'experts' => '👨‍🔬 Experts',
        'enterprise_rankings' => '📊 Rankings',
        'matches' => '🤝 Matches',
        'deals' => '📄 Deals',
        'engagements' => '📅 Engagements',
        'iot_data' => '📡 IoT Data',
        'notifications' => '🔔 Notifications'
    ];
    
    echo "<h3>Table Counts</h3>";
    echo "<table border='1' cellpadding='8' style='border-collapse:collapse;'>";
    echo "<tr style='background:#078ece;color:white;'><th>Table</th><th>Count</th><th>Status</th></tr>";
    
    $totalRecords = 0;
    foreach ($tables as $table => $label) {
        try {
            $stmt = $pdo->query("SELECT COUNT(*) as count FROM $table");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $result['count'];
            $totalRecords += $count;
            $status = $count > 0 ? '✅' : '⚠️ Empty';
            echo "<tr><td><strong>$label</strong> ($table)</td><td style='text-align:center;font-weight:bold;'>$count</td><td style='text-align:center;'>$status</td></tr>";
        } catch (PDOException $e) {
            echo "<tr><td><strong>$label</strong> ($table)</td><td style='text-align:center;color:red;'>Error</td><td style='text-align:center;'>❌</td></tr>";
        }
    }
    echo "</table>";
    echo "<p><strong>Total Records:</strong> " . $totalRecords . "</p>";
    
    // Show sample data
    echo "<hr>";
    echo "<h3>📋 Sample Data</h3>";
    
    // Enterprises
    echo "<h4>Enterprises</h4>";
    $stmt = $pdo->query("SELECT enterprise_id, name, sector, location, is_verified, status FROM enterprises LIMIT 5");
    $enterprises = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<table border='1' cellpadding='6' style='border-collapse:collapse;'>";
    echo "<tr style='background:#f0f0f0;'><th>ID</th><th>Name</th><th>Sector</th><th>Location</th><th>Verified</th><th>Status</th></tr>";
    foreach ($enterprises as $e) {
        echo "<tr>";
        echo "<td>" . $e['enterprise_id'] . "</td>";
        echo "<td><strong>" . $e['name'] . "</strong></td>";
        echo "<td>" . $e['sector'] . "</td>";
        echo "<td>" . $e['location'] . "</td>";
        echo "<td>" . ($e['is_verified'] ? '✅' : '❌') . "</td>";
        echo "<td>" . $e['status'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Matches
    echo "<h4>Matches</h4>";
    $stmt = $pdo->query("SELECT match_id, enterprise_id, investor_id, match_score, status FROM matches LIMIT 5");
    $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($matches) > 0) {
        echo "<table border='1' cellpadding='6' style='border-collapse:collapse;'>";
        echo "<tr style='background:#f0f0f0;'><th>ID</th><th>Enterprise</th><th>Investor</th><th>Score</th><th>Status</th></tr>";
        foreach ($matches as $m) {
            echo "<tr>";
            echo "<td>" . $m['match_id'] . "</td>";
            echo "<td>" . $m['enterprise_id'] . "</td>";
            echo "<td>" . $m['investor_id'] . "</td>";
            echo "<td><strong>" . $m['match_score'] . "%</strong></td>";
            echo "<td>" . $m['status'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:#856404;'>No matches found. Please insert sample data.</p>";
    }
    
    // IoT Data
    echo "<h4>IoT Data</h4>";
    $stmt = $pdo->query("SELECT sensor_id, enterprise_id, sensor_name, parameter, value, unit, is_alert FROM iot_data LIMIT 5");
    $iotData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($iotData) > 0) {
        echo "<table border='1' cellpadding='6' style='border-collapse:collapse;'>";
        echo "<tr style='background:#f0f0f0;'><th>ID</th><th>Enterprise</th><th>Sensor</th><th>Parameter</th><th>Value</th><th>Unit</th><th>Alert</th></tr>";
        foreach ($iotData as $i) {
            echo "<tr>";
            echo "<td>" . $i['sensor_id'] . "</td>";
            echo "<td>" . $i['enterprise_id'] . "</td>";
            echo "<td>" . $i['sensor_name'] . "</td>";
            echo "<td>" . $i['parameter'] . "</td>";
            echo "<td>" . $i['value'] . "</td>";
            echo "<td>" . $i['unit'] . "</td>";
            echo "<td>" . ($i['is_alert'] ? '⚠️' : '✅') . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:#856404;'>No IoT data found. Please insert sample data.</p>";
    }
    
    // Check if admin user exists
    echo "<hr>";
    echo "<h3>🔐 Admin User</h3>";
    $stmt = $pdo->query("SELECT user_id, name, email, role FROM users WHERE email = 'admin@aiiiis.rw'");
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($admin) {
        echo "✅ Admin user found:<br>";
        echo "<ul>";
        echo "<li><strong>Name:</strong> " . $admin['name'] . "</li>";
        echo "<li><strong>Email:</strong> " . $admin['email'] . "</li>";
        echo "<li><strong>Role:</strong> " . $admin['role'] . "</li>";
        echo "</ul>";
        echo "<p><strong>Login:</strong> http://localhost/aiiiis/login</p>";
        echo "<p><strong>Password:</strong> admin123</p>";
    } else {
        echo "❌ Admin user not found! Please insert admin user.";
    }
    
    echo "<hr>";
    echo "<p>✅ Verification complete! Your database is ready.</p>";
    echo "<p><a href='/aiiiis/admin/dashboard' style='background:#078ece;color:white;padding:10px 20px;text-decoration:none;border-radius:5px;'>Go to Admin Dashboard →</a></p>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}