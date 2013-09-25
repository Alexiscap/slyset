<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    protected $table = 'coverflow';
    protected $data;

    public function __construct() {
        parent::__construct();
        $this->data = array();
    }

    public function get_cover_artistes() {
        $query1 = $this->db->query('SELECT artiste_1, artiste_2, artiste_3, artiste_4, artiste_5 FROM coverflow');
        foreach ($query1->list_fields() as $field) {
            $this->db->select('C.*, U.login AS loginU, U.id AS idU, U.thumb AS thumbU, U.cover AS coverU');
            $this->db->from('coverflow AS C');
            $this->db->join('utilisateur U', 'U.login = C.' . "" . $field . "");
            $this->db->where('U.type', '2');

            $query = $this->db->get();
            $result[] = $query->result();
        }
        return $result;
    }

    public function insert_artiste($artiste1, $artiste2 = NULL, $artiste3 = NULL, $artiste4 = NULL, $artiste5 = NULL) {
        $data['artiste_1'] = $artiste1;
        $data['artiste_2'] = $artiste2;
        $data['artiste_3'] = $artiste3;
        $data['artiste_4'] = $artiste4;
        $data['artiste_5'] = $artiste5;

        $this->db->insert('coverflow', $data);
    }

    public function update_artiste($artiste1, $artiste2 = NULL, $artiste3 = NULL, $artiste4 = NULL, $artiste5 = NULL) {
        $data['artiste_1'] = $artiste1;
        $data['artiste_2'] = $artiste2;
        $data['artiste_3'] = $artiste3;
        $data['artiste_4'] = $artiste4;
        $data['artiste_5'] = $artiste5;
        
        $this->db->update('coverflow', $data);
    }
}