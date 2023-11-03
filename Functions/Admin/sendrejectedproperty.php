<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../DataBase/connection.php';

session_start();
if(isset($_SESSION["useradmin"])){
    $propertyId = $_POST["propertyId"];
    $selectproperty = "SELECT * FROM landing_properties WHERE propertyID ='$propertyId'";
    $executeproperty = mysqli_query($con, $selectproperty);
    $getpropertyinfo = mysqli_fetch_assoc($executeproperty);

    $receiver = $getpropertyinfo['landlord_id'];
    $selectlandlord = "SELECT * FROM user_landlord WHERE lID ='$receiver'";
    $executelandlord = mysqli_query($con, $selectlandlord);
    $getlandlordinfo = mysqli_fetch_assoc($executelandlord);

    $landlordemail = $getlandlordinfo['lEmail'];

    $identity = "landlord";
    $lName = $getlandlordinfo["lFname"];
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
        $mail->addAddress($landlordemail);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Property Rejection Notification: "'.$getpropertyinfo['propertyTitle'].'"';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>
        Dear $lName,</h1>
        We regret to inform you that your property listing, ".'"'.$getpropertyinfo['propertyTitle'].'"'.". has not been approved and will not be displayed on our platform.
        <br><br>
        Our team carefully reviewed your property listing, and unfortunately, it does not meet our current criteria. If you have any questions or would like feedback on how to improve your listing, please don't hesitate to contact us.
        <br><br>
        Thank you for considering our platform for your ".'"'.$getpropertyinfo['propertyTitle'].'"'." listing. We appreciate your understanding and hope to assist you with future listings.
        <br><br>
        Best regards,
        <h4>RentA Team</h4>
        <a href='gmail.com' target='_blank'>renta202223@gmail.com<a>
        <br><br></div>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
?>