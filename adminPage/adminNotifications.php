<?php
include('../DataBase/connection.php');
session_start();

if(isset($_SESSION['useradmin'])){
    $selectadminnotif = "SELECT * FROM admin_notification WHERE notif_status='unread' ORDER BY date_notif DESC";
    $executeadminnotif = mysqli_query($con, $selectadminnotif);
    $row_adminnotif = mysqli_fetch_all($executeadminnotif, MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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

<!-- MAIN ````````` -->
    <div class="admin-sidebar position-fixed top-0">
        <div class="admin-logo-div d-flex gap-4 align-items-center ">
            <!-- <img src="../imgs/a .png" alt="" style="height: 27px;" class="img-a"> -->
            <img src="../imgs/key.png" alt="" style="height:25px;" class="key-logo">
            <img src="../imgs/logo.png" alt="" style="height:80px;" class="admin-logo">
        </div>
        <div class="items-container d-flex flex-column justify-content-center ">    
            <a href="adminDashboard.php" class="item">
                <div class="item-box d-flex align-items-center gap-4">
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

    <section class="home-section ">
        <nav class="ps-3 pe-md-5 pe-sm-3 pe-3 py-3 d-flex align-items-center justify-content-between ">
            <div class="sidebar-btn ">
                <i class="bi bi-list"></i>
            </div>

            
            <div class="d-flex gap-5">
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
                        <p class="admin-name d-md-block d-none d-md-block d-sm-none d-none">Admin G5</p>
                    </div>

            </div>
        </nav>

        <!-- DASHBOARD -->
        <div class="admin-container d-flex flex-column justify-content-center align-items-center  p-3" id="divNotifBody">
            <h1 class="admin-page-h1 text-center">Notifications</h1>
            <div class="notif-container mt-5">

            <?php
            for($i = 0; $i<count($row_adminnotif); $i++){

                if($row_adminnotif[$i]['notif_info'] == "Landlord-Register"){
                    $selectlandlord = "SELECT * FROM user_landlord WHERE lID='".$row_adminnotif[$i]['landlord_id']."'";
                    $executelandlord = mysqli_query($con, $selectlandlord);
                    $row_landlord = mysqli_fetch_assoc($executelandlord);
                ?>
                <!-- 1 notif landlord verification-->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="adminVerifyId.php?id=<?php echo $row_adminnotif[$i]['landlord_id'] ?>&notifid=<?php echo $row_adminnotif[$i]['id']?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/admin/landlord.png" class="landlord-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  Landlord, <b><?php echo $row_landlord['lFname'] . " " . $row_landlord['lLname'] ?></b> had registered. Please verify his/her identity so that he/she can already list a property.</div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout" value="<?php echo $row_adminnotif[$i]['id']?>" onclick="removeNotification(this.value)"></button>
                    </div>
                </div>
                <?php
                }
                else if($row_adminnotif[$i]['notif_info'] == "List-Property"){
                    $selectlandlord = "SELECT * FROM user_landlord WHERE lID='".$row_adminnotif[$i]['landlord_id']."'";
                    $executelandlord = mysqli_query($con, $selectlandlord);
                    $row_landlord = mysqli_fetch_assoc($executelandlord);
                ?>
                <!-- 1 notif property verification -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="../viewProperty.php?id=<?php echo $row_adminnotif[$i]['property_id'] ?>&notifid=<?php echo $row_adminnotif[$i]['id']?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/admin/properties.png" class="notif-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  Landlord, <b><?php echo $row_landlord['lFname'] . " " . $row_landlord['lLname'] ?></b>, had listed a property. Please review and approve to display it in the website. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout" value="<?php echo $row_adminnotif[$i]['id']?>" onclick="removeNotification(this.value)"></button>
                    </div>
                </div>
                <?php
                }
                else if($row_adminnotif[$i]['notif_info'] == "Renter-Register"){
                    $selectrenter = "SELECT * FROM user_renter WHERE rId='".$row_adminnotif[$i]['renter_id']."'";
                    $executerenter = mysqli_query($con, $selectrenter);
                    $row_renter = mysqli_fetch_assoc($executerenter);
                ?>
                <!-- 1 notif renter-->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="adminRenterInfo.php?id=<?php echo $row_adminnotif[$i]['renter_id'] ?>&notifid=<?php echo $row_adminnotif[$i]['id']?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/admin/renters.png" class="landlord-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  A new renter, <b><?php echo $row_renter['rFname'] . " " . $row_renter['rLname'] ?></b>, has recently completed their registration.</div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])); ?></div>
                                </div>
                            </div> 
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout" value="<?php echo $row_adminnotif[$i]['id']?>" onclick="removeNotification(this.value)"></button>
                    </div>
                </div>
                <?php
                }
                else if($row_adminnotif[$i]['notif_info'] == "Application"){
                ?>
                <!-- 1 notif applications-->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="adminApplications.php?notifid=<?php echo $row_adminnotif[$i]['id']?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/admin/applicants.png" class="landlord-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  A renter had applied in one of the properties. View status.</div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout" value="<?php echo $row_adminnotif[$i]['id']?>" onclick="removeNotification(this.value)"></button>
                    </div>
                </div>
                <?php
                }
                else if($row_adminnotif[$i]['notif_info'] == "Lease"){
                    ?>
                <!-- 1 notif leases-->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="adminLeases.php?notifid=<?php echo $row_adminnotif[$i]['id']?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/admin/leases.png" class="lease-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  A lease & advance payment agreement was settled. View now. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout" value="<?php echo $row_adminnotif[$i]['id']?>" onclick="removeNotification(this.value)"></button>
                    </div>
                </div>
                <?php
                }
                else if($row_adminnotif[$i]['notif_info'] == "Complaints"){
                    ?>
                <!-- 1 notif complaint-->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/admin/report.png" class="warning-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  A renter had sent complaint to a landlord. Take Action. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout" value="<?php echo $row_adminnotif[$i]['id']?>" onclick="removeNotification(this.value)"></button>
                    </div>
                </div>
                <?php
                }
                else if($row_adminnotif[$i]['notif_info'] == "Warnings"){
                    ?>
                <!-- 1 notif warning-->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/admin/report.png" class="warning-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3"> A landlord had sent warning to a renter. Take Action. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_adminnotif[$i]['date_notif'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-logout" value="<?php echo $row_adminnotif[$i]['id']?>" onclick="removeNotification(this.value)"></button>
                    </div>
                </div>
                <?php
                }
            }
            ?>
                </div>
            </div><!-- end of dashboard-container div -->
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
?>