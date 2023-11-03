<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../DataBase/connection.php';

if(isset($_SESSION["rEmail"])){
    $rEmailAdd = $_SESSION["rEmail"];
    $identity = "renter";
    $rName = $_SESSION["rFname"];
    $rFnameArray = explode(" ",$rName);
    if(count($rFnameArray) == 1){
        $rTempFletter = substr($rFnameArray[0], 0, 1);
        $rTempFname = substr($rFnameArray[0], -strlen($rFnameArray[0])+1, strlen($rFnameArray[0]));
        $rName = strtoupper($rTempFletter) . strtolower($rTempFname);
    }
    else{
        $rTempFletter = substr($rFnameArray[0], 0, 1);
        $rTempFname = substr($rFnameArray[0], -strlen($rFnameArray[0])+1, strlen($rFnameArray[0]));
        $rTempFletter1 = substr($rFnameArray[1], 0, 1);
        $rTempFname1 = substr($rFnameArray[1], -strlen($rFnameArray[1])+1, strlen($rFnameArray[1]));
        $rName = strtoupper($rTempFletter) . strtolower($rTempFname) . " " . strtoupper($rTempFletter1) . strtolower($rTempFname1);
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
            $mail->Password   = 'coxxzyzvwiurfisx';                              //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
    
        //Recipients
        $mail->setFrom('renta202223@gmail.com', 'Rent A');
        $mail->addAddress($rEmailAdd);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Verification Code';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>Hi, $rName</h1>
        We're happy you signed up for RentA. To start
        exploring the RentA App please enter in our verification
        page the code below.
        <h3>$verificationCode</h3> 
        <br>Welcome to our RentA App!
        <h4>The Renta App Team</h4></div>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
else if(isset($_SESSION["lEmail"])){
    $lEmailAdd = $_SESSION["lEmail"];
    $identity = "landlord";
    $lName = $_SESSION["lFname"];
    $lFnameArray = explode(" ",$lName);
    if(count($lFnameArray) == 1){
        $lTempFletter = substr($lFnameArray[0], 0, 1);
        $lTempFname = substr($lFnameArray[0], -strlen($lFnameArray[0])+1, strlen($lFnameArray[0]));
        $lName = strtoupper($lTempFletter) . strtolower($lTempFname);
    }
    else{
        $lTempFletter = substr($lFnameArray[0], 0, 1);
        $lTempFname = substr($lFnameArray[0], -strlen($lFnameArray[0])+1, strlen($lFnameArray[0]));
        $lTempFletter1 = substr($lFnameArray[1], 0, 1);
        $lTempFname1 = substr($lFnameArray[1], -strlen($lFnameArray[1])+1, strlen($lFnameArray[1]));
        $lName = strtoupper($lTempFletter) . strtolower($lTempFname) . " " . strtoupper($lTempFletter1) . strtolower($lTempFname1);
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
        $mail->addAddress($lEmailAdd);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Verification Code';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>Hi, $lName</h1>
        We're happy you signed up for RentA. To start<br>
        exploring the RentA App please enter in our verification<br>
        page the code below.
        <h3>$verificationCode</h3> 
        <br>Welcome to our RentA App!
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