<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function getUsers($id)
    {
        $this->db->where('id_user !=', $id);
        return $this->db->get('user')->result_array();
    }

    public function getRole()
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

    public function getAllUsers()
    {
        // Contoh query untuk mengambil semua user
        $query = $this->db->get('user');
        return $query->result();
    }

    public function updateUserRole($id_user, $new_role_id)
    {
        // Contoh query untuk update role user
        $data = array('role_id' => $new_role_id);
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $data);
    }

    public function getUserEmailById($id_user)
    {
        $this->db->select('email');
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('user');
        $result = $query->row();

        return ($result) ? $result->email : null;
    }


    // public function getRole()
    // {
    //     $this->db->query("SELECT role FROM user_role a where a.id in (select id_user from user where a.id=id_user)");
    //     // SELECT b.role FROM user a LEFT JOIN user_role b ON a.role_id = b.id;
    //     $this->db->select('b.role');
    //     $this->db->from('user a');
    //     $this->db->join('user_role b', 'a.role_id = b.id', 'left');
    //     $query = $this->db->get();
    //     // var_dump($query);
    //     // die;
    // }

    // public function getBarang()
    // {
    //     $this->db->join('jenis j', 'b.jenis_id = j.id_jenis');
    //     $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
    //     $this->db->order_by('id_barang');
    //     return $this->db->get('barang b')->result_array();
    // }

    // public function getBarangMasuk($limit = null, $id_barang = null, $range = null)
    // {
    //     $this->db->select('*');
    //     $this->db->join('user u', 'bm.user_id = u.id_user');
    //     $this->db->join('supplier sp', 'bm.supplier_id = sp.id_supplier');
    //     $this->db->join('barang b', 'bm.barang_id = b.id_barang');
    //     $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
    //     if ($limit != null) {
    //         $this->db->limit($limit);
    //     }

    //     if ($id_barang != null) {
    //         $this->db->where('id_barang', $id_barang);
    //     }

    //     if ($range != null) {
    //         $this->db->where('tanggal_masuk' . ' >=', $range['mulai']);
    //         $this->db->where('tanggal_masuk' . ' <=', $range['akhir']);
    //     }

    //     $this->db->order_by('id_barang_masuk', 'DESC');
    //     return $this->db->get('barang_masuk bm')->result_array();
    // }

    // public function getBarangKeluar($limit = null, $id_barang = null, $range = null)
    // {
    //     $this->db->select('*');
    //     $this->db->join('user u', 'bk.user_id = u.id_user');
    //     $this->db->join('barang b', 'bk.barang_id = b.id_barang');
    //     $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
    //     if ($limit != null) {
    //         $this->db->limit($limit);
    //     }
    //     if ($id_barang != null) {
    //         $this->db->where('id_barang', $id_barang);
    //     }
    //     if ($range != null) {
    //         $this->db->where('tanggal_keluar' . ' >=', $range['mulai']);
    //         $this->db->where('tanggal_keluar' . ' <=', $range['akhir']);
    //     }
    //     $this->db->order_by('id_barang_keluar', 'DESC');
    //     return $this->db->get('barang_keluar bk')->result_array();
    // }

    // public function getMax($table, $field, $kode = null)
    // {
    //     $this->db->select_max($field);
    //     if ($kode != null) {
    //         $this->db->like($field, $kode, 'after');
    //     }
    //     return $this->db->get($table)->row_array()[$field];
    // }

    // public function count($table)
    // {
    //     return $this->db->count_all($table);
    // }

    // public function sum($table, $field)
    // {
    //     $this->db->select_sum($field);
    //     return $this->db->get($table)->row_array()[$field];
    // }

    // public function min($table, $field, $min)
    // {
    //     $field = $field . ' <=';
    //     $this->db->where($field, $min);
    //     return $this->db->get($table)->result_array();
    // }

    // public function chartBarangMasuk($bulan)
    // {
    //     $like = 'T-BM-' . date('y') . $bulan;
    //     $this->db->like('id_barang_masuk', $like, 'after');
    //     return count($this->db->get('barang_masuk')->result_array());
    // }

    // public function chartBarangKeluar($bulan)
    // {
    //     $like = 'T-BK-' . date('y') . $bulan;
    //     $this->db->like('id_barang_keluar', $like, 'after');
    //     return count($this->db->get('barang_keluar')->result_array());
    // }

    // public function laporan($table, $mulai, $akhir)
    // {
    //     $tgl = $table == 'barang_masuk' ? 'tanggal_masuk' : 'tanggal_keluar';
    //     $this->db->where($tgl . ' >=', $mulai);
    //     $this->db->where($tgl . ' <=', $akhir);
    //     return $this->db->get($table)->result_array();
    // }

    // public function cekStok($id)
    // {
    //     $this->db->join('satuan s', 'b.satuan_id=s.id_satuan');
    //     return $this->db->get_where('barang b', ['id_barang' => $id])->row_array();
    // }
}
