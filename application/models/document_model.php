<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document_model extends CI_Model {

    protected $table_doc = 'documents';
    protected $table_alb = 'albums';
	protected $table_track = 'morceaux';
    protected $tbl_order = 'commande';
    protected $tbl_orderinfo = 'infos_commande';

    protected $data;

    public function __construct() {
        parent::__construct();
        $this->data = array();
    }

    public function get_all_album_user($user_id) {
        return $this->db->select('id,img_cover,annee,nom,livret_path')
        				->from($this->table_alb)
        				->where('Utilisateur_id',$user_id)
        				->group_by('id')
        				->get()
        				->result();

    }

    public function get_all_album_moreceaux_user($user_id) {
        return $this->db->query('SELECT id,albums_id,nom
								FROM morceaux 
								WHERE Utilisateur_id = ' . $user_id . '
								GROUP BY id')
                        ->result();
    }

    public function get_document_paroles($all_album) {
        return $this->db->query('(SELECT morceaux.id AS morceau_id,documents.prix,morceaux.nom AS nom_morceau,documents.Albums_id AS album_id, documents.id AS document_id,documents.path,type_document
						FROM morceaux					
						INNER JOIN documents
						ON documents.morceaux_id = morceaux.id
						WHERE morceaux.Albums_id IN (' . $all_album . ') AND type_document = "paroles"
						ORDER BY documents.Albums_id ASC, documents.morceaux_id ASC)')
                        ->result();
    }

    public function get_document_partition($all_album) {
        return $this->db->query('(SELECT morceaux.id AS morceau_id,documents.prix,morceaux.nom AS nom_morceau,documents.Albums_id AS album_id, documents.id AS document_id,documents.path,type_document
						FROM morceaux					
						INNER JOIN documents
						ON documents.morceaux_id = morceaux.id
						WHERE morceaux.Albums_id IN (' . $all_album . ') AND type_document = "partition"
						ORDER BY documents.Albums_id ASC, documents.morceaux_id ASC)')
                        ->result();
    }

    public function get_all_morceau_doc($user_id) {
        // les id morceaux sans album + les morceaux par albums
        return $this->db->query('(SELECT Morceaux_Id,documents.Albums_id,documents.path,albums.nom,albums.annee,albums.livret_path,img_cover, 1 as type
								FROM documents
								JOIN albums ON documents.Albums_id = albums.id
										WHERE documents.Utilisateur_id = 30
								GROUP BY documents.Albums_id)')
                        ->result();
    }

    public function all_doc($user_id) {
        return $this->db->query('SELECT morceaux_id,path,type_document FROM documents WHERE Utilisateur_id = ' . $user_id . ' ORDER BY type_document ASC')
                        ->result();
    }

    public function get_morceau_album() {
        return $this->db->query('SELECT morceaux.id,morceaux.nom,morceaux.Albums_id,documents.path,documents.prix,documents.type_document
								FROM morceaux
								JOIN albums ON morceaux.Albums_id = albums.id
								JOIN documents ON morceaux.id = documents.Morceaux_id
										WHERE morceaux.Utilisateur_id = 30
								GROUP BY documents.Albums_id
																ORDER BY type_document ASC

								')
                        ->result();
    }

    public function get_album($user_id) {
        return $this->db->query('SELECT nom,id FROM albums WHERE Utilisateur_id = ' . $user_id)
                        ->result();
    }
    
    public function get_one_album($id_alb)
    {
      return $this->db->query('SELECT nom,id FROM albums WHERE id = ' . $id_alb)
                        ->result();
    }

    public function get_morceau_by_album($album,$not_type_doc) {
    	return $this->db->query('SELECT morceaux.id,morceaux.nom FROM morceaux
									LEFT OUTER JOIN documents ON documents.morceaux_id = morceaux.id
                                     WHERE morceaux.id NOT IN ( SELECT morceaux.id FROM morceaux
                                        LEFT OUTER JOIN documents ON documents.morceaux_id = morceaux.id
                                            WHERE documents.type_document = "'.$not_type_doc.'")
                                        AND morceaux.albums_id = '.$album )                       
						->result();
    					
    }

    public function insert_doc($prix,$album, $morceau, $path, $type) {
            $prix = !empty($prix) ? "$prix" : NULL;

        $this->db->set(array('albums_id' => $album, 'Morceaux_id' => $morceau, 'path' => $path, 'Utilisateur_id' => $this->session->userdata('uid'), 'format' => 'pdf', 'type_document' => $type,'prix'=> $prix))
                ->insert('documents');
    }

    public function insert_livret($album, $path) {
        $data = $this->data;
        $data['livret_path'] = $path;

        $this->db->where('id', $album);
        $this->db->update('albums', $data);
    }

	//mise au panier
    public function panier($prix, $doc_id, $nom) {

        $id_commande_user = $this->db->select('id')
                                    ->from($this->tbl_order)
                                    ->where(array('Utilisateur_id' => $this->session->userdata('uid'), 'status' => 'P'))
                                    ->get()
                                    ->result();
        if (empty($id_commande_user) == 1) {
            $data = array(
                'Utilisateur_id' => $this->session->userdata('uid'),
                'date' => date('Y-m-d H:i:s', time()),
                'status' => 'P'
            );

            $this->db->insert($this->tbl_order, $data);
        }

        $existing_panier = $this->db->select('id,titre')
                                    ->from($this->tbl_orderinfo)
                                    ->where_in('Documents_id', $doc_id)
                                    ->where(array('Commande_id' => $id_commande_user[0]->id))
                                    ->get()
                                    ->result();

        if (empty($existing_panier) == 1) {
            $infos_track = $this->db->select('documents.id,documents.morceaux_id AS track_id,morceaux.nom AS nom_track,documents.prix,morceaux.format,documents.Albums_id AS id_alb')
                    ->from($this->table_doc)
                    ->join($this->table_track,'morceaux.id = documents.Morceaux_id')
                    ->where(array('documents.id'=> $doc_id))
                    ->get()
                    ->result();

            foreach ($infos_track as $info_track) {
                $data_cmd = array(
                    'Commande_id' => $id_commande_user[0]->id,
                    'Albums_id' => $info_track->id_alb,
                    'titre' => $info_track->nom_track,
                    'prix' => $info_track->prix,
                    'morceaux_id' => $info_track->track_id,
                    'documents_id' => $doc_id,
                    'format' => 'pdf'
                );
                $this->db->insert($this->tbl_orderinfo, $data_cmd);
                return 'ajout';
            }
        }

        /*
        $this->db->set(array('Utilisateur_id' => $this->session->userdata('uid'), 'status' => 'P'))
                ->insert('commande');
        $cmd_last_id = $this->db->insert_id();

        $this->db->set(array('Commande_id' => $cmd_last_id, 'prix' => $prix, 'Documents_id' => $doc_id))
                ->insert('infos_commande');
        */
    }
    
    public function delete_livret($id_album)
    {
    
        $data['livret_path'] = null;

        $this->db->where('id', $id_album);
        $this->db->update('albums', $data);
    }

    public function get_one_doc_by_id($doc_id)
    {
        return $this->db->select('documents.id AS doc_id,documents.prix, morceaux.nom AS name_track, albums.nom AS alb_name,documents.path AS doc_path')
                        ->from($this->table_doc)
                        ->join($this->table_track,'morceaux.id=documents.Morceaux_id')
                        ->join($this->table_alb,'morceaux.albums_id=albums.id','LEFT OUTER')
                        ->where(array('documents.id'=>$doc_id))
                        ->get()
                        ->result();

    }

    public function delete_paroles($doc_id)
    {
        $this->db->delete($this->table_doc, array('id' => $doc_id)); 


    }
    public function update_paroles($doc_id,$file_name,$prix)
    {
        $data['path'] = $file_name;
        $prix = !empty($prix) ? "$prix" : NULL;
        $data['prix'] = $prix;
        $this->db->where('id', $doc_id);
        $this->db->update($this->table_doc, $data);

    }

        public function update_paroles_price($doc_id,$prix)
    {
        $prix = !empty($prix) ? "$prix" : NULL;
        $data['prix'] = $prix;
        $this->db->where('id', $doc_id);
        $this->db->update($this->table_doc, $data);

    }

    public function get_doc_already_basket()
    {
        $user_ud = $this->session->userdata('uid');
        return $this->db->select('infos_commande.Documents_id,documents.type_document')
                        ->from($this->tbl_order)
                        ->join($this->tbl_orderinfo,'commande.id = infos_commande.Commande_id','LEFT OUTER JOIN')
                        ->join($this->table_doc,'documents.id = infos_commande.Documents_id','LEFT OUTER JOIN')
                        ->where(array('commande.status'=>'P','infos_commande.Documents_id IS NOT NULL'=> null,'commande.Utilisateur_id'=>$user_ud))
                        ->get()
                        ->result();


    }

}