<?php
    include('../DataBase/connection.php');
    $code = $_GET['code'];
    $getEmailQuery = mysqli_query($con, "SELECT user_email FROM reset_password WHERE link_code='$code'");
    $email = mysqli_fetch_assoc($getEmailQuery);

    if(mysqli_num_rows($getEmailQuery) == 0 || !isset($_GET["code"])){
        exit("can't find page");
    }
    else{
        $userEmail = $email['user_email'];
        $delete_query = mysqli_query($con, "DELETE FROM reset_password WHERE link_code='$code'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Forgot Password</title>
    <link rel="icon" type="image/x-icon" href="/imgs/key.ico">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    

    <!-- CSS file -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesChangePassword.css">
    <link rel="stylesheet" href="../CSS/stylesLoginAs.css">
    <link rel="stylesheet" href="../CSS/stylesNav.css">

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="../JavaScripts/UsersSecurityQuery.js"></script>
    <script src="../../JavaScripts/functionNav.js"></script>
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

<body class="">

<!-- Navbar - Renter -->
<div class="nav-container fixed-top ">
    <nav class="navbar navbar-expand-md px-3 px-md-5">
        <div class="container-fluid">

            <!-- burger -->
            <button class="navbar-toggler collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuRenter" >
                <span class="toggler-icon top-bar"></span>
                <span class="toggler-icon middle-bar"></span>
                <span class="toggler-icon bottom-bar"></span>
            </button>

            <!-- logo -->
            <a class="navbar-brand" href="#">
                <img src="../imgs/logo.png" alt="RentA" id="imgLogo">
            </a>
            
            <!-- Avatar - Renter on small screen -->
            <div class="dropdown ms-auto d-sm-block d-md-none ">
                <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../imgs/b.png" alt="" class="img-avatar">
                    <i class="bi bi-chevron-down" id="chevron-down-avatar"></i>
                    <i class="bi bi-chevron-up" id="chevron-up-avatar"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-avatar-renter-sm " aria-labelledby="dropdrownbtn-avatar">
                    <li><a class="dropdown-item dropdown-item-first" href="#">My Profile</a></li>
                    <li><a class="dropdown-item" href="#">Messages</a></li>
                    <li><a class="dropdown-item" href="#">Favorites</a></li>
                    <li><a class="dropdown-item dropdown-item-last" href="#">Logout</a></li>
                </ul>
            </div>

            <!-- links center -->
            <div class="collapse navbar-collapse" id="navMenuRenter">

                <ul class="navbar-nav navbar-nav-renter d-flex align-items-center ms-auto">
                    <li class="nav-item px-3">
                        <a class="nav-link" href="#">Find Rentals</a>
                    </li>
                    <li class="nav-item px-4">
                        <a class="nav-link" href="RentersPage/application1Submit.php">Applications</a>
                    </li>
                </ul>

                <ul class="d-flex align-items-center ms-auto">
                    <!-- Avatar - Renter big-->
                    <div class="dropdown ">
                        <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../imgs/b.png" alt="" class="img-avatar me-1">
                            <i class="bi bi-chevron-down" id="chevron-down-avatar2"></i>
                            <i class="bi bi-chevron-up" id="chevron-up-avatar2"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-avatar-renter" aria-labelledby="dropdrownbtn-avatar">
                        <li><a class="dropdown-item dropdown-item-first" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">Messages</a></li>
                        <li><a class="dropdown-item" href="#">Favorites</a></li>
                        <li><a class="dropdown-item dropdown-item-last" href="#">Logout</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- end navbar renter -->


<!-- main container -->
    <div class="container-changepass">
        <div class="row">
            <div class="col-6">
                <div class="input_container d-flex justify-content-center align-items-center ">

                    <div class="reset d-flex flex-column justify-content-center align-items-center " >
                        <header class="header mb-3">Create New Password</header>
                        <p class="text-center mt-2">Type and confirm a secure new password <br/> for your account.</p>
                            
    
                        <div class="reset_form mt-3 d-flex flex-column justify-content-center form_inputs">
                            <form action="changePasswordFunction.php" method="POST">
    
                                <div class="input-block form_inputs d-flex flex-row mt-3 div_passes">
                                    <input type="password" name="new_pass" id="new_pass" class="input_ht hovers input_passes" minlength="8" onblur="checkPass()" required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> New Password </span>
                                    
                                    <span class="input-group-text btn " id="toggle_pass">
                                        <i class="bi bi-eye-slash loginPassIcon" id="toggle_icon"></i>
                                    </span>
                                </div>
                                
                                <div class="input-block form_inputs d-flex flex-row mt-3 div_passes">
                                    <input type="password" name="confirm_new_pass" id="confirm_new_pass" class="input_ht hovers input_passes" onkeyup="checkPassword()" minlength="8" required="required" placeholder=" " autocomplete="off">
                                    <span class="placeholder"> Confirm Password </span>
                                    
                                    <span class="input-group-text btn confirmPass" id="toggle_pass">
                                        <i class="bi bi-eye-slash loginPassIcon confPass" id="toggle_icon"></i>
                                    </span>
                                </div>
                                    
                                <button id="btn_reset" class="mt-4 inputs buttons">Reset Password</button>
                                
                                
                            </form>
                        </div>
                </div>
            </div>

            <!-- hide on screens smaller than large -->
            <div class="col-6 pic_container d-none d-lg-block">
                
            </div>
        </div>
    </div>

</body>
</html>
<?php
// Close the database connection
mysqli_close($con);
?>