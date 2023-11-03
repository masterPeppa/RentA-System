<?php
    //Start Session
    session_start();
    //Connection of database
    include('../../DataBase/connection.php');
    include('../getIp.php');
    //user information
    $lFname = $_SESSION['lFname'];
    $lLname = $_SESSION['lLname'];
    $lEmail = $_SESSION['lEmail'];
    $lNumber = $_SESSION['lNumber'];
    $datepicker_input = $_SESSION['datepicker_input'];
    $lPassword = $_SESSION['lPassword'];
    $lConfirmPassword = $_SESSION['lConfirmPassword'];
    $region_text = $_SESSION['region_text'];
    $province_text = $_SESSION['province_text'];
    $city_text = $_SESSION['city_text'];
    $barangay_text = $_SESSION['barangay_text'];
    $lHouseNo = $_SESSION['lHouseNo'];
    $lStatus = "not-verified";
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = date('Y-m-d H:i:s');
    //Renter Device IP Address
    $lUserIp = getIPAddress();
    //hash password in database
    $lHashPassword = password_hash($lConfirmPassword, PASSWORD_DEFAULT);

        //set the +63 to 09
        $lMobileNum = "0" . "$lNumber";
        //check if the first name has a second name
        $lFnameArray = explode(" ",$lFname);
        if(count($lFnameArray) == 1){
            $lTempFletter = substr($lFnameArray[0], 0, 1);
            $lTempFname = substr($lFnameArray[0], -strlen($lFnameArray[0])+1, strlen($lFnameArray[0]));
            $lFname = strtoupper($lTempFletter) . strtolower($lTempFname);
        }
        else{
            $lTempFletter = substr($lFnameArray[0], 0, 1);
            $lTempFname = substr($lFnameArray[0], -strlen($lFnameArray[0])+1, strlen($lFnameArray[0]));

            $lTempFletter1 = substr($lFnameArray[1], 0, 1);
            $lTempFname1 = substr($lFnameArray[1], -strlen($lFnameArray[1])+1, strlen($lFnameArray[1]));
            $lFname = strtoupper($lTempFletter) . strtolower($lTempFname) . " " . strtoupper($lTempFletter1) . strtolower($lTempFname1);
        }

        //check if the last name has a second last name
        $lLnameArray = explode(" ",$lLname);
        if(count($lLnameArray) == 1){
            $lTempLletter = substr($lLnameArray[0], 0, 1);
            $lTempLname = substr($lLnameArray[0], -strlen($lLnameArray[0])+1, strlen($lLnameArray[0]));
            $lLname = strtoupper($lTempLletter) . strtolower($lTempLname);
        }
        else{
            $lTempLletter = substr($lLnameArray[0], 0, 1);
            $lTempLname = substr($lLnameArray[0], -strlen($lLnameArray[0])+1, strlen($lLnameArray[0]));

            $lTempLletter1 = substr($lLnameArray[1], 0, 1);
            $lTempLname1 = substr($lLnameArray[1], -strlen($lLnameArray[1])+1, strlen($lLnameArray[1]));
            $lLname = strtoupper($lTempLletter) . strtolower($lTempLname) . " " . strtoupper($lTempLletter1) . strtolower($lTempLname1);
        }
        //function for setting a default profile for new user
        //to set the first letter of first
        $lInitial = substr($lFname, 0, 1);
        $lLetters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
        for($i = 0; $i <= count($lLetters); $i++){
            if(strtoupper($lInitial) == strtoupper($lLetters[$i])){
                $lDefaultProfile = "../imgs/defaultProfile/".$lLetters[$i].".png";
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
        $lInsertData = "INSERT INTO user_landlord (lFname, lLname, lEmail, lPassword, lNumber, lBdate, lRegion, lProvince, lCity, lBrgy, lHouseNo, lStatus, lImgProfile, lIP, backupPhrase, date_created)
        VALUES ('$lFname','$lLname','$lEmail','$lHashPassword','$lMobileNum','$datepicker_input','$region_text','$province_text','$city_text', '$barangay_text', '$lHouseNo', '$lStatus', '$lDefaultProfile', '$lUserIp', '$security', '$currentDateTime')";
        $lSql_execute = mysqli_query($con, $lInsertData);
        
    mysqli_close($con);

    if(isset($_GET['action']) && $_GET['action'] != ''){
        echo "<script>window.location.href = '../../landlordPage/Verification/idVerification.php?action=listproperty';</script>";
    }
    else{
        echo "<script>window.location.href = '../../landlordPage/Verification/idVerification.php';</script>";
    }
?>