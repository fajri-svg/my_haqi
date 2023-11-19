<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ranking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('NilaiMatrik_model');
        $this->load->model('BobotTernormalisasi_model');
        $this->load->model('MatrikIdeal_model');
    }

    public function index()
    {
        $data['title'] = 'Ranking';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/index', $data);
        $this->load->view('templates/footer');
    }

    public function perhitungan()
    {
        $data['title'] = 'Perhitungan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->NilaiMatrik_model->getKriteria();
        $data['alternatif'] = $this->NilaiMatrik_model->getAlternatif();

        // var_dump($data);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/perhitungan', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        if ($this->input->post('simpan')) {

            $data['id_user'] = $this->input->post('id_alt');
            // var_dump($data);
            // die;
            $data['nilai_matrik'] = [];

            foreach ($this->input->post() as $key => $value) {
                if (strpos($key, 'id_krite') !== false) {
                    $idKriteria = $value;
                    $nilai = $this->input->post('nilai' . substr($key, 8));

                    $data['nilai_matrik'][] = [
                        'id_user' => $data['id_user'],
                        'id_kriteria' => $idKriteria,
                        'nilai' => $nilai
                    ];
                }
            }

            $result = $this->NilaiMatrik_model->simpanNilaiMatrik($data);

            if ($result) {
                // Berhasil disimpan
                $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Data kriteria user updated!</div>');
                redirect('ranking/perhitungan');
            } else {
                // Gagal disimpan
                echo 'Gagal menyimpan data!';
            }
        }
    }

    public function nilaiMatrik()
    {
        $data['title'] = 'Nilai Matrik';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->NilaiMatrik_model->getKriteria();
        $data['alternatif'] = $this->NilaiMatrik_model->getAlternatif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/nilaiMatrik', $data);
        $this->load->view('templates/footer');
    }

    public function nilaiMatrikTernormalisasi()
    {
        $data['title'] = 'Nilai Matrik Ternormalisasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->NilaiMatrik_model->getKriteria();
        $data['alternatif'] = $this->NilaiMatrik_model->getAlternatif();
        $data['nilai_matrik'] = $this->NilaiMatrik_model->getNilai();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/nilaiMatrikTernormalisasi', $data);
        $this->load->view('templates/footer');
    }

    public function nilaiBobotTernormalisasi()
    {
        $data['title'] = 'Nilai Bobot Ternormalisasi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->BobotTernormalisasi_model->getKriteria();
        $data['alternatif'] = $this->BobotTernormalisasi_model->getAlternatif();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/nilaiBobotTernormalisasi', $data);
        $this->load->view('templates/footer');
    }

    public function matrikIdeal()
    {
        $data['title'] = 'Matrik Ideal Positif/Negatif';
        $data['title1'] = 'Matrik Ideal Positif (A<sup>+</sup>)';
        $data['title2'] = 'Matrik Ideal Negatif (A<sup>-</sup>)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->MatrikIdeal_model->getKriteria();
        $data['alternatif'] = $this->MatrikIdeal_model->getAlternatif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/matrikIdeal', $data);
        $this->load->view('templates/footer');
    }

    public function jarakSolusi()
    {
        $data['title'] = 'Jarak Ideal Positif/Negatif';
        $data['title1'] = 'Jarak Solusi Ideal Positif (D<sup>+</sup>)';
        $data['title2'] = 'Jarak Solusi Ideal Negatif (D<sup>-</sup>)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->MatrikIdeal_model->getKriteria();
        $data['alternatif'] = $this->MatrikIdeal_model->getAlternatif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/jarakSolusi', $data);
        $this->load->view('templates/footer');
    }

    public function hasilRanking()
    {
        $data['title'] = 'Ranking';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->MatrikIdeal_model->getKriteria();
        $data['alternatif'] = $this->MatrikIdeal_model->getAlternatif();
        $this->load->library('session');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/hasilRanking', $data);
        $this->load->view('templates/footer');

        if (!$this->session->has_userdata('ymax')) {
            $this->load->view('jarakSolusi'); 
        }
    }

    public function cetak()
    {
        $data['title'] = 'Cetak';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->MatrikIdeal_model->getKriteria();
        $data['alternatif'] = $this->MatrikIdeal_model->getAlternatif();
        $this->load->library('session');

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/cetak', $data);
        // $this->load->view('templates/footer');

        if (!$this->session->has_userdata('ymax')) {
            $this->load->view('jarakSolusi'); 
        }
    }


}
