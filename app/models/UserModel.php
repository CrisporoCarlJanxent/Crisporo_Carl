<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'tournament_signups';
    protected $primary_key = 'id';
    
    // Optional: Add allowed fields for mass assignment security
    protected $allowed_fields = ['team_name', 'captain_name', 'game_title'];
    
    // Optional: Add validation rules
    protected $validation_rules = [
        'team_name' => 'required|min_length[3]|max_length[100]',
        'captain_name' => 'required|min_length[2]|max_length[100]',
        'game_title' => 'required|min_length[2]|max_length[100]'
    ];
}