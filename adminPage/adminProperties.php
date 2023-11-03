<?php
include ('../DataBase/connection.php');
session_start();

if(isset($_SESSION['useradmin'])){

    $selectproperties = "SELECT * FROM landing_properties";
    $executeproperties = mysqli_query($con, $selectproperties);
    $row_properties = mysqli_fetch_all($executeproperties, MYSQLI_ASSOC);

    $visited = 0;
    $notyetvisited = 0;
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

    <!-- MODAL APPROVE PROPERTY -->
    <div class="modal fade" id="approvePropertyModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalApproveProperty">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <section class="">
                        
                        <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                            <img src="../imgs/question-purple.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2 modal-txt">This property <b>will be listed in the page </b>. Are you sure you had already visited the property created and want to approve it?</h5>
                        </div>

                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn admin-btns btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">No</button>
                    <a onclick="approveProperty()" class="btn admin-btns action-purple modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Yes</a>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end - APPROVE PROPERTY  --> 

    <!-- MODAL DISAPPROVE PROPERTY -->
    <div class="modal fade" id="disapprovePropertyModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalDisapproveProperty">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <section class="">
                        
                        <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                            <img src="../imgs/question.png" alt="Log Out" class="img-logout">
                            <h5 class="text-center mt-2 modal-txt">This property <b> will not be listed </b>. Are you sure you want to disapprove this property? </h5>
                        </div>

                    </section>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn admin-btns btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">No</button>
                    <a onclick="disapprovedProperty()" class="btn admin-btns btn-del modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Yes</a>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end - DISAPPROVE PROPERTY  --> 

    <!-- MODAL DELETE PROPERTY -->
    <div class="modal fade" id="deletePropertyModal" tabindex="-1" aria-labelledby="reasonModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content modals container_modalDisapproveProperty">

                <div class="modal-header modal-header-logout p-3">
                    <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="d-flex flex-column align-items-center justify-content-center px-md-5 px-3">
                        <img src="../imgs/question.png" alt="Log Out" class="img-logout">
                        <h5 class="text-center mt-2 modal-txt">This property will not appear on the page. Are you sure you want to <b> delete this property? </b> </h5>
                    </div>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn admin-btns btn-cancel modal-btns px-4 py-2" data-bs-dismiss="modal">No</button>
                    <a onclick="forcedeleteProperty()" class="btn admin-btns btn-del modal-btns px-4 py-2 d-flex align-items-center justify-content-center">Yes</a>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end - APPROVE PROPERTY  --> 








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
                <div class="item-box active-item-box d-flex align-items-center gap-4">
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
                        <p class="admin-name d-md-block d-none">Admin G5</p>
                    </div>

            </div>
        </nav>

        <!-- DASHBOARD -->
        <div class="admin-container p-3">
            <div class="d-flex justify-content-center ">
                <h1 class="admin-page-h1">Properties</h1>
            </div>

            
            <!-- TABLE -->
            <div class="admin-table p-md-5 p-1">

                <!-- FOR VERIFICATION TABLE -->
                <div>
                    <h4 class="subtitles mt-3"><b> For ocular visit </b></h4>
                    <table role="table" class="table-admin mt-3">
                        <!-- HEADER -->
                        <thead role="rowgroup" class="headers">
                            <tr role="row" class="headers">
                                <th role="columnheader" class="py-3 pe-3 ps-xl-3">No.</th>
                                <th role="columnheader" class="py-3 pe-5">Property title</th>
                                <th role="columnheader" class="py-3 pe-5">Property type</th>
                                <th role="columnheader" class="py-3 pe-3">Landlord ID</th>
                                <th role="columnheader" class="py-3 pe-5">Date created</th>
                                <th role="columnheader" class="py-3 pe-3">Actions</th>
                            </tr>
                        </thead>
                        
                        <!-- DATA -->
                        <tbody role="rowgroup">
                        <?php
                        $num = 1;
                            for($i = 0; $i < count($row_properties); $i++){
                                if($row_properties[$i]['occular_visit_status'] == "not_yet"){
                                    $notyetvisited =+ 1;
                                    $date = $row_properties[$i]['createdTime'];
                                    $datedbformat = new DateTime($date);
                                    $date = $datedbformat->format('m/d/Y H:i');
                        ?>
                            <tr role="row" class="admin-table-row">
                                <td role="cell" class="py-3 pe-2 admin-tovisit ps-xl-3"> <b> <?php echo $num ?> </b> </td>
                                <td role="cell" class="py-3 pe-2 admin-tovisit"> <?php echo $row_properties[$i]['propertyTitle'] ?> </td>
                                <td role="cell" class="py-3 pe-2 admin-tovisit"> <?php echo $row_properties[$i]['propertyType'] ?> </td>
                                <td role="cell" class="py-3 pe-3 admin-tovisit"> <?php echo $row_properties[$i]['landlord_id'] ?> </td>
                                <td role="cell" class="py-3 pe-2 admin-tovisit"> <?php echo $date ?></td>
                                <td role="cell" class="py-3 admin-tovisit"> 
                                    <div class="d-flex gap-2">
                                        <a href="../viewProperty.php?id=<?php echo $row_properties[$i]['propertyID'] ?>" role="button" title="View" class="btn action-button action-purple d-flex align-items-center justify-content-center ">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a onclick="getapprovepropertyid()" id="<?php echo $row_properties[$i]['propertyID'] ?>" role="button" title="Approve" class="propertyIdvalue btn action-button action-green d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#approvePropertyModal">
                                            <i class="bi bi-check-lg"></i>
                                        </a>
                                        <a onclick="getdisapprovedpropertyid()" role="button" id="<?php echo $row_properties[$i]['propertyID'] ?>" title="Disapprove" class="propertydisapproveIdvalue btn action-button action-red d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#disapprovePropertyModal">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $num++;
                                }
                            }
                                ?>
                        </tbody>
                        <div class="d-none">
                            <input type="text" id="propertyidvalue">
                        </div>
                    </table>
                    
                    <!-- nothing yet -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php
                        if($notyetvisited == 0){
                            ?>
                            <p class="no-data yet">-- No properties waiting for approval. --</p>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <!-- VERIFIED PROPERTIES TABLE -->
                <div class="mt-5">
                    <h4 class="subtitles"><b> Listed Properties </b></h4>
                    <table role="table" class="table-admin mt-3">
                        <!-- HEADER -->
                        <thead role="rowgroup" class="headers">
                            <tr role="row" class="headers">
                                <th role="columnheader" class="py-3 pe-5 ps-xl-3">Status</th>
                                <th role="columnheader" class="py-3 pe-3 ">Property ID</th>
                                <th role="columnheader" class="py-3 pe-5">Property type</th>
                                <th role="columnheader" class="py-3 pe-5">Property title</th>
                                <th role="columnheader" class="py-3 pe-3">Landlord ID</th>
                                <th role="columnheader" class="py-3 pe-3">Date listed</th>
                                <th role="columnheader" class="py-3 pe-3">Actions</th>
                            </tr>
                        </thead>
                
                        <!-- DATA -->
                        <tbody role="rowgroup">
                            <?php
                        for($i = 0; $i < count($row_properties); $i++){
                                if($row_properties[$i]['occular_visit_status'] == "visited"){
                                    $visited =+ 1;
                                    $date = $row_properties[$i]['createdTime'];
                                    $datedbformat = new DateTime($date);
                                    $date = $datedbformat->format('m/d/Y H:i');
                        ?>
                            <tr role="row" class="admin-table-row" >
                            <!-- STATUSES -->
                                <td role="cell" class="py-3 pe-2 ps-xl-3 admin-listed-prop"> 

                                <?php
                                if($row_properties[$i]['renting_status'] == "moving-in"){
                                    ?>

                                    <div class="status-processing">
                                        <span class='status-purple'>
                                            <!-- <i class='bi bi-circle-fill pe-1'></i> -->
                                        </span>
                                        <span class='status-purple'>In a deal</span>
                                    </div>
                                    <?php
                                }
                                else if($row_properties[$i]['renting_status'] == "residing"){
                                    ?>
                                    <div class="status-rented">
                                        <span class='status-done'>
                                            <!-- <i class='bi bi-circle-fill pe-1'></i> -->
                                        </span>
                                        <span class='status-done'>Rented</span>
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <div class="status-available">
                                        <span class='status-green'>
                                            <!-- <i class='bi bi-circle-fill pe-1'></i> -->
                                        </span>
                                        <span class='status-green'>Available</span>
                                    </div>
                                    <?php
                                }
                                ?>
                                </td>
                                <td role="cell" class="py-3 pe-2 admin-listed-prop"> <b><?php echo $row_properties[$i]['propertyID'] ?></b>  </td>
                                <td role="cell" class="py-3 pe-2 admin-listed-prop"> <?php echo $row_properties[$i]['propertyType'] ?> </td>
                                <td role="cell" class="py-3 pe-2 admin-listed-prop"> <?php echo $row_properties[$i]['propertyTitle'] ?> </td>
                                <td role="cell" class="py-3 pe-3 admin-listed-prop"> <?php echo $row_properties[$i]['landlord_id'] ?> </td>
                                <td role="cell" class="py-3 pe-2 admin-listed-prop"> <?php echo $date ?> </td>
                                <td role="cell" class="py-3 admin-listed-prop"> 
                                    <div class="d-flex gap-2">
                                        <a href="../viewProperty.php?id=<?php echo $row_properties[$i]['propertyID'] ?>" role="button" title="View" class="btn action-button action-purple d-flex align-items-center justify-content-center ">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <button onclick="getdeletepropertyid()" id="<?php echo $row_properties[$i]['propertyID'] ?>" class="deletepropertyid action-button action-red" title="Delete" data-bs-toggle="modal" data-bs-target="#deletePropertyModal">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                                ?>
                        </tbody>
                        <div class="d-none">
                            <input type="text" id="propertyidtodelete">
                        </div>
                    </table>

                    <!-- nothing yet -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php
                        if($visited == 0){
                            ?>
                            <p class="no-data yet">-- No properties approved yet. --</p>
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