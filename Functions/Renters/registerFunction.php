<?php
    //Start Session
    session_start();
    //Connection of database
    include('../../DataBase/connection.php');
    include('../getIp.php');
    //user information
    $rFname = $_SESSION['rFname'];
    $rLname = $_SESSION['rLname'];
    $rEmail = $_SESSION['rEmail'];
    $rNumber = $_SESSION['rNumber'];
    $datepicker_input = $_SESSION['datepicker_input'];
    $rOccupation = $_SESSION['rOccupation'];
    $rConfirmPassword = $_SESSION['rPassword'];
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');
    //Renter Device IP Address
    $rUserIp = getIPAddress();
    //hash password in database
    $rHashPassword = password_hash($rConfirmPassword, PASSWORD_DEFAULT);
    //by default status is no because its no verified
    $rStatus = "NO";

        //set the +63 to 09
        $rMobileNum = "0" . "$rNumber";
        //check if the first name has a second name
        $rFnameArray = explode(" ",$rFname);
        if(count($rFnameArray) == 1){
            $rTempFletter = substr($rFnameArray[0], 0, 1);
            $rTempFname = substr($rFnameArray[0], -strlen($rFnameArray[0])+1, strlen($rFnameArray[0]));
            $rFname = strtoupper($rTempFletter) . strtolower($rTempFname);
        }
        else{
            $rTempFletter = substr($rFnameArray[0], 0, 1);
            $rTempFname = substr($rFnameArray[0], -strlen($rFnameArray[0])+1, strlen($rFnameArray[0]));

            $rTempFletter1 = substr($rFnameArray[1], 0, 1);
            $rTempFname1 = substr($rFnameArray[1], -strlen($rFnameArray[1])+1, strlen($rFnameArray[1]));
            $rFname = strtoupper($rTempFletter) . strtolower($rTempFname) . " " . strtoupper($rTempFletter1) . strtolower($rTempFname1);
        }

        //check if the last name has a second last name
        $rLnameArray = explode(" ",$rLname);
        if(count($rLnameArray) == 1){
            $rTempLletter = substr($rLnameArray[0], 0, 1);
            $rTempLname = substr($rLnameArray[0], -strlen($rLnameArray[0])+1, strlen($rLnameArray[0]));
            $rLname = strtoupper($rTempLletter) . strtolower($rTempLname);
        }
        else{
            $rTempLletter = substr($rLnameArray[0], 0, 1);
            $rTempLname = substr($rLnameArray[0], -strlen($rLnameArray[0])+1, strlen($rLnameArray[0]));

            $rTempLletter1 = substr($rLnameArray[1], 0, 1);
            $rTempLname1 = substr($rLnameArray[1], -strlen($rLnameArray[1])+1, strlen($rLnameArray[1]));
            $rLname = strtoupper($rTempLletter) . strtolower($rTempLname) . " " . strtoupper($rTempLletter1) . strtolower($rTempLname1);
        }
        //function for setting a default profile for new user
        //to set the first letter of first
        $rInitial = substr($rFname, 0, 1);
        $rLetters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        for($i = 0; $i <= count($rLetters); $i++){
            if(strtoupper($rInitial) == strtoupper($rLetters[$i])){
                $rDefaultProfile = "../imgs/defaultProfile/".$rLetters[$i].".png";
                break;
            }
        }
        $sec_Phrase=array("home","reside","lodging","kin","roof","renta","attic","interior","cabin", "occupant", "fork", "terrace");

        shuffle($sec_Phrase);  // Shuffle the array in place
        $security = "";

        foreach ($sec_Phrase as $word_Phrase) {
            if($security == ""){
                $security .= $word_Phrase;
            } 
            else{
                $security .= " $word_Phrase";
            }
        }
        $rInsertData = "INSERT INTO user_renter (rFname, rLname, rEmail, rPass, rNum, rBday, rOccupation, rUserIp, rImgProfile, rStatus, backupPhrase, date_registered)
        VALUES ('$rFname','$rLname','$rEmail','$rHashPassword','$rMobileNum','$datepicker_input','$rOccupation','$rUserIp','$rDefaultProfile','$rStatus', '$security', '$currentDateTime')";
        $rSql_execute = mysqli_query($con, $rInsertData);
        
    mysqli_close($con);

    echo "
    <script>window.location.href = '../../RentersPage/backupPhrase.php';</script>";
    
?>