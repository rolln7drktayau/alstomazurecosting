
class Charges {
    licenses;
    azureCharges;
    dxcCharges;
    totalCharges;

    constructor() {
        this.licenses = 0;
        this.azureCharges = 0;
        this.dxcCharges = 0;
        this.totalCharges = 0;
    }

    setChargesTotalPrice(){
        this.totalCharges = this.azureCharges + this.dxcCharges + this.licenses;
    }

    getChargesTotalPrice(){
        this.setChargesTotalPrice();
        return this.totalCharges;
    }

    displayIt() {
        return "SUMMARY\n-------\n" +
               "   Licenses: " + this.licenses + 
               "   Az: " + this.azureCharges +
               "   DXC: " + this.dxcCharges +
               "   Total: " + this.totalCharges;
    }

    showIt() {
        return "SUMMARY<br>-------" +
               "<br>Licenses: " + this.licenses + " €" +
               "<br>Az - " + this.azureCharges + " €" +
               "<br>DXC - " + this.dxcCharges + " €" +
               "<br>Total - " + this.totalCharges + " €";
    }
}

class Instance {
    name;
    price;
    core;

    constructor() {
        this.name = "Inst code"
        this.price = 0;
        this.core = 0;
    }

    displayIt() {
        return this.name + " - " + this.price;
    }

    getInstanceName() {
        return this.name;
    }

    showIt() {
        return this.core + " core(s) - " + this.price + " €";
    }
}

class Disk {
    name;
    price;

    constructor() {
        this.price = 0.0;
    }

    displayIt() {
        return this.name + " - " + this.price;
    }

    showIt() {
        return this.name + " - " + this.price + " €";
    }
}

class Environment {
    name;
    charges;

    constructor() {
        this.name = "Env";
        this.charges = 0.0;
    }

    displayIt() {
        return this.name + " - " + this.charges;
    }

    showIt() {
        return this.name + " - " + this.charges+ " €";
    }
}

class Price {
    azurePrice;
    dxcPrice;
    totalPrice;

    constructor() {
        this.azurePrice = 0;
        this.dxcPrice = 0;
        this.totalPrice = 0;
    }

    displayIt() {
        return "   Az: " + this.azurePrice +
               "   DXC: " + this.dxcPrice +
               "   Total: " + this.totalPrice;
    }

    showIt() {
        return "<br>Az - " + this.azurePrice + " €" +
               "<br>DXC - " + this.dxcPrice + " €" +
               "<br>Total - " + this.totalPrice + " €";
    }
}

class Compute {
    region;
    operatingSystem;
    subscription;
    serie;
    instance;
    uptime;
    environment;
    price;

    constructor() {
        // this.serie = getInstanceName();
        this.instance = new Instance();
        this.uptime = 1.0;
        this.environment = new Environment();
        this.price = new Price();
    }

    getComputeAzurePrice() {
        this.price.azurePrice = this.instance.price * this.uptime;
        return this.price.azurePrice;
    }

    getComputeDxcPrice() {
        this.price.dxcPrice = + this.environment.charges;
        return this.price.dxcPrice;
    }

    getComputeTotalPrice() {
        this.price.totalPrice = (this.instance.price * this.uptime) + this.environment.charges;
        return this.price.totalPrice;
    }

    displayIt() {
        return this.region + "\n" +
               this.operatingSystem + "\n" +
               this.subscription + "\n" +
               this.serie + "\n" +
               this.instance.displayIt() + "\n" +
               this.uptime + "\n" +
               this.environment.displayIt() + "\n" +
               "Total\n" + this.price.displayIt() + "\n"
    }

    showIt() {
        return this.region + "<br>" +
               this.operatingSystem + "<br>" +
               this.subscription + "<br>" +
               this.serie + " - " + this.instance.getInstanceName() + "<br>" +
               this.instance.showIt() + "<br>" +
               this.uptime + " use<br>" +
               this.environment.showIt() + "<br>" +
               "[SUM]" + this.price.showIt() + "<br>"
    }
}

