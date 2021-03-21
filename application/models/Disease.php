<?php
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Disease extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function add_disease($data)
    {
        if($this->db->insert("diseases",$data)){
            return true;
        }else{
            return false;
        }
    }

    
    public function get_diseases()
    {
        $this->db->select('name, id');
        $this->db->from('diseases');
        return $this->db->get()->result();
    }

    public function add_sick_cow($data)
    {
        if($this->db->insert("sick_cows",$data)){
            return true;
        }else{
            return false;
        }
    }

    public function update_sick_cow($id)
    {
        $this->db->where('id', $id);
        if($this->db->delete('sick_cows'))
        {
            return true;
        }
    }


    public function get_sick_cows($disease_id)
    {


            $this->db->select("f.customer_name as farmer, c.id as cow_id, c.age, b.name as breed_name, sc.status,sc.id, d.name, d.id as disease_id");
            $this->db->from('sick_cows sc');
            $this->db->join('diseases d','d.id = sc.disease_id');
            $this->db->join('cows c', 'c.id = sc.cow_id');
            $this->db->join('breeds b', 'b.id = c.breed_id');
            $this->db->join('customer_information f', 'f.customer_id = c.supplier_id');
            if($disease_id != "All")
            {
                $this->db->where('sc.disease_id',$disease_id);
            }
        
       
        return $this->db->get()->result();
    }

    public function get_cows()
    {
        $this->db->select("f.customer_name as farmer, c.id, b.name as breed_name");
        $this->db->from('cows c');
        $this->db->join('breeds b','b.id = c.breed_id');
        $this->db->join('customer_information f','f.customer_id = c.supplier_id');
        return $this->db->get()->result();
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

    public function update_cow_disease_status($data)
    {
        $this->db->where("id", $data["id"]);
        if($this->db->update('sick_cows', $data))
        {
            return true;
        }
    }
}

?>