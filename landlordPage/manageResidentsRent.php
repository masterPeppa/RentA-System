<!-- <?php
    include ('../DataBase/connection.php');
    session_start();
    if(isset($_SESSION['lEmail'])){
    $landlordEmail = $_SESSION['lEmail'];
    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $lgetId = mysqli_fetch_assoc($executeSelectUser);
    if(isset($_GET['id']) && $_GET['id'] != ""){
        $update_notif="UPDATE landlord_notification SET notif_status='read' WHERE id = '".$_GET['id']."'";
        $newnotif_update_executed=mysqli_query($con,$update_notif);
    } 
    else {
        $update_notif="UPDATE landlord_notification SET notif_status='read' WHERE landlord_id = '".$lgetId['lID']."' AND notif_info='receipt'";
        $newnotif_update_executed=mysqli_query($con,$update_notif);
    }
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Residents' Rents</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">
    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesNav.css">
    <link rel="stylesheet" href="../CSS/stylesManageApplicants.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    
</head>
<body>

<!-- MODAL NOT VERIFIED YET -->
<div class="modal fade" id="cantListModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals modal_cantList">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                        <img src="../../imgs/warning.png" alt="" class="img-logout">
                        <h5 class="text-center mt-2 modal-txt"> Oops! You can't list a property yet since the admin is still verifying your identity. We will notify you immediately when you are already verified.</h5>
                    </div>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn modal-logout-btns btn-del px-4 py-2" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - NOT VERIFIED YET --> 

<!-- Navbar - Landlord -->
<div class="nav-container fixed-top">
        <nav class="navbar navbar-expand-md px-3 px-md-5">
            <div class="container-fluid">
			<!-- for save condition -->
                <div class="d-none">
                    <input type="text" id="txtEmail" value="<?php echo $_SESSION['lEmail'];?>">
                </div>
                <!-- burger -->
                <button class="navbar-toggler collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuLandlord" >
                    <span class="toggler-icon top-bar"></span>
                    <span class="toggler-icon middle-bar"></span>
                    <span class="toggler-icon bottom-bar"></span>
                </button>

                <!-- logo -->
                <a class="navbar-brand" href="../../RentA">
                    <img src="../imgs/logo.png" alt="RentA" id="imgLogo">
                </a>
                
                <!-- Avatar - Landlord on small screen -->
                <div class="dropdown ms-auto d-sm-block d-md-none">
                    <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $lgetId['lImgProfile'] ?>" alt="" class="img-avatar me-1">
                        <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar"></i>
                        <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar"></i>
                        <div class="d-none">
                            <input type="text" id="txtUserId" value="<?php echo $lgetId['lID'] ?>">
                        </div>
                    <span id="smnotifyCircle">
                    </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-avatar-sm " aria-labelledby="dropdrownbtn-avatar">
                        <li>
                            <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="landlordNotifications.php" id="smNotifCount">
                                Notifications 
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="smmessageCount">Messages 
                                
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="landlordProfile.php">My Profile</a></li>
                        <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                    </ul>
                </div>

                <!-- links center -->
                <div class="collapse navbar-collapse" id="navMenuLandlord">

                    <ul class="navbar-nav navbar-nav-landlord d-flex align-items-center">
                        
                        <li class="nav-item px-3">
                            <a class="nav-link" href="manageProperty.php">My Properties</a>
                        </li>

                        <!-- Manage Renters -->
                        <li class="nav-item dropdown d-none d-sm-none d-md-block">
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn active-dropdown btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage Renters
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-manage" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="manageApplicants.php">Applicants</a></li>
                                <li><a class="dropdown-item" href="manageLeases.php">Leases</a></li>
                                <li><a class="dropdown-item" href="manageAdvancePayments.php">Advance Payments</a></li>
                                <li><a class="dropdown-item" href="manageResidents.php">Residents</a></li>
                                <li><a class="dropdown-item dropdown-item-last active-dropdown" href="manageResidentsRent.php">Residents' Rents</a></li>
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageApplicants.php">Applicants</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " href="manageLeases.php">Leases</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageAdvancePayments.php">Advance Payments</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="manageResidents.php">Residents</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link active-dropdown" href="manageResidentsRent.php">Residents' Rents</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link listProperty" onclick="checklistProperty1()">List a Property</a>
                        </li>

                    </ul>
                    
                    <ul class="d-flex align-items-center ms-auto">
                        <!-- Avatar - Landlord big-->
                        <div class="dropdown me-2 d-none d-sm-none d-md-block ">
                            <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $lgetId['lImgProfile'] ?>" alt="" class="img-avatar me-1">
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>
                                <span id="notifyCircle">
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-avatar" aria-labelledby="dropdrownbtn-avatar">
                                <li>
                                    <a class="dropdown-item dropdown-item-first d-flex justify-content-between" href="landlordNotifications.php" id="notifCount">
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="messageCount">
                                    </a>
                                </li>
                                <li><a class="dropdown-item " href="landlordProfile.php">My profile</a></li>
                                <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                            </ul>
                        </div>

                        <!-- List property button -->
                        <div class=" nav-item d-none d-sm-none d-md-block">
                            <a onclick="checklistProperty1()" class="btn btns listProperty btn_listProperty pt-2">List a Property</a>
                        </div>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
<!-- end nav landlord -->

<!-- MODAL LOGOUT -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content container_modalLogout">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <section class="section_logout">
                        
                        <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/logout.png" alt="Log Out" class="img-logout">
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
<?php
    $selectlistlease = "SELECT * FROM lease WHERE landlord_id='".$lgetId['lID']."' AND (lease_status='residing' OR lease_status='moved-out')";
    $executelistlease = mysqli_query($con, $selectlistlease);
    $getlistlease = mysqli_fetch_all($executelistlease, MYSQLI_ASSOC);
?>
<!-- NO APPLICANTS -->
    <?php 
    if(count($getlistlease) == 0){
        ?>
    <div class="container-fluid container-no-approved-applicants px-3 px-md-5 py-3">
        <header>
            <h3 class="title">Residents' Rents</h3>
            <p class="mt-3">You currently have no record of resident's rent.</p>
        </header>

        <!-- refresh button -->
        <div class="d-flex gap-2 mt-3">
        <button class="btn refresh-btn" onclick="refreshPage()" id="btnrefresh">
            </button>
        </div>
    </div>
<?php
    }
    else{
?>
<!-- THERE'S APPROVED APPLICANTS -->
    <div class="container-fluid container-approved-applicants px-3 px-md-5 py-3">
        <header>
            <h3 class="title">Residents' Rents</h3>
            <p class="mt-3">You currently have <span class="total-residents"> <b><?php echo count($getlistlease) ?></b></span> record of resident's rent.</p>
        </header>

        <!-- refresh button -->
        <div class="d-flex gap-2 mt-3">
        <button class="btn refresh-btn" onclick="refreshPage()" id="refreshButton">
            </button>
        </div>

    <!-- TABLE -->
        <table role="table" class="table-manage-applicants mt-3">
        <!-- HEADER -->
            <thead role="rowgroup" class="headers">
                <tr role="row" class="headers">
                    
                    <th role="columnheader" class="py-3 pe-5">ID No.</th>
                    <th role="columnheader" class="py-3 pe-5">Name</th>
                    <th role="columnheader" class="py-3 pe-3">Property Info</th>
                    <th role="columnheader" class="py-3 pe-3">Lease start</th>
                    <th role="columnheader" class="py-3 pe-5">Lease end</th>
                    <th role="columnheader" class="py-3 pe-5">Due every</th>
                    <th role="columnheader" class="py-3 pe-3">Actions</th>
                </tr>
            </thead>

        <!-- DATA -->
            <tbody role="rowgroup">
            <?php
                    for($i = 0; $i < count($getlistlease); $i++){
                        $propertyId = $getlistlease[$i]['property_id'];
                        $renterId = $getlistlease[$i]['renter_id'];

                        $datestart = date("m/d/Y", strtotime($getlistlease[$i]['starting_lease_date']));
                        $dateend = date("m/d/Y", strtotime($getlistlease[$i]['ending_lease_date']));
                        
                        $selectProperty = "SELECT * FROM landing_properties WHERE propertyID='$propertyId'";
                        $executeProperty = mysqli_query($con, $selectProperty);
                        $getProperty = mysqli_fetch_assoc($executeProperty);

                        $selectrenter= "SELECT * FROM user_renter WHERE rId='$renterId'";
                        $executerenter = mysqli_query($con, $selectrenter);
                        $getrenterinfo = mysqli_fetch_assoc($executerenter);
                    ?>
                <tr role="row" class="border-bottom">
                    <td role="cell" class="py-3 pe-2 manage-res-rent" id="signingstatus"> <?php echo $getrenterinfo['rId'] ?> </td>
                    <td role="cell" class="py-3 pe-2 manage-res-rent"><?php echo $getrenterinfo['rFname'] . " " . $getrenterinfo['rLname']?></td>
                    <td role="cell" class="py-3 pe-2 manage-res-rent"><?php echo $getProperty['propertyTitle'] ?></td>
                    <td role="cell" class="py-3 pe-2 manage-res-rent"><?php
                        $dbdatetime = $datestart;
                        $datetime = new DateTime($dbdatetime);
                        $date = $datetime->format('m-d-Y');
                        $dbdatedata = $datetime->format('m-d-Y');

                        echo $dbdatedata ?></td>
                    <td role="cell" class="py-3 pe-2 manage-res-rent"><?php 
                        $dbdatetime = $dateend;
                        $datetime = new DateTime($dbdatetime);
                        $date = $datetime->format('m-d-Y');
                        $dbdatedata = $datetime->format('m-d-Y');

                        echo $dbdatedata ?></td>
                    <td role="cell" class="py-3 pe-2 manage-res-rent"><b><?php echo $getlistlease[$i]['preferred_monthly_rent'] ?></b> </td>
                    <td role="cell" class="py-3 manage-res-rent">
                        <a href="manageResidentsRentRecord.php?leaseid=<?php echo $getlistlease[$i]['id'] ?>" class="btn btns btn-confirm px-1 py-2 d-flex align-items-center justify-content-center" role="button">
                            <i class="bi bi-search-heart actionIcon pe-1"></i>
                            <span>Records</span>
                        </a>
                    </td>
              </tr>
              <?php
                }
                ?>
            </tbody>
          </table>

    </div>
<div class="d-none">
    <input type="text" id="txtiteratecount" value="<?php echo count($getlistlease)?>">
</div>
<?php
    }
    ?>



    <!-- JS -->
    <script src="../JavaScripts/functionNav.js"></script>
    <script defer src="../JavaScripts/functionManageProperty.js"></script>

    <script>
            function blurFunction(){
                var upManage = document.getElementById("chevron-up-manage");
                var downManage = document.getElementById("chevron-down-manage");
                var upAvatar = document.getElementById("chevron-up-avatar");
                var downAvatar = document.getElementById("chevron-down-avatar");
                var upAvatar2 = document.getElementById("chevron-up-avatar2");
                var downAvatar2 = document.getElementById("chevron-down-avatar2");

                upAvatar.style.display = "none";
                downAvatar.style.display = "inline-block";

                upAvatar2.style.display = "none";
                downAvatar2.style.display = "inline-block";

                upManage.style.display = "none";
                downManage.style.display = "inline-block";
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

            // var i = 0;
            //     setInterval(function () {
            //         $.ajax({
            //             url: "../Functions/Landlord/refreshAdvancePayment.php",
            //             method: "POST",
            //             data: {
            //                 userid: $("#txtUserId").val(),
            //                 currentValue: $("#currentValue"+i).val(),
            //                 currentiterationcount: $("#txtiteratecount").val(),
            //                 iterate: i
            //             },
            //             dataType: "text",
            //             success: function (data) {
            //             var iteration = document.getElementById('txtiteratecount').value;
            //                 i++;
            //                 if (i >= iteration) {
            //                     i = 0;
            //                 }
            //                 $("#btnrefresh").html(data);
            //                 $("#refreshButton").html(data);
            //             }
            //         });
            //     }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Landlord/realtimeNotifCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Landlord/realtimeNotifCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smNotifCount").html(data);
                    }
                });
            }, 700);
    </script>



</body>
</html>
<!-- <?php
    }
    else{
        if(isset($_GET['data']) && $_GET['data'] != ""){
            echo "<script>window.location.href = 'starterPage.php?data=".$_GET['data']."'</script>";
        }
        else{
            echo "<script>window.location.href = '../../../RentA/landlordPage/starterPage.php'</script>";
        }
    }
    ?> -->