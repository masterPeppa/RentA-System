<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Gallery</title>

    <link rel="icon" type="image/x-icon" href="../../imgs/key.ico">

    <!-- Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="CSS/">
    <link rel="stylesheet" href="CSS/stylesPropertyGallery.css">
    <link rel="stylesheet" href="CSS/stylesLoginAs.css">
    <!-- <link rel="stylesheet" href="CSS/stylesGallery.css"> -->

    <!-- Jquery Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- JS -->
    <script src="JavaScripts/functionNav.js"></script>
</head>
<body>
    <!-- Modal - Login as-->
    <div class="modal fade" id="modal_loginAs" tabindex="-1" aria-labelledby="modal_loginAs" aria-hidden="true">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content vertical-align-center ">
                    <div class="modal-body">

                        <div class="container_loginAs">
                            <header class="text-center mt-5">Which one are you?</header>
                            <div class="row mt-5 d-flex align-items-center justify-content-center">
                    
                                <div class="col-md-6 col-12 d-flex align-items-center justify-content-end pe-5 columns btnRenter">
                                    <div class="aRenter box boxes-loginAs d-flex flex-column justify-content-center align-items-center ">
                                        <img src="imgs/aRenter.png" alt="I'm a Renter" class="img-renter d-md-block d-none">
                                        <p class="mt-4 btn-margin p-label">I'm a Renter</p>
                                    </div>
                                </div>
                    
                                <div class="col-md-6 col-12 d-flex align-items-center justify-content-start ps-5 columns btnLandlord">
                                    <div class="aLandlord box boxes-loginAs d-flex flex-column justify-content-center align-items-center">
                                        <img src="imgs/aLandlord.png" alt="I'm a Landlord" class="img-landlord d-md-block d-none ">
                                        <p class="mt-4 btn-margin p-label">I'm a Landlord</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
<?php
    session_start();
    include('DataBase/connection.php');
    $propertyId = $_GET['id'];
    $selectId = "SELECT * FROM landing_properties WHERE propertyID='$propertyId'";
    $executeSelectedid = mysqli_query($con, $selectId);
    $getPropertyinfo = mysqli_fetch_assoc($executeSelectedid);

    $selectnewId = "SELECT * FROM landing_properties_new WHERE propertyID='$propertyId'";
    $executenewSelectedid = mysqli_query($con, $selectnewId);
    $getnewPropertyinfo = mysqli_fetch_assoc($executenewSelectedid);
    //featured photos
    $setImg1 = str_replace("../../", "", $getPropertyinfo['imgFeatured1']);
    $setImg2 = str_replace("../../", "", $getPropertyinfo['imgFeatured2']);
    $setImg3 = str_replace("../../", "", $getPropertyinfo['imgFeatured3']);

    if(isset($_SESSION['lEmail'])){
        ?>
        <input type="text" id="txtEmail" value="<?php echo $_SESSION['lEmail'];?>">
        <?php
    }
    else if(isset($_SESSION['rEmail'])){
        ?>
        <input type="text" id="txtEmail" value="<?php echo $_SESSION['rEmail'];?>">
        <?php
    }
    else{
        ?>
        <input type="text" id="txtEmail" value="null">
        <?php
    }
