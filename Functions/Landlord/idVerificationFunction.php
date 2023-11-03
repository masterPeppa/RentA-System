<?php
session_start();
include ('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['imgValue'])){
    $imgDir = $_SESSION['imgValue'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['imgValue'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['imgValue']);
        }
    }
}
if(!isset($_SESSION['imgValue'])){
    // Retrieve the image data from the request
    $imageData = $_POST['imageData'];
    $lEmail = $_SESSION['lEmail'];

    $lgetEmail ="SELECT * From user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con,$lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);
    $lId = $lgetId['lID'];

    // Remove the data URI scheme prefix (e.g., "data:image/jpeg;base64,")
    $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);

    // Decode the base64-encoded image data
    $imageData = base64_decode($imageData);

    // Generate a unique filename for the image
    $filename = 'L' . $lId . 'Verification_ID_' . time() . '.png';

    // Specify the folder to save the image
    $folderPath = '../../imgs/Verification_ID/';

    // Create the full path for the image file
    $filePath = $folderPath . $filename;

    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        // we will get the image path
        $_SESSION['imgValue'] = $filePath;
        // Image saved successfully
        echo ''.$filePath.'';
    } else {
        // Error saving image
        echo 'Error saving image';
    }
}
// Close the database connection
mysqli_close($con);
?>
