<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../DataBase/connection.php';

session_start();
if(isset($_SESSION["useradmin"])){
    $receiver = $_POST["renterId"];
    $reason = $_POST["reason"];
    $selectrenter = "SELECT * FROM user_renter WHERE rId ='$receiver'";
    $executerenter = mysqli_query($con, $selectrenter);
    $getrenterinfo = mysqli_fetch_assoc($executerenter);

    $renteremail = $getrenterinfo['rEmail'];

    $identity = "renter";
    $rName = $getrenterinfo["rFname"];
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
        $mail->Subject = 'Account Suspension Notice';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>
        Dear $rName,</h1>
        We regret to inform you that your account on our rental platform has been suspended due to <b>$reason</b>. Upholding the safety and integrity of our community remains our utmost priority, and this action aligns with our established policies.
        <br><br>
        As a result, your account has been suspended, and you will not be able to apply for or rent properties within our system.
        <br><br>
        We take this matter seriously and will conduct a thorough review of your account activity. If it is determined that there has been a misunderstanding, your account may be reinstated. However, if the violations are confirmed, further action may be taken, including a permanent suspension.
        <br><br>
        Should you have any questions or wish to provide additional information or context regarding your account suspension, please contact our support team at [Support Email or Phone Number]. We will promptly investigate your case and keep you informed of any developments.
        <br><br>
        We encourage all users to adhere to our policies and guidelines to ensure a safe and positive experience for everyone within our community. We appreciate your cooperation in this matter.
        <br><br>
        Thank you for your understanding.
        <br><br>
        Sincerely,
        <h4>RentA Team</h4>
        <a href='gmail.com' target='_blank'>renta202223@gmail.com<a>
        <br><br></div>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }
}
?>