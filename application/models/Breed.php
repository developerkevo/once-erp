<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Breed extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

        public function add_breed($data)
        {
            if($this->db->insert("breeds",$data)){
                return true;
            }else{
                return false;
            }
        }

        public function get_breeds()
        {
            $this->db->select('id,name');
            $this->db->from('breeds');
            return $query = $this->db->get()->result();
        }

        public function update_breed($data)
        {
            $this->db->where('id', $data["id"]);
            if($this->db->update('breeds', $data))
            {
                return true;
            }
        }

        public function delete_breed($id)
        {
            $this->db->where('id', $id);
            if($this->db->delete('breeds'))
            {
                return true;
            }
        }
    }
?>