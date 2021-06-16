<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $login = $this->session->userdata('email');

        if (!isset($login)) {
            $this->session->set_flashdata('message', '<div class="alert alert-primary text-center" role="alert">
        Please login first.
            </div>');
            redirect('auth');
        }
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $name = $this->input->post('name');
            // cek apa ada image
            $uploud_image = $_FILES['image']['name'];

            if ($uploud_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';


                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }


            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                    Your profile has been edited!
                    </div>');
            redirect('user');
        }
    }
    public function info_tu()
    {
        $data['title'] = 'Info TU';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['info'] = $this->db->get('info_tu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/info_tu', $data);
        $this->load->view('templates/footer');
    }
    public function sp_card()
    {


        $data['title'] = 'SP Card';
        $userdata = $this->session->userdata();
        $this->load->model('Model_user', 'user');
        $nisn = $this->user->get_nisn($userdata['email']);



        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['info'] = $this->db->get('info_tu')->result_array();
        $data['kartu'] = $this->db->get_where('kartu_spp', ['nisn' => $nisn['nisn']])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/sp_card', $data);
        $this->load->view('templates/footer');
    }
    public function pay($id)
    {
        $data['title'] = 'SP Card';
        $this->load->model('Model_user', 'user');
        $email = $this->session->userdata('email');
        $nisn = $this->user->get_nisn($email);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['id_spp'] = $id;

        $data['detail_pay'] = $this->user->get_detailPay($id, $nisn['nisn']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/pay', $data);
        $this->load->view('templates/footer');
    }
}
