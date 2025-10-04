<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Dashboard extends Controller {
    
    public function index() {
        // Simple dashboard that shows you're logged in
        if (!is_logged_in()) {
            redirect('auth/login');
            exit();
        }
        
        // Get user data directly from session
        $username = $this->session->userdata('username');
        $email = $this->session->userdata('email');
        $role = $this->session->userdata('role');
        
        // Load the dashboard view with data
        $data = [
            'username' => $username,
            'email' => $email,
            'role' => $role
        ];
        
        $this->call->view('dashboard/index', $data);
    }
}
?>
