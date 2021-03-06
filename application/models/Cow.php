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
        $this->db->select('b.name as breed_name ,s.customer_name as farmer,r.name as route_name, c.age,c.production, c.id');
        $this->db->from('cows c');
        $this->db->join("breeds b", "b.id = c.breed_id");
        $this->db->join("routes r", "r.id = c.route_id");
        $this->db->join("customer_information s", "s.customer_id = c.supplier_id");
        return $this->db->get()->result();
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

    public function cows_by_breed()
    {
        $this->db->select("count(c.id) as cows, b.name as breed");
        $this->db->from('cows c');
        $this->db->join("breeds b", "b.id = c.breed_id");
        $this->db->group_by("c.breed_id");
        return $this->db->get()->result();
    }


    public function cows_by_route()
    {
        $this->db->select("count(c.id) as cows, r.name as route");
        $this->db->from('cows c');
        $this->db->join("routes r", "r.id = c.route_id");
        $this->db->group_by("c.route_id");
        return $this->db->get()->result();
    }
}

?>