<?php
include('../DataBase/connection.php');
session_start();

if(isset($_SESSION['rEmail'])){
$sender = $_POST['send'];
$receiver = $_POST['receive'];
$ownerProfile = $_POST['owner'];
$userProfile = $_POST['user'];

$output ="";
$chats = "SELECT * FROM users_messages WHERE (sender ='".$sender."' AND receiver = '"
    . $receiver."') OR (sender = '".$receiver."' AND receiver = '".$sender."')";
    $executeChat = mysqli_query($con, $chats);

    $unreadcount = "SELECT * FROM users_messages WHERE receive_status='unread'";
    $executeunreadcount = mysqli_query($con, $unreadcount);
    $getunreadcount = mysqli_num_rows($executeunreadcount);

    $updateReceiveData = "UPDATE users_messages SET sent_status='sent', receive_status='read' WHERE sender='$receiver' AND receive_status='read'";
    $update_executed = mysqli_query($con, $updateReceiveData);
    $iterationCount = 1;
// RENTER
while($chat = mysqli_fetch_assoc($executeChat)){
    $dbdatetime = $chat['date_sent'];
    $datetime = new DateTime($dbdatetime);
    $time = $datetime->format('m-d-Y H:i');
    $iterationCount++;
    if($chat["sender"] == $sender){ 
        //sending
        $output .= 
        // OUTGOING
        "
        <div class='chat outgoing' style='display: flex; justify-content: flex-end; align-items: flex-end; gap: 10px; '>
            <span style='font-size: 10px;'>$time</span>
            <div class='details' style='max-width: 500px; 
                    @media only screen and (max-width: 768px){
                        .details{
                            max-width: 380px !important; }
                    }'>
                    <p style='background: #d5bfff; border-radius: 20px 20px 0 20px;'> ".$chat['message']." </p>
                    
                </div>";

                if(trim($chat['receive_status']) == "unread"){
                    $output .= "<span> <img src='imgs/delivered.png' class='delivered' style='width: 15px; height: 15px;
                                @media only screen and (max-width: 768px){
                                    .details{
                                        max-width: 380px !important; }
                            }'></span>";
                        }
                    else{
                        if($iterationCount+$getunreadcount <= mysqli_num_rows($executeChat)){
                            $output .= "<span style='visibility: hidden;'> <img src='$ownerProfile' class='seen' style='width: 15px !important; 
                                @media only screen and (max-width: 768px){
                                    .seen{
                                    max-width: 380px !important; }
                                }'></span>";
                        }
                        else{
                        $output .= "<span> <img src='$ownerProfile' class='seen' style='width: 15px !important; height: 15px;
                                @media only screen and (max-width: 768px){
                                    .seen{
                                    max-width: 380px !important; }
                                }'></span>";
                        }
                    }
                    $output .= "</div>";
    }
    else{
        //receiving
        $output .= 
        // INCOMING
        "<div class='chat incoming' style='display: flex; justify-content: space-between; '>

            <div style='display: flex;'>
                <div style='display: flex; align-items: flex-end; gap: 10px;'>
                    <img src='$ownerProfile' alt='profile' style='height: 50px; width: 50px;'>
                        <div class='details' style='margin-left: 10px; margin-right: auto; max-width: 550px; 
                            @media only screen and (max-width: 768px){
                                .details{
                                    max-width: 380px !important; }
                            }'>
                            <p style='background: #fff !important; border-radius: 18px 18px 18px 0;'>".$chat['message']."</p>
                        </div>
                    </div>
                    <span style='font-size: 10px; display: flex; align-items: end'>$time</span>
                </div>";
            

            if($iterationCount+$getunreadcount <= mysqli_num_rows($executeChat)){
                $output .= "<span style='visibility: hidden; align-items:end'> 
                <img src='$ownerProfile' class='seen' style='width: 15px !important; height: 15px; '> 
                </span>";
            }
            else{
                $output .= "<span style='display:flex; align-items:end'> 
                <img src='$ownerProfile' class='seen' style='width: 15px !important; height: 15px; '> 
                </span>";
                }
            $output .= "</div>";

    }
}

echo $output;
}

