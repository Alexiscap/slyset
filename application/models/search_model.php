<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search_model extends CI_Model {

    protected $table = 'utilisateur';
    protected $data;

    public function __construct() {
        parent::__construct();
        $data = array();
    }

    public function search($keyword, $limit = 20, $offset = 0) {
        $this->db->select('*')
                ->from($this->table)
                ->like('login', $keyword)
                ->order_by('login')
                ->limit($limit, $offset);

        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function count_results($keyword) {
        return (int) $this->db->from($this->table)
                        ->like('login', $keyword)
                        ->count_all_results();
    }

}