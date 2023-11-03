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
    
    $filename = 'L' . $lId . 'Verification_Front_ID_' . time() . $extension;
    $folderPath = '../../imgs/Verification_ID/';
    $filePath = $folderPath . $filename;
    file_put_contents($filePath, $imageData);

    if (file_put_contents($filePath, $imageData)) {
        $getId = "SELECT * FROM verification_document WHERE user_id='$lId'";
        $lcheckId = mysqli_query($con, $getId);
        $lcheckidexistence = mysqli_num_rows($lcheckId);
        if($lcheckidexistence > 0){
            $updateData = "UPDATE verification_document SET img_front = '$filePath' WHERE user_id='$lId'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        else{
            $insertData = "INSERT INTO verification_document (img_front, user_id) VALUES ('$filePath', '$lId')";
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