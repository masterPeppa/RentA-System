<?php
    include('../DataBase/connection.php');
    session_start();
    if(!isset($_SESSION['searchdata'])){

    $filterData = $_REQUEST["q"];
    $filterList = explode("~~", $filterData);
    $filterSessions = [];

    if($filterList[0] != "Any"){
        $_SESSION['filterPropertytype'] = $filterList[0];
    }
    if($filterList[1] != "null"){
        $_SESSION['txtLocation1'] = $filterList[1];
        $searchLocation = preg_split('/[\s,]+/', $filterList[1]);
        if(count($searchLocation) == 2){
            $_SESSION['txtLocation1'] = $searchLocation[0];
            $_SESSION['txtLocation2'] = $searchLocation[1];
        }
        else if(count($searchLocation) == 3){
            $_SESSION['txtLocation1'] = $searchLocation[0];
            $_SESSION['txtLocation2'] = $searchLocation[1];
            $_SESSION['txtLocation3'] = $searchLocation[2];
        }
        else if(count($searchLocation) == 4){
            $_SESSION['txtLocation1'] = $searchLocation[0];
            $_SESSION['txtLocation2'] = $searchLocation[1];
            $_SESSION['txtLocation3'] = $searchLocation[2];
            $_SESSION['txtLocation4'] = $searchLocation[3];
        }
    }
    if($filterList[4] != "Any"){
        $_SESSION['filterbedcount'] = $filterList[4];
    }
    if($filterList[5] != "Any"){
        $_SESSION['filterbathcount'] = $filterList[5];
    }
    if($filterList[6] != "null"){
        $_SESSION['filterAmenities'] = $filterList[6];
    }
    if($filterList[7] != "Any Size"){
        if($filterList[7] == "Below 20m2"){
            $_SESSION['choiceNumber'] = 1;
        }
        else if($filterList[7] == "21m2 - 50m2"){
            $_SESSION['choiceNumber'] = 2;
        }
        else if($filterList[7] == "51m2 - 100m2"){
            $_SESSION['choiceNumber'] = 3;
        }
        else{
            $_SESSION['choiceNumber'] = 4;
        }
    }
    if($filterList[2] == 0 && $filterList[3] == 100000){
        unset($_SESSION['priceRange']);
    }
    else{
        $_SESSION['min'] = $filterList[2];
        $_SESSION['max'] = $filterList[3];
        $_SESSION['priceRange'] = "exist";
    }
    }
    else{
        $_SESSION['txtLocation1'] = $_SESSION['searchdata'];
        $searchLocation = preg_split('/[\s,]+/', $_SESSION['searchdata']);
        if(count($searchLocation) == 2){
            $_SESSION['txtLocation1'] = $searchLocation[0];
            $_SESSION['txtLocation2'] = $searchLocation[1];
        }
        else if(count($searchLocation) == 3){
            $_SESSION['txtLocation1'] = $searchLocation[0];
            $_SESSION['txtLocation2'] = $searchLocation[1];
            $_SESSION['txtLocation3'] = $searchLocation[2];
        }
        else if(count($searchLocation) == 4){
            $_SESSION['txtLocation1'] = $searchLocation[0];
            $_SESSION['txtLocation2'] = $searchLocation[1];
            $_SESSION['txtLocation3'] = $searchLocation[2];
            $_SESSION['txtLocation4'] = $searchLocation[3];
        }
        echo "<script>window.location.href = '../rentals.php'</script>";
    }
?>

