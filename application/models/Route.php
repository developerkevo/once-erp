<?php
    
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Route extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function add_route($data)
    {
        if($this->db->insert("routes",$data)){
            return true;
        }else{
            return false;
        }
    }

    
    public function get_routes()
    {
        $this->db->select('id,name');
        $this->db->from('routes');
        return $query = $this->db->get()->result();
    }

    public function update_route($data)
    {
        $this->db->where('id', $data["id"]);
        if($this->db->update('routes', $data))
        {
            return true;
        }
    }

    public function delete_route($id)
    {
        $this->db->where('id', $id);
        if($this->db->delete('routes'))
        {
            return true;
        }
    }
}

?>