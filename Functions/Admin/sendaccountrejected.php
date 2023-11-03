<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../DataBase/connection.php';

session_start();
if(isset($_SESSION["useradmin"])){
    $receiver = $_POST["receiver"];
    $reason = $_POST["reason"];
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
        $mail->Subject = 'Verification Rejection Notice';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>
        Dear $lName,</h1>
        We regret to inform you that your verification request has been rejected. 
        The reason for this decision is as follows: 
        <br><br>
        <b>$reason</b>
        <br><br>
        We understand the importance of the verification process and its significance for our community. If you believe there has been an error or wish to address the issues raised, please contact our support team for further assistance.
        <br><br>
        We appreciate your understanding and cooperation as we work together to maintain the integrity of our system.
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