<?php
include('../../DataBase/connection.php');
$propertyid = $_POST['propertyid'];
$txtValue = $_POST['txtValue'];

$selectlease = "SELECT * FROM lease WHERE property_id='$propertyid' AND (lease_status='moved-out' OR lease_status='confirmed-moved-out')";
$executelease = mysqli_query($con, $selectlease);
$row_lease = mysqli_fetch_assoc($executelease);
$row_lease_count = mysqli_num_rows($executelease);

if($row_lease_count > 0){
    if($txtValue == "available"){
        $update_lease="UPDATE lease SET lease_status='moved-out' WHERE property_id='$propertyid' AND lease_status='confirmed-moved-out'";
        $new_update_executed=mysqli_query($con,$update_lease);

        $update_landing_properties="UPDATE landing_properties SET renting_status='unavailable' WHERE propertyID='$propertyid'";
        $newnlanding_properties=mysqli_query($con,$update_landing_properties);
    }
    else{
        $update_lease="UPDATE lease SET lease_status='confirmed-moved-out' WHERE property_id='$propertyid' AND lease_status='moved-out'";
        $new_update_executed=mysqli_query($con,$update_lease);

        $update_landing_properties="UPDATE landing_properties SET renting_status='available' WHERE propertyID='$propertyid'";
        $newnlanding_properties=mysqli_query($con,$update_landing_properties);
    }
}
else {
    if($txtValue == "available"){
        $update_landing_properties="UPDATE landing_properties SET renting_status='unavailable' WHERE propertyID='$propertyid'";
        $newnlanding_properties=mysqli_query($con,$update_landing_properties);
    }
    else{
        $update_landing_properties="UPDATE landing_properties SET renting_status='available' WHERE propertyID='$propertyid'";
        $newnlanding_properties=mysqli_query($con,$update_landing_properties);
    }
}
// Close the database connection
mysqli_close($con);
?>