<?php
    session_start();
    include ('../DataBase/connection.php');
    if(isset($_SESSION['rEmail'])){
        //notifdate
        date_default_timezone_set('Asia/Manila');
        $currentDateTime = new DateTime();
        $databaseFormattedDate = $currentDateTime->format('Y-m-d H:i:s');

        $user_email = $_SESSION['rEmail'];
        $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$user_email'";
        $executeSelectUser = mysqli_query($con, $selectUser);
        $getUser = mysqli_fetch_assoc($executeSelectUser);

        $separatedWordSecurity = $getUser['backupPhrase'];
        $_SESSION['renterId'] = $getUser['rId'];
        $wordArray = explode(" ", $separatedWordSecurity);

        $insertAdminNotif = "INSERT INTO admin_notification (renter_id, notif_info, date_notif, notif_status) VALUES ('".$getUser['rId']."', 'Renter-Register', '$databaseFormattedDate', 'unread')";
        $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);
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
    
    

    <!-- CSS files -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesBackupPhrase.css">
    <link rel="stylesheet" href="../CSS/loading.css">
    <link rel="stylesheet" href="../CSS/stylesNav.css">
    
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
        function gotIt(){
            propset = document.getElementById('txtSet');

            if(propset.value == "notset"){
                window.location.href = "../";
            }
            else{
                window.location.href = "application1Submit.php";
            }
        }
        
        setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeMessageCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#messageCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeMessageCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smmessageCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifyCircle").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smnotifyCircle").html(data);
                    }
                });
            }, 700);
    </script>

</head>

<body class="">

    <!-- <div class="loadBackground">
        <div class="Loadcontainer">
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/rLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/eLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/nLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" src="../imgs/imgLoading/tLoading.png" style="width: 30px; height:30px;"></div>
            <div class="imgLoading"><img class="imgLoad" id="imgA" src="../imgs/imgLoading/aLoading.png" style="width: 30px; height:30px;"></div>
        </div>
    </div> -->

    

</head>
<body>
    
<!-- Navbar - Renter -->
        <div class="nav-container fixed-top ">
        <nav class="navbar navbar-expand-md px-3 px-md-5">
            <div class="container-fluid">

                <div class="d-none">
                    <input type="text" id="txtEmail" value="<?php echo $_SESSION['rEmail'];?>">
                    <?php
                    if(isset($_SESSION['applyProperty'])){
                        ?>
                        <input type="text" id="txtSet" value="set">
                        <?php
                    }
                    else{
                        ?>
                        <input type="text" id="txtSet" value="notset">
                        <?php
                    }
                    ?>
                </div>

                <!-- burger -->
                <button class="navbar-toggler collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuRenter" >
                    <span class="toggler-icon top-bar"></span>
                    <span class="toggler-icon middle-bar"></span>
                    <span class="toggler-icon bottom-bar"></span>
                </button>

                <!-- logo -->
                <a class="navbar-brand" href="../RentA">
                    <img src="../imgs/logo.png" alt="RentA" id="imgLogo">
                </a>
                
                <!-- Avatar - Renter on small screen -->
                <div class="dropdown ms-auto d-sm-block d-md-none ">
                    <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $getUser['rImgProfile'] ?>" alt="" class="img-avatar">
                        <i class="bi bi-chevron-down" id="chevron-down-avatar"></i>
                        <i class="bi bi-chevron-up" id="chevron-up-avatar"></i>
                        <div class="d-none">
                            <input type="text" id="txtUserId" value="<?php echo $getUser['rId'] ?>">
                        </div>
                    <span id="smnotifyCircle">
                    </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-avatar-renter-sm " aria-labelledby="dropdrownbtn-avatar">
                    <li>
                        <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="renterNotifications.php" id="smNotifCount"> 
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="smmessageCount">Messages 
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="../favorites.php">Favorites</a></li>
                    <li><a class="dropdown-item " href="renterProfile.php">My Profile</a></li>
                    <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                </ul>
                </div>

                <!-- links center -->
                <div class="collapse navbar-collapse" id="navMenuRenter">

                    <ul class="navbar-nav navbar-nav-renter d-flex align-items-center ms-auto">
                        <li class="nav-item px-3">
                            <a class="nav-link" href="rentals.php">Find Rentals</a>
                        </li>
                        <li class="nav-item px-4">
                            <a class="nav-link" href="RentersPage/application1Submit.php">Applications
                            <span id="notifId">
                                    
                                    </span>
                            </a>
                        </li>
                    </ul>

                    <ul class="d-flex align-items-center ms-auto">
                        <!-- Avatar - Renter big-->
                        <div class="dropdown ">
                            <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $getUser['rImgProfile'] ?>" alt="" class="img-avatar me-1">
                                <i class="bi bi-chevron-down" id="chevron-down-avatar2"></i>
                                <i class="bi bi-chevron-up" id="chevron-up-avatar2"></i>

                            <span id="notifyCircle">
                            </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-avatar-renter" aria-labelledby="dropdrownbtn-avatar">
                                <li>
                                    <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="renterNotifications.php" id="notifCount"> 
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="messageCount">Messages 
                                    </a>
                                </li>
                                <li><a class="dropdown-item" href="../favorites.php">Favorites</a></li>
                                <li><a class="dropdown-item" href="renterProfile.php">My Profile</a></li>
                                <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- end navbar renter -->

