<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->call->model('AuthModel');
        
        // Ensure session is started
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Show login form
     */
    public function login()
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            
            if (empty($username) || empty($password)) {
                $data['error'] = 'Please fill in all fields.';
                $this->call->view('auth/login', $data);
                return;
            }
            
            $user = $this->AuthModel->authenticate($username, $password);
            
            if ($user) {
                // Set session data
                $this->session->set_userdata([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                    'is_logged_in' => true
                ]);
                
                // Redirect to dashboard after successful login
                redirect('dashboard');
            } else {
                $data['error'] = 'Invalid username or password.';
                $this->call->view('auth/login', $data);
            }
        } else {
            // Check if already logged in
            if ($this->session->userdata('is_logged_in')) {
                redirect('users/view');
            }
            $this->call->view('auth/login');
        }
    }

    /**
     * Show registration form
     */
    public function register()
    {
        if ($this->io->method() === 'post') {
            $data = [
                'username' => $this->io->post('username'),
                'email' => $this->io->post('email'),
                'password' => $this->io->post('password'),
                'confirm_password' => $this->io->post('confirm_password'),
                'role' => 'user' // Default role
            ];
            
            // Validate passwords match
            if ($data['password'] !== $data['confirm_password']) {
                $data['error'] = 'Passwords do not match.';
                $this->call->view('auth/register', $data);
                return;
            }
            
            // Remove confirm_password from data array
            unset($data['confirm_password']);
            
            try {
                $user_id = $this->AuthModel->register($data);
                
                if ($user_id) {
                    // Auto-login after registration
                    $user = $this->AuthModel->get_user($user_id);
                    $this->session->set_userdata([
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'is_logged_in' => true
                    ]);
                    
                    redirect('users/view');
                } else {
                    $data['error'] = 'Registration failed. Please try again.';
                    $this->call->view('auth/register', $data);
                }
            } catch (Exception $e) {
                $data['error'] = 'Registration failed: ' . $e->getMessage();
                $this->call->view('auth/register', $data);
            }
        } else {
            // Check if already logged in
            if ($this->session->userdata('is_logged_in')) {
                redirect('users/view');
            }
            $this->call->view('auth/register');
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    /**
     * Show profile page
     */
    public function profile()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth/login');
        }
        
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->AuthModel->get_user($user_id);
        
        $this->call->view('auth/profile', $data);
    }

    /**
     * Update profile
     */
    public function update_profile()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth/login');
        }
        
        if ($this->io->method() === 'post') {
            $user_id = $this->session->userdata('user_id');
            $data = [
                'username' => $this->io->post('username'),
                'email' => $this->io->post('email')
            ];
            
            try {
                $this->AuthModel->update_profile($user_id, $data);
                
                // Update session data
                $this->session->set_userdata([
                    'username' => $data['username'],
                    'email' => $data['email']
                ]);
                
                redirect('auth/profile');
            } catch (Exception $e) {
                $data['error'] = 'Update failed: ' . $e->getMessage();
                $data['user'] = $this->AuthModel->get_user($user_id);
                $this->call->view('auth/profile', $data);
            }
        } else {
            redirect('auth/profile');
        }
    }

    /**
     * Change password
     */
    public function change_password()
    {
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth/login');
        }
        
        if ($this->io->method() === 'post') {
            $user_id = $this->session->userdata('user_id');
            $current_password = $this->io->post('current_password');
            $new_password = $this->io->post('new_password');
            $confirm_password = $this->io->post('confirm_password');
            
            if ($new_password !== $confirm_password) {
                $data['error'] = 'New passwords do not match.';
                $data['user'] = $this->AuthModel->get_user($user_id);
                $this->call->view('auth/profile', $data);
                return;
            }
            
            // Verify current password
            $user = $this->AuthModel->find($user_id);
            if (!password_verify($current_password, $user['password'])) {
                $data['error'] = 'Current password is incorrect.';
                $data['user'] = $this->AuthModel->get_user($user_id);
                $this->call->view('auth/profile', $data);
                return;
            }
            
            try {
                $this->AuthModel->change_password($user_id, $new_password);
                redirect('auth/profile');
            } catch (Exception $e) {
                $data['error'] = 'Password change failed: ' . $e->getMessage();
                $data['user'] = $this->AuthModel->get_user($user_id);
                $this->call->view('auth/profile', $data);
            }
        } else {
            redirect('auth/profile');
        }
    }
}
?>
