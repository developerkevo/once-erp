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

    public function vet_by_id($id)
    {
        $this->db->select("semen_count");
        $this->db->from('vets');
        $this->db->where('id',$id);
        $this->db->limit('1');
        return $this->db->get()->result();

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


    public function all_bookings($status)
    {


            $this->db->select("f.customer_name, v.name as vet_name, v.id as vet_id, b.date, b.id, b.status, b.semen_used, v.semen_count");
            $this->db->from('bookings b');
            $this->db->join('vets v','v.id = b.vet_id');
            $this->db->join('customer_information f', 'f.customer_id = b.farmer_id');
      
            if($status != "All")
            {
                $this->db->where('b.status',$status);
            }
        
       
        return $this->db->get()->result();
    }

    public function add_booking($data)
    {
        if($this->db->insert("bookings",$data)){
            return true;
        }else{
            return false;
        }
    }


    public function update_booking_status($data)
    {
        $this->db->where('id', $data["id"]);
        if($this->db->update('bookings', $data))
        {
            return true;
        }
    }

    public function update_semen_count($data)
    {
        $this->db->where('id', $data["id"]);
        if($this->db->update('vets', $data))
        {
            return true;
        }
    }
}

?>