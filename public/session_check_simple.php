<?php
$path = 'C:\temp\ci4_session';
echo "Checking path: " . $path . "<br>";
echo "Is directory? " . (is_dir($path) ? 'Yes' : 'No') . "<br>";
echo "Is writable? " . (is_writable($path) ? 'Yes' : 'No') . "<br>";

// Try to create a file
$testFile = $path . '/test_write.txt';
$result = file_put_contents($testFile, 'Test write permission');
echo "Can write? " . ($result !== false ? 'Yes - wrote ' . $result . ' bytes' : 'No') . "<br>";
if (file_exists($testFile)) {
    echo "File exists: " . $testFile . "<br>";
    unlink($testFile);
} else {
    echo "File was not created<br>";
}

// Check PHP user
echo "<br>PHP running as user: " . get_current_user() . "<br>";
echo "PHP process owner: " . (function_exists('posix_geteuid') ? posix_geteuid() : 'N/A on Windows') . "<br>";
?>