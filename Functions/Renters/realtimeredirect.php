<?php
    session_start();
    include('../../DataBase/connection.php');
    $renterEmail = $_SESSION['rEmail'];
    $selectUser = "SELECT * FROM user_renter WHERE rEmail ='$renterEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $getUser = mysqli_fetch_assoc($executeSelectUser);
    
    $select_accepted = "SELECT * FROM application_data WHERE renter_id='".$getUser['rId']."' AND send_status = '2' AND agreement != 'finished'";
    $checked_accepted = mysqli_query($con, $select_accepted);

    $select_rejected = "SELECT * FROM application_data WHERE renter_id='".$getUser['rId']."' AND send_status = 'rejected' AND agreement != 'finished'";
    $checked_rejected = mysqli_query($con, $select_rejected);

    //update the image in data base
    $notexist = "SELECT * FROM application_data WHERE renter_id='".$getUser['rId']."' AND send_status = '1' AND agreement != 'finished'";
    $executeexist = mysqli_query($con, $notexist);

    //update the image in data base
    $select_lease = "SELECT * FROM lease WHERE renter_id ='".$getUser['rId']."' AND (sent_status='sent1' OR sent_status='sent2')";
    $execute_lease = mysqli_query($con, $select_lease);
    $checklease = mysqli_fetch_assoc($execute_lease);

    $accept = mysqli_num_rows($checked_accepted);
    $reject = mysqli_num_rows($checked_rejected);
    $exist = mysqli_num_rows($executeexist);
    $lease = mysqli_num_rows($execute_lease);

    if($accept > 0 && $lease == 0){
        echo "accepted";
    }
    else if($reject > 0){
        echo "rejected";
    }
    else if($exist == 0){
        echo "not exist";
    }
    else if($lease > 0){
        if($checklease['sent_status'] == "sent1"){
            echo "lease1";
        }
        else if($checklease['sent_status'] == "sent2"){
            echo "lease2";
        }
    }
    else{
        echo "not yet";
    }
    

    mysqli_close($con);
?>