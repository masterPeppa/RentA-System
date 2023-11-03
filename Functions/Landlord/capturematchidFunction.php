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
    $imageData = $_POST['matchImgData'];
    $lEmail = $_SESSION['lEmail'];
    //get the id of the landlord matches email
    $lgetEmail = "SELECT * FROM user_landlord WHERE lEmail='$lEmail'";
    $lcheckDatabase = mysqli_query($con, $lgetEmail);
    $lgetId = mysqli_fetch_assoc($lcheckDatabase);
    $lId = $lgetId['lID'];
    //notifdate
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = new DateTime();
    $databaseFormattedDate = $currentDateTime->format('Y-m-d H:i:s');
    
    // Remove the data URI scheme prefix (e.g., "data:image/png;base64,")
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    
    // Decode the base64-encoded image data
    $imageData = base64_decode($imageData);
    
    // Generate a unique filename for the image
    $filename = 'L' . $lId . 'Verification_Confirm_ID_' . time() . '.png';
    
    // Specify the folder to save the image
    $folderPath = '../../imgs/Verification_ID/';
    
    // Create the full path for the image file
    $filePath = $folderPath . $filename;
    
    // Save the image file
    if (file_put_contents($filePath, $imageData)) {
        //update the image in data base
        $updateData = "UPDATE verification_document SET img_match = '$filePath' WHERE user_id='$lId'";
        $executeUpdate = mysqli_query($con, $updateData);

        $updateLandlordinfo = "UPDATE user_landlord SET lStatus = 'semi-verified', rejected_reason = NULL WHERE lID='$lId'";
        $executelandlordinfo = mysqli_query($con, $updateLandlordinfo);

        $selectAdminNotif = "SELECT * FROM admin_notification WHERE landlord_id='$lId' AND notif_info='Landlord-Register'";
        $checkAdminNotif = mysqli_query($con, $selectAdminNotif);
        $countAdminNotif = mysqli_num_rows($checkAdminNotif);

        if($countAdminNotif > 0){
            $updateAdminNotif = "UPDATE admin_notification SET date_notif='$databaseFormattedDate', notif_status='unread' WHERE landlord_id='$lId' AND notif_info='Landlord-Register'";
            $executeupdateAdminNotif = mysqli_query($con, $updateAdminNotif);
        }
        else{
            $insertAdminNotif = "INSERT INTO admin_notification (landlord_id, notif_info, date_notif, notif_status) VALUES ('$lId', 'Landlord-Register', '$databaseFormattedDate', 'unread')";
            $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);
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