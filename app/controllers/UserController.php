<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
        $this->call->library('pagination'); // ✅ add pagination library
        
        // Require authentication for all methods
        if (!is_logged_in()) {
            redirect('auth/login');
            exit();
        }
    }

    public function view()
    {
        // Current page
        $page = 1;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        // Search query
        $q = '';
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 5;

        // ✅ Use the page() method from your UserModel
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['signups'] = $all['records'];
        $total_rows = $all['total_rows'];

        // ✅ Pagination setup
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('default'); // keep default first
        $this->pagination->initialize(
            $total_rows,
            $records_per_page,
            $page,
            site_url('users/view') . '?q=' . urlencode($q)
        );
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/view', $data);
    }

    public function create()
    {
        if ($this->io->method() === 'post') {
            $team_name = $this->io->post('team_name');
            $captain_name = $this->io->post('captain_name');
            $game_title = $this->io->post('game_title');

            $data = [
                'team_name' => $team_name,
                'captain_name' => $captain_name,
                'game_title' => $game_title
            ];

            try {
                $this->UserModel->insert($data);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while creating team: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $this->call->view('users/create');
        }
    }

    public function update($id)
    {
        if ($this->io->method() === 'post') {
            $team_name = $this->io->post('team_name');
            $captain_name = $this->io->post('captain_name');
            $game_title = $this->io->post('game_title');

            $data = [
                'team_name' => $team_name,
                'captain_name' => $captain_name,
                'game_title' => $game_title
            ];

            try {
                $this->UserModel->update($id, $data);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while updating team: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $data['signup'] = $this->UserModel->find($id);
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        if ($this->io->method() === 'post') {
            try {
                if ($this->UserModel->delete($id)) {
                    redirect('users/view');
                } else {
                    echo 'Something went wrong while deleting team';
                }
            } catch (Exception $e) {
                echo 'Something went wrong while deleting team: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $data['signup'] = $this->UserModel->find($id);
            if (!$data['signup']) {
                echo 'Team not found';
                return;
            }
            $this->call->view('users/delete', $data);
        }
    }
}
