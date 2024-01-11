<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Submenu_model');
    }

    public function index()
    {
        $id_submenu = 9;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }

    public function edit_menu($id_menu)
    {
        $data['title'] = 'Edit Menu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->Submenu_model->getMenuById($id_menu);

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Submenu_model->editMenu($id_menu);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu updated!</div>');
            redirect('menu');
        }
    }

    public function delete_menu($id_menu)
    {
        $this->Submenu_model->deleteMenu($id_menu);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu deleted!</div>');
        redirect('menu');
    }

    public function submenu()
    {
        $id_submenu = 10;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }

    public function edit_submenu($id)
    {
        $data['title'] = 'Edit Submenu';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        // Fetch the submenu details based on the provided $id
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['submenu'] = $this->menu->getSubMenuById($id);

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_submenu', $data); // Change the view name accordingly
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->where('id', $id);
            $this->db->update('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Sub menu updated!</div>');
            redirect('menu/submenu');
        }
    }

    public function delete_submenu($id)
    {
        // Pastikan $id tidak kosong
        if (!empty($id)) {
            // Hapus data berdasarkan id
            $this->db->where('id', $id);
            $this->db->delete('user_sub_menu');

            // Set pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub menu deleted!</div>');
        } else {
            // Set pesan error jika $id kosong
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid request!</div>');
        }

        // Redirect ke halaman submenu
        redirect('menu/submenu');
    }
}
