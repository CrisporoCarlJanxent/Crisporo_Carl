<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
        $this->call->library('pagination');
        
        // Require authentication for all methods
        if (!is_logged_in()) {
            redirect('auth/login');
            exit();
        }
    }

    public function view()
    {
        try {
            $page = 1;
            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $page = $this->io->get('page');
            }

            $q = '';
            if (isset($_GET['q']) && !empty($_GET['q'])) {
                $q = trim($this->io->get('q'));
            }

            $records_per_page = 5;

            $all = $this->UserModel->page($q, $records_per_page, $page);
            $data['signups'] = $all['records'];
            $total_rows = $all['total_rows'];

            $this->pagination->set_options([
                'first_link'     => '⏮ First',
                'last_link'      => 'Last ⏭',
                'next_link'      => 'Next →',
                'prev_link'      => '← Prev',
                'page_delimiter' => '&page='
            ]);
            $this->pagination->set_theme('bootstrap');
            $this->pagination->initialize(
                $total_rows,
                $records_per_page,
                $page,
                site_url('users/view') . '?q=' . urlencode($q)
            );
            $data['page'] = $this->pagination->paginate();

            $this->call->view('users/view', $data);
        } catch (Exception $e) {
            echo "<h1>Error in UserController::view()</h1>";
            echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
            echo "<p>File: " . htmlspecialchars($e->getFile()) . "</p>";
            echo "<p>Line: " . $e->getLine() . "</p>";
            echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
            exit();
        }
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
            } catch (Exception $e) {
                // In production, avoid echoing errors that can break redirects
            }
            redirect('users/view');
            return;
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
            } catch (Exception $e) {
                // In production, avoid echoing errors that can break redirects
            }
            redirect('users/view');
            return;
        } else {
            $data['signup'] = $this->UserModel->find($id);
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        if ($this->io->method() === 'post') {
            // Perform delete and always redirect
            try {
                $this->UserModel->delete($id);
            } catch (Exception $e) {
                // Swallow error for UX; log in development if needed
            }
            redirect('users/view');
            return;
        } else {
            $data['signup'] = $this->UserModel->find($id);
            if (!$data['signup']) {
                redirect('users/view');
                return;
            }
            $this->call->view('users/delete', $data);
        }
    }
}
?>
