<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class concert extends CI_Model
{
  
    protected $table = 'concerts';

	public function count()
    	{
        	return $this->db->count_all($this->table);
    	}

    public function get_concert($nb, $first = 0)
    {
   
     if(!is_integer($nb) OR $nb < 1 OR !is_integer($first) OR $first < 0)
        {
            return false;
        }
         
    
        return $this->db->select('lieu,ville,titre,date,prix,snd_partie')
        				->where(array('Artiste_id' => 2))
                        ->from($this->table)
                        ->order_by('date','desc')
                        ->limit($nb, $first)
                        ->get()
                        ->result();
    }

    public function ajout_concert ($artiste,$snd_partie,$date_concert,$heure_concert,$salle,$ville,$prix)
    {
    	 if(!is_string($artiste) OR empty($artiste))
        {
            return false;
        }
    
    	
    	 return $this->db->set(array('titre' => $artiste,'Artiste_id'=>3,'lieu'=>$salle,'ville'=>$ville,'snd_partie'=>$snd_partie,'prix'=>$prix))
               // ->set('date', 'NOW()', false)
                ->insert($this->table);
    	}
    
}


/*
   
    public function count()
    {
        return $this->db->count_all($this->table);
    }
     
    public function get_commentaires($nb, $debut = 0)
    {
        if(!is_integer($nb) OR $nb < 1 OR !is_integer($debut) OR $debut < 0)
        {
            return false;
        }
         
        return $this->db->select('`id`, `pseudo`, `message`, DATE_FORMAT(`date`,\'%d/%m/%Y &agrave; %H:%i:%s\') AS \'date\'', false)
                ->from($this->table)
                ->order_by('id', 'desc')
                ->limit($nb, $debut)
                ->get()
                ->result();
    }
}



*/