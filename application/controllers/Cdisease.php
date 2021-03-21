<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cdisease extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->library('auth');
        $this->load->library('session');
        $this->load->model('Route');
        $this->load->model('Vet');
        $this->load->model("Customers");
        $this->load->model("Disease");
        $this->auth->check_admin_auth();
    }


    public function add_disease()
    {
        $disease = $this->input->post("disease");

        $data = ["name" => $disease];

        if($this->Disease->add_disease($data))
        {
            redirect(base_url('Cdisease/manage_diseases'));
        }else{
            $this->session->set_flashdata('error_message', "Error Occured");
            redirect(base_url('Cdisease/manage_diseases'));
        }
    }



    
    public function manage_diseases()
    {  
        $CI =& get_instance(); 
        $status = $this->input->post("dstatus");

        if($status == null or $status == "")
        {
            $status = "All";
        }
        
        $diseases = $this->Disease->get_diseases();

        $sick_cows = $this->Disease->get_sick_cows($status);

        $cows = $this->Disease->get_cows();

        /// chart data and lable route;
        // $vets_by_route_data = $vets_by_route_label = '';
        // foreach($vets_by_route as $br)
        // {
        //     $vets_by_route_data .= $br->vets.",";
        //     $vets_by_route_label .= $br->route.",";
        // }

    

         /// chart data and lable semen count;
        //  $vets_by_semen_count_data = $vets_by_semen_count_label = '';
        //  foreach($vets_by_semen_count as $br)
        //  {
        //      $vets_by_semen_count_data .= $br->semens.",";
        //      $vets_by_semen_count_label .= $br->name.",";
        //  }


        $data = array(
        "diseases" => $diseases,
        "sick_cows" => $sick_cows,
        "cows" => $cows
        );   
    
        $this->template->full_admin_html_view($CI->parser->parse('diseases/manage_diseases',$data,true));
    }


    public function add_sick_cow()
    {
        $cow_id = $this->input->post("cow_id");
        $disease_id = $this->input->post("disease_id");

        $data = array("cow_id" => $cow_id, "disease_id" => $disease_id);


        if($this->Disease->add_sick_cow($data))
        {
            redirect(base_url('Cdisease/manage_diseases'));
        }else{
            $this->session->set_flashdata('error_message', "Error Occured");
            redirect(base_url('Cdisease/manage_diseases'));
        }


    }


    public function update_cow_disease_status()
    {
        $id = $this->input->post("id");
        $status = $this->input->post("cowStatus");

        $data = array(
            "id" => $id,
            "status" => $status
        );

        if($this->Disease->update_cow_disease_status($data))
        {
            redirect(base_url('Cdisease/manage_diseases'));
        }

    }

     

}

?>