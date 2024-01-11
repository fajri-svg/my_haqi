<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //kalau validasinya sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        //kalau usernya ada
        if ($user) {
            //kalau user active
            if ($user['is_active'] == 1) {
                //cek pass
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id_user' => $user['id_user']
                    ];
                    $this->session->set_userdata($data);
                    // print_r($data);
                    // die;

                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else if ($user['role_id'] == 2) {
                        redirect('user');
                    } else if ($user['role_id'] == 3) {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert 
                    alert-danger" role="alert">Wrong password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">This email has not ben activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert 
            alert-danger" role="alert">Email is not registerd!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            //siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Congratulation! your account has been created. Please activate your account</div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'     => 'smtp', // you can use 'mail' instead of 'sendmail or smtp'
            'smtp_host'    => 'smtp.googlemail.com', // you can use 'smtp.googlemail.com' or 'smtp.gmail.com' instead of 'ssl://smtp.googlemail.com'
            'smtp_user'    => 'myhaqibot@gmail.com', // client email gmail id
            'smtp_pass'    => 'waow weah kpol rmjt', // client password
            'smtp_port'    =>  465,
            'smtp_crypto'  => 'ssl',
            // 'smtp_timeout' => '5',
            'mailtype'     => 'html',
            'charset'      => 'utf-8',
            'newline'      => "\r\n",
            // 'wordwrap'     => TRUE,
            // 'validate'     => FALSE
        ];
        $this->load->library('email', $config);
        $this->email->initialize($config); // intializing email library, whitch is defiend in system

        $this->email->set_newline("\r\n"); // comuplsory line attechment because codeIgniter interacts with the SMTP server with regards to line break

        // $from_email = $this->input->post('f_email'); // sender email, coming from my view page 
        // $to_email = $this->input->post('email'); // reciever email, coming from my view page
        //Load email library

        $this->email->from('myhaqibot@gmail.com', 'HAQI');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a 
            href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');  // we can use html tag also beacause use $config['mailtype'] = 'HTML'
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a 
            href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');  // we can use html tag also beacause use $config['mailtype'] = 'HTML'

        }
        //Send mail
        if ($this->email->send()) {
            return true;
            // $this->session->set_flashdata("email_sent", "Congragulation Email Send Successfully.");
            // echo "email_sent";
        } else {
            // echo "email_not_sent";
            echo $this->email->print_debugger();
            die;  // If any error come, its run
        }

        // $config = [
        //     'protocol'   => 'smtp',
        //     'smtp_host'  => 'smtp.gmail.com',
        //     // '_smtp_auth'   => true,
        //     'smtp_user'  => 'myhaqibot@gmail.com',
        //     'smtp_pass'  => 'waow weah kpol rmjt',
        //     // 'SMTPSecure' => PHPMailer::ENCRYPTION_SMTPS,
        //     'smtp_port'  => 465,
        //     // 'mailtype'   => 'html', //or text
        //     'crlf'       => "\r\n",
        //     // 'charset'    => 'utf-8',
        //     'newline'    => "\r\n"
        // ];

        // $this->load->library('email', $config);
        // $this->email->initialize($config);

        // $this->email->from('myhaqibot@gmail.com', 'Haqi-bot');
        // $this->email->to('mfajriaushaf@gmail.com');
        // $this->email->subject('Testing');
        // $this->email->message('Hello');

        // if ($this->email->send()) {
        //     return true;
        // } else {
        //     echo $this->email->print_debugger();
        //     die;
        // }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert 
                    alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert 
                    alert-danger" role="alert">Account activation failed! token expired</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Account activation failed! token invalid</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert 
            alert-danger" role="alert">Account activation failed! wrong email</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert 
        alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = 'Access Blocked';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        // $this->load->view('templates/topbar', $data);
        $this->load->view('auth/blocked', $data);
        // $this->load->view('templates/footer');
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgotpassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            //ambil 2 kondisi
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                // $this->db->insert('user_token', $user);
                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert 
                alert-success" role="alert">Please check your email to reser your password!</div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Email not registered or activated!</div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Reset password failed! token invalid.</div>');
                redirect('auth/forgotpassword');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert 
            alert-danger" role="alert">Reset password failed! wrong email.</div>');
            redirect('auth/forgotpassword');
        }
    }

    public function changePassword()
    {
        //validasi reset pass hrus lewat email
        if (!$this->session->userdata('reset_email')) {
            redirect('auth/forgotpassword');
        }
        $token = $this->input->get('token');
        $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
        $email = $this->session->userdata('reset_email');

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            if (time() - $user_token['date_created'] < (60 * 60 * 3)) {
                $data['title'] = 'Change Password';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/changepassword');
                $this->load->view('templates/auth_footer');
            } else {
                $this->db->delete('user_token', ['email' => $email]);

                $this->session->set_flashdata('message', '<div class="alert 
                alert-danger" role="alert">Account activation failed! token expired</div>');
                redirect('auth');
            }
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);


            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->db->delete('user_token', ['email' => $email]);

            //hapus session
            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert 
            alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('auth');
        }
    }
}
