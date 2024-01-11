<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria_model extends CI_Model
{

    public function getKriteria()
    {
        $query = $this->db->query("SELECT * FROM kriteria ORDER BY id_kriteria ASC");
        return $query->result_array();
    }

    public function generateNewID()
    {
        $query = $this->db->query("SELECT MAX(id_kriteria) as idMaks FROM kriteria");
        $data  = $query->row_array();
        $nim = $data['idMaks'];

        $noUrut = (int) $nim;
        $noUrut++;


        $IDbaru =  $noUrut;

        return $IDbaru;
    }

    public function simpanKriteria($data)
    {
        $this->db->insert('kriteria', $data);
    }

    public function getKriteriaById($id)
    {
        $query = $this->db->get_where('kriteria', array('id_kriteria' => $id));
        return $query->row_array();
    }

    public function updateKriteria($id, $data)
    {
        $this->db->where('id_kriteria', $id);
        $this->db->update('kriteria', $data);
    }

    public function deleteKriteria($id)
    {
        $this->db->query("DELETE from nilai_matrik where id_kriteria = " . $id);
        $this->db->where('id_kriteria', $id);
        return $this->db->delete('kriteria');
    }
}
