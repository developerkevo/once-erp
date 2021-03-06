<?php

class Lbreed{


    public function breed_add_form() {
        $CI = & get_instance();
        $data = array();
        $breedForm = $CI->parser->parse('herd/add_breed', $data, true);
        return $breedForm;
    }

    public function breeds($data){
        $CI =& get_instance();
        $data = array(
            "breeds" => $data
        );
        $breeds = $CI->parser->parse('herd/breeds',$data,true);
        return $breeds;
    }


}