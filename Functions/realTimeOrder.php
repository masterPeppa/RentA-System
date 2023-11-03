<?php
include('../DataBase/connection.php');
session_start();

if(isset($_SESSION['rEmail'])){
$activeUserId = $_POST['send'];
$landlordId = $_POST['receive'];

//check if the user already messsage the landlord
$selectConnection = "SELECT * FROM conectivity_status WHERE landlord_id='$activeUserId' OR renter_id='$activeUserId'";
$executeConnection = mysqli_query($con, $selectConnection);
$getConnection = mysqli_num_rows($executeConnection);

$latestMessage = "SELECT * FROM users_messages WHERE (sender ='".$activeUserId."' OR receiver = '"
.$activeUserId ."')
ORDER BY date_sent DESC";
$executelatest = mysqli_query($con, $latestMessage);
                    $getLatestMessage = mysqli_fetch_assoc($executelatest);
                    $checkHasValue = mysqli_num_rows($executelatest);
                    if($checkHasValue > 0 ){
                        $recentChat = $getLatestMessage['message'];
                    }
                    else{
                        $recentChat = "";
                    }  


                    if ($getConnection > 0) {
                        $sortedConnections = array();
                    
                        while ($connection = mysqli_fetch_assoc($executeConnection)) {
                            $landlordId = $connection['landlord_id'];
                    
                            $latestNotif = "SELECT * FROM users_messages WHERE (sender ='".$landlordId."' AND receiver = '"
                            .$activeUserId ."') OR (sender = '".$activeUserId."' AND receiver = '".$landlordId."')
                            ORDER BY date_sent DESC";
                            $executelatestnotif = mysqli_query($con, $latestNotif);
                            $getLatestNotif = mysqli_fetch_assoc($executelatestnotif);
                    
                            $selectLandlord = "SELECT * FROM user_landlord WHERE lID='$landlordId'";
                            $executeLandlord = mysqli_query($con, $selectLandlord);
                            $selectUserMessagebox = mysqli_fetch_assoc($executeLandlord);
                    
                            // Check if valid data was fetched
                            if ($selectUserMessagebox) {
                                $sortedConnections[] = array(
                                    'landlordId' => $landlordId,
                                    'userProfile' => str_replace("../", "", $selectUserMessagebox['lImgProfile']),
                                    'userName' => ucwords($selectUserMessagebox['lFname']) . " " . ucwords($selectUserMessagebox['lLname']),
                                    'message' => $getLatestNotif['message'],
                                    'date_sent' => $getLatestNotif['date_sent'],
                                    'message_status' => $getLatestNotif['sent_status']
                                );
                            }
                        }

                        usort($sortedConnections, function($a, $b) {
                            return strtotime($b['date_sent']) - strtotime($a['date_sent']);
                        });
                        
                        foreach ($sortedConnections as $connection) {
                            $dbdatetime = $connection['date_sent'];
                            $datetime = new DateTime($dbdatetime);
                            $time = $datetime->format('H:i');
                            ?>
                            <a href="messages.php?landlordId=<?php echo $connection['landlordId'] ?>">

                            <div class="d-flex justify-content-between px-1 ">

                                <div class="message-details d-flex align-items-center gap-3 mb-3">
                                    <div class="">
                                        <img src="<?php echo $connection['userProfile'] ?>" alt="" style="width: 75px;">
                                    </div>

                                    <div class="d-flex flex-column gap-2">
                                    <?php if ($connection['message_status'] == "unsent") { 
                                        ?>
                                        <b><p class="sender-text"><?php echo $connection['userName']; ?></p></b>
                                        <b><p class="sender-text"><?php echo $connection['message']; ?></p></b>
                                    <?php } 
                                    
                                    else { ?>
                                        <p class="sender-text"><?php echo $connection['userName']; ?></p>
                                        <p class="sender-text"><?php echo $connection['message']; ?></p>
                                    <?php } ?>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center d-xl-flex d-lg-none d-md-none d-sm-flex d-flex">
                                    <?php if ($connection['message_status'] == "unsent") { 
                                            ?>
                                        <b><span class="sender-text pe-3"><?php echo $time ?></span></b>
                                        <?php } 
                                        
                                        else { ?>
                                            <span class="sender-text pe-3"><?php echo $time ?></span>
                                            <?php } ?>
                                </div>                            </div>
                            </a>
                            <?php
                        }                        
                    }
                }


if(isset($_SESSION['lEmail'])){
    $activeUserId = $_POST['send'];
    $renterId = $_POST['receive'];
                    
    //check if the user already messsage the landlord
    $selectConnection = "SELECT * FROM conectivity_status WHERE landlord_id='$activeUserId' OR renter_id='$activeUserId'";
    $executeConnection = mysqli_query($con, $selectConnection);
    $getConnection = mysqli_num_rows($executeConnection);
                    
    $latestMessage = "SELECT * FROM users_messages WHERE (sender ='".$activeUserId."' OR receiver = '"
    .$activeUserId ."')
    ORDER BY date_sent DESC";
    $executelatest = mysqli_query($con, $latestMessage);
    $getLatestMessage = mysqli_fetch_assoc($executelatest);
    $checkHasValue = mysqli_num_rows($executelatest);
    if($checkHasValue > 0 ){
        $recentChat = $getLatestMessage['message'];
    }
    else{
        $recentChat = "";
    }  


    if ($getConnection > 0) {
        $sortedConnections = array();
    
        while ($connection = mysqli_fetch_assoc($executeConnection)) {
            $renterId = $connection['renter_id'];
    
            $latestNotif = "SELECT * FROM users_messages WHERE (sender ='".$renterId."' AND receiver = '"
            .$activeUserId ."') OR (sender = '".$activeUserId."' AND receiver = '".$renterId."')
            ORDER BY date_sent DESC";
            $executelatestnotif = mysqli_query($con, $latestNotif);
            $getLatestNotif = mysqli_fetch_assoc($executelatestnotif);
    
            $selectrenter = "SELECT * FROM user_renter WHERE rId='$renterId'";
            $executerenter = mysqli_query($con, $selectrenter);
            $selectUserMessagebox = mysqli_fetch_assoc($executerenter);
    
            // Check if valid data was fetched
            if ($selectUserMessagebox) {
                $sortedConnections[] = array(
                    'renterId' => $renterId,
                    'userProfile' => str_replace("../", "", $selectUserMessagebox['rImgProfile']),
                    'userName' => ucwords($selectUserMessagebox['rFname']) . " " . ucwords($selectUserMessagebox['rLname']),
                    'message' => $getLatestNotif['message'],
                    'date_sent' => $getLatestNotif['date_sent'],
                    'message_status' => $getLatestNotif['receive_status']
                );
            }
        }

        usort($sortedConnections, function($a, $b) {
            return strtotime($b['date_sent']) - strtotime($a['date_sent']);
        });
        
        foreach ($sortedConnections as $connection) {
            $dbdatetime = $connection['date_sent'];
            $datetime = new DateTime($dbdatetime);
            $time = $datetime->format('H:i');
            ?>
            <a href="messages.php?renterId=<?php echo $connection['renterId'] ?>">

                <div class="d-flex justify-content-between px-1  ">

                    <div class="message-details d-flex align-items-center gap-3 mb-3">
                        <div class="">
                            <img src="<?php echo $connection['userProfile'] ?>" alt="" style="width: 75px;" class="img-sender">
                        </div>

                        <div class="d-flex flex-column gap-2 ">
                        <?php if ($connection['message_status'] == "unread") { 
                            ?>
                            <b><p class="sender-text"><?php echo $connection['userName']; ?></p></b>
                            <b><p class="sender-text "><?php echo $connection['message']; ?></p></b>
                        <?php } 
                        
                        else { ?>
                            <p class="sender-text"><?php echo $connection['userName']; ?></p>
                            <p class="sender-text"><?php echo $connection['message']; ?></p>
                        <?php } ?>
                        </div>
                    </div>

                    <div class="align-items-center d-xl-flex d-lg-none d-md-none d-sm-flex d-flex">
                    <?php if ($connection['message_status'] == "unread") { 
                            ?>
                        <b><span class="sender-text pe-3"><?php echo $time ?></span></b>
                        <?php } 
                        
                        else { ?>
                            <span class="sender-text pe-3"><?php echo $time ?></span>
                        <?php } ?>
                    </div>
                </div>
            </a>
            <?php
        }
    }
}
?>