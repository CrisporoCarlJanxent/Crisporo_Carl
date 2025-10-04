<?php
// Debug file to identify white screen issues
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

echo "Debug: Starting application...<br>";

// Check if required files exist
$required_files = [
    'scheme/kernel/LavaLust.php',
    'app/config/config.php',
    'app/config/database.php'
];

foreach ($required_files as $file) {
    if (file_exists($file)) {
        echo "✓ Found: $file<br>";
    } else {
        echo "✗ Missing: $file<br>";
    }
}

// Check PHP version
echo "PHP Version: " . phpversion() . "<br>";

// Check if PDO MySQL is available
if (extension_loaded('pdo_mysql')) {
    echo "✓ PDO MySQL extension loaded<br>";
} else {
    echo "✗ PDO MySQL extension NOT loaded<br>";
}

// Check database connection
try {
    $host = 'sql12.freesqldatabase.com';
    $dbname = 'sql12799933';
    $username = 'sql12799933';
    $password = 'C2iyjsecfC';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Database connection successful<br>";
} catch (PDOException $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "<br>";
}

// Try to include the main application
echo "<br>Attempting to load main application...<br>";

try {
    // Set the same constants as index.php
    $system_path = 'scheme';
    $application_folder = 'app';
    $public_folder = 'public';
    
    define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
    define('SYSTEM_DIR', ROOT_DIR . $system_path . DIRECTORY_SEPARATOR);
    define('APP_DIR', ROOT_DIR . $application_folder . DIRECTORY_SEPARATOR);
    define('PUBLIC_DIR', $public_folder);
    
    echo "✓ Constants defined<br>";
    
    // Try to include the main framework file
    if (file_exists(SYSTEM_DIR . 'kernel/LavaLust.php')) {
        echo "✓ LavaLust.php found, attempting to include...<br>";
        require_once SYSTEM_DIR . 'kernel/LavaLust.php';
        echo "✓ LavaLust.php included successfully<br>";
    } else {
        echo "✗ LavaLust.php not found<br>";
    }
    
} catch (Exception $e) {
    echo "✗ Error loading application: " . $e->getMessage() . "<br>";
    echo "Stack trace: <pre>" . $e->getTraceAsString() . "</pre>";
} catch (Error $e) {
    echo "✗ Fatal error: " . $e->getMessage() . "<br>";
    echo "Stack trace: <pre>" . $e->getTraceAsString() . "</pre>";
}

echo "<br>Debug complete.";
?>
