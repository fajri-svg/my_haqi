<?php
class MatrikIdeal_model extends CI_Model
{
    public function getKriteria()
    {
        return $this->db->get('kriteria')->result();
    }

    public function getNilaiMatrik($idKriteria)
    {
        return $this->db->get_where('nilai_matrik', ['id_kriteria' => $idKriteria])->result();
    }

    public function getAlternatif()
    {
        return $this->db->order_by('id_user', 'asc')->get('user')->result_array();
    }
}
