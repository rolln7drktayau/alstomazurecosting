<?php

// https://prices.azure.com/api/retail/prices

// header('Content-Type: application/json; charset=utf-8');

// Url encoding function to avoid variable errors
function myUrlEncode($string) {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", " ", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
};

function fetchIt($url) {
    
}

$data = json_decode(file_get_contents(myUrlEncode($url)), true);
$tab = array();

// array_push($tab, $data);
// print_r($tab);
// print_r($data["Count"]);

// $cpt = 100;
while ($data["NextPageLink"]) {
    # code...
    // print_r($data["Count"].'<br>');
    // $cpt = $cpt + 100;
    array_push($tab, $data);
    $data = json_decode(file_get_contents(myUrlEncode($data["NextPageLink"])), true);
    print_r($data["Count"].'<br>');
}

?>