class ManagedDisks {
    type;
    redundancy;
    disk;
    price;

    constructor() {
        this.disk = new Disk();
        this.price = new Price();
    }

    getManagedDisksAzurePrice() {
        return this.price.azurePrice;
    }

    getManagedDisksDxcPrice() {
        this.price.dxcPrice = (+0.2051) * this.price.azurePrice;
        return this.price.dxcPrice;
    }

    getManagedDisksTotalPrice() {
        this.price.totalPrice = (+ this.price.azurePrice + this.price.dxcPrice);
        return this.price.totalPrice;
    }

    displayIt() {
        return this.type + "\n" +
               this.redundancy + "\n" +
               this.disk.displayIt() + "\n" +
               "Total\n" + this.price.displayIt() + "\n";
    }

    showIt() {
        return this.type + "<br>" +
               this.redundancy + "<br>" +
               this.disk.showIt() + "<br>" +
               "[SUM]" + this.price.showIt() + " €" + "<br>";
    }
}

class Machine {
    compute;
    managedDisks = [];
    charges;

    constructor() {
        this.compute = new Compute();
        this.managedDisks = [];
        this.charges = new Charges();
    }

    getComputeAzurePrice() {
        return this.compute.getComputeAzurePrice();
       }

    getComputeDxcPrice(){
        return this.compute.getComputeDxcPrice();
    }

    getManagedDisksAzurePrice() {
        let ans = 0;
        for (let i = 0; i < this.managedDisks.length; i++) {
            ans = (+ ans + this.managedDisks[i].getManagedDisksAzurePrice());
        }
        return ans;
    }

    getManagedDisksDxcPrice(){
        let ans = 0;
        for (let i = 0; i < this.managedDisks.length; i++) {
            ans = (+ ans + this.managedDisks[i].getManagedDisksDxcPrice());
        }
        return ans;
    }

    setCharges(){
        this.charges.azureCharges = this.compute.price.azurePrice + this.getManagedDisksAzurePrice();
        this.charges.dxcCharges = this.compute.price.dxcPrice + this.getManagedDisksDxcPrice();
        this.charges.totalCharges = (+ this.charges.getChargesTotalPrice());
    }

    getTotalPrice() {
        this.setCharges();
        return (+ this.compute.getComputeTotalPrice() + this.managedDisks.getManagedDisksTotalPrice() + this.charges.getChargesTotalPrice());
    }

    displayMd() {
        let out = "";
        for (let i = 0; i < this.managedDisks.length; i++) {
            out +="\n"+this.managedDisks[i].displayIt();
        }
        return out;
    }

    displayIt() {
        return "COMPUTE\n-------\n" + this.compute.displayIt() +
               "\nMANAGED DISKS\n-------------" + this.displayMd() +
               "\n\n" + this.charges.displayIt() +"\n";
    }

    showMd() {
        let out = "<br>";
        for (let i = 0; i < this.managedDisks.length; i++) {
            out +="___<br>"+this.managedDisks[i].showIt();
        }
        return out;
    }

    showIt() {
        return "COMPUTE<br>-------<br>" + this.compute.showIt() +
               "<br>MANAGED DISKS<br>-------------" + this.showMd() +
               "<br>" + this.charges.showIt() + "<br>";
    }

}

class Cart {
    cartId;
    machines = [];

    constructor() {
        this.cartId = 0;
        this.machines = [];
    }

    displayIt(){
        let ans = "";
        for (let i = 0; i < this.machines.length; i++) {
            ans += this.machines[i].displayIt();
        }
        console.log(ans);
    }

    showIt(){
        let mac = "";
        for (let i = 0; i < this.machines.length; i++) {
            mac += this.machines[i].showIt() + "__________<br>";
        }
        return mac;
    }
}