<?php
	session_start();
	require "../../DataBase/connection.php";
	//get the user input in login page
    $rEmail = $_POST['rEmail'];
    $uPassword = $_POST['rPassword'];
    $landlordid = $_POST['lId'];
    $dateid = $_POST['dateid'];
    //checking if the email is exist in the database of renters
    $select_renter = "SELECT * FROM user_renter WHERE rEmail='$rEmail'";
    $select_renter_executed=mysqli_query($con, $select_renter);
    $renter_count = mysqli_num_rows($select_renter_executed);
    $renter_data = mysqli_fetch_assoc($select_renter_executed);

    //checking if the email is exist in the database of renter and not blocked
    $select_renter_blocked = "SELECT * FROM user_renter WHERE rEmail='$rEmail' AND rStatus='blocked'";
    $select_renter_executed_blocked=mysqli_query($con, $select_renter_blocked);
    $renter_count_blocked = mysqli_num_rows($select_renter_executed_blocked);
    $renter_data_blocked = mysqli_fetch_assoc($select_renter_executed_blocked);

    $select_landlord = "SELECT * FROM user_landlord WHERE lEmail='$rEmail'";
    $select_landlord_executed=mysqli_query($con, $select_landlord);
    $landlord_count = mysqli_num_rows($select_landlord_executed);

    if($renter_count_blocked > 0){
        echo "blocked";
    }
    else if ($renter_count > 0) {
        if($renter_data['rEmail'] == $rEmail){
            //getting the firstname of user in database
            $firstName = $renter_data['rFname'];
            //if user input password matched to the hashed password in database
            if (password_verify($uPassword, $renter_data['rPass'])) {
                $_SESSION['rEmail'] = $rEmail;
                $_SESSION['firstName'] = $firstName;
                $_SESSION['renterId'] = $renter_data['rId'];
                if($landlordid != "null" && $landlordid != "1"){
                    echo "../messages.php?landlordId=$landlordid";
                }
                else if($dateid != "null"){
                    echo "application4Move.php";
                }
                else if($landlordid == "1"){
                    echo "../RentersPage/application1Submit.php";
                }
                else if(isset($_SESSION['applyProperty'])){
                    echo "../RentersPage/application1Submit.php";
                }
                else{
                    echo "success";
                }
            }
            //if the password doesn't match
            else{
                echo "incorrect pass";
            }
        }
        else{
            echo "not exist";
        }
    }
    else if($uPassword == "group5" && $rEmail == "renta"){
        echo "../adminPage/adminDashboard.php";
        $_SESSION['useradmin'] = "admin";
    }
    else if($landlord_count > 0){
        echo "invalid";
    }
    //if the email doesn't exist in database
    else{
        echo "not exist";
    }
?>
