<?php
session_start();
include('../../DataBase/connection.php');
$propertyId = ucwords($_REQUEST["q"]);
$delete_query0 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE landlord_id='".$_SESSION['landlordId']."' AND propertyID='$propertyId'");
$delete_query1 = mysqli_query($con, "DELETE FROM landing_properties WHERE landlord_id='".$_SESSION['landlordId']."' AND propertyID='$propertyId'");
$delete_query2 = mysqli_query($con, "DELETE FROM user_favorites WHERE favorite_id='$propertyId'");
$delete_query3 = mysqli_query($con, "DELETE FROM application_data WHERE property_id='$propertyId'");
$delete_query4 = mysqli_query($con, "DELETE FROM lease WHERE property_id='$propertyId'");
$delete_query5 = mysqli_query($con, "DELETE FROM feedback_data WHERE property_id='$propertyId'");
$delete_query6 = mysqli_query($con, "DELETE FROM complaints_data WHERE property_id='$propertyId'");
$delete_query7 = mysqli_query($con, "DELETE FROM receipt WHERE property_id='$propertyId'");
// Close the database connection
mysqli_close($con);
?>