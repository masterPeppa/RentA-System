<?php
session_start();
include('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['receiptImgValue'])){
    $imgDir = $_SESSION['receiptImgValue'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['receiptImgValue'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['receiptImgValue']);
        }
    }
}

if(!isset($_SESSION['receiptImgValue'])){
    // Retrieve the image data from the request
    $imageData = $_POST['receiptImgData'];
    $paymentId = $_POST['paymentId'];
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

    $filename = 'r' . $rId . 'Monthly_Payment_Receipt_' . time() . $extension;
    $folderPath = '../../imgs/MonthlyPayment/';
    $filePath = $folderPath . $filename;
    file_put_contents($filePath, $imageData);

    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        $updateData = "UPDATE payment_records SET img_receipt = '$filePath' WHERE id='$paymentId'";
        $executeUpdate = mysqli_query($con, $updateData);
        // we will get the image path
        $_SESSION['receiptImgValue'] = $filePath;
    } else {
        // Error saving image
        echo 'Error saving image';
    }
}
// Close the database connection
mysqli_close($con);
?>