<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class concert extends CI_Model
{
  
    protected $table = 'concerts';
	protected $table_addresse = 'adresse';


	public function count()
    	{
        	return $this->db->count_all('concerts');
    	}

    public function get_concert($nb, $first = 0)
    {
   
     if(!is_integer($nb) OR $nb < 1 OR !is_integer($first) OR $first < 0)
        {
            return false;
        }

        return $this->db->select('Utilisateur_id,Adresse_id,date,titre,seconde_partie,numero_adresse,salle,voie_adresse,ville,code_postal,pays,prix')        				
                        ->from ('concerts')
                        ->join ('adresse','concerts.Adresse_id=adresse.id')
                        ->where(array('Utilisateur_id' => 1))
                        ->order_by('date','asc')
                        ->limit($nb, $first)
                        ->get()
                        ->result();
	}
	
	
//ajouter adresse -> recuperer id adresse pour ajouter dans table concert
    public function ajout_adresse ($ville,$pays,$code_postal,$route,$street_number)
    {
    	
  		return $this->db->set(array('ville'=>$ville,'pays'=>$pays,'code_postal'=>$code_postal,'voie_adresse'=>$route,'numero_adresse'=>$street_number))
                		->insert($this->table_addresse);
    }
    
    public function ajout_concert($artiste,$snd_partie,$date,$heure,$salle,$prix)
        {

  		return $this->db->set(array('Utilisateur_id'=>3,'titre'=>$artiste,'Adresse_id'=>2,'salle'=>$salle,'seconde_partie'=>$snd_partie,'prix'=>$prix))
                ->insert($this->table);
    	}
    
}
