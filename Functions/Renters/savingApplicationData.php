
<?php
    include('../../DataBase/connection.php');
    session_start();

    unset($_SESSION['matchCapturedImage']);
    unset($_SESSION['backImgValue']);
    unset($_SESSION['frontCapturedImage']);

    //notifdate
    date_default_timezone_set('Asia/Manila');
    $currentDateTime = new DateTime();
    $databaseFormattedDate = $currentDateTime->format('Y-m-d H:i:s');

    $applicationdata = ucwords($_REQUEST["q"]);
    //we set as array the value we get from the java script to separate them
    $arrayApplicationData = explode("~~>", $applicationdata);

    $updateApplicationdata = "UPDATE application_data SET 
    landlord_id='$arrayApplicationData[0]', 
    property_id='$arrayApplicationData[21]', 
    past_address='".mysqli_real_escape_string($con, $arrayApplicationData[18])."',
    past_year='".mysqli_real_escape_string($con, $arrayApplicationData[23])."',
    Ocuupant_No='$arrayApplicationData[7]', 
    preferred_monthly_rent='$arrayApplicationData[24]',
    past_recidency_type='$arrayApplicationData[19]', 
    past_landlordname='".mysqli_real_escape_string($con, $arrayApplicationData[12])."', 
    past_landlordcontact='$arrayApplicationData[13]', 
    past_reason='".mysqli_real_escape_string($con, $arrayApplicationData[14])."', 
    current_complete_address='".mysqli_real_escape_string($con, $arrayApplicationData[8])."',
    current_year='".mysqli_real_escape_string($con, $arrayApplicationData[22])."',
    current_type_of_residence='$arrayApplicationData[15]',
    current_landlordname='".mysqli_real_escape_string($con, $arrayApplicationData[9])."', 
    current_contact_number='$arrayApplicationData[10]', 
    current_reason='".mysqli_real_escape_string($con, $arrayApplicationData[11])."', 
    evicted_info='$arrayApplicationData[16]',
    broke_lease='$arrayApplicationData[17]', 
    send_status='1', agreement='Ongoing' 
    WHERE renter_id='$arrayApplicationData[20]' AND send_status='0'";
    $executeapplicationdata = mysqli_query($con, $updateApplicationdata);

    $insertAdminNotif = "INSERT INTO admin_notification (landlord_id, renter_id, property_id, notif_info, date_notif, notif_status) 
    VALUES ('".$arrayApplicationData[0]."', '".$arrayApplicationData[20]."', '".$arrayApplicationData[21]."', 'Application', '$databaseFormattedDate', 'unread')";
    $executeInsertAdminNotif = mysqli_query($con, $insertAdminNotif);

    $insertlandlordNotif = "INSERT INTO landlord_notification (landlord_id, renter_id, property_id, notif_info, notif_date, notif_status) 
    VALUES ('".$arrayApplicationData[0]."', '".$arrayApplicationData[20]."', '".$arrayApplicationData[21]."', 'Application', '$databaseFormattedDate', 'unread')";
    $executeInsertLandlordNotif = mysqli_query($con, $insertlandlordNotif);
?>