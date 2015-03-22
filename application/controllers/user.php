<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Udhay
 */
class user extends MY_Controller {

    //put your code here
    function __construct() {

        parent::__construct();
        $this->usersection();
        $this->load->model('login_model', 'login');
    }

    function index() {
        if ($this->input->post('pay') && !empty($_POST)) {
            $data = $_POST;
            extract($data);
            $productid = array_filter($productid);
            foreach ($productid as $key => $val) {
                $product = array('productId' => $productid[$key], 'quantity' => $quantity[$key], 'total' => $total[$key], 'date' => date("Y-m-d"));
                $this->db->insert('reports', $product);
            }
            $html = $this->load->view('front/print', $_POST, TRUE);
            include_once('dompdf/dompdf_config.inc.php');
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream("bill.pdf", array("Attachment" => 0));
        } else {
            $this->template->build('front/home');
        }
    }

##Toget Product name from id

    public function getProductid() {
        $pid = isset($_REQUEST['pid']) ? $_REQUEST['pid'] : '';
        $pname = isset($_REQUEST['pname']) ? $_REQUEST['pname'] : '';
        if ($pid != "") {
            $this->db->select('productName,price');
            $this->db->where('productId', $pid);
            $query = $this->db->get('products');
            $result = $query->row_array();
            if ($query->num_rows() > 0):
                echo $result['productName'] . '####' . $result['price'];
            endif;
        }
        if ($pname != "") {
            $this->db->select('productId,price');
            $this->db->where('productName', $pname);
            $query = $this->db->get('products');
            $result = $query->row_array();
            if ($query->num_rows() > 0):
                echo $result['productId'] . '####' . $result['price'];
            endif;
        }
    }

## Auto complete function to suggest the product name while typing

    public function autocomplete() {
        if ($_GET['type'] == 'product') {
            $result = mysql_query("SELECT productId FROM bill_products where productId LIKE '" . $_GET['name_startsWith'] . "%'");
            $data = array();
            while ($row = mysql_fetch_array($result)) {
                array_push($data, $row['productId']);
            }
            echo json_encode($data);
        }
        if ($_GET['type'] == 'productname') {
            $result = mysql_query("SELECT productName FROM bill_products where productName LIKE '" . $_GET['name_startsWith'] . "%'");
            $data = array();
            while ($row = mysql_fetch_array($result)) {
                array_push($data, $row['productName']);
            }
            echo json_encode($data);
        }
    }

## To Generate excel daily reports

    public function daily_reports() {

        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('products');
        $this->db->join('reports', 'products.productId = reports.productId');
        $this->db->where('reports.date', $today);
        $query = $this->db->get();
        $result = $query->result_array();
        $data['value'] = $result;

        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=" . $today . ".xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        $content = $this->load->view('front/reports', $data, true);
        echo $content;
        exit;
    }

## To proceed the print page

    public function proceed() {
        $data = $_POST;
        extract($data);
        $error = "";
        $productid = array_filter($productid);
        foreach ($productid as $key => $val) {
            $pricetemp = $price[$key] + $quantity[$key];
            $totaltemp = $total[$key];
            if ($total[$key] != $totaltemp) {
                $error = "Wrong Entry,.Please Resubmit the Form";
                $this->session->set_userdata('error', $error);
            }
        }
        if ($error == "") {
            $html = $this->load->view('front/print', $_POST, TRUE);
            include_once('dompdf/dompdf_config.inc.php');
            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->set_paper("a4", "portrait");
            $dompdf->render();
            $dompdf->stream("bill.pdf", array("Attachment" => 0));
        }
        redirect('user');
        //$this->load->view('front/print', $_POST);
        /*
          $pdf_filename = 'report.pdf';
          $this->load->library('dompdf_lib');
          $this->dompdf_lib->convert_html_to_pdf($html, $pdf_filename, true);
         * 
         */
    }

}
