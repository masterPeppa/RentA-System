<?php
session_start();
$checkingCode = ucwords($_REQUEST["q"]);
$tempVerification = $_SESSION['verificationCode'];
$id = $_SESSION['identity'];

if($checkingCode == $tempVerification){
    echo "$tempVerification" . ",$id";
}
else{
    echo "Error!";
}
?>