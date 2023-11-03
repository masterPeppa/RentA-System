<?php
    session_start();
    $checkData = $_REQUEST["q"];
    $textArray = explode("~~", $checkData);

    if($textArray[1] == "searchdata"){
        $_SESSION['searchdata'] = $textArray[0];
    }
    else if($textArray[1] == "messagedata"){
        $_SESSION['firstMessage'] = $textArray[0];
    }
?>