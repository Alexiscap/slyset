<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Comptes_model extends CI_Model
{
    protected $table = 'utilisateur';
    
    /**
     *
     * Gestion ADMIN Mélomanes
     * 
    **/
//    public function liste_melos($order, $by)
    public function liste_melos($limit = 20, $offset = 0)
    {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('type = 1')
//                        ->limit($nb, $debut)
//                        ->order_by($order, $by)
                        ->limit($limit, $offset)
                        ->get()
                        ->result();
    }
    
    public function get_melo($melo_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id = ' . "'" . $melo_id . "'");
        $this->db->limit(1);
        
        $query = $this->db->get();

        if($query->num_rows() == 1){
            $result = $query->result();
            $data = $result[0]; 
            return $data;
        } else {
            return false;
        }
    }
        
    public function suspend_melo($melo_id, $etat)
    {
        $data['suspendu'] = $etat;
        
        $this->db->update($this->table, $data, "id = ".$melo_id);
    }
    
    
    public function delete_melo($melo_id)
    {
        return $this->db->where('id', (int) $melo_id)->delete($this->table);
    }
    
    public function multi_delete_melos($array_melos_id)
    {
        return $this->db->where_in('id', $array_melos_id)->delete($this->table);
    }
    
    public function multi_suspend_melos($array_melos_id)
    {
        $data['suspendu'] = 1;
        
        return $this->db->where_in('id', $array_melos_id)
                        ->update($this->table, $data);
    }
    
    public function count_melo($champ = array(), $valeur = null)
    {
        return (int) $this->db->where($champ, $valeur)
                              ->from($this->table)
                              ->count_all_results();
    }
    
    
    /**
     *
     * Gestion ADMIN Musiciens
     * 
    **/
//    public function liste_melos($order, $by)
    public function liste_musiciens($limit = 20, $offset = 0)
    {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('type = 2')
//                        ->limit($nb, $debut)
//                        ->order_by($order, $by)
                        ->limit($limit, $offset)
                        ->get()
                        ->result();
    }
    
    public function get_musicien($musicien_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id = ' . "'" . $musicien_id . "'");
        $this->db->limit(1);
        
        $query = $this->db->get();

        if($query->num_rows() == 1){
            $result = $query->result();
            $data = $result[0]; 
            return $data;
        } else {
            return false;
        }
    }
        
    public function suspend_musicien($musicien_id, $etat)
    {
        $data['suspendu'] = $etat;
        
        $this->db->update($this->table, $data, "id = ".$musicien_id);
    }
    
    
    public function delete_musicien($musicien_id)
    {
        return $this->db->where('id', (int) $musicien_id)->delete($this->table);
    }
    
    public function multi_delete_musiciens($array_musiciens_id)
    {
        return $this->db->where_in('id', $array_musiciens_id)->delete($this->table);
    }
    
    public function multi_suspend_musiciens($array_musiciens_id)
    {
        $data['suspendu'] = 1;
        
        return $this->db->where_in('id', $array_musiciens_id)
                        ->update($this->table, $data);
    }
    
    public function count_musicien($champ = array(), $valeur = null)
    {
        return (int) $this->db->where($champ, $valeur)
                              ->from($this->table)
                              ->count_all_results();
    }
}