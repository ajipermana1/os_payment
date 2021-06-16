<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{

    public function getAllUser()
    {
        $query = "SELECT user.id, user.role_id ,user.name, user.email, user.image, user_role.role FROM user INNER JOIN user_role ON user.role_id = user_role.id

        ";

        return $this->db->query($query)->result_array();
    }
    public function insertByExcel($data)
    {
        $insert =  $this->db->insert_batch('user', $data);
        if ($insert) {
            return true;
        }
    }
    public function get_user()
    {
        return $this->db->get('user')->result();
    }
    public function get_nisn($email)
    {
        $query = "SELECT nisn FROM user WHERE user.email = '$email' ";
        return $this->db->query($query)->row_array();
    }
    public function get_infoUser($email)
    {
        $query = "SELECT user.name , user.email, user_role.role , user.date_created FROM user INNER JOIN user_role ON user.role_id = user_role.id WHERE user.email = '$email' ";
        return $this->db->query($query)->row_array();
    }
    public function getUser_id($id)
    {
        $query = "SELECT user.id, user.role_id, user.nisn , user.name, user_role.role ,user.email FROM user INNER JOIN user_role ON user.role_id = user_role.id WHERE user.id = '$id' ";
        return $this->db->query($query)->row_array();
    }
    public function get_detailUser($id)
    {
        $query = "SELECT user.id, user.role_id, user.nisn , user.name, user.date_created,user_role.role ,user.email FROM user INNER JOIN user_role ON user.role_id = user_role.id WHERE user.id = '$id' ";
        return $this->db->query($query)->row_array();
    }
    public function get_detailPay($id, $nisn)
    {
        $query = "SELECT user.id, user.nisn, user.name , user.kelas, user.email, kartu_spp.nama,kartu_spp.besar_iuran,kartu_spp.status FROM user INNER JOIN kartu_spp ON user.nisn = kartu_spp.nisn WHERE kartu_spp.id = $id AND user.nisn = $nisn
        ";
        return $this->db->query($query)->row_array();
    }
    public function updateStatus($nisn,$order_id){
       $status = [
           'status' => 'Lunas'
           ];
           $this->db->update('kartu_spp',$status,['order_id' => $order_id]);
        return $query;
        
    }
    public function get_nisnId($id){
        
        $query = "SELECT nisn FROM user WHERE user.id = '$id' ";
        return $this->db->query($query)->row_array();
        
    }
}
