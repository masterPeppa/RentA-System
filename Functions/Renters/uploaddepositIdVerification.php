<?php
session_start();
include('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['depositImgValue'])){
    $imgDir = $_SESSION['depositImgValue'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['depositImgValue'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['depositImgValue']);
        }
    }
}

if(!isset($_SESSION['depositImgValue'])){
    // Retrieve the image data from the request
    $imageData = $_POST['depositImgData'];
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

    $filename = 'r' . $rId . 'Verification_deposit_receipt_' . time() . $extension;
    $folderPath = '../../imgs/Receipt/Deposit/';
    $filePath = $folderPath . $filename;
    file_put_contents($filePath, $imageData);

    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        //update the image in data base
        $getId = "SELECT * FROM receipt WHERE renter_id='$rId' AND payment_status='Not yet'";
        $rcheckId = mysqli_query($con, $getId);
        $rcheckidexistence = mysqli_num_rows($rcheckId);
        if($rcheckidexistence > 0){
            $updateData = "UPDATE receipt SET img_deposit = '$filePath' WHERE renter_id='$rId'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        else{
            $insertData = "INSERT INTO receipt (img_deposit, renter_id, payment_status) VALUES ('$filePath', '$rId', 'Not yet')";
            $executeInsert = mysqli_query($con, $insertData);
        }
        // we will get the image path
        $_SESSION['depositImgValue'] = $filePath;
    } else {
        // Error saving image
        echo 'Error saving image';
    }
}
// Close the database connection
mysqli_close($con);
?>