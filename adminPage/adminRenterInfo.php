<?php
include ('../DataBase/connection.php');
session_start();

if(isset($_SESSION['useradmin'])){
    $selectadminnotif = "SELECT * FROM admin_notification WHERE notif_status='unread' ORDER BY date_notif DESC";
    $executeadminnotif = mysqli_query($con, $selectadminnotif);
    $row_adminnotif = mysqli_fetch_all($executeadminnotif, MYSQLI_ASSOC);

    if(isset($_GET['id']) && $_GET['id'] != ""){
        $selectrenter = "SELECT * FROM user_renter WHERE rId='".$_GET['id']."'";
        $executerenter = mysqli_query($con, $selectrenter);
        $row_renter = mysqli_fetch_assoc($executerenter);

        $date = $row_renter['rBday'];
        $datedbformat = new DateTime($date);
        $formatted_date = $datedbformat->format('F d, Y');

        if(isset($_GET['notifid']) && $_GET['notifid'] != ""){
            $update_notif="UPDATE admin_notification SET notif_status='read' WHERE id = '".$_GET['notifid']."'";
            $newnotif_update_executed=mysqli_query($con,$update_notif);
        }
        else{
            $update_notif="UPDATE admin_notification SET notif_status='read' WHERE renter_id='".$_GET['id']."' AND notif_info='Renter-Register'";
            $newnotif_update_executed=mysqli_query($con,$update_notif);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Admin</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">

    <!-- Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesAdmin.css">
    
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>

    <!-- MODAL LOGOUT -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalLogout">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body modal-body-logout">
                    <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                        <img src="../imgs/logout-purple.png" alt="Log Out" class="img-logout">
                        <h5 class="text-center mt-1">Are you sure you want to log out?</h5>
                    </div>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                    <a href="../index.php?status=logout" class="btn btn-go modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                  </div>
            </div>
        </div>
    </div>
    <!-- modal end - LOGOUT -->

        <!-- MODAL STATE REASON -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalReason">
    
                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
    
                    <div class="modal-body">
                        <section class="">
                            <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                                <img src="../imgs/question.png" alt="Log Out" class="img-logout">
                                <h5 class="text-center mt-2 modal-txt">Please let the landlord know your reason for not verifying his ID.</h5>
                                <textarea name="" id="txtReason" class="txtarea-reason p-3 mt-2" id="" cols="" rows="" placeholder="State reason here..."></textarea>
                            </div>
                        </section>
                    </div>
    
                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn admin-btns btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">Cancel</button>
                        <a onclick="" class="btn admin-btns btn-del modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - STATE REASON --> 

    <!-- MAIN `````````` -->
    <div class="admin-sidebar position-fixed top-0">
        <div class="admin-logo-div d-flex gap-4 align-items-center ">
            <!-- <img src="../imgs/a .png" alt="" style="height: 27px;" class="img-a"> -->
            <img src="../imgs/key.png" alt="" style="height:25px;" class="key-logo">
            <img src="../imgs/logo.png" alt="" style="height:80px;" class="admin-logo">
        </div>
        <div class="items-container d-flex flex-column justify-content-center ">    
            <a href="adminDashboard.php" class="item">
                <div class="item-box  d-flex align-items-center gap-4">
                    <!-- <img src="../imgs/admin/dashboard.png" class="item-img"> -->
                    <i class='bx bxs-dashboard'></i>
                    <span>Dashboard</span>
                </div>
            </a>
            <a href="adminType.php" class="item">
                <div class="item-box d-flex align-items-center gap-4">
                    <img src="../imgs/admin/property-type.png" class="item-img">
                    <span>Property Type</span>
                </div>
            </a>
            <a href="adminProperties.php" class="item">
                <div class="item-box d-flex align-items-center gap-4">
                    <img src="../imgs/admin/properties.png" class="item-img">
                    <span>Properties</span>
                </div>
            </a>
            <a href="adminLandlords.php" class="item">
                <div class="item-box d-flex align-items-center gap-4">
                    <img src="../imgs/admin/landlord.png" class="item-img">
                    <span>Landlords</span>
                </div>
            </a>
            <a href="adminRenters.php" class="item">
                <div class="item-box active-item-box  d-flex align-items-center gap-4">
                    <img src="../imgs/admin/renters.png" class="item-img">
                    <span>Renters</span>
                </div>
            </a>
            <a href="adminApplications.php" class="item">
                <div class="item-box d-flex align-items-center gap-4">
                    <img src="../imgs/admin/applicants.png" class="item-img">
                    <span>Applications</span>
                </div>
            </a>
            <a href="adminLeases.php" class="item">
                <div class="item-box d-flex align-items-center gap-4">
                    <img src="../imgs/admin/leases.png" class="item-img">
                    <span>Leases</span>
                </div>
            </a>
            
        </div><!-- end of items-container div -->

        <a href="#" class="item h-25 d-flex align-items-end pb-5 log" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <div class="item-box d-flex align-items-center gap-4">
                <img src="../imgs/admin/logout.png" class="item-img">
                <span>Logout</span>
            </div>
        </a>
    </div>

    <section class="home-section">
        <nav class="ps-3 pe-md-5 pe-sm-3 pe-3 py-3 d-flex align-items-center justify-content-between">
            <div class="sidebar-btn ">
                <i class="bi bi-list"></i>
            </div>
            

            <div class="d-flex gap-4">
                <!-- <button type="button" onclick="notificationwindow()" class="btn position-relative">
                    <i class='bx bx-bell' ></i>
                    <span class="position-absolute translate-middle rounded-circle admin-badge">
                      <span class="visually-hidden">New alerts</span>
                    </span>
                  </button> -->

                    <button type="button" onclick="notificationwindow()" class="btn position-relative">
                        <i class='bx bx-bell' ></i>
                        <span id="adminnotifbody">
                        </span>
                    </button>

                    <div class="d-flex align-items-center gap-2">
                        <img src="../imgs/admin/admin1.png" alt="" style="width:32px">
                        <p class="admin-name d-md-block d-none">Admin G5</p>
                    </div>

            </div>
        </nav>

        <!-- DASHBOARD -->
        <div class="admin-container p-5">
            <div class="d-flex">
                <h1 class="admin-page-h1">Renter's Information</h1>
            </div>

            <div class="row mt-5">
                <!-- renter's profile -->
                <div class="col-lg-2 col-12">
                    <div class="mt-1 ps-4">
                        <img src="../imgs/defaultProfile/m.png" alt="" class="info-profile1">
                    </div>
                </div>
                <div class="col-lg-10 col-12">
                    <!-- renter info -->
                    <div class="mt-3 ps-2">
                        <h6 class="mb-1">Last Name: <span><b> <?php echo $row_renter['rLname'] ?> </b></span> </h6>
                        <h6 class="mb-1">First Name: <span><b> <?php echo $row_renter['rFname'] ?> </b></span> </h6>
                        <h6 class="mb-1">Mobile No: <span><b> <?php echo $row_renter['rNum'] ?> </b></span> </h6>
                        <h6 class="mb-1">Birthdate: <span><b> <?php echo $formatted_date ?></b></span> </h6>
                        <h6 class="mb-1">Occupation: <span><b> <?php echo $row_renter['rOccupation'] ?> </b></span> </h6>
                    </div>

                    <!-- Warnings -->
                    <?php
                    $selectwarningcount = "SELECT * FROM warning_data WHERE renter_id='".$row_renter['rId']."'";
                    $executewarningcount = mysqli_query($con, $selectwarningcount);
                    $row_warning = mysqli_fetch_all($executewarningcount, MYSQLI_ASSOC);
                    if(count($row_warning) > 0){
                    ?>
                    <div class="my-5 ps-2">
                        <h3 class="mb-5 warning-txt">Warnings - <span><?php echo count($row_warning) ?></span></h3>
                        <div class="warning-content">
                        <?php
                            for($i = 0; $i < count($row_warning); $i++){
                            ?>
                            <p><b> Date received: </b> <span class="warning-date"><?php echo $row_warning[$i]['report_date'] ?></span> </p>
                            <p><b>From: </b> <span class="warning-from"><?php echo $row_warning[$i]['reporter_id'] ?></span> </p>
                            <p><b>Description: </b> <span class="warning-desc"><?php echo $row_warning[$i]['report_reason'] ?></span></p>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="d-flex mt-5 pt-5 ps-2">
                    <a href="adminRenters.php" class="text-secondary btn-back"> 
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
    </section>



    <script src="../JavaScripts/functionAdmin.js"></script>
    <script>
        setInterval(function() {
            $.ajax({
                url: "../Functions/Admin/realtimeAdminNotif.php",
                method: "POST",
                success: function(data) {
                    $("#adminnotifbody").html(data);
                }
            });
        }, 10);
    </script>
</body>
</html>
<?php
}
else{
    echo "<script>window.history.back();</script>";
}
    }
    else{
        echo "<script>window.history.back();</script>";
    }
    ?>