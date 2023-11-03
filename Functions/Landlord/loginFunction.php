<?php
	session_start();
	require "../../DataBase/connection.php";
	//get the user input in login page
    $landlordEmail = $_POST['landlordEmail'];
    $landlordPassword = $_POST['landlordPassword'];
    $renterid = $_POST['rId'];
    $landlordAction = $_POST['landlordAction'];
    $redirectinfo = $_POST['pageInfo'];
    //checking if the email is exist in the database of landlord
    $select_landlord = "SELECT * FROM user_landlord WHERE lEmail='$landlordEmail'";
    $select_landlord_executed=mysqli_query($con, $select_landlord);
    $landlord_count = mysqli_num_rows($select_landlord_executed);
    $landlord_data = mysqli_fetch_assoc($select_landlord_executed);

    //checking if the email is exist in the database of landlord and not blocked
    $select_landlord_blocked = "SELECT * FROM user_landlord WHERE lEmail='$landlordEmail' AND lStatus='blocked'";
    $select_landlord_executed_blocked=mysqli_query($con, $select_landlord_blocked);
    $landlord_count_blocked = mysqli_num_rows($select_landlord_executed_blocked);
    $landlord_data_blocked = mysqli_fetch_assoc($select_landlord_executed_blocked);

    //checking if the email is exist in the database of renters
    $select_renter = "SELECT * FROM user_renter WHERE rEmail='$landlordEmail'";
    $select_renter_executed=mysqli_query($con, $select_renter);
    $renter_count = mysqli_num_rows($select_renter_executed);
    if($landlord_count_blocked > 0){
        echo "blocked";
    }
    else if($landlord_count > 0)
        {
            if($landlord_data['lEmail'] == $landlordEmail){
                //getting the firstname of user in database
                $firstName = $landlord_data['lFname'];
                //if user input password matched to the hashed password in database
                if (password_verify($landlordPassword, $landlord_data['lPassword'])) {
                    $_SESSION['lEmail'] = $landlordEmail;
                    $_SESSION['firstName'] = $firstName;
                    $_SESSION['landlordId'] = $landlord_data['lID'];
                    if($renterid != "null"){
                        echo "../messages.php?renterId=$renterid";
                    }
                    else if($redirectinfo != "null"){
                        echo "manageResidents.php";
                    }
                    else if($landlordAction != "null" && $landlord_data['lStatus'] == "fully-verified") {
                        echo "listAProperty.php";
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
        else if($landlordPassword == "group5" && $landlordEmail == "renta"){
            echo "../adminPage/adminDashboard.php";
            $_SESSION['useradmin'] = "admin";
        }
        else if($renter_count > 0){
            echo "invalid";
        }
        //if the email doesn't exist in database
        else{
            echo "not exist";
        }
        ?>