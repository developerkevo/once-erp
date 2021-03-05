<?php

class LRoute{


    public function route_add_form() {
        $CI = & get_instance();
        $data = array();
        $routeForm = $CI->parser->parse('herd/add_route', $data, true);
        return $routeForm;
    }

    public function routes($data){
        $CI =& get_instance();
        $data = array(
            "routes" => $data
        );
        $routes = $CI->parser->parse('herd/routes',$data,true);
        return $routes;
    }


}