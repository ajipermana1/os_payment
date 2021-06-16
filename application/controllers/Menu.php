<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        }
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

        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Menu Management';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
            $data['menu'] = $this->db->get('user_menu')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $menu = $this->input->post('menu');

            $data = [
                'menu' => $menu
            ];

            $this->db->insert('user_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu has been add!
          </div>');

            redirect('menu');
        }
    }
    public function subMenu()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'url', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->model('model_menu', 'menu');
            $data['title'] = 'Submenu Management';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
            $data['sub_menu'] = $this->menu->getSubMenu();
            $data['menu'] = $this->db->get('user_menu')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $title = $this->input->post('title');
            $menu_id = $this->input->post('menu_id');
            $url = $this->input->post('url');
            $icon = $this->input->post('icon');
            $is_active = $this->input->post('is_active');
            $data = [
                'title' => $title,
                'menu_id' => $menu_id,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];
            $this->db->insert('user_sub_menu', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sub Menu has been add!
          </div>');
            redirect('menu/submenu');
        }
    }
    public function deleteSubMenu($id)
    {
        $this->db->delete('user_sub_menu', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Sub Menu has been delete!
      </div>');
        redirect('menu/submenu');
    }
    public function editSubMenu($id)
    {

        $this->form_validation->set_rules('menu_id', 'Menu Id', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active', 'Active Status', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->model('model_menu', 'menu');
            $data['title'] = 'Edit Sub Menu';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
            $data['sub_menu'] = $this->menu->getSubMenu();
            $data['edit_sub_menu'] = $this->menu->getSubMenuById($id);
            $data['menu'] = $this->db->get('user_menu')->result_array();
            $data['menu_edit'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/edit_submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $menu_id = $this->input->post('menu_id');
            $title = $this->input->post('title');
            $url = $this->input->post('url');
            $icon = $this->input->post('icon');
            $is_active = $this->input->post('is_active');

            $data = [
                'menu_id' => $menu_id,
                'title' => $title,
                'url' => $url,
                'icon' => $icon,
                'is_active' => $is_active
            ];


            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('user_sub_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Sub Menu has been Update!
          </div>');
            redirect('menu/submenu');
        }
    }




    public function delete($id)
    {
        $this->db->delete('user_menu', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
        Menu has been delete!
            </div>');
        redirect('menu');
    }
    public function edit($id)
    {

        $this->form_validation->set_rules('menu_edit', 'Edit Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->model('model_menu', 'menu');
            $data['title'] = 'Edit Menu';
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
            $data['sub_menu'] = $this->menu->getSubMenu();
            $data['menu'] = $this->db->get('user_menu')->result_array();
            $data['menu_edit'] = $this->db->get_where('user_menu', ['id' => $id])->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('menu/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $menu = $this->input->post('menu_edit');

            $this->db->set('menu', $menu);
            $this->db->where('id', $id);
            $this->db->update('user_menu');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Menu has been Update!
          </div>');
            redirect('menu');
        }
    }
}
