<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->library('form_validation');
    // }
    public function index()
    {
        $cek = $this->session->userdata('email');
        if ($cek) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user =  $this->db->get_where('user', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                  
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == "1") {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                    Wrong password!
                    </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                This Email has been not activated!
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
        Email is not registed yet!
        </div>');
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
            'is_unique' => 'The email has be registed!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password is not matches!',
            'min_length' => 'Password to short dude!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            // Persiapkan data
            $email = htmlspecialchars($this->input->post('email', true));
            $name = htmlspecialchars($this->input->post('name', true));
            $image = 'default.jpg';
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $role_id = 2;
            $is_active = 0;
            $date_created = time();

            // Memasukan data ke array
            $data = [
                'name' => $name,
                'email' => $email,
                'image' => $image,
                'password' =>  $password,
                'role_id' => $role_id,
                'is_active' => $is_active,
                'date_created' => $date_created

            ];
            // insert data ke tabel user
            $this->db->insert('user', $data);
            // membuat data  user_token
            $token = base64_encode(random_bytes(64));
            // memasukan data ke array
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()

            ];
            // insert data ke tabel user_token
            $this->db->insert('user_token', $user_token);
            // send email untuk verifikasi akun
            $this->_sendEmail($token, 'verify', $email);

            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        We have seen activated method to ' . $email . '!  </div>');
            redirect('auth');
        }
    }
    private function _sendEmail($token, $type, $email)
    {
        $this->load->model('model_menu', 'menu');


        $email = $email;
        $user_email = $this->menu->getIdByEmail($email);


        $id = rtrim(strtr(base64_encode($user_email['id']), '+/', '-_'), '=');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'oneschoolpayment@gmail.com';
        $config['smtp_pass'] = '$4Jipermana';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from('osp@gmail.com', 'One Schoole Payment');
        $this->email->to($email);
        if ($type == 'verify') {
            $this->email->subject('One School Payment Account Verification');
            $this->email->message('Click here to activated your account: <a href="' . base_url() . 'auth/verify?email=' . $email  . '&token=' . urlencode($token) . '">Activated!</a> ');
        } else {
            $this->email->subject('Reset Password OSP');
            $this->email->message('Click here to reset your password: <a href="' . base_url() . 'auth/reset_password/' . $id  . '">Reset!</a> ');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die();
        };
    }
    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        if (!$user) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
            Verification failed!, Wrong email.
            </div>');
            redirect('auth');
        } else {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if (!$user_token) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
            Verification failed!, Wrong token.
            </div>');
                redirect('auth');
            } else {
                if (time() - $user_token['is_active'] < (60 * 60 * 24)) {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                    Verification failed!, Token expired.
                    </div>');
                    redirect('auth');
                } else {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                Veryfication success! , please login.
                </div>');
                    redirect('auth');
                }
            }
        }
    }
    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password ?';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot_password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = htmlspecialchars($this->input->post('email'));

            $user_email = $this->db->get_where('user', ['email' => $email])->result_array();

            if (!$user_email) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                The email is not registed yet!
                </div>');
                redirect('auth');
            } else {
                $this->_sendEmail($user_email, 'reset_password', $email);
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                Please check your email to reset password!
                </div>');
                redirect('auth');
            }
            // $id_email1 = base64_decode($id_email);
            // $id = $this->db->get_where('user', ['id' => $id_email1]);


        }
    }
    public function reset_password($id)
    {
        $id = base64_decode($id);
        $account = $this->db->get_where('user', ['id' => $id])->row_array();
        if (!$account) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
            Your account has been deleted, please register again!
            </div>');
            redirect('auth');
        } else {
            $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
                'matches' => 'Password is not matches!',
                'min_length' => 'Password to short dude!'
            ]);
            $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
            if ($this->form_validation->run() == false) {
                $data['title'] = 'Reset Password';
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/reset_password');
                $this->load->view('templates/auth_footer');
            } else {
                $new_password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $this->db->set('password', $new_password);
                $this->db->where('id', $id);
                $this->db->update('user');
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
            Your password has been reset!, please login.
            </div>');
                redirect('auth');
            }
        }
    }
    public function logout()
    {
        $login = $this->session->userdata('email');
        if (!isset($login)) {
            $this->session->set_flashdata('message', '<div class="alert alert-primary text-center" role="alert">
        Please login first.
            </div>');
            redirect('auth');
        } else {
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('role_id');
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        You has been logout!
        </div>');
            redirect('auth');
            # code...
        }
    }
}
