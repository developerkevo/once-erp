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
        $content =$this->lcow->cows($data);    
        $this->template->full_admin_html_view($content);
    }

}

?>