<?php
// session_start();
// include "functions.php";
// include './scripts/php/storage.php';
include './scripts/php/data.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <meta name="ALSTOM" content="ALSTOM">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="-1" />
    <link rel="shortcut icon" href="./assets/logos/Alstom_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./scripts/css//main.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script> -->
    <!-- <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    <!-- <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
		
      <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
      </script> -->
    <title>Alstom Azure Costing</title>
</head>

<body class="container">
    <div class="header-Area"></div>
    <div class="Main-Title-Area" draggable="true">
        ALSTOM COSTING CALCULATOR
    </div>
    <div class="Compute-Title-Area"> COMPUTE </div>
    <div class="Compute-Area">
        <div class="Region-Label"> REGION </div>
        <select id="region" name="region" class="form-control linked-select Region-Select" data-target="#operatingSystem" data-source="./scripts/php/data.php?field=operatingSystem&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
            <?php while ($data_1 = $region->fetch()) { ?>
                <option value="<?php echo $data_1['value']; ?>">
                <?php echo $data_1['value'];
            } ?>
                </option>
        </select>

        <div class="Operating-System-Label"> OPERATING SYSTEM </div>
        <select id="operatingSystem" name="operatingSystem" class="form-control linked-select for-selection Operating-System-Select" data-target="#subscription" data-source="./scripts/php/data.php?field=subscription&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
            <!-- <label for="reservation" class="reserved" style="display : none;">Reserved </label>
                <input type="radio" name="reserved" id="reserved" class="reserved" style="display : none;">
                <label for="hb" class="hb" style="display : none;">Hybrid Benefit</label>
                <input type="radio" name="hb" id="hb" class="hb" style="display : none;"> -->
            <!-- If WINDOWS, then Hybrid Benefit and we bring our own license -->
        </select>

        <div class="Subscription-Label"> SUBSCRIPTION </div>
        <select id="subscription" name="subscription" class="form-control linked-select Subscription-Select" data-target="#serie" data-source="./scripts/php/data.php?field=serie&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>

        <div class="Serie-Label"> SERIE </div>
        <select id="serie" name="serie" class="form-control linked-select Serie-Select" data-target="#instance" data-source="./scripts/php/data.php?field=instance&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>
        <div class="Virtual-Machine-Label"> VIRTUAL MACHINE </div>
        <select id="instance" name="instance" class="form-control linked-select Virtual-Machine-Select" data-target="#uptime" data-source="./scripts/php/data.php?field=uptime&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>
        <div class="Uptime-Label"> UPTIME </div>
        <select id="uptime" name="uptime" class="form-control linked-select Uptime-Select" data-target="#environment" data-source="./scripts/php/data.php?field=environment&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>
        <div class="Environment-Label"> ENVIRONMENT </div>
        <select id="environment" name="environment" class="form-control linked-select Environment-Select" data-target="#type" data-source="./scripts/php/data.php?field=type&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>


        <div class="Compute-Price-Area">
            <div class="Azure-Compute-Price-Label"> AZURE </div>
            <textarea class="Azure-Compute-Price" readonly> 0.0 € </textarea>
            <div class="DXC-Compute-Price-Label"> DXC </div>
            <textarea class="DXC-Compute-Price" readonly> 0.0 €</textarea>
            <div class="Compute-Total-Price-Label"> TOTAL </div>
            <textarea class="Compute-Total-Price" readonly> 0.0 €</textarea>
        </div>

    </div>

    <div class="Managed-Disks-Title-Area"> MANAGED DISKS </div>
    <div class="Managed-Disks-Area">
        <div class="Type-Label"> TYPE </div>
        <select id="type" name="type" class="form-control linked-select Type-Select" data-target="#redundancy" data-source="./scripts/php/data.php?field=redundancy&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>
        <div class="Redundancy-Label"> REDUNDANCY </div>
        <select id="redundancy" name="redundancy" class="form-control linked-select Redundancy-Select" data-target="#datadisks" data-source="./scripts/php/data.php?field=datadisks&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>
        <div class="Data-Disks-Label"> DISKS </div>
        <select id="datadisks" name="datadisks" class="form-control linked-select Data-Disks-Select" data-target="#total" data-source="./scripts/php/data.php?field=total&selection=$id">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>
        <div class="total" style="display : none;"> total </div>
        <select id="total" name="total" class="form-control linked-select Total-Elmt" data-source="./scripts/php/data.php?field=end&selection=$id" style="display : none;">
            <option value='0' selected disabled>-- SELECT --</option>
        </select>

        <!-- <div id="total" class="Managed-Disks-Price-Area"> PRICE <label for="mdPrice" class="mdPrice"> = 0.00 €</label></div> -->
        <div class="Managed-Disks-Price-Area">
            <div class="Azure-Managed-Disks-Price-Label"> AZURE </div>
            <textarea class="Azure-Managed-Disks-Price" readonly> 0.0 €</textarea>
            <div class="DXC-Managed-Disks-Price-Label"> DXC </div>
            <textarea class="DXC-Managed-Disks-Price" readonly> 0.0 € </textarea>
            <div class="Managed-Disks-Total-Price-Label"> TOTAL </div>
            <textarea class="Managed-Disks-Total-Price" readonly> 0.0 €</textarea>
        </div>

        <button class="Managed-Disks-PopButton red" disabled> REMOVE </button>
        <button class="Managed-Disks-PushButton green" disabled> NEW DISK </button>

    </div>
    <div class="Total-Price-Area">
        <div class="Licenses-Label"> LICENSES </div>
        <textarea class="Licenses-Price" readonly>0.00 €</textarea>
        <div class="Azure-Charges-Label"> AZURE CHARGES </div>
        <textarea class="Azure-Charges-Price" readonly>0.00 €</textarea>
        <div class="DXC-Charges-Label"> DXC CHARGES </div>
        <textarea class="DXC-Charges-Price" readonly>0.00 €</textarea>
        <div class="Total-Price-Label"> TOTAL PRICE </div>
        <textarea class="Total-Price" readonly>0.00 € / MONTH</textarea>
    </div>


    <!-- Test -->
    <div class="Logs-Title-Area"> LOGS AREA </div>
    <div class="Logs-Area" id="Logs-Area">
        <!-- <textarea class="Log-Zone" name="" id="Log-Zone" wrap="off" cols="30" rows="50"></textarea> -->
    </div>


    <div class="Summary-Area">
        <textarea class="Summary" name="" id="Summary" wrap="off" readonly></textarea>
    </div>

    <div class="CD-Area">
        <button class="New-Project-Zone red" disabled>ADD NEW VM</button>
        <Button id="Done-Zone" class="Done-Zone green" disabled>DONE / EXPORT</Button>
    </div>

    <?php include './scripts/php/dialogs.php' ?>

    <div class="footer-Area Summ"></div>
    <script type="text/javascript" src="./app/js/app.js"></script>
    <script type="text/javascript" src="./app/js/objects.js"></script>
    <script type="text/javascript" src="./scripts/js/main.js"></script>
    <script type="text/javascript" src="./scripts/js/display.js"></script>
</body>

<!-- https://jsfiddle.net/RR6z5/1/  -->

</html>