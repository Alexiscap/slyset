<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User_model extends CI_Model
{
    protected $table = 'utilisateur';
    
    public function __construct(){
      parent::__construct();
    }
    
    public function validCredentials($mail, $password){
      $this->load->library('encrypt');

      $password = $this->encrypt->sha1($password);

      $q = "SELECT * FROM utilisateur WHERE mail = ? AND password = ?";

      $data = array($mail, $password);
      $q = $this->db->query($q, $data);

      if($q->num_rows() > 0){
        $r = $q->result();
        $session_data = array('mail' => $r[0]->mail,'logged_in' => true);
        $this->session->set_userdata($session_data);
        return true;
      } else {
        return false;
      }
    }
    
    public function isLoggedIn(){
     if($this->session->userdata('logged_in')){
        return true;
      } else {
        return false;
      }
    }
      
}