<?php

class Lcow{


    public function cows($data){
        $CI =& get_instance();
        $cows = $CI->parser->parse('herd/manage_cows',$data,true);
        return $cows;
    }


}