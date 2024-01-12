<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Submenu_model');
    }



    public function index()
    {
        $id_submenu = 1;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['name'] = $this->db->get_where('user', ['name' => $name_nm])->row_array();
        // $sql['user'] = $this->db->count_all('user');

        // print_r($data);
        // die;
        $this->load->model('Alternatif_model');
        $this->load->model('Kriteria_model');
        $this->load->model('Count_model');
        $data['alternatif'] = $this->Alternatif_model->getAlternatif();
        $data['kriteria'] = $this->Kriteria_model->getKriteria();

        date_default_timezone_set('Asia/Jakarta');
        $data['current_time'] = date('H:i:s A');

        $data['language_percentages'] = $this->getLanguagePercentages();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');

        // $sql = "SELECT COUNT(*) as user_count FROM user";
        // var_dump($data);
        // die;
    }

    private function getLanguagePercentages()
    {
        $projectPath = '/xampp/htdocs/my_haqi';
        $fileExtensions = ['php', 'js', 'html'];

        $languageCount = [];

        foreach ($fileExtensions as $extension) {
            $files = $this->scanFiles($projectPath, $extension);
            $languageCount[$extension] = count($files);
        }

        $totalFiles = array_sum($languageCount);

        $languagePercentages = [];
        foreach ($languageCount as $extension => $count) {
            $percentage = ($count / $totalFiles) * 100;
            $languagePercentages[$extension] = round($percentage, 2);
        }

        // print_r($languagePercentages);
        // die;
        return $languagePercentages;
    }

    private function scanFiles($dir, $extension)
    {
        $files = glob($dir . '/**/*.' . $extension, GLOB_BRACE);
        return $files;
    }

    public function role()
    {
        $id_submenu = 11;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert 
        alert-success" role="alert">Access changed!</div>');
    }

    public function userPosition()
    {
        $id_submenu = 17;
        $title = $this->Submenu_model->getSubmenuTitleById($id_submenu);

        $data['title'] = $title;
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->model('Alternatif_model');
        $data['alternatif'] = $this->Alternatif_model->getAlternatif();
        // $data['role'] = $this->db->get_where('user_role')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/userPosition', $data);
        $this->load->view('templates/footer');
    }

    // function edituser($iduser = null)
    // {
    //     if ($iduser == null) {
    //         if (isset($_POST) && count($_POST) > 0) {
    //             $iduser = $this->input->post('iduser');
    //             if ($this->input->post('pwd1') != null || !empty($this->input->post('pwd1'))) {
    //                 $old = md5(md5($this->input->post('pwd1')) . 'nasi' . sha1($this->input->post('pwd1')));
    //                 $cekpass = array(
    //                     'id_ngota' => $iduser,
    //                     'pwo' => $old
    //                 );
    //                 $oldpass = $this->Altperiod->get($this->table, $cekpass);
    //                 // print_r($oldpass->num_rows()+$iduser+$old);
    //                 if ($oldpass) {
    //                     if ($this->input->post('pwd2') != null && !empty($this->input->post('pwd2'))) {
    //                         // $test=$this->input->post('pwd2');
    //                         $passenc = md5(md5($this->input->post('pwd2')) . 'nasi' . sha1($this->input->post('pwd2')));
    //                         // print_r($test);
    //                         $imgurl = $this->Altperiod->upload('foto', 300, 300, '75%');
    //                         $datauser = array(
    //                             'pwo' => $passenc,
    //                             'role' => $this->input->post('role'),
    //                             'status' => $this->input->post('status')
    //                         );
    //                         if ($imgurl != 1) {
    //                             $datauser['foto'] = $imgurl;
    //                         } elseif ($imgurl == 1) {
    //                             $datauser = $datauser;
    //                         } else {
    //                             header('HTTP/1.1 500 Foto Gagal di Upload');
    //                         }

    //                         $updatedat = $this->Altperiod->edit($this->table, $datauser, $cekpass);
    //                         if ($updatedat) {
    //                             echo "Data Berhasil di perbaharui";
    //                         } else {
    //                             header('HTTP/1.1 500 Terjadi Kesalahan');
    //                         }
    //                     } else {
    //                         header('HTTP/1.1 500 Password Baru Kosong');
    //                     }
    //                 } else {
    //                     header('HTTP/1.1 500 Password Salah');
    //                 }
    //             } else if ($this->input->post('pwd1') == null || empty($this->input->post('pwd1'))) {
    //                 $cekuser = array(
    //                     'id_ngota' => $iduser
    //                 );
    //                 $fetuser = $this->Altperiod->get($this->table, $cekuser);
    //                 if ($fetuser) {
    //                     $datauser = array(
    //                         'role' => $this->input->post('role'),
    //                         'status' => $this->input->post('status')
    //                     );
    //                     $imgurl = $this->Altperiod->upload('foto', 300, 300, '75%');
    //                     if ($imgurl != 1) {
    //                         $datauser['foto'] = $imgurl;
    //                     } elseif ($imgurl == 1) {
    //                         $datauser = $datauser;
    //                     } else {
    //                         header('HTTP/1.1 500 Foto Gagal di Upload');
    //                     }
    //                     $updatedat = $this->Altperiod->edit($this->table, $datauser, $cekuser);
    //                     if ($updatedat) {
    //                         echo "Data Berhasil di perbaharui";
    //                     } else {
    //                         header('HTTP/1.1 500 Terjadi Kesalahan');
    //                     }
    //                 } else {
    //                     header('HTTP/1.1 500 User Tidak Ada');
    //                 }
    //             } else {
    //                 header('HTTP/1.1 500 Periksa Data Kembali');
    //             }
    //         } else {
    //             header('HTTP/1.1 500 Terjadi Kesalahan');
    //         }
    //     } else {
    //         $data['datauser'] = $this->Altperiod->get($this->table, $iduser);
    //         $this->load->view('userfolder/edit_user', $data);
    //     }
    // }

    // public function edit($getId)
    // {
    //     $id = encode_php_tags($getId);
    //     $this->_validasi('edit');

    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = "Edit User";
    //         $data['user'] = $this->admin->get('user', ['id_user' => $id]);
    //         $this->template->load('templates/dashboard', 'user/edit', $data);
    //     } else {
    //         $input = $this->input->post(null, true);
    //         $input_data = [
    //             'nama'          => $input['nama'],
    //             'username'      => $input['username'],
    //             'email'         => $input['email'],
    //             'no_telp'       => $input['no_telp'],
    //             'role'          => $input['role']
    //         ];

    //         if ($this->admin->update('user', 'id_user', $id, $input_data)) {
    //             set_pesan('data berhasil diubah.');
    //             redirect('user');
    //         } else {
    //             set_pesan('data gagal diubah.', false);
    //             redirect('user/editUser/' . $id);
    //         }
    //     }
    // }

    public function delete($getId)
    {
        $this->load->model('Admin_model', 'admin');
        $id = encode_php_tags($getId);

        // Ambil email user berdasarkan ID
        $userEmail = $this->admin->getUserEmailById($id);

        // Cek apakah email user adalah 'mfajriaushaf@gmail.com'
        if ($userEmail === 'mfajriaushaf@gmail.com') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User dengan email mfajriaushaf@gmail.com tidak dapat dihapus!</div>');
            redirect('admin/userPosition');
        }

        // Lanjutkan proses penghapusan untuk user selain 'mfajriaushaf@gmail.com'
        if ($this->admin->delete('user', 'id_user', $id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User Berhasil Dihapus</div>');
            redirect('admin/userPosition');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User Gagal Dihapus</div>');
            redirect('admin/userPosition');
        }
    }




    public function toggle($getId)
    {
        $this->load->model('Admin_model', 'admin');
        $id = encode_php_tags($getId);
        $status = $this->admin->get('user', ['id_user' => $id])['is_active'];
        $toggle = $status ? 0 : 1; //Jika user aktif maka nonaktifkan, begitu pula sebaliknya
        $message = $toggle ? 'activated' : 'inactive';

        if ($this->admin->update('user', 'id_user', $id, ['is_active' => $toggle])) {
            // set_pesan($message);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">User has been ' . $message . '</div>');
            // $this->session->set_flashdata($message);
        }
        redirect('admin/userPosition');
    }

    // public function userRole($role_id)
    // {
    //     // $id = encode_php_tags($getId);
    //     $status = $this->admin->getRole();
    //     $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
    //     // $toggle = $status ? 0 : 1; //Jika user aktif maka nonaktifkan, begitu pula sebaliknya
    //     // $message = $toggle ? 'activated' : 'inactive';

    //     // if ($this->admin->update('user', 'id_user', $id, ['is_active' => $toggle])) {
    //     //     // set_pesan($message);
    //     //     $this->session->set_flashdata('message', '<div class="alert 
    //     //     alert-success" role="alert">User has been ' . $message . '</div>');
    //     //     // $this->session->set_flashdata($message);
    //     // }
    //     redirect('admin/userPosition');
    // }

    public function editRole()
    {
        $this->load->model('Admin_model');
        // Ambil data user dari model (contoh: semua user)
        $data['users'] = $this->Admin_model->getAllUsers();

        // Tampilkan view dengan data dropdown
        $this->load->view('admin/userPosition', $data);
    }

    public function updateRole()
    {
        $this->load->model('Admin_model');
        // Ambil data dari form
        $id_user = $this->input->post('id_user');
        $new_role_id = $this->input->post('new_role_id');

        // Update role user di model
        $this->Admin_model->updateUserRole($id_user, $new_role_id);

        // Redirect atau tampilkan pesan sukses
        redirect('admin/userPosition');
    }

    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">New sub menu added!</div>');
            redirect('menu/submenu');
        }
    }
}
