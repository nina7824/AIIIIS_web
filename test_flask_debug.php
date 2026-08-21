<?php
// Debug Flask API connection

echo "<h1>Flask API Debug</h1>";

// Test 1: Health check
echo "<h2>Test 1: Health Check</h2>";
$url = "http://localhost:5000/api/health";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Status: " . $httpCode . "<br>";
if ($error) {
    echo "CURL Error: " . $error . "<br>";
}
if ($response) {
    echo "Response: " . substr($response, 0, 500) . "<br>";
    if ($httpCode === 200) {
        echo "✅ Health check passed!<br>";
    }
} else {
    echo "❌ No response from Flask API<br>";
}

// Test 2: Chat endpoint
echo "<h2>Test 2: Chat Endpoint</h2>";
$chatUrl = "http://localhost:5000/api/chat";
$data = json_encode(['message' => 'What is NIRDA?']);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $chatUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Status: " . $httpCode . "<br>";
if ($error) {
    echo "CURL Error: " . $error . "<br>";
}
if ($response) {
    $result = json_decode($response, true);
    echo "Response: " . $response . "<br>";
    echo "Reply: " . ($result['reply'] ?? 'No reply') . "<br>";
    echo "Source: " . ($result['source'] ?? 'unknown') . "<br>";
    echo "Success: " . ($result['success'] ? '✅ Yes' : '❌ No') . "<br>";
} else {
    echo "❌ No response from chat endpoint<br>";
}

// Test 3: Check if local knowledge base exists
echo "<h2>Test 3: Local Knowledge Base</h2>";
$kbPath = WRITEPATH . 'cache/knowledge_base.json';
echo "Path: " . $kbPath . "<br>";
if (file_exists($kbPath)) {
    echo "✅ Knowledge base exists<br>";
    $content = file_get_contents($kbPath);
    $data = json_decode($content, true);
    echo "Items: " . count($data['faqs'] ?? []) . "<br>";
} else {
    echo "❌ Knowledge base does not exist<br>";
}

// Test 4: Check if Flask API is accessible via command line
echo "<h2>Test 4: Network Check</h2>";
exec('ping -n 1 localhost', $output, $return);
echo "Ping localhost: " . ($return === 0 ? "✅ Success" : "❌ Failed") . "<br>";

exec('netstat -ano | findstr :5000', $output, $return);
echo "Port 5000 listening: " . (count($output) > 0 ? "✅ Yes" : "❌ No") . "<br>";
if (count($output) > 0) {
    echo "Output: " . implode("<br>", $output) . "<br>";
}
?>