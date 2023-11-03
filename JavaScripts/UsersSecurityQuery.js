
$(document).ready(function(){   
    var input_container = document.querySelector('.input_container');
    var body = document.querySelector('body');
    var box = document.querySelector('.box');
    
    //remove loading
    $('.loadBackground').click(function(){
        $('.loadBackground').fadeOut(0);
    }).delay(6000).trigger("click");
    //for btn back if the the send change pass link is error
    $('#btn_back').click(function(){
        input_container.classList.remove('active');
        body.classList.remove('active');
        box.classList.remove('active');
        $('.loader').css('display', 'none');
        $('#btn_send').css('display', 'block');
        $('#div_failed').css('display', 'none');
    });
    //send instruction in forgot pass
    $('#btn_send').click(function(){
        var txt1 = document.getElementById('word1');
        var txt2 = document.getElementById('word2');
        var txt3 = document.getElementById('word3');
        var txt4 = document.getElementById('word4');
        var txt5 = document.getElementById('word5');
        var txt6 = document.getElementById('word6');
        var txt7 = document.getElementById('word7');
        var txt8 = document.getElementById('word8');
        var txt9 = document.getElementById('word9');
        var txt10 = document.getElementById('word10');
        var txt11 = document.getElementById('word11');
        var txt12 = document.getElementById('word12');
        //Get the email
        var uEmail = document.getElementById("rEmail");
        
        if(uEmail.value == ""){
            uEmail.setCustomValidity("Please enter your email address!");
            uEmail.reportValidity()
        }
        else if(txt1.value == ""){
            txt1.setCustomValidity("Please fill in this textbox!");
            txt1.reportValidity();
        }
        else if(txt2.value == ""){
            txt2.setCustomValidity("Please fill in this textbox!");
            txt2.reportValidity();
        }
        else if(txt3.value == ""){
            txt3.setCustomValidity("Please fill in this textbox!");
            txt3.reportValidity();
        }
        else if(txt4.value == ""){
            txt4.setCustomValidity("Please fill in this textbox!");
            txt4.reportValidity();
        }
        else if(txt5.value == ""){
            txt5.setCustomValidity("Please fill in this textbox!");
            txt5.reportValidity();
        }
        else if(txt6.value == ""){
            txt6.setCustomValidity("Please fill in this textbox!");
            txt6.reportValidity();
        }
        else if(txt7.value == ""){
            txt7.setCustomValidity("Please fill in this textbox!");
            txt7.reportValidity();
        }
        else if(txt8.value == ""){
            txt8.setCustomValidity("Please fill in this textbox!");
            txt8.reportValidity();
        }
        else if(txt9.value == ""){
            txt9.setCustomValidity("Please fill in this textbox!");
            txt9.reportValidity();
        }
        else if(txt10.value == ""){
            txt10.setCustomValidity("Please fill in this textbox!");
            txt10.reportValidity();
        }
        else if(txt11.value == ""){
            txt11.setCustomValidity("Please fill in this textbox!");
            txt11.reportValidity();
        }
        else if(txt12.value == ""){
            txt12.setCustomValidity("Please fill in this textbox!");
            txt12.reportValidity();
        }
        //check if the email is not null
        else{
        var userEmail = uEmail.value;
        var securityVal = txt1.value + "," + txt2.value + "," + txt3.value + "," + txt4.value + "," + txt5.value + "," + txt6.value + "," + txt7.value
        + "," + txt8.value + "," + txt9.value + "," + txt10.value + "," + txt11.value + "," + txt12.value;
            http = new XMLHttpRequest();
            http.onreadystatechange = function() {
            $('.loader').css("display", "block");
            $('#btn_send').css("display", "none");
                
                if (http.readyState == 4 && http.status == 200) {
                    var responseEmail = http.responseText;
                    if(responseEmail == userEmail){
                        input_container.classList.add('active');
                        body.classList.add('active');
                        box.classList.add('active');
                        $('#div_success').addClass('d-flex');
                        $('#div_failed').removeClass('d-flex');
                        $('#div_success').css('display', 'flex');
                        $('#div_failed').css('display', 'none');
                        $('.loader').css('display', 'none');
                    }
                    else{
                        input_container.classList.add('active');
                        body.classList.add('active');
                        box.classList.add('active'); 
                        $('#div_failed').addClass('d-flex');
                        $('#div_success').removeClass('d-flex');
                        $('#div_failed').css('display', 'flex');
                        $('#div_success').css('display', 'none');
                        $('.loader').css('display', 'none');
                    }
                }
            };
            http.open("GET", "Functions/forgotPasswordFunction.php?q=" + userEmail + "," + securityVal, true); 
            http.send();
        }
    });
    //for reset password show/hide password
    $('#toggle_pass').click(function(){
        if($('#toggle_icon').hasClass('bi-eye-slash')){
            $('#toggle_icon').removeClass('bi-eye-slash');
            $('#toggle_icon').addClass('bi-eye');
            document.getElementById("new_pass").type = "text";
        }
        else{
            $('#toggle_icon').addClass('bi-eye-slash');
            $('#toggle_icon').removeClass('bi-eye');
            document.getElementById("new_pass").type = "password";
        }
    });
    //toggle button for show and hide confirm password
    $('.confirmPass').click(function(){
        if($('.confPass').hasClass('bi-eye-slash')){
            $('.confPass').removeClass('bi-eye-slash');
            $('.confPass').addClass('bi-eye');
            document.getElementById("confirm_new_pass").type = "text";
        }
        else{
            $('.confPass').addClass('bi-eye-slash');
            $('.confPass').removeClass('bi-eye');
            document.getElementById("confirm_new_pass").type = "password";
        }
    });
});
//checking if the confirm password is matched in password
function checkPassword(){
    var pass = document.getElementById("new_pass");
    var pass1 = document.getElementById("confirm_new_pass");

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