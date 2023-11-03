<!-- <?php
    //start session
    session_start();
    if(isset($_POST['rEmail'])){
        //Renter Info
        $rFname = $_POST['rFname'];
        $rLname = $_POST['rLname'];
        $rEmail = $_POST['rEmail'];
        $rNumber = $_POST['rNumber'];
        $datepicker_input = $_POST['datepicker_input'];
        $rOccupation = $_POST['rOccupation'];
        if($rOccupation == "Others"){
            $rOccupation = $_POST['rJobOther'];
        }
        //Renter Password 
        $rPassword = $_POST['rPassword'];
        $rConfirmPassword = $_POST['rConfirmPassword'];
        //
        $_SESSION['rFname'] = $rFname;
        $_SESSION['rLname'] = $rLname;
        $_SESSION['rEmail'] = $rEmail;
        $_SESSION['rNumber'] = $rNumber;
        $_SESSION['datepicker_input'] = $datepicker_input;
        $_SESSION['rOccupation'] = $rOccupation;
        $_SESSION['rPassword'] = $rPassword;
        $_SESSION['rConfirmPassword'] = $rConfirmPassword;

        $_SESSION['current_email'] = $_SESSION['rEmail'];
    }
    else if(isset($_POST['lEmail'])){
        //Renter Info
        $lFname = $_POST['lFname'];
        $lLname = $_POST['lLname'];
        $lEmail = $_POST['lEmail'];
        $lNumber = $_POST['lNumber'];
        $datepicker_input = $_POST['datepicker_input'];
        $region_text = $_POST['region_text'];
        $province_text = $_POST['province_text'];
        $city_text = $_POST['city_text'];
        $barangay_text = $_POST['barangay_text'];
        $lHouseNo = $_POST['lHouseNo'];
        //Renter Password 
        $lPassword = $_POST['lPassword'];
        $lConfirmPassword = $_POST['lConfirmPassword'];
        //set user input as session
        $_SESSION['lFname'] = $lFname;
        $_SESSION['lLname'] = $lLname;
        $_SESSION['lEmail'] = $lEmail;
        $_SESSION['lNumber'] = $lNumber;
        $_SESSION['datepicker_input'] = $datepicker_input;
        $_SESSION['lPassword'] = $lPassword;
        $_SESSION['lConfirmPassword'] = $lConfirmPassword;
        $_SESSION['region_text'] = $region_text;
        $_SESSION['province_text'] = $province_text;
        $_SESSION['city_text'] = $city_text;
        $_SESSION['barangay_text'] = $barangay_text;
        $_SESSION['lHouseNo'] = $lHouseNo;

        $_SESSION['current_email'] = $_SESSION['lEmail'];
    }
    include('sendingVerificationCode.php');
    $_SESSION['verificationCode'] = $verificationCode;
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Verification</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS files -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesVerification.css">
    <link rel="stylesheet" href="../CSS/loading.css">
    <link rel="stylesheet" href="../CSS/stylesNav.css">
    <link rel="stylesheet" href="../CSS/stylesLoginAs.css">
    
    <!---->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> 
    
    <!--JQuery-->
    <script src="../JavaScripts/RentersPageQuery.js"></script>
    <!-- AJAX -->
    <script src="../JavaScripts/AJAX-Functions.js"></script>
    <script src="../JavaScripts/functionNav.js"></script>

    <script>
        function startCountdown() {
            //get the id of span with a text of"30"
            //this is here because everytime the page is loaded the countdown will always appear
            var countdownElement = document.getElementById("countdown");
            var seconds = 30;

            //countdown function
            var countdownInterval = setInterval(function() {
                seconds--;
                countdownElement.textContent = seconds;
                
                //the resend link will show if the countdown is equal to 0
                if (seconds <= 0) {
                clearInterval(countdownInterval);
                $('#resendLink').css("display", "inline-block");
                $('#countdown').css("display", "none");
                $('.resend_none').css("display", "none");
                }
            }, 1000);
            }
            // Start the countdown when the page is loaded
            window.onload = startCountdown;

        function blurFunction(){
            var upAvatar = document.getElementById("chevron-up-avatar");
            var downAvatar = document.getElementById("chevron-down-avatar");
            var upAvatar2 = document.getElementById("chevron-up-avatar2");
            var downAvatar2 = document.getElementById("chevron-down-avatar2");

            upAvatar.style.display = "none";
            downAvatar.style.display = "inline-block";

            upAvatar2.style.display = "none";
            downAvatar2.style.display = "inline-block";
        }
    </script>
