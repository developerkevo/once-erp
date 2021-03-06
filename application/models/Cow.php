<?php
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cow extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function add_cow($data)
    {
        if($this->db->insert("cows",$data)){
            return true;
        }else{
            return false;
        }
    }

    
    public function get_cows()
    {
        $this->db->select('id,name');
        $this->db->from('cows');
        return $query = $this->db->get()->result();
    }

    public function update_cow($data)
    {
        $this->db->where('id', $data["id"]);
        if($this->db->update('cows', $data))
        {
            return true;
        }
    }

    public function delete_cow($id)
    {
        $this->db->where('id', $id);
        if($this->db->delete('cows'))
        {
            return true;
        }
    }
}

?>