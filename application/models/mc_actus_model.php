<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mc_actus_model extends CI_Model
{
    protected $table = 'wall';
    protected $data;

    public function __construct() {
        parent::__construct();
        $this->data = array();
    }
    
    public function insert_actus($message, $lien, $photo, $user_id)
    {        
        $data['Utilisateur_id'] = $this->session->userdata('uid');
        $data['wallto_utilisateur_id'] = $user_id;
        $data['markup_message'] = $message;
        $data['photo'] = $photo;
        $data['video'] = $lien;
        $data['created'] = Date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
    }
    
//    public function editer_news($id, $titre = null, $contenu = null)
//    {
//      if($titre == null AND $contenu == null)
//      {
//          return false;
//      }
//
//      if($titre != null)
//      {
//          $this->db->set('titre', $titre);
//      }
//      if($contenu != null)
//      {
//          $this->db->set('contenu', $contenu);
//      }
//
//      $this->db->set('date_modif', 'NOW()', false);
//      $this->db->where('id', (int) $id);
//      
//      return $this->db->update($this->table);
//    }
//    
    public function delete_actus($message_id)
    {
        return $this->db->where('id', (int) $message_id)->delete($this->table);
    }
    
    public function delete_comments($comment_id)
    {
        return $this->db->where('id', (int) $comment_id)->delete('commentaires');
    }
    
//    public function count($where = array())
//    {
//      return (int) $this->db->where($where)
//                            ->count_all_results($this->table);      
//    }
    
    public function count($champ = array(), $valeur = null)
    {
        return (int) $this->db->where($champ, $valeur)
                              ->from('commentaires')
                              ->count_all_results();
    }
    
    public function liste_actus($nb = 10, $debut = 0, $user_visited = null)
    {
        return $this->db->select('W.*, U.login AS loginU, U.thumb AS thumbU, U.id AS idU')
                        ->from('wall AS W')
                        ->join('utilisateur U', 'U.id = W.Utilisateur_id')
                        ->where('W.wallto_utilisateur_id', (int) $user_visited)
                        ->limit($nb, $debut)
                        ->order_by('W.id', 'desc')
                        ->get()
                        ->result();
    }
    
    public function liste_comments($nb = 100, $debut = 0)
    {
        return $this->db->select('A.id AS idA,
                                  B.id AS idB,
                                  B.Wall_id AS wallidB,
                                  B.comment AS commentB,
                                  B.created AS createdB,
                                  B.Utilisateur_id AS utilisateuridB,
                                  U.id AS idU,
                                  U.login AS loginU,
                                  U.thumb AS thumbU')
                        ->from('wall AS A')
                        ->join('commentaires AS B', 'B.Wall_id = A.id')
                        ->join('utilisateur AS U', 'U.id = B.Utilisateur_id')
//                        ->limit($nb, $debut)
                        ->order_by('B.id', 'asc')
                        ->get()
                        ->result();
    }
    
    public function insert_comments()
    {
        if(!empty($_POST['usercomment']) && !empty($_POST['messageid'])){
            $utilisateurid = $this->session->userdata('uid');
            $wallid        = $this->input->post('messageid');
            $comment       = $this->input->post('usercomment');
            $login         = $this->session->userdata('login');
            $thumb         = $this->session->userdata('thumb');
            $created       = Date('Y-m-d H:i:s');            
            
            $commentArray = array(
              'Utilisateur_id' => $utilisateurid,
              'Wall_id'        => $wallid,
              'comment'        => $comment,
              'created'        => $created
            );
            
            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created, $utilisateurid, $login, $thumb);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }
    
    private function returnMarkup($comment, $created, $utilisateurid, $login, $thumb)
    {         
        return '<div class="comments">
                    <div class="com_left">
                        <a href='.site_url("home/".$utilisateurid).'" ><img src="'.files("profiles/".$thumb).'" alt="Photo Profil" /></a>
                    </div>
                    <div class="com_right">
                        <div class="com_top">
                        </div>
                        <div class="com_bottom">
                            <span class="com_publi_infos">'.$login.'<small> - '.my_time($created).'</small></span>
                            <span class="com_publi_msg">'.$comment.'</span>
                        </div>
                    </div>
                </div>';
    }
}