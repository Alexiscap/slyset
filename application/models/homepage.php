<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class homepage extends CI_Model
{
  
    protected $table = 'concerts';

    public function get_concert()
    {
<<<<<<< HEAD
        return $this->db->select('date,titre,salle,Utilisateur_id,salle,ville,concerts.id,seconde_partie')
                        ->from($this->table)
                        ->join ('adresse','concerts.Adresse_id=adresse.id')
                        ->group_by('date')
                        ->get()
                        ->result();
    }
    
      public function get_date()
    {
        return $this->db->select('date')
=======
        return $this->db->select('date','titre')
>>>>>>> 46018ed70d5ff61218de51e00fde1110341177e7
                        ->from($this->table)
                        ->join ('adresse','concerts.Adresse_id=adresse.id')
                        ->group_by('date')
                        ->get()
                        ->result();
    }
    
}