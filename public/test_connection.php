<?php
// Test database connection
$host = 'localhost';
$dbname = 'aiiiis_db';
$username = 'root';
$password = '';

echo "<h2>Database Connection Test</h2>";

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Database connection successful!<br><br>";
    
    // Check users table
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "👤 Users in database: " . $result['count'] . "<br>";
    
    // Check admin user
    $stmt = $pdo->query("SELECT email, role FROM users WHERE email = 'admin@aiiiis.rw'");
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "✅ Admin user found: " . $admin['email'] . " (Role: " . $admin['role'] . ")<br>";
    } else {
        echo "❌ Admin user not found!<br>";
    }
    
} catch(PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage();
}