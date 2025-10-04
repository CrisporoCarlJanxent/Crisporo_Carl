<?php
/**
 * Debug script for Render deployment
 * Access this at: https://crisporo-carl.onrender.com/debug_render.php
 * 
 * IMPORTANT: Remove or restrict access to this file in production!
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Render Deployment Debug Information</h1>";
echo "<hr>";

// PHP Version
echo "<h2>PHP Version</h2>";
echo "<p>" . phpversion() . "</p>";

// Document Root
echo "<h2>Document Root</h2>";
echo "<p>" . $_SERVER['DOCUMENT_ROOT'] . "</p>";

// Current Directory
echo "<h2>Current Directory</h2>";
echo "<p>" . __DIR__ . "</p>";

// Check if key files exist
echo "<h2>File Existence Check</h2>";
$files_to_check = [
    'index.php',
    'app/config/config.php',
    'app/config/database.php',
    'scheme/kernel/LavaLust.php',
    'runtime',
    'runtime/logs',
    'runtime/sessions',
    'runtime/cache'
];

echo "<ul>";
foreach ($files_to_check as $file) {
    $path = __DIR__ . '/' . $file;
    $exists = file_exists($path);
    $writable = is_writable($path);
    
    echo "<li><strong>$file:</strong> ";
    echo $exists ? "✓ Exists" : "✗ Missing";
    
    if ($exists) {
        echo " | " . ($writable ? "✓ Writable" : "✗ Not writable");
        echo " | Permissions: " . substr(sprintf('%o', fileperms($path)), -4);
    }
    echo "</li>";
}
echo "</ul>";

// Environment Variables
echo "<h2>Environment Variables</h2>";
echo "<ul>";
echo "<li><strong>SERVER_NAME:</strong> " . ($_SERVER['SERVER_NAME'] ?? 'Not set') . "</li>";
echo "<li><strong>REQUEST_URI:</strong> " . ($_SERVER['REQUEST_URI'] ?? 'Not set') . "</li>";
echo "<li><strong>DOCUMENT_ROOT:</strong> " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Not set') . "</li>";
echo "</ul>";

// Database Connection Test
echo "<h2>Database Connection Test</h2>";
try {
    $host = 'sql12.freesqldatabase.com';
    $dbname = 'sql12799933';
    $username = 'sql12799933';
    $password = 'C2iyjsecfC';
    
    $dsn = "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    
    echo "<p style='color: green;'>✓ Database connection successful!</p>";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT 1 as test");
    $result = $stmt->fetch();
    echo "<p>✓ Database query test: " . ($result['test'] === 1 ? 'Passed' : 'Failed') . "</p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Apache Modules (if available)
echo "<h2>Apache Modules</h2>";
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    echo "<p>mod_rewrite: " . (in_array('mod_rewrite', $modules) ? '✓ Enabled' : '✗ Disabled') . "</p>";
} else {
    echo "<p>Cannot detect Apache modules (CLI or non-Apache environment)</p>";
}

// Session Test
echo "<h2>Session Test</h2>";
if (session_status() === PHP_SESSION_DISABLED) {
    echo "<p style='color: red;'>✗ Sessions are disabled</p>";
} else {
    echo "<p style='color: green;'>✓ Sessions are available</p>";
    
    // Try to start a session
    try {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        echo "<p style='color: green;'>✓ Session started successfully</p>";
        echo "<p>Session ID: " . session_id() . "</p>";
        echo "<p>Session save path: " . session_save_path() . "</p>";
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Session start failed: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}

// .htaccess check
echo "<h2>.htaccess Check</h2>";
$htaccess_path = __DIR__ . '/.htaccess';
if (file_exists($htaccess_path)) {
    echo "<p style='color: green;'>✓ .htaccess exists</p>";
    echo "<pre>" . htmlspecialchars(file_get_contents($htaccess_path)) . "</pre>";
} else {
    echo "<p style='color: red;'>✗ .htaccess not found</p>";
}

echo "<hr>";
echo "<p><em>Remember to remove or restrict this file after debugging!</em></p>";
?>
