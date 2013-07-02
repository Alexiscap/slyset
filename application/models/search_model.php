<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Search_model extends CI_Model
{
    protected $table = 'utilisateur';
    
    public function search($keyword)
    {
        $this->db->like('login', $keyword);
        $query = $this->db->get($this->table);
        return $query->result();
    }
}