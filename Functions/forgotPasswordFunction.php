<?php
    session_start();
    include ('../DataBase/connection.php');
        //getting the email address in textbox
        $userData = ucwords($_REQUEST["q"]);
        //since we have 2 data's such as email and security answer we will set $userData as array
        $arrayData = explode("," , $userData);
        //Checking data base if the Email is already in data base
        $rcheckDatabase = "SELECT * FROM user_renter WHERE rEmail='$arrayData[0]'";
        $rdatabaseResult = mysqli_query($con, $rcheckDatabase);
        $rcheckExistence = mysqli_num_rows($rdatabaseResult);
        $rgetData = mysqli_fetch_assoc($rdatabaseResult);

        $lcheckDatabase = "SELECT * FROM user_landlord WHERE lEmail='$arrayData[0]'";
        $ldatabaseResult = mysqli_query($con, $lcheckDatabase);
        $lcheckExistence = mysqli_num_rows($ldatabaseResult);
        $lgetData = mysqli_fetch_assoc($ldatabaseResult);

        if($rcheckExistence > 0){
            $email = $rgetData['rEmail'];
            $first_name = $rgetData['rFname'];
            $security = $rgetData['backupPhrase'];
            $securityData = $arrayData[1] . " " . $arrayData[2] . " " . $arrayData[3] . " " . $arrayData[4] . " " . $arrayData[5]
            . " " . $arrayData[6] . " " . $arrayData[7] . " " . $arrayData[8] . " " . $arrayData[9] . " " . $arrayData[10] . " " . $arrayData[11] . " " . $arrayData[12];
            if($security == strtolower($securityData)){
                include ('sendingNewPassLink.php');
                $_SESSION['userEmail'] = $email;
                echo "$email";
            }
            else{
                echo "error!";
                session_destroy();
            }
        }
        else if($lcheckExistence > 0){
            $email = $lgetData['lEmail'];
            $first_name = $lgetData['lFname'];
            $security = $lgetData['backupPhrase'];
            $securityData = $arrayData[1] . " " . $arrayData[2] . " " . $arrayData[3] . " " . $arrayData[4] . " " . $arrayData[5]
            . " " . $arrayData[6] . " " . $arrayData[7] . " " . $arrayData[8] . " " . $arrayData[9] . " " . $arrayData[10] . " " . $arrayData[11] . " " . $arrayData[12];
            if($security == strtolower($securityData)){
                include ('sendingNewPassLink.php');
                $_SESSION['userEmail'] = $email;
                echo "$email";
            }
            else{
                echo "error!";
                session_destroy();
            }
        }
        else{
            echo "error!";
            session_destroy();
        }
        // Close the database connection
mysqli_close($con);
?>