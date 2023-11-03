<?php 
    session_start();
    $identity = "landlord";
    $_SESSION['identity'] = $identity;
    $userEmail = "null";
    if (isset($_SESSION['current_email']) && isset($_SESSION['rConfirmPassword'])) {
        unset($_SESSION['rFname']);
        unset($_SESSION['rLname']);
        unset($_SESSION['rEmail']);
        unset($_SESSION['rNumber']);
        unset($_SESSION['datepicker_input']);
        unset($_SESSION['rOccupation']);
        unset($_SESSION['rPassword']);
        unset($_SESSION['rConfirmPassword']);
    } 
    else if (isset($_SESSION['current_email']) && isset($_SESSION['lConfirmPassword'])) {
        
        if(isset($_SESSION['lEmail'])){
            $userEmail = $_SESSION['lEmail'];
            unset($_SESSION['lEmail']);
        }
    }
    

    if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Landlord</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS file -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesLandlordStarter.css">
    <!-- <link rel="stylesheet" href="../CSS/loading.css"> -->
    <link rel="stylesheet" href="../CSS/stylesNav.css">

    <!-- Jquery Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!--Javascripts-->
    <script src="../JavaScripts/LandlordPageQuery.js"></script>
    <script src="../JavaScripts/AJAX-Functions.js"></script>
    <script src="../JavaScripts/location.js"></script>
    <script>
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
<body>


<!-- MODAL INVALID CREDENTIALS -->
<div class="modal fade" id="invalidModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalInvalid">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/warning.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2">Invalid Credentials. <br> This account belongs to a renter. </h5>
                            <a href="../RentersPage/starterPage.php" class="mt-3 link-invalid-credential">Log in as renter instead</a>
                        </div>
                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-invalid px-3 py-2" data-bs-dismiss="modal">Try Again</button>
                  </div>
            </div>
        </div>
    </div>

<!-- MODAL blocked PASSWORD -->
<div class="modal fade" id="blockedModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalInvalidPass">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        <div class="d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/blocked.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2">Account Temporarily Blocked <br><br> Your account has been temporarily blocked due to a violation of our system's rules. 
                            <br>Please contact our support team for further assistance. </h5>
                        </div>
                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-invalid px-3 py-2" data-bs-dismiss="modal">Try Again</button>
                  </div>
            </div>
        </div>
    </div>
<!-- modal end - blocked CREDENTIALS -->

<!-- MODAL INCORRECT PASSWORD -->
<div class="modal fade" id="invalidPass" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalInvalidPass">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        <div class="d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/warning.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2">Invalid Password. </h5>
                        </div>
                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-invalid px-3 py-2" data-bs-dismiss="modal">Try Again</button>
                  </div>
            </div>
        </div>
    </div>
<!-- modal end - INVALID CREDENTIALS -->

<!-- MODAL ACCOUNT DOES NOT EXIST -->
<div class="modal fade" id="notExist" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalInvalid">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/warning.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2">This account doesn't exist.</h5>
                            <a id="registerModal" class="mt-3 link-invalid-credential">Register instead</a>
                        </div>
                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-invalid px-3 py-2" data-bs-dismiss="modal">Try Again</button>
                  </div>
            </div>
        </div>
    </div>
<!-- modal end - ACCOUNT DOES NOT EXIST -->

<!-- MODAL ENSURE -->
<div class="modal fade" id="modalEnsure" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalEnsure">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                        <div class="d-flex flex-column align-items-center justify-content-center ">
                            <img src="../imgs/question-main.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2 px-3">You will be required to submit a government ID for verification after filling out this form. <br> Do you wish to proceed now?</h5>
                        </div>
                </div>

                <div class="modal-footer d-flex justify-content-end gap-2 p-3">
                    <button type="button" id="noReq" class="btn btns btn-cancel px-4 py-2" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btns btn-go px-4 py-2 text-light" data-bs-dismiss="modal">Yes</button>
                  </div>
            </div>
        </div>
</div>
<!-- modal end - ENSURE -->

<!-- MODAL ACCOUNT BANNED -->
<div class="modal fade" id="modalBannedYou" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalBannedUser">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center justify-content-center ">
                        <img src="../imgs/warning.png" alt="Log Out" class="img-logout">
                        <h5 class="text-center mt-2 px-3">Sorry, your account was banned. <br> Please check your email for the corresponding reason.</h5>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-end gap-2 px-3 pb-3">
                    <button type="button" class="btn btns btn-del px-4 py-2" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
</div>
<!-- modal end - ACCOUNT BANNED -->

