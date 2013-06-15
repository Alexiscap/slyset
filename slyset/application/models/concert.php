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
    	 $snd_partie = !empty($snd_partie) ? "$snd_partie" : NULL;

    	 $date_concert = $date.' '.$heure.':00';
  		
  		 $this->db->set(array('Utilisateur_id'=>$user,'titre'=>$artiste,'Adresse_id'=>$last_id_addresse,'salle'=>$salle,'seconde_partie'=>$snd_partie,'prix'=>$prix,'date'=>$date_concert))
                ->insert($this->table);
        
    }
    	     
	public function update_concert_data ($ville,$pays,$code_postal,$route,$street_number,$artiste,$snd_partie,$salle,$prix,$heure,$date,$id_concert,$adresse_id)
		{
  			 $date_concert = $date.' '.$heure;
  			 
  			         	
  			 $prix = !empty($prix) ? "$prix" : NULL;
    		 $snd_partie = !empty($snd_partie) ? "$snd_partie" : NULL;


             $data_concert =  array('titre'=>$artiste,'salle'=>$salle,'seconde_partie'=>$snd_partie,'prix'=>$prix,'date'=>$date_concert);
        
  		  	 $this->db->where('id',$id_concert)
                ->update($this->table,$data_concert);
		
			 $data_adresse =  array('ville'=>$ville,'pays'=>$pays,'code_postal'=>$code_postal,'voie_adresse'=>$route,'numero_adresse'=>$street_number,'phone_number'=>$phone,'website'=>$website);
         
  		  	 $this->db->where('id',$adresse_id)
                ->update($this->table_addresse,$data_adresse);
  		
                  
		}
		
		public function delete_concert_data($id_concert,$id_adresse)
	
	{
	
		$this->db->where('id', $id_concert)
				 ->delete('concerts'); 
		
		$this->db->where('id', $id_adresse);
		$this->db->delete('adresse'); 
	}
	
	public function add_activity($id_concert,$uid)
	{
	 $this->db->set(array('Utilisateur_id'=>$uid,'Concerts_id'=>$id_concert))
                		->insert('concerts_activite');
                		
    return $this->returnMarkup($id_concert);


	}
	
	        
    private function returnMarkup($id_concert)
    {         
   return '<a id="'.$id_concert.'" href="#" class="noparticiper"><span class="button_left"></span><span  class="button_center">Je n\'y vais plus</span><span class="button_right"></span></a>';
                
          /*    return  '<div class="comm">
						<img src="'.img_url('common/del.png').'" class="del"/>
    					<img src="'.img_url('common/avatar_comm.png').' />
      					<p class="name_comm"> Jim Morrison</p>
      					<p class="commentaire">'.$comment.'</p> 
    				</div>';
    				*/
    }
    
	
	public function delete_activity($id_concert,$uid)
	{
	 $data_delete_act = array('Utilisateur_id'=>$uid,'Concerts_id'=>$id_concert); 
	 $this->db->delete('concerts_activite', $data_delete_act); 


	}
	
	public function get_activity($user_id)
	{
	 return $this->db->select('Concerts_id')        				
                        ->from ('concerts_activite')
                        ->where(array('Utilisateur_id' => $user_id))
                        ->get()
                        ->result();
    	
	}

}