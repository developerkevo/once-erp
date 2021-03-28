<?php

error_reporting(1);
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Manfucturing extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function get_raw_materials()
    {
        $this->db->select('id,name,unit_price,quantity,unit_measure');
        $this->db->from('raw_materials');
        return $this->db->get()->result();
    }

    public function add_update_raw_material($data)
    {
        if($data['id'] == null)
        {
            if($this->db->insert("raw_materials",$data)){
                return true;
            }else{
                return false;
            }
        }else{

            $this->db->where("id", $data["id"]);
            if($this->db->update('raw_materials', $data))
            {
                return true;
            }
        }
        
    }

    public function get_products()
    {
        $this->db->select('id,name,unit_price,target_quantity,measurement_unit');
        $this->db->from('products');
        return $this->db->get()->result();
    }


    public function add_update_product($data)
    {
        if($data['id'] == null)
        {
            if($this->db->insert("products",$data)){
                return true;
            }else{
                return false;
            }
        }else{

            $this->db->where("id", $data["id"]);
            if($this->db->update('products', $data))
            {
                return true;
            }
        }
        
    }


    public function get_product_raw_materials($id)
    {
        $this->db->select("m.quantity as used_quantity, p.name as product, p.unit_price as product_unit_price, p.target_quantity, p.measurement_unit, 
        r.name as raw_material, r.unit_price as material_unit_price, r.quantity as material_quantity, r.unit_measure as raw_material_unit_measure");
        $this->db->from('manufacturing m');
        $this->db->join('products p','p.id = m.product_id');
        $this->db->join('raw_materials r','r.id = m.raw_material_id');
        $this->db->where('m.product_id', $id);
        return $this->db->get()->result();
    }


    public function add_product_details($data)
    {
        if($this->db->insert("manufacturing",$data))
        {

            $sql = " UPDATE raw_materials SET quantity = quantity - ? WHERE id = ?";
            if($this->db->query($sql, array($data["quantity"],$data["raw_material_id"])))
            {
                return true;
            }else{
               
                return $this->db->error();
            }
        }else{
            return $this->db->error();
        }
    }

    public function raw_material_buying_price($rm_id)
    {
        $this->db->select("unit_price");
        $this->db->where("id",$rm_id);
        $this->db->limit(1);
        $query = $this->db->get('raw_materials');      
        return  $query->row()->unit_price;
    }

    public function add_product_sales($data)
    {
        if($this->db->insert("manfucturing_sales",$data))
        {
            return true;
        }
        return false;
    }

    public function update_product_available_quantity($quantity, $id)
    {
       
            $sql = " UPDATE products SET target_quantity = 	target_quantity - ? WHERE id = ?";
            if($this->db->query($sql, array($quantity, $id)))
            {
                return true;
            }else{
               
                return $this->db->error();
            }
    }

    public function get_available_product_qunatity($product_id)
    {
        $this->db->select("target_quantity");
        $this->db->where("id",$product_id);
        $this->db->limit(1);
        $query = $this->db->get('products');      
        return  $query->row()->target_quantity;
    }

    public function get_product_sales($product_id)
    {
        $this->db->select("p.name, p.unit_price, p.measurement_unit, c.customer_name, ms.quantity, ms.date");
        $this->db->from("manfucturing_sales ms");
        $this->db->join('products p','p.id = ms.product_id');
        $this->db->join('customer_information c','c.customer_id = ms.farmer_id');
        $this->db->where('ms.product_id', $product_id);
        return $this->db->get()->result();
    }

}
