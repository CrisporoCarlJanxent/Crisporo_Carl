<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class SetupController extends Controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Setup admin account
     */
    public function admin()
    {
        // Database connection
        $host = 'localhost';
        $dbname = 'mockdata';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $data = [];
            $data['messages'] = [];
            
            // Check if users table exists
            $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
            if ($stmt->rowCount() == 0) {
                $data['messages'][] = ['type' => 'error', 'text' => 'Users table does not exist. Creating it now...'];
                
                // Create users table
                $sql = "CREATE TABLE IF NOT EXISTS `users` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(50) NOT NULL UNIQUE,
                  `email` varchar(100) NOT NULL UNIQUE,
                  `password` varchar(255) NOT NULL,
                  `role` enum('admin','user') NOT NULL DEFAULT 'user',
                  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  PRIMARY KEY (`id`),
                  KEY `idx_username` (`username`),
                  KEY `idx_email` (`email`),
                  KEY `idx_role` (`role`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
                
                $pdo->exec($sql);
                $data['messages'][] = ['type' => 'success', 'text' => 'Users table created successfully!'];
            } else {
                $data['messages'][] = ['type' => 'success', 'text' => 'Users table exists.'];
            }
            
            // Check if admin user exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'admin'");
            $stmt->execute();
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$admin) {
                $data['messages'][] = ['type' => 'error', 'text' => 'Admin user does not exist. Creating it now...'];
                
                // Create admin user
                $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->execute(['admin', 'admin@tournament.com', $hashedPassword, 'admin']);
                
                $data['messages'][] = ['type' => 'success', 'text' => 'Admin user created successfully!'];
            } else {
                $data['messages'][] = ['type' => 'success', 'text' => 'Admin user exists.'];
            }
            
            // Check if ADMIN user exists
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = 'ADMIN'");
            $stmt->execute();
            $admin2 = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$admin2) {
                $data['messages'][] = ['type' => 'error', 'text' => 'ADMIN user does not exist. Creating it now...'];
                
                // Create ADMIN user
                $hashedPassword2 = password_hash('ADMIN', PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
                $stmt->execute(['ADMIN', 'admin2@tournament.com', $hashedPassword2, 'admin']);
                
                $data['messages'][] = ['type' => 'success', 'text' => 'ADMIN user created successfully!'];
            } else {
                $data['messages'][] = ['type' => 'success', 'text' => 'ADMIN user exists.'];
            }
            
            // Get all users
            $stmt = $pdo->query("SELECT id, username, email, role, created_at FROM users");
            $data['users'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            $data['messages'][] = ['type' => 'error', 'text' => 'Database Error: ' . $e->getMessage()];
            $data['users'] = [];
        }
        
        $this->call->view('setup/admin', $data);
    }
}
?>
