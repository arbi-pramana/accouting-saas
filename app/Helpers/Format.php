<?php

namespace App\Helpers;

class Format{
    
    function price($amount){
        return "Rp. ".number_format($amount,2);
    }

    public function date_format($date)
    {
        return date("d M Y",strtotime($date));
    }
}