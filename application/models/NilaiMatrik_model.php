<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NilaiMatrik_model extends CI_Model
{

    public function getKriteria()
    {
        return $this->db->get('kriteria')->result_array();
    }

    public function getAlternatif()
    {
        return $this->db->order_by('id_user')->get('user')->result_array();
    }

    public function getNilaiMatrik($idKriteria, $idUser)
    {
        return $this->db->get_where('nilai_matrik', ['id_kriteria' => $idKriteria, 'id_user' => $idUser])->row_array();
    }

    public function simpanNilaiMatrik($data)
    {
        $this->db->trans_start();

        // Hapus nilai_matrik jika sudah ada untuk id_user tertentu
        $this->db->delete('nilai_matrik', ['id_user' => $data['id_user']]);

        // Simpan nilai_matrik baru
        $this->db->insert_batch('nilai_matrik', $data['nilai_matrik']);

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function getNilaiMatriks($id_user)
    {
        return $this->db->query("SELECT * FROM nilai_matrik WHERE id_user='$id_user' ORDER BY id_matrik ASC")->result_array();
    }

    public function getNilai()
    {
        return $this->db->get('nilai_matrik')->result_array();
    }

    // public function getMatrik($idUser)
    // {
    //     return $this->db->order_by('id_matrik', 'asc')->get_where('nilai_matrik', array('id_user' => $idUser))->result_array();
    // }

    // public function getJumlahAlternatif()
    // {
    //     return $this->db->get('user')->num_rows();
    // }

    // public function getBobotKriteria($idKriteria)
    // {
    //     $nilaiMatrik = $this->db->get_where('nilai_matrik', array('id_kriteria' => $idKriteria))->result_array();
    //     $jumlahAlternatif = $this->getJumlahAlternatif();

    //     $totalNilai = array_sum(array_column($nilaiMatrik, 'nilai'));
    //     return $totalNilai / $jumlahAlternatif;
    // }

    // public function getBobotInput($idKriteria)
    // {
    //     return $this->db->get_where('kriteria', array('id_kriteria' => $idKriteria))->row_array()['bobot'];
    // }
}
