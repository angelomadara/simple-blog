<?php

function readable_date($date,$format = null){
    if($date){
        if($format != null) $format = $format;
        else $format = 'M d, Y';
        return date($format,strtotime($date));
    }
    return false;
}

function readable_datetime($date,$format = null){
    if($date){
        if($format != null) $format = $format;
        else $format = 'M d, Y H:i A';
        return date($format,strtotime($date));
    }
    return false;
}

function title_case($string){
    return ucwords(strtolower($string));
}