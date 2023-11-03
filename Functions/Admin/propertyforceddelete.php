<?php
    include ('../../DataBase/connection.php');
    $prop_id = $_REQUEST["q"];
    $selectlandlord = "SELECT * FROM landing_properties WHERE propertyID='$prop_id'";
    $executelandlord = mysqli_query($con, $selectlandlord);
    $row_landlord = mysqli_fetch_assoc($executelandlord);

    echo $row_landlord['landlord_id']."~>".$row_landlord['propertyTitle'];

    $delete_query = mysqli_query($con, "DELETE FROM landing_properties WHERE propertyID='$prop_id'");
    $delete_query1 = mysqli_query($con, "DELETE FROM landing_properties_new WHERE propertyID='$prop_id'");
    $delete_query2 = mysqli_query($con, "DELETE FROM application_data WHERE property_id='$prop_id'");
    $delete_query3 = mysqli_query($con, "DELETE FROM complaints_data WHERE property_id='$prop_id'");
    $delete_query4 = mysqli_query($con, "DELETE FROM feedback_data WHERE property_id='$prop_id'");
    $delete_query5 = mysqli_query($con, "DELETE FROM lease WHERE property_id='$prop_id'");
    $delete_query6 = mysqli_query($con, "DELETE FROM receipt WHERE property_id='$prop_id'");
    $delete_query7 = mysqli_query($con, "DELETE FROM user_favorites WHERE favorite_id='$prop_id'");
?>