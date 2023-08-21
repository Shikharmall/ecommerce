
var x = 0;
var z = 90;
var y;

function fucnincrement(){
    
    x = x+1;

    document.getElementById("numb").innerText = x;
    
    y = z*x;

    document.getElementById("pricetag").innerText = "Sub Total: Rs "+y;
    document.getElementById("pricetagtotal").innerText = "Total Amount: Rs "+y;
}



function fucndecrement(){
    
    x = x-1;
    if(x<1){
        x = 1;
        document.getElementById("numb").innerText = x;
    }
    else{
        
        y = z*x;
        document.getElementById("numb").innerText = x;
        document.getElementById("pricetag").innerText = "Sub Total: Rs "+y;
        document.getElementById("pricetagtotal").innerText = "Total Amount: Rs "+y;
    }
}

