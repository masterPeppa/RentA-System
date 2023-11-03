<?php 
    include('../../DataBase/connection.php');
    $landlordId = $_POST['userid'];
    $property = $_POST['propertyInfo'];
    
    $getId = "SELECT * FROM landing_properties WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
    $lcheckId = mysqli_query($con, $getId);
    $lcheckidexistence = mysqli_num_rows($lcheckId);

    $newgetId = "SELECT * FROM landing_properties_new WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
    $newlcheckId = mysqli_query($con, $newgetId);
    $newlcheckidexistence = mysqli_num_rows($newlcheckId);

    if($property == "Livingroom"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgLivingroom = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgLivingroom1 = NULL, imgLivingroom2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Diningroom"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgDiningroom = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgDiningroom1 = NULL, imgDiningroom2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Bedroom"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgBedroom = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgBedroom1 = NULL, imgBedroom2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Bathroom"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgBathroom = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgBathroom1 = NULL, imgBathroom2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Kitchen"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgKitchen = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgKitchen1 = NULL, imgKitchen2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Laundryroom"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgLaundryroom = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgLaundryroom1 = NULL, imgLaundryroom2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Studyoffice"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgStudyOffice = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgStudyOffice1 = NULL, imgStudyOffice2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Entertainment"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgEntertainmentroom = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgEntertainmentroom1 = NULL, imgEntertainmentroom2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Walkincloset"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgWalkInCloset = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgWalkInCloset1 = NULL, imgWalkInCloset2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Hallways"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgHallway = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgHallway1 = NULL, imgHallway2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Staircase"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgStaircase = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgStaircase1 = NULL, imgStaircase2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Other"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgOther = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgOther1 = NULL, imgOther2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Garden"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgGarden = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgGarden1 = NULL, imgGarden2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Outkitchen"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgOutKitchen = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgOutKitchen1 = NULL, imgOutKitchen2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Frontyard"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgFrontyard = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgFrontyard1 = NULL, imgFrontyard2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Backyard"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgBackyard = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgBackyard1 = NULL, imgBackyard2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Patio"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgPatio = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgPatio1 = NULL, imgPatio2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Terrace"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgTerrace = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgTerrace1 = NULL, imgTerrace2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Deck"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgDeck = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgDeck1 = NULL, imgDeck2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Playarea"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgPlayarea = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgPlayarea1 = NULL, imgPlayarea2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Swimmingpool"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgPool = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgPool1 = NULL, imgPool2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Driveway"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgDriveway = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgDriveway1 = NULL, imgDriveway2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Walkways"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgWalkways = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgWalkways1 = NULL, imgWalkways2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
    else if($property == "Storageshed"){
        if($newlcheckidexistence > 0){
            $updateData = "UPDATE landing_properties SET imgStorageshed = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        if($newlcheckidexistence > 0){
            $updateData1 = "UPDATE landing_properties_new SET imgStorageshed1 = NULL, imgStorageshed2 = NULL WHERE landlord_id='$landlordId' AND publishing_status='Not yet'";
            $executeUpdate1 = mysqli_query($con, $updateData1);
        }
    }
?>