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
    <link rel="stylesheet" href="../../CSS/stylesIdVerification.css">
    <link rel="stylesheet" href="../../CSS/stylesNav.css">
    <link rel="stylesheet" href="../../CSS/stylesLoginAs.css">
    
    <!-- JS -->
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
            <header class="main-header">Identity Verification</header>
            <p class="mt-3">RentA aims to confirm your legitimacy and ensure account security.
            This helps build trust between renters and landlords. The data you're sharing will be private, safe, and secure. <br> <br>
            First, add an official government ID.
            </p>

            <!-- Please ensure that the information is not blurred and is easily legible <br/> for a quick verification process. <br/> -->

            <section class="radio-section mt-3">

            <div class="radio-list">
                <div class="radio-item">
                    <input type="radio" name="choice" id="idUpload" value="upload">
                    <label for="idUpload">Upload an existing photo. </label>
                </div>
                
                <div class="radio-item">
                    <input type="radio" name="choice" id="idCapture" value="camera">
                    <label for="idCapture">Take a photo with your camera.</label>
                </div>
            </div>
            </section>
            <footer class="d-flex mt-5 justify-content-end">
                <!-- <button class="btns" id="btn_back"><i class="bi bi-arrow-left"></i>&nbsp;Back</button> -->
                <div>
                    <!-- <button class="btns btn1 px-4 py-2 btn-cancel" id="" data-bs-toggle="modal" data-bs-target="#skipVerificationModal">Skip Verification</button> -->
                    <button class="btns btn1 px-4 py-2 btn-go text-light" id="btn_continue">Continue</button>
                </div>
                
                
            </footer>
        </div>
</body>
</html>
<?php
    }
    else{
        echo "<script>window.location.href = '../../../RentA/landlordPage/starterPage.php'</script>";
    }
    ?>