<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class News_model extends CI_Model
{
    protected $table = 'sl_news';
    
    public function ajouter_news($auteur, $titre, $contenu)
    {
        $this->db->set('auteur',  $auteur);
        $this->db->set('titre',   $titre);
        $this->db->set('contenu', $contenu);
         
        $this->db->set('date_ajout', 'NOW()', false);
        $this->db->set('date_modif', 'NOW()', false);
         
        return $this->db->insert($this->table);
    }
    
    public function editer_news($id, $titre = null, $contenu = null)
    {
      if($titre == null AND $contenu == null)
      {
          return false;
      }

      if($titre != null)
      {
          $this->db->set('titre', $titre);
      }
      if($contenu != null)
      {
          $this->db->set('contenu', $contenu);
      }

      $this->db->set('date_modif', 'NOW()', false);
      $this->db->where('id', (int) $id);
      
      return $this->db->update($this->table);
    }
    
    public function supprimer_news($id)
    {
      return $this->db->where('id', (int) $id)->delete($this->table);
    }
    
    public function count($where = array())
    {
      return (int) $this->db->where($where)
                            ->count_all_results($this->table);      
    }
    
    public function liste_news($nb = 10, $debut = 0)
    {
      return $this->db->select('*')
                      ->from($this->table)
                      ->limit($nb, $debut)
                      ->order_by('id', 'desc')
                      ->get()
                      ->result();
    }
}