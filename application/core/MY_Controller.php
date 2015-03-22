<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        
    }
    function adminsection()
    {
        $this->template->title('Bill Admin');
        $this->template->set_partial('header', 'layouts/header');
        $this->template->set_partial('footer', 'layouts/footer');
        $this->template->set_layout('default');
    }
    function usersection()
    {
        $this->template->title('Billing Section');
        $this->template->set_partial('header', 'layouts/Userheader');
        $this->template->set_partial('footer', 'layouts/Userfooter');
        $this->template->set_layout('default');
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */