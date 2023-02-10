<?php

$region = array();










header('Content-Type: application/json; charset=utf-8');


// Url encoding function to avoid variable errors





function myUrlEncode($string) {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
}

$url = "https://prices.azure.com/api/retail/prices";


// A- Compute data

// 1. Virtual Machines
$virtual_machines_json = (file_get_contents(myUrlEncode("https://prices.azure.com/api/retail/prices?%24filter=serviceName%20eq%20%27Virtual%20Machines%27")));
$virtual_machines_array = json_decode($virtual_machines_json, true);
// print_r($virtual_machines_array);

// 2. Regions
$location_json = (file_get_contents(myUrlEncode("https://prices.azure.com/api/retail/prices?%24filter=serviceName%20eq%20%27Virtual%20Machines%27")));
$location_array = json_decode($virtual_machines_json, true);
// print_r($virtual_machines_array);


$compute = (file_get_contents(myUrlEncode("https://prices.azure.com/api/retail/prices?%24filter=serviceFamily%20eq%20%27Compute%27")));
$compute_data = json_decode($compute, true);
while ($a <= 10) {
    # code...
}

echo ("Compute Sort ");
print_r($compute_data);

// 1. a/ Sort Compute

// - By Instance

// - By Os/Software

// - By Series

// - By Region

// - By Currency




$cpt = 0;

$by_Windows = array();

for ($i=0; $i < count($data["Items"]); $i++) { 
    # code...
    if (strpos($data["Items"][$i]["productName"], 'Windows')) {
        # code...
        $cpt++;
        array_push($by_Windows, $data["Items"][$i]);
    }
}


// echo ("Windows Sort");
// print_r($by_Windows);


// By Linux


?>