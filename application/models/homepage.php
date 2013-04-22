<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class homepage extends CI_Model
{
  
    protected $table = 'concerts';

    public function get_concert()
    {
        return $this->db->select('date')
                        ->from($this->table)
                        ->get()
                        ->result();
    }
    
}