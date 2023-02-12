<?php
// https://www.youtube.com/watch?v=8T4zOV8iHD0
use function PHPSTORM_META\map;
// Server="rolandtest3-server.mysql.database.azure.com";UserID = "jvdwzkzpuz@rolandtest3-server";Password="HNYO434SB660244Z$";Database="alstom_costing_calculator";
// Data Source=tcp;rolandtest3-server.mysql.database.azure.com,1433;Initial Catalog=rolandtest3-server;User Id=jvdwzkzpuz
// $con = mysqli_init(); mysqli_ssl_set($con,NULL,NULL, "NULL", NULL, NULL); mysqli_real_connect($conn, "rolandtest3-server.mysql.database.azure.com", "jvdwzkzpuz", "HNYO434SB660244Z$", "alstom_costing_calculator", 3306, MYSQLI_CLIENT_SSL);
include "functions.php";
// include "storage.php";

$pdo = bdd_access();
global $currency;
$currency = devisesImport();
$id = 'accId';

$winLic = "1.25";
$linLic = "2";

$currencyCode = "currencyCode";
$tierMinimumUnits = "tierMinimumUnits";
$reservationTerm = "reservationTerm";
$retailPrice = "retailPrice";
$unitPrice = "unitPrice";
$armRegionName = "armRegionName";
$location = "location";
$effectiveStartDate = "effectiveStartDate";
$effectiveEndDate = "effectiveEndDate";
$meterId = "meterId";
$productId = "productId";
$skuId = "skuId";
$productName = "productName";
$skuName = "skuName";
$serviceName = "serviceName";
$serviceId = "serviceId";
$serviceFamily = "serviceFamily";
$unitOfMeasure = "unitOfMeasure";
$type = "type";
$isPrimaryMeterRegion = "isPrimaryMeterRegion";
$armSkuName = "armSkuName";
$meterName = "meterName";
$offerId = "offerId";
$payg = "Pay As You Go";



$Service = "Service";
$unitOfMeasure = "Unit of Measure";
$IncludedQuantity = "Included Quantity ";
$PartNumber = "Part Number";
$UnitPrice = "Unit Price";


// $storage = array();


function numberExtraction($elm)
{
    $nbr = (int) filter_var($elm, FILTER_SANITIZE_NUMBER_INT);
    return $nbr;
}

function getCoreNum($vm)
{
    if (!strpos($vm, '/') === false) {
        list($pref, $suff) = explode("/", $vm);
        $vm = $suff;
    }
    if (!strpos($vm, 'v') === false) {
        list($pref, $suff) = explode("v", $vm);
        $int = (int) filter_var($pref, FILTER_SANITIZE_NUMBER_INT);
    } else {
        $int = (int) filter_var($vm, FILTER_SANITIZE_NUMBER_INT);
    }

    $int = numberExtraction($int);
    return $int;
}

function diskHeight($elm)
{
    $nbr = (int) filter_var($elm, FILTER_SANITIZE_NUMBER_INT);
    switch ($nbr) {
        case '1':
            $nbr = '4 Gio';
            break;
        case '2':
            $nbr = '8 Gio';
            break;
        case '3':
            $nbr = '16 Gio';
            break;
        case '4':
            $nbr = '32 Gio';
            break;
        case '6':
            $nbr = '64 Gio';
            break;
        case '10':
            $nbr = '128 Gio';
            break;
        case '15':
            $nbr = '256 Gio';
            break;
        case '20':
            $nbr = '512 Gio';
            break;
        case '30':
            $nbr = '1 To';
            break;
        case '40':
            $nbr = '2 To';
            break;
        case '50':
            $nbr = '4 To';
            break;
        case '60':
            $nbr = '8 To';
            break;
        case '70':
            $nbr = '16 To';
            break;
        case '80':
            $nbr = '32 To';
            break;
    }
    return $nbr;
}


$field = empty($_GET['field']) ? 'region' : $_GET['field'];

