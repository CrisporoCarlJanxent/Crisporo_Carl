<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
    }

    
    public function view()
    {
        $data['signups'] = $this->UserModel->all();
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
                echo 'Something went wrong while registering team: ' . htmlspecialchars($e->getMessage());
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
            // Actually delete the signup (POST request from confirmation form)
            try {
                if ($this->UserModel->delete($id)) {
                    redirect('users/view');
                } else {
                    echo 'Something went wrong while removing team signup';
                }
            } catch (Exception $e) {
                echo 'Something went wrong while removing team signup: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            // Show delete confirmation page (GET request from signups table)
            $data['signup'] = $this->UserModel->find($id);
            if (!$data['signup']) {
                echo 'Team signup not found';
                return;
            }
            $this->call->view('users/delete', $data);
        }
    }
}