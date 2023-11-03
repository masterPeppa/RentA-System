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
    <title>RentA</title>
    <link rel="icon" type="image/x-icon" href="../../imgs/key.ico">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS file -->
    <link rel="stylesheet" href="../../CSS/">
    <link rel="stylesheet" href="../../CSS/stylesUploadId.css">
    <link rel="stylesheet" href="../../CSS/stylesNav.css">

    <!-- JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
    <script src="../../JavaScripts/id_query.js"></script>
    <script src="../../JavaScripts/functionNav.js"></script>
    <link rel="stylesheet" href="../../CSS/stylesLoginAs.css">
    <script>
        window.addEventListener('load', function() {
            document.getElementById('uploadFileback').value = "";
            document.getElementById('frontuploadFile').value = "";
        });
    </script>
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
        <header class="main-header">Upload images</header>
        <p class="mt-3">
            Please ensure that the information is not blurred and
            the front of your identity card clearly shows your face.
        </p>

        <section class="section-upload mt-4">

            <div class="row d-flex align-items-center justify-content-center">

                <input type="file" class="showImgSize" id="frontuploadFile" accept=".png, .jpg, .jpeg">
                <div class="col-md-6 col-12 col-id-front columns d-flex flex-column align-items-center" id="btn_frontupload">
                    <div class="box box-upload-id d-flex align-items-center justify-content-center flex-column frontImg">
                        <canvas id="frontcanvas" class="showImgSize"></canvas>
                        <img src="../../imgs/id-front.png" alt="" class="front img-upload-id">
                        <p class="upload front">Upload front</p>
                        <p class="file-type front">JPEG or PNG only</p>
                    </div>
                    <p class="upload p-filename" id="frontfileName">nahdine.jpg</p>
                </div>
                
                <input type="file" class="showImgSize" id="uploadFileback" accept=".png, .jpg, .jpeg">
                <div class="col-md-6 col-12 col-id-back columns d-flex flex-column align-items-center" id="btn_backUpload">
                    <div class="box box-upload-id d-flex align-items-center justify-content-center flex-column" >
                        <canvas id="backCanvas" class="showImgSize"></canvas>
                        <img src="../../imgs/id-back.png" alt="" class="back img-upload-id">
                        <p class="upload back">Upload back</p>
                        <p class="file-type back">JPEG or PNG only</p>
                    </div>
                    <p class="upload p-filename" id="backFileName">nahdine.jpg</p>
                </div>
                
            </div>
        </section>
        <footer class="d-flex flex-row mt-5 justify-content-between">
            <button class="btns return-btns ms-2"  id="btn_ReturnChoice"><i class="bi bi-arrow-left"></i>&nbsp;Back</button>
            <button class="btns btn-go text-light px-4 py-2" id="btn_NextMatching">Continue</button>
        </footer>
    <br><br>
    </div>


    

    
</body>
</html>
<?php
    }
    else{
        echo "<script>window.location.href = '../../../RentA/landlordPage/starterPage.php'</script>";
    }
    ?>