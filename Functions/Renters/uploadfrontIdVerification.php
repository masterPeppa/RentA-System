<?php
session_start();
include('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['frontCapturedImage'])){
    $imgDir = $_SESSION['frontCapturedImage'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['frontCapturedImage'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['frontCapturedImage']);
        }
    }
}

if(!isset($_SESSION['frontCapturedImage'])){
    // Retrieve the image data from the request
    $imageData = $_POST['frontCapturedData'];
    $imgName = $_POST['imgName'];
    $rEmail = $_SESSION['rEmail'];

    $rgetEmail = "SELECT * FROM user_renter WHERE rEmail='$rEmail'";
    $rcheckDatabase = mysqli_query($con, $rgetEmail);
    $rgetId = mysqli_fetch_assoc($rcheckDatabase);
    $rId = $rgetId['rId'];

    $imageData = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $imageData);
    $imageData = base64_decode($imageData);
    $mime = getimagesizefromstring($imageData)['mime'];
    $allowedFormats = [
        'image/png' => '.png',
        'image/jpeg' => '.jpeg',
        'image/jpg' => '.jpg',
    ];

    $extension = $allowedFormats[$mime] ?? '.png';
    $filename = 'r' . $rId . 'Verification_Front_ID_' . time() . $extension;
    $folderPath = '../../imgs/renter_verification/';
    $filePath = $folderPath . $filename;
    
    file_put_contents($filePath, $imageData);

    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        $getId = "SELECT * FROM application_data WHERE renter_id='$rId' AND send_status='0'";
        $rcheckId = mysqli_query($con, $getId);
        $rcheckidexistence = mysqli_num_rows($rcheckId);
        if($rcheckidexistence > 0){
            $updateData = "UPDATE application_data SET front_id = '$filePath' WHERE renter_id='$rId' AND send_status='0'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        else{
            $insertData = "INSERT INTO application_data (front_id, renter_id, send_status) VALUES ('$filePath', '$rId', '0')";
            $executeInsert = mysqli_query($con, $insertData);
        }
        // we will get the image path
        $_SESSION['frontCapturedImage'] = $filePath;
        // Image saved successfully
        echo $imgName;
    } else {
        // Error saving image
        echo 'Error saving image';
    }
}
// Close the database connection
mysqli_close($con);
?>