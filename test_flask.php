<?php
// Test Flask API connection

echo "<h1>Flask API Integration Test</h1>";

// Test health
$url = "http://localhost:5000/api/health";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "<h2>Health Check</h2>";
echo "HTTP Status: " . $httpCode . "<br>";
if ($response) {
    echo "Response: " . $response . "<br>";
    $data = json_decode($response, true);
    if (isset($data['status']) && $data['status'] === 'ok') {
        echo "✅ Flask API is working!<br>";
        echo "Knowledge items: " . $data['knowledge_items'] . "<br>";
        echo "Model: " . $data['model_name'] . "<br>";
    }
} else {
    echo "❌ No response from Flask API<br>";
}

// Test chat
echo "<h2>Chat Test</h2>";
$chatUrl = "http://localhost:5000/api/chat";
$data = json_encode(['message' => 'What is NIRDA?']);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $chatUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    $result = json_decode($response, true);
    echo "Question: What is NIRDA?<br>";
    echo "Reply: " . ($result['reply'] ?? 'No reply') . "<br>";
    echo "Source: " . ($result['source'] ?? 'unknown') . "<br>";
    echo "Success: " . ($result['success'] ? '✅ Yes' : '❌ No') . "<br>";
}
?>