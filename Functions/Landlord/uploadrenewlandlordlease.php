<?php
session_start();
include('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['imgrenewlease'])){
    $imgDir = $_SESSION['imgrenewlease'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['imgrenewlease'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['imgrenewlease']);
        }
    }
}

if(!isset($_SESSION['imgrenewlease'])){
    // Retrieve the image data from the request
    $imageData = $_POST['leaseimgdata'];
    $renter = $_POST['leaserenterid'];
    $property = $_POST['leasepropertyid'];
    $lEmail = $_SESSION['lEmail'];

    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);
    $lId = $lgetId['lID'];

    $imageData = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $imageData);

    $imageData = base64_decode($imageData);

    $mime = getimagesizefromstring($imageData)['mime'];
    $allowedFormats = [
        'image/png' => '.png',
        'image/jpeg' => '.jpeg',
        'image/jpg' => '.jpg',
    ];

    $extension = $allowedFormats[$mime] ?? '.png';
    $filename = $lId . 'renewlease' . time() . $extension;
    $folderPath = '../../imgs/lease/';
    $filePath = $folderPath . $filename;

    file_put_contents($filePath, $imageData);

    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        //update the image in data base
        $updateData = "UPDATE lease SET img_lease = '$filePath' WHERE renter_id='$renter' AND landlord_id='$lId' AND property_id='$property' AND lease_status='residing'";
        $executeUpdate = mysqli_query($con, $updateData);
        // we will get the image path
        $_SESSION['imgrenewlease'] = $filePath;
    } else {
        // Error saving image
        echo 'Error saving image';
    }
}
// Close the database connection
mysqli_close($con);
?>