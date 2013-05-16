<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class User_authentication
{
    private $obj = null;

    function User_authentication()
    {
        $this->obj =& get_instance();
    }

    function basic_user_validation()
    {
        // Not logged in, then redirect to the Home Page.
        if(!$this->obj->session->userdata('logged_in'))
            redirect('');
    }

    function musicien_user_validation()
    {
        // Not logged in and have right member access, then redirect to the Home Page.
        // If it's a melomane (1) account, it's not a anonym, melomane or admin
        if($this->obj->session->userdata('account') == 1)
            redirect('');
    }

    function admin_user_validation()
    {
        // Not logged in and have right member access, then redirect to the Home Page.
        // If it's not a admin (0) account
        if($this->obj->session->userdata('account') != 0)
            redirect('');
    }

}