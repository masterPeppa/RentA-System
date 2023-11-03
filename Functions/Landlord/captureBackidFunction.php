<?php
session_start();
include('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['backImgValue'])){
    $imgDir = $_SESSION['backImgValue'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['backImgValue'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['backImgValue']);
        }
    }
}

if(!isset($_SESSION['backImgValue'])){
    // Retrieve the image data from the request
    $imageData = $_POST['backImgData'];
    $lEmail = $_SESSION['lEmail'];
    //get the id of the landlord matches email
    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);
    $lId = $lgetId['lID'];
    
    // Remove the data URI scheme prefix (e.g., "data:image/png;base64,")
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    
    // Decode the base64-encoded image data
    $imageData = base64_decode($imageData);
    
    // Generate a unique filename for the image
    $filename = 'L' . $lId . 'Verification_Back_ID_' . time() . '.png';
    
    // Specify the folder to save the image
    $folderPath = '../../imgs/Verification_ID/';
    
    // Create the full path for the image file
    $filePath = $folderPath . $filename;
    
    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        //update the image in data base
        $updateData = "UPDATE verification_document SET img_back = '$filePath' WHERE user_id='$lId'";
        $executeUpdate = mysqli_query($con, $updateData);
        // we will get the image path
        $_SESSION['backImgValue'] = $filePath;
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