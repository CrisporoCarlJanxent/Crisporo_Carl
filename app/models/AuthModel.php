<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';
    protected $allowed_fields = ['username', 'email', 'password', 'role', 'created_at', 'updated_at'];
    protected $validation_rules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'role' => 'required|in_list[admin,user]'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Register a new user
     */
    public function register($data)
    {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->insert($data);
    }

    /**
     * Authenticate user login
     */
    public function authenticate($username, $password)
    {
        $user = $this->db->table($this->table)
                        ->where('username', $username)
                        ->or_where('email', $username)
                        ->get();
        
        if ($user && password_verify($password, $user['password'])) {
            // Remove password from returned data
            unset($user['password']);
            return $user;
        }
        
        return false;
    }

    /**
     * Get user by ID
     */
    public function get_user($id)
    {
        $user = $this->find($id);
        if ($user) {
            unset($user['password']);
        }
        return $user;
    }

    /**
     * Update user profile
     */
    public function update_profile($id, $data)
    {
        // Don't allow password updates through this method
        unset($data['password']);
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->update($id, $data);
    }

    /**
     * Change password
     */
    public function change_password($id, $new_password)
    {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        return $this->update($id, [
            'password' => $hashed_password,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Check if user has specific role
     */
    public function has_role($user_id, $role)
    {
        $user = $this->get_user($user_id);
        return $user && $user['role'] === $role;
    }

    /**
     * Get all users (admin only)
     */
    public function get_all_users()
    {
        return $this->db->table($this->table)
                       ->select('id, username, email, role, created_at, updated_at')
                       ->get_all();
    }
}
?>
