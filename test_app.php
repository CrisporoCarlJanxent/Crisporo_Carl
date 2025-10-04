<?php
// Simple test to see if the main application loads
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Testing main application...<br>";

// Set the same constants as index.php
$system_path = 'scheme';
$application_folder = 'app';
$public_folder = 'public';

define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('SYSTEM_DIR', ROOT_DIR . $system_path . DIRECTORY_SEPARATOR);
define('APP_DIR', ROOT_DIR . $application_folder . DIRECTORY_SEPARATOR);
define('PUBLIC_DIR', $public_folder);

echo "Constants defined<br>";

// Include the main framework
require_once SYSTEM_DIR . 'kernel/LavaLust.php';
?>
