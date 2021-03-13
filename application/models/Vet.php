<?php
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vet extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function add_vet($data)
    {
        if($this->db->insert("vets",$data)){
            return true;
        }else{
            return false;
        }
    }

    
    public function get_vets()
    {
        $this->db->select(' v.id, v.name ,v.location, v.phone, v.id_no,r.name as route_name,v.semen_count');
        $this->db->from('vets v');
        $this->db->join("routes r", "r.id = v.route_id");
        return $this->db->get()->result();
    }

    public function update_cow($data)
    {
        $this->db->where('id', $data["id"]);
        if($this->db->update('vets', $data))
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

    public function vets_by_semen_count()
    {
        $this->db->select("sum(semen_count) as semens, name");
        $this->db->from('vets');
        $this->db->group_by("id");
        return $this->db->get()->result();
    }


    public function vets_by_route()
    {
        $this->db->select("count(v.id) as vets, r.name as route");
        $this->db->from('vets v');
        $this->db->join("routes r", "r.id = v.route_id");
        $this->db->group_by("v.route_id");
        return $this->db->get()->result();
    }

    public function bookings($vet_id)
    {
        $this->db->select("f.customer_name, v.name as vet_name, b.date, b.id, b.status, b.semen_used");
        $this->db->from('bookings b');
        $this->db->join('vets v','v.id = b.vet_id');
        $this->db->join('customer_information f', 'f.customer_id = b.farmer_id');
        $this->db->where('b.vet_id',$vet_id);
        return $this->db->get()->result();
    }
}

?>