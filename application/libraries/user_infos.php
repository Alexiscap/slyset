<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class User_infos
{
    private $obj = null;

    function User_infos()
    {
        $this->obj =& get_instance();
    }

    function basic_user_validation()
    {
        // Not logged in, then redirect to the Home Page.
        if(!$this->obj->session->userdata('logged_in'))
            redirect('');
    }

}