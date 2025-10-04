<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html><html><head><title>Quick Test</title></head><body>";
echo "<h1>Quick Diagnostic Test</h1>";
echo "<p>✓ PHP is working</p>";
echo "<p>PHP Version: " . phpversion() . "</p>";

echo "<h2>Try these links:</h2>";
echo "<ul>";
echo "<li><a href='/auth/login'>Go to Login Page</a></li>";
echo "<li><a href='/auth/register'>Go to Register Page</a></li>";
echo "<li><a href='/'>Go to Home (requires login)</a></li>";
echo "</ul>";

echo "<h2>File Check:</h2>";
if (file_exists(__DIR__ . '/index.php')) {
    echo "<p>✓ index.php exists</p>";
} else {
    echo "<p>✗ index.php missing</p>";
}

if (file_exists(__DIR__ . '/app/config/config.php')) {
    echo "<p>✓ config.php exists</p>";
} else {
    echo "<p>✗ config.php missing</p>";
}

echo "</body></html>";
?>
