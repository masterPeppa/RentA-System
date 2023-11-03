<?php

session_start();
include('../DataBase/connection.php');
if(isset($_SESSION['rEmail'])){
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Notifications</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">
     
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

     <!-- Bootstrap icons -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

     <!-- CSS -->
     <link rel="stylesheet" href="../CSS/">
     <link rel="stylesheet" href="../CSS/stylesNav.css">
     <link rel="stylesheet" href="../CSS/stylesRenterApplication.css">

     <!--JQuery-->
     

</head>
<body>

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

<!-- MODAL EXTEND -->
<div class="modal fade" id="extendContractModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modals modal-extend">

            <div class="modal-header modal-header-logout p-3">
                <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center mt-3 px-4">
                    <img src="../imgs/question-purple.png" alt="Log Out" class="img-logout">
                    <h5 class="text-center mt-1">Do you wish to request contract renewal and extend your stay here? If yes, we will notify your landlord and we'll get you his/her response.</h5>
                </div>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                <a onclick="sendExtensiontolandlord()" class="btn btn-confirm modal-logout-btns d-flex align-items-center justify-content-center" data-bs-dismiss="modal">Yes</a>
              </div>
        </div>
    </div>
</div>
<!-- modal end - EXTEND -->


<!-- MODAL REASON FOR REJECTION -->
<div class="modal fade" id="renewRejectedModal" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modals modal-reject-reason">

            <div class="modal-header modal-header-logout p-3">
                <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center mt-3 px-4">
                    <img src="../imgs/question-purple.png" alt="Log Out" class="img-logout">
                    <h5 class="text-center mt-1">Your landlord didn't agreed to your contract renewal for this reason: </h5>
                    <div class="reason-div p-3 mt-3">
                        <p class="reject-reason-txt" id="txtReason1">Please state reason submitted here...</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button  onclick="okRejected()" type="button" class="btn btn-confirm modal-logout-btns" data-bs-dismiss="modal">Ok</button>
              </div>
        </div>
    </div>
</div>
<!-- modal end - EXTEND -->

<!-- MODAL REASON FOR REJECTION -->
<div class="modal fade" id="renewrejectedreceipt" tabindex="-1" aria-labelledby="modalLogout" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modals modal-reject-reason">

            <div class="modal-header modal-header-logout p-3">
                <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="d-flex flex-column align-items-center justify-content-center mt-3 px-4">
                    <img src="../imgs/question-purple.png" alt="Log Out" class="img-logout">
                    <h5 class="text-center mt-1">Your payment was declined by your landlord due to the following reason: </h5>
                    <div class="reason-div p-3 mt-3">
                        <p class="reject-reason-txt" id="txtReason">Please state reason submitted here...</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-flex gap-2 p-3">
                <button type="button" class="btn btn-confirm modal-logout-btns" data-bs-dismiss="modal">Ok</button>
              </div>
        </div>
    </div>
</div>
<!-- modal end - EXTEND -->

<!-- Navbar - Renter -->
<div class="nav-container fixed-top ">
    <nav class="navbar navbar-expand-md px-3 px-md-5">
        <div class="container-fluid">

            <div class="d-none">
                <input type="text" id="txtEmail" value="<?php echo $_SESSION['rEmail'];?>">
            </div>

            <!-- burger -->
            <button class="navbar-toggler collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuRenter" >
                <span class="toggler-icon top-bar"></span>
                <span class="toggler-icon middle-bar"></span>
                <span class="toggler-icon bottom-bar"></span>
            </button>

            <!-- logo -->
            <a class="navbar-brand" href="../../RentA">
                <img src="../imgs/logo.png" alt="RentA" id="imgLogo">
            </a>
            
            <!-- Avatar - Renter on small screen -->
            <div class="dropdown ms-auto d-sm-block d-md-none ">
                <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $getUser['rImgProfile'] ?>" alt="" class="img-avatar">
                    <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar"></i>
                    <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar"></i>
                    <div class="d-none">
                        <input type="text" id="txtUserId" value="<?php echo $getUser['rId'] ?>">
                    </div>
                <span id="smnotifyCircle">
                </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-avatar-renter-sm " aria-labelledby="dropdrownbtn-avatar">
                    <li>
                        <a class="dropdown-item dropdown-item-first d-flex justify-content-between active-dropdown" href="renterNotifications.php" id="smNotifCount">
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="smmessageCount"> 
                        </a>
                    </li>
                    <li><a class="dropdown-item" href="../favorites.php">Favorites</a></li>
                    <li><a class="dropdown-item " href="renterProfile.php">My Profile</a></li>
                    <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                </ul>
            </div>

            <!-- links center -->
            <div class="collapse navbar-collapse" id="navMenuRenter">

                <ul class="navbar-nav navbar-nav-renter d-flex gap-2 align-items-center ms-auto">
                        <li class="nav-item px-3">
                            <a class="nav-link" href="../rentals.php">Find Rentals</a>
                        </li>
                        
                        <!-- Manage -->
                        <li class="nav-item dropdown d-none d-sm-none d-md-block">
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block dd-renter-manage" type="button" id="" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-rentals" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" href="application1Submit.php">Application</a></li>
                                <li><a class="dropdown-item" href="manageMonthlyRent.php">Monthly Rent</a></li>
                                <li><a class="dropdown-item dropdown-item-last" href="manageRentalConcern.php">Rental Concern</a></li>
                                
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" href="application1Submit.php">Application</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link active-dropdown" href="manageMonthlyRent.php">Monthly Rent</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " href="manageRentalConcern.php">Rental Concern</a>
                        </li>

                </ul>

                <ul class="d-flex align-items-center ms-auto">
                    <!-- Avatar - Renter big-->
                    <div class="dropdown ">
                        <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $getUser['rImgProfile'] ?>" alt="" class="img-avatar me-1">
                            <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                            <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>

                        <span id="notifyCircle">
                        </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-avatar-renter" aria-labelledby="dropdrownbtn-avatar">
                            <li>
                                <a class="dropdown-item dropdown-item-first d-flex justify-content-between active-dropdown" href="renterNotifications.php" id="notifCount">
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item d-flex justify-content-between" href="../messages.php" id="messageCount">
                                     
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="../favorites.php">Favorites</a></li>
                            <li><a class="dropdown-item" href="renterProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                        </ul>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</div>
<!-- end navbar renter -->



<!-- MAIN -->
<!-- NOTIFICATIONS -->
<div class="landlord-container d-flex flex-column justify-content-center align-items-center  p-3" id="notifBody">
    <h1 class="l-page-h1">Notifications</h1>
    <div class="notif-container mt-3">

    <?php
        $selectrenternotif = "SELECT * FROM renter_notification WHERE notif_status='unread' ORDER BY notif_date DESC";
        $executerenternotif = mysqli_query($con, $selectrenternotif);
        $row_renternotif = mysqli_fetch_all($executerenternotif, MYSQLI_ASSOC);
        for($i = 0; $i<count($row_renternotif); $i++){

            if($row_renternotif[$i]['notif_info'] == "application-approved"){
            ?>
                <!-- 1 notif landlord approved application -->
            <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                <div class="col-11">
                    <a href="application3LeaseWait.php?idnotif=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                        <div class="row">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/approved.png" class="app-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2">
                                <div class="notif-msg ps-3"> The landlord had approved your rental application. View progress. </div>
                                <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                            </div>
                        </div>
                    </a>
                </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>
        <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "rejected-application"){
                ?>
                <!-- 1 notif landlord rejected application -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="application2Rejected.php?idnotif=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/cancel.png" class="bill-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  Sorry, the landlord had rejected your rental application. See the reason why by clicking this notification.</div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>
        
            <?php
            }
            else if($row_renternotif[$i]['notif_info'] == "received-lease"){
                ?>

                <!-- 1 notif landlord sent lease -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="application3SignLeaseUploaded.php?idnotif=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/lease-ag.png" class="ag-img ms-1" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  The landlord sent you a lease and advance payment agreement. Settle it now. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>
            <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "receipt-accepted"){
            ?>
                <!-- 1 notif landlord confirmed receipt -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="application4Move.php?idnotif=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/calendar.png" class="ag-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3"> The landlord confirmed your lease and advance payment. Message him/her to settle your move-in date. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>
            <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "moved-in-q"){
            ?>
                <!-- 1 notif renter moved in? -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="application4Move.php?idnotif=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/question-sign.png" class="ag-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  Have you already moved-in? Please confirm now. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>

            <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "due3"){
            ?>
                <!-- 1 notif monthly rent due -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="manageMonthlyRent.php?idnotif=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/wallet.png" class="ag-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  Your monthly rent is due in 3 days. Settle it now. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                                </div>
                                
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>

            <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "due-today"){
            ?>
                <!-- 1 notif monthly rent due today -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="manageMonthlyRent.php?idnotif=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/wallet.png" class="ag-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  Your monthly rent is due today. You need to settle it now. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>

            <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "due-late"){
            ?>

                <!-- 1 notif monthly rent due late -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                    <div class="col-11">
                        <a href="manageMonthlyRent.php?idnotif=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/wallet.png" class="ag-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2">
                                    <div class="notif-msg ps-3">  Your monthly rent due date has already passed. Please settle it immediately. </div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>

            <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "contract-expiring"){
            ?>

            <!-- 1 notif contract expiring -->
            <div class="row d-flex align-items-center py-3 border-bottom notification-content" onclick="reqnewlease(this)" data-value="<?php echo $row_renternotif[$i]['id'] ?>">
                <div class="col-11">
                    <a href="" class="a-notif">
                        <div class="row">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/question-sign.png" class="ag-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2 extend-notif">
                                <div class="notif-msg ps-3">  Your contract is expiring next month. We need you to settle it. Please click this notification.</div>
                                <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-1 d-flex justify-content-end pe-2 ">
                    <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                </div>
            </div>

            <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "extend-agreed"){
            ?>

            <!-- 1 notif contract agreed to extend -->
            <div class="row d-flex align-items-center py-3 border-bottom notification-content">
                <div class="col-11">
                    <a href="renewedLease.php?notifid=<?php echo $row_renternotif[$i]['id'] ?>" class="a-notif">
                        <div class="row">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/approved.png" class="app-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2 extend-notif">
                                <div class="notif-msg ps-3"> The landlord had agreed on renewing your contract. Please wait while he/she processes the new contract. </div>
                                <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-1 d-flex justify-content-end pe-2 ">
                    <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                </div>
            </div>

            <?php
            }
        
            else if($row_renternotif[$i]['notif_info'] == "extend-rejected"){
            ?>

            <!-- 1 notif contract rejected to extend -->
            <div class="row d-flex align-items-center py-3 border-bottom notification-content" onclick="getRejectedrenewid(this)" data-value="<?php echo $row_renternotif[$i]['id']?>">
                <div class="col-11">
                    <a href="" class="a-notif">
                        <div class="row">
                            <div class="col-1 ps-2">
                                <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                    <img src="../imgs/cancel.png" class="bill-img" alt="">
                                </div>
                            </div>
                            <div class="col-10 d-flex flex-column gap-2 extend-notif">
                                <div class="notif-msg ps-3"> Sorry! The landlord had rejected your request for contract renewal. See his/her reason here.</div>
                                <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-1 d-flex justify-content-end pe-2 ">
                    <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                </div>
            </div>

            <?php
            }

            else if($row_renternotif[$i]['notif_info'] == "receipt-rejected"){
                ?>
                <!-- 1 notif contract rejected to extend -->
                <div class="row d-flex align-items-center py-3 border-bottom notification-content" onclick="checkrejectedreason(this)" data-value="<?php echo $row_renternotif[$i]['id'] ?>">
                    <div class="col-11">
                        <a href="" class="a-notif">
                            <div class="row">
                                <div class="col-1 ps-2">
                                    <div class="notif-circle rounded-circle d-flex align-items-center justify-content-center ">
                                        <img src="../imgs/cancel.png" class="bill-img" alt="">
                                    </div>
                                </div>
                                <div class="col-10 d-flex flex-column gap-2 extend-notif">
                                    <div class="notif-msg ps-3"> Sorry! The landlord had rejected your payment receipt. See his/her reason here.</div>
                                    <div class="notif-date ps-3"><?php echo date('m/d/Y', strtotime($row_renternotif[$i]['notif_date'])); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-1 d-flex justify-content-end pe-2 ">
                        <button type="button" class="btn-close btn-close-notif btnremovenotif" onclick="removenotiffunction(this.value)" value="<?php echo $row_renternotif[$i]['id'] ?>"></button>
                    </div>
                </div>
    
                <?php
                }
        }
            ?>
        </div>
        <div class="d-none">
            <input type="text" value="" id="txtNotifextendid">
        </div>
    


<!-- ```````````````````````````````` -->
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="../JavaScripts/functionNav.js"></script>

    <script>
        function blurFunction(){
            var upAvatar = document.getElementById("chevron-up-avatar");
            var downAvatar = document.getElementById("chevron-down-avatar");
            var upAvatar2 = document.getElementById("chevron-up-avatar2");
            var downAvatar2 = document.getElementById("chevron-down-avatar2");
            var upManage = document.getElementById("chevron-up-manage");
            var downManage = document.getElementById("chevron-down-manage");
             
            upAvatar.style.display = "none";
            downAvatar.style.display = "inline-block";

            upAvatar2.style.display = "none";
            downAvatar2.style.display = "inline-block";

            upManage.style.display = "none";
            downManage.style.display = "inline-block";
        }
        function checkrejectedreason(valueid){
            var id = valueid.getAttribute('data-value');
            var txtReason = document.getElementById("txtReason");
            const modal = new bootstrap.Modal(document.getElementById('renewrejectedreceipt'));
            $.ajax({
                url:"../Functions/Renters/displayrejectedreason.php",
                method:"POST",
                data:{
                    paymentid:id
                },
                dataType:"text",
                success:function(data)
                {
                    txtReason.textContent = data;
                    modal.show();
                    removenotiffunction(id);
                }
            });
        }

        function okRejected(){
            var txtNotifextendid = document.getElementById("txtNotifextendid").value;
            removenotiffunction(txtNotifextendid);
            $("#renewRejectedModal").modal("hide");
        }

        function sendExtensiontolandlord(){
            var txtNotifextendid = document.getElementById("txtNotifextendid").value;
            $.ajax({
                url:"../Functions/Renters/sendreqnewleasetolandlord.php",
                method:"POST",
                data:{
                    notifid:txtNotifextendid
                },
                dataType:"text",
                success:function(data)
                {
                    removenotiffunction(txtNotifextendid);
                }
            });
        }

        function reqnewlease(valueid){
            var id = valueid.getAttribute('data-value');
            var txtNotifextendid = document.getElementById("txtNotifextendid");
            const modal = new bootstrap.Modal(document.getElementById('extendContractModal'));
            
            txtNotifextendid.value = id;
            modal.show();
        }

        function getRejectedrenewid(valueid){
            var id = valueid.getAttribute('data-value');
            var txtReason = document.getElementById("txtReason1");
            var txtNotifextendid = document.getElementById("txtNotifextendid");
            const modal = new bootstrap.Modal(document.getElementById('renewRejectedModal'));

            $.ajax({
                url:"../Functions/Renters/displayrenewrejectedreason.php",
                method:"POST",
                data:{
                    notifid:id
                },
                dataType:"text",
                success:function(data)
                {
                    txtReason.textContent = data;
                    txtNotifextendid.value = id;
                    modal.show();
                }
            });
        }

        setInterval(function(){
                $.ajax({
                    url:"../Functions/Renters/realtimeapplicationNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifId").html(data);
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
                    url:"../Functions/Renters/realtimeNotifCount.php",
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
                    url:"../Functions/Renters/realtimeNotifCount.php",
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
    echo "<script>window.location.href = '../../../RentA/RentersPage/starterPage.php'</script>";
}
?> -->