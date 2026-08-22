<?php
$host = 'localhost';
$dbname = 'aiiiis_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Test password
    $testPassword = 'admin123';
    $newHash = password_hash($testPassword, PASSWORD_DEFAULT);
    
    echo "<h2>Password Reset Tool</h2>";
    echo "New hash for 'admin123': <code>" . $newHash . "</code><br><br>";
    
    // Update specific user
    $email = 'info@eacapital.rw';
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->execute([$newHash, $email]);
    
    if ($stmt->rowCount() > 0) {
        echo "✅ Password updated for: " . $email . "<br>";
        echo "You can now login with: <strong>" . $email . " / admin123</strong><br><br>";
    } else {
        echo "❌ User not found: " . $email . "<br>";
    }
    
    // Show all investor users
    echo "<h3>All Investor Users</h3>";
    $stmt = $pdo->query("SELECT user_id, name, email, role FROM users WHERE role = 'investor'");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . $user['user_id'] . "</td>";
        echo "<td>" . $user['name'] . "</td>";
        echo "<td>" . $user['email'] . "</td>";
        echo "<td>" . $user['role'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<br><a href='/AIIIIS_web/login'>Go to Login →</a>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}