?>

    <div class="d-flex flex-column align-items-center">

    <!-- navbar with save -->
    <div class="nav-container fixed-top nav-save">
        <nav class="navbar navbar-expand-md">
            <div class="container-fluid d-flex">

                <div class="btn-back-view">
                    <i class="bi bi-chevron-left" onclick="GobackPage()"></i>
                </div>

                <div>
                    <div class="d-none">
                    <button onclick="saveFunction()" class="nav-save-btns d-block" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                    <button onclick="saveFunction()" class="nav-save-btns d-none" id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button>
                    </div>
                <?php 
                if(!isset($_SESSION['rEmail']) && !isset($_SESSION['lEmail']) && !isset($_SESSION['useradmin'])){
                ?>
                    <button class="nav-save-btns d-block" id="btnSave" onclick="saveFunction()" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                    <button class="nav-save-btns d-none" id="btnSaved" onclick="saveFunction()"id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button>
                <?php
                }
                else{
                    //check if the user is landlord
                    if(isset($_SESSION['lEmail'])){
                        $landlordEmail = $_SESSION['lEmail'];
                        $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
                        $executeSelectUser = mysqli_query($con, $selectUser);
                        $getUser = mysqli_fetch_assoc($executeSelectUser);
                        //check if the user has favorite data
                        $select_favorite = "SELECT * FROM user_favorites WHERE favorite_id='$propertyId' AND user_id='l" . $getUser['lID'] . "'";
                        $favorite_result=mysqli_query($con, $select_favorite);
                        $favorite_count = mysqli_num_rows($favorite_result);
                        if($favorite_count > 0){?>
                        <!-- for save conditionlogo -->
                        <div class="d-none">
                            <!-- <button onclick="saveFunction()" class="nav-save-btns d-none" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                            <button onclick="saveFunction()" class="nav-save-btns d-block" id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button> -->
                        </div>
                            <!-- <button class="nav-save-btns d-none" id="btnSave" onclick="saveFunction()" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                            <button class="nav-save-btns d-block" id="btnSaved" onclick="saveFunction()"id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button> -->
                        <?php
                        }
                        else{
                        ?>
                            <!-- <button class="nav-save-btns d-block" id="btnSave" onclick="saveFunction()" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                            <button class="nav-save-btns d-none" id="btnSaved" onclick="saveFunction()"id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button> -->
                        <?php
                            }
                        }
                        //check if the user is renter
                        else if(isset($_SESSION['rEmail'])){
                            $renterEmail = $_SESSION['rEmail'];
                            $selectUser = "SELECT * FROM user_renter WHERE rEmail='$renterEmail'";
                            $executeSelectUser = mysqli_query($con, $selectUser);
                            $getUser = mysqli_fetch_assoc($executeSelectUser);
                            $select_favorite = "SELECT * FROM user_favorites WHERE favorite_id='$propertyId' AND user_id='r" . $getUser['rId'] . "'";
                            $favorite_result=mysqli_query($con, $select_favorite);
                            $favorite_count = mysqli_num_rows($favorite_result);
                            if($favorite_count > 0){?>
                            <!-- for save conditionlogo -->
                            <div class="d-none">
                                <button onclick="saveFunction()" class="nav-save-btns d-none" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                                <button onclick="saveFunction()" class="nav-save-btns d-block" id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button>
                            </div>
                                <button class="nav-save-btns d-none" id="btnSave" onclick="saveFunction()" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                                <button class="nav-save-btns d-block" id="btnSaved" onclick="saveFunction()"id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button>
                            <?php
                            }
                            else{
                            ?>
                                <button class="nav-save-btns d-block" id="btnSave" onclick="saveFunction()" id="btnNavSave" value="<?php echo $getPropertyinfo['propertyID']; ?>"> Save &nbsp;&nbsp;<i class="bi bi-heart heart-icons" ></i></button>
                                <button class="nav-save-btns d-none" id="btnSaved" onclick="saveFunction()"id="btnNavSaved" value="unsave"> Saved &nbsp;&nbsp; <i class="bi bi-heart-fill heart-icons"></i></button>
                                <?php
                                }
                            }
                        }
                        ?>
                </div>

            </div>
        </nav>
    </div>
<!-- end with save -->