</head>

<body class="d-flex align-items-center justify-content-center ">


    <!-- <div class="loadBackground">
        <div class="Loadcontainer">
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/rLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/eLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/nLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/tLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" id="imgA" src="../imgs/imgLoading/aLoading.png" style="width: 30px; height:30px;"></div>
        </div>
    </div> -->

    <!-- MODAL ARE YOU SURE -->
    <div class="modal fade" id="sure" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalSure">

                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body ">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                            <img src="../imgs/warning.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2">Are you sure you want to cancel registration?</h5>
                        </div>
                    </div>

                    <div class="modal-footer d-flex gap-2 pb-3 px-3">
                        <button type="button" class="btn btns btn-cancel px-4 py-2" data-bs-dismiss="modal">No</button>
                        <a href="cancelVerification.php">
                            <button type="button" class="btn btns btn-del px-4 py-2" >Yes</button>
                        </a>
                        
                        
                    </div>
                </div>
            </div>
        </div>



    <div class="wrapper ">
        <?php
        if(isset($_GET['action']) && $_GET['action'] != ''){ ?>
        <div class="d-none">
            <input type="text" id="txtLandlordAction" value="<?php echo $_GET['action'] ?>">
        </div>
        <?php
        }
        else{
            ?>
            <div class="d-none">
                <input type="text" id="txtLandlordAction" value="null">
            </div>
            <?php
            }
            ?>
            <div class="container" id="container_ver">
                
                <div class="btn_c" data-bs-toggle="modal" data-bs-target="#sure">
                    <a class="btn" id="btn_cancel" href="#" >
                        <button type="button" class="btn-close btn-close-logout" aria-label="Close"></button>
                    </a>
                </div>

                <div class="text-center" >
                    <img src="../imgs/mail5.png" id="img_mail" alt="Image could not be shown."> 
                </div>
                <div class="text-center" id="txt_ver"><br/>
                    <h4>Verify your email address</h4>
                    <p class="mt-1">Please check your inbox for verification code <br>
                    sent to <b class="registered-email"><?php echo $_SESSION['current_email'] ?></b> to activate your account.<br><br>
                </div>
                
                        <!--user verification code 6 numbers-->

                        <div class="container justify-content-center d-flex flex-row " id="code_container">
                            <input type='text' class="form-control rVrificationCode text-center" placeholder='' autocomplete="off" maxlength="1" name="uInput1" id="uInput1" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" style="caret-color: transparent;" required="required">
                            <input type='text' class="form-control rVrificationCode text-center" placeholder='' autocomplete="off" maxlength="1" name="uInput2" id="uInput2" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" style="caret-color: transparent;" required="required">
                            <input type='text' class="form-control rVrificationCode text-center" placeholder='' autocomplete="off" maxlength="1" name="uInput3" id="uInput3" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" style="caret-color: transparent;" required="required">
                            <input type='text' class="form-control rVrificationCode text-center" placeholder='' autocomplete="off" maxlength="1" name="uInput4" id="uInput4" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" style="caret-color: transparent;" required="required">
                            <input type='text' class="form-control rVrificationCode text-center" placeholder='' autocomplete="off" maxlength="1" name="uInput5" id="uInput5" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" style="caret-color: transparent;" required="required">
                            <input type='text' class="form-control rVrificationCode text-center" placeholder='' autocomplete="off" maxlength="1" name="uInput6" id="uInput6" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" style="caret-color: transparent;" required="required">
                        </div>
                        <div class="resend_div text-center mt-2">
                            <span class="resend_none"> Resend code in </span> 
                            <span class="loader"></span><a href="verificationProcess.php" id="resendLink">Resend</a><span id="countdown">30</span></p>
                        </div> 
                        
                        <p id="errorMessage" class="text-center mt-3">The verification code is invalid.</p>
                        
                        <div class="verify_btndiv d-flex justify-content-center flex-column">
                            <div class="">
                                <input type='button' onclick="checkVerificationCode()" value='Verify' class="btn" id="btn_verify">
                            </div>
                            <div class="spam_notif text-center mt-3">
                                <!-- GO TO REGISTRATION PAGE IF CHANGE EMAIL WAS CLICKED -->
                                <p>Can't find it? Please check your spam folder or <br> <a onclick="GobackPage()" class="change-email">Change your email</a> </p>
                            </div>
                        </div>
            </div>
    </div>
        
</body>
</html>