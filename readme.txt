TUTORIAL FOR THE COSTING CALCULATOR
INFORMATIONS
    - The tool helps to calculate the price of a virtual machine and its non-compute ressources.
    - The unit price's the one on ALSTOM and Microsoft Contract, from EA (Entreprise) Portal API.
    - The calculator also considers DXC discounts, and the Hybrid Benefits only if you select Windows OS.
SECTIONS
    - Compute.
    - Managed Disks (Non-Compute). 
    - Logs Area (Inputs View).
SECTIONS USAGE SPECIFICATIONS
    - Compute
        . Region : Only four (4) regions are actually considered.
        . OS : Windows (Hybrid Benefit) or Linux (Default OS  + OS price).
        . Subscription : Usage (Time / Consumption).
        . Serie : Serie of VM, considering the first letter of its name.
        . Virtual Machine : The one you need (RAM AND CPU will be added in a next future).
        . Uptime : Running cycle of the compute (processor). No uptime for a reserved one.
        . Environment : DXC discount also depends on the environment.
    - Managed Disks
        . Type : HDD and SSD type (Premium / Standard), automatically selected depending on the VM you've choosen.
        . Redundancy : Actually LRS / ZRS (Others will be considered on a next future).
        . Disks : The one you need, with storage capacity.
    - Logs Area
        - It's a realtime resume of your actions.
        - Outputs are packaged as and accordion.
OUTPUTS
    - Azure : It returns the ressource price, given by Microsoft, without any additional charges.
    - DXC : It returns DXC discount on the selected ressource.
    - Licenses : OS Licenses price, depending on core number.
    - total : Total charges by SECTIONS
Good to know :
    - Selections are linked, and all depends of the previous one(s)
    - You cannot ad a new if you didn't yet fill all the required Selections
    - You can export your selections to .XLS format



    DigiCertGlobalRootCA.crt.pem

    Server="rct-projects-server.mysql.database.azure.com";UserID = "RCT_Projects_Admin";Password="Admin_Server_33";Database="alstom_costing_calculator";SslMode=MySqlSslMode.Required;SslCa="DigiCertGlobalRootCA.crt.pem";