<?php
    //Connection of database
    include('../../DataBase/connection.php');
    //start Session
    session_start();
    $renterId = $_POST['userid'];
    $landlordid = $_POST['landlordid'];

    $select_lease = "SELECT * FROM lease WHERE renter_id ='$renterId' AND move_in_data != '0000-00-00'";
    $execute_lease = mysqli_query($con, $select_lease);
    $checklease = mysqli_fetch_assoc($execute_lease);
    $checkexislease = mysqli_num_rows($execute_lease);

    echo "<h3 class='mt-5 txt-havent text-center'>Your home is waiting for you!</h3>";

    if($checkexislease > 0){
        $date = $checklease['move_in_data'];
        $datedbformat = new DateTime($date);
        $formatted_date = $datedbformat->format('F d, Y');
        
        echo "<h5 class='text-center date-set'>Your move-in date is on <span class='move-in-date'>$formatted_date.</span></h5>
            <a onclick='movedin()' role='button' class='px-4 py-2 btns-application btn-moved'>I have moved in</a>";
    }
    else{
        echo "<h5 class='text-center date-not-yet'>Move-in date is not yet set.</span></h5>
                    <a href='../messages.php?landlordId=$landlordid' role='button' class='px-4 py-2 btns-application btn-moved'>
                    <span>
                        <i class='bi bi-chat-heart-fill pe-1'></i>
                    </span>Message
                    </a>";
    }
    mysqli_close($con);
?>