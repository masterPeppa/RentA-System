<?php
include ('../DataBase/connection.php');
session_start();

if(isset($_SESSION['useradmin'])){

    $selectrenter = "SELECT * FROM user_renter";
    $executerenter = mysqli_query($con, $selectrenter);
    $row_renter = mysqli_fetch_all($executerenter, MYSQLI_ASSOC);
    $active = 0;
    $blocked = 0;
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

    <!-- MODAL BAN -->
    <div class="modal fade" id="banRenterModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalBlockLandlord">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <section class="">
                        
                        <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                            <img src="../imgs/question.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2 modal-txt"> This user will not be able to rent a property. Are you sure you want to <br> <b> ban this renter </b>?</h5>
                            <textarea name="" id="txtReason" class="txtarea-reason p-3 mt-2 w-100 " id="" cols="" rows="" placeholder="What's your reason for banning him/her?"></textarea>
                        </div>

                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn admin-btns btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">No</button>
                    <a onclick="confirmblockedrenter()" class="btn admin-btns btn-del modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Yes</a>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - BAN --> 



    <!-- MAIN ``````````` -->
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
                <div class="item-box active-item-box d-flex align-items-center gap-4">
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
                <!-- <button type="button"onclick="notificationwindow()" class="btn position-relative">
                    <i class='bx bx-bell' ></i>
                    <span class="position-absolute translate-middle rounded-circle admin-badge">
                      <span class="visually-hidden">New alerts</span>
                    </span>
                  </button> -->

                    <button type="button"onclick="notificationwindow()" class="btn position-relative">
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
        <div class="admin-container p-3">
            <div class="d-flex justify-content-center ">
                <h1 class="admin-page-h1">Renters</h1>
            </div>

            <!-- TABLE -->
            <div class="admin-table p-md-5 p-1">

                <!-- RENTERS TABLE -->
                <div class="mt-5">
                    <!-- <h4 class="subtitles"><b> Listed Properties </b></h4> -->
                    <!-- <h4 class="mt-3 subtitles"><b> </b></h4> -->
                    <table role="table" class="table-admin mt-3">
                        <!-- HEADER -->
                        <thead role="rowgroup" class="headers">
                            <tr role="row" class="headers">
                                <th role="columnheader" class="py-3 pe-5 ps-xl-3">ID No.</th>
                                <th role="columnheader" class="py-3 pe-3">Name</th>
                                <th role="columnheader" class="py-3 pe-5">Email</th>
                                <th role="columnheader" class="py-3 pe-5">Mobile No.</th>
                                <th role="columnheader" class="py-3 pe-3">Date registered</th>
                                <th role="columnheader" class="py-3 pe-3">Warnings</th>
                                <th role="columnheader" class="py-3 pe-3">Actions</th>
                            </tr>
                        </thead>
                
                        <!-- DATA -->
                        <tbody role="rowgroup">
                        <?php
                            for($i = 0; $i < count($row_renter); $i++){
                                if($row_renter[$i]['rStatus'] != "blocked"){
                                $active =+ 1;
                                $selectwarningcount = "SELECT * FROM warning_data WHERE renter_id='".$row_renter[$i]['rId']."'";
                                $executewarningcount = mysqli_query($con, $selectwarningcount);
                                $warning_count = mysqli_num_rows($executewarningcount);

                                $date = $row_renter[$i]['date_registered'];
                                $datedbformat = new DateTime($date);
                                $date = $datedbformat->format('m/d/Y H:i');
                        ?>
                            <tr role="row" class="admin-table-row" >
                            <!-- STATUSES -->
                                <td role="cell" class="py-3 pe-2 ps-xl-3 admin-renters"> <b><?php echo $row_renter[$i]['rId'] ?></b>  </td>
                                <td role="cell" class="py-3 pe-2 admin-renters"> <?php echo $row_renter[$i]['rLname']. ", " .$row_renter[$i]['rFname']  ?> </td>
                                <td role="cell" class="py-3 pe-2 admin-renters"> <?php echo $row_renter[$i]['rEmail'] ?> </td>
                                <td role="cell" class="py-3 pe-3 admin-renters"> <?php echo $row_renter[$i]['rNum'] ?> </td>
                                <td role="cell" class="py-3 pe-3 admin-renters"> <?php echo $date ?> </td>
                                <td role="cell" class="py-3 pe-3 admin-renters"> <?php echo $warning_count ?> </td>
                                <td role="cell" class="py-3 admin-renters"> 
                                    <div class="d-flex gap-2">
                                        <a href="adminRenterInfo.php?id=<?php echo $row_renter[$i]['rId'] ?>" role="button" class="btn action-button action-purple d-flex align-items-center justify-content-center ">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a onclick="getrenterblockedid()" id="<?php echo $row_renter[$i]['rId'] ?>" role="button" title="Ban" class="blockedid btn action-button action-red d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#banRenterModal">
                                            <i class="bi bi-ban"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                                ?>
                        </tbody>
                        <div class="d-none">
                            <input type="text" id="txtrenterid">
                        </div>
                    </table>

                    <!-- nothing yet -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php
                        if($active == 0){
                            ?>
                            <p class="no-data yet">-- There's no registered renters yet. --</p>
                            <?php
                        }
                            ?>
                    </div>
                </div>

                <!-- BANNED RENTERS TABLE -->
                <div class="mt-5">
                    <h4 class="mt-3 subtitles"><b> Banned </b></h4>
                    <table role="table" class="table-admin mt-3">
                        <!-- HEADER -->
                        <thead role="rowgroup" class="headers">
                            <tr role="row" class="headers">
                                <th role="columnheader" class="py-3 pe-5 ps-xl-3">ID No.</th>
                                <th role="columnheader" class="py-3 pe-3">Name</th>
                                <th role="columnheader" class="py-3 pe-5">Email</th>
                                <th role="columnheader" class="py-3 pe-3">Ban reason</th>
                                <th role="columnheader" class="py-3 pe-3">Date banned</th>
                                <th role="columnheader" class="py-3 pe-3">Actions</th>
                            </tr>
                        </thead>
                
                        <!-- DATA -->
                        <tbody role="rowgroup">
                        <?php
                            for($i = 0; $i < count($row_renter); $i++){
                                if($row_renter[$i]['rStatus'] == "blocked"){
                                $blocked =+ 1;
                                $selectwarningcount = "SELECT * FROM warning_data WHERE renter_id='".$row_renter[$i]['rId']."'";
                                $executewarningcount = mysqli_query($con, $selectwarningcount);
                                $warning_count = mysqli_num_rows($executewarningcount);

                                $date = $row_renter[$i]['date_blocked'];
                                $datedbformat = new DateTime($date);
                                $date = $datedbformat->format('m/d/Y');
                        ?>
                            <tr role="row" class="admin-table-row" >
                            <!-- STATUSES -->
                                <td role="cell" class="py-3 pe-2 ps-xl-3 admin-renters"> <b><?php echo $row_renter[$i]['rId'] ?></b>  </td>
                                <td role="cell" class="py-3 pe-2 admin-renters"> <?php echo $row_renter[$i]['rLname']. ", " .$row_renter[$i]['rFname']  ?> </td>
                                <td role="cell" class="py-3 pe-2 admin-renters"> <?php echo $row_renter[$i]['rEmail'] ?> </td>
                                <td role="cell" class="py-3 pe-3 admin-renters"> <?php echo $row_renter[$i]['blocked_reason'] ?> </td>
                                <td role="cell" class="py-3 pe-3 admin-renters"> <?php echo $date ?> </td>
                                <td role="cell" class="py-3 pe-3 admin-renters"> 
                                    <a href="adminRenterInfo.php?id=<?php echo $row_renter[$i]['rId'] ?>" role="button" class="btn action-button action-purple d-flex align-items-center justify-content-center ">
                                        <i class="bi bi-eye-fill"></i>
                                    </a> 
                                </td>
                                

                            </tr>
                            <?php
                            }
                        }
                                ?>
                        </tbody>
                        <div class="d-none">
                            <input type="text" id="txtrenterid">
                        </div>
                    </table>
                    <!-- nothing yet -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php
                        if($blocked == 0){
                            ?>
                            <p class="no-data yet">-- There's no banned renters yet. --</p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
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
    ?>