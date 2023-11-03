$(document).ready(function(){
    //datepicker
    $('#picker').datepicker({
    format:'mm-dd-yyyy',
    minDate: new Date()
    });
    //to automatically move the textbox once the textbox has one character
    $('.lVrificationCode').keyup(function(){
        if(this.value.length == this.maxLength){
            $(this).nextAll('.lVrificationCode:first').focus();
        }
        else{
            $(this).prevAll('.lVrificationCode:first').focus();
        }
    });
    //toggle button for show and hide password
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
    //toggle button for show and hide confirm password
    $('#toggle_password2').click(function(){
        if($('.icon2').hasClass('bi-eye-slash')){
            $('.icon2').removeClass('bi-eye-slash');
            $('.icon2').addClass('bi-eye');
            document.getElementById("lConfirmPassword").type = "text";
        }
        else{
            $('.icon2').addClass('bi-eye-slash');
            $('.icon2').removeClass('bi-eye');
            document.getElementById("lConfirmPassword").type = "password";
        }
    });
    //toggle button for show and hide login password
    $('#toggle_loginpass').click(function(){
        if($('.loginPassIcon').hasClass('bi-eye-slash')){
            $('.loginPassIcon').removeClass('bi-eye-slash');
            $('.loginPassIcon').addClass('bi-eye');
            document.getElementById("login_password").type = "text";
        }
        else{
            $('.loginPassIcon').addClass('bi-eye-slash');
            $('.loginPassIcon').removeClass('bi-eye');
            document.getElementById("login_password").type = "password";
        }
    });
    //remove loading
    $('.loadBackground').click(function(){
        $('.loadBackground').fadeOut(0);
    }).delay(6000).trigger("click");
    //to remove warning message one the user is typing
    $('#rInput2').focus(function(){
        $('#errorMessage').css("display","none")
    });
    //if the resend link is clicked the loading will show
    $('#resendLink').click(function(){
        $('.loader').css("display", "inline-block");
        $('#resendLink').css("display", "none");
    });
    //after the loading the resend link will show again
    $('.loader').hover(function(){
        $('.loader').css("display", "none");
    }).delay(3000).trigger("hover");

    $('#btn_login').click(function(){ 
        $.ajax({
            url:"../Functions/Landlord/loginFunction.php",
            method:"POST",
            data:{
                landlordEmail:$("#login_email").val(),
                landlordPassword:$("#login_password").val(),
                rId:$("#txtrenter").val(),
                pageInfo:$("#redirectlease").val(),
                landlordAction:$("#txtLandlordAction").val()
            },
            dataType:"text",
            success:function(data)
            {
                if(data == "invalid"){
                    $('#invalidModal').modal('show');
                }
                else if(data == "incorrect pass"){
                    $('#invalidPass').modal('show');
                }
                else if(data == "not exist"){
                    $('#notExist').modal('show');
                }
                else if(data == "success"){
                    window.open('../?start=1','_self');
                }
                else if(data == "blocked"){
                    $('#modalBannedYou').modal('show');
                }
                else{
                    window.location.href = data;
                }
            }
        });
    });
    $('#registerModal').click(function(){
        $('#notExist').modal('hide');
        $('#btn_registerhover').click();
    });


    $(document).on('keypress', '.txtreg', function(event) {
        if (event.keyCode === 13) {
            $('#btn_register').trigger('click');
        }
    });


    $(document).on('keyup', '.login_inputs', function(event) {
        if (event.keyCode === 13) {
            $('#btn_login').click();
        }
    });
});