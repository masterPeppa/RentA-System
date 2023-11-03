<?php
include ('../DataBase/connection.php');
session_start();

if(isset($_SESSION['useradmin'])){

    if(isset($_GET['id']) && $_GET['id'] != ""){
        $selectlease = "SELECT * FROM lease WHERE id='".$_GET['id']."'";
        $executelease = mysqli_query($con, $selectlease);
        $row_lease = mysqli_fetch_assoc($executelease);

        $selectrenter = "SELECT * FROM user_renter WHERE rId='".$row_lease['renter_id']."'";
        $executerenter = mysqli_query($con, $selectrenter);
        $row_renter = mysqli_fetch_assoc($executerenter);

        $selectlandlord = "SELECT * FROM user_landlord WHERE lID='".$row_lease['landlord_id']."'";
        $executelandlord = mysqli_query($con, $selectlandlord);
        $row_landlord = mysqli_fetch_assoc($executelandlord);

        $selectreceipt = "SELECT * FROM receipt WHERE property_id='".$row_lease['property_id']."' AND landlord_id='".$row_lease['landlord_id']."' AND renter_id='".$row_lease['renter_id']."'";
        $executereceipt = mysqli_query($con, $selectreceipt);
        $row_receipt = mysqli_fetch_assoc($executereceipt);

        
        $imglease = str_replace("../", "", $row_lease['img_lease']);
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
                <div class="item-box d-flex align-items-center gap-4">
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
                <div class="item-box active-item-box d-flex align-items-center gap-4">
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
        <div class="admin-container p-md-5 p-3">
            <div class="d-flex">
                <h1 class="admin-page-h1">Lease</h1>
            </div>

            <!-- landlord info -->
            <div class="mt-3 ps-2">
                <h6 class="mb-1">Renter: <span><b> <?php echo $row_renter['rLname'].", ".$row_renter['rFname'] ?> </b></span> </h6>
                <h6 class="mb-1">Landlord: <span><b> <?php echo $row_landlord['lLname'].", ".$row_landlord['lFname'] ?> </b></span> </h6>
                <h6 class="mb-1">Lease start: <span><b> 01/23/2023 </b></span> </h6>
                <h6 class="mb-1">Lease end: <span><b> 01/24/2023 </b></span> </h6>
            </div>

            <div class="row mt-3">
                <div class="col-xxl-4 col-12 mt-3 d-flex justify-content-center ">
                    <img src="../<?php echo $imglease ?>" alt="" class="verification-imgs admin-lease">
                </div>
                <?php
                if($row_lease['advance_amount'] != NULL){
                    $imgadvance = str_replace("../", "", $row_receipt['img_advance']);
                    ?>
                <div class="col-xxl-4 col-xl-6 col-lg-6 col-12 mt-3 d-flex flex-column justify-content-center align-items-center ">
                    <img src="../<?php echo $imgadvance ?>" alt="" class="verification-imgs admin-receipt">
                    <p class="mt-1">Advance Rental</p>
                    <p> <span class="month-advance"><?php echo $row_lease['advance_period'] ?></span> advance - <b>  ₱  <span class="advance-amount"><?php echo $row_lease['advance_amount'] ?> </b></span></p>
                </div>
                <?php
                }
                if($row_lease['deposit_amount'] != NULL){
                    $imgdeposit = str_replace("../", "", $row_receipt['img_deposit']);
                    ?>
                    <div class="col-xxl-3 col-xl-6 col-lg-6 col-12 mt-3 d-flex flex-column justify-content-center align-items-center">
                        <img src="../<?php echo $imgdeposit ?>" alt="" class="verification-imgs admin-receipt">
                        <p class="mt-1">Security Deposit</p>
                        <p><b>₱ <span class="sec-deposit-amount"><?php echo $row_lease['deposit_amount'] ?></span></b></p>
                    </div>
                    <?php
                }
                ?>
            </div>
            

            <div class="p-3">
                <div class="d-flex mt-5 ps-2">
                    <a href="adminLeases.php" class="text-secondary btn-back"> 
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