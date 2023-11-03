<?php
session_start();
include('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['matchCapturedImage'])){
    $imgDir = $_SESSION['matchCapturedImage'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['matchCapturedImage'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['matchCapturedImage']);
        }
    }
}

if(!isset($_SESSION['matchCapturedImage'])){
    // Retrieve the image data from the request
    $imageData = $_POST['matchCapturedData'];
    $rEmail = $_SESSION['rEmail'];
    //get the id of the landlord matches email
    $rgetEmail = "SELECT * FROM user_renter WHERE rEmail='$rEmail'";
    $rcheckDatabase = mysqli_query($con, $rgetEmail);
    $rgetId = mysqli_fetch_assoc($rcheckDatabase);
    $rId = $rgetId['rId'];
    
    // Remove the data URI scheme prefix (e.g., "data:image/png;base64,")
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    
    // Decode the base64-encoded image data
    $imageData = base64_decode($imageData);
    
    // Generate a unique filename for the image
    $filename = 'r' . $rId . 'Verification_Confirm_ID_' . time() . '.png';
    
    // Specify the folder to save the image
    $folderPath = '../../imgs/renter_verification/';
    
    // Create the full path for the image file
    $filePath = $folderPath . $filename;
    
    // Save the image file
    if (file_put_contents($filePath, $imageData)) {

        //update the image in data base
        $getId = "SELECT * FROM application_data WHERE renter_id='$rId' AND send_status='0'";
        $rcheckId = mysqli_query($con, $getId);
        $rcheckidexistence = mysqli_num_rows($rcheckId);
        if($rcheckidexistence > 0){
            $updateData = "UPDATE application_data SET face_pic='$filePath' WHERE renter_id='$rId' AND send_status='0'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        else{
            $insertData = "INSERT INTO application_data (face_pic, renter_id, send_status) VALUES ('$filePath', '$rId', '0')";
            $executeInsert = mysqli_query($con, $insertData);
        }
        // we will get the image path
        $_SESSION['matchCapturedImage'] = $filePath;
        // Image saved successfully
        echo $filename;
    } else {
        // Error saving image
        echo 'Error saving image';
    }
    
}
// Close the database connection
mysqli_close($con);
?>