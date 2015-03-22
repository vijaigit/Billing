<?php
## To check whether the admin user got logged IN
function adminLoginCheck()
{
    $CI =& get_instance();
    $adminuserid =  $CI->session->userdata('adminid');
    if($adminuserid != 1)
    {
        redirect('admin');
    }
}
## To check whether the  user  logged IN or Not
function sessionCheck()
{
    $CI =& get_instance();
    $adminuserid =  $CI->session->userdata('adminid');
    if($adminuserid == 1)
    {
        redirect('admin/dashboard');
    }
}

##Get hotel name from generalinfo
function get_hotelname()
{
    $CI =& get_instance();
    $CI->db->select('a.value as HOTEL_NAME');
    $CI->db->from('generalinfo a');
    $CI->db->where('a.name','HOTEL_NAME');
    $query = $CI->db->get();
    $result = $query->result_array();
    return $result[0]['HOTEL_NAME'];
}
##Get hotel name from generalinfo
function get_address()
{
    $CI =& get_instance();
    $CI->db->select('a.value as ADDRESS');
    $CI->db->from('generalinfo a');
    $CI->db->where('a.name','ADDRESS');
    $query = $CI->db->get();
    $result = $query->result_array();
    return $result[0]['ADDRESS'];
}

?>