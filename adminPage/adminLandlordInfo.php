<?php
include ('../DataBase/connection.php');
session_start();

if(isset($_SESSION['useradmin'])){

    if(isset($_GET['id']) && $_GET['id'] != ""){
        $selectlandlord = "SELECT * FROM user_landlord WHERE lID='".$_GET['id']."'";
        $executelandlord = mysqli_query($con, $selectlandlord);
        $row_landlord = mysqli_fetch_assoc($executelandlord);

        $date = $row_landlord['lBdate'];
        $datedbformat = new DateTime($date);
        $formatted_date = $datedbformat->format('F d, Y');
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
                <div class="item-box active-item-box d-flex align-items-center gap-4">
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
                <h1 class="admin-page-h1">Landlord's Information</h1>
            </div>

            <div class="row mt-5">
                <!-- landlord's profile -->
                <div class="col-lg-2 col-12">
                    <div class="mt-1 ps-4">
                        <img src="../imgs/defaultProfile/m.png" alt="" class="info-profile1">
                    </div>
                </div>

                <div class="col-lg-10 col-12">
                        <!-- landlord info -->
                        <div class="mt-3">
                            <h6 class="mb-1">Last Name: <span><b> <?php echo $row_landlord['lLname'] ?> </b></span> </h6>
                            <h6 class="mb-1">First Name: <span><b> <?php echo $row_landlord['lFname'] ?> </b></span> </h6>
                            <h6 class="mb-1">Mobile No: <span><b> <?php echo $row_landlord['lNumber'] ?> </b></span> </h6>
                            <h6 class="mb-1">Birthdate: <span><b> <?php echo $formatted_date ?> </b></span> </h6>
                            <h6 class="mb-1">Address: <span><b> <?php echo $row_landlord['lHouseNo'] . " " . $row_landlord['lBrgy'] . ", " . $row_landlord['lCity'] . ", " . $row_landlord['lProvince']?> </b></span> </h6>
                        </div>
                    </div>
                </div>

                <!-- Complaints -->
                <?php
                $selectcomplaintscount = "SELECT * FROM complaints_data WHERE landlord_id='".$row_landlord['lID']."'";
                $executecomplaintscount = mysqli_query($con, $selectcomplaintscount);
                $row_complaints = mysqli_fetch_all($executecomplaintscount, MYSQLI_ASSOC);
                if(count($row_complaints) > 0){
                ?>
                <div class="my-5 ps-2">
                    <h3 class="mb-5 warning-txt">Complaints - <span><?php echo $complaints_count ?></span></h3>
                    <div class="complaint-content">
                        <?php
                        for($i = 0; $i < count($row_complaints); $i++){
                            $complaindate = $row_complaints[$i]['report_date'];
                            $complaindatedbformat = new DateTime($complaindate);
                            $complainformatted_date = $complaindatedbformat->format('m-d-Y');
                        ?>
                            <p><b> Date received: </b> <span class="complaint-date"><?php echo $complainformatted_date ?></span> </p>
                            <p><b>From: </b> <span class="complaint-from"><?php echo $row_complaints[$i]['reporter_id'] ?></span> </p>
                            <p><b>Description: </b> <span class="complaint-desc"><?php echo $row_complaints[$i]['report_reason'] ?></span></p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                }
                ?>

            <div class="d-flex mt-5 pt-5 ps-2">
                <a href="adminLandlords.php" class="text-secondary btn-back"> 
                    <i class="bi bi-arrow-left"></i> Back
                </a>
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