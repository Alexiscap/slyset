<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    protected $table = 'coverflow';
    
    public function __construct()
    {
        parent::__construct();
        $data = array();
    }
    
    public function get_cover_artistes()
    {
        $query1 = $this->db->query('SELECT artiste_1, artiste_2, artiste_3, artiste_4, artiste_5 FROM coverflow'); 
        foreach ($query1->list_fields() as $field){
            $this->db->select('C.*, U.login AS loginU, U.id AS idU, U.thumb AS thumbU');
            $this->db->from('coverflow AS C');
            $this->db->join('utilisateur U', 'U.login = C.' . "" . $field . "");
    //            $this->db->join('utilisateur U', 'U.login = C.artiste_' . "'" . $cpt . "'");
            $this->db->where('U.type', '2');

    //        $this->db->limit(1);

            $query = $this->db->get();
//                $data[] = $result[0]; 
//            if($query->num_rows() == 1){
                $result[] = $query->result();
    //            return $query->result();
//                $result = $query->result();
//                $data[] = $result[0]; 
//                return $result;
//            } else {
//                $this->form_validation->set_message('pas ok');
//                return false;
//            }
        }
            return $result;
//            print_r($result);
      
//        $query = $this->db->query('SELECT artiste_1, artiste_2, artiste_3, artiste_4, artiste_5 FROM coverflow'); 
//        foreach ($query->list_fields() as $field)
//        {
//            echo $field;
//        }
//        
//        foreach ($query->field_data() as $field)
//        {
//            print_r($field);
//        }
    }
    
    public function insert_artiste($artiste1, $artiste2 = NULL, $artiste3 = NULL, $artiste4 = NULL, $artiste5 = NULL)
    {        
        $data['artiste_1'] = $artiste1;
        $data['artiste_2'] = $artiste2;
        $data['artiste_3'] = $artiste3;
        $data['artiste_4'] = $artiste4;
        $data['artiste_5'] = $artiste5;
        
        $this->db->insert($this->table, $data);
    }
    
    public function update_artiste($artiste1, $artiste2 = NULL, $artiste3 = NULL, $artiste4 = NULL, $artiste5 = NULL)
    {
        $data['artiste_1'] = $artiste1;
        $data['artiste_2'] = $artiste2;
        $data['artiste_3'] = $artiste3;
        $data['artiste_4'] = $artiste4;
        $data['artiste_5'] = $artiste5;
        
        $this->db->update($this->table, $data);
    }
    
//    public function validCredentials($login, $password){
//        $this->load->library('encrypt');
//
//        $password = $this->encrypt->sha1($password);
//
//        $this->db->select('*');
//        $this->db->from('utilisateur');
//        $this->db->where('login = ' . "'" . $login . "'" . ' AND password = ' . "'" . $password . "'");
//        $this->db->limit(1);
//
//        $query = $this->db->get();
//
//        if($query->num_rows() > 0){
//            $r = $query->result();
//            $session_data = array('login' => $r[0]->login, 'logged_in' => true);
//            $this->session->set_userdata($session_data);
//            return true;
//        } else {
//            return false;
//        }
//    }
//    
//    function isLoggedIn(){
//        if($this->session->userdata('logged_in')){
//            return true;
//        } else {
//            return false;
//        }
//    }

    
    
}