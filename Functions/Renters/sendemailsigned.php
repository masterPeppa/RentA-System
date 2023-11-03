<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../DataBase/connection.php';

session_start();
if(isset($_SESSION["rEmail"])){
    $receiver = $_POST["receiver"];
    $selectlandlord = "SELECT * FROM user_landlord WHERE lID ='$receiver'";
    $executeLandlord = mysqli_query($con, $selectlandlord);
    $getLandlordinfo = mysqli_fetch_assoc($executeLandlord);

    $selectrenter = "SELECT * FROM user_renter WHERE rEmail ='".$_SESSION["rEmail"]."'";
    $executerenter = mysqli_query($con, $selectrenter);
    $getrenter = mysqli_fetch_assoc($executerenter);

    $landlordEmail = $getLandlordinfo['lEmail'];

    $identity = "renter";
    $rName = $getrenter["rFname"];
    $rFnameArray = explode(" ",$rName);

    if(count($rFnameArray) == 1){
        $rName = ucwords($rFnameArray[0]);
    }
    else if(count($rFnameArray) == 2){
        $rName = ucwords($rFnameArray[0]) . " " . ucwords($rFnameArray[1]);
    }
    else if(count($rFnameArray) == 3){
        $rName = ucwords($rFnameArray[0]) . " " . ucwords($rFnameArray[1]) . " " . ucwords($rFnameArray[2]);
    }
    //Verification code
    $verificationCode = random_int(100000,999999);
    //Create an instance; passing true enables exceptions
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'renta202223@gmail.com';                     //SMTP username
            $mail->Password   = 'coxxzyzvwiurfisx';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
    
        //Recipients
        $mail->setFrom('renta202223@gmail.com', 'Rent A');
        $mail->addAddress($landlordEmail);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Your lease is already signed.';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>Dear Landlord</h1>
        Hooray! Renter, $rName had already signed your lease agreement. It's time for you
        to <a href='localhost/RentA/landlordPage/manageResidents.php?data=setdate'>set</a> the move-in date. <br> <br> Thank you!
        <br>
        <h4>The Renta App Team</h4></div>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
?>