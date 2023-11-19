<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Kriteria_model');
    }

    public function index()
    {
        $data['title'] = 'Data Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['role'] = $this->db->get('user_role')->result_array();
        $data['kriteria'] = $this->Kriteria_model->getKriteria();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambahKriteria()
    {
        $data['title'] = 'Tambah Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->Kriteria_model->getKriteria();
        $data['IDbaru'] = $this->Kriteria_model->generateNewID();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/tambahkriteria', $data);
        $this->load->view('templates/footer');
    }

    public function simpanKriteria()
    {
        $data = array(
            'id_kriteria' => $this->input->post('id_kriteria'),
            'nama_kriteria' => $this->input->post('nama_kriteria'),
            'bobot' => $this->input->post('bobot'),
            'poin1' => $this->input->post('poin1'),
            'poin2' => $this->input->post('poin2'),
            'poin3' => $this->input->post('poin3'),
            'poin4' => $this->input->post('poin4'),
            'poin5' => $this->input->post('poin5'),
            'poin6' => $this->input->post('poin6'),
            'poin7' => $this->input->post('poin7'),
            'poin8' => $this->input->post('poin8'),
            'poin9' => $this->input->post('poin9'),
            'poin10' => $this->input->post('poin10'),
            'sifat' => $this->input->post('sifat')
        );

        $this->Kriteria_model->simpanKriteria($data);
        $this->session->set_flashdata('message', '<div class="alert 
        alert-success" role="alert">Data kriteria updated!</div>');
        redirect('data');
    }

    public function ubahkriteria($id)
    {
        $data['title'] = 'Ubah Kriteria';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //Inget viewnya blom ada
        $this->load->model('Kriteria_model');
        $data['kriteria'] = $this->Kriteria_model->getKriteriaById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/ubahkriteria', $data);
        $this->load->view('templates/footer');
    }

    public function prosesUbah()
    {
        $this->load->model('Kriteria_model');

        $data = array(
            'nama_kriteria' => $this->input->post('nama_kriteria'),
            'bobot' => $this->input->post('bobot'),
            'poin1' => $this->input->post('poin1'),
            'poin2' => $this->input->post('poin2'),
            'poin3' => $this->input->post('poin3'),
            'poin4' => $this->input->post('poin4'),
            'poin5' => $this->input->post('poin5'),
            'poin6' => $this->input->post('poin6'),
            'poin7' => $this->input->post('poin7'),
            'poin8' => $this->input->post('poin8'),
            'poin9' => $this->input->post('poin9'),
            'poin10' => $this->input->post('poin10'),
            'sifat' => $this->input->post('sifat')
        );

        $this->Kriteria_model->updateKriteria($this->input->post('id_kriteria'), $data);
        $this->session->set_flashdata('message', '<div class="alert 
        alert-success" role="alert">Data kriteria updated!</div>');
        redirect('data');
    }

    public function deleteKriteria($id)
    {
        $this->load->model('Kriteria_model');

        if ($this->Kriteria_model->deleteKriteria($id)) {
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Data kriteria updated!</div>');
            redirect('data');
        } else {
            $this->session->set_flashdata('message', '<div class="alert 
            alert-danger" role="alert">Data kriteria delete failed!</div>');
            redirect('data');
        }
    }

    public function dataUser()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['alternatif'] = $this->db->get('user')->result_array();
        // $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->model('Alternatif_model');
        $data['alternatif'] = $this->Alternatif_model->getAlternatif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/datauser', $data);
        $this->load->view('templates/footer');
    }
}