<!-- Navbar - Guest -->
    <div class="nav-container fixed-top">
        <nav class="navbar navbar-expand-md px-3 px-md-5">
            <div class="container-fluid">

                <!-- burger -->
                <?php
                    if(!isset($_GET['action']) || $_GET['action'] == 'listproperty'){
                ?>
                <button class="navbar-toggler navbar-toggler-log collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuGuest" >
                    <span class="toggler-icon top-bar"></span>
                    <span class="toggler-icon middle-bar"></span>
                    <span class="toggler-icon bottom-bar"></span>
                </button>
                <?php
                    }
                    ?>

                <!-- logo -->
                <a class="navbar-brand d-sm-block" href="../../RentA">
                    <img src="../imgs/logo.png" alt="RentA" id="imgLogo" class="imgLogo-log">
                </a>
                
                <!-- Avatar - guest on small screen -->
                <div class="dropdown ms-auto d-sm-block d-md-none">
                    <li class="nav-link as-renter interact-as">You're interacting as a <b>Landlord</b> </li>
                </div>

                <!-- links center -->
                <div class="collapse navbar-collapse navMenuGuest-renter" id="navMenuGuest">

                    <ul class="navbar-nav navbar-nav-renter d-flex align-items-center ms-auto">
                        <li class="nav-item px-3 d-none d-md-block li-as-renter li-as">
                        You're interacting as a <b>Landlord</b>
                        </li>
                        <li class="d-sm-block d-md-none">
                        <?php
                        if(!isset($_GET['action']) || $_GET['action'] == 'listproperty'){
                            ?>
                            <a href="../RentersPage/starterPage.php" class="a-iAm">I'm a Renter</a>
                        <?php
                        }
                        ?>
                        </li>
                    </ul>
                    <ul class="d-flex align-items-center ms-auto">
                    <?php
                        if(!isset($_GET['action']) || $_GET['action'] == 'listproperty'){
                    ?>
                        <!-- Avatar - guest big-->
                        <a href="../RentersPage/starterPage.php" class="a-iAm">I'm a Renter</a>
                    
                    <?php
                        }
                        ?>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
<!-- end navbar - guest -->

