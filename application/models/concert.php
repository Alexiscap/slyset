<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class concert extends CI_Model
{

  
    protected $table = 'concerts';   
    protected $table_people= 'utilisateur';
	protected $table_addresse = 'adresse';

	public function get_user($user_id)
    	{
        return $this->db->select('nom,prenom,login')        				
                        ->from ($this->table_people)
                        ->where(array('id' => $user_id))
                        ->get()
                        ->result();
    	}
	
	public function count()
    	{
        	return $this->db->count_all('concerts');
    	}
    	
    // ----- ----- par artiste
    	
    public function count_artiste_concert($user_id,$date)
    	{
    	 date_default_timezone_set('Europe/Paris');
      	$today = now();
      	$datestring = mdate('%Y-%m-%d %H:%i:00');
      	
        	//ajouter la notion de a venir et passé
		$appel =  $this->db->select('id')        				
                        ->from ('concerts')
                        ->where(array('Utilisateur_id' => $user_id,'date '.$date => $datestring ))
                        ->get();
        return $appel->num_rows();
    	}

    public function get_concert($nb, $first = 0,$user_id,$date)
	{
   		$this->load->helper('date');
		if(!is_integer($nb) OR $nb < 1 OR !is_integer($first) OR $first < 0)
        {
			return false;
        }
        date_default_timezone_set('Europe/Paris');
      	$today = now();
      	$datestring = mdate('%Y-%m-%d %H:%i:00');
      	

		return $this->db->select('concerts.id,Utilisateur_id,Adresse_id,date,titre,seconde_partie,numero_adresse,salle,voie_adresse,ville,code_postal,pays,prix,phone_number,website')        				
                        ->from ('concerts')
                        ->join ('adresse','concerts.Adresse_id=adresse.id')
                        ->where(array('Utilisateur_id' => $user_id,'date '.$date => $datestring ))
                        ->order_by('date','desc')
                        ->limit($nb, $first)
                        ->get()
                        ->result();               
	}
	
	
	//ajouter adresse -> recuperer id adresse pour ajouter dans table concert
	
	public function ajout_concert_data ($ville,$pays,$code_postal,$route,$street_number,$artiste,$snd_partie,$salle,$prix,$heure,$date,$user)
		{
		
  		 $this->db->set(array('ville'=>$ville,'pays'=>$pays,'code_postal'=>$code_postal,'voie_adresse'=>$route,'numero_adresse'=>$street_number))
                		->insert($this->table_addresse);

    	 $last_id_addresse =  $this->db->insert_id();

	
		 $prix = !empty($prix) ? "$prix" : NULL;
    	
    	 $date_concert = $date.' '.$heure.':00';
  		
  		 $this->db->set(array('Utilisateur_id'=>$user,'titre'=>$artiste,'Adresse_id'=>$last_id_addresse,'salle'=>$salle,'seconde_partie'=>$snd_partie,'prix'=>$prix,'date'=>$date_concert))
                ->insert($this->table);
        
    }
    	     
	public function update_concert_data ($ville,$pays,$code_postal,$route,$street_number,$artiste,$snd_partie,$salle,$prix,$heure,$date,$id_concert,$adresse_id)
		{
  			 $date_concert = $date.' '.$heure.':00';

             $data_concert =  array('titre'=>$artiste,'salle'=>$salle,'seconde_partie'=>$snd_partie,'prix'=>$prix,'date'=>$date_concert);
        
        	 $prix = !empty($prix) ? "$prix" : NULL;
  		  	 $this->db->where('id',$id_concert)
                ->update($this->table,$data_concert);
		
			 $data_adresse =  array('ville'=>$ville,'pays'=>$pays,'code_postal'=>$code_postal,'voie_adresse'=>$route,'numero_adresse'=>$street_number);
         
  		  	 $this->db->where('id',$adresse_id)
                ->update($this->table_addresse,$data_adresse);
  		
                  
		}

}