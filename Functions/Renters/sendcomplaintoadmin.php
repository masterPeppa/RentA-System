<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';
require '../../DataBase/connection.php';

session_start();
if(isset($_SESSION["rEmail"])){
    $complainant = $_POST["complainant"];
    $defendant = $_POST["defendant"];
    $reason = $_POST["reason"];

    $selectlandlord = "SELECT * FROM user_landlord WHERE lID ='$defendant'";
    $executeLandlord = mysqli_query($con, $selectlandlord);
    $getLandlordinfo = mysqli_fetch_assoc($executeLandlord);

    $selectrenter = "SELECT * FROM user_renter WHERE rEmail ='$complainant'";
    $executerenter = mysqli_query($con, $selectrenter);
    $getrenter = mysqli_fetch_assoc($executerenter);

    $receiver = 'renta202223@gmail.com';

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
        $mail->addAddress($receiver);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Complaint.';
        $mail->Body = "<div style='background-color: #EDE4FF; padding: 25px; border-radius: 20px;'><h1 style='color: #8c52ff'>Complaint Report</h1>
        The renter has lodged a complaint about their landlord due to the following reason:
        <br><br>
        $reason
        <br> <br> Thank you!
        <br>
        <h4>The Renta App Team</h4></div>";
    
        $mail->send();
        
    } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}')</script>";
    }

    date_default_timezone_set('Asia/Manila');
    $save_time = date("Y-m-d H:i:s");

    $insertAdminNotif = "INSERT INTO admin_notification (landlord_id, renter_id, notif_info, date_notif, notif_status) 
    VALUES ('$complainant', '$defendant', 'Complaints', '$save_time', 'unread')";
    $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);

    $insertComplaints = "INSERT INTO complaints_data (landlord_id, reporter_id, report_reason, report_date) 
    VALUES ('$defendant', '$complainant', '$reason', '$save_time')";
    $executeInsertComplaints = mysqli_query($con, $insertComplaints);
}
?>