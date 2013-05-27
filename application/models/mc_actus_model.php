<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mc_actus_model extends CI_Model
{
    protected $table = 'wall';
    
    public function insert_actus($message, $lien, $photo)
    {
//        $this->db->set('auteur',  $auteur);
//        $this->db->set('titre',   $titre);
//        $this->db->set('contenu', $contenu);
//         
//        $this->db->set('date_ajout', 'NOW()', false);
//        $this->db->set('date_modif', 'NOW()', false);
//         
//        return $this->db->insert($this->table);
        
        $data['Utilisateur_id'] = $this->session->userdata('uid');
        $data['wallto_utilisateur_id'] = $this->session->userdata('uid');
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
    
    public function liste_actus($nb = 10, $debut = 0)
    {
        return $this->db->select('*')
                        ->from($this->table)
                        ->limit($nb, $debut)
                        ->order_by('id', 'desc')
                        ->get()
                        ->result();
    }
    
    public function liste_comments() //$nb = 50, $debut = 0
    {
        return $this->db->select('*')
                        ->from($this->table)
                        ->join('commentaires', 'commentaires.Wall_id = wall.id')
//                        ->limit($nb, $debut)
                        ->order_by('commentaires.id', 'asc')
                        ->get()
                        ->result();
    }
    
    public function insert_comments()
    {
        if(!empty($_POST['usercomment']) && !empty($_POST['messageid'])){
            $wallid   = $this->input->post('messageid');
            $comment  = $this->input->post('usercomment');
            $created  = Date('Y-m-d H:i:s');
            
//            $now   = time();
//            $date2 = strtotime($created2);
//
//            function dateDiff($date1, $date2){
//                $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
//                $retour = array();
//
//                $tmp = $diff;
//                $retour['second'] = $tmp % 60;
//
//                $tmp = floor( ($tmp - $retour['second']) /60 );
//                $retour['minute'] = $tmp % 60;
//
//                $tmp = floor( ($tmp - $retour['minute'])/60 );
//                $retour['hour'] = $tmp % 24;
//
//                $tmp = floor( ($tmp - $retour['hour'])  /24 );
//                $retour['day'] = $tmp;
//
//                return $retour;
//            }
//
//            // Test de la fonction
//            $created = dateDiff($now, $date2);
            
            
            
            $commentArray = array(
              'Wall_id'  =>   $wallid,
              'comment'  =>   $comment,
              'created'  =>   $created
            );
            
            $this->db->insert('commentaires', $commentArray);
            return $this->returnMarkup($comment, $created);
        } else {
            echo 'Oops, une erreur ! Vérifie que tu as bien remplie ton commentaire !';
        }
    }
    
    private function returnMarkup($comment, $created)
    {         
        return '<div class="comments">
                    <div class="com_left">
                        <img src="'.img_url("sidebar-left/photo-profil.png").'" alt="Photo Profil" />
                    </div>
                    <div class="com_right">
                        <div class="com_top">
                        </div>
                        <div class="com_bottom">
                            <span class="com_publi_infos">John Doe <small>- '.$created.'</small></span>
                            <span class="com_publi_msg">'.$comment.'</span>
                        </div>
                    </div>
                </div>';
    }
}