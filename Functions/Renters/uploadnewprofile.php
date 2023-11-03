<?php
session_start();
include('../../DataBase/connection.php');
//if the session has value
if(isset($_SESSION['imgnewprofilepic'])){
    $imgDir = $_SESSION['imgnewprofilepic'];
    //if the value of session exist
    if (file_exists($imgDir)) {
        //the session value matched in the directory willbe deleted
        if (unlink($imgDir)) {
            //we will remove the session['imgnewprofilepic'] to make sure tha the function will proceed to the next if statement
            unset($_SESSION['imgnewprofilepic']);
        }
    }
}

if(!isset($_SESSION['imgnewprofilepic'])){
    // Retrieve the image data from the request
    $imageData = $_POST['newprofilepic'];
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
    $filename = $rId . 'profile0' . time() . $extension;
    $folderPath = '../../imgs/profilefolder/';
    $filePath = $folderPath . $filename;
    
    file_put_contents($filePath, $imageData);

    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        $pathvalue = str_replace("../../", "../", $filePath);
        $updateProfile = "UPDATE user_renter SET rImgProfile = '$pathvalue' WHERE rId='$rId'";
        $executeUpdate = mysqli_query($con, $updateProfile);
        // we will get the image path
        $_SESSION['imgnewprofilepic'] = $filePath;
    } else {
        // Error saving image
        echo 'Error saving image';
    }

    
    $folderPath = '../../imgs/profilefolder/';
    $folderFiles = array_filter(scandir($folderPath), function($item) {
        return !in_array($item, ['.', '..']);
    });

    $getlImageDirectory = "SELECT lImgProfile FROM user_landlord";
    $ldirectoryResult = mysqli_query($con, $getlImageDirectory);

    $getrImageDirectory = "SELECT rImgProfile FROM user_renter";
    $rdirectoryResult = mysqli_query($con, $getrImageDirectory);

    if ($ldirectoryResult || $rdirectoryResult) {
        $databaseFiles = [];

        while ($dirfetch = mysqli_fetch_assoc($ldirectoryResult)) {
            if (!empty($dirfetch['lImgProfile'])) {
                $databaseFiles[] = basename($dirfetch['lImgProfile']);
            }
        }

        while ($dirfetch = mysqli_fetch_assoc($rdirectoryResult)) {
            if (!empty($dirfetch['rImgProfile'])) {
                $databaseFiles[] = basename($dirfetch['rImgProfile']);
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
}
// Close the database connection
mysqli_close($con);
?>