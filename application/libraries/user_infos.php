<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class User_infos
{
    private $obj = null;
    private $data = array();

    public function User_infos()
    {
        $this->obj =& get_instance();
        $this->obj->load->model('user_model');
    }

    public function uri_user()
    {
//         Not logged in, then redirect to the Home Page.
//        if(!$this->obj->session->userdata('logged_in'))
//            redirect('');
      
        if($this->obj->uri->segment(2) === FALSE && !is_numeric($this->obj->uri->segment(2))){
            $user_id = NULL;
        } else {
            $user_id = $this->obj->uri->segment(2);
//            $this->profile_user($user_id);
            
            return true;
        }
        
        return false;
    }
    
    public function profile_user($user_id){
//        $user_id = $this->uri_user();
        $profile = $this->obj->user_model->getUser($user_id);
//        return $profile = $profile_infos[0];
        return $profile;
//        echo $test;
//        echo $profile[0]->$stdclass;
//        print_r($profile);
    }

}