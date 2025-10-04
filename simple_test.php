<?php
// Simple test without framework to check basic functionality
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Simple Test - No Framework</h1>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Current Directory: " . __DIR__ . "<br>";

// Test database connection
try {
    $host = 'sql12.freesqldatabase.com';
    $dbname = 'sql12799933';
    $username = 'sql12799933';
    $password = 'C2iyjsecfC';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Database connection successful<br>";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM tournament_signups");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✓ Tournament signups table has " . $result['count'] . " records<br>";
    
} catch (PDOException $e) {
    echo "✗ Database connection failed: " . $e->getMessage() . "<br>";
}

// Test file permissions
$test_file = 'test_write.txt';
if (is_writable('.')) {
    file_put_contents($test_file, 'test');
    echo "✓ Directory is writable<br>";
    unlink($test_file);
} else {
    echo "✗ Directory is not writable<br>";
}

echo "<br><strong>Basic functionality test complete!</strong>";
?>
