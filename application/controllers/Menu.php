<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['page'] = 'menu/index';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/template', $data);
        } else {
            $newMenu = $this->input->post('menu', true);
            $this->db->insert('user_menu', ['menu' => $newMenu]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('Menu');
        }
    }

    public function subMenu()
    {
        $data['title'] = 'Submenu Management';
        $data['page'] = 'menu/submenu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->model('Menu_model', 'menu');
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        // $data['subMenu'] = $this->db->get('user_sub_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu ID', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/template', $data);
        } else {

            $data = [
                'menu_id' => $this->input->post('menu_id', true),
                'title' => $this->input->post('title', true),
                'url' => $this->input->post('url', true),
                'icon' => $this->input->post('icon', true),
                'is_active' => $this->input->post('is_active', true)
            ];


            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function deleteMenu($id, $menu)
    {
        $this->db->delete('user_menu', ['id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu ' . $menu . ' deleted!</div>');
        redirect('menu');
    }

    public function deleteSubMenu($id, $subMenu)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Submenu ' . $subMenu . ' deleted!</div>');
        redirect('menu/subMenu');
    }
}