<!-- Main -->
<div class="container-fluid container-start-landlord">
    <div class="container-landlord">
        <div class="bg d-flex justify-content-center align-items-center">
            <div class="box login">
                <h2 class="d-none d-sm-none d-md-block renting_txt">Renting made easy. </br>
                    Find your home easily.</h2>
                <p class="mt-4">Already have an account?
                    <button href="" class="hover_btns" id="btn_loginhover">Log In</button>
                </p>
            </div>

            <div class="box register">
                <!-- button banned  -->
                <h2 class="d-none d-sm-none d-md-block renting_txt">Renting made easy. </br>
                    Find your home easily.</h2>

                <p class="mt-4">No account yet? 
                    <button class="hover_btns" id="btn_registerhover">Register</button>
                </p>
                
            </div>
        </div>

        <div class="form_box d-flex justify-content-center align-items-center">

            <!-- Login Form -->
            <div class="form form_login d-flex align-items-center justify-content-center flex-column">
                <header class="mb-5 mt-5 text-center">
                    Welcome Back
                </header>

                <div class="divLogin">
                    
                    <div class="input-block form_inputs mb-3" >
                        <input type="email" name="landlordEmail" id="login_email" class="login_inputs" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                        <span class="placeholder"> Email address </span>
                    </div>

                    <div class="input-block form_inputs d-flex flex-row" id="login_pass">
                        <input type="password" name="landlordPassword" id="login_password" class="login_inputs" required="required" placeholder=" " autocomplete="off">
                        <span class="placeholder"> Password </span>
                        
                        <span class="input-group-text btn " id="toggle_loginpass">
                            <i class="bi bi-eye-slash loginPassIcon" id="toggle_icon"></i>
                        </span>
                    </div>
                    
                    <?php if(isset($_GET['id']) && $_GET['id'] != ""){ ?>
                        <div class="d-none">
                            <input type="text" id="txtrenter" value="<?php echo $_GET['id'] ?>">
                        </div>
                    <?php
                    }
                    else{
                        ?>
                        <div class="d-none">
                            <input type="text" id="txtrenter" value="null">
                        </div>
                        <?php
                    }
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
                    if(isset($_GET['data']) && $_GET['data'] != ""){ ?>
                        <div class="d-none">
                            <input type="text" id="redirectlease" value="<?php echo $_GET['data'] ?>">
                        </div>
                    <?php
                    }
                    else{
                        ?>
                        <div class="d-none">
                            <input type="text" id="redirectlease" value="null">
                        </div>
                        <?php
                    }
                    ?>
                    <div class="mt-4 text-center">
                        <a href="../forgotPassword.php?user=Landlord" id="btn_forgot"> Forgot Password? </a>
                    </div>
                    <button type="submit" class="mt-5 mb-4" value="Log In" id="btn_login">Log In</button>
    </div>
            </div>

            <!-- Registration Form -->
            <div class="form form_register d-flex align-items-center justify-content-center flex-column">
                <header class="text-center">
                    Get Started Now
                </header>
                <?php
                if(isset($_GET['action']) && $_GET['action'] != ''){ ?>
                <form action="../Functions/verificationProcess.php?action=listproperty" method="POST" class="d-flex flex-column form-r divLogin">
                    <?php
                }
                else{
                    ?>
                    <form action="../Functions/verificationProcess.php" onsubmit="return validateForm()" method="POST" class="d-flex flex-column form-r divLogin">
                    <?php
                }
                ?>
                    <div class="input-block form_inputs reg_inputs d-flex flex-row names gap-2 mt-3" id="div_fname" >
                        <?php
                        if(isset($_SESSION['lFname'])){
                            ?>
                            <input type="text" name="lFname" id="lFname"  class="txtreg input_ht" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['lFname'] ?>">
                            <span class="placeholder span_placeholder"> First Name </span>
                        <?php
                            unset($_SESSION['lFname']);
                        }
                        else{
                            ?>
                            <input type="text" name="lFname" id="lFname"  class="txtreg input_ht" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off">   
                            <span class="placeholder span_placeholder"> First Name </span>
                            <?php
                        }
                        if(isset($_SESSION['lLname'])){
                            ?>
                        <input type="text" name="lLname" id="lLname" class="txtreg input_ht" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['lLname'] ?>">
                        <span class="placeholder span_placeholder" id="placeholder_lname"> Last Name </span>
                        <?php
                            unset($_SESSION['lLname']);
                        }
                        else{
                            ?>
                        <input type="text" name="lLname" id="lLname" class="txtreg input_ht" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                        <span class="placeholder span_placeholder" id="placeholder_lname"> Last Name </span>
                            <?php
                        }
                        ?>
                    </div>
                   <!-- <p class="txt-other"> Make sure it matches the name on your government ID. </p> -->

                    <div class="input-block form_inputs reg_inputs form_blocks mt-3">
                        <?php
                        if($userEmail != "null"){
                            ?>
                            <input type="text" name="lEmail" id="lEmail" onkeyup="focusEmail()" class="txtreg input_ht input_holders" required="required" spellcheck="false" placeholder=" " autocomplete="off" value="<?php echo $userEmail ?>">
                            <span class="placeholder span_placeholder"> Email address </span>
                            <?php
                        }
                        else{
                            ?>
                            <input type="text" name="lEmail" id="lEmail" onkeyup="focusEmail()" class="txtreg input_ht input_holders" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                            <span class="placeholder span_placeholder"> Email address </span>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="input-block form_inputs reg_inputs d-flex flex-row with_span mt-3" >
                    <?php
                        if(isset($_SESSION['lPassword'])){
                        ?>
                        <input type="password" name="lPassword" id="lPassword" onkeyup="focusPassword()" class="txtreg input_ht input_left" minlength="8" required="required" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['lPassword'] ?>">
                        <span class="placeholder span_placeholder"> Password </span>
                        <?php
                            unset($_SESSION['lPassword']);
                        }
                        else{
                            ?>
                        <input type="password" name="lPassword" id="lPassword" onkeyup="focusPassword()" class="txtreg input_ht input_left" minlength="8" required="required" placeholder=" " autocomplete="off">
                        <span class="placeholder span_placeholder"> Password </span>
                            <?php
                        }
                        ?>
                        <span class="input-group-text input_ht span_right btn" id="toggle_password1">
                            <i class="bi bi-eye-slash span_icons toggle_icon icon1" id=""></i>
                        </span>
                    </div>

                    <div class="input-block form_inputs reg_inputs d-flex flex-row with_span mt-3" >
                    <?php
                    if(isset($_SESSION['lConfirmPassword'])){
                        ?>
                        <input type="password" name="lConfirmPassword" id="lConfirmPassword" onkeyup="focusConfirmPassword()" class="txtreg input_ht input_left" minlength="8" required="required" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['lConfirmPassword'] ?>">
                        <span class="placeholder span_placeholder"> Confirm Password </span>
                        <?php
                            unset($_SESSION['lConfirmPassword']);
                        }
                        else{
                            ?>
                            <input type="password" name="lConfirmPassword" id="lConfirmPassword" onkeyup="focusConfirmPassword()" class="txtreg input_ht input_left" minlength="8" required="required" placeholder=" " autocomplete="off">
                            <span class="placeholder span_placeholder"> Confirm Password </span>
                            <?php
                        }
                        ?>
                        <span class="input-group-text input_ht span_right btn" id="toggle_password2">
                            <i class="bi bi-eye-slash span_icons toggle_icon icon2" id=""></i>
                        </span>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="input-block form_inputs reg_inputs d-flex flex-row row_span" id="qNumber" >
                                <span class="input-group-text input_ht span_left span_num" id="">+63</span>
                                <?php
                                if(isset($_SESSION['lNumber'])){
                                ?>
                                    <input type="text" name="lNumber" id="lNumber" onkeyup="focusMobileNumber()" class="txtreg num_box input_ht input_right" minlength="10" maxlength="10" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required="required" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['lNumber'] ?>">
                                    <span class="placeholder span_placeholder"> Mobile Number </span>
                                <?php
                                    unset($_SESSION['lNumber']);
                                }
                                else{
                                    ?>
                                    <input type="text" name="lNumber" id="lNumber" onkeyup="focusMobileNumber()" class="txtreg num_box input_ht input_right" minlength="10" maxlength="10" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> Mobile Number </span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col_margin">
                            <div class="input-block form_inputs reg_inputs d-flex flex-row date row_span" id="picker">
                                
                                <span class="input-group-text input_ht btn span_left span_bday">
                                    <i class="bi bi-calendar-event date_icon" id=""></i>
                                </span>
                                <?php
                                if(isset($_SESSION['datepicker_input'])){
                                ?>
                                <input type="text" name="datepicker_input" id="datepicker_input" class="txtreg input_ht input_right" onkeydown="return false;" required="required" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['datepicker_input'] ?>">
                                <span class="placeholder span_placeholder"> Birthdate </span>
                                <?php
                                unset($_SESSION['datepicker_input']);
                                }
                                else{
                                ?>
                                <input type="text" name="datepicker_input" id="datepicker_input" class="txtreg input_ht input_right" onkeydown="return false;" required="required" placeholder=" " autocomplete="off">
                                <span class="placeholder span_placeholder"> Birthdate </span>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <p class="txt-other mt-2">Home Address</p>
                        <select name="region" class="form-control form-select input_ht select_address form_inputs reg_inputs" id="region"></select>
                        <input type="hidden" class="txtreg form-control" name="region_text" id="region_text" required="required">

                    <div class="row mt-3">
                        <div class="col-md-6">
                                <select name="province" class="txtreg form-control form-select input_ht select_address form_inputs reg_inputs" id="province" required="required">
                                    <option selected="true" id="prov" disabled="disabled" value="">State/Province</option>
                                </select>
                                <input type="hidden" class="form-control txtreg" name="province_text" id="province_text" required="required">
                            </div>
                            <div class="col-md-6 col_margin">
                                <select name="city" class="txtreg form-control form-select input_ht select_address form_inputs reg_inputs" id="city" required="required">
                                    <option selected="true" disabled="disabled" value="">City</option>
                                </select>
                                <input type="hidden" class="form-control txtreg" name="city_text" id="city_text" required="required">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 col_width">
                            <select name="barangay" class="txtreg form-control form-select input_ht select_address form_inputs reg_inputs" id="barangay" required="required">
                                <option selected="true" disabled="disabled" value="">Barangay</option>
                            </select>
                            <input type="hidden" class="form-control txtreg" name="barangay_text" id="barangay_text" required="required">
                        </div>
                        <div class="col-md-6 col_margin col_width">
                            <div class="input-block form_inputs reg_inputs div_houseno">
                                <?php
                                if(isset($_SESSION['lHouseNo'])){
                                    ?>
                                    <input type="text" name="lHouseNo" id="lHouseNo" class="input_ht select_address txtreg" required="required" spellcheck="false" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['lHouseNo'] ?>">
                                    <span class="placeholder span_placeholder"> House No.</span>
                                    <?php
                                    unset($_SESSION['lHouseNo']);
                                }
                                else{
                                    ?>
                                    <input type="text" name="lHouseNo" id="lHouseNo" class="input_ht select_address txtreg" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                    <span class="placeholder span_placeholder"> House No.</span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <input type="submit" onclick="landlordvalidation()" class="btn align-items-center justify-content-center text-center input_ht mt-3" id="btn_register" value="Create Account">

                </form>
            </div>
        </div>
    </div>
    </div>
    <div class="d-none">
        <?php
        if(isset($_SESSION['region_text'])){
            ?>
            <input type="text" id="regiontxtvalue" value="<?php echo $_SESSION['region_text'] ?>">
            <?php
            unset($_SESSION['region_text']);
        }
        else{
        ?>
            <input type="text" id="regiontxtvalue" value="null">
        <?php
        }
        
        if(isset($_SESSION['province_text'])){
            ?>
            <input type="text" id="provincetxtvalue" value="<?php echo $_SESSION['province_text'] ?>">
            <?php
            unset($_SESSION['province_text']);
        }
        else{
        ?>
            <input type="text" id="provincetxtvalue" value="null">
        <?php
        }

        if(isset($_SESSION['city_text'])){
            ?>
            <input type="text" id="citytxtvalue" value="<?php echo $_SESSION['city_text'] ?>">
            <?php
            unset($_SESSION['city_text']);
        }
        else{
        ?>
            <input type="text" id="citytxtvalue" value="null">
        <?php
        }

        if(isset($_SESSION['barangay_text'])){
            ?>
            <input type="text" id="brgytxtvalue" value="<?php echo $_SESSION['barangay_text'] ?>">
            <?php
            unset($_SESSION['barangay_text']);
        }
        else{
        ?>
            <input type="text" id="brgytxtvalue" value="null">
        <?php
        }
        ?>
    </div>
</div>
<!-- script for slideshow -->
    <script>
        const btn_loginhover = document.querySelector('#btn_loginhover');
        const btn_registerhover = document.querySelector('#btn_registerhover');
        const form_box = document.querySelector('.form_box');
        const body = document.querySelector('body');
        const box = document.querySelector('.box');
        const modal = new bootstrap.Modal(document.getElementById('modalEnsure'));
        const btnNo = document.getElementById('noReq');
        var btnReg = document.getElementById("btn_registerhover");

        btn_registerhover.onclick = function(){
            form_box.classList.add('active');
            body.classList.add('active');
            box.classList.add('active');
            modal.show();
        }

        btn_loginhover.onclick = function(){
            form_box.classList.remove('active');
            body.classList.remove('active');
            box.classList.remove('active');
            window.history.pushState(null, null, regLink);
        }

        btnNo.onclick = function(){
            form_box.classList.remove('active');
            body.classList.remove('active');
            box.classList.remove('active');
            window.history.pushState(null, null, regLink);
        }

        window.onload = function() {
            setTimeout(function() {
                var regionSelect = document.getElementById("region");
                
                var region = document.getElementById("regiontxtvalue");

                if(region.value != "null"){
                    for (var i = 0; i < regionSelect.options.length; i++) {
                        if (regionSelect.options[i].text === region.value) {
                            regionSelect.selectedIndex = i;
                            btnReg.click();
                            break;
                        }
                    }
                }
                else{
                    regionSelect.value = "Region";
                }
                var event = new Event("change");
                regionSelect.dispatchEvent(event);
            }, 300);
            setTimeout(function() {
                var provinceSelect = document.getElementById("province");
                var province = document.getElementById("provincetxtvalue");

                if(province.value != "null"){
                    for (var i = 0; i < provinceSelect.options.length; i++) {
                        if (provinceSelect.options[i].text === province.value) {
                            provinceSelect.selectedIndex = i;
                            break;
                        }
                    }
                }
                else{
                    provinceSelect.selectedIndex = 0;
                }
                var event = new Event("change");
                provinceSelect.dispatchEvent(event);
            }, 600);
            setTimeout(function() {
                var citySelect = document.getElementById("city");
                var city = document.getElementById("citytxtvalue");

                if(city.value != "null"){
                    for (var i = 0; i < citySelect.options.length; i++) {
                        if (citySelect.options[i].text === city.value) {
                            citySelect.selectedIndex = i;
                            break;
                        }
                    }
                }
                else{
                    citySelect.selectedIndex = 0;
                }
                var event = new Event("change");
                citySelect.dispatchEvent(event);
            }, 900);
            setTimeout(function() {
                var brgySelect = document.getElementById("barangay");
                var brgy = document.getElementById("brgytxtvalue");

                if(brgy.value != "null"){
                    for (var i = 0; i < brgySelect.options.length; i++) {
                        if (brgySelect.options[i].text === brgy.value) {
                            brgySelect.selectedIndex = i;
                            break;
                        }
                    }
                }
                else{
                    brgySelect.selectedIndex = 0;
                }
                var event = new Event("change");
                brgySelect.dispatchEvent(event);
            }, 1200);
        };
    </script>

</body>
</html>

<?php
    }
    else{
        echo "<script>window.location.href = '../'</script>";
    }
    ?>