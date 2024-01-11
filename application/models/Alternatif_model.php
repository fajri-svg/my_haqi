<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{

  public function getAlternatif()
  {
    $query = $this->db->query("SELECT *
                              FROM user a
                              LEFT JOIN user_role b ON a.role_id = b.id
                              JOIN user_statuses c ON a.is_active = c.id;");
    return $query->result_array();
    // print_r($query);
    // die;

    // $this->db->get_where('user');
    // return $this->db->get('user')->result_array();
  }

  public function getStatus()
  {
    $query = $this->db->query("SELECT * FROM user a LEFT JOIN user_statuses b ON a.is_active = b.id;");
    return $query->result_array();
    // print_r($query);
    // die;

    // $this->db->get_where('user');
    // return $this->db->get('user')->result_array();
  }

  public function getRole()
  {
    // $this->db->query("SELECT role FROM user_role a where a.id in (select id_user from user where a.id=id_user)");
    // SELECT b.role FROM user a LEFT JOIN user_role b ON a.role_id = b.id;
    // $this->db->select('b.role');
    // $this->db->from('user a');
    // $this->db->join('user_role b', 'a.role_id = b.id', 'left');
    // $query = $this->db->get();
    // var_dump($query);
    // die;
  }

  public function joinOrder($where)
  {
    $this->db->select('*');
    $this->db->from('nilai_matrik');
    $this->db->join('user d', 'd.id_user=bo.id_user');
    $this->db->join('kriteria', 'bu.id=d.id_kriteria');
    $this->db->where($where);
    return $this->db->get();
  }
}
