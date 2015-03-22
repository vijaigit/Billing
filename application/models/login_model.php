<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_model
 *
 * @author Udhay
 */
class login_model extends CI_Model {

    //put your code here
## check login credentials
    public function login_check($username = '', $password = '') {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

## Get all the products
    public function get_allroducts() {
        $this->db->select('*');
        $this->db->from('products');
        $query  = $this->db->get();
        return $query->result_array();
    }
## GEt product detail
    public function get_productDetail($id) {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id',$id);
        $query  = $this->db->get();
        return $query->result_array();
    }
}
