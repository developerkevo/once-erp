<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cvet extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->library('auth');
        $this->load->library('session');
        $this->load->model('Route');
        $this->load->model('Vet');
        $this->load->model("Customers");
        $this->auth->check_admin_auth();
    }

    
    public function manage_vets()
    {  
        $CI =& get_instance(); 
        $routes = $this->Route->get_routes();
        
        $vets = $this->Vet->get_vets();
        $vets_by_route = $this->Vet->vets_by_route();
        $vets_by_semen_count = $this->Vet->vets_by_semen_count();      

        /// chart data and lable route;
        $vets_by_route_data = $vets_by_route_label = '';
        foreach($vets_by_route as $br)
        {
            $vets_by_route_data .= $br->vets.",";
            $vets_by_route_label .= $br->route.",";
        }

    

         /// chart data and lable semen count;
         $vets_by_semen_count_data = $vets_by_semen_count_label = '';
         foreach($vets_by_semen_count as $br)
         {
             $vets_by_semen_count_data .= $br->semens.",";
             $vets_by_semen_count_label .= $br->name.",";
         }


        $data = array(
        "routes" => $routes, 
        "vets" => $vets,
        "vets_by_route_label"=>$vets_by_route_label,
        "vets_by_route_data"=>$vets_by_route_data,
        "vets_by_semen_count_data"=>$vets_by_semen_count_data,
        "vets_by_semen_count_label"=>$vets_by_semen_count_label,
    );


    
    
        $this->template->full_admin_html_view($CI->parser->parse('vet/manage_vets',$data,true));
    }

    public function add_vet()
    {

        $this->auth->check_admin_auth();

        
        $name = $this->input->post("name");
        $phone = $this->input->post("phone");
        $route_id = $this->input->post("route_id");
        $id = $this->input->post("id");
        $location = $this->input->post("location");
        $semen_count = $this->input->post("semen_count");
        $sp = $this->input->post("sp");
        $bp = $this->input->post("bp");

        $data = array(
            "name" => $name,
            "phone" => $phone,
            "route_id" => $route_id,
            "location" => $location,
            "semen_count" => $semen_count,
            "semen_sp" => $sp,
            "semen_bp" => $bp,
            "id_no" => $id
        );

        if($this->Vet->add_vet($data))
        {

             $CI = &get_instance();
    
           
              $transaction_id = $this->auth->generator(10);
              $headcode = $this->Customers->get_trx_head_code(1); #represents vets
          
              
              // add to transaction
              $cosdr = array(
                  'VNo'            =>  $transaction_id,
                  'Vtype'          =>  'Debit',
                  'VDate'          =>  date("Y-m-d"),
                  'COAID'          =>  $headcode,
                  'Narration'      =>  "Assigned $name Semen units " . $transaction_id,
                  'Debit'          =>  $semen_count * $bp,
                  'Credit'         => 0,
                  'IsPosted'       => 1,
                  'CreateBy'       => $this->session->userdata('user_id'),
                  'CreateDate'     => date('Y-m-d H:i:s'),
                  'IsAppove'       => 1
              );

            $CI->db->insert('acc_transaction', $cosdr);
      
            redirect(base_url('Cvet/manage_vets'));
        }else{
            $this->session->set_flashdata('error_message', "Error Occured");
            redirect(base_url('Cvet/manage_vets'));
        }
    
    }


    public function update_vet()
    {

        $id = $this->uri->segment(3);

        $name = $this->input->post("name");
        $phone = $this->input->post("phone");
        $route_id = $this->input->post("route_id");
        $id = $this->input->post("id");
        $location = $this->input->post("location");
        $semen_count = $this->input->post("semen_count");

        $data = array(
            "name" => $name,
            "phone" => $phone,
            "route_id" => $route_id,
            "location" => $location,
            "semen_count" => $semen_count,
            "id_no" => $id
        );

    

       if($this->Cow->update_cow($data))
       {
        redirect(base_url('Cvet/manage_vets'));
       }

       $this->session->set_flashdata('error_message', "Error Occured");
        redirect(base_url('Cvet/manage_vets'));
    }


    public function bookings()
    {
        $vet_id = $this->uri->segment(3);
        $bookings = $this->Vet->bookings($vet_id);       
        header('Content-Type: application/json');
        echo json_encode($bookings);
    }

    public function manage_bookings()
    {
        $CI =& get_instance(); 

        $status = $this->input->post("fstatus");

        if($status == null or $status == "")
        {
            $status = "All";
        }


        $bookings = $this->Vet->all_bookings($status);  
                
        
        $farmers = $this->Customers->get_farmer_name_id(); 
        $vets = $this->Vet->get_vets();
        $data = array(
            "bookings" => $bookings,
            "customers" => $farmers,
            "vets" => $vets
        );
        $this->template->full_admin_html_view($CI->parser->parse('vet/bookings',$data,true));
    }


    public function add_booking()
    {
        //$CI =& get_instance(); 
        $date  = $this->input->post("date");
        $farmer = $this->input->post("customer");
        $vet_id = $this->input->post("vet_id");

        $data = array(
            "vet_id" => $vet_id,
            "farmer_id" => $farmer,
            "date" => $date
        );

        if($this->Vet->add_booking($data))
        {
            redirect(base_url('Cvet/manage_bookings'));
        }else{
            $this->session->set_flashdata('error_message', "Error Occured");
            redirect(base_url('Cvet/manage_bookings'));
        }


    }


    public function update_booking_status()
    {
        $vet_id = $this->input->post("vet_id");
        $semen_used = $this->input->post('semen_used');
        $id = $this->input->post('bid');
        $status = $this->input->post('status');
        $selling_price = $this->input->post('sp');
        $charges = $this->input->post('charges');

        $farmer_id = $this->Vet->farmer_id_from_booking($id);        

        $data = array(
            "id" => $id,
            "semen_used" => $semen_used,
            "status" => $status,
            "charges" => $charges
        );

        $current_semen_count = $this->Vet->vet_by_id($vet_id)[0]->semen_count;

        if($current_semen_count < $semen_used)
        {
            $this->session->set_flashdata('error_message', "Used semen is more than the current semen for the vet");
            redirect(base_url('Cvet/manage_bookings'));
        }else{
            if($this->Vet->update_booking_status($data))
            {
                
                $data = array(
                    "id" => $vet_id,                 
                    "semen_count" => ($current_semen_count - $semen_used));

                if($this->Vet->update_semen_count($data))
                {
                    #debit a customer


                    if($semen_used > 0 or $charges > 0){

                        $CI = &get_instance();
    
           
                        $transaction_id = $this->auth->generator(10);
                        $headcode = $this->Customers->get_trx_head_code($farmer_id);
                    
                        
                        // add to transaction
                        $cosdr = array(
                            'VNo'            =>  $transaction_id,
                            'Vtype'          =>  'Credit',
                            'VDate'          =>  date("Y-m-d"),
                            'COAID'          =>  $headcode,
                            'Narration'      =>  "Treated Cow and insemination " . $transaction_id,
                            'Debit'          =>  0,
                            'Credit'         => ($semen_used * $selling_price) + $charges,
                            'IsPosted'       => 1,
                            'CreateBy'       => $this->session->userdata('user_id'),
                            'CreateDate'     => date('Y-m-d H:i:s'),
                            'IsAppove'       => 1
                        );
           
                       $CI->db->insert('acc_transaction', $cosdr);

                    }   
                    

                    redirect(base_url('Cvet/manage_bookings'));
                }else{
                    $this->session->set_flashdata('error_message', "Failed");
                    redirect(base_url('Cvet/manage_bookings'));
                }
            }
        }


        
    }
    

}
