<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{

    public function getAlternatif()
    {
        $this->db->get_where('user');
        return $this->db->get('user')->result_array();
    }


}
