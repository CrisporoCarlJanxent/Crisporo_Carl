<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'tournament_signups';
    protected $primary_key = 'id';
    protected $allowed_fields = ['team_name', 'captain_name', 'game_title'];
    protected $validation_rules = [
        'team_name' => 'required|min_length[3]|max_length[100]',
        'captain_name' => 'required|min_length[2]|max_length[100]',
        'game_title' => 'required|min_length[2]|max_length[100]'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function page($q = '', $records_per_page = null, $page = null)
    {
        if (is_null($page)) {
            return [
                'total_rows' => $this->db->table($this->table)->count_all(),
                'records' => $this->db->table($this->table)->get_all()
            ];
        } else {
            $query = $this->db->table($this->table);

            if (!empty($q)) {
                $query->like('team_name', '%'.$q.'%')
                      ->or_like('captain_name', '%'.$q.'%')
                      ->or_like('game_title', '%'.$q.'%');
            }

            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

            $data['records'] = $query->pagination($records_per_page, $page)->get_all();

            return $data;
        }
    }
}
?>