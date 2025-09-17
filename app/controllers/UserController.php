<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
        $this->call->library('pagination'); 
    }    public function view()
    {
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
    }

    public function create()
    {
        if ($this->io->method() === 'post') {
            $team_name = $this->io->post('team_name');
            $captain_name = $this->io->post('captain_name');
            $game_title = $this->io->post('game_title');

            // Handle file upload manually since we're having issues with the upload library
            if (!isset($_FILES['team_logo']) || !is_uploaded_file($_FILES['team_logo']['tmp_name'])) {
                echo 'Error: No file was uploaded. Please select a team logo.';
                return;
            }

            $file = $_FILES['team_logo'];
            
            // Validate file type
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!in_array($file['type'], $allowed_types)) {
                echo 'Error: Invalid file type. Please upload a JPG, JPEG, PNG, or GIF file.';
                return;
            }

            // Validate file size (2MB max)
            if ($file['size'] > 2048 * 1024) {
                echo 'Error: File is too large. Maximum size is 2MB.';
                return;
            }

            // Generate unique filename
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_filename = uniqid('team_logo_') . '.' . $extension;
            $destination = './public/' . $new_filename;

            // Move uploaded file
            if (!move_uploaded_file($file['tmp_name'], $destination)) {
                echo 'Error: Failed to save the uploaded file.';
                return;
            }

            $team_logo = $new_filename;

            $data = [
                'team_name' => $team_name,
                'captain_name' => $captain_name,
                'game_title' => $game_title,
                'team_logo' => $team_logo
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

            // Handle file upload if a new logo is provided
            if (isset($_FILES['team_logo']) && is_uploaded_file($_FILES['team_logo']['tmp_name'])) {
                $file = $_FILES['team_logo'];
                
                // Validate file type
                $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!in_array($file['type'], $allowed_types)) {
                    echo 'Error: Invalid file type. Please upload a JPG, JPEG, PNG, or GIF file.';
                    return;
                }

                // Validate file size (2MB max)
                if ($file['size'] > 2048 * 1024) {
                    echo 'Error: File is too large. Maximum size is 2MB.';
                    return;
                }

                // Generate unique filename
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $new_filename = uniqid('team_logo_') . '.' . $extension;
                $destination = './public/' . $new_filename;

                // Delete old logo if exists
                $old_logo = $this->UserModel->find($id)['team_logo'];
                if ($old_logo && file_exists('./public/' . $old_logo)) {
                    unlink('./public/' . $old_logo);
                }

                // Move uploaded file
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $data['team_logo'] = $new_filename;
                } else {
                    echo 'Error: Failed to save the uploaded file.';
                    return;
                }
            }

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
                    echo 'Something went wrong while removing team signup';
                }
            } catch (Exception $e) {
                echo 'Something went wrong while removing team signup: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $data['signup'] = $this->UserModel->find($id);
            if (!$data['signup']) {
                echo 'Team signup not found';
                return;
            }
            $this->call->view('users/delete', $data);
        }
    }
}
?>
