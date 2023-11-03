$(document).ready(function(){
    //landlord
    $('#toggle_password1').click(function(){
        if($('.icon1').hasClass('bi-eye-slash')){
            $('.icon1').addClass('bi-eye');
            $('.icon1').removeClass('bi-eye-slash');
            document.getElementById("lPassword").type = "text";
        }
        else{
            $('.icon1').addClass('bi-eye-slash');
            $('.icon1').removeClass('bi-eye');
            document.getElementById("lPassword").type = "password";
        }
    });
    $('#toggle_password2').click(function(){
        if($('.icon2').hasClass('bi-eye-slash')){
            $('.icon2').addClass('bi-eye');
            $('.icon2').removeClass('bi-eye-slash');
            document.getElementById("lnewPassword").type = "text";
        }
        else{
            $('.icon2').addClass('bi-eye-slash');
            $('.icon2').removeClass('bi-eye');
            document.getElementById("lnewPassword").type = "password";
        }
    });
    $('#toggle_password3').click(function(){
        if($('.icon3').hasClass('bi-eye-slash')){
            $('.icon3').addClass('bi-eye');
            $('.icon3').removeClass('bi-eye-slash');
            document.getElementById("lconfirmnewPassword").type = "text";
        }
        else{
            $('.icon3').addClass('bi-eye-slash');
            $('.icon3').removeClass('bi-eye');
            document.getElementById("lconfirmnewPassword").type = "password";
        }
    });
    $('#save_new_pass').click(function(){
        var current_pass = document.getElementById('lPassword');
        var new_pass = document.getElementById('lnewPassword');
        var confirm_new_pass = document.getElementById('lconfirmnewPassword');

        if(current_pass.value === ""){
            current_pass.setCustomValidity("Please enter your current password");
            current_pass.reportValidity();
        }

        else if(new_pass.value === ""){
            new_pass.setCustomValidity("Please enter a new password");
            new_pass.reportValidity();
        }
        
        else if(confirm_new_pass.value === ""){
            confirm_new_pass.setCustomValidity("Please re-enter your new password");
            confirm_new_pass.reportValidity();
        }
        else if(new_pass.value != confirm_new_pass.value){
            confirm_new_pass.setCustomValidity("Your new password doesn't match");
            confirm_new_pass.reportValidity();
        }
        else{
            http = new XMLHttpRequest();
                
            http.onreadystatechange = function() {
                    
                if (http.readyState == 4 && http.status == 200) {
                    if(http.responseText == "failed"){
                        current_pass.setCustomValidity("Your new password doesn't match");
                        current_pass.reportValidity();
                    }
                    else{
                        location.reload();
                    }
                }
            };
            http.open("GET", "../Functions/Landlord/editPassword.php?q=" + current_pass.value + "~~>" + new_pass.value + "~~>" + confirm_new_pass.value, true); 
            http.send(); 
        }
    });
    $('#btnsavename').click(function(){
        var firstname = document.getElementById("llandlordf");
        var lastname = document.getElementById("llandlordlast");
        if(firstname.value === ""){
            firstname.setCustomValidity("Please enter your firstname");
            firstname.reportValidity();
        }

        else if(lastname.value === ""){
            lastname.setCustomValidity("Please enter your lastname");
            lastname.reportValidity();
        }
        else{
        http = new XMLHttpRequest();
                
            http.onreadystatechange = function() {
                    
                if (http.readyState == 4 && http.status == 200) {
                    location.reload();
                }
            };
            http.open("GET", "../Functions/Landlord/editlandlordname.php?q=" + firstname.value + "~~>" + lastname.value, true); 
            http.send(); 
        }
    });

    $('#btnEditNumber').click(function(){
        var mobile_number = document.getElementById("txtNumber");
        if(mobile_number.value === ""){
            mobile_number.setCustomValidity("Please enter your mobile number");
            mobile_number.reportValidity();
        }
        else{
        http = new XMLHttpRequest();
                
            http.onreadystatechange = function() {
                    
                if (http.readyState == 4 && http.status == 200) {
                    location.reload();
                }
            };
            http.open("GET", "../Functions/Landlord/editlandlordnumber.php?q=" + mobile_number.value, true); 
            http.send(); 
        }
    });

    $('#btnEditLocation').click(function(){
        var region = document.getElementById("txtRegion");
        var province = document.getElementById("txtProvince");
        var city = document.getElementById("txtCity");
        var barangay = document.getElementById("txtBarangay");
        var houseno = document.getElementById("txtHouseNo");
        if(region.value === ""){
            region.setCustomValidity("Please enter your region");
            region.reportValidity();
        }
        else if(province.value === ""){
            province.setCustomValidity("Please enter your province");
            province.reportValidity();
        }
        else if(city.value === ""){
            city.setCustomValidity("Please enter your city");
            city.reportValidity();
        }
        else if(barangay.value === ""){
            barangay.setCustomValidity("Please enter your barangay");
            barangay.reportValidity();
        }
        else if(houseno.value === ""){
            houseno.setCustomValidity("Please enter your house no.");
            houseno.reportValidity();
        }
        else{
        http = new XMLHttpRequest();
                
            http.onreadystatechange = function() {
                    
                if (http.readyState == 4 && http.status == 200) {
                    location.reload();
                }
            };
            http.open("GET", "../Functions/Landlord/editlocation.php?q=" + region.value + "~~>" + province.value +
            "~~>" + city.value + "~~>" + barangay.value + "~~>" + houseno.value, true); 
            http.send(); 
        }
    });
    //renter
    $('#toggle_password4').click(function(){
        if($('.icon4').hasClass('bi-eye-slash')){
            $('.icon4').addClass('bi-eye');
            $('.icon4').removeClass('bi-eye-slash');
            document.getElementById("rPassword").type = "text";
        }
        else{
            $('.icon4').addClass('bi-eye-slash');
            $('.icon4').removeClass('bi-eye');
            document.getElementById("rPassword").type = "password";
        }
    });
    $('#toggle_password5').click(function(){
        if($('.icon5').hasClass('bi-eye-slash')){
            $('.icon5').addClass('bi-eye');
            $('.icon5').removeClass('bi-eye-slash');
            document.getElementById("rnewPassword").type = "text";
        }
        else{
            $('.icon5').addClass('bi-eye-slash');
            $('.icon5').removeClass('bi-eye');
            document.getElementById("rnewPassword").type = "password";
        }
    });
    $('#toggle_password6').click(function(){
        if($('.icon6').hasClass('bi-eye-slash')){
            $('.icon6').addClass('bi-eye');
            $('.icon6').removeClass('bi-eye-slash');
            document.getElementById("rconfirmnewPassword").type = "text";
        }
        else{
            $('.icon6').addClass('bi-eye-slash');
            $('.icon6').removeClass('bi-eye');
            document.getElementById("rconfirmnewPassword").type = "password";
        }
    });

    $('#save_new_rpass').click(function(){
        var current_pass = document.getElementById('rPassword');
        var new_pass = document.getElementById('rnewPassword');
        var confirm_new_pass = document.getElementById('rconfirmnewPassword');

        if(current_pass.value === ""){
            current_pass.setCustomValidity("Please enter your current password");
            current_pass.reportValidity();
        }

        else if(new_pass.value === ""){
            new_pass.setCustomValidity("Please enter a new password");
            new_pass.reportValidity();
        }
        
        else if(confirm_new_pass.value === ""){
            confirm_new_pass.setCustomValidity("Please re-enter your new password");
            confirm_new_pass.reportValidity();
        }
        else if(new_pass.value != confirm_new_pass.value){
            confirm_new_pass.setCustomValidity("Your new password doesn't match");
            confirm_new_pass.reportValidity();
        }
        else{
            http = new XMLHttpRequest();
                
            http.onreadystatechange = function() {
                    
                if (http.readyState == 4 && http.status == 200) {
                    if(http.responseText == "failed"){
                        current_pass.setCustomValidity("Your new password doesn't match");
                        current_pass.reportValidity();
                    }
                    else{
                        location.reload();
                    }
                }
            };
            http.open("GET", "../Functions/Renters/editPassword.php?q=" + current_pass.value + "~~>" + new_pass.value + "~~>" + confirm_new_pass.value, true); 
            http.send(); 
        }
    });
    $('#btnsavername').click(function(){
        var firstname = document.getElementById("rrenterf");
        var lastname = document.getElementById("rrenterlast");
        if(firstname.value === ""){
            firstname.setCustomValidity("Please enter your firstname");
            firstname.reportValidity();
        }

        else if(lastname.value === ""){
            lastname.setCustomValidity("Please enter your lastname");
            lastname.reportValidity();
        }
        else{
        http = new XMLHttpRequest();
                
            http.onreadystatechange = function() {
                    
                if (http.readyState == 4 && http.status == 200) {
                    location.reload();
                }
            };
            http.open("GET", "../Functions/Renters/editrentername.php?q=" + firstname.value + "~~>" + lastname.value, true); 
            http.send(); 
        }
    });
    $('#btnrEditNumber').click(function(){
        var mobile_number = document.getElementById("rNumber");
        if(mobile_number.value === ""){
            mobile_number.setCustomValidity("Please enter your mobile number");
            mobile_number.reportValidity();
        }
        else{
        http = new XMLHttpRequest();
                
            http.onreadystatechange = function() {
                    
                if (http.readyState == 4 && http.status == 200) {
                    location.reload();
                }
            };
            http.open("GET", "../Functions/Renters/editrenternumber.php?q=" + mobile_number.value, true); 
            http.send(); 
        }
    });
});