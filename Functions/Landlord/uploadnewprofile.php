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
    $lEmail = $_SESSION['lEmail'];

    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);
    $lId = $lgetId['lID'];

    // Remove the data URI scheme prefix (e.g., "data:image/png;base64,")
    $imageData = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $imageData);

    // Decode the base64-encoded image data
    $imageData = base64_decode($imageData);

    // Determine the image format based on the MIME type
    $mime = getimagesizefromstring($imageData)['mime'];
    $allowedFormats = [
        'image/png' => '.png',
        'image/jpeg' => '.jpeg',
        'image/jpg' => '.jpg',
    ];

    $extension = $allowedFormats[$mime] ?? '.png'; // Default to .png if the format is not recognized

    // Generate a unique filename for the image
    $filename = 'l' . $lId . 'profile' . time() . $extension;

    // Specify the folder to save the image
    $folderPath = '../../imgs/profilefolder/';

    // Create the full path for the image file
    $filePath = $folderPath . $filename;

    // Save the image to the specified path
    file_put_contents($filePath, $imageData);
    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        $pathvalue = str_replace("../../", "../", $filePath);
        $updateProfile = "UPDATE user_landlord SET lImgProfile = '$pathvalue' WHERE lID='$lId'";
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