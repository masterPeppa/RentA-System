<?php
    //Connection of database
    include('../../DataBase/connection.php');
    //start Session
    session_start();
    //getting the email address in textbox
    $checkingEmail = ucwords($_REQUEST["q"]);
    //we set as array the value we get from the java script to separate them
    $arrayPropertyList = explode("~?", $checkingEmail);

    if($arrayPropertyList[21] == "Null"){
    //We separate the values of checkboxes to remove strayed images
    $spacePropertyList = explode("~!", $arrayPropertyList[12]);

    $amenitiesPropertyList = explode("~-", $arrayPropertyList[20]);

    $propertyAmenities = implode(', ', $amenitiesPropertyList);
    //array list for removing decision
    $amenitiesCheckList = array("Living Room", "Dining Room", "Bedrooms", "Bathrooms", "Kitchen", "Laundry Room", "StudyOffice", "Entertainment Room", "Walk In Closet", "Hallways", "Staircase"
    , "Other", "Garden", "Outdoor Kitchen", "Front Yard", "Back Yard", "Patio", "Terrace", "Deck", "Play Area", "Swimming Pool", "Driveway", "Walkways"
    , "Storage Shed");
    //array list for database accessing
    $amenitiesCheckData = array("imgLivingroom", "imgDiningroom", "imgBedroom", "imgBathroom", "imgKitchen", "imgLaundryroom", "imgStudyOffice", "imgEntertainmentroom", "imgWalkInCloset", "imgHallway", "imgStaircase"
    , "imgOther", "imgGarden", "imgOutKitchen", "imgFrontyard", "imgBackyard", "imgPatio", "imgTerrace", "imgDeck", "imgPlayarea", "imgPool", "imgDriveway", "imgWalkways"
    , "imgStorageshed");
    //array of image session
    $setOfsessionArray = array('imgAmenitiesLivingRoom', 'imgAmenitiesDiningroom', 'imgAmenitiesBedrooms'
    , 'imgAmenitiesBathrooms', 'imgAmenitiesKitchen', 'imgAmenitiesLaundryRoom', 'imgAmenitiesStudyOffice', 'imgAmenitiesEntertainmentRoom', 'imgAmenitiesWalkInCloset',
    'imgAmenitiesHallways', 'imgAmenitiesStaircase', 'imgAmenitiesOther', 'imgAmenitiesGarden', 'imgAmenitiesOutdoorKitchen', 'imgAmenitiesFrontYard',
    'imgAmenitiesBackYard', 'imgAmenitiesPatio', 'imgAmenitiesTerrace', 'imgAmenitiesDeck', 'imgAmenitiesPlayArea', 'imgAmenitiesSwimmingPool', 'imgAmenitiesDriveway',
    'imgAmenitiesWalkways', 'imgAmenitiesStorageShed', 'imgFeatured3', 'imgFeatured2', 'imgFeatured1');
    //filename array
    $filenameArraylist = $_SESSION['sessionArray'];
    
    $lEmail = $_SESSION['lEmail'];

    $activeCheckbox = [];

    $uncheckedValues = [];
    //date created
    
    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");
    $txtdescription = mysqli_real_escape_string($con, $arrayPropertyList[2]);

    //set title and property name as pascal case
    //Title
    $TitleArray = explode(" ",$arrayPropertyList[1]);
    if(count($TitleArray) == 1){
        $TemporaryTitle = substr($TitleArray[0], 0, 1);
        $Temporary2ndTitle = substr($TitleArray[0], -strlen($TitleArray[0])+1, strlen($TitleArray[0]));
        $propertyTitle = strtoupper($TemporaryTitle) . strtolower($Temporary2ndTitle);
    }
    else if(count($TitleArray) == 2){
        $TemporaryTitle = substr($TitleArray[0], 0, 1);
        $Temporary2ndTitle = substr($TitleArray[0], -strlen($TitleArray[0])+1, strlen($TitleArray[0]));

        $TemporaryTitle1 = substr($TitleArray[1], 0, 1);
        $Temporary2ndTitle1 = substr($TitleArray[1], -strlen($TitleArray[1])+1, strlen($TitleArray[1]));

        $propertyTitle = strtoupper($TemporaryTitle) . strtolower($Temporary2ndTitle) . " " . strtoupper($TemporaryTitle1) . strtolower($Temporary2ndTitle1);
    }
    else if(count($TitleArray) == 3){
        $TemporaryTitle = substr($TitleArray[0], 0, 1);
        $Temporary2ndTitle = substr($TitleArray[0], -strlen($TitleArray[0])+1, strlen($TitleArray[0]));

        $TemporaryTitle1 = substr($TitleArray[1], 0, 1);
        $Temporary2ndTitle1 = substr($TitleArray[1], -strlen($TitleArray[1])+1, strlen($TitleArray[1]));

        $TemporaryTitle2 = substr($TitleArray[2], 0, 1);
        $Temporary2ndTitle2 = substr($TitleArray[2], -strlen($TitleArray[2])+1, strlen($TitleArray[2]));

        $propertyTitle = strtoupper($TemporaryTitle) . strtolower($Temporary2ndTitle) . " " . strtoupper($TemporaryTitle1) . strtolower($Temporary2ndTitle1) . " " . strtoupper($TemporaryTitle2) . strtolower($Temporary2ndTitle2);
    }
    else if(count($TitleArray) == 4){
        $TemporaryTitle = substr($TitleArray[0], 0, 1);
        $Temporary2ndTitle = substr($TitleArray[0], -strlen($TitleArray[0])+1, strlen($TitleArray[0]));

        $TemporaryTitle1 = substr($TitleArray[1], 0, 1);
        $Temporary2ndTitle1 = substr($TitleArray[1], -strlen($TitleArray[1])+1, strlen($TitleArray[1]));

        $TemporaryTitle2 = substr($TitleArray[2], 0, 1);
        $Temporary2ndTitle2 = substr($TitleArray[2], -strlen($TitleArray[2])+1, strlen($TitleArray[2]));

        $TemporaryTitle3 = substr($TitleArray[3], 0, 1);
        $Temporary2ndTitle3 = substr($TitleArray[3], -strlen($TitleArray[3])+1, strlen($TitleArray[3]));

        $propertyTitle = strtoupper($TemporaryTitle) . strtolower($Temporary2ndTitle) . " " . strtoupper($TemporaryTitle1) . strtolower($Temporary2ndTitle1) . " " . strtoupper($TemporaryTitle2) . strtolower($Temporary2ndTitle2) . " " . strtoupper($TemporaryTitle3) . strtolower($Temporary2ndTitle3);
    }
    //get id
    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);
    $lId = $lgetId['lID'];
    
    for($i = 0; $i < count($spacePropertyList); $i++){
        for($j = 0; $j < count($amenitiesCheckData); $j++){
            if($spacePropertyList[$i] == $amenitiesCheckList[$j]){
                $activeCheckbox[] = $amenitiesCheckData[$j];
                break;
            }
        }
    }
    // Initialize the variable before the loop to get the value inside a loop
    $setOfArrayNumbers = "";

    for ($m = 0; $m < count($activeCheckbox); $m++) {
        for ($n = 0; $n < count($amenitiesCheckList); $n++) {
            if ($activeCheckbox[$m] != $amenitiesCheckData[$n]) {
                if ($n == 23) {
                    // Concatenate with the existing value this is to separate the values and set as array
                    $setOfArrayNumbers .= $n . "---"; 
                } else {
                    // Concatenate with the existing value
                    $setOfArrayNumbers .= $n . ","; 
                }
            }
        }
    }
    $arrayValues = explode("---", $setOfArrayNumbers);
    $firstArray = explode(",", $arrayValues[0]); // Get the values from the first exploded array
    $commonValues = $firstArray; // Initialize $commonValues with the values from the first array

    for ($q = 1; $q < count($arrayValues); $q++) {
        $getArrayValue = explode(",", $arrayValues[$q]);
        // Find the common values in all arrays
        $commonValues = array_intersect($commonValues, $getArrayValue);
        // Code to execute only during the last iteration
        foreach ($commonValues as $number) {
            if($q == count($arrayValues) - 2){
                $uncheckedValues[] = $number;
            }
            else if($q == count($arrayValues) - 1){
                $uncheckedValues[] = $number;
            }
        }
    }
    for($a = 0; $a < 24; $a++){
        for($b = 0; $b < count($uncheckedValues); $b++){
            $num = $uncheckedValues[$b];
            $space1 = trim($amenitiesCheckData[$num] . '1');
            $space2 = trim($amenitiesCheckData[$num] . '2');
            $selectimgValue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
            $executeimgValue = mysqli_query($con, $selectimgValue);
            $getimgValue = mysqli_fetch_assoc($executeimgValue);
            $property_id = $getimgValue['propertyID'];
            if($a == $uncheckedValues[$b]){

                if($a == 23 && $a == $num){

                    $updateData1 = "UPDATE landing_properties_new SET $space1 = NULL, $space2 = NULL, publishing_status='Published', occular_visit_status='not_yet' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate1 = mysqli_query($con, $updateData1);

                    $updateData = "UPDATE landing_properties SET propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                    propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                    maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                    propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                    propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                    propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', publishing_status='Published', occular_visit_status='not_yet', createdTime='$created_Time', house_num='$arrayPropertyList[22]' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate = mysqli_query($con, $updateData);

                    $insertAdminNotif = "INSERT INTO admin_notification (landlord_id, property_id, notif_info, date_notif, notif_status) VALUES ('$lId', '$property_id', 'List-Property', '$created_Time', 'unread')";
                    $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);
                    
                    foreach ($_SESSION['sessionArray'] as $key => $value) {
                        unset($_SESSION['sessionArray'][$key]);
                    }
                    for($p = 0; $p < count($setOfsessionArray); $p++){
                        if(isset($_SESSION[$setOfsessionArray[$p]])){
                            unset($_SESSION[$setOfsessionArray[$p]]);
                        }
                    }
                    echo "../viewProperty.php?id=".$property_id;
                    break;
                }
                else if($a == 23 && $a != $num){
                    
                    $updateData1 = "UPDATE landing_properties_new SET $space1 = NULL, $space2 = NULL, publishing_status='Published', occular_visit_status='not_yet' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate1 = mysqli_query($con, $updateData1);

                    $updateData = "UPDATE landing_properties SET $amenitiesCheckData[$num] = NULL, propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                    propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                    maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                    propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                    propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                    propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', publishing_status='Published', occular_visit_status='not_yet', createdTime='$created_Time', house_num='$arrayPropertyList[22]' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate = mysqli_query($con, $updateData);

                    $insertAdminNotif = "INSERT INTO admin_notification (landlord_id, property_id, notif_info, date_notif, notif_status) VALUES ('$lId', '$property_id', 'List-Property', '$created_Time', 'unread')";
                    $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);
                    
                    foreach ($_SESSION['sessionArray'] as $key => $value) {
                        unset($_SESSION['sessionArray'][$key]);
                    }
                    for($p = 0; $p < count($setOfsessionArray); $p++){
                        if(isset($_SESSION[$setOfsessionArray[$p]])){
                            unset($_SESSION[$setOfsessionArray[$p]]);
                        }
                    }
                    if(isset($getimgValue[$amenitiesCheckData[$num]])){
                        //get the value of specific image column in db
                        $imgDir = $getimgValue[$amenitiesCheckData[$num]];
                        //if the value of imgDir exist
                        if (file_exists($imgDir)) {
                            //the session value matched in the directory willbe deleted
                            if (unlink($imgDir)) {
                                //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                                unset($_SESSION[$imgDir]);
                            }
                        }
                    }
                    echo "../viewProperty.php?id=".$property_id;
                    break;
                }
                else{
                    if(isset($getimgValue[$amenitiesCheckData[$num]])){
                        //get the value of specific image column in db
                        $imgDir = $getimgValue[$amenitiesCheckData[$num]];
                        //if the value of imgDir exist
                        if (file_exists($imgDir)) {
                            //the session value matched in the directory willbe deleted
                            if (unlink($imgDir)) {
                                //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                                unset($_SESSION[$imgDir]);
                            }
                        }
                    }

                    $updateData1 = "UPDATE landing_properties_new SET $space1 = NULL, $space2 = NULL WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate1 = mysqli_query($con, $updateData1);

                    $updateData = "UPDATE landing_properties SET $amenitiesCheckData[$num] = NULL, propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                    propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                    maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                    propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                    propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                    propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', createdTime='$created_Time', house_num='$arrayPropertyList[22]' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate = mysqli_query($con, $updateData);
                }
                break;
            }
            else if($a == $uncheckedValues[$b] && $a == 23){
                    
                $updateData1 = "UPDATE landing_properties_new SET publishing_status='Published', occular_visit_status='not_yet' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate1 = mysqli_query($con, $updateData1);

                $updateData = "UPDATE landing_properties SET propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                    propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                    maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                    propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                    propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                    propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', createdTime='$created_Time', house_num='$arrayPropertyList[22]' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate = mysqli_query($con, $updateData);

                    $insertAdminNotif = "INSERT INTO admin_notification (landlord_id, property_id, notif_info, date_notif, notif_status) VALUES ('$lId', '$property_id', 'List-Property', '$created_Time', 'unread')";
                    $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);
                
                foreach ($_SESSION['sessionArray'] as $key => $value) {
                    unset($_SESSION['sessionArray'][$key]);
                }
                for($p = 0; $p < count($setOfsessionArray); $p++){
                    if(isset($_SESSION[$setOfsessionArray[$p]])){
                        unset($_SESSION[$setOfsessionArray[$p]]);
                    }
                }
                echo "../viewProperty.php?id=".$property_id;
                break;
            }
            else if($a != $uncheckedValues[$b] && $a == 23){

                $updateData1 = "UPDATE landing_properties_new SET publishing_status='Published', occular_visit_status='not_yet' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate1 = mysqli_query($con, $updateData1);

                $updateData = "UPDATE landing_properties SET propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                    propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                    maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                    propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                    propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                    propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', publishing_status='Published', occular_visit_status='not_yet', createdTime='$created_Time', house_num='$arrayPropertyList[22]' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate = mysqli_query($con, $updateData);

                    $insertAdminNotif = "INSERT INTO admin_notification (landlord_id, property_id, notif_info, date_notif, notif_status) VALUES ('$lId', '$property_id', 'List-Property', '$created_Time', 'unread')";
                    $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);
                
                foreach ($_SESSION['sessionArray'] as $key => $value) {
                    unset($_SESSION['sessionArray'][$key]);
                }
                for($p = 0; $p < count($setOfsessionArray); $p++){
                    if(isset($_SESSION[$setOfsessionArray[$p]])){
                        unset($_SESSION[$setOfsessionArray[$p]]);
                    }
                }
                echo "../viewProperty.php?id=".$property_id;
                break;
            }
        }
    }
}
else{
    //We separate the values of checkboxes to remove strayed images
    $spacePropertyList = explode("~!", $arrayPropertyList[12]);

    $amenitiesPropertyList = explode("~-", $arrayPropertyList[20]);

    $propertyAmenities = implode(', ', $amenitiesPropertyList);
    //array list for removing decision
    $amenitiesCheckList = array("Living Room", "Dining Room", "Bedrooms", "Bathrooms", "Kitchen", "Laundry Room", "StudyOffice", "Entertainment Room", "Walk In Closet", "Hallways", "Staircase"
    , "Other", "Garden", "Outdoor Kitchen", "Front Yard", "Back Yard", "Patio", "Terrace", "Deck", "Play Area", "Swimming Pool", "Driveway", "Walkways"
    , "Storage Shed");
    //array list for database accessing
    $amenitiesCheckData = array("imgLivingroom", "imgDiningroom", "imgBedroom", "imgBathroom", "imgKitchen", "imgLaundryroom", "imgStudyOffice", "imgEntertainmentroom", "imgWalkInCloset", "imgHallway", "imgStaircase"
    , "imgOther", "imgGarden", "imgOutKitchen", "imgFrontyard", "imgBackyard", "imgPatio", "imgTerrace", "imgDeck", "imgPlayarea", "imgPool", "imgDriveway", "imgWalkways"
    , "imgStorageshed");
    //array of image session
    $setOfsessionArray = array('imgAmenitiesLivingRoom', 'imgAmenitiesDiningroom', 'imgAmenitiesBedrooms'
    , 'imgAmenitiesBathrooms', 'imgAmenitiesKitchen', 'imgAmenitiesLaundryRoom', 'imgAmenitiesStudyOffice', 'imgAmenitiesEntertainmentRoom', 'imgAmenitiesWalkInCloset',
    'imgAmenitiesHallways', 'imgAmenitiesStaircase', 'imgAmenitiesOther', 'imgAmenitiesGarden', 'imgAmenitiesOutdoorKitchen', 'imgAmenitiesFrontYard',
    'imgAmenitiesBackYard', 'imgAmenitiesPatio', 'imgAmenitiesTerrace', 'imgAmenitiesDeck', 'imgAmenitiesPlayArea', 'imgAmenitiesSwimmingPool', 'imgAmenitiesDriveway',
    'imgAmenitiesWalkways', 'imgAmenitiesStorageShed', 'imgFeatured3', 'imgFeatured2', 'imgFeatured1');
    //filename array
    if(isset($_SESSION['sessionArray'])){
        $filenameArraylist = $_SESSION['sessionArray'];
    }
    
    $lEmail = $_SESSION['lEmail'];

    $activeCheckbox = [];

    $uncheckedValues = [];
    //date created
    
    date_default_timezone_set('Asia/Manila');
    $created_Time = date("Y-m-d H:i:s");
    $txtdescription = mysqli_real_escape_string($con, $arrayPropertyList[2]);

    //set title and property name as pascal case
    //Title
    $TitleArray = explode(" ",$arrayPropertyList[1]);
    if(count($TitleArray) == 1){
        $TemporaryTitle = substr($TitleArray[0], 0, 1);
        $Temporary2ndTitle = substr($TitleArray[0], -strlen($TitleArray[0])+1, strlen($TitleArray[0]));
        $propertyTitle = strtoupper($TemporaryTitle) . strtolower($Temporary2ndTitle);
    }
    else if(count($TitleArray) == 2){
        $TemporaryTitle = substr($TitleArray[0], 0, 1);
        $Temporary2ndTitle = substr($TitleArray[0], -strlen($TitleArray[0])+1, strlen($TitleArray[0]));

        $TemporaryTitle1 = substr($TitleArray[1], 0, 1);
        $Temporary2ndTitle1 = substr($TitleArray[1], -strlen($TitleArray[1])+1, strlen($TitleArray[1]));

        $propertyTitle = strtoupper($TemporaryTitle) . strtolower($Temporary2ndTitle) . " " . strtoupper($TemporaryTitle1) . strtolower($Temporary2ndTitle1);
    }
    else if(count($TitleArray) == 3){
        $TemporaryTitle = substr($TitleArray[0], 0, 1);
        $Temporary2ndTitle = substr($TitleArray[0], -strlen($TitleArray[0])+1, strlen($TitleArray[0]));

        $TemporaryTitle1 = substr($TitleArray[1], 0, 1);
        $Temporary2ndTitle1 = substr($TitleArray[1], -strlen($TitleArray[1])+1, strlen($TitleArray[1]));

        $TemporaryTitle2 = substr($TitleArray[2], 0, 1);
        $Temporary2ndTitle2 = substr($TitleArray[2], -strlen($TitleArray[2])+1, strlen($TitleArray[2]));

        $propertyTitle = strtoupper($TemporaryTitle) . strtolower($Temporary2ndTitle) . " " . strtoupper($TemporaryTitle1) . strtolower($Temporary2ndTitle1) . " " . strtoupper($TemporaryTitle2) . strtolower($Temporary2ndTitle2);
    }
    else if(count($TitleArray) == 4){
        $TemporaryTitle = substr($TitleArray[0], 0, 1);
        $Temporary2ndTitle = substr($TitleArray[0], -strlen($TitleArray[0])+1, strlen($TitleArray[0]));

        $TemporaryTitle1 = substr($TitleArray[1], 0, 1);
        $Temporary2ndTitle1 = substr($TitleArray[1], -strlen($TitleArray[1])+1, strlen($TitleArray[1]));

        $TemporaryTitle2 = substr($TitleArray[2], 0, 1);
        $Temporary2ndTitle2 = substr($TitleArray[2], -strlen($TitleArray[2])+1, strlen($TitleArray[2]));

        $TemporaryTitle3 = substr($TitleArray[3], 0, 1);
        $Temporary2ndTitle3 = substr($TitleArray[3], -strlen($TitleArray[3])+1, strlen($TitleArray[3]));

        $propertyTitle = strtoupper($TemporaryTitle) . strtolower($Temporary2ndTitle) . " " . strtoupper($TemporaryTitle1) . strtolower($Temporary2ndTitle1) . " " . strtoupper($TemporaryTitle2) . strtolower($Temporary2ndTitle2) . " " . strtoupper($TemporaryTitle3) . strtolower($Temporary2ndTitle3);
    }
    //get id
    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);
    $lId = $lgetId['lID'];
    
    for($i = 0; $i < count($spacePropertyList); $i++){
        for($j = 0; $j < count($amenitiesCheckData); $j++){
            if($spacePropertyList[$i] == $amenitiesCheckList[$j]){
                $activeCheckbox[] = $amenitiesCheckData[$j];
                break;
            }
        }
    }
    // Initialize the variable before the loop to get the value inside a loop
    $setOfArrayNumbers = "";

    for ($m = 0; $m < count($activeCheckbox); $m++) {
        for ($n = 0; $n < count($amenitiesCheckList); $n++) {
            if ($activeCheckbox[$m] != $amenitiesCheckData[$n]) {
                if ($n == 23) {
                    // Concatenate with the existing value this is to separate the values and set as array
                    $setOfArrayNumbers .= $n . "---"; 
                } else {
                    // Concatenate with the existing value
                    $setOfArrayNumbers .= $n . ","; 
                }
            }
        }
    }
    $arrayValues = explode("---", $setOfArrayNumbers);
    $firstArray = explode(",", $arrayValues[0]); // Get the values from the first exploded array
    $commonValues = $firstArray; // Initialize $commonValues with the values from the first array

    for ($q = 1; $q < count($arrayValues); $q++) {
        $getArrayValue = explode(",", $arrayValues[$q]);
        // Find the common values in all arrays
        $commonValues = array_intersect($commonValues, $getArrayValue);
        // Code to execute only during the last iteration
        foreach ($commonValues as $number) {
            if($q == count($arrayValues) - 2){
                $uncheckedValues[] = $number;
            }
            else if($q == count($arrayValues) - 1){
                $uncheckedValues[] = $number;
            }
        }
    }

    for($a = 0; $a < 24; $a++){
        for($b = 0; $b < count($uncheckedValues); $b++){
            $num = $uncheckedValues[$b];
            $selectimgValue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
            $executeimgValue = mysqli_query($con, $selectimgValue);
            $getimgValue = mysqli_fetch_assoc($executeimgValue);
            $checkexistingData = mysqli_num_rows($executeimgValue);
            $space1 = trim($amenitiesCheckData[$num] . '1');
            $space2 = trim($amenitiesCheckData[$num] . '2');

            if($checkexistingData > 0){
                $property_id = $getimgValue['propertyID'];

                
                $selectImageValue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND propertyID='".$arrayPropertyList[21]."'";
                $executeImageValue = mysqli_query($con, $selectImageValue);
                $getImageValue = mysqli_fetch_assoc($executeImageValue);

                $selectImageValue1 = "SELECT * FROM landing_properties_new WHERE landlord_id='$lId' AND propertyID='".$arrayPropertyList[21]."'";
                $executeImageValue1 = mysqli_query($con, $selectImageValue1);
                $getImageValue1 = mysqli_fetch_assoc($executeImageValue1);

                
                if($getimgValue['imgFeatured1'] == NULL){
                    $featured1 = ", imgFeatured1='".$getImageValue['imgFeatured1']."'";
                }
                else {
                    $featured1 = "";
                }
                if($getimgValue['imgFeatured2'] == NULL){
                    $featured2 = ", imgFeatured2='".$getImageValue['imgFeatured2']."'";
                }
                else {
                    $featured2 = "";
                }
                if($getimgValue['imgFeatured3'] == NULL){
                    $featured3 = ", imgFeatured3 ='".$getImageValue['imgFeatured3']."'";
                }
                else {
                    $featured3 = "";
                }

                if($a == $uncheckedValues[$b]){

                    if($a == 23 && $a == $num){
                        $updateData = "UPDATE landing_properties SET propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                        propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                        maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                        propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                        propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                        propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', publishing_status='Published', occular_visit_status='".$getImageValue['occular_visit_status']."', updatedTime='$created_Time', house_num='$arrayPropertyList[22]', createdTime='".$getImageValue['createdTime']."'
                        $featured1 $featured2 $featured3 WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                        $executeUpdate = mysqli_query($con, $updateData);
                        if(isset($_SESSION['sessionArray'])){
                            foreach ($_SESSION['sessionArray'] as $key => $value) {
                                unset($_SESSION['sessionArray'][$key]);
                            }
                            for($p = 0; $p < count($setOfsessionArray); $p++){
                                if(isset($_SESSION[$setOfsessionArray[$p]])){
                                    unset($_SESSION[$setOfsessionArray[$p]]);
                                }
                            }
                        }
                        $updateFavorite = "UPDATE user_favorites SET favorite_id = '$property_id' WHERE favorite_id='".$arrayPropertyList[21]."'";
                        $executeUpdateFavorite = mysqli_query($con, $updateFavorite);

                        $updateapplication = "UPDATE application_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdateapplication = mysqli_query($con, $updateapplication);

                        $updatelease= "UPDATE lease SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdatelease = mysqli_query($con, $updatelease);

                        $updatefeedback = "UPDATE feedback_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdatefeedback = mysqli_query($con, $updatefeedback);

                        $updatecomplaints = "UPDATE complaints_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executecomplints = mysqli_query($con, $updatecomplaints);

                        $updatereceipt = "UPDATE receipt SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executereceipt = mysqli_query($con, $updatereceipt);

                        $updatepayment_records = "UPDATE payment_records SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executepayment_records = mysqli_query($con, $updatepayment_records);

                        $updatelandlord_notification = "UPDATE landlord_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executelandlord_notification = mysqli_query($con, $updatelandlord_notification);

                        $updaterenter_notification = "UPDATE renter_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executerenter_notification = mysqli_query($con, $updaterenter_notification);

                        $updateadmin_notification = "UPDATE admin_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeadmin_notification = mysqli_query($con, $updateadmin_notification);

                        $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE propertyID='".$arrayPropertyList[21]."' AND landlord_id='".$_SESSION['landlordId']."'");
                        $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE propertyID='".$arrayPropertyList[21]."' AND landlord_id='".$_SESSION['landlordId']."'");
                        echo "../viewProperty.php?id=".$property_id;
                    }
                    else if($a == 23 && $a != $num){
                        $updateData1 = "UPDATE landing_properties_new SET $space1 = NULL, $space2 = NULL, publishing_status='Published', occular_visit_status='not_yet' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                        $executeUpdate1 = mysqli_query($con, $updateData1);
                    
                        $updateData = "UPDATE landing_properties SET $amenitiesCheckData[$num] = NULL, propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                        propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                        maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                        propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                        propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                        propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', publishing_status='Published', occular_visit_status='".$getImageValue['occular_visit_status']."',  updatedTime='$created_Time', house_num='$arrayPropertyList[22]', createdTime='".$getImageValue['createdTime']."'
                        $featured1 $featured2 $featured3 WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                        $executeUpdate = mysqli_query($con, $updateData);
                        
                        if(isset($_SESSION['sessionArray'])){
                            foreach ($_SESSION['sessionArray'] as $key => $value) {
                                unset($_SESSION['sessionArray'][$key]);
                            }
                            for($p = 0; $p < count($setOfsessionArray); $p++){
                                if(isset($_SESSION[$setOfsessionArray[$p]])){
                                    unset($_SESSION[$setOfsessionArray[$p]]);
                                }
                            }
                        }
                        if(isset($getimgValue[$amenitiesCheckData[$num]])){
                            //get the value of specific image column in db
                            $imgDir = $getimgValue[$amenitiesCheckData[$num]];
                            //if the value of imgDir exist
                            if (file_exists($imgDir)) {
                                //the session value matched in the directory willbe deleted
                                if (unlink($imgDir)) {
                                    //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                                    unset($_SESSION[$imgDir]);
                                }
                            }
                        }
                        $updateFavorite = "UPDATE user_favorites SET favorite_id = '$property_id' WHERE favorite_id='".$arrayPropertyList[21]."'";
                        $executeUpdateFavorite = mysqli_query($con, $updateFavorite);

                        $updateapplication = "UPDATE application_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdateapplication = mysqli_query($con, $updateapplication);

                        $updatelease= "UPDATE lease SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdatelease = mysqli_query($con, $updatelease);

                        $updatefeedback = "UPDATE feedback_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdatefeedback = mysqli_query($con, $updatefeedback);

                        $updatecomplaints = "UPDATE complaints_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executecomplints = mysqli_query($con, $updatecomplaints);

                        $updatereceipt = "UPDATE receipt SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executereceipt = mysqli_query($con, $updatereceipt);

                        $updatepayment_records = "UPDATE payment_records SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executepayment_records = mysqli_query($con, $updatepayment_records);

                        $updateadmin_notification = "UPDATE admin_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeadmin_notification = mysqli_query($con, $updateadmin_notification);

                        $updatelandlord_notification = "UPDATE landlord_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executelandlord_notification = mysqli_query($con, $updatelandlord_notification);

                        $updaterenter_notification = "UPDATE renter_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executerenter_notification = mysqli_query($con, $updaterenter_notification);

                        $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE propertyID='".$arrayPropertyList[21]."' AND landlord_id='".$_SESSION['landlordId']."'");
                        $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE propertyID='".$arrayPropertyList[21]."' AND landlord_id='".$_SESSION['landlordId']."'");
                        echo "../viewProperty.php?id=".$property_id;
                    }
                    else{
                        $updateData1 = "UPDATE landing_properties_new SET $space1 = NULL, $space2 = NULL WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                        $executeUpdate1 = mysqli_query($con, $updateData1);

                        $updateData = "UPDATE landing_properties SET $amenitiesCheckData[$num] = NULL, propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                        propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                        maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                        propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                        propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                        propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', updatedTime='$created_Time', house_num='$arrayPropertyList[22]', createdTime='".$getImageValue['createdTime']."' 
                        $featured1 $featured2 $featured3 WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                        $executeUpdate = mysqli_query($con, $updateData);

                        if(isset($getimgValue[$amenitiesCheckData[$num]])){
                            //get the value of specific image column in db
                            $imgDir = $getimgValue[$amenitiesCheckData[$num]];
                            //if the value of imgDir exist
                            if (file_exists($imgDir)) {
                                //the session value matched in the directory willbe deleted
                                if (unlink($imgDir)) {
                                    //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                                    unset($_SESSION[$imgDir]);
                                }
                            }
                        }
                    }
                    break;
                }
                else if($a == $uncheckedValues[$b] && $a == 23){
                        $updateData1 = "UPDATE landing_properties_new SET publishing_status='Published', occular_visit_status='not_yet' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                        $executeUpdate1 = mysqli_query($con, $updateData1);
                
                        $updateData = "UPDATE landing_properties SET propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                        propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                        maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                        propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                        propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                        propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', publishing_status='Published', occular_visit_status='".$getImageValue['occular_visit_status']."',  updatedTime='$created_Time', house_num='$arrayPropertyList[22]', createdTime='".$getImageValue['createdTime']."'
                        $featured1 $featured2 $featured3 WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                        $executeUpdate = mysqli_query($con, $updateData);
                    
                        if(isset($_SESSION['sessionArray'])){
                            foreach ($_SESSION['sessionArray'] as $key => $value) {
                                unset($_SESSION['sessionArray'][$key]);
                            }
                            for($p = 0; $p < count($setOfsessionArray); $p++){
                                if(isset($_SESSION[$setOfsessionArray[$p]])){
                                    unset($_SESSION[$setOfsessionArray[$p]]);
                                }
                            }
                        }
                    
                        $updateFavorite = "UPDATE user_favorites SET favorite_id = '$property_id' WHERE favorite_id='".$arrayPropertyList[21]."'";
                        $executeUpdateFavorite = mysqli_query($con, $updateFavorite);

                        $updateapplication = "UPDATE application_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdateapplication = mysqli_query($con, $updateapplication);

                        $updatelease= "UPDATE lease SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdatelease = mysqli_query($con, $updatelease);

                        $updatefeedback = "UPDATE feedback_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdatefeedback = mysqli_query($con, $updatefeedback);

                        $updatecomplaints = "UPDATE complaints_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executecomplints = mysqli_query($con, $updatecomplaints);

                        $updatereceipt = "UPDATE receipt SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executereceipt = mysqli_query($con, $updatereceipt);

                        $updatepayment_records = "UPDATE payment_records SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executepayment_records = mysqli_query($con, $updatepayment_records);

                        $updateadmin_notification = "UPDATE admin_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeadmin_notification = mysqli_query($con, $updateadmin_notification);

                        $updatelandlord_notification = "UPDATE landlord_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executelandlord_notification = mysqli_query($con, $updatelandlord_notification);

                        $updaterenter_notification = "UPDATE renter_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executerenter_notification = mysqli_query($con, $updaterenter_notification);
                        
                    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE propertyID='".$arrayPropertyList[21]."' AND landlord_id='".$_SESSION['landlordId']."'");
                    $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE propertyID='".$arrayPropertyList[21]."' AND landlord_id='".$_SESSION['landlordId']."'");
                    echo "../viewProperty.php?id=".$property_id;
                }
                else if($a != $uncheckedValues[$b] && $a == 23){
                    $updateData1 = "UPDATE landing_properties_new SET publishing_status='Published', occular_visit_status='not_yet' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate1 = mysqli_query($con, $updateData1);
                
                    $updateData = "UPDATE landing_properties SET propertyType='$arrayPropertyList[0]', propertyTitle='".mysqli_real_escape_string($con, $propertyTitle)."',
                        propertyDescription='$txtdescription', propertyPrice='$arrayPropertyList[3]', propertyUnit='$arrayPropertyList[4]', propertyFloorArea='$arrayPropertyList[5]', 
                        maxOccupants='$arrayPropertyList[6]', propertyBathroom='$arrayPropertyList[7]', propertyBedrooms='$arrayPropertyList[8]', propertyParkingArea='$arrayPropertyList[9]', 
                        propertyPetAllowed='$arrayPropertyList[10]', propertyFullyFurnished='$arrayPropertyList[11]', propertyProvince='$arrayPropertyList[13]', propertyCity='$arrayPropertyList[14]',
                        propertyBarangay='$arrayPropertyList[15]', propertyRegion='$arrayPropertyList[16]', propertyLatitude='$arrayPropertyList[17]', propertyLongitude='$arrayPropertyList[18]',
                        propertyNearby='$arrayPropertyList[19]', propertyAmenities='$propertyAmenities', publishing_status='Published', occular_visit_status='".$getImageValue['occular_visit_status']."',  updatedTime='$created_Time', house_num='$arrayPropertyList[22]', createdTime='".$getImageValue['createdTime']."'
                        $featured1 $featured2 $featured3 WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                        $executeUpdate = mysqli_query($con, $updateData);

                        if(isset($_SESSION['sessionArray'])){
                            foreach ($_SESSION['sessionArray'] as $key => $value) {
                                unset($_SESSION['sessionArray'][$key]);
                            }
                            for($p = 0; $p < count($setOfsessionArray); $p++){
                                if(isset($_SESSION[$setOfsessionArray[$p]])){
                                    unset($_SESSION[$setOfsessionArray[$p]]);
                                }
                            }
                        }
                        $updateFavorite = "UPDATE user_favorites SET favorite_id = '$property_id' WHERE favorite_id='".$arrayPropertyList[21]."'";
                        $executeUpdateFavorite = mysqli_query($con, $updateFavorite);

                        $updateapplication = "UPDATE application_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdateapplication = mysqli_query($con, $updateapplication);

                        $updatelease = "UPDATE lease SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdatelease = mysqli_query($con, $updatelease);

                        $updatefeedback = "UPDATE feedback_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeupdatefeedback = mysqli_query($con, $updatefeedback);

                        $updatecomplaints = "UPDATE complaints_data SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executecomplints = mysqli_query($con, $updatecomplaints);

                        $updatereceipt = "UPDATE receipt SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executereceipt = mysqli_query($con, $updatereceipt);

                        $updatepayment_records = "UPDATE payment_records SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executepayment_records = mysqli_query($con, $updatepayment_records);

                        $updateadmin_notification = "UPDATE admin_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executeadmin_notification = mysqli_query($con, $updateadmin_notification);

                        $updatelandlord_notification = "UPDATE landlord_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executelandlord_notification = mysqli_query($con, $updatelandlord_notification);

                        $updaterenter_notification = "UPDATE renter_notification SET property_id = '$property_id' WHERE property_id='".$arrayPropertyList[21]."'";
                        $executerenter_notification = mysqli_query($con, $updaterenter_notification);

                        $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE propertyID='".$arrayPropertyList[21]."' AND landlord_id='".$_SESSION['landlordId']."'");
                        $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE propertyID='".$arrayPropertyList[21]."' AND landlord_id='".$_SESSION['landlordId']."'");
                        echo "../viewProperty.php?id=".$property_id;
                }
                else if($getimgValue[$amenitiesCheckData[$a]] == NULL){
                    $updateData = "UPDATE landing_properties SET $amenitiesCheckData[$a] = '".$getImageValue[$amenitiesCheckData[$a]]."' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate = mysqli_query($con, $updateData);
                }
                $spaceOutsideValue1 = trim($amenitiesCheckData[$a] . '1');
                $spaceOutsideValue2 = trim($amenitiesCheckData[$a] . '2');
                if($getImageValue1[$spaceOutsideValue1] == NULL){
                    $updateData1 = "UPDATE landing_properties_new SET $spaceOutsideValue1 = '".$getImageValue1[$spaceOutsideValue1]."' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate1 = mysqli_query($con, $updateData1);
                }
                if($getImageValue1[$spaceOutsideValue2] == NULL){
                    $updateData1 = "UPDATE landing_properties_new SET $spaceOutsideValue2 = '".$getImageValue1[$spaceOutsideValue2]."' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                    $executeUpdate1 = mysqli_query($con, $updateData1);
                }
            }
        }
    }
}
// Close the database connection
mysqli_close($con);
?>