<!-- MODAL LOGOUT -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="modalDelete" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalLogout">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/logout.png" alt="" class="img-logout">
                            <h5 class="text-center mt-1">Are you sure you want to log out?</h5>
                        </div>
                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                    <a href="../index.php?status=logout" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                  </div>
            </div>
        </div>
    </div>
<!-- modal end - LOGOUT -->

<!-- MAIN -->
    <div class="wrapper ">
            <div class="container" id="container_backup">

                <div class="text-center mt-4" >
                    <img src="../imgs/key-features.png" id="img_backup" alt="Image could not be shown."> 
                </div>
                <div class="text-center" id="txt_ver"><br/>
                    <h4 class="title">Secret Backup Phrase</h4>
                    <p class="mt-3">This 12-word secret phrase makes it easy to backup and restore your account. <br> </p>
                    <div class="d-none d-md-block"> <b>WARNING:</b> Never disclose your backup phrase. Anyone with this phrase <br> can reset your password.<br><br></div>
                    
                    <div class="d-block d-sm-block d-md-none"><b>WARNING:</b> <br> Never disclose your backup phrase. <br> Anyone with this phrase can <br> reset your password.<br><br></div>
                    </div>
                <div class="container mt-1 justify-content-center d-flex" id="code_container">
                    <textarea name="" id="phrase_container" cols="4" rows="3" disabled><?php echo "1. " . $wordArray[0] . "  2. " . $wordArray[1] . "  3. " . $wordArray[2] . "  4. "
                    . $wordArray[3] . "\n5. " . $wordArray[4] . "  6. " . $wordArray[5] . "  7. " . $wordArray[6] . "  8. " . $wordArray[7] . "\n9. " . $wordArray[8] . "  10. " . $wordArray[9]
                    . "  11. " . $wordArray[10] . "  12. " . $wordArray[11]; ?></textarea>
                </div>
                
                <div class="mt-4 text-center">
                    <input type='button' onclick="gotIt()" value='Got It' class="btn" id="btn_bckp_next">
                </div>
            </div>
    </div>
    

    <script>
        function blurFunction(){
            var up = document.getElementById("chevron-up-manage");
            var down = document.getElementById("chevron-down-manage");
            var upAvatar = document.getElementById("chevron-up-avatar");
            var downAvatar = document.getElementById("chevron-down-avatar");
            var upAvatar2 = document.getElementById("chevron-up-avatar2");
            var downAvatar2 = document.getElementById("chevron-down-avatar2");

            up.style.display = "none";
            down.style.display = "inline-block";

            upAvatar.style.display = "none";
            downAvatar.style.display = "inline-block";

            upAvatar2.style.display = "none";
            downAvatar2.style.display = "inline-block";
        }
        setInterval(function(){
                $.ajax({
                    url:"../Functions/Renters/realtimeapplicationNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifId").html(data);
                    }
                });
            }, 700);
    </script>
</body>
</html>
<?php
    }
    else{
        echo "<script>window.location.href = '../../../RentA/RentersPage/starterPage.php'</script>";
    }
    // Close the database connection
mysqli_close($con);
    ?>