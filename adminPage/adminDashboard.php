<?php
include('../DataBase/connection.php');
session_start();

if(isset($_SESSION['useradmin'])){
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
                <div class="item-box active-item-box  d-flex align-items-center gap-4">
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
        <div class="admin-container p-3">
            <div class="d-flex justify-content-center ">
                
            <h1 class="admin-page-h1">Dashboard</h1>
            </div>
            <div class="dashboard-container mt-3">
                <!-- <h1 class="m-3">Dashboard</h1> -->
                <!-- dashboard tiles-->
                <div class="admin-cards">
                    <a href="adminType.php">
                        <div class="admin-card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Property Type</h5>
                                <p class="card-number" id="typecountbody">0</p>
                                <img src="../imgs/admin/vector1.png"  id="vector1" class="card-img">
                            </div>
                        </div>
                    </a>
                    <a href="adminProperties.php">
                        <div class="admin-card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Properties</h5>
                                <p class="card-number" id="propertycountbody"></p>
                                <img src="../imgs/admin/vector2.png" id="vector2" class="card-img vector">
                            </div>
                        </div>
                    </a>
                    <a href="adminLandlords.php">
                        <div class="admin-card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Landlords</h5>
                                <p class="card-number" id="landlordcountbody">0</p>
                                <img src="../imgs/admin/vector4.png" id="vector4" class="card-img vector">
                            </div>
                        </div>
                    </a>
                    <a href="adminRenters.php">
                        <div class="admin-card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Renters</h5>
                                <p class="card-number" id="rentercountbody">0</p>
                                <img src="../imgs/admin/vector5.png" id="vector5" class="card-img vector">
                            </div>
                        </div>
                    </a>
                    <a href="adminApplications.php">
                        <div class="admin-card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Applications</h5>
                                <p class="card-number" id="applicationcountbody">0</p>
                                <img src="../imgs/admin/vector3.png" id="vector3" class="card-img vector">
                            </div>
                        </div>
                    </a>
                    <a href="adminLeases.php">
                        <div class="admin-card">
                            <div class="card-body p-5">
                                <h5 class="card-title">Leases</h5>
                                <p class="card-number" id="leasecountbody"></p>
                                <img src="../imgs/admin/vector6.png" id="vector6" class="card-img vector">
                            </div>
                        </div>
                    </a>
                </div><!-- end of admin-cards div -->
            </div><!-- end of dashboard-container div -->
        </div>
    </section>



    <script src="../JavaScripts/functionAdmin.js"></script>
    <script>
        setInterval(function(){
                $.ajax({
                    url:"../Functions/Admin/realtimeLandlordsCount.php",
                    method:"POST",
                    dataType:"text",
                    success:function(data)
                    {
                        $("#landlordcountbody").html(data);
                    }
                });
            }, 300);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Admin/realtimeRentersCount.php",
                    method:"POST",
                    dataType:"text",
                    success:function(data)
                    {
                        $("#rentercountbody").html(data);
                    }
                });
            }, 300);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Admin/realtimeapplicationCount.php",
                    method:"POST",
                    dataType:"text",
                    success:function(data)
                    {
                        $("#applicationcountbody").html(data);
                    }
                });
            }, 300);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Admin/realtimeleaseCount.php",
                    method:"POST",
                    dataType:"text",
                    success:function(data)
                    {
                        $("#leasecountbody").html(data);
                    }
                });
            }, 300);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Admin/realtimePropertyTypeCount.php",
                    method:"POST",
                    dataType:"text",
                    success:function(data)
                    {
                        $("#typecountbody").html(data);
                    }
                });
            }, 300);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Admin/realtimePropertiesCount.php",
                    method:"POST",
                    dataType:"text",
                    success:function(data)
                    {
                        $("#propertycountbody").html(data);
                    }
                });
            }, 300);
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