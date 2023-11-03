<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../DataBase/connection.php';
if($email != ""){
    $rFnameArray = explode(" ",$first_name);
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
    $code = uniqid(true);
    $createCode = "INSERT INTO reset_password (user_email, link_code) VALUES ('$email','$code')";
    $insertCode =  mysqli_query($con, $createCode);
    //Create an instance; passing true enables exceptions
    $mail = new PHPMailer(true);
    if(!$insertCode){
        exit("Error");
    }
    try {
        $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'renta202223@gmail.com';                     //SMTP username
            $mail->Password   = 'coxxzyzvwiurfisx';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                      //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS
    
        //Recipients
        $mail->setFrom('renta202223@gmail.com', 'Rent A');
        $mail->addAddress($email);     //Add a recipient
    
        //Content
        $ResetUrl = $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/changePassword.php?code=$code";
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'RentA';
        $mail->Body = "<h1>Hi $rName</h1>
        We're sending you this email because you requested<br>
        a password reset. Click on this <a href='$ResetUrl'>link</a> to reset your password.
        <br><br>If you didn't request a password reset, you can ignore and delete
        <br>this email. Your password will not be changed
        <br><h4>The Renta App Team</h4>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
        $delete_query = mysqli_query($con, "DELETE FROM reset_password WHERE code='$code'");
    }
}
else{
    echo "<script>alert('Please sign up again, sorry for the inconvenience, \nthere was just a system problem')</script>";
}
?>