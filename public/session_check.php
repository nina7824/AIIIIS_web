<?php
// Load the CodeIgniter environment
require_once '../vendor/autoload.php';
require_once '../app/Config/Paths.php';

$paths = new Config\Paths();
require_once $paths->systemDirectory . '/Boot.php';

// Initialize the application
$app = CodeIgniter\Boot::bootWeb($paths);

// Now check session config
$sessionConfig = config('Session');
echo "Session Save Path from config: " . $sessionConfig->savePath . "<br>";

// Check if directory exists and is writable
$path = $sessionConfig->savePath;
echo "Is directory? " . (is_dir($path) ? 'Yes' : 'No') . "<br>";
echo "Is writable? " . (is_writable($path) ? 'Yes' : 'No') . "<br>";

// Try to create a test file
$testFile = $path . DIRECTORY_SEPARATOR . 'test_write.txt';
@file_put_contents($testFile, 'Test');
echo "Can write file? " . (file_exists($testFile) ? 'Yes' : 'No') . "<br>";
@unlink($testFile);

echo "<br>CI_ENVIRONMENT: " . (env('CI_ENVIRONMENT') ?? 'Not set') . "<br>";
echo "Base URL: " . (env('app.baseURL') ?? 'Not set') . "<br>";