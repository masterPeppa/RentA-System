<?php
session_start();
include ('../../DataBase/connection.php');
    if(isset($_SESSION['lEmail'])){
        $user_email = $_SESSION['lEmail'];
        $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$user_email'";
        $executeSelectUser = mysqli_query($con, $selectUser);
        $getUser = mysqli_fetch_assoc($executeSelectUser);

        $userProfile = "../".$getUser['lImgProfile'];
        
        $separatedWordSecurity = $getUser['backupPhrase'];
        $wordArray = explode(" ", $separatedWordSecurity);
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | Verification</title>
    <link rel="icon" type="image/x-icon" href="../../imgs/key.ico">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS file -->
    <link rel="stylesheet" href="../../CSS/">
    <link rel="stylesheet" href="../../CSS/stylesIdMatching.css">
    <link rel="stylesheet" href="../../CSS/stylesNav.css">
    <link rel="stylesheet" href="../../CSS/stylesLoginAs.css">

    <!-- JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
    <script src="../../JavaScripts/id_query.js"></script>
    <script src="../../JavaScripts/functionNav.js"></script>


</head>

<body>

    <!-- MAIN -->
        <div class="container">
        <?php
            if(isset($_GET['action']) && $_GET['action'] != ''){ ?>
                <div class="d-none">
                    <input type="text" id="txtLandlordAction" value="<?php echo $_GET['action'] ?>">
                </div>
            <?php
            }
            else{
            ?>
                <div class="d-none">
                    <input type="text" id="txtLandlordAction" value="null">
                </div>
            <?php
            }
            ?>
            <header class="main-header"> ID & Face Matching </header>
            <p class="mt-3">
                Provide a selfie holding the government ID you provided. Make sure your face & the photo in your ID are clear for faster verification.
            </p>

            <section class="section-matching mt-4 " id="imgmatchId">
                <div class="d-flex flex-column">
                    <div class="outer-container d-flex align-items-center justify-content-center">
                        <div class="container-match-vid">
                            <video id="matchwebcam" autoplay playsinline class="img_Capture"></video>
                        </div>
                    </div>
                    
                    <footer class="mt-5 d-flex flex-row justify-content-between">
                        <button class="return-btns btn-back ms-2" id="btn_ReturnBack"><i class="bi bi-arrow-left"></i>&nbsp;Back</button>
                        <button class="btns proceed-btns" id="btn_capturematchid"> <i class="bi bi-camera"> </i> &nbsp;Take Photo</button>
                    </footer>
                </div>
            </section>

            <section class="section-confirm-back mt-4 d-none" id="imgmatchIdResult">
                <div class="d-flex flex-column">
                    <div class="outer-container d-flex align-items-center justify-content-center">
                        <div class="container-match-pic">
                            <canvas id="matchcanvas" class="img_Capture"></canvas>
                        </div>
                    </div>
                    <footer class="d-flex flex-row mt-5 gap-2 justify-content-between">
                        <button class="return-btns btn-retake ms-1" id="btn_retakematch"><i class="bi bi-arrow-left"></i>&nbsp;Retake Photo</button>
                        <button class="btns proceed-btns" id="btn_confirmmatchId"><i class="bi bi-check-circle"></i> &nbsp;Submit Photo</button>
                    </div>
                </div>
            </section>

        </div>
</body>
</html>
<?php
    }
    else{
        echo "<script>window.location.href = '../../../RentA/landlordPage/starterPage.php'</script>";
    }
    ?>