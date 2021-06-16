<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_menu extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT user_sub_menu . * , user_menu . menu
       FROM user_sub_menu JOIN user_menu 
       ON user_sub_menu . menu_id = user_menu . id
       ";
        return $this->db->query($query)->result_array();
    }

    public function getSubMenuById($id)
    {
        $query = "SELECT user_sub_menu . * , user_menu . menu
       FROM user_sub_menu JOIN user_menu 
       ON user_sub_menu . menu_id = user_menu . id
       WHERE user_sub_menu . id = $id
       ";
        return $this->db->query($query)->row_array();
    }

    public function getIdByEmail($email)
    {
        $query = "SELECT id FROM user WHERE email='$email'";
        return  $this->db->query($query)->row_array();
    }
    public function getEmailByToken($token)
    {
        $query = "SELECT email FROM `user_token` 
       WHERE token = '$token'
       ";
        return $this->db->query($query)->row_array();
    }
}
