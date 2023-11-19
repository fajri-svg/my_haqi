<?php
class BobotTernormalisasi_model extends CI_Model {
    public function getKriteria() {
        return $this->db->get('kriteria')->result_array();
    }

    public function getAlternatif() {
        return $this->db->order_by('id_user', 'asc')->get('user')->result_array();
    }

    public function getNilaiMatrik($idUser) {
        return $this->db->order_by('id_matrik', 'asc')->get_where('nilai_matrik', array('id_user' => $idUser))->result_array();
    }

    public function getJumlahAlternatif() {
        return $this->db->get('user')->num_rows();
    }

    public function getBobotKriteria($idKriteria) {
        $nilaiMatrik = $this->db->get_where('nilai_matrik', array('id_kriteria' => $idKriteria))->result_array();
        $jumlahAlternatif = $this->getJumlahAlternatif();
        
        $totalNilai = array_sum(array_column($nilaiMatrik, 'nilai'));
        return $totalNilai / $jumlahAlternatif;
    }

    public function getBobotInput($idKriteria) {
        return $this->db->get_where('kriteria', array('id_kriteria' => $idKriteria))->row_array()['bobot'];
    }
}
?>
