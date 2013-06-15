<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perso_model extends CI_Model
{
    protected $table = 'page_personnalise';
    
    public function __construct()
    {
        parent::__construct();
        $data = array();
    }
    
    public function get_perso($user_visited = null)
    {
        $this->db->select('P.*, U.login AS loginU, U.id AS idU');
        $this->db->from('page_personnalise AS P');
        $this->db->join('utilisateur U', 'U.id = P.Utilisateur_id');
        $this->db->where('P.Utilisateur_id', (int) $user_visited);
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1){
//            return $query->result();
            $result = $query->result();
            $data = $result[0]; 
            return $data;
        } else {
            return false;
        }
    }
    
    public function delete_perso()
    {
        return $this->db->where('Utilisateur_id', $this->session->userdata('uid'))->delete($this->table);
    }
    
    public function insert_perso($theme_css, $background = NULL, $repeat = NULL, $couleur1 = NULL, $couleur2 = NULL, $couleur3 = NULL, $couleur4 = NULL)
    {        
        $data['Utilisateur_id'] = $this->session->userdata('uid');
        $data['theme_css'] = $theme_css;
        $data['background'] = $background;
        $data['repeat'] = $repeat;
        $data['couleur1'] = $couleur1;
        $data['couleur2'] = $couleur2;
        $data['couleur3'] = $couleur3;
        $data['couleur4'] = $couleur4;
        
        $this->db->insert($this->table, $data);
    }
    
    public function update_perso($theme_css, $background = NULL, $repeat = NULL, $couleur1 = NULL, $couleur2 = NULL, $couleur3 = NULL, $couleur4 = NULL)
    {
        $data['theme_css'] = $theme_css;
        $data['background'] = $background;
        $data['repeat'] = $repeat;
        $data['couleur1'] = $couleur1;
        $data['couleur2'] = $couleur2;
        $data['couleur3'] = $couleur3;
        $data['couleur4'] = $couleur4;
        
        $this->db->update($this->table, $data, "Utilisateur_id = ".$this->session->userdata('uid'));
    }

}
	