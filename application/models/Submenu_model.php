<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu_model extends CI_Model
{

    public function get_submenu_by_id($id)
    {
        // Query untuk mendapatkan data submenu berdasarkan ID
        $query = $this->db->get_where('user_sub_menu', array('id' => $id));
        return $query->row_array();
    }

    public function update_submenu($id, $title, $url, $icon, $is_active)
    {
        // Query untuk melakukan update data submenu berdasarkan ID
        $data = array(
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active
        );
        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);
    }

    public function getSubmenuTitleById($id_submenu)
    {
        // Query untuk mengambil title berdasarkan ID dari tabel user_sub_menu
        $query = $this->db->get_where('user_sub_menu', array('id' => $id_submenu));

        // Ambil hasil query
        $result = $query->row();

        // Periksa apakah hasil query ada
        if ($result) {
            return $result->title;
        } else {
            return "Submenu tidak ditemukan";
        }
    }

    public function getMenuById($id_menu)
    {
        return $this->db->get_where('user_menu', ['id' => $id_menu])->row_array();
    }

    public function editMenu($id_menu)
    {
        $data = [
            'menu' => $this->input->post('menu')
        ];

        $this->db->where('id', $id_menu);
        $this->db->update('user_menu', $data);
    }

    public function deleteMenu($id_menu)
    {
        $this->db->delete('user_menu', ['id' => $id_menu]);
    }
}
