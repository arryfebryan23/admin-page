<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['page'] = 'user/index';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/template', $data);
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['page'] = 'user/edit';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/template', $data);
        } else {
            $name = $this->input->post('name');
            $email = $data['user']['email'];

            // Cek jika ada file gambar yang ingin di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.svg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            // Query builder type lain
            // $this->db->update('user', ['name' => $name], ['email' => $email]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['page'] = 'user/change-password';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required' => 'Password field is reuqired!',
                'matches' => 'Password dont match!',
                'min_length' => 'Password too short!'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');
        $this->form_validation->set_rules('current_password', 'Current Passwrod', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/template', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('password1', true);

            if (password_verify($current_password, $data['user']['password'])) {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    $email = $data['user']['email'];
                    $hash_password = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $new_password);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your password has been changed!</div>');
                    redirect('user/changepassword');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
                redirect('user/changepassword');
            }
        }
    }
}
