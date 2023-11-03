<?php 
    session_start();
    $identity = "renter";
    $_SESSION['identity'] = $identity;
    $userEmail = "null";
    if (isset($_SESSION['current_email']) && isset($_SESSION['rConfirmPassword'])) {
        $userEmail = $_SESSION['rEmail'];
        unset($_SESSION['rEmail']);
    } 
    else if (isset($_SESSION['current_email']) && isset($_SESSION['lConfirmPassword'])) {
        unset($_SESSION['lFname']);
        unset($_SESSION['lLname']);
        unset($_SESSION['lEmail']);
        unset($_SESSION['lNumber']);
        unset($_SESSION['datepicker_input']);
        unset($_SESSION['lPassword']);
        unset($_SESSION['lConfirmPassword']);
        unset($_SESSION['region_text']);
        unset($_SESSION['province_text']);
        unset($_SESSION['city_text']);
        unset($_SESSION['barangay_text']);
        unset($_SESSION['lHouseNo']);
    }
    if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- CSS file -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesRenterStarter.css">
    <!-- <link rel="stylesheet" href="../CSS/loading.css"> -->
    <link rel="stylesheet" href="../CSS/stylesNav.css">
    <link rel="stylesheet" href="../CSS/stylesLoginAs.css">

    <!--Date Picker-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!--JQuery-->
    <script src="../JavaScripts/RentersPageQuery.js"></script>
    <script src="../JavaScripts/AJAX-Functions.js"></script>
    <script src="../JavaScripts/functionNav.js"></script>
    

</head>
<body>
    <!-- loading -->
    <!-- <div class="loadBackground">
        <div class="Loadcontainer">
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/rLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/eLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/nLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/tLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" id="imgA" src="../imgs/imgLoading/aLoading.png" style="width: 30px; height:30px;"></div>
        </div>
    </div> -->

<!-- Navbar - Guest -->
    <div class="nav-container fixed-top">
        <nav class="navbar navbar-expand-md px-3 px-md-5">
            <div class="container-fluid">

                <!-- burger -->
                <button class="navbar-toggler navbar-toggler-log collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuGuest" >
                    <span class="toggler-icon top-bar"></span>
                    <span class="toggler-icon middle-bar"></span>
                    <span class="toggler-icon bottom-bar"></span>
                </button>

                <!-- logo -->
                <a class="navbar-brand" href="../../RentA">
                    <img src="../imgs/logo.png" alt="RentA" id="imgLogo" class="imgLogo-log">
                </a>
                
                <!-- Avatar - guest on small screen -->
                <div class="dropdown ms-auto d-sm-block d-md-none">
                    <li class="nav-link interact-as" >You're interacting as a <b>Renter</b> </li>
                </div>

                <!-- links center -->
                <div class="collapse navbar-collapse navMenuGuest-renter" id="navMenuGuest">

                    <ul class="navbar-nav navbar-nav-renter d-flex align-items-center ms-auto">
                        <li class="nav-item px-3 d-none d-md-block li-as-renter li-as">
                           You're interacting as a <b>Renter</b>
                        </li>
                        <li class="d-sm-block d-md-none">
                            <?php
                            if(!isset($_GET['property']) || $_GET['property'] == ""){
                                ?>
                                <a href="../landlordPage/starterPage.php" class="a-iAm">I'm a Landlord</a>
                                <?php
                            }
                            else{
                                $_SESSION['applyProperty'] = $_GET['property'];
                            }
                            ?>
                        </li>
                    </ul>

                    <ul class="d-flex align-items-center ms-auto">
                        <!-- Avatar - guest big-->
                        <?php
                            if(!isset($_GET['property']) || $_GET['property'] == ""){
                                ?>
                                <a href="../landlordPage/starterPage.php" class="a-iAm">I'm a Landlord</a>
                                <?php
                            }
                            ?>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
<!-- end navbar - guest -->

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
                            <h5 class="text-center mt-2">Invalid Credentials. <br> This account belongs to a landlord. </h5>
                            <a href="../LandlordPage/starterPage.php" class="mt-3 link-invalid-credential">Log in as landlord instead</a>
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
<!-- modal end - INVALID CREDENTIALS -->

