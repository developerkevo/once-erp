<?php
error_reporting(1);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cmanufucturing extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->load->library('auth');
        $this->load->library('session');
        $this->load->model("Manfucturing");
        $this->load->model("Customers");
        $this->auth->check_admin_auth();
    }

    public function manage_raw_materials()
    {
        $CI = &get_instance();
        $raw_materials = $this->Manfucturing->get_raw_materials();

        $data = array("raw_materials" => $raw_materials);

        $this->template->full_admin_html_view($CI->parser->parse('manufucturing/manage_raw_materials', $data, true));
    }


    public function add_raw_material()
    {
        $name = $this->input->post("rawMaterialName");
        $unit_price = $this->input->post("unitPrice");
        $quantity = $this->input->post("quantity");
        $unit_measure = $this->input->post("unitMeasure");
        $id = $this->input->post("id");

        $data = array(
            "name" => $name,
            "unit_price" => $unit_price,
            "quantity" => $quantity,
            "unit_measure" => $unit_measure,
            "id" => $id
        );


        if ($this->Manfucturing->add_update_raw_material($data)) {
            redirect(base_url('Cmanufucturing/manage_raw_materials'));
        } else {
            $this->session->set_flashdata('error_message', "Error Occured");
            redirect(base_url('Cmanufucturing/manage_raw_materials'));
        }
    }

    public function manage_products()
    {
        $CI = &get_instance();
        $products = $this->Manfucturing->get_products();
        $raw_materials = $this->Manfucturing->get_raw_materials();
        $farmers = $this->Customers->get_farmer_name_id(); 

        $data = array("products" => $products, "raw_materials" => $raw_materials, "farmers"=>$farmers);

        $this->template->full_admin_html_view($CI->parser->parse('manufucturing/manage_products', $data, true));
    }



    public function add_products()
    {
        $name = $this->input->post("productName");
        $unit_price = $this->input->post("unitPrice");
        $target_quantity = $this->input->post("targetQuantity");
        $measurement_unit = $this->input->post("measurementUnit");
        $id = $this->input->post("id");

        $data = array(
            "name" => $name,
            "unit_price" => $unit_price,
            "target_quantity" => $target_quantity,
            "measurement_unit" => $measurement_unit,
            "id" => $id
        );

        if ($this->Manfucturing->add_update_product($data)) {
            redirect(base_url('Cmanufucturing/manage_products'));
        } else {
            $this->session->set_flashdata('error_message', "Error Occured");
            redirect(base_url('Cmanufucturing/manage_products'));
        }
    }


    public function get_product_raw_materials()
    {
        $id = $this->uri->segment(3);

        $data = $this->Manfucturing->get_product_raw_materials($id);

        echo json_encode($data);
    }

    public function add_product_details()
    {
        $product_id = $this->input->post("id");
        $raw_material_id = $this->input->post("rmid");
        $quantity_used = $this->input->post("pq");

        $data = array(
            "product_id" => $product_id,
            "raw_material_id" => $raw_material_id,
            "quantity" => $quantity_used
        );

        $results = $this->Manfucturing->add_product_details($data);

        $bp = $this->Manfucturing->raw_material_buying_price($raw_material_id);

        if ($results) {

            //update cash
            $CI = &get_instance();

            $transaction_id = $this->auth->generator(10);
            $headcode = $this->Customers->get_trx_head_code(1); #represents vets        

            // add to transaction
            $cosdr = array(
                'VNo'            =>  $transaction_id,
                'Vtype'          =>  'Debit',
                'VDate'          =>  date("Y-m-d"),
                'COAID'          =>  $headcode,
                'Narration'      =>  "Add raw material to production " . $transaction_id,
                'Debit'          =>  $quantity_used * $bp,
                'Credit'         => 0,
                'IsPosted'       => 1,
                'CreateBy'       => $this->session->userdata('user_id'),
                'CreateDate'     => date('Y-m-d H:i:s'),
                'IsAppove'       => 1
            );

            $CI->db->insert('acc_transaction', $cosdr);


            redirect(base_url('Cmanufucturing/manage_products'));
        } else {
            $this->session->set_flashdata('error_message', "Error Occured");
            redirect(base_url('Cmanufucturing/manage_products'));
        }
    }


    public function sell_product()
    {
        $farmer = $this->input->post('farmer_id');
        $quantity = $this->input->post('quantity');
        $product_id = $this->input->post('product_id');
        $product_unit_price = $this->input->post('product_unit_price');

        if ($quantity > $this->Manfucturing->get_available_product_qunatity($product_id)) {
            $this->session->set_flashdata('error_message', "The quantity is more than the available quantity");
            redirect(base_url('Cmanufucturing/manage_products'));
        } else {

            $data = array(
                "farmer_id" => $farmer,
                "quantity" => $quantity,
                "product_id" => $product_id
            );

            if ($this->Manfucturing->add_product_sales($data)) {
                $CI = &get_instance();

                $transaction_id = $this->auth->generator(10);
                $headcode = $this->Customers->get_trx_head_code($farmer);        

                // add to transaction
                $cosdr = array(
                    'VNo'            =>  $transaction_id,
                    'Vtype'          =>  'Credit',
                    'VDate'          =>  date("Y-m-d"),
                    'COAID'          =>  $headcode,
                    'Narration'      =>  "Sell Product to Farmer " . $transaction_id,
                    'Debit'          =>  0,
                    'Credit'         => $quantity * $product_unit_price,
                    'IsPosted'       => 1,
                    'CreateBy'       => $this->session->userdata('user_id'),
                    'CreateDate'     => date('Y-m-d H:i:s'),
                    'IsAppove'       => 1
                );

                if($CI->db->insert('acc_transaction', $cosdr))
                {
                    $this->Manfucturing->update_product_available_quantity($quantity, $product_id);
                    $this->session->set_flashdata('message', "Sold Successfully");
                    redirect(base_url('Cmanufucturing/manage_products'));
                }

               
            }
        }
    }


    public function sales()
    {
        $id = $this->uri->segment(3);

        $data = $this->Manfucturing->get_product_sales($id);

        echo json_encode($data);
    }
}