if (!empty($_GET['field'])) {
    switch ($field) {
        case 'operatingSystem':
            $region = $_GET['selection'];
            $table = 'atRegions';

            // Request os from database
            $operatingSystem = $pdo->prepare(
                "SELECT * 
                                              FROM osSoftware"
            );
            $operatingSystem->execute();
            $items = $operatingSystem->fetchAll();

            // On renvoie les données au format JSON en choisissant des clefs spécifiques
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['name'],
                    'value' => $item['name']
                ];
            }, $items));
            break;

        case 'subscription':
            $os = $_GET['selection'];

            $table = 'subscriptionType';
            //6. series
            $subType = $pdo->prepare("SELECT * FROM $table");
            $subType->execute();

            $items = $subType->fetchAll();
            // On renvoie les données au format JSON en choisissant des clefs spécifiques
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['subType'],
                    'value' => $item['id'] . ' | ' . $item['value']
                ];
            }, $items));
            break;

        case 'serie':
            $subscription = $_GET['selection'];
            $table = 'vmSeries';
            //6. series
            $serie = $pdo->prepare("SELECT * FROM vmSeries");
            $serie->execute();

            $items = $serie->fetchAll();
            // On renvoie les données au format JSON en choisissant des clefs spécifiques
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['name'],
                    'value' => $item['code']
                ];
            }, $items));
            break;

        case 'instance':
            $region = $_GET['location'];
            $os = $_GET['os'];
            $subtype = $_GET['subs'];
            $serie = $_GET['selection'];
            $serie = "Virtual Machines " . $serie;

            list($op, $sub) = explode(" | ", $subtype);
            $operator = (float) $op;
            $subType = $sub;

            $reg = $region . " 2";

            if (!strcmp($subType, $payg)) {

                if (!strcmp($os, "Windows")) {
                    $table = 'eadata';
                    $instances = $pdo->prepare("SELECT DISTINCT *, SUBSTRING_INDEX(SUBSTRING_INDEX($meterName, ' - ', 2), ' - ', -1)
                                        AS Instances
                                        FROM $table 
                                        WHERE $meterName
                                        LIKE '%Virtual Machines%'
                                        AND $meterName
                                        LIKE :location 
                                        AND $meterName
                                        NOT LIKE :os
                                        AND $meterName
                                        LIKE :serie
                                        AND meterName
                                        NOT LIKE '%ADHType%'
                                        AND $meterName
                                        NOT LIKE 'Dev%' 
                                        AND $meterName
                                        NOT LIKE '%Low%' 
                                        AND $meterName
                                        NOT LIKE '%Spot%' 
                                        AND $meterName 
                                        NOT LIKE '%Basic%'
                                        AND $meterName 
                                        NOT LIKE '%Ex%' 
                                        AND $meterName 
                                        NOT LIKE '%Promo%' 
                                        AND $offerId 
                                        NOT LIKE '%MS-AZR-0148P%'
                                        ORDER BY Instances ASC");
                    $instances->bindValue('os', '%' . $os . '%');
                    $instances->bindValue('location', '%' . $region . '%');
                    $instances->bindValue('serie', '%' . $serie . '%');
                    $instances->execute();


                    $items = $instances->fetchAll();
                    // On renvoie les données au format JSON en choisissant des clefs spécifiques
                    header('Content-Type: application/json');
                    echo json_encode(array_map(function ($item) {
                        return [
                            'label' => $item['Instances'],
                            'value' => $item['id'] . ' | ' . $item['unitPrice'] . ' | ' . getCoreNum($item['Instances']) . ' | ' . $item['Instances'] . ' | ' .  numberExtraction($item['unitOfMeasure'])
                        ];
                    }, $items));
                } else {
                    $table = 'eadata';
                    $instances = $pdo->prepare("SELECT DISTINCT *, SUBSTRING_INDEX(SUBSTRING_INDEX($meterName, ' - ', 2), ' - ', -1)
                                        AS Instances
                                        FROM $table 
                                        WHERE $meterName
                                        LIKE '%Virtual Machines%'
                                        AND $meterName
                                        LIKE :location 
                                        AND $meterName
                                        NOT LIKE :os
                                        AND $meterName
                                        LIKE :serie
                                        AND $meterName
                                        NOT LIKE 'Dev%' 
                                        AND $meterName
                                        NOT LIKE '%Low%' 
                                        AND $meterName
                                        NOT LIKE '%Spot%' 
                                        AND $meterName 
                                        NOT LIKE '%Basic%'
                                        AND $meterName 
                                        NOT LIKE '%Ex%' 
                                        AND $meterName 
                                        NOT LIKE '%Promo%' 
                                        AND $offerId 
                                        NOT LIKE '%MS-AZR-0148P%'
                                        ORDER BY Instances ASC");
                    $instances->bindValue('os', '%' . $os . '%');
                    $instances->bindValue('location', '%' . $region . '%');
                    $instances->bindValue('serie', '%' . $serie . '%');
                    $instances->execute();


                    $items = $instances->fetchAll();
                    // On renvoie les données au format JSON en choisissant des clefs spécifiques
                    header('Content-Type: application/json');
                    echo json_encode(array_map(function ($item) {
                        return [
                            'label' => $item['Instances'],
                            'value' => $item['id'] . ' | ' . $item['unitPrice'] . ' | ' . getCoreNum($item['Instances']) . ' | ' . $item['Instances'] . ' | ' .  numberExtraction($item['unitOfMeasure'])
                        ];
                    }, $items));
                }
            } else {
                // include "fetcher.php";
                // $url = "https://prices.azure.com/api/retail/prices?$filter=priceType%20eq%20%27Reservation%27%20and%20serviceName%20eq%20%27Virtual%20Machines%27";
                // $url += "%20and%20location%20eq%20%27".$region."%27";
                $table = 'rezdata';
                $instances = $pdo->prepare("SELECT DISTINCT * 
                                            FROM $table 
                                            WHERE $productName 
                                            LIKE '%Virtual Machines%'
                                            AND $location 
                                            LIKE :location 
                                            AND $productName 
                                            LIKE :serie 
                                            AND $reservationTerm
                                            LIKE :subType
                                            AND $type 
                                            NOT LIKE 'Dev%' 
                                            AND $skuName 
                                            NOT LIKE '%Low%' 
                                            AND $skuName 
                                            NOT LIKE '%Spot%' 
                                            AND $productName
                                            NOT LIKE '%Basic%'  
                                            ORDER BY $skuName ASC");
                // $instances->bindValue('os', '%' . $os . '%');
                $instances->bindValue('location', '%' . $region);
                $instances->bindValue('serie', '%' . $serie . '%');
                $instances->bindValue('subType', '%' . $subType . '%');
                $instances->execute();


                $items = $instances->fetchAll();
                // On renvoie les données au format JSON en choisissant des clefs spécifiques
                header('Content-Type: application/json');
                echo json_encode(array_map(function ($item) {
                    return [
                        'label' => $item['meterName'],
                        'value' => $item['accId'] . ' | ' . $item['unitPrice'] . ' | ' . getCoreNum($item['meterName']) . ' | ' . $item['meterName']
                    ];
                }, $items));
            }
            break;

        case 'uptime':
            $region = $_GET['location'];
            $os = $_GET['os'];
            $subtype = $_GET['subs'];
            $serie = $_GET['serie'];
            $instances = $_GET['selection'];

            list($op, $sub) = explode(" | ", $subtype);
            $operator = $op;
            $subType = $sub;
            // On renvoie les données au format JSON en choisissant des clefs spécifiques
            if (!strcmp($subType, $payg)) {
                $uptime = $pdo->prepare("SELECT * FROM upTime");
                $uptime->execute();
                $items = $uptime->fetchAll();
                header('Content-Type: application/json');
                echo json_encode(array_map(function ($item) {
                    return [
                        'label' => $item['time'],
                        'value' => $item['value']
                    ];
                }, $items));
            } else {
                $uptime = $pdo->prepare("SELECT * FROM upTime WHERE value LIKE '1'");
                $uptime->execute();
                $items = $uptime->fetchAll();
                header('Content-Type: application/json');
                echo json_encode(array_map(function ($item) {
                    return [
                        'label' => $item['time'],
                        'value' => $item['value']
                    ];
                }, $items));
            }
            break;

        case 'environment':
            $region = $_GET['location'];
            $os = $_GET['os'];
            $subtype = $_GET['subs'];
            $serie = $_GET['serie'];
            $instances = $_GET['instance'];
            $uptime = $_GET['selection'];

            $env = $pdo->prepare("SELECT * FROM dxcEnvType");
            $env->execute();
            $items = $env->fetchAll();
            // On renvoie les données au format JSON en choisissant des clefs spécifiques
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['value'],
                    'value' => $item['price']
                ];
            }, $items));
            break;

        case 'type':
            $region = $_GET['location'];
            $os = $_GET['os'];
            $subtype = $_GET['subs'];
            $serie = $_GET['serie'];
            $instances = $_GET['instance'];
            $uptime = $_GET['uptime'];
            $environment = $_GET['selection'];


            // CATEGORY dxc md
            $category = $pdo->prepare("SELECT per FROM dxcNcCategory WHERE id LIKE '%2%'");
            $category->execute();

            if (strpos($instances, 's')) {
                $diskType = $pdo->prepare("SELECT * FROM diskType");
                $diskType->execute();
            } else {
                $diskType = $pdo->prepare("SELECT * FROM diskType WHERE name NOT LIKE '%PREMIUM%'");
                $diskType->execute();
            }

            $items = $diskType->fetchAll();

            // On renvoie les données au format JSON en choisissant des clefs spécifiques
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['name'],
                    'value' => $item['name']
                ];
            }, $items));
            break;

        case 'redundancy':
            $region = $_GET['location'];
            $os = $_GET['os'];
            $subtype = $_GET['subs'];
            $serie = $_GET['serie'];
            $instances = $_GET['instance'];
            $uptime = $_GET['uptime'];
            $environment = $_GET['env'];
            $disktype = $_GET['selection'];

            $red = $pdo->prepare("SELECT * FROM storageType");
            $red->execute();

            $items = $red->fetchAll();

            // On renvoie les données au format JSON en choisissant des clefs spécifiques
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['code'],
                    'value' => $item['code']
                ];
            }, $items));
            break;

        case 'datadisks':
            $region = $_GET['location'];
            $os = $_GET['os'];
            $subtype = $_GET['subs'];
            $serie = $_GET['serie'];
            $instances = $_GET['instance'];
            $uptime = $_GET['uptime'];
            $environment = $_GET['env'];
            $disktype = $_GET['type'];
            $redundancy = $_GET['selection'];

            if (!strcmp($redundancy, "LRS")) {
                $disk = $pdo->prepare("SELECT *, SUBSTRING_INDEX(SUBSTRING_INDEX($Service, ' - ', 2), ' - ', -1) 
                        AS Disks 
                        FROM data 
                        WHERE $Service 
                        -- LIKE :redundancy 
                        -- AND $Service 
                        LIKE :location 
                        AND $Service 
                        LIKE '%Managed Disks%' 
                        AND $Service 
                        LIKE :disktype 
                        AND $Service 
                        NOT LIKE '%Dev%' 
                        AND $Service 
                        NOT LIKE '%Promo%'
                        AND $Service 
                        NOT LIKE '%Expired%'  
                        AND $Service 
                        NOT LIKE '%Basic%'  
                        AND $Service 
                        NOT LIKE '%Snapshots%' 
                        AND $Service 
                        NOT LIKE '%Mounts%'
                        AND $Service 
                        NOT LIKE '%Special%'
                        AND $Service 
                        NOT LIKE '%ZRS%'
                        AND $Service 
                        NOT LIKE '%Burst%'
                        ORDER BY Disks ASC ");
                // $disk->bindValue('redundancy', '%' . $redundancy . '%');
                $disk->bindValue('location', '%' . $region . '%');
                $disk->bindValue('disktype', '%' . $disktype . '%');
            } else {
                $disk = $pdo->prepare("SELECT *, SUBSTRING_INDEX(SUBSTRING_INDEX($Service, ' - ', 2), ' - ', -1) 
                        AS `Disks` 
                        FROM data
                        WHERE $Service
                        LIKE :location 
                        AND $Service 
                        LIKE '%Managed Disks%'
                        AND $Service 
                        LIKE :disktype  
                        AND $Service
                        NOT LIKE '%Dev%' 
                        AND $Service
                        NOT LIKE '%Promo%'
                        AND $Service 
                        NOT LIKE '%Expired%'  
                        AND $Service 
                        NOT LIKE '%Basic%'  
                        AND $Service 
                        NOT LIKE '%Snapshots%' 
                        AND $Service
                        NOT LIKE '%Mounts%'
                        AND $Service 
                        NOT LIKE '%Special%'
                        AND $Service
                        NOT LIKE '%LRS%' 
                        AND $Service 
                        NOT LIKE '%Burst%'
                        ORDER BY `Disks` ASC ");
                // $disk->bindValue('redundancy', '%' . $redundancy . '%');
                $disk->bindValue('location', '%' . $region . '%');
                $disk->bindValue('disktype', '%' . $disktype . '%');
            }


            $disk->execute();

            $items = $disk->fetchAll();
            // On renvoie les données au format JSON en choisissant des clefs spécifiques
            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['Disks'] . ' (' . diskHeight($item['Disks']) . ')',
                    'value' => $item['id'] . ' | ' . $item['Unit Price'] . ' | ' . numberExtraction($item['Unit of Measure']) . ' | ' . $item['Disks']
                ];
            }, $items));
            break;

        case 'total':
            $region = $_GET['location'];
            $os = $_GET['os'];
            $subtype = $_GET['subs'];
            $serie = $_GET['serie'];
            $instances = $_GET['instance'];
            $uptime = $_GET['uptime'];
            $environment = $_GET['env'];
            $disktype = $_GET['type'];
            $redundancy = $_GET['redundancy'];

            $dd = $_GET['selection'];

            $region = $pdo->prepare("SELECT * FROM atRegions");
            $region->execute();
            $items = $region->fetchAll();

            header('Content-Type: application/json');
            echo json_encode(array_map(function ($item) {
                return [
                    'label' => $item['value'],
                    'value' => $item['value']
                ];
            }, $items));
            break;


        default:

            // Region Selection
            $region = $pdo->prepare("SELECT * FROM atRegions");
            $region->execute();

            break;
    }
} else {
    $region = $pdo->prepare("SELECT * FROM atRegions");
    $region->execute();
}
