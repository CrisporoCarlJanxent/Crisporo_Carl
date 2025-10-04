<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Dashboard extends Controller {
    
    public function index() {
        // Simple dashboard that shows you're logged in
        if (!is_logged_in()) {
            redirect('auth/login');
            exit();
        }
        
        $user = get_current_user();
        
        echo "<!DOCTYPE html>";
        echo "<html><head><title>Dashboard</title>";
        echo "<style>body{font-family:Arial;margin:40px;} .success{background:#4CAF50;color:white;padding:20px;border-radius:5px;}</style>";
        echo "</head><body>";
        echo "<div class='success'>";
        echo "<h1>✓ Login Successful!</h1>";
        echo "<p>Welcome, <strong>" . htmlspecialchars($user['username']) . "</strong>!</p>";
        echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
        echo "<p>Role: " . htmlspecialchars($user['role']) . "</p>";
        echo "</div>";
        echo "<h2>Navigation:</h2>";
        echo "<ul>";
        echo "<li><a href='" . site_url('users/view') . "'>View Users</a></li>";
        echo "<li><a href='" . site_url('users/create') . "'>Create User</a></li>";
        echo "<li><a href='" . site_url('auth/profile') . "'>My Profile</a></li>";
        echo "<li><a href='" . site_url('auth/logout') . "'>Logout</a></li>";
        echo "</ul>";
        echo "</body></html>";
    }
}
?>
