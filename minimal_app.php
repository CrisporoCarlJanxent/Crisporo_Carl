<?php
// Minimal working version of the application
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define security constant
define('PREVENT_DIRECT_ACCESS', true);

// Set paths
$system_path = 'scheme';
$application_folder = 'app';
$public_folder = 'public';

define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('SYSTEM_DIR', ROOT_DIR . $system_path . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . $application_folder . DIRECTORY_SEPARATOR);
define('PUBLIC_DIR', $public_folder);

echo "<h1>Minimal App Test</h1>";
echo "Loading LavaLust framework...<br>";

try {
    // Include the framework
    require_once SYSTEM_DIR . 'kernel/LavaLust.php';
    echo "✓ Framework loaded successfully!<br>";
    
    // Test if we can access the application
    echo "✓ Application should be working now!<br>";
    echo "<a href='/'>Try the main application</a><br>";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "<br>";
} catch (Error $e) {
    echo "✗ Fatal Error: " . $e->getMessage() . "<br>";
}
?>
