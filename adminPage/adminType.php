<?php
include ('../DataBase/connection.php');
session_start();

if(isset($_SESSION['useradmin'])){

    $selectpropertyType = "SELECT * FROM property_types";
    $executepropertyType = mysqli_query($con, $selectpropertyType);
    $row_propertyType = mysqli_fetch_all($executepropertyType, MYSQLI_ASSOC);
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
                            <h5 class="text-center mt-2 modal-txt"> Are you sure you want to delete this type of property</b>?</h5>
                        </div>

                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn admin-btns btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">No</button>
                    <a onclick="confirmDelete()" class="btn admin-btns btn-del modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Yes</a>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - BAN --> 

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

    <!-- MODAL ADD PROPERTY TYPE -->
    <div class="modal fade" id="addType" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalAddType">

                <div class="modal-body mt-3">
                        <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                            <h5 class="text-center mt-2 modal-txt"> <b>Add a property type</b> </h5>
                            <div class="mt-5 mb-3">
                                <label for="input-prop-type" class="form-label">Property type</label>
                                <input type="email" class="form-control p-2 input-prop-type mt-2" id="input-prop-type">
                            </div>
                        </div>
                </div>

                <div class="modal-footer d-flex justify-content-center py-3">
                    <a onclick="addType()" class="btn admin-btns btn-go modal-btns px-5 py-2 d-flex align-items-center justify-content-center">Add</a>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - ADD PROPERTY TYPE --> 

    <!-- MAIN `````````` -->
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
                <div class="item-box active-item-box d-flex align-items-center gap-4">
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
                <h1 class="admin-page-h1">Property Type</h1>
            </div>

            <!-- TABLE -->
            <div class="admin-table py-md-1 px-md-5 p-1">

                <!-- RENTERS TABLE -->
                <div class="mt-5">
                    <!-- <h4 class="subtitles"><b> Listed Properties </b></h4> -->
                    <table role="table" class="table-admin mt-3">
                        <!-- HEADER -->
                        <thead role="rowgroup" class="headers">
                            <tr role="row" class="headers">
                                <th role="columnheader" class="py-3 pe-5 ps-xl-3">No.</th>
                                <th role="columnheader" class="py-3 pe-3">Property type</th>
                                <th role="columnheader" class="py-3 pe-5">Actions</th>
                            </tr>
                        </thead>
                

                        <!-- DATA -->
                        <tbody role="rowgroup">
                        <?php
                        for($i = 0; $i < count($row_propertyType); $i++){
                            ?>
                            <tr role="row" class="admin-table-row" >
                                <td role="cell" class="py-3 pe-2 ps-xl-3 admin-renters"> <b><?php echo $i+1 ?></b>  </td>
                                <td role="cell" class="py-3 pe-2 admin-renters"><?php echo $row_propertyType[$i]['property_type']; ?></td>
                                <td role="cell" class="py-3 admin-renters"> 
                                    <div class="d-flex gap-2">
                                        <a onclick="deleteType()" id="<?php echo $row_propertyType[$i]['id']; ?>" class="btnTypeDeleteId btn action-button action-red d-flex align-items-center justify-content-center" role="button" data-bs-toggle="modal" data-bs-target="#banRenterModal">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                            ?>
                            <div class="d-none">
                                <input type="text" id="deleteId">
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="btn-add-type pe-md-5 pe-sm-0 d-flex justify-content-end mt-3">
                <a href="" role="button" class="admin-btns btn-go px-4 py-3" data-bs-toggle="modal" data-bs-target="#addType"> 
                    <i class="bi bi-house-add"></i> Add property type
                </a>
            </div> <br>
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