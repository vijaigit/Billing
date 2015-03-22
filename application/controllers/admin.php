<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends MY_Controller {

    function __construct() {

        parent::__construct();
        $this->adminsection();
        $this->load->model('login_model', 'login');
    }

## Admin login page

    public function index() {
        ## To check whether the  user  logged IN or Not
        sessionCheck();

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->input->post('submit')):
            if ($this->form_validation->run() == TRUE) {

                $check = $this->login->login_check($_POST['username'], $_POST['password']);
                if (!$check):
                    $this->session->set_userdata('info', 'Invalid Username or Password');
                endif;
                if ($check):
                    $this->session->set_userdata('adminid', 1);
                    redirect('admin/dashboard');
                endif;
            }

        endif;
        $this->template->build('admin_login');
    }

## Admin dashbord page    

    public function dashboard() {

        ##Check whether the admin loggedin
        adminLoginCheck();
        $data['products'] = $this->login->get_allroducts();
        $this->template->build('dashboard', $data);
    }

##To add products

    public function add_product() {
        ##Check whether the admin loggedin
        adminLoginCheck();

        ## Validation
        $this->form_validation->set_rules('pname', 'Product Name', 'required|is_unique[products.productName]');
        $this->form_validation->set_rules('productid', 'Product Id', 'required|is_unique[products.productId]');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->input->post('save')) {

            if ($this->form_validation->run() == TRUE) {
                $date = date('Y-m-d');
                ##Insertion query
                $product = array('addedDate' => $date, 'productName' => $this->input->post('pname'), 'productId' => $this->input->post('productid'), 'price' => $this->input->post('price'), 'status' => $this->input->post('status'));
                $this->db->insert('products', $product);
                $this->session->set_userdata('info', 'Product Inserted Successfully');
                redirect('admin');
            }
        }

        $this->template->build('add_product');
    }

## This function to manage delete,active & Inactive    

    public function action() {
        ##Check whether the admin loggedin
        adminLoginCheck();
        if ($this->input->post('active')) {
            $products = $this->input->post('products');
            ##Update products
            $this->db->set('status', 1);
            $this->db->where_in('id', $products);
            $this->db->update('products');
            $this->session->set_userdata('info', 'Products Updated Successfully');
        }
        if ($this->input->post('inactive')) {
            $products = $this->input->post('products');
            ##Update products
            $this->db->set('status', 0);
            $this->db->where_in('id', $products);
            $this->db->update('products');
            $this->session->set_userdata('info', 'Products Updated Successfully');
        }
        if ($this->input->post('delete')) {
            $products = $this->input->post('products');
            ##Delete products
            $this->db->where_in('id', $products);
            $this->db->delete('products');
            $this->session->set_userdata('info', 'Products Updated Successfully');
        }
        redirect('admin/dashboard');
    }

## To Edit products

    public function edit_products($id = 0) {
      error_log("inside");
        ##Check whether the admin loggedin
        adminLoginCheck();
        $data['productid'] = $id;
        ## Validation
        $data['details'] = $this->login->get_productDetail($id);
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->input->post('save')) {

            if ($this->form_validation->run() == TRUE) {
                ##Update query
                $product = array('productName' => $this->input->post('pname'), 'productId' => $this->input->post('productid'), 'price' => $this->input->post('price'), 'status' => $this->input->post('status'));
                $this->db->where('id', $this->input->post('pidhidden'));
                $this->db->update('products', $product);
                $this->session->set_userdata('info', 'Product Updated Successfully');
                redirect('admin/dashboard');
            }
        }
        $this->template->build('edit_product', $data);
    }

## Check uniqueness when editing the productid and name

    public function checkUnique() {
        $pname = isset($_REQUEST['pname'])?$_REQUEST['pname']:'';
        $pid = isset($_REQUEST['pid'])?$_REQUEST['pid']:'';
        if ($pname != '') {
            $this->db->select('*');
            $this->db->where('productName', $pname);
            $query = $this->db->get('products');
            $result = $query->num_rows();
            echo $result;
        }
        if ($pid != '') {
            $this->db->select('*');
            $this->db->where('productId', $pid);
            $query = $this->db->get('products');
            $result = $query->num_rows();
            echo $result;
        }
    }
    
## To save general settings

public function general_settings()
{
    ##Check whether the admin loggedin
    adminLoginCheck();
    if($this->input->post('save'))
    {
        $this->db->set('value',  $this->input->post('hname'));
        $this->db->where('name','HOTEL_NAME');
        $this->db->update('generalinfo');
        $this->db->set('value',  $this->input->post('address'));
        $this->db->where('name','ADDRESS');
        $this->db->update('generalinfo');
        $this->session->set_userdata('info','Settings updated successfully');
    }
    
    
    ## GEt general setting data
    $this->db->select('a.value as HOTEL_NAME,b.value as ADDRESS');
    $this->db->from('generalinfo a');
    $this->db->from('generalinfo b');
    $this->db->where('a.name','HOTEL_NAME');
    $this->db->where('b.name','ADDRESS');
    $query = $this->db->get();
    $data['datas'] = $query->result_array();
    $this->template->build('general_settings', $data);
}    

##Logout

    public function logout() {
        $this->session->sess_destroy();
        redirect('admin');
    }

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */