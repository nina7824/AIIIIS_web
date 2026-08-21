<?php
// Test the chatbot controller directly

$message = $_GET['message'] ?? 'What is NIRDA?';
$serviceId = $_GET['service_id'] ?? 'general';

$url = "http://localhost/aiiiis/chatbot/process";
$data = http_build_query([
    'message' => $message,
    'service_id' => $serviceId
]);

$options = [
    'http' => [
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => $data,
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo "<h1>Chatbot Test</h1>";
echo "<strong>Question:</strong> " . htmlspecialchars($message) . "<br>";
echo "<strong>Response:</strong> " . htmlspecialchars($result) . "<br>";

$data = json_decode($result, true);
if ($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}
?>