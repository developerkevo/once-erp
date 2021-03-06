<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cherd extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->library('auth');
        $this->load->library('lbreed');
        $this->load->library('lroute');
        $this->load->library('lcow');
        $this->load->library('session');
        $this->load->model('Breed');
        $this->load->model('Route');
        $this->load->model('Cow');
        $this->load->model("Customers");
        $this->auth->check_admin_auth();
    }


    public function add_breed()
    {
        $content = $this->lbreed->breed_add_form();
        $this->template->full_admin_html_view($content);      
        
    }

    public function save_breed()
    {
        $name = $this->input->post('name');
        $data = array(
            "name" => $name,
        );
        if($this->Breed->add_breed($data))
        {
            redirect(base_url('Cherd/manage_breed'));    
        }else{
            redirect(base_url('Cherd/add_breed'));    
        }
    }
    
    public function manage_breed() {
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $data = $this->Breed->get_breeds();
        
         $content =$this->lbreed->breeds($data);
    
        $this->template->full_admin_html_view($content);
    }


    public function delete_breed()
    {
        $id = $this->uri->segment(3);
        
        if($this->Breed->delete_breed($id)){
            redirect(base_url('Cherd/manage_breed'));    
        }else{
            redirect(base_url('Cherd/add_breed'));    
        }
    }

    public function update_breed()
    {
        $id = $this->uri->segment(3);
        $name = $this->input->post("name");
        $data = array(
            "name" => $name,
            "id" => $id
        );
        if($this->Breed->update_breed($data))
        {        
           redirect(base_url('Cherd/manage_breed'));    
        }else{
            redirect(base_url('Cherd/add_breed'));    
        }
    }
  

    //routes
    public function manage_route()
    {
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $data = $this->Route->get_routes();        
        $content =$this->lroute->routes($data);    
        $this->template->full_admin_html_view($content);
    }


    public function add_route()
    {
        $content = $this->lroute->route_add_form();
        $this->template->full_admin_html_view($content);      
        
    }


    public function save_route()
    {
        $name = $this->input->post('name');
        $data = array(
            "name" => $name,
        );
        if($this->Route->add_route($data))
        {
            redirect(base_url('Cherd/manage_route'));    
        }else{
            redirect(base_url('Cherd/add_route'));    
        }
    }

    public function delete_route()
    {
        $id = $this->uri->segment(3);
        
        if($this->Route->delete_route($id)){
            redirect(base_url('Cherd/manage_breed'));    
        }else{
            redirect(base_url('Cherd/add_breed'));    
        }
    }

    public function update_route()
    {
        $id = $this->uri->segment(3);
        $name = $this->input->post("name");
        $data = array(
            "name" => $name,
            "id" => $id
        );
        if($this->Route->update_route($data))
        {        
           redirect(base_url('Cherd/manage_route'));    
        }else{
            redirect(base_url('Cherd/add_route'));    
        }
    }


    
    public function manage_cow()
    {
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $breeds = $this->Breed->get_breeds();
        $routes = $this->Route->get_routes();
        $farmers = $this->Customers->get_farmer_name_id();
        $cows = $this->Cow->get_cows();
        $cows_by_breed = $this->Cow->cows_by_breed();
        $cows_by_route = $this->Cow->cows_by_route();      

        /// chart data and lable breed;
        $cows_by_breed_data = $cows_by_breed_lable = '';
        foreach($cows_by_breed as $br)
        {
            $cows_by_breed_data .= $br->cows.",";
            $cows_by_breed_lable .= $br->breed.",";
        }

    

         /// chart data and lable route;
         $cows_by_route_data = $cows_by_route_lable = '';
         foreach($cows_by_route as $br)
         {
             $cows_by_route_data .= $br->cows.",";
             $cows_by_route_lable .= $br->route.",";
         }


        $data = array("breeds" => $breeds,
        "routes" => $routes,
        "farmers" => $farmers, 
        "cows" => $cows,
        "cows_by_breed_data"=>$cows_by_breed_data,
        "cows_by_breed_lable"=>$cows_by_breed_lable, 
        "cows_by_route_data"=>$cows_by_route_data,
        "cows_by_route_lable"=>$cows_by_route_lable
    );
        $content =$this->lcow->cows($data);    
        $this->template->full_admin_html_view($content);
    }

    public function add_cow()
    {
        $CI =& get_instance();
        $this->auth->check_admin_auth();

        $farmer_id = $this->input->post("farmer");
        $breed_id = $this->input->post("breed");
        $route_id = $this->input->post("route");
        $age = $this->input->post("age");
        $production = $this->input->post("production");

        $data = array(
            "breed_id" => $breed_id,
            "age" => $age,
            "route_id" => $route_id,
            "supplier_id" => $farmer_id,
            "production" => $production

        );
        if($this->Cow->add_cow($data))
        {
            redirect(base_url('Cherd/manage_cow'));
        }else{
            $this->session->set_flashdata('error_message', "Error Occured");
            redirect(base_url('Cherd/manage_cow'));
        }
    }


    public function update_cow()
    {

        $id = $this->uri->segment(3);

        $farmer_id = $this->input->post("farmer");
        $breed_id = $this->input->post("breed");
        $route_id = $this->input->post("route");
        $age = $this->input->post("age");
        $production = $this->input->post("production");

        $data = array(
            "breed_id" => $breed_id,
            "age" => $age,
            "route_id" => $route_id,
            "supplier_id" => $farmer_id,
            "production" => $production,
            "id" => $id
        );

       if($this->Cow->update_cow($data))
       {
        redirect(base_url('Cherd/manage_cow'));
       }

       $this->session->set_flashdata('error_message', "Error Occured");
        redirect(base_url('Cherd/manage_cow'));
    }

}

?>