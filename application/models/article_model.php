<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Article_model extends CI_Model
{
    protected $table = 'articles';
    
    public function insert_article($title, $article)
    {
        $data['Utilisateur_id'] = $this->session->userdata('uid');
        $data['titre'] = $title;
        $data['article'] = $article;
//        $data['image'] = $photo;
        $data['created'] = Date('Y-m-d H:i:s');
        $data['updated'] = Date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
    }
    
    public function liste_article($order, $by)
    {
        return $this->db->select('*')
                        ->from($this->table)
//                        ->limit($nb, $debut)
                        ->order_by($order, $by)
                        ->get()
                        ->result();
    }
    
    public function get_article($article_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id = ' . "'" . $article_id . "'");
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
    
    public function update_article($article_id, $title, $article)
    {
        $data['titre'] = $title;
        $data['article'] = $article;
        $data['updated'] = Date('Y-m-d H:i:s');
        
        $this->db->update($this->table, $data, "id = ".$article_id);
    }
    
    public function delete_article($article_id)
    {
        return $this->db->where('id', (int) $article_id)->delete($this->table);
    }
    
    public function multi_delete_article($array_article_id)
    {
        return $this->db->where_in('id', $array_article_id)->delete($this->table);
    }
    
    public function count($champ = array(), $valeur = null)
    {
        return (int) $this->db->where($champ, $valeur)
                              ->from($this->table)
                              ->count_all_results();
    }
}