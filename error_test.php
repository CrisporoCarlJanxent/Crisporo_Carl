<?php
/**
 * Emergency Error Display Script
 * This forces ALL errors to display, bypassing framework settings
 */

// Force error display BEFORE any other code runs
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

echo "<!DOCTYPE html><html><head><title>Error Test</title></head><body>";
echo "<h1>Testing Application Bootstrap</h1>";
echo "<p>If you see this, PHP is executing...</p>";
echo "<hr>";

// Try to load the application
try {
    echo "<p>Step 1: Setting up constants...</p>";
    
    define('PREVENT_DIRECT_ACCESS', TRUE);
    
    $system_path = 'scheme';
    $application_folder = 'app';
    $public_folder = 'public';
    
    define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);
    define('SYSTEM_DIR', ROOT_DIR . $system_path . DIRECTORY_SEPARATOR);
    define('APP_DIR', ROOT_DIR . $application_folder . DIRECTORY_SEPARATOR);
    define('PUBLIC_DIR', $public_folder);
    
    echo "<p>✓ Constants defined</p>";
    echo "<p>ROOT_DIR: " . ROOT_DIR . "</p>";
    echo "<p>SYSTEM_DIR: " . SYSTEM_DIR . "</p>";
    echo "<p>APP_DIR: " . APP_DIR . "</p>";
    
    echo "<p>Step 2: Loading LavaLust kernel...</p>";
    
    if (!file_exists(SYSTEM_DIR . 'kernel/LavaLust.php')) {
        throw new Exception("LavaLust.php not found at: " . SYSTEM_DIR . 'kernel/LavaLust.php');
    }
    
    echo "<p>✓ LavaLust.php exists</p>";
    
    // Try to include it
    require_once SYSTEM_DIR . 'kernel/LavaLust.php';
    
    echo "<p>✓ LavaLust loaded successfully!</p>";
    echo "<p>If you see this, the framework loaded without fatal errors.</p>";
    
} catch (Throwable $e) {
    echo "<div style='background: #ffebee; border: 2px solid #c62828; padding: 20px; margin: 20px 0;'>";
    echo "<h2 style='color: #c62828;'>❌ Fatal Error Caught!</h2>";
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
    echo "<p><strong>Line:</strong> " . $e->getLine() . "</p>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre style='background: #fff; padding: 10px; overflow: auto;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div>";
}

echo "<hr>";
echo "<h2>PHP Info</h2>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Loaded Extensions: " . implode(', ', get_loaded_extensions()) . "</p>";

// Check session configuration
echo "<h2>Session Configuration</h2>";
echo "<p>Session Save Path: " . session_save_path() . "</p>";
echo "<p>Session Name: " . session_name() . "</p>";
echo "<p>Session Status: ";
switch(session_status()) {
    case PHP_SESSION_DISABLED:
        echo "DISABLED";
        break;
    case PHP_SESSION_NONE:
        echo "NONE (not started)";
        break;
    case PHP_SESSION_ACTIVE:
        echo "ACTIVE";
        break;
}
echo "</p>";

echo "</body></html>";
?>
