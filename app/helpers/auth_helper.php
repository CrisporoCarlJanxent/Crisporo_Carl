<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

if (!function_exists('is_logged_in'))
{
    /**
     * Check if user is logged in
     *
     * @return bool
     */
    function is_logged_in()
    {
        try {
            $CI =& get_instance();
            error_log("Session object exists: " . (isset($CI->session) ? 'yes' : 'no'));
            $result = $CI->session->userdata('is_logged_in') === true;
            error_log("Session is_logged_in value: " . var_export($CI->session->userdata('is_logged_in'), true));
            return $result;
        } catch (Throwable $e) {
            error_log("Error in is_logged_in(): " . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('get_current_user'))
{
    /**
     * Get current logged in user data
     *
     * @return array|false
     */
    function get_current_user()
    {
        $CI =& get_instance();
        if (is_logged_in()) {
            $user_id = $CI->session->userdata('user_id');
            $username = $CI->session->userdata('username');
            $email = $CI->session->userdata('email');
            $role = $CI->session->userdata('role');
            
            return [
                'id' => $user_id ? $user_id : 0,
                'username' => $username ? $username : 'Unknown',
                'email' => $email ? $email : '',
                'role' => $role ? $role : 'user'
            ];
        }
        return false;
    }
}

if (!function_exists('has_role'))
{
    /**
     * Check if current user has specific role
     *
     * @param string $role
     * @return bool
     */
    function has_role($role)
    {
        $user = get_current_user();
        return $user && $user['role'] === $role;
    }
}

if (!function_exists('is_admin'))
{
    /**
     * Check if current user is admin
     *
     * @return bool
     */
    function is_admin()
    {
        return has_role('admin');
    }
}

if (!function_exists('require_login'))
{
    /**
     * Require user to be logged in, redirect to login if not
     *
     * @return void
     */
    function require_login()
    {
        // Debug logging
        error_log("require_login() called");
        error_log("is_logged_in result: " . (is_logged_in() ? 'true' : 'false'));
        
        if (!is_logged_in()) {
            error_log("Redirecting to auth/login");
            redirect('auth/login');
        }
    }
}

if (!function_exists('require_admin'))
{
    /**
     * Require user to be admin, redirect to login if not logged in or not admin
     *
     * @return void
     */
    function require_admin()
    {
        if (!is_logged_in()) {
            redirect('auth/login');
        }
        
        if (!is_admin()) {
            show_404('Access Denied', 'You do not have permission to access this page.');
        }
    }
}

if (!function_exists('get_instance'))
{
    /**
     * Get LavaLust instance
     *
     * @return object
     */
    function &get_instance()
    {
        return Controller::instance();
    }
}
?>
