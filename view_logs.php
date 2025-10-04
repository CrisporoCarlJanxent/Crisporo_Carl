<?php
/**
 * Log Viewer - View PHP error logs
 * REMOVE THIS FILE AFTER DEBUGGING!
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

$log_file = __DIR__ . '/runtime/logs/php_error.log';
$lavalust_log_dir = __DIR__ . '/runtime/logs/';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Log Viewer</title>
    <style>
        body { font-family: monospace; margin: 20px; background: #f5f5f5; }
        h1 { color: #333; }
        .log-section { background: white; padding: 15px; margin: 10px 0; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        pre { background: #1e1e1e; color: #d4d4d4; padding: 15px; overflow-x: auto; border-radius: 3px; }
        .error { color: #f44336; }
        .warning { color: #ff9800; }
        .info { color: #2196f3; }
        button { background: #4CAF50; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 3px; margin: 5px; }
        button:hover { background: #45a049; }
        .danger { background: #f44336; }
        .danger:hover { background: #da190b; }
    </style>
</head>
<body>

<h1>🔍 Application Logs</h1>

<div class="log-section">
    <h2>PHP Error Log</h2>
    <?php if (file_exists($log_file)): ?>
        <p><strong>File:</strong> <?php echo $log_file; ?></p>
        <p><strong>Size:</strong> <?php echo filesize($log_file); ?> bytes</p>
        <p><strong>Last Modified:</strong> <?php echo date('Y-m-d H:i:s', filemtime($log_file)); ?></p>
        
        <button onclick="location.reload()">🔄 Refresh</button>
        <button class="danger" onclick="if(confirm('Clear this log?')) window.location.href='?clear=php'">🗑️ Clear PHP Log</button>
        
        <h3>Log Contents (Last 100 lines):</h3>
        <pre><?php
            $lines = file($log_file);
            $last_lines = array_slice($lines, -100);
            echo htmlspecialchars(implode('', $last_lines));
        ?></pre>
    <?php else: ?>
        <p style="color: #ff9800;">⚠️ PHP error log file not found: <?php echo $log_file; ?></p>
    <?php endif; ?>
</div>

<div class="log-section">
    <h2>LavaLust Application Logs</h2>
    <?php
    $log_files = glob($lavalust_log_dir . 'log-*.php');
    if (!empty($log_files)):
        rsort($log_files); // Most recent first
        $latest_log = $log_files[0];
        ?>
        <p><strong>Latest Log File:</strong> <?php echo basename($latest_log); ?></p>
        <p><strong>Size:</strong> <?php echo filesize($latest_log); ?> bytes</p>
        <p><strong>Last Modified:</strong> <?php echo date('Y-m-d H:i:s', filemtime($latest_log)); ?></p>
        
        <button class="danger" onclick="if(confirm('Clear all LavaLust logs?')) window.location.href='?clear=lavalust'">🗑️ Clear LavaLust Logs</button>
        
        <h3>Log Contents (Last 100 lines):</h3>
        <pre><?php
            $content = file_get_contents($latest_log);
            // Remove PHP tags from log files
            $content = str_replace(['<?php defined(\'PREVENT_DIRECT_ACCESS\') OR exit(\'No direct script access allowed\'); ?>', '<?php exit(); ?>', '<?php  exit(); ?>'], '', $content);
            $lines = explode("\n", $content);
            $last_lines = array_slice($lines, -100);
            echo htmlspecialchars(implode("\n", $last_lines));
        ?></pre>
        
        <h3>All Log Files:</h3>
        <ul>
        <?php foreach ($log_files as $file): ?>
            <li><?php echo basename($file); ?> (<?php echo filesize($file); ?> bytes)</li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p style="color: #ff9800;">⚠️ No LavaLust log files found in: <?php echo $lavalust_log_dir; ?></p>
    <?php endif; ?>
</div>

<div class="log-section">
    <h2>Apache/Server Error Log</h2>
    <p style="color: #888;">Server error logs are typically not accessible via PHP. Check Render dashboard logs.</p>
</div>

<?php
// Handle clear requests
if (isset($_GET['clear'])) {
    if ($_GET['clear'] === 'php' && file_exists($log_file)) {
        file_put_contents($log_file, '');
        echo "<script>alert('PHP log cleared!'); window.location.href='view_logs.php';</script>";
    } elseif ($_GET['clear'] === 'lavalust') {
        $log_files = glob($lavalust_log_dir . 'log-*.php');
        foreach ($log_files as $file) {
            unlink($file);
        }
        echo "<script>alert('LavaLust logs cleared!'); window.location.href='view_logs.php';</script>";
    }
}
?>

<hr>
<p><em>⚠️ Remember to delete this file (view_logs.php) after debugging!</em></p>

</body>
</html>