<!-- main -->
    <div class="container-fluid container-start-renter">
        <div class="container container-renter">
            <div class="bg d-flex justify-content-center align-items-center">
                
                <div class="box login">
                    <h2 class="d-none d-sm-none d-md-block renting_txt">Renting made easy. </br>
                        Find your home easily.</h2>
                    <p class="mt-4">Already have an account?
                        <button href="" class="hover_btns" id="btn_loginhover">Log In</button>
                    </p>
                </div>

                <div class="box register">

                    <h2 class="d-none d-sm-none d-md-block renting_txt">Renting made easy. </br>
                        Find your home easily.</h2>

                    <p class="mt-4">No account yet? 
                        <button class="hover_btns" id="btn_registerhover">Register</button>
                    </p>
                </div>
            </div>

            <div class="form_box d-flex justify-content-center align-items-center">

                <div class="form form_login d-flex align-items-center justify-content-center flex-column">
                    <header class="mb-5 mt-5 text-center">
                        Welcome Back
                    </header>

                    <div class="divLogin">
                        
                        <div class="input-block form_inputs mb-3" >
                            <input type="email" name="rEmail" id="login_email" class="login_inputs" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                            <span class="placeholder"> Email address </span>
                        </div>

                        <div class="input-block form_inputs d-flex flex-row" id="login_pass">
                            <input type="password" name="rPassword" id="login_password" class="login_inputs" required="required" placeholder=" " autocomplete="off">
                            <span class="placeholder"> Password </span>
                            
                            <span class="input-group-text btn " id="toggle_loginpass">
                                <i class="bi bi-eye-slash loginPassIcon" id="toggle_icon"></i>
                            </span>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="../forgotPassword.php?user=Renter" id="btn_forgot"> Forgot Password? </a>
                        </div>
                        <button type="submit" class="mt-5 mb-4" value="Log In" id="btn_login">Log In</button>
                    </div>
                </div>

                <div class="form form_register d-flex align-items-center justify-content-center flex-column">
                    <header class="text-center">
                        Get Started Now
                    </header>

                    <form action="../Functions/verificationProcess.php" onsubmit="return validateForm()" method="POST" class="d-flex flex-column gap-3 form-r mt-3 divLogin">
                        
                        <div class="input-block form_inputs reg_inputs d-flex flex-row names gap-2" id="div_fname" >
                            
                        <?php
                            if(isset($_SESSION['rFname'])){
                                ?>
                                <input type="text" name="rFname" id="rFname" class="input_ht" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['rFname'] ?>">
                                <span class="placeholder span_placeholder"> First Name </span>
                                <?php
                                unset($_SESSION['rFname']);
                            }
                            else{
                                ?>
                                <input type="text" name="rFname" id="rFname" class="input_ht" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                                <span class="placeholder span_placeholder"> First Name </span>
                                <?php
                            }
                        if(isset($_SESSION['rLname'])){
                            ?>
                            <input type="text" name="rLname" id="rLname" class="input_ht" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['rLname'] ?>">
                            <span class="placeholder span_placeholder" id="placeholder_lname"> Last Name </span>
                            <?php
                            unset($_SESSION['rLname']);
                        }
                        else{
                            ?>
                            <input type="text" name="rLname" id="rLname" class="input_ht" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                            <span class="placeholder span_placeholder" id="placeholder_lname"> Last Name </span>
                            <?php
                        }
                        ?>
                        </div>

                    <div class="input-block form_inputs reg_inputs form_blocks">
                    <?php
                    if($userEmail != "null"){
                        ?>
                        <input type="email" name="rEmail" id="rEmail" onkeyup="focusrEmail()" class="input_ht input_holders" required="required" spellcheck="false" placeholder=" " autocomplete="off" value="<?php echo $userEmail ?>">
                        <span class="placeholder span_placeholder"> Email address </span>
                        <?php
                    }
                    else{
                        ?>
                        <input type="email" name="rEmail" id="rEmail" onkeyup="focusrEmail()" class="input_ht input_holders" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                        <span class="placeholder span_placeholder"> Email address </span>
                        <?php
                    }
                    ?>
                    </div>

                    <div class="input-block form_inputs reg_inputs d-flex flex-row with_span" >
                    <?php
                    if(isset($_SESSION['rPassword'])){
                        ?>
                        <input type="password" name="rPassword" id="rPassword" onkeyup="focusrPassword()" class="input_ht input_left" minlength="8" required="required" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['rPassword'] ?>">
                        <span class="placeholder span_placeholder"> Password </span>
                        <?php
                        unset($_SESSION['rPassword']);
                    }
                    else{
                        ?>
                        <input type="password" name="rPassword" id="rPassword" onkeyup="focusrPassword()" class="input_ht input_left" minlength="8" required="required" placeholder=" " autocomplete="off">
                        <span class="placeholder span_placeholder"> Password </span>
                        <?php
                    }
                    ?>

                        <span class="input-group-text input_ht span_right btn" id="toggle_password1">
                            <i class="bi bi-eye-slash span_icons toggle_icon icon1" id=""></i>
                        </span>
                    </div>

                    <?php if(isset($_GET['id']) && $_GET['id'] != ""){ ?>
                        <div class="d-none">
                            <input type="text" id="txtLandlord" value="<?php echo $_GET['id'] ?>">
                        </div>
                    <?php
                    }
                    else{
                        ?>
                        <div class="d-none">
                            <input type="text" id="txtLandlord" value="null">
                        </div>
                        <?php
                    }
                    if(isset($_GET['date']) && $_GET['date'] != ""){ ?>
                        <div class="d-none">
                            <input type="text" id="txtdate" value="<?php echo $_GET['date'] ?>">
                        </div>
                    <?php
                    }
                    else{
                        ?>
                        <div class="d-none">
                            <input type="text" id="txtdate" value="null">
                        </div>
                        <?php
                    }
                    ?>
                    
                    <div class="input-block form_inputs reg_inputs d-flex flex-row with_span" >
                    <?php
                    if(isset($_SESSION['rConfirmPassword'])){
                        ?>
                        <input type="password" name="rConfirmPassword" id="rConfirmPassword" onkeyup="focusrConfirmPassword()" class="input_ht input_left" minlength="8" required="required" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['rConfirmPassword'] ?>">
                        <span class="placeholder span_placeholder"> Confirm Password </span>
                        <?php
                        unset($_SESSION['rConfirmPassword']);
                    }
                    else{
                        ?>
                        <input type="password" name="rConfirmPassword" id="rConfirmPassword" onkeyup="focusrConfirmPassword()" class="input_ht input_left" minlength="8" required="required" placeholder=" " autocomplete="off">
                        <span class="placeholder span_placeholder"> Confirm Password </span>
                        <?php
                    }
                    ?>

                        <span class="input-group-text input_ht span_right btn" id="toggle_password2">
                            <i class="bi bi-eye-slash span_icons toggle_icon icon2" id=""></i>
                        </span>
                    </div>

                    <!-- <div class="d-flex flex-row gap-2 "> -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-block form_inputs reg_inputs d-flex flex-row row_span" id="qNumber" >
                                <span class="input-group-text input_ht span_left span_num" id="">+63</span>
                            <?php
                            if(isset($_SESSION['rNumber'])){
                                ?>
                                <input type="text" name="rNumber" id="rNumber" onkeyup="focusrMobileNumber()" class="num_box input_ht input_right" minlength="10" maxlength="10" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required="required" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['rNumber'] ?>">
                                <span class="placeholder span_placeholder"> Mobile Number </span>
                                <?php
                                unset($_SESSION['rNumber']);
                            }
                            else{
                                ?>
                                <input type="text" name="rNumber" id="rNumber" onkeyup="focusrMobileNumber()" class="num_box input_ht input_right" minlength="10" maxlength="10" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required="required" placeholder=" " autocomplete="off">
                                <span class="placeholder span_placeholder"> Mobile Number </span>
                                <?php
                            }
                            ?>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col_bday">
                            <div class="input-block form_inputs reg_inputs d-flex flex-row date row_span" id="picker">
                                
                                <span class="input-group-text input_ht btn span_left span_bday">
                                    <i class="bi bi-calendar-event date_icon" id=""></i>
                                </span>
                            <?php
                            if(isset($_SESSION['datepicker_input'])){
                                ?>
                                <input type="text" name="datepicker_input" id="datepicker_input" class="input_ht input_right" onkeydown="return false;" required="required" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['datepicker_input'] ?>">
                                <span class="placeholder span_placeholder"> Birthdate </span>
                                <?php
                                unset($_SESSION['datepicker_input']);
                            }
                            else{
                                ?>
                                <input type="text" name="datepicker_input" id="datepicker_input" class="input_ht input_right" onkeydown="return false;" required="required" placeholder=" " autocomplete="off">
                                <span class="placeholder span_placeholder"> Birthdate </span>
                                <?php
                            }
                            ?>

                            </div>
                        </div>

                    </div>

                    <select class="form-select form_inputs reg_inputs mx-auto" name="rOccupation" id="rOccupation" required="required">
                        <option selected="selected" selected disabled hidden value="">Occupation</option>
                        <?php
                        if(isset($_SESSION['rOccupation'])){
                            if($_SESSION['rOccupation'] == "Professional"){
                                ?>
                                <option value="Professional" selected>Professional</option>
                                <option value="Self-Employed">Self-Employed</option>
                                <option value="Social Worker">Social Worker</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="OFW">OFW</option>
                                <option value="Others">Others</option>
                                <?php
                            }
                            else if($_SESSION['rOccupation'] == "Self-Employed"){
                                ?>
                                <option value="Professional">Professional</option>
                                <option value="Self-Employed" selected>Self-Employed</option>
                                <option value="Social Worker">Social Worker</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="OFW">OFW</option>
                                <option value="Others">Others</option>
                                <?php
                            }
                            else if($_SESSION['rOccupation'] == "Social Worker"){
                                ?>
                                <option value="Professional">Professional</option>
                                <option value="Self-Employed">Self-Employed</option>
                                <option value="Social Worker" selected>Social Worker</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="OFW">OFW</option>
                                <option value="Others">Others</option>
                                <?php
                            }
                            else if($_SESSION['rOccupation'] == "Freelancer"){
                                ?>
                                <option value="Professional">Professional</option>
                                <option value="Self-Employed">Self-Employed</option>
                                <option value="Social Worker">Social Worker</option>
                                <option value="Freelancer" selected>Freelancer</option>
                                <option value="OFW">OFW</option>
                                <option value="Others">Others</option>
                                <?php
                            }
                            else if($_SESSION['rOccupation'] == "OFW"){
                                ?>
                                <option value="Professional">Professional</option>
                                <option value="Self-Employed">Self-Employed</option>
                                <option value="Social Worker">Social Worker</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="OFW" selected>OFW</option>
                                <option value="Others">Others</option>
                                <?php
                            }
                            else{
                                ?>
                                <option value="Professional">Professional</option>
                                <option value="Self-Employed">Self-Employed</option>
                                <option value="Social Worker">Social Worker</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="OFW">OFW</option>
                                <option value="Others" selected>Others</option>
                                <?php
                            }
                        }
                        else{
                            ?>
                            <option value="Professional">Professional</option>
                                <option value="Self-Employed">Self-Employed</option>
                                <option value="Social Worker">Social Worker</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="OFW">OFW</option>
                                <option value="Others">Others</option>
                                <?php
                        }
                        ?>
                    </select> 
                    <?php
                    if(isset($_SESSION['rOccupation'])){
                        if($_SESSION['rOccupation'] != "Professional" && $_SESSION['rOccupation'] != "Self-Employed" && $_SESSION['rOccupation'] != "Social Worker"
                        && $_SESSION['rOccupation'] != "Freelancer" && $_SESSION['rOccupation'] != "OFW"){
                            ?>
                    <div class="input-block form_inputs reg_inputs form_blocks d-block" id="rDivJobOther" >
                        
                            <input type="tonkeydownext" name="rJobOther" id="rJobOther" class="input_ht input_holders" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off" value="<?php echo $_SESSION['rOccupation'] ?>">
                            <span class="placeholder span_placeholder"> Please specify occupation </span>
                            
                    </div>
                    <?php
                        }
                        else{
                            ?>
                            <div class="input-block form_inputs reg_inputs form_blocks d-none" id="rDivJobOther" >

                        <input type="tonkeydownext" name="rJobOther" id="rJobOther" class="input_ht input_holders" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                        <span class="placeholder span_placeholder"> Please specify occupation </span>
                        
                </div>
                <?php
                        }
                    }
                        else{
                            ?>
                            <div class="input-block form_inputs reg_inputs form_blocks d-none" id="rDivJobOther" >

                        <input type="tonkeydownext" name="rJobOther" id="rJobOther" class="input_ht input_holders" onkeydown="return /^([a-z A-Z])*$/i.test(event.key)" required="required" spellcheck="false" placeholder=" " autocomplete="off">
                        <span class="placeholder span_placeholder"> Please specify occupation </span>
                        
                </div>
                            <?php
                        }
                        unset($_SESSION['rOccupation']);
                        ?>

                    <input onclick="rentervalidation()" type="submit" class="btn align-items-center justify-content-center text-center input_ht" id="btn_register" value="Create Account">

                    </form>
                </div>


            </div>
        </div>
    </div>

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
    
    <script>
        const btn_loginhover = document.querySelector('#btn_loginhover');
        const btn_registerhover = document.querySelector('#btn_registerhover');
        const form_box = document.querySelector('.form_box');
        const body = document.querySelector('body');
        const box = document.querySelector('.box');

        btn_registerhover.onclick = function(){
            form_box.classList.add('active');
            body.classList.add('active');
            box.classList.add('active');
        }

        btn_loginhover.onclick = function(){
            form_box.classList.remove('active');
            body.classList.remove('active');
            box.classList.remove('active');
        }
        window.onload = function() {
            setTimeout(function() {
                var rOccupation = document.getElementById("rOccupation");
                var event = new Event("change");
                if(rOccupation.value != ""){
                    btn_registerhover.click();
                }
                rOccupation.dispatchEvent(event);
            }, 300);
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