else if(isset($_SESSION['lEmail'])){
    $sender = $_POST['send'];
    $receiver = $_POST['receive'];
    $ownerProfile = $_POST['owner'];
    $userProfile = $_POST['user'];
    
    $output ="";
    $chats = "SELECT * FROM users_messages WHERE (sender ='".$sender."' AND receiver = '"
        . $receiver."') OR (sender = '".$receiver."' AND receiver = '".$sender."')";
        $executeChat = mysqli_query($con, $chats);

    $unsentCount = "SELECT * FROM users_messages WHERE sent_status='unsent'";
    $executeunsentChat = mysqli_query($con, $unsentCount);
    $getunsentcount = mysqli_num_rows($executeunsentChat);

    $updateReceiveData = "UPDATE users_messages SET receive_status='read', sent_status='sent' WHERE sender='$receiver' AND sent_status='sent'";
    $update_executed = mysqli_query($con, $updateReceiveData);
    $iterationCount = 1;
    
// LANDLORD
    while($chat = mysqli_fetch_assoc($executeChat)){
    $dbdatetime = $chat['date_sent'];
    $datetime = new DateTime($dbdatetime);
    $time = $datetime->format('m-d-Y H:i');
    $iterationCount++;
        if($chat["sender"] == $sender){
            //sending
            $output .= 
            // OUTGOING
            "<div class='chat outgoing' style='display: flex; justify-content: flex-end; align-items: flex-end; gap: 10px; '>
                <span style='font-size: 10px;'>$time</span>
                    <div class='details' style='max-width: 500px; 
                        @media only screen and (max-width: 768px){
                            .details{
                                max-width: 380px !important; }
                        }'>
                        <p style='background: #d5bfff; border-radius: 20px 20px 0 20px;'> ".$chat['message']." </p>
                    </div>";
                    
            if(trim($chat['sent_status']) == "unsent"){
            $output .= "<span> <img src='imgs/delivered.png' class='delivered' style='width: 15px; height: 15px;
                        @media only screen and (max-width: 768px){
                            .details{
                                max-width: 380px !important; }
                    }'></span>";

                }
            else{
                if($iterationCount+$getunsentcount <= mysqli_num_rows($executeChat)){
                    $output .= "<span style='visibility: hidden;'> <img src='$ownerProfile' class='seen' style='width: 15px !important; height: 15px;
                        @media only screen and (max-width: 768px){
                            .seen{
                            max-width: 380px !important; }
                        }'></span>";
                }
                else{
                $output .= "<span> <img src='$ownerProfile' class='seen' style='width: 15px !important; height: 15px;
                        @media only screen and (max-width: 768px){
                            .seen{
                            max-width: 380px !important; }
                        }'></span>";
                    }
            }
            $output .= "</div>";
        }
        else{
            //receiving
            $output .= 
            // INCOMING
            "<div class='chat incoming' style='display: flex; justify-content: space-between; '>
    
                <div style='display: flex;'>
                    <div style='display: flex; align-items: flex-end; gap: 10px;'>
                        <img src='$ownerProfile' alt='profile' style='height: 50px; width: 50px;'>
                            <div class='details' style='margin-left: 10px; margin-right: auto; max-width: 550px; 
                                @media only screen and (max-width: 768px){
                                    .details{
                                        max-width: 380px !important; }
                                }'>
                                <p style='background: #fff !important; border-radius: 18px 18px 18px 0;'>".$chat['message']."</p>
                            </div>
                        </div>
                        <span style='font-size: 10px; display: flex; align-items: end'>$time</span>
                    </div>";
                
    
                if($iterationCount+$getunsentcount <= mysqli_num_rows($executeChat)){
                    $output .= "<span style='visibility: hidden; align-items:end'> 
                    <img src='$ownerProfile' class='seen' style='width: 15px !important; height: 15px; '> 
                    </span>";
                }
                else{
                    $output .= "<span style='display:flex; align-items:end'> 
                    <img src='$ownerProfile' class='seen' style='width: 15px !important; height: 15px; '> 
                    </span>";
                    }
                $output .= "</div>";
    
        }
    }
    echo $output;
    }

    
?>