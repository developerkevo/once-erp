<?php

class LCow{


    public function cows($data){
        $CI =& get_instance();
        $data = array(
            "routes" => $data[1],
            "breeds" => $data[0],
            "farmers" => $data[2]
        );
        $routes = $CI->parser->parse('herd/manage_cows',$data,true);
        return $routes;
    }


}