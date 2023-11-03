<?php
session_start();
include('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['docuCapturedImage'])){
    $imgDir = $_SESSION['docuCapturedImage'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['docuCapturedImage'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['docuCapturedImage']);
        }
    }
}

if(!isset($_SESSION['docuCapturedImage'])){
    // Retrieve the image data from the request
    $imageData = $_POST['docuCapturedData'];
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
    $filename = 'r' . $rId . 'Verification_documents_' . time() . $extension;
    $folderPath = '../../imgs/verificationdocuments/';
    $filePath = $folderPath . $filename;
    
    file_put_contents($filePath, $imageData);

    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        $getId = "SELECT * FROM application_data WHERE renter_id='$rId' AND send_status='0'";
        $rcheckId = mysqli_query($con, $getId);
        $rcheckidexistence = mysqli_num_rows($rcheckId);
        if($rcheckidexistence > 0){
            $updateData = "UPDATE application_data SET docu_id = '$filePath' WHERE renter_id='$rId' AND send_status='0'";
            $executeUpdate = mysqli_query($con, $updateData);
        }
        else{
            $insertData = "INSERT INTO application_data (docu_id, renter_id, send_status) VALUES ('$filePath', '$rId', '0')";
            $executeInsert = mysqli_query($con, $insertData);
        }
        // we will get the image path
        $_SESSION['docuCapturedImage'] = $filePath;
        // Image saved successfully
        echo $imgName;
    } else {
        // Error saving image
        echo 'Error saving image';
    }
}

$folderPath = '../../imgs/verificationdocuments/';
$folderFiles = array_filter(scandir($folderPath), function($item) {
    return !in_array($item, ['.', '..']);
});

$getImageDirectory = "SELECT docu_id FROM application_data";
$directoryResult = mysqli_query($con, $getImageDirectory);

if ($directoryResult) {
    
    $databaseFiles = [];

    while ($dirfetch = mysqli_fetch_assoc($directoryResult)) {
        
        if (!empty($dirfetch['docu_id'])) {
            $databaseFiles[] = basename($dirfetch['docu_id']);
        }
    }

} else {
    echo "Database query failed: " . mysqli_error($con);
}

$folderFiles = array_map('trim', $folderFiles);
$databaseFiles = array_map('trim', $databaseFiles);
$filesToDelete = array_diff($folderFiles, $databaseFiles);

    foreach ($filesToDelete as $file) {
        $filePath = $folderPath . $file;
        
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
// Close the database connection
mysqli_close($con);
?>