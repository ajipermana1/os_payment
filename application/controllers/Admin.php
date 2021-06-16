<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_user','user');
        $this->load->library('excel');
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
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['info'] = $this->db->get('info_tu')->result_array();
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|min_length[3]');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $info_buka = $this->input->post('info_buka');
            $keterangan = $this->input->post('keterangan');
            $info_keramaian = $this->input->post('info_keramaian');

            $dt = [
                'butup' => $info_buka,
                'keramaian' => $keterangan,
                'status' => $info_keramaian


            ];
            $this->db->set($dt);
            $this->db->where('id', 1);

            $update =  $this->db->update('info_tu');

            if ($update) {

                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
              Info TU berhasil diupdate!
                   </div>');
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
               Info TU gagal diupdate!
                    </div>');
                redirect('admin');
            }
        }
    }
    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required|trim');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $role = $this->input->post('role');

            $data = [
                'role' => $role
            ];

            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        Role has been add!
            </div>');
            redirect('admin/role');
        }
    }
    public function role_acces($id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['role_acces'] = $this->db->get_where('user_role', ['id' => $id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/role_acces', $data);
        $this->load->view('templates/footer');
    }
    public function role_delete($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        Role has been delete!
            </div>');
        redirect('admin/role');
    }
    function changeAccess()
    {
        $role_id = $this->input->post('roleId');
        $menu_id =  $this->input->post('menuId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_acces_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_acces_menu', $data);
        } else {
            $this->db->delete('user_acces_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
        Access changed!
            </div>');
    }
    public function user_list()
    {


        $data['title'] = 'User List';
        $data['user_list'] = $this->user->getAllUser();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $email = $this->session->userdata('email');
        $data['info_user'] = $this->user->get_infoUser($email);

        // $data['role_acces'] = $this->db->get_where('user_role', ['id' => $id])->row_array();
        // $this->db->where('id !=', 1);
        // $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'The email has be registed!'
        ]);
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password is not matches!',
            'min_length' => 'Password to short dude!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/user_list', $data);
            $this->load->view('templates/footer');
        } else {
            $email = htmlspecialchars($this->input->post('email', true));
            $name = htmlspecialchars($this->input->post('name', true));
            $image = 'default.jpg';
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $role_id = base64_decode($this->input->post('role_id'));
            $is_active = $this->input->post('is_active');
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

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
            User has been add! 
            </div>');
            redirect('admin/user_list');
        }
    }
    public function user_detail($id)
    {
        $data['title'] = 'User List';
        $data['user_list'] = $this->user->getAllUser();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['detail_user'] = $this->user->get_detailUser($id);
        $data['user_id'] = $id;
        $nisn = $this->user->get_nisnId($id);
        $data['kartu'] = $this->db->get_where('kartu_spp', ['nisn' => $nisn['nisn']])->result_array();
        $this->form_validation->set_rules('nama','Nama','required|trim');
         $this->form_validation->set_rules('bsr_iuran','Besar Iuran','required|trim');
          $this->form_validation->set_rules('tenggat','Tenggat','required|trim');
        
        if($this->form_validation->run() == false){
            
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('admin/user_detail', $data);
        $this->load->view('templates/footer');
        }else{
            $nisn = $nisn['nisn'];
            $nama = $this->input->post('nama');
            $besar_iuran = $this->input->post('bsr_iuran');
            $tenggat = $this->input->post('tenggat');
            $status = 'Belum';
            $order_id = NULL;
            
            $data = [
                'nisn' => $nisn,
                'nama' => $nama,
                'besar_iuran' => $besar_iuran,
                'tenggat' => $tenggat,
                'status' => $status,
                'order_id' => $order_id
                ];
                
                $add = $this->db->insert('kartu_spp',$data);
                if($add){
                     $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                Pembayaran telah ditambahkan! 
                </div>');
                redirect('admin/user_detail/' . $id);
                    
                }else{
                     $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                Gagal menambah pembayaran! 
                </div>');
                redirect('admin/user_detail/' . $id);
                }
            
            
        }
    }
    public function edit_pay($id){
         $data['title'] = 'User List';
        $data['user_list'] = $this->user->getAllUser();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['pay_info'] = $this->db->get_where('kartu_spp',['id' =>$id])->row_array();
        $data['user_id'] = $id;

        $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('besar_iuran', 'Besar Iuran', 'required|trim');
        $this->form_validation->set_rules('tenggat', 'Tenggat', 'required');

        if ($this->form_validation->run() == false) {


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/edit_pay', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama');
            $besar_iuran = $this->input->post('besar_iuran');
            $tenggat = $this->input->post('tenggat');

            $dt = [
                'nama' => $nama,
                'besar_iuran' => $besar_iuran,
                'tenggat' => $tenggat

            ];

            $this->db->set($dt);
            $this->db->where('id', $id);
            $update = $this->db->update('kartu_spp');
            if ($update) {
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
               Data pembayaran telah diupdate! 
                </div>');
                redirect('admin/user_list');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                Gagal mengupdate data! 
                </div>');
                redirect('admin/user_list');
            }
        }
        
    }
    public function delete_pay($id){
       $this->db->delete('kartu_spp', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-info text-center" role="alert">
            Data telah Dihapus!
                </div>');
        redirect('admin/user_list');
    }
   
    public function edit_user($id)
    {
        $data['title'] = 'User List';
        $data['user_list'] = $this->user->getAllUser();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata['email']])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['user_ingfo'] = $this->user->getUser_id($id);

        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]|trim');
        $this->form_validation->set_rules('role_id', 'Role_id', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == false) {


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/user_edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $role_id = $this->input->post('role_id');
            $email = $this->input->post('email');

            $dt = [
                'name' => $name,
                'role_id' => $role_id,
                'email' => $email

            ];

            $this->db->set($dt);
            $this->db->where('id', $id);
            $update = $this->db->update('user');
            if ($update) {
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                User has been update! 
                </div>');
                redirect('admin/user_list');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                Failed to Update! 
                </div>');
                redirect('admin/user_list');
            }
        }
    }
    public function import_excel()
    {
        $file = $_FILES['excel']['name'];
        if (!isset($file)) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger text-center" role="alert">
            ' . $this->upload->display_errors() .
                    ' </div>'
            );
            redirect('admin/user_list');
        } else {
            $path = $file;
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $image = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $password = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $role_id = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $is_active = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $date_created = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $temp_data[] = array(
                        'name'    => $name,
                        'email'    => $email,
                        'image'    => $image,
                        'password' => $password,
                        'role_id' => $role_id,
                        'is_active' => $is_active,
                        'date_created' => $date_created
                    );
                }
            }

            $insert = $this->user->insertByExcel($temp_data);
            if ($insert) {
                $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                User has been add by excel! </div>');
                redirect('admin/user_list');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
                ' . $this->upload->display_errors() . '     </div>');
                redirect('admin/user_list');
            }
        }
    }
    public function importExcel()
    {

        $fileName = $_FILES['excel']['name'];


        $config['upload_path'] = './assets/office_excel/'; //path upload
        $config['file_name'] = $fileName;  // nama file
        $config['allowed_types'] = 'xls|xlsx|csv'; //tipe file yang diperbolehkan
        $config['max_size'] = 30000; // maksimal sizze

        $this->load->library('upload'); //meload librari upload
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('excel')) {

            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center" role="alert">
         ' . $this->upload->display_errors() . '
            </div>');
            redirect('admin/user_list');
        }

        $inputFileName = './assets/office_excel/' . $fileName;

        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            for ($row = 2; $row <= $highestRow; $row++) {
                $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $image = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $password = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                $role_id = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $is_active = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                $date_created = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                $temp_data[] = array(
                    'name'    => $name,
                    'email'    => $email,
                    'image'    => $image,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role_id' => $role_id,
                    'is_active' => $is_active,
                    'date_created' => $date_created
                );
            }
        }

        // Sesuaikan key array dengan nama kolom di database     password_hash($this->input->post('password1'), PASSWORD_DEFAULT)                                                    
        // $data = array(
        //     "name" => $rowData[0][1],
        //     "email" => $rowData[0][2],
        //     "image" => $rowData[0][3],
        //     "password" => password_hash($rowData[0][4], PASSWORD_DEFAULT),
        //     "role_id" => $rowData[0][5],
        //     "is_active" => $rowData[0][6],
        //     "date_created" => $rowData[0][7]
        // );

        $insert = $this->user->insertByExcel($temp_data);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-center" role="alert">
                User has been add by excel!
                </div>');
        redirect('admin/user_list');
    }
    public function delete_user($id)
    {
        $this->db->delete('user', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-info text-center" role="alert">
            User has been delete!
                </div>');
        redirect('admin/user_list');
    }
}
