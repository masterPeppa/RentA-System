//renters
//checking if the email is already exist
function showEmail(){ 
    var txtEmail = document.getElementById("rEmail");
    var allowedDomains = ["yahoo.com", "gmail.com", "bulsu.edu.ph"];
    var isValidDomain = allowedDomains.some(function(domain) {
        return txtEmail.value.endsWith("@" + domain);
    });

    if (txtEmail.value == "") {
        txtEmail.setCustomValidity("Please enter your email address!");
        txtEmail.reportValidity();
    }
    else if (!isValidDomain) {
        txtEmail.setCustomValidity("Please enter a valid email address.");
        txtEmail.reportValidity();
    }
    else{
        http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                var reqVal = http.responseText;
                if(reqVal == txtEmail.value){
                    txtEmail.setCustomValidity(txtEmail.value + " is already exist!");
                    txtEmail.reportValidity();
                }
                else{
                    txtEmail.setCustomValidity("");
                }
            }
        };
        
        http.open("GET", "../Functions/Renters/renterCheckEmail.php?q=" + txtEmail.value, true); 
        http.send(); 
    }
} 

//checking if the confirm password is matched in password
function checkPassword(){
    var pass = document.getElementById("rPassword");
    var pass1 = document.getElementById("rConfirmPassword");

    if(pass.value != pass1.value){
        pass1.setCustomValidity("Passwords do not match. Please try again.");
        pass1.reportValidity();
    }
    else{
        pass1.setCustomValidity("");
    }
}
//error trap if ever the user edit the password instead of confirm password
function checkPass(){
    var pass = document.getElementById("rPassword");
    var pass1 = document.getElementById("rConfirmPassword");
    if(pass.value == pass1.value){
        pass1.setCustomValidity("");
    }
}
//to make sure that the first number in mobile numbe input is start in "9"
function checkMobileNumber(){
    var mNumber = document.getElementById("rNumber");
    var numVal = mNumber.value;

    if(numVal.charAt(0) !== '9'){
        mNumber.setCustomValidity("Make sure your first input number starts with \"9\".");
        mNumber.reportValidity();
    }
    else{
        mNumber.setCustomValidity("");
    }
}

function focusrMobileNumber(){
    var mNumber = document.getElementById("rNumber");
    mNumber.setCustomValidity("");
}

function focusrConfirmPassword(){
    var password1 = document.getElementById("rConfirmPassword");
    password1.setCustomValidity("");
}

function focusrPassword(){
    var password = document.getElementById("rPassword");
    password.setCustomValidity("");
}

function focusrEmail(){
    var txtEmail = document.getElementById("rEmail");
    txtEmail.setCustomValidity("");
}
//landlord

//checking if the confirm password is matched in password
function passwordCheck(){
    var password = document.getElementById("lPassword");
    var password1 = document.getElementById("lConfirmPassword");

    if(password.value != password1.value){
        password1.setCustomValidity("Passwords do not match. Please try again.");
        password1.reportValidity();
    }
    else{
        password1.setCustomValidity("");
    }
}
//error trap if ever the user edit the password instead of confirm password
function passCheck(){
    var password = document.getElementById("lPassword");
    var password1 = document.getElementById("lConfirmPassword");
    if(password.value == password1.value){
        password1.setCustomValidity("");
    }
    else{
        password.setCustomValidity("");
    }
}

//to make sure that the first number in mobile numbe input is start in "9"
function mobileNumberCheck(){
    var mNumber = document.getElementById("lNumber");
    var numVal = mNumber.value;

    if(numVal.charAt(0) !== '9'){
        mNumber.setCustomValidity("Make sure your first input number starts with \"9\".");
        mNumber.reportValidity();
    }
    else{
        mNumber.setCustomValidity("");
    }
}


//checking if the email is already exist

function showMail() {
    var txtEmail = document.getElementById("lEmail");
    var allowedDomains = ["yahoo.com", "gmail.com", "bulsu.edu.ph"];
    var isValidDomain = allowedDomains.some(function(domain) {
        return txtEmail.value.endsWith("@" + domain);
    });


    if (txtEmail.value.trim() === "") {
        txtEmail.setCustomValidity("Please enter your email address!");
        txtEmail.reportValidity();
    } 

    else if (!isValidDomain) {
        txtEmail.setCustomValidity("Please enter a valid email address.");
        txtEmail.reportValidity();
    }

    else {
        var http = new XMLHttpRequest();

        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                var reqVal = http.responseText;
                if (reqVal == txtEmail.value) {
                    txtEmail.setCustomValidity(txtEmail.value + " is already exist!");
                    txtEmail.reportValidity();
                } else {
                    txtEmail.setCustomValidity("");
                }
            }
        };

        http.open("GET", "../Functions/Landlord/landlordCheckEmail.php?q=" + txtEmail.value, true);
        http.send();
    }
}

//landlord and renter verification


function checkVerificationCode(){
    var code1 = document.getElementById("uInput1");
    var code2 = document.getElementById("uInput2");
    var code3 = document.getElementById("uInput3");
    var code4 = document.getElementById("uInput4");
    var code5 = document.getElementById("uInput5");
    var code6 = document.getElementById("uInput6");
    var landlordaction = document.getElementById("txtLandlordAction");

    var code = code1.value + code2.value + code3.value + code4.value + code5.value + code6.value;

    http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                var codeValue = http.responseText;
                var array = codeValue.split(",")
                if(code == array[0] && array[1] == "renter"){
                    window.location = "../Functions/Renters/registerFunction.php";
                }
                else if(code == array[0] && array[1] == "landlord"){
                    if(landlordaction.value != "null"){
                        window.location = "../Functions/Landlord/registerFunction.php?action=listproperty";
                    }
                    else{
                        window.location = "../Functions/Landlord/registerFunction.php";
                    }
                }
                else{
                    code1.value = "";
                    code2.value = "";
                    code3.value = "";
                    code4.value = "";
                    code5.value = "";
                    code6.value = "";
                    $('#errorMessage').css("display","block");
                    return false;
                }
            }
        };
        http.open("GET", "CheckCode.php?q=" + code, true);
        http.send(); 
}

function landlordvalidation(){
    showMail();
    mobileNumberCheck(); 
    passwordCheck(); 
    passCheck();
}

function rentervalidation(){
    showEmail();
    checkMobileNumber();
    checkPassword(); 
    checkPass();
}

function focusMobileNumber(){
    var mNumber = document.getElementById("lNumber");
    mNumber.setCustomValidity("");
}

function focusConfirmPassword(){
    var password1 = document.getElementById("lConfirmPassword");
    password1.setCustomValidity("");
}

function focusPassword(){
    var password = document.getElementById("lPassword");
    password.setCustomValidity("");
}

function focusEmail(){
    var txtEmail = document.getElementById("lEmail");
    txtEmail.setCustomValidity("");
}