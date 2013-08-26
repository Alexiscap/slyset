<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document_model extends CI_Model {

    protected $table_doc = 'documents';
    protected $table_alb = 'albums';
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

    public function get_morceau_by_album($album) {
        return $this->db->query('SELECT nom,id FROM morceaux WHERE Albums_id = ' . $album)
                        ->result();
    }

    public function insert_doc($album, $morceau, $path, $type) {
        $this->db->set(array('albums_id' => $album, 'Morceaux_id' => $morceau, 'path' => $path, 'Utilisateur_id' => $this->session->userdata('uid'), 'format' => 'pdf', 'type_document' => $type))
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
        $this->db->set(array('Utilisateur_id' => $this->session->userdata('uid'), 'status' => 'P'))
                ->insert('commande');
        $cmd_last_id = $this->db->insert_id();

        $this->db->set(array('Commande_id' => $cmd_last_id, 'prix' => $prix, 'Documents_id' => $doc_id))
                ->insert('infos_commande');
    }

}