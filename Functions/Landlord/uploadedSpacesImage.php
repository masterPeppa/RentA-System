<?php
session_start();
include('../../DataBase/connection.php');
    // Retrieve the image data from the request
    $imageData = $_POST['imageFile'];
    $imgName = $_POST['imgName'];
    $lEmail = $_SESSION['lEmail'];
    $sessionArray = [];

    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);
    $lId = $lgetId['lID'];

    //get prop id to set as unique name
    $getId = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
    $lcheckId = mysqli_query($con, $getId);
    $getiddata = mysqli_fetch_assoc($lcheckId);
    $lcheckidexistence = mysqli_num_rows($lcheckId);

    if($lcheckidexistence > 0){
        $propid = $getiddata['propertyID'];
    }
    else{
        $propid = "1";
    }

    //get prop id to set as unique name
    $newgetId = "SELECT * FROM landing_properties_new WHERE landlord_id='$lId' AND publishing_status='Not yet'";
    $newlcheckId = mysqli_query($con, $newgetId);
    $newgetiddata = mysqli_fetch_assoc($newlcheckId);
    $newlcheckidexistence = mysqli_num_rows($newlcheckId);

    if($newlcheckidexistence > 0){
        $propid = $getiddata['propertyID'];
    }
    else{
        $propid = "1";
    }

    $imageData = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $imageData);
    $imageData = base64_decode($imageData);
    $mime = getimagesizefromstring($imageData)['mime'];
    $allowedFormats = [
        'image/png' => '.png',
        'image/jpeg' => '.jpeg',
        'image/jpg' => '.jpg',
    ];

    $extension = $allowedFormats[$mime] ?? '.png'; 
    $filename = 'RentA' . $lId . $imgName . $propid . time() . $extension;
    $folderPath = '../../imgs/properties/';
    $filePath = $folderPath . $filename;
    file_put_contents($filePath, $imageData);

    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        if($lcheckidexistence > 0){
            if($imgName == "uploadImgLivingRoom"){
                if(isset($_SESSION['imgAmenitiesLivingRoom'])){
                    $imgDir = $_SESSION['imgAmenitiesLivingRoom'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesLivingRoom']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgLivingroom = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesLivingRoom'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDiningroom"){
                if(isset($_SESSION['imgAmenitiesDiningroom'])){
                    $imgDir = $_SESSION['imgAmenitiesDiningroom'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDiningroom']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgDiningroom = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDiningroom'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgKitchen"){
                if(isset($_SESSION['imgAmenitiesKitchen'])){
                    $imgDir = $_SESSION['imgAmenitiesKitchen'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesKitchen']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgKitchen = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesKitchen'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBedrooms"){
                if(isset($_SESSION['imgAmenitiesBedrooms'])){
                    $imgDir = $_SESSION['imgAmenitiesBedrooms'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBedrooms']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgBedroom = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBedrooms'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBathrooms"){
                if(isset($_SESSION['imgAmenitiesBathrooms'])){
                    $imgDir = $_SESSION['imgAmenitiesBathrooms'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBathrooms']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgBathroom = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBathrooms'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStudyOffice"){
                if(isset($_SESSION['imgAmenitiesStudyOffice'])){
                    $imgDir = $_SESSION['imgAmenitiesStudyOffice'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStudyOffice']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgStudyOffice = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStudyOffice'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgEntertainmentRoom"){
                if(isset($_SESSION['imgAmenitiesEntertainmentRoom'])){
                    $imgDir = $_SESSION['imgAmenitiesEntertainmentRoom'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesEntertainmentRoom']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgEntertainmentroom = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesEntertainmentRoom'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgLaundryRoom"){
                if(isset($_SESSION['imgAmenitiesLaundryRoom'])){
                    $imgDir = $_SESSION['imgAmenitiesLaundryRoom'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesLaundryRoom']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgLaundryroom = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesLaundryRoom'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgHallways"){
                if(isset($_SESSION['imgAmenitiesHallways'])){
                    $imgDir = $_SESSION['imgAmenitiesHallways'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesHallways']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgHallway = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesHallways'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStaircase"){
                if(isset($_SESSION['imgAmenitiesStaircase'])){
                    $imgDir = $_SESSION['imgAmenitiesStaircase'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStaircase']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgStaircase = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStaircase'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkInCloset"){
                if(isset($_SESSION['imgAmenitiesWalkInCloset'])){
                    $imgDir = $_SESSION['imgAmenitiesWalkInCloset'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesWalkInCloset']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgWalkInCloset = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkInCloset'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOther"){
                if(isset($_SESSION['imgAmenitiesOther'])){
                    $imgDir = $_SESSION['imgAmenitiesOther'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesOther']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgOther = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesOther'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgFrontYard"){
                if(isset($_SESSION['imgAmenitiesFrontYard'])){
                    $imgDir = $_SESSION['imgAmenitiesFrontYard'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesFrontYard']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgFrontyard = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesFrontYard'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBackYard"){
                if(isset($_SESSION['imgAmenitiesBackYard'])){
                    $imgDir = $_SESSION['imgAmenitiesBackYard'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBackYard']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgBackyard = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBackYard'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgTerrace"){
                if(isset($_SESSION['imgAmenitiesTerrace'])){
                    $imgDir = $_SESSION['imgAmenitiesTerrace'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesTerrace']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgTerrace = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesTerrace'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDeck"){
                if(isset($_SESSION['imgAmenitiesDeck'])){
                    $imgDir = $_SESSION['imgAmenitiesDeck'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDeck']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgDeck = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDeck'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgGarden"){
                if(isset($_SESSION['imgAmenitiesGarden'])){
                    $imgDir = $_SESSION['imgAmenitiesGarden'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesGarden']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgGarden = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesGarden'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgSwimmingPool"){ 
                if(isset($_SESSION['imgAmenitiesSwimmingPool'])){
                $imgDir = $_SESSION['imgAmenitiesSwimmingPool'];
                //if the value of session exist
                if (file_exists($imgDir)) {
                    //the session value matched in the directory willbe deleted
                    if (unlink($imgDir)) {
                        //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                        unset($_SESSION['imgAmenitiesSwimmingPool']);
                    }
                }
            }
                $updateData = "UPDATE landing_properties SET imgPool = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesSwimmingPool'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDriveway"){
                if(isset($_SESSION['imgAmenitiesDriveway'])){
                    $imgDir = $_SESSION['imgAmenitiesDriveway'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDriveway']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgDriveway = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDriveway'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkways"){
                if(isset($_SESSION['imgAmenitiesWalkways'])){
                    $imgDir = $_SESSION['imgAmenitiesWalkways'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesWalkways']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgWalkways = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkways'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOutdoorKitchen"){
                if(isset($_SESSION['imgAmenitiesOutdoorKitchen'])){
                    $imgDir = $_SESSION['imgAmenitiesOutdoorKitchen'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesOutdoorKitchen']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgOutKitchen = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesOutdoorKitchen'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPlayArea"){
                if(isset($_SESSION['imgAmenitiesPlayArea'])){
                    $imgDir = $_SESSION['imgAmenitiesPlayArea'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesPlayArea']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgPlayarea = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesPlayArea'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPatio"){
                if(isset($_SESSION['imgAmenitiesPatio'])){
                    $imgDir = $_SESSION['imgAmenitiesPatio'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesPatio']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgPatio = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesPatio'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStorageShed"){
                if(isset($_SESSION['imgAmenitiesStorageShed'])){
                    $imgDir = $_SESSION['imgAmenitiesStorageShed'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStorageShed']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgStorageshed = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStorageShed'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "Featured1"){
                if(isset($_SESSION['imgFeatured1'])){
                    $imgDir = $_SESSION['imgFeatured1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgFeatured1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgFeatured1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgFeatured1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "Featured2"){
                if(isset($_SESSION['imgFeatured2'])){
                    $imgDir = $_SESSION['imgFeatured2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgFeatured2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgFeatured2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgFeatured2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "Featured3"){
                if(isset($_SESSION['imgFeatured3'])){
                    $imgDir = $_SESSION['imgFeatured3'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgFeatured3']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties SET imgFeatured3 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgFeatured3'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
        }
        else{
            if($imgName == "uploadImgLivingRoom"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgLivingroom, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesLivingRoom'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDiningroom"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgDiningroom, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesDiningroom'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgKitchen"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgKitchen, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesKitchen'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBedrooms"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgBedroom, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesBedrooms'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBathrooms"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgBathroom, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesBathrooms'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStudyOffice"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgStudyOffice, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesStudyOffice'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgEntertainmentRoom"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgEntertainmentroom, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesEntertainmentRoom'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgLaundryRoom"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgLaundryroom, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesLaundryRoom'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgHallways"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgHallway, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesHallways'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStaircase"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgStaircase, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesStaircase'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkInCloset"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgWalkInCloset, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkInCloset'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOther"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgOther, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesOther'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgFrontYard"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgFrontyard, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesFrontYard'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBackYard"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgBackyard, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesBackYard'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgTerrace"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgTerrace, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesTerrace'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDeck"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgDeck, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesDeck'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgGarden"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgGarden, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesGarden'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgSwimmingPool"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgPool, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesSwimmingPool'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDriveway"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgDriveway, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesDriveway'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkways"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgWalkways, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkways'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOutdoorKitchen"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgOutKitchen, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesOutdoorKitchen'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPlayArea"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgPlayarea, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesPlayArea'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPatio"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgPatio, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesPatio'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStorageShed"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgStorageshed, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgAmenitiesStorageShed'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "Featured1"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgFeatured1, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgFeatured1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "Featured2"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgFeatured2, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgFeatured2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "Featured3"){
                $insertData = "INSERT INTO landing_properties (landlord_id, imgFeatured3, publishing_status) VALUES ('$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);

                $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
                // we will get the image path
                $_SESSION['imgFeatured3'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
        }


        //New landing page images
        if($newlcheckidexistence > 0){
            //living room
            if($imgName == "uploadImgLivingRoom1"){
                if(isset($_SESSION['imgAmenitiesLivingRoom1'])){
                    $imgDir = $_SESSION['imgAmenitiesLivingRoom1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesLivingRoom1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgLivingroom1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesLivingRoom1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }

            else if($imgName == "uploadImgLivingRoom2"){
                if(isset($_SESSION['imgAmenitiesLivingRoom2'])){
                    $imgDir = $_SESSION['imgAmenitiesLivingRoom2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesLivingRoom2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgLivingroom2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesLivingRoom2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            //Dining room
            if($imgName == "uploadImgDiningroom1"){
                if(isset($_SESSION['imgAmenitiesDiningRoom1'])){
                    $imgDir = $_SESSION['imgAmenitiesDiningRoom1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDiningRoom1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgDiningroom1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDiningroom1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }

            else if($imgName == "uploadImgDiningroom2"){
                if(isset($_SESSION['imgAmenitiesDiningRoom2'])){
                    $imgDir = $_SESSION['imgAmenitiesDiningRoom2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDiningRoom2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgDiningroom2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDiningRoom2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            //bedroom
            else if($imgName == "uploadImgBedrooms1"){
                if(isset($_SESSION['imgAmenitiesBedrooms1'])){
                    $imgDir = $_SESSION['imgAmenitiesBedrooms1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBedrooms1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgBedroom1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBedrooms1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBedrooms2"){
                if(isset($_SESSION['imgAmenitiesBedrooms2'])){
                    $imgDir = $_SESSION['imgAmenitiesBedrooms2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBedrooms2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgBedroom2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBedrooms2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            //bathroom
            else if($imgName == "uploadImgBathrooms1"){
                if(isset($_SESSION['imgAmenitiesBathrooms1'])){
                    $imgDir = $_SESSION['imgAmenitiesBathrooms1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBathrooms1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgBathroom1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBathrooms1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBathrooms2"){
                if(isset($_SESSION['imgAmenitiesBathrooms2'])){
                    $imgDir = $_SESSION['imgAmenitiesBathrooms2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBathrooms2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgBathroom2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBathrooms2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            //Kitchen
            else if($imgName == "uploadImgKitchen1"){
                if(isset($_SESSION['imgAmenitiesKitchen1'])){
                    $imgDir = $_SESSION['imgAmenitiesKitchen1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesKitchen1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgKitchen1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBathrooms1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgKitchen2"){
                if(isset($_SESSION['imgAmenitiesKitchen2'])){
                    $imgDir = $_SESSION['imgAmenitiesKitchen2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesKitchen2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgKitchen2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesKitchen2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStudyOffice1"){
                if(isset($_SESSION['imgAmenitiesStudyOffice1'])){
                    $imgDir = $_SESSION['imgAmenitiesStudyOffice1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStudyOffice1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgStudyOffice1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStudyOffice1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStudyOffice2"){
                if(isset($_SESSION['imgAmenitiesStudyOffice2'])){
                    $imgDir = $_SESSION['imgAmenitiesStudyOffice2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStudyOffice2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgStudyOffice2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStudyOffice2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgEntertainmentRoom1"){
                if(isset($_SESSION['imgAmenitiesEntertainmentRoom1'])){
                    $imgDir = $_SESSION['imgAmenitiesEntertainmentRoom1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesEntertainmentRoom1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgEntertainmentroom1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesEntertainmentRoom1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgEntertainmentRoom2"){
                if(isset($_SESSION['imgAmenitiesEntertainmentRoom2'])){
                    $imgDir = $_SESSION['imgAmenitiesEntertainmentRoom2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesEntertainmentRoom2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgEntertainmentroom2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesEntertainmentRoom2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgLaundryRoom1"){
                if(isset($_SESSION['imgAmenitiesLaundryRoom1'])){
                    $imgDir = $_SESSION['imgAmenitiesLaundryRoom1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesLaundryRoom1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgLaundryroom1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesLaundryRoom1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgLaundryRoom2"){
                if(isset($_SESSION['imgAmenitiesLaundryRoom2'])){
                    $imgDir = $_SESSION['imgAmenitiesLaundryRoom2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesLaundryRoom2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgLaundryroom2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesLaundryRoom2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgHallways1"){
                if(isset($_SESSION['imgAmenitiesHallways1'])){
                    $imgDir = $_SESSION['imgAmenitiesHallways1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesHallways1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgHallway1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesHallways1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgHallways2"){
                if(isset($_SESSION['imgAmenitiesHallways2'])){
                    $imgDir = $_SESSION['imgAmenitiesHallways2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesHallways2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgHallway2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesHallways2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStaircase1"){
                if(isset($_SESSION['imgAmenitiesStaircase1'])){
                    $imgDir = $_SESSION['imgAmenitiesStaircase1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStaircase1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgStaircase1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStaircase1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStaircase2"){
                if(isset($_SESSION['imgAmenitiesStaircase2'])){
                    $imgDir = $_SESSION['imgAmenitiesStaircase2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStaircase2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgStaircase2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStaircase2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkInCloset1"){
                if(isset($_SESSION['imgAmenitiesWalkInCloset1'])){
                    $imgDir = $_SESSION['imgAmenitiesWalkInCloset1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesWalkInCloset1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgWalkInCloset1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkInCloset1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkInCloset2"){
                if(isset($_SESSION['imgAmenitiesWalkInCloset2'])){
                    $imgDir = $_SESSION['imgAmenitiesWalkInCloset2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesWalkInCloset2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgWalkInCloset2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkInCloset2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOther1"){
                if(isset($_SESSION['imgAmenitiesOther1'])){
                    $imgDir = $_SESSION['imgAmenitiesOther1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesOther1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgOther1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesOther1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOther2"){
                if(isset($_SESSION['imgAmenitiesOther2'])){
                    $imgDir = $_SESSION['imgAmenitiesOther2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesOther2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgOther2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesOther2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgFrontYard1"){
                if(isset($_SESSION['imgAmenitiesFrontYard1'])){
                    $imgDir = $_SESSION['imgAmenitiesFrontYard1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesFrontYard1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgFrontyard1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesFrontYard1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgFrontYard2"){
                if(isset($_SESSION['imgAmenitiesFrontYard2'])){
                    $imgDir = $_SESSION['imgAmenitiesFrontYard2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesFrontYard2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgFrontyard2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesFrontYard2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBackYard1"){
                if(isset($_SESSION['imgAmenitiesBackYard1'])){
                    $imgDir = $_SESSION['imgAmenitiesBackYard1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBackYard1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgBackyard1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBackYard1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBackYard2"){
                if(isset($_SESSION['imgAmenitiesBackYard2'])){
                    $imgDir = $_SESSION['imgAmenitiesBackYard2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesBackYard2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgBackyard2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesBackYard2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgTerrace1"){
                if(isset($_SESSION['imgAmenitiesTerrace1'])){
                    $imgDir = $_SESSION['imgAmenitiesTerrace1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesTerrace1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgTerrace1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesTerrace1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgTerrace2"){
                if(isset($_SESSION['imgAmenitiesTerrace2'])){
                    $imgDir = $_SESSION['imgAmenitiesTerrace2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesTerrace2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgTerrace2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesTerrace2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDeck1"){
                if(isset($_SESSION['imgAmenitiesDeck1'])){
                    $imgDir = $_SESSION['imgAmenitiesDeck1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDeck1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgDeck1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDeck1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDeck2"){
                if(isset($_SESSION['imgAmenitiesDeck2'])){
                    $imgDir = $_SESSION['imgAmenitiesDeck2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDeck2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgDeck2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDeck2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgGarden1"){
                if(isset($_SESSION['imgAmenitiesGarden1'])){
                    $imgDir = $_SESSION['imgAmenitiesGarden1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesGarden1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgGarden1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesGarden1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgGarden2"){
                if(isset($_SESSION['imgAmenitiesGarden2'])){
                    $imgDir = $_SESSION['imgAmenitiesGarden2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesGarden2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgGarden2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesGarden2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgSwimmingPool1"){ 
                if(isset($_SESSION['imgAmenitiesSwimmingPool1'])){
                $imgDir = $_SESSION['imgAmenitiesSwimmingPool1'];
                //if the value of session exist
                if (file_exists($imgDir)) {
                    //the session value matched in the directory willbe deleted
                    if (unlink($imgDir)) {
                        //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                        unset($_SESSION['imgAmenitiesSwimmingPool1']);
                    }
                }
            }
                $updateData = "UPDATE landing_properties_new SET imgPool1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesSwimmingPool1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgSwimmingPool2"){ 
                if(isset($_SESSION['imgAmenitiesSwimmingPool2'])){
                $imgDir = $_SESSION['imgAmenitiesSwimmingPool2'];
                //if the value of session exist
                if (file_exists($imgDir)) {
                    //the session value matched in the directory willbe deleted
                    if (unlink($imgDir)) {
                        //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                        unset($_SESSION['imgAmenitiesSwimmingPool2']);
                    }
                }
            }
                $updateData = "UPDATE landing_properties_new SET imgPool2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesSwimmingPool2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDriveway1"){
                if(isset($_SESSION['imgAmenitiesDriveway1'])){
                    $imgDir = $_SESSION['imgAmenitiesDriveway1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDriveway1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgDriveway1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDriveway1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDriveway2"){
                if(isset($_SESSION['imgAmenitiesDriveway2'])){
                    $imgDir = $_SESSION['imgAmenitiesDriveway2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesDriveway2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgDriveway2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesDriveway2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkways1"){
                if(isset($_SESSION['imgAmenitiesWalkways1'])){
                    $imgDir = $_SESSION['imgAmenitiesWalkways1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesWalkways1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgWalkways1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkways1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkways2"){
                if(isset($_SESSION['imgAmenitiesWalkways2'])){
                    $imgDir = $_SESSION['imgAmenitiesWalkways2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesWalkways2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgWalkways2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkways2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOutdoorKitchen1"){
                if(isset($_SESSION['imgAmenitiesOutdoorKitchen1'])){
                    $imgDir = $_SESSION['imgAmenitiesOutdoorKitchen1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesOutdoorKitchen1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgOutKitchen1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesOutdoorKitchen1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOutdoorKitchen2"){
                if(isset($_SESSION['imgAmenitiesOutdoorKitchen2'])){
                    $imgDir = $_SESSION['imgAmenitiesOutdoorKitchen2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesOutdoorKitchen2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgOutKitchen2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesOutdoorKitchen2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPlayArea1"){
                if(isset($_SESSION['imgAmenitiesPlayArea1'])){
                    $imgDir = $_SESSION['imgAmenitiesPlayArea1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesPlayArea1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgPlayarea1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesPlayArea1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPlayArea2"){
                if(isset($_SESSION['imgAmenitiesPlayArea2'])){
                    $imgDir = $_SESSION['imgAmenitiesPlayArea2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesPlayArea2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgPlayarea2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesPlayArea2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPatio1"){
                if(isset($_SESSION['imgAmenitiesPatio1'])){
                    $imgDir = $_SESSION['imgAmenitiesPatio1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesPatio1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgPatio1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesPatio1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPatio2"){
                if(isset($_SESSION['imgAmenitiesPatio2'])){
                    $imgDir = $_SESSION['imgAmenitiesPatio2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesPatio2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgPatio2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesPatio2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStorageShed1"){
                if(isset($_SESSION['imgAmenitiesStorageShed1'])){
                    $imgDir = $_SESSION['imgAmenitiesStorageShed1'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStorageShed1']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgStorageshed1 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStorageShed1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStorageShed2"){
                if(isset($_SESSION['imgAmenitiesStorageShed2'])){
                    $imgDir = $_SESSION['imgAmenitiesStorageShed2'];
                    //if the value of session exist
                    if (file_exists($imgDir)) {
                        //the session value matched in the directory willbe deleted
                        if (unlink($imgDir)) {
                            //we will remove the session['imgAmenities'] to make sure tha the function will proceed to the next if statement
                            unset($_SESSION['imgAmenitiesStorageShed2']);
                        }
                    }
                }
                $updateData = "UPDATE landing_properties_new SET imgStorageshed2 = '$filePath' WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeUpdate = mysqli_query($con, $updateData);
                // we will get the image path
                $_SESSION['imgAmenitiesStorageShed2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
        }

        else{
            if($imgName == "uploadImgLivingRoom1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
                
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgLivingroom1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                // we will get the image path
                $_SESSION['imgAmenitiesLivingRoom1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgLivingRoom2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
                
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgLivingroom2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesLivingRoom2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDiningroom1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
                
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgDiningroom1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                // we will get the image path
                $_SESSION['imgAmenitiesDiningRoom1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
			else if($imgName == "uploadImgDiningroom2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
                
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgDiningroom2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesDiningRoom2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBedrooms1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
                
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgBedroom1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesBedrooms1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if ($imgName == "uploadImgBedrooms2") {
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
            
                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgBedroom2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                
                // Store the image path in a session variable
                $_SESSION['imgAmenitiesBedrooms2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            
            else if($imgName == "uploadImgBathrooms1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
                
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgBathroom1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesBathrooms1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if ($imgName == "uploadImgBathrooms2") {
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);
            
                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgBathroom2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                
                // Store the image path in a session variable
                $_SESSION['imgAmenitiesBathrooms2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgKitchen1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgKitchen1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                
                // Store the image path in a session variable
                $_SESSION['imgAmenitiesKitchen1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgKitchen2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgKitchen2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesKitchen2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStudyOffice1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgStudyOffice1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesStudyOffice1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStudyOffice2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgStudyOffice2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesStudyOffice2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgEntertainmentRoom1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgEntertainmentroom1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesEntertainmentRoom1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgEntertainmentRoom2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgEntertainmentroom2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesEntertainmentRoom2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgLaundryRoom1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgLaundryroom1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesLaundryRoom1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgLaundryRoom2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgLaundryroom2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesLaundryRoom2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgHallways1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgHallway1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesHallways1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgHallways2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgHallway2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesHallways2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStaircase1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgStaircase1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesStaircase1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStaircase2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgStaircase2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesStaircase2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkInCloset1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgWalkInCloset1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkInCloset1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkInCloset2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgWalkInCloset2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkInCloset2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOther1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgOther1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesOther1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOther2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgOther2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesOther2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgFrontYard1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgFrontyard1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesFrontYard1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgFrontYard2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgFrontyard2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesFrontYard2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBackYard1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgBackyard1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesBackYard1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgBackYard2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgBackyard2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesBackYard2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgTerrace1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgTerrace1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesTerrace1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgTerrace2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgTerrace2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesTerrace2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDeck1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgDeck1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesDeck1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDeck2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgDeck2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesDeck2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgGarden1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgGarden1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesGarden1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgGarden2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgGarden2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesGarden2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgSwimmingPool1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgPool1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesSwimmingPool1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgSwimmingPool2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgPool2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesSwimmingPool2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDriveway1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgDriveway1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesDriveway1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgDriveway2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgDriveway2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesDriveway2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkways1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgWalkways1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkways1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgWalkways2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgWalkways2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesWalkways2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOutdoorKitchen1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgOutKitchen1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesOutdoorKitchen1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgOutdoorKitchen2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgOutKitchen2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesOutdoorKitchen2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPlayArea1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgPlayarea1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesPlayArea1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPlayArea2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgPlayarea2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesPlayArea2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPatio1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgPatio1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesPatio1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgPatio2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgPatio2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesPatio2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStorageShed1"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgStorageshed1, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesStorageShed1'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
            else if($imgName == "uploadImgStorageShed2"){
                $insertData1 = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('$lId', 'Not yet')";
                $executeInsert1 = mysqli_query($con, $insertData1);

                $selectinsertedvalue = "SELECT * FROM landing_properties WHERE landlord_id='$lId' AND publishing_status='Not yet'";
                $executeselectedvalue = mysqli_query($con, $selectinsertedvalue);
                $getselectedvalue = mysqli_fetch_assoc($executeselectedvalue);
            
                $insertData = "INSERT INTO landing_properties_new (propertyID, landlord_id, imgStorageshed2, publishing_status) VALUES ('".$getselectedvalue['propertyID']."', '$lId', '$filePath', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);
                // we will get the image path
                $_SESSION['imgAmenitiesStorageShed2'] = $filePath;
                $sessionArray[] = $filePath;

                echo "success";
            }
        }
        $_SESSION['sessionArray'] = $sessionArray;
        $_SESSION['isPublish'] = "false";
    } else {
        // Error saving image
        echo 'Error saving image';
    }
    // Close the database connection
mysqli_close($con);
?>