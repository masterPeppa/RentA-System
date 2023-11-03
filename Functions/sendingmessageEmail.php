<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../DataBase/connection.php';

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
        $mail->Subject = 'RentA';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>You've received a message.</h1>
        Renter, $rName sent you a message. <a href='localhost/RentA/messages.php?renterId=".$getrenter['rId']."'>Check it out.</a> 
        <br>
        <h4>The Renta App Team</h4></div>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
else if(isset($_SESSION["lEmail"])){
    $receiver = $_POST["receiver"];
    $selectlandlord = "SELECT * FROM user_landlord WHERE lEmail ='".$_SESSION["lEmail"]."'";
    $executelandlord = mysqli_query($con, $selectlandlord);
    $getlandlord = mysqli_fetch_assoc($executelandlord);
    
    $selectrenter = "SELECT * FROM user_renter WHERE rId ='".$receiver."'";
    $executerenter = mysqli_query($con, $selectrenter);
    $getrenterinfo = mysqli_fetch_assoc($executerenter);

    $renteremail = $getrenterinfo['rEmail'];

    $identity = "landlord";
    $lName = $getlandlord["lFname"];
    $lFnameArray = explode(" ",$lName);

    if(count($lFnameArray) == 1){
        $lName = ucwords($lFnameArray[0]);
    }
    else if(count($lFnameArray) == 2){
        $lName = ucwords($lFnameArray[0]) . " " . ucwords($lFnameArray[1]);
    }
    else if(count($lFnameArray) == 3){
        $lName = ucwords($lFnameArray[0]) . " " . ucwords($lFnameArray[1]) . " " . ucwords($lFnameArray[2]);
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
        $mail->addAddress($renteremail);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Message';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>You've received a message.</h1>
        Landlord, $lName sent you a message. <br>
        <a href='localhost/RentA/messages.php?landlordId=".$getlandlord['lID']."'>Check it out.</a>  
        <br>
        <h4>The Renta App Team</h4></div>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
else if($_SESSION['identity'] == "renter"){
    echo "<script>alert('Apologies for the inconvenience. Please sign up again.');
    window.location.href = '../RentersPage/Starterpage.php';</script>";
    session_destroy();
}
else if($_SESSION['identity'] == "landlord"){
    echo "<script>alert('Apologies for the inconvenience. Please sign up again.');
    window.location.href = '../landlordPage/Starterpage.php';</script>";
    session_destroy();
}
?>