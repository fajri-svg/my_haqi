<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ranking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('NilaiMatrik_model');
        $this->load->model('BobotTernormalisasi_model');
        $this->load->model('MatrikIdeal_model');
        $this->load->model('Submenu_model');
        $this->load->library('session');
        // $this->load->library('PHPExcel');
    }

    // hasilRanking
    public function index()
    {
        $id_submenu = 16;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/hasilRanking', $data);
        $this->load->view('templates/footer');
    }

    //input nilai
    public function inputNilai()
    {
        $id_submenu = 5;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $this->session->userdata('id_user');

        // Mengirimkan id_user ke view
        $data['id_user'] = $id_user;
        // print_r($data);
        // die;

        $data['kriteria'] = $this->NilaiMatrik_model->getKriteria();
        $data['alternatif'] = $this->NilaiMatrik_model->getAlternatif();

        // var_dump($data);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/index', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        if ($this->input->post('simpan')) {

            $data['id_user'] = $this->input->post('id_user');
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
                redirect('ranking/inputNilai');
            } else {
                // Gagal disimpan
                echo 'Gagal menyimpan data!';
            }
        }
    }

    public function nilaiMatrik()
    {
        $id_submenu = 6;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->NilaiMatrik_model->getKriteria();
        $data['alternatif'] = $this->NilaiMatrik_model->getAlternatif();
        // $data['order'] = $this->Alternatif_model->joinOrder();
        // var_dump($data);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('ranking/nilaiMatrik', $data);
        $this->load->view('templates/footer');
    }

    public function nilaiMatrikTernormalisasi()
    {
        $id_submenu = 7;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);
        $id_submenu = 13;
        $title1 = $this->Submenu_model->getSubmenuTitleById($id_submenu);
        $data['title1'] = 'Matrik Ideal Positif (A<sup>+</sup>)';
        $data['title2'] = 'Matrik Ideal Negatif (A<sup>-</sup>)';
        $data['title3'] = 'Jarak Solusi Ideal Positif (D<sup>+</sup>)';
        $data['title4'] = 'Jarak Solusi Ideal Negatif (D<sup>-</sup>)';

        $data['title'] = $title;
        $data['title01'] = $title1;
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
        $id_submenu = 13;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
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
        $id_submenu = 14;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
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
        $id_submenu = 15;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
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
        $id_submenu = 16;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['title1'] = 'Jarak Solusi Ideal Positif (D<sup>+</sup>)';
        $data['title2'] = 'Jarak Solusi Ideal Negatif (D<sup>-</sup>)';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['kriteria'] = $this->MatrikIdeal_model->getKriteria();
        $data['alternatif'] = $this->MatrikIdeal_model->getAlternatif();
        $this->load->library('session');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        if (!$this->session->has_userdata('ymax')) {
            $this->load->view('ranking/jarakSolusi');
        }
        $this->load->view('ranking/hasilRanking', $data);
        $this->load->view('templates/footer');
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

        // echo "<i>cek sessionn dplus</i>";
        // echo "<pre>";
        // print_r($this->session->userdata('dplus'));
        // echo "</pre>";

        // echo "<i>cek sessionn dmin</i>";
        // echo "<pre>";
        // print_r($this->session->userdata('dmin'));
        // echo "</pre>";

        // print_r($this->session->all_userdata());

        if (!$this->session->has_userdata('ymax')) {
            // Assuming 'jarak_solusi.php' contains functions/methods you want to include
            $this->load->helper('path');
            include(APPPATH . 'path/to/ranking/nilaiMatrikTernormalisasi.php');
        }
    }

    public function exportToExcel()
    {
        @session_start();
        $this->load->database();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul spreadsheet
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Nilai'); // Ubah judul kolom

        // Siapkan array untuk menyimpan data sementara
        $data = [];

        // Isi data ke dalam array
        foreach ($_SESSION['dplus'] as $key => $dxmin) {
            $jarakm = $_SESSION['dmin'][$key];
            $id_alt = $_SESSION['id_alt'][$key];

            $nama = $this->db->query("SELECT * FROM user WHERE id_user='$id_alt'")->row_array();
            $nm = $nama['name'];

            $nilaiPre = $dxmin + $jarakm;
            $nilaid = $jarakm / $nilaiPre;
            $nilai = round($nilaid, 4);

            // Tambahkan data ke array
            $data[] = [
                'nama' => $nm,
                'nilai' => $nilai
            ];
        }

        // Urutkan data berdasarkan nilai dari yang terbesar
        usort($data, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        // Isi data ke dalam spreadsheet
        $i = 2;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $i, $i - 1);
            $sheet->setCellValue('B' . $i, $row['nama']);
            $sheet->setCellValue('C' . $i, $row['nilai']);
            $i++;
        }

        // Simpan ke file Excel
        date_default_timezone_set('Asia/Jakarta');
        $exportDate = date('d-m-Y (h-i-s A)');
        $filename = 'Laporan_Ranking_Karyawan_' . $exportDate . '.xlsx';
        $path = FCPATH . '/backup/export/' . $filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        // Download file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