<!-- GALLERY -->
    <section class="gallery-container">

    <!-- FEATURED -->
        <section class="featured">
            <div class="row d-flex gallery-row flex-wrap mt-5">
                <div class="col-12 d-flex align-items-center">
                    <img src="<?php echo $setImg1 ?>" alt="" class="img-fluid p-1 gallery-img">
                </div>
                <div class="col-6 d-flex align-items-center">
                    <img src="<?php echo $setImg2 ?>" alt="" class="img-fluid p-1 gallery-img ">
                </div>
                <div class="col-6 d-flex align-items-center">
                    <img src="<?php echo $setImg3 ?>" alt="" class="img-fluid p-1 gallery-img ">
                </div>
            </div>
        </section>

    <?php
    if($getPropertyinfo['imgLivingroom'] != NULL){
        $livingroom = str_replace("../../", "", $getPropertyinfo['imgLivingroom']);
        $livingroom1 = str_replace("../../", "", $getnewPropertyinfo['imgLivingroom1']);
        $livingroom2 = str_replace("../../", "", $getnewPropertyinfo['imgLivingroom2']);
    ?>
    <!-- LIVING ROOM -->
        <section class="living-room mt-5 mb-3">
            <h3 class="text-center">Living Room</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $livingroom ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $livingroom1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $livingroom2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgDiningroom'] != NULL){
        $Diningroom = str_replace("../../", "", $getPropertyinfo['imgDiningroom']);
        $Diningroom1 = str_replace("../../", "", $getnewPropertyinfo['imgDiningroom1']);
        $Diningroom2 = str_replace("../../", "", $getnewPropertyinfo['imgDiningroom2']);
    ?>
    <!-- DINING ROOM -->
        <section class="living-room mt-5 mb-3">
            <h3 class="text-center">Dining Room</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $Diningroom ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $Diningroom1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $Diningroom2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgKitchen'] != NULL){
        $kitchen = str_replace("../../", "", $getPropertyinfo['imgKitchen']);
        $kitchen1 = str_replace("../../", "", $getnewPropertyinfo['imgKitchen1']);
        $kitchen2 = str_replace("../../", "", $getnewPropertyinfo['imgKitchen2']);
    ?>
    <!-- KITCHEN -->
        <section class="kitchen mt-5 mb-3">
            <h3 class="text-center">Kitchen</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $kitchen ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $kitchen1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $kitchen2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgBedroom'] != NULL){
        $bedroom = str_replace("../../", "", $getPropertyinfo['imgBedroom']);
        $bedroom1 = str_replace("../../", "", $getnewPropertyinfo['imgBedroom1']);
        $bedroom2 = str_replace("../../", "", $getnewPropertyinfo['imgBedroom2']);
    ?>
    <!-- BEDROOM -->
        <section class="bedroom mt-5 mb-3">
            <h3 class="text-center">Bedroom</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $bedroom ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $bedroom1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $bedroom2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgBathroom'] != NULL){
        $bathroom = str_replace("../../", "", $getPropertyinfo['imgBathroom']);
        $bathroom1 = str_replace("../../", "", $getnewPropertyinfo['imgBathroom1']);
        $bathroom2 = str_replace("../../", "", $getnewPropertyinfo['imgBathroom2']);
    ?>
    <!-- BATHROOMS -->
        <section class="bathroom mt-5 mb-3">
            <h3 class="text-center">Bathroom</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $bathroom ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $bathroom1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $bathroom2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgStudyOffice'] != NULL){
        $StudyOffice = str_replace("../../", "", $getPropertyinfo['imgStudyOffice']);
        $StudyOffice1 = str_replace("../../", "", $getnewPropertyinfo['imgStudyOffice1']);
        $StudyOffice2 = str_replace("../../", "", $getnewPropertyinfo['imgStudyOffice2']);
    ?>
    <!-- STUDY ROOM -->
        <section class="study-room mt-5 mb-3">
            <h3 class="text-center">Study Room / Office</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $StudyOffice ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $StudyOffice1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $StudyOffice2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgEntertainmentroom'] != NULL){
        $entertainmentroom = str_replace("../../", "", $getPropertyinfo['imgEntertainmentroom']);
        $entertainmentroom1 = str_replace("../../", "", $getnewPropertyinfo['imgEntertainmentroom1']);
        $entertainmentroom2 = str_replace("../../", "", $getnewPropertyinfo['imgEntertainmentroom2']);
    ?>
    <!-- ENTERTAINMENT ROOM -->
        <section class="entertainment-room mt-5 mb-3">
            <h3 class="text-center">Entertainment Room</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $entertainmentroom ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $entertainmentroom1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $entertainmentroom2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgLaundryroom'] != NULL){
        $laundryroom = str_replace("../../", "", $getPropertyinfo['imgLaundryroom']);
        $laundryroom1 = str_replace("../../", "", $getnewPropertyinfo['imgLaundryroom1']);
        $laundryroom2 = str_replace("../../", "", $getnewPropertyinfo['imgLaundryroom2']);
    ?>
    <!-- LAUNDRY ROOM -->
        <section class="utility-room mt-5 mb-3">
            <h3 class="text-center">Laundry Room</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $laundryroom ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $laundryroom1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $laundryroom2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgHallway'] != NULL){
        $hallway = str_replace("../../", "", $getPropertyinfo['imgHallway']);
        $hallway1 = str_replace("../../", "", $getnewPropertyinfo['imgHallway1']);
        $hallway2 = str_replace("../../", "", $getnewPropertyinfo['imgHallway2']);
    ?>
    <!-- HALLWAY -->
        <section class="hallway mt-5 mb-3">
            <h3 class="text-center">Hallway</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $hallway ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $hallway1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $hallway2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgStaircase'] != NULL){
        $staircase = str_replace("../../", "", $getPropertyinfo['imgStaircase']);
        $staircase1 = str_replace("../../", "", $getnewPropertyinfo['imgStaircase1']);
        $staircase2 = str_replace("../../", "", $getnewPropertyinfo['imgStaircase2']);
    ?>
    <!-- STAIRCASES -->
        <section class="staircases mt-5 mb-3">
            <h3 class="text-center">Staircases</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $staircase ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $staircase1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $staircase2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgWalkInCloset'] != NULL){
        $walkincloset = str_replace("../../", "", $getPropertyinfo['imgWalkInCloset']);
        $walkincloset1 = str_replace("../../", "", $getnewPropertyinfo['imgWalkInCloset1']);
        $walkincloset2 = str_replace("../../", "", $getnewPropertyinfo['imgWalkInCloset2']);
    ?>
    <!-- STORAGE AREA  -->
        <section class="storage-area mt-5 mb-3">
            <h3 class="text-center">Walk-in Closet</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $walkincloset ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $walkincloset1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $walkincloset2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgOther'] != NULL){
        $other = str_replace("../../", "", $getPropertyinfo['imgOther']);
        $other1 = str_replace("../../", "", $getnewPropertyinfo['imgOther1']);
        $other2 = str_replace("../../", "", $getnewPropertyinfo['imgOther2']);
    ?>
    <!-- Other Functional Rooms -->
        <section class="other-room mt-5 mb-3">
            <h3 class="text-center">Other Functional Rooms</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $other ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $other1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $other2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgFrontyard'] != NULL){
        $frontyard = str_replace("../../", "", $getPropertyinfo['imgFrontyard']);
        $frontyard1 = str_replace("../../", "", $getnewPropertyinfo['imgFrontyard1']);
        $frontyard2 = str_replace("../../", "", $getnewPropertyinfo['imgFrontyard2']);
    ?>
    <!-- FRONT YARD -->
        <section class="frontyard mt-5 mb-3">
            <h3 class="text-center">Front Yard</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $frontyard ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $frontyard1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $frontyard2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgBackyard'] != NULL){
        $backyard = str_replace("../../", "", $getPropertyinfo['imgBackyard']);
        $backyard1 = str_replace("../../", "", $getnewPropertyinfo['imgBackyard1']);
        $backyard2 = str_replace("../../", "", $getnewPropertyinfo['imgBackyard2']);
    ?>
    <!-- BACKYARD -->
        <section class="backyard mt-5 mb-3">
            <h3 class="text-center">Backyard</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $backyard ?>" alt="" class="img-fluid p-1 gallery-img">
            </div><div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $backyard1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div><div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $backyard2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgTerrace'] != NULL){
        $terrace = str_replace("../../", "", $getPropertyinfo['imgTerrace']);
        $terrace1 = str_replace("../../", "", $getnewPropertyinfo['imgTerrace1']);
        $terrace2 = str_replace("../../", "", $getnewPropertyinfo['imgTerrace2']);
    ?>
    <!-- TERRACE -->
        <section class="patio-terrace mt-5 mb-3">
            <h3 class="text-center">Patio / Terrace</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $terrace ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $terrace1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $terrace2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgDeck'] != NULL){
        $deck = str_replace("../../", "", $getPropertyinfo['imgDeck']);
        $deck1 = str_replace("../../", "", $getnewPropertyinfo['imgDeck1']);
        $deck2 = str_replace("../../", "", $getnewPropertyinfo['imgDeck2']);
    ?>
    <!-- Deck -->
        <section class="deck mt-5 mb-3">
            <h3 class="text-center">Deck</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $deck ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $deck1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $deck2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgGarden'] != NULL){
        $garden = str_replace("../../", "", $getPropertyinfo['imgGarden']);
        $garden1 = str_replace("../../", "", $getnewPropertyinfo['imgGarden1']);
        $garden2 = str_replace("../../", "", $getnewPropertyinfo['imgGarden2']);
    ?>
    <!-- Garden -->
        <section class="garden mt-5 mb-3">
            <h3 class="text-center">Garden</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $garden ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $garden1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $garden2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgPool'] != NULL){
        $pool = str_replace("../../", "", $getPropertyinfo['imgPool']);
        $pool1 = str_replace("../../", "", $getnewPropertyinfo['imgPool1']);
        $pool2 = str_replace("../../", "", $getnewPropertyinfo['imgPool2']);
    ?>
    <!-- POOL -->
        <section class="pool mt-5 mb-3">
            <h3 class="text-center">Swimming Pool</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $pool ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $pool1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $pool2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgDriveway'] != NULL){
        $driveway = str_replace("../../", "", $getPropertyinfo['imgDriveway']);
        $driveway1 = str_replace("../../", "", $getnewPropertyinfo['imgDriveway1']);
        $driveway2 = str_replace("../../", "", $getnewPropertyinfo['imgDriveway2']);
    ?>
    <!-- DRIVEWAY -->
        <section class="driveway mt-5 mb-3">
            <h3 class="text-center">Driveway</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $driveway ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $driveway1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $driveway2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgWalkways'] != NULL){
        $walkway = str_replace("../../", "", $getPropertyinfo['imgWalkways']);
        $walkway1 = str_replace("../../", "", $getnewPropertyinfo['imgWalkways1']);
        $walkway2 = str_replace("../../", "", $getnewPropertyinfo['imgWalkways2']);
    ?>
    <!-- Walkways -->
        <section class="walkways mt-5 mb-3">
            <h3 class="text-center">Walkways</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $walkway ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $walkway1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $walkway2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgOutKitchen'] != NULL){
        $outkitchen = str_replace("../../", "", $getPropertyinfo['imgOutKitchen']);
        $outkitchen1 = str_replace("../../", "", $getnewPropertyinfo['imgOutKitchen1']);
        $outkitchen2 = str_replace("../../", "", $getnewPropertyinfo['imgOutKitchen2']);
    ?>
    <!-- Outdoor Kitchen -->
        <section class="outdoor-kitchen mt-5 mb-3">
            <h3 class="text-center">Outdoor Kitchen</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $outkitchen ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $outkitchen1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $outkitchen2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgPlayarea'] != NULL){
        $playarea = str_replace("../../", "", $getPropertyinfo['imgPlayarea']);
        $playarea1 = str_replace("../../", "", $getnewPropertyinfo['imgPlayarea1']);
        $playarea2 = str_replace("../../", "", $getnewPropertyinfo['imgPlayarea2']);
    ?>
    <!-- Play Area -->
        <section class="play-area mt-5 mb-3">
            <h3 class="text-center">Play Area</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $playarea ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $playarea ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $playarea ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgPatio'] != NULL){
        $Patio = str_replace("../../", "", $getPropertyinfo['imgPatio']);
        $Patio1 = str_replace("../../", "", $getnewPropertyinfo['imgPatio1']);
        $Patio2 = str_replace("../../", "", $getnewPropertyinfo['imgPatio2']);
    ?>
    <!-- Patio -->
        <section class="outdoor-sitting mt-5 mb-3">
            <h3 class="text-center">Patio</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $Patio ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $Patio1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $Patio1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    if($getPropertyinfo['imgStorageshed'] != NULL){
        $storageshed = str_replace("../../", "", $getPropertyinfo['imgStorageshed']);
        $storageshed1 = str_replace("../../", "", $getnewPropertyinfo['imgStorageshed1']);
        $storageshed2 = str_replace("../../", "", $getnewPropertyinfo['imgStorageshed2']);
    ?>
    <!-- STORAGE SHED-->
        <section class="storage-shed mt-5 mb-3">
            <h3 class="text-center">Storage Shed</h3>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $storageshed ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $storageshed1 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
            <div class="row d-flex gallery-row align-items-center">
                <img src="<?php echo $storageshed2 ?>" alt="" class="img-fluid p-1 gallery-img">
            </div>
        </section>
    <?php
    }
    ?>
</div>
</body>
</html>
<?php
// Close the database connection
mysqli_close($con);
?>