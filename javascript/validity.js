function myFuncValidPin(val) {
    /*document.getElementById("demo").innerHTML = val;*/
    let x = val.length;
    let y = "Invalid pincode";
    let z = "";
    if(x>6){
        document.getElementById("pincode").style.borderColor = "red";
        document.getElementById("demo").style.display ="block";
        document.getElementById("demo").innerHTML = y;
    }
    else{
        document.getElementById("pincode").style.borderColor = "#00b9f5";
        document.getElementById("demo").style.display ="none";
        document.getElementById("demo").innerHTML = z;
    }
}


function myFuncValidPhone(val) {
    /*document.getElementById("demo").innerHTML = val;*/
    let x = val.length;
    let y = "Phone Number can be only of 10 digits";
    let z = "";
    if(x>10){ 
        document.getElementById("phone").style.borderColor = "red";
        document.getElementById("demo1").style.display ="block";
        document.getElementById("demo1").innerHTML = y; 
    }
    else{
        document.getElementById("phone").style.borderColor = "#00b9f5";
        document.getElementById("demo1").style.display ="none";
        document.getElementById("demo1").innerHTML = z;
    }
}