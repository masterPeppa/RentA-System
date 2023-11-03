<?php
    include ('../DataBase/connection.php');
    session_start();
    if(isset($_SESSION['lEmail'])){
    $landlordEmail = $_SESSION['lEmail'];
    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE publishing_status='Not yet' AND landlord_id='".$_SESSION['landlordId']."'");
    $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $lgetId = mysqli_fetch_assoc($executeSelectUser);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Notifications</title>
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

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
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
                        <h5 class="text-center mt-2 modal-txt"> Oops! You can't list a property yet since the landlord is still verifying your identity. We will notify you immediately when you are already verified.</h5>
                    </div>
                </div>

                <div class="modal-footer d-flex gap-2 p-3">
                    <button type="button" class="btn modal-logout-btns btn-del px-4 py-2" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<!-- modal end - NOT VERIFIED YET --> 

<!-- MODAL EXTEND -->
<div class="modal fade" id="extendContractModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modals modal-l-extend">

            <div class="modal-header modal-header-logout p-3">
                <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center mt-3 px-4">
                    <img src="../imgs/question-purple.png" alt="Log Out" class="img-logout">
                    <h5 class="text-center mt-1">Do you agree on renewing the contract to extend the renter's stay?</h5>
                    <textarea name="" id="txtReason1" class="txtarea-reason p-3 mt-2" id="" cols="" rows="" placeholder="If no, please state reason here..."></textarea>
                </div>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button onclick="sendrejectednewlease()" class="btn btn-cancel modal-logout-btns">No</button>
                <a onclick="sendacceptednewlease()" class="btn btn-confirm modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
              </div>
        </div>
    </div>
</div>
<!-- modal end - EXTEND -->

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
                            <a class="dropdown-item dropdown-item-first active-dropdown d-flex justify-content-between" href="landlordNotifications.php" id="smNotifCount"> Notification
                                 
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
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage Renters
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-manage" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="manageApplicants.php">Applicants</a></li>
                                <li><a class="dropdown-item" href="manageLeases.php">Leases</a></li>
                                <li><a class="dropdown-item" href="manageAdvancePayments.php">Advance Payments</a></li>
                                <li><a class="dropdown-item" href="manageResidents.php">Residents</a></li>
                                <li><a class="dropdown-item dropdown-item-last" href="manageResidentsRent.php">Residents' Rents</a></li>
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
                            <a class="nav-link" href="manageResidentsRent.php">Residents' Rents</a>
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
                                    <a class="dropdown-item dropdown-item-first active-dropdown d-flex justify-content-between" href="landlordNotifications.php" id="notifCount">
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

<!-- MODAL REJECT -->
<div class="modal fade" id="modalReject" tabindex="-1" aria-labelledby="modalReject" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content container_modalReject">

            <div class="modal-header modal-header-manage p-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body modal-body-reject">
                <section class="section_reject">
                    
                    <div class="div-manage d-flex flex-column align-items-center justify-content-center gap-2 mt-4">
                        <img src="../imgs/reject.png" alt="" class="img-warning">
                        <h4>Are you sure?</h4>
                        <p class="text-center">Renter, <span class="renter-name">Renter Name</span>
                            <br>
                            liked your property and wants to rent it.
                            <br>Are you sure you want to reject <br>his/her application?</p></p>
                    </div>
                </section>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button type="button" class="btn btn-cancel modal-btns" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-reject modal-btns">Reject</button>
              </div>
        </div>
    </div>
</div>
<!-- modal end - reject -->

<!-- MAIN -->
    <!-- NOTIFICATIONS -->
    <div class="landlord-container d-flex flex-column justify-content-center align-items-center  p-3" id="notifBody">
        <h1 class="l-page-h1">Notifications</h1>
        <div class="notif-container mt-3">
        <?php
        $selectlandlordnotif = "SELECT * FROM landlord_notification WHERE notif_status='unread' ORDER BY notif_date DESC";
        $executelandlordnotif = mysqli_query($con, $selectlandlordnotif);
        $row_landlordnotif = mysqli_fetch_all($executelandlordnotif, MYSQLI_ASSOC);

        for($i = 0; $i<count($row_landlordnotif); $i++){
            if($row_landlordnotif[$i]['notif_info'] == "Application"){
                ?><!-- 1 notif renter sent application-->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="manageApplicants.php?id=<?php echo $row_landlordnotif[$i]['id'] ?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/application.png" class="landlord-img ms-2" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3"> A potential renter had sent an application. View and process it now. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="lremovenotiffunction(this.value)" value="<?php echo $row_landlordnotif[$i]['id'] ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div> 
                <?php
            }
            else if($row_landlordnotif[$i]['notif_info'] == "Payment"){
                $selectrenter = "SELECT * FROM user_renter WHERE rId='".$row_landlordnotif[$i]['renter_id']."'";
                    $executerenterr = mysqli_query($con, $selectrenter);
                    $row_renter = mysqli_fetch_assoc($executerenterr);
                ?>
                    <!-- 1 notif renter agreed to lease agreement -->
                    <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <div class="col-11">
                            <a href="manageLeases.php?id=<?php echo $row_landlordnotif[$i]['id'] ?>" class="a-notif">
                                <div class="row">
                                    <div class="col-1 ps-2">
                                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                            <img src="../imgs/bill-white.png" class="bill-img mt-1" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 d-flex flex-column gap-2">
                                        <div class="notif-msg ps-3">  Renter, <span><?php echo $row_renter['rFname'] . " " . $row_renter['rLname'] ?></span>, had approved the lease agreement and sent an advance payment. Confirm now. </div>
                                        <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])); ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="lremovenotiffunction(this.value)" value="<?php echo $row_landlordnotif[$i]['id'] ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                <?php
            }
            else if($row_landlordnotif[$i]['notif_info'] == "Receipt"){
                $selectrenter = "SELECT * FROM user_renter WHERE rId='".$row_landlordnotif[$i]['renter_id']."'";
                    $executerenterr = mysqli_query($con, $selectrenter);
                    $row_renter = mysqli_fetch_assoc($executerenterr);
                ?>
                    <!-- 1 notif renter paid monthly rent-->
                    <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <div class="col-11">
                            <a href="manageResidentsRent.php?id=<?php echo $row_landlordnotif[$i]['id'] ?>" class="a-notif">
                                <div class="row">
                                    <div class="col-1 ps-2">
                                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                            <img src="../imgs/peso.png" class="peso-img" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 d-flex flex-column gap-2">
                                        <div class="notif-msg ps-3">  Renter, <span><?php echo $row_renter['rFname'] . " " . $row_renter['rLname'] ?></span>, had paid monthly rent. Confirm receipt now. </div>
                                        <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])); ?></div>
                                    </div>
                                </div>     
                            </a>
                        </div>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="lremovenotiffunction(this.value)" value="<?php echo $row_landlordnotif[$i]['id'] ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                <?php
            }
            else if($row_landlordnotif[$i]['notif_info'] == "moved-in"){
                $selectrenter = "SELECT * FROM user_renter WHERE rId='".$row_landlordnotif[$i]['renter_id']."'";
                    $executerenterr = mysqli_query($con, $selectrenter);
                    $row_renter = mysqli_fetch_assoc($executerenterr);
                ?>
                    <!-- 1 notif renter moved in-->
                    <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <div class="col-11">
                            <a href="manageResidents.php?id=<?php echo $row_landlordnotif[$i]['id'] ?>" class="a-notif">
                                <div class="row">
                                    <div class="col-1 ps-2">
                                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                            <img src="../imgs/moved.png" class="bill-img" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 d-flex flex-column gap-2">
                                        <div class="notif-msg ps-3">  Renter, <span><?php echo $row_renter['rFname'] . " " . $row_renter['rLname'] ?></span>, had already moved-in. </div>
                                        <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])); ?></div>
                                    </div> 
                                </div>
                            </a>
                        </div>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="lremovenotiffunction(this.value)" value="<?php echo $row_landlordnotif[$i]['id'] ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                <?php
            }
            else if($row_landlordnotif[$i]['notif_info'] == "Cancelled"){
                $selectrenter = "SELECT * FROM user_renter WHERE rId='".$row_landlordnotif[$i]['renter_id']."'";
                    $executerenterr = mysqli_query($con, $selectrenter);
                    $row_renter = mysqli_fetch_assoc($executerenterr);
                ?>
                    <!-- 1 notif renter cancelled-->
                    <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <div class="col-11">
                            <a href="manageResidents.php?id=<?php echo $row_landlordnotif[$i]['id'] ?>" class="a-notif">
                                <div class="row">
                                    <div class="col-1 ps-2">
                                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                            <img src="../imgs/cancel.png" class="bill-img" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 d-flex flex-column gap-2">
                                        <div class="notif-msg ps-3">  Renter, <span><?php echo $row_renter['rFname'] . " " . $row_renter['rLname'] ?></span>, cancelled the renting application.</div>
                                        <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])); ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="lremovenotiffunction(this.value)" value="<?php echo $row_landlordnotif[$i]['id'] ?>" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                <?php
            }

            else if($row_landlordnotif[$i]['notif_info'] == "extension"){
                $selectrenter = "SELECT * FROM user_renter WHERE rId='".$row_landlordnotif[$i]['renter_id']."'";
                    $executerenterr = mysqli_query($con, $selectrenter);
                    $row_renter = mysqli_fetch_assoc($executerenterr);
                ?>
                    <!-- 1 notif renter extension -->
                    <div class="row d-flex align-items-center py-3 border-bottom notification-content" onclick="sendidfornewlease(this)" data-value="<?php echo $row_landlordnotif[$i]['id'] ?>">
                        <div class="col-11">
                            <a href="" class="a-notif">  
                                <div class="row">
                                    <div class="col-1 ps-2">
                                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                            <img src="../imgs/question-sign.png" class="ag-img" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 d-flex flex-column gap-2">
                                        <div class="notif-msg ps-3">  Renter, <span><?php echo $row_renter['rFname'] . " " . $row_renter['rLname'] ?></span>, wants to renew the contract expiring next month. We need you to settle it. Please click this notification.</div>
                                        <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])); ?></div>
                                    </div>
                                </div>
                            </a>  
                        </div>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="lremovenotiffunction(this.value)" value="<?php echo $row_landlordnotif[$i]['id'] ?>"  data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                <?php
            }

            else if($row_landlordnotif[$i]['notif_info'] == "property-approved"){
                $selectproperty = "SELECT * FROM landing_properties WHERE propertyID='".$row_landlordnotif[$i]['property_id']."'";
                    $executeproperty = mysqli_query($con, $selectproperty);
                    $row_property = mysqli_fetch_assoc($executeproperty);
                ?>
                    <!-- 1 notif renter extension -->
                    <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                        <div class="col-11">
                            <a href="../viewProperty.php?id=<?php echo $row_landlordnotif[$i]['property_id']?>&notifId=<?php echo $row_landlordnotif[$i]['id'] ?>" class="a-notif">  
                                <div class="row">
                                    <div class="col-1 ps-2">
                                        <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                            <img src="../imgs/question-sign.png" class="ag-img" alt="">
                                        </div>
                                    </div>
                                    <div class="col-10 d-flex flex-column gap-2">
                                        <div class="notif-msg ps-3">  Hooray! The admin had already approved the property, <b> <?php echo $row_property['propertyTitle'] ?> </b>  so this will be shown to potential renters.  </div>
                                        <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_landlordnotif[$i]['notif_date'])); ?></div>
                                    </div>
                                </div>
                            </a>  
                        </div>
                        <div class="col-1 d-flex justify-content-end pe-2 ">
                            <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="lremovenotiffunction(this.value)" value="<?php echo $row_landlordnotif[$i]['id'] ?>"  data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                <?php
            }

            
        }
            ?>
        </div>

        <div class="d-none">
            <input type="text" id="txtIdtoremove" value="">
        </div>
    <!-- JS -->
    <script src="../JavaScripts/functionNav.js"></script>

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
        function sendrejectednewlease(){
            var txtreason = document.getElementById('txtReason1');
            var txtIdtoremove = document.getElementById("txtIdtoremove").value;
            if(txtreason.value != ""){
                $.ajax({
                    url:"../Functions/Landlord/sendrejectednewlease.php",
                    method:"POST",
                    data: {
                        notifid: $("#txtIdtoremove").val(),
                        reasonValue: txtreason.value
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#extendContractModal").modal("hide");
                        lremovenotiffunction(txtIdtoremove);
                    }
                });
            }
            else{
                txtreason.setCustomValidity("Please state the reason!");
                txtreason.reportValidity();
            }
        }

        function sendacceptednewlease(){
            var txtIdtoremove = document.getElementById("txtIdtoremove").value;
            window.location.href = "sendRenewedLease.php?notifid="+txtIdtoremove;
        }

        function sendidfornewlease(valueid){
            var id = valueid.getAttribute('data-value');
            var txtIdtoremove = document.getElementById("txtIdtoremove");
            const modal = new bootstrap.Modal(document.getElementById('extendContractModal'));
            
            txtIdtoremove.value = id;
            modal.show();
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
<?php
    }
    else{
        echo "<script>window.location.href = '../../../RentA/landlordPage/starterPage.php'</script>";
    }
    ?> 