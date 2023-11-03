<?php
    include ('../DataBase/connection.php');
    include ("../Functions/commonFunctions.php");
    session_start();
    if(isset($_SESSION['lEmail'])){
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentA | List a Property</title>
    <link rel="icon" type="image/x-icon" href="../imgs/key.ico">

    
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    
    <!-- CSS -->
    <link rel="stylesheet" href="../CSS/">
    <link rel="stylesheet" href="../CSS/stylesListAProperty.css">
    <link rel="stylesheet" href="../CSS/stylesNav.css">

    <!-- Jquery Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    
    <!-- map api -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- JavaScript-->
    <script defer src="../JavaScripts/listPropertyQuery.js"></script>
    <script defer src="../JavaScripts/listPropertyQuery1.js"></script>
    <script src="../JavaScripts/functionNav.js"></script>
</head>
<body>
    <!-- map function -->
<script>
    function blurFunction(){
            var up = document.getElementById("chevron-up-manage");
            var down = document.getElementById("chevron-down-manage");
            var upAvatar = document.getElementById("chevron-up-avatar");
            var downAvatar = document.getElementById("chevron-down-avatar");
            var upAvatar2 = document.getElementById("chevron-up-avatar2");
            var downAvatar2 = document.getElementById("chevron-down-avatar2");

            up.style.display = "none";
            down.style.display = "inline-block";

            upAvatar.style.display = "none";
            downAvatar.style.display = "inline-block";

            upAvatar2.style.display = "none";
            downAvatar2.style.display = "inline-block";
        }
    //the blue marker in the map
    var currentMarker;
    document.addEventListener('DOMContentLoaded', function() {
        
        // Create a map centered at a specific location
        // the location we set is malolos
        var map = L.map('locationInputDiv').setView([14.8527, 120.8160], 13);
        
        // Add a tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Add click event listener to the map
        map.on('click', function(e) {
            var latitude = e.latlng.lat; // Latitude of the clicked point
            var longitude = e.latlng.lng; // Longitude of the clicked point

            //set the latitude and longitude text
            document.getElementById('longitude').value = longitude;
            document.getElementById('latitude').value  = latitude;
            
            getNearbyPlaces();
            //run this function to update the text in the location textbox
            getPlaceName(latitude, longitude);
            // If a marker already exists, remove it from the map
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }
            locationTextbox();
            // Create a new marker at the clicked location
            currentMarker = L.marker([latitude, longitude]).addTo(map);
        });

        // Check if Geolocation is supported by the browser
        if ('geolocation' in navigator) {
            // Get the user's current location
            navigator.geolocation.getCurrentPosition(function(position) {
                if(document.getElementById('longitude').value == ""){
                    var userLatitude = position.coords.latitude;
                    var userLongitude = position.coords.longitude;

                    // Create a marker for the user's current location
                    currentMarker = L.marker([userLatitude, userLongitude]).addTo(map);

                    // Center the map on the user's location
                    map.setView([userLatitude, userLongitude], 13);
                    //set te longitude and latitude text as current long itude and latitude
                    document.getElementById('longitude').value = userLatitude;
                    document.getElementById('latitude').value = userLongitude;
                    $('#btnLocation').attr('src', '../imgs/add1.png');
                    //update the textbox in location textboxes
                    getPlaceName(userLatitude, userLongitude);
                    getNearbyPlaces();

                    //remove the current marker
                    if (currentMarker) {
                        map.removeLayer(currentMarker);
                    }

                    // and add a new one
                    currentMarker = L.marker([userLatitude, userLongitude]).addTo(map);
                }
            }, 
            function(error) {
                console.error('Error getting user location:', error.message);
            });
        } 
        else {
            console.log('Geolocation is not available in this browser.');
        }

        // Function to get the name of the place using reverse geocoding
        function getPlaceName(latitude, longitude) {
        var apiUrl = `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`;

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
            if (data && data.address) {
                //getting the location values for textbox
                var city = data.address.municipality || '';
                var province = data.address.state || '';
                var barangay = data.display_name.split(',');
                var region = data.address.region || '';
                // Check if city is empty, use the town or village or the 2nd value in diplay_name
                if (!city && data.address.town) 
                {
                    city = data.address.town;
                } 
                else if (!city && data.address.village)
                {
                    city = data.address.village;
                }
                else{
                    city = barangay[1];
                }
                //set the textboxes in location
                document.getElementById('region').value = `${region}`;
                document.getElementById('province').value = `${province}`;
                document.getElementById('city').value = `${city}`;
                document.getElementById('barangay').value = barangay[0];
                document.getElementById('longitude').value = longitude;
                document.getElementById('latitude').value = latitude;
                //remove the current blue marker and
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }
                getNearbyPlaces();
                // add a new one
                currentMarker = L.marker([latitude, longitude]).addTo(map);
            }
        })
        .catch(error => console.error('Error fetching place name:', error));
    }

    // function for textboxes in location if the user change it
    function handleLocationChange() {
        var province = document.getElementById('province').value;
        var city = document.getElementById('city').value;
        var region = document.getElementById('region').value;
        var barangay = document.getElementById('barangay').value;

        // create an string that matched to the result given by leaflet
        var locationString = `${barangay}, ${city}, ${province}, ${region}, Philippines`;

        // getting the longitude and latitude
        var geocodeUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(locationString)}`;

        fetch(geocodeUrl)
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
            var latitude = data[0].lat;
            var longitude = data[0].lon;

            // Update the latitude and longitude textboxes
            document.getElementById('longitude').value = longitude;
            document.getElementById('latitude').value = latitude;

            // Update the map and marker
            getNearbyPlaces();
            updateMapAndMarker(latitude, longitude);
            }
        })
        .catch(error => console.error('Error fetching geocoding data:', error));
    }

    // Add event listeners to the location textboxes
    document.getElementById('province').addEventListener('change', handleLocationChange);
    document.getElementById('city').addEventListener('change', handleLocationChange);
    document.getElementById('region').addEventListener('change', handleLocationChange);
    document.getElementById('barangay').addEventListener('change', handleLocationChange);

    // ... (existing code)

    // Function to update the map and marker
    function updateMapAndMarker(latitude, longitude) {
        if (currentMarker) {
        map.removeLayer(currentMarker);
        }

        // Create a new marker at the updated location
        currentMarker = L.marker([latitude, longitude]).addTo(map);

        // Center the map on the updated location
        map.setView([latitude, longitude], 13);
    }
    //function for converting the latitude and longitude to km
    function haversineDistance(latitudeFrom, longitudeFrom, latitudeTo, longitudeTo) {
        // Earth's radius in kilometers
        const earthRadius = 6578; 

        const latDiff = (latitudeTo - latitudeFrom) * (Math.PI / 180);
        const lonDiff = (longitudeTo - longitudeFrom) * (Math.PI / 180);

        const a = Math.sin(latDiff / 2) * Math.sin(latDiff / 2) +
                    Math.cos(latitudeFrom * (Math.PI / 180)) * Math.cos(latitudeTo * (Math.PI / 180)) *
                    Math.sin(lonDiff / 2) * Math.sin(lonDiff / 2);
        
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        const distance = earthRadius * c;

        return distance;
    }

    // Function to get nearby places from the JSON file
    function getNearbyPlaces() {
    fetch('../JavaScripts/addressJSON/landmarks.json')
        .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }
        // Parse the JSON data from the response
        return response.json();
        })
        .then(data => {
        // Check if data is an array
        if (!Array.isArray(data.landmarks)) {
            throw new Error('Invalid data format. Expected an array.');
        }

        // Get the current latitude and longitude from the textboxes
        var latitude = parseFloat(document.getElementById('latitude').value);
        var longitude = parseFloat(document.getElementById('longitude').value);

        // Find nearby places based on latitude and longitude
        var nearbyPlaces = data.landmarks.filter(place => {
        var distance = haversineDistance(latitude, longitude, place.latitude, place.longitude);
        // Convert distance to kilometers
        place.distanceInKm = distance;
        // Consider places within 5 kilometers (adjust as needed)
        return distance <= 5; 
        });
        var placesToLog = nearbyPlaces.slice(0, 4)
        var NearbyInfo = "";
        //set the data into a textbox
        placesToLog.forEach(place => {
            NearbyInfo += `${place.name}` + "," + `${place.info}` + "," + `${place.distanceInKm.toFixed(2)}` + "km" + "~";
        });
        // Store the information of all 4 nearby places in the 'nearbyPlaces' element
        document.getElementById('nearbyPlaces').value = NearbyInfo;
        })
        .catch(error => console.error('Error fetching nearby places data:', error));
    }
});

            setInterval(function(){
                $.ajax({
                    url:"../Functions/Landlord/realtimeNotifCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/Landlord/realtimeNotifCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smNotifCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeMessageCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#messageCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeMessageCount.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smmessageCount").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#notifyCircle").html(data);
                    }
                });
            }, 700);
            setInterval(function(){
                $.ajax({
                    url:"../Functions/realtimeNotif.php",
                    method:"POST",
                    data:{
                        userid:$("#txtUserId").val()
                    },
                    dataType:"text",
                    success:function(data)
                    {
                        $("#smnotifyCircle").html(data);
                    }
                });
            }, 700);

    function getMessageLink(){
        document.getElementById('txtLinkValues').value = "message";
    }
    function getAdvancePaymentLink(){
        document.getElementById('txtLinkValues').value = "advance";
    }
    function getprofileLink(){
        document.getElementById('txtLinkValues').value = "profile";
    }
    function getLeaseLink(){
        document.getElementById('txtLinkValues').value = "lease";
    }
    function getResidentRentLink(){
        document.getElementById('txtLinkValues').value = "residentRent";
    }
    function getApprovedLink(){
        document.getElementById('txtLinkValues').value = "approved";
    }
    function getManageLink(){
        document.getElementById('txtLinkValues').value = "manage";
    }
    function getApplicantsLink(){
        document.getElementById('txtLinkValues').value = "applicants";
    }
    function getPropertiesLink(){
        document.getElementById('txtLinkValues').value = "properties";
    }
    function getIndexLink(){
        document.getElementById('txtLinkValues').value = "index";
    }
    function getNotificationLandlordLink(){
        document.getElementById('txtLinkValues').value = "notificationlandlord";
    }
    function changeLink(){
        var linkValue = document.getElementById('txtLinkValues').value;

        if(linkValue == "message"){
            window.location.href = "../messages.php";
        }
        else if(linkValue == "advance"){
            window.location.href = "manageAdvancePayments.php";
        }
        else if(linkValue == "residentRent"){
            window.location.href = "manageResidentsRent.php";
        }
        else if(linkValue == "profile"){
            window.location.href = "landlordProfile.php"
        }
        else if(linkValue == "lease"){
            window.location.href = "manageResidents.php"
        }
        else if(linkValue == "approved"){
            window.location.href = "manageLeases.php"
        }
        else if(linkValue == "manage"){
            window.location.href = "manageLeases.php"
        }
        else if(linkValue == "applicants"){
            window.location.href = "manageApplicants.php"
        }
        else if(linkValue == "properties"){
            window.location.href = "manageProperty.php";
        }
        else if(linkValue == "index"){
            window.location.href = "../../RentA";
        }
        else if(linkValue == "notificationlandlord"){
            window.location.href = "landlordNotifications.php";
        }
    }

    
</script>

<div class="container-fluid d-flex-flex-column">

<?php
    $landlordEmail = $_SESSION['lEmail'];
    $selectUser = "SELECT * FROM user_landlord WHERE lEmail	='$landlordEmail'";
    $executeSelectUser = mysqli_query($con, $selectUser);
    $lgetId = mysqli_fetch_assoc($executeSelectUser);
    $_SESSION['landlordId'] = $lgetId['lID'];
    ?>


<!-- Navbar - Landlord -->
<div class="nav-container fixed-top">
        <nav class="navbar navbar-expand-md px-3 px-md-5">
            <div class="container-fluid">
			<!-- for save condition -->
                <div class="d-none">
                    <input type="text" id="txtEmail" value="<?php echo $_SESSION['lEmail'];?>">
                </div>
                <!-- burger -->
                <button class="navbar-toggler collapsed d-flex d-sm-block d-md-none flex-column justify-content-around" type="button" data-bs-toggle="collapse" data-bs-target="#navMenuLandlord" >
                    <span class="toggler-icon top-bar"></span>
                    <span class="toggler-icon middle-bar"></span>
                    <span class="toggler-icon bottom-bar"></span>
                </button>

                <!-- logo -->
                <a class="navbar-brand" onclick="getIndexLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">
                    <img src="../imgs/logo.png" alt="RentA" id="imgLogo">
                </a>
                
                <!-- Avatar - Landlord on small screen -->
                <div class="dropdown ms-auto d-sm-block d-md-none">
                    <button onclick="dropdownAvatarFunction()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $lgetId['lImgProfile'] ?>" alt="" class="img-avatar me-1">
                        <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar"></i>
                        <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar"></i>
                        <div class="d-none">
                            <input type="text" id="txtUserId" value="<?php echo $lgetId['lID'] ?>">
                        </div>
                    <span id="smnotifyCircle">
                    </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-avatar-sm " aria-labelledby="dropdrownbtn-avatar">
                        <li>
                            <a class="dropdown-item dropdown-item-first d-flex justify-content-between" onclick="getNotificationLandlordLink()"  data-bs-toggle="modal" data-bs-target="#changeLinkModal" id="smNotifCount">
                                Notifications 
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-between" onclick="getMessageLink()"  data-bs-toggle="modal" data-bs-target="#changeLinkModal" id="smmessageCount">Messages 
                                
                            </a>
                        </li>
                        <li><a class="dropdown-item" onclick="getprofileLink()"  data-bs-toggle="modal" data-bs-target="#changeLinkModal">My Profile</a></li>
                        <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                    </ul>
                </div>

                <!-- links center -->
                <div class="collapse navbar-collapse" id="navMenuLandlord">

                    <ul class="navbar-nav navbar-nav-landlord d-flex align-items-center">
                        
                        <li class="nav-item px-3">
                            <a class="nav-link" onclick="getPropertiesLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">My Properties</a>
                        </li>

                        <!-- Manage Renters -->
                        <li class="nav-item dropdown d-none d-sm-none d-md-block">
                            <button onclick="dropdownManageFunction()" onblur="blurFunction()" class="btn active btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-manage" data-bs-toggle="dropdown" aria-expanded="false">
                                Manage Renters
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-manage"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-manage"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-manage" aria-labelledby="dropdrownbtn-manage">
                                <li><a class="dropdown-item dropdown-item-first" onclick="getApplicantsLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Applicants</a></li>
                                <li><a class="dropdown-item" onclick="getManageLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Leases</a></li>
                                <li><a class="dropdown-item active-dropdown" onclick="getAdvancePaymentLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Advance Payments</a></li>
                                <li><a class="dropdown-item" onclick="getLeaseLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Residents</a></li>
                                <li><a class="dropdown-item dropdown-item-last" onclick="getResidentRentLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Residents' Rents</a></li>
                            </ul>
                        </li>

                       <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" onclick="getApplicantsLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Applicants</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link " onclick="getManageLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Leases</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link active-dropdown" onclick="getAdvancePaymentLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Advance Payments</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" onclick="getLeaseLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Residents</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link" onclick="getResidentRentLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">Residents' Rents</a>
                        </li>

                        <li class="nav-item d-block d-sm-block d-md-none">
                            <a class="nav-link listProperty" onclick="checklistProperty1()">List a Property</a>
                        </li>

                    </ul>
                    
                    <ul class="d-flex align-items-center ms-auto">
                        <!-- Avatar - Landlord big-->
                        <div class="dropdown me-2 d-none d-sm-none d-md-block ">
                            <button onclick="dropdownAvatarFunction2()" onblur="blurFunction()" class="btn btn-light dropdown-toggle d-inline-block" type="button" id="dropdrownbtn-avatar" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="<?php echo $lgetId['lImgProfile'] ?>" alt="" class="img-avatar me-1">
                                <i class="bi bi-chevron-down nav-icons" id="chevron-down-avatar2"></i>
                                <i class="bi bi-chevron-up nav-icons" id="chevron-up-avatar2"></i>
                                <span id="notifyCircle">
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-avatar" aria-labelledby="dropdrownbtn-avatar">
                                <li>
                                    <a class="dropdown-item dropdown-item-first d-flex justify-content-between" onclick="getNotificationLandlordLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal" id="notifCount">
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between" onclick="getMessageLink()"  data-bs-toggle="modal" data-bs-target="#changeLinkModal" id="messageCount">
                                    </a>
                                </li>
                                <li><a class="dropdown-item " onclick="getprofileLink()" data-bs-toggle="modal" data-bs-target="#changeLinkModal">My profile</a></li>
                                <li><a class="dropdown-item dropdown-item-last" data-bs-toggle="modal" data-bs-target="#logoutModal">Log out</a></li>
                            </ul>
                        </div>

                        <!-- List property button -->
                        <div class=" nav-item d-none d-sm-none d-md-block">
                            <a onclick="checklistProperty1()" class="btn btns listProperty btn_listProperty pt-2">List a Property</a>
                        </div>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
    <div class="d-none">
        <input type="text" id="txtLinkValues" value="">
    </div>
<!-- end navbar - landlord -->

    <!-- modal confirmation logout -->
        <!-- <div class="modal fade container-logout" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body logoutmodalbody">
                    Are you sure you want to logout?
                </div>
                <div class="modal-footer logoutmodalfooter d-flex gap-3 p-3">
                    <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">No</button>
                    <button id="btnConfirmLogout" class="btn btn-danger px-3 py-1">Yes</button>
                </div>
                </div>
            </div>
        </div> -->

        <!-- MODAL NOT ENOUGH PHOTO -->
        <div class="modal fade" id="notEnoughPhotoModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals modal-not-enough-photo">

                    <!-- <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> -->

                    <div class="modal-body">
                        <div class="d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/warning.png" alt="" class="img-logout">
                            <h5 class="text-center mt-1">Please complete photo upload.</h5>
                        </div>
                    </div>

                    <!-- <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">Ok</button>
                        <a id="btnConfirmLogout" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                    </div> -->
                </div>
            </div>
        </div>
    <!-- modal end - LOGOUT -->

        <!-- MODAL LOGOUT -->
        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalLogout">

                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                                <img src="../imgs/logout.png" alt="" class="img-logout">
                                <h5 class="text-center mt-1">Are you sure you want to logout?</h5>
                            </div>
                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                        <a id="btnConfirmLogout" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - LOGOUT -->

        <!-- modal saving property -->
        <!-- <div class="modal fade container-logout" id="SaveProperty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body logoutmodalbody">
                    You are about to save this property to this site
                </div>
                <div class="modal-footer logoutmodalfooter d-flex gap-3 p-3">
                    <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Review</button>
                    <button id="btnConfirmPublish" class="btn btn-primary px-3 py-1">Confirm</button>
                </div>
                </div>
            </div>
        </div> -->

        <!-- modal saving property -->
        <!-- <div class="modal fade container-logout" id="SaveProperty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body logoutmodalbody">
                    You are about to save this property to this site
                </div>
                <div class="modal-footer logoutmodalfooter d-flex gap-3 p-3">
                    <button type="button" class="btn btn-secondary px-3 py-1" data-bs-dismiss="modal">Review</button>
                    <button id="btnConfirmPublish" class="btn btn-primary px-3 py-1">Confirm</button>
                </div>
                </div>
            </div>
        </div> -->

        <!-- MODAL SAVE PROPERTY -->
        <div class="modal fade" id="SaveProperty" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalCancel">

                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class="div-logout d-flex align-items-center justify-content-center mt-5">
                                <img src="../imgs/home.png" alt="" class="img-home">
                                <h5 class=" mt-1 ps-2"> You are about to save and publish your property. Confirm saving and publishing it to the website?  </h5>
                            </div>
                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">Review</button>
                        <a id="btnConfirmPublish" class="btn btn-confirm modal-logout-btns d-flex align-items-center justify-content-center">Confirm</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - SAVE PROPERTY -->

    <!-- SAVING WHEN NOT ALL INFO ARE FILLED UP -->
        <!-- <div class="modal fade container-logout" id="savingfailed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body logoutmodalbody">
                    Please complete fill in all information we needed
                </div>
                <div class="modal-footer logoutmodalfooter d-flex gap-3 p-3">
                    <button type="button" class="btn btn-primary px-3 py-1" data-bs-dismiss="modal">Ok</button>
                </div>
                </div>
            </div>
        </div> -->

        <!-- MODAL SAVING WHEN NOT ALL INFO ARE FILLED UP -->
        <div class="modal fade" id="savingfailed" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalCancel">

                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                                <img src="../imgs/warning.png" alt="" class="img-logout">
                                <h5 class="text-center mt-1"> Oops! Please fill out and complete all information needed about your property before publishing. </h5>
                            </div>
                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">Okay</button>
                        <!-- <a id="btnConfirmPublish" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Confirm</a> -->
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - SAVING WHEN NOT ALL INFO ARE FILLED UP -->

    <!-- CANCEL MODAL -->
        <!-- <div class="modal fade container-modal-cancel" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body cancel-modal-body">
                    Are your sure you want to cancel editing?
                </div>
                <div class="modal-footer logoutmodalfooter d-flex gap-3 p-3">
                    <button type="button" class="btn btn-primary px-3 py-1" data-bs-dismiss="modal">No</button>
                    <button onclick="Prev()" class="btn btn-danger px-3 py-1">Yes</button>
                </div>
                </div>
            </div>
        </div> -->

        <!-- MODAL CANCEL -->
        <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalCancel">

                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                                <img src="../imgs/question.png" alt="" class="img-logout">
                                <h5 class="text-center mt-2 txt-cancel"> You will lose all the changes that you've made. <br> Are you sure you want to cancel editing information about your property? </h5>
                            </div>
                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                        <a id="btnConfirmPublish" onclick="Prev()" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - CANCEL -->

        <!-- Go to other links modal -->
        <!-- <div class="modal fade container-logout" id="changeLinkModal" tabindex="-1" aria-labelledby="changeLinkModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body logoutmodalbody">
                    Are your sure you want to cancel editing?
                </div>
                <div class="modal-footer logoutmodalfooter d-flex gap-3 p-3">
                    <button type="button" class="btn btn-primary px-3 py-1" data-bs-dismiss="modal">No</button>
                    <button onclick="changeLink()" class="btn btn-danger px-3 py-1">Yes</button>
                </div>
                </div>
            </div>
        </div> -->

        <!-- MODAL Go to other links -->
        <div class="modal fade" id="changeLinkModal" tabindex="-1" aria-labelledby="logoutModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content modals container_modalCancel">

                    <div class="modal-header modal-header-logout p-3">
                        <button type="button" class="btn-close btn-close-logout" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body modal-body-logout">
                        <section class="section_logout">
                            
                            <div class="div-logout d-flex flex-column align-items-center justify-content-center mt-3">
                            <img src="../imgs/question.png" alt="" class="img-logout">
                                <h5 class="text-center mt-2 txt-cancel"> You will lose all the changes that you've made. <br> Are you sure you want to cancel editing information about your property? </h5>
                            </div>
                        </section>
                    </div>

                    <div class="modal-footer d-flex gap-2 p-3">
                        <button type="button" class="btn btn-cancel modal-logout-btns" data-bs-dismiss="modal">No</button>
                        <a id="btnConfirmPublish" onclick="changeLink()" class="btn btn-del modal-logout-btns d-flex align-items-center justify-content-center">Yes</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal end - Go to other links -->

        <!-- modal please wait -->
        <div class="modal container-logout" id="waitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-body logoutmodalbody">
                    Please wait... 
                </div>
                </div>
            </div>
        </div>

        <?php
        if(!isset($_GET['propId'])){
        ?>
        <!-- MAIN -->
        <div class="wrapper_listAProperty">

            <div class="row">
            <!-- SIDEBAR COLUMN -->
                <div class="col-3 col_sidebar d-flex flex-column d-md-block d-none">
                    
                    <div class="sidebar-wrapper position-fixed">
                    <!-- PROPERTY INFO -->
                    <a href="#PropertyInfo" class="sideMenuTxt sidebar-item" id="propInfoTxt">
                        <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="piDiv">
                            <p class="sidebarLbl sidebar-txt mt-1">Property Information</p>
                            
                            <span class="sidebarBtn">
                                <img id="btnProperty" src="../imgs/add1.png" alt="">
                            </span>
                        </div>
                    </a>

                    <!-- DETAILS -->
                    <a href="#Details" class="sideMenuTxt sidebar-item" id="propDetailsTxt">
                        <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="dDiv">
                            <p class="sidebarLbl sidebar-txt mt-1">Details</p>
                            
                            <span class="sidebarBtn">
                                <img id="btnDetails" src="../imgs/add1.png" alt="">
                            </span>
                        </div>
                    </a>

                    <!-- spaces -->
                    <a href="#Spaces" class="sideMenuTxt sidebar-item" id="propSpacesTxt">
                        <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="sDiv">
                            <p class="sidebarLbl sidebar-txt mt-1">Spaces</p>
                            
                            <span class="sidebarBtn">
                                <img id="btn_Spaces" src="../imgs/add1.png" alt="">
                            </span>
                        </div>
                    </a>

                    <!-- PHOTOS -->
                    <a href="#Photos" class="sideMenuTxt sidebar-item" id="propPhotosTxt">
                        <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="pDiv">
                            <p class="sidebarLbl sidebar-txt mt-1">Photos</p>
                            
                            <span class="sidebarBtn">
                                <img id="btnPhotos" src="../imgs/add1.png" alt="">
                            </span>
                        </div>
                    </a>

                    <!-- FEATURED -->
                    <a href="#Featured" class="sideMenuTxt sidebar-item" id="propFeaturedTxt">
                        <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="fDiv">
                            <p class="sidebarLbl sidebar-txt mt-1">Featured</p>
                            
                            <span class="sidebarBtn">
                                <img id="btnFeatured" src="../imgs/add1.png" alt="">
                            </span>
                        </div>
                    </a>

                    <!-- AMENITIES -->
                    <a href="#Amenities" class="sideMenuTxt sidebar-item" id="propSpacesTxt">
                        <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="aDiv">
                            <p class="sidebarLbl sidebar-txt mt-1">Amenities</p>
                            
                            <span class="sidebarBtn">
                                <img id="btn_Amenities" src="../imgs/done.png" alt="">
                            </span>
                        </div>
                    </a>

                    <!-- LOCATION -->
                    <a href="#Location" class="sideMenuTxt sidebar-item" id="propLocationTxt">
                        <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="lDiv">
                            <p class="sidebarLbl sidebar-txt mt-1">Location</p>
                            
                            <span class="sidebarBtn">
                                <img id="btnLocation" src="../imgs/add1.png" alt="">
                            </span>
                        </div>
                    </a>

                    <!-- CONTACT -->
                    <a href="#Contact" class="sideMenuTxt sidebar-item" id="propContactsTxt">
                        <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="cDiv">
                            <p class="sidebarLbl sidebar-txt mt-1">Contact</p>
                            
                            <span class="sidebarBtn">
                                <img id="btnContact" src="../imgs/add1.png" alt="">
                            </span>
                        </div>
                    </a>

                </div>
                </div>
                <!-- END OF SIDEBAR COLUMN -->


                <!-- FORMS COLUMN -->
                <div class="col-9 px-4 py-3 col_forms d-flex flex-column">
                    
                    <!-- PROPERTY INFO FORM -->
                    <section id="infoDiv" class="section-property-info">
                        <h2 class="div-titles">Property Information</h2>
                        <div class="container-inputs my-2 ">

                            <!-- PROPERTY TYPE -->
                            <div class="div-property-type mb-3">
                                <label for="propertyType" class="inputsLabel mt-3">Property type <span class="text-danger"> *</span></label><br>
                                <div id="btnDiv" class="d-flex row-property-type">

                                    
                                    <!-- radio button for apartment -->
                                    <?php
                                        $selectType = "SELECT * FROM property_types";
                                        $executeSelectType = mysqli_query($con, $selectType);
                                        $getType = mysqli_fetch_all($executeSelectType, MYSQLI_ASSOC);

                                        for($i = 0; $i < count($getType); $i++){
                                    ?>
                                    <input type="radio" name="property_type" id="<?php echo $getType[$i]['property_type'] ?>" value="<?php echo $getType[$i]['property_type'] ?>" onclick="propertyInformationFunction()" class="btn-check visually-hidden rad-property-type">
                                    <label for="<?php echo $getType[$i]['property_type'] ?>" class="btnType text-center label-property-type mt-3" id="btn_<?php echo $getType[$i]['property_type'] ?>"><?php echo $getType[$i]['property_type'] ?></label>
                                    <?php
                                        }
                                        ?>
                                </div>        
                            </div>
                        
                            <!-- PROPERTY TITLE -->
                            <div class="div-property-title mb-3">
                                <label for="propertyTitle" class="form-label ms-1">Property Title <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control input-containers mt-1" id="propertyTitle" onkeyup="propertyInformationFunction()" minlength="1" maxlength="29" required>
                                <div class="form-text ms-1">This will appear as the title of your listing.</div>
                            </div>

                            <!-- PROPERTY DESCRIPTION -->
                            <div class="div-property-description mb-3">
                                <label for="propertyDescription" class="form-label ms-1">Property Description <span class="text-danger"> *</span></label>
                                <textarea id="propertyDescription" class="w-100 input-containers textarea-description mt-1" placeholder="" onkeyup="propertyInformationFunction()" rows="5" cols=""></textarea>
                                <div class="form-text ms-1">Describe your property and its unique features here to attract potential renters.</div>
                            </div>

                            <!-- PROPERTY PRICE -->
                            <div class="row row-price">
                                <div class="col-12">
                                    <label for="propertyPrice" class="form-label">Property Price <span class="text-danger"> *</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-2 span-peso" id="">₱</span>
                                        <input type="text" class="form-control mt-2 input-containers" id="propertyPrice" minlength="1" onkeyup="propertyInformationFunction()" maxlength="6" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" placeholder="Rent price per month">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </section>
                

                <!-- PROPERTY DETAILS FORM -->
                    <section class="section-property-details mt-5">
                        <h2 class="div-titles mt-3">Property Details</h2>
                        <div class="container-inputs my-2 ">
                            <div class="row mt-3">

                                <!-- PROPERTY NAME -->
                                <!-- <div class="col-4 pe-3">
                                    <label for="propertyName" class="ms-1">Property Name</label><br>
                                    <input type="text" class="input-containers mt-2 " onkeyup="propertyDetailsFunction()" id="propertyName" placeholder="" minlength="1" maxlength="29" required><br>
                                </div> -->

                                <!-- UNIT/FLOOR NUMBER -->
                                <div class="col-4 pe-3">
                                    <label for="propertyNum" class="ms-1">Unit/Floor No. <span class="text-danger"> *</span> </label><br>
                                    <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" id="propertyNum" minlength="1" maxlength="3" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                                </div>

                                <!-- FLOOR AREA -->
                                <div class="col-4 pe-3">
                                    <label for="floorArea" class="ms-1">Floor Area (m&sup2) <span class="text-danger"> *</span> </label><br>
                                    <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" id="floorArea" minlength="1" maxlength="3" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                                </div>

                                <!-- occupants -->
                                <div class="col-4">
                                    <label for="" class="ms-1 occupant">Max occupant no. <span class="text-danger"> *</span> </label><br>
                                    <input type="text" class="input-containers details-input-num mt-2 " onkeyup="propertyDetailsFunction()" id="maxOccupants" placeholder="" minlength="1" maxlength="29" required><br>
                                </div>

                                <!-- another row -->

                                <!-- BEDROOMS -->
                                <div class="col-4 mt-3 pe-3">
                                    <label for="bedNum" class="ms-1">Bedrooms <span class="text-danger"> *</span> </label><br>
                                    <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" id="bedNum" placeholder="Quantity" minlength="1" maxlength="2" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                                </div>

                                <!-- BATHROOMS -->
                                <div class="col-4 mt-3 pe-3">
                                    <label for="bathNum" class="ms-1">Bathrooms <span class="text-danger"> *</span> </label><br>
                                <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" id="bathNum" placeholder="Quantity" minlength="1" maxlength="2" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                                </div>

                                <!-- CAR SPACES -->
                                <div class="col-4 mt-3">
                                    <label for="otherDetails" class="ms-1">Car Spaces <span class="text-danger"> *</span> </label><br>
                                    <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" id="otherDetails" placeholder="Quantity" minlength="1" maxlength="2" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                                </div>

                                <!-- another row -->

                                <!-- PET FRIENDLY -->
                                <div class="col-md-5 col-12 mt-3">
                                    <label for="petFriendly" class="ms-1">Pet Friendly? <span class="text-danger"> *</span> </label><br>
                                    <div class="btn-group mt-3 gap-1"> 
                                        <input type="radio" name="pet_friendly" value="YES" id="pet_yes" onclick="propertyDetailsFunction()" class="btn-check">
                                        <label for="pet_yes" class="btnPet" id="yes_pet">Yes</label>
                                        <input type="radio" name="pet_friendly" value="NO" id="pet_no" onclick="propertyDetailsFunction()" class="btn-check">
                                        <label for="pet_no" class="btnPet" id="no_pet">No</label>
                                    </div>
                                </div>

                                <div class="col-md-7 col-12 mt-3">
                                    <label for="furnished" class="ms-1">Fully Furnished? <span class="text-danger"> *</span> </label><br>
                                    <div class="radio_furnished mt-3">
                                        <input type="radio" name="furnished_friendly" value="YES" id="furnished_yes" onclick="propertyDetailsFunction()" class="btn-check">
                                        <label for="furnished_yes" class="btnfurnished" id="yes_furnished">Yes</label>
                    
                                        <input type="radio" name="furnished_friendly" value="NO" id="furnished_no" onclick="propertyDetailsFunction()" class="btn-check">
                                        <label for="furnished_no" class="btnfurnished" id="no_furnished">No</label>

                                        <input type="radio" name="furnished_friendly" value="SEMI" id="furnished_semi" onclick="propertyDetailsFunction()" class="btn-check">
                                        <label for="furnished_semi" class="btnfurnished" id="semi_furnished">Semi</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                

                <!-- SPACES SECTION -->
                    <section class="section-spaces mt-5">
                        <h2 class="div-titles mt-3">Spaces </h2>
                        <div class="container-inputs my-2 ">
                        
                        <p class="ms-1 p-instruction">Please select all the house spaces that is included in your property to be rented. 
                <b> You are required to take photos and upload each spaces below </b>. These will appear in the property gallery to be viewed by your potential renters. </p>

                        <!-- INDOOR -->
                        <h6 class="ms-1 mt-4 mb-md-0 mb-sm-3 mb-3"><b>Indoor</b></h6>
                        <div class="row">

                            <!-- living room -->
                            <div class="col-lg-3 col-4 pe-2 mt-lg-3 mt-0">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Living Room" class="btn-check" id="LivingRoom">
                                <label class="btn-spaces" for="LivingRoom" id="btn_LivingRoom">Living Room</label>
                            </div>
                            
                            <!-- Dining room -->
                            <div class="col-lg-3 col-4 pe-2 mt-lg-3 mt-0">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Dining room" class="btn-check" id="Diningroom">
                                <label class="btn-spaces" for="Diningroom" id="btn_Diningroom">Dining Room</label>
                            </div>

                            <!-- Bedroom -->
                            <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-lg-3 mt-0">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Bedrooms" class="btn-check" id="Bedrooms">
                                <label class="btn-spaces" for="Bedrooms" id="btn_Bedrooms">Bedroom</label>
                            </div>
                            
                            <!-- Bathroom -->
                            <div class="col-lg-3 col-4 mt-3 pe-lg-0 pe-2">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Bathrooms" class="btn-check" id="Bathrooms">
                                <label class="btn-spaces" for="Bathrooms" id="btn_Bathrooms">Bathroom</label>
                            </div>


                        <!-- 2nd row -->

                            <!-- KITCHEN -->
                            <div class="col-lg-3 col-4 pe-2 mt-3">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Kitchen" class="btn-check" id="Kitchen">
                                <label class="btn-spaces" for="Kitchen" id="btn_Kitchen">Kitchen</label>
                            </div>

                            <!-- LAUNDRY ROOM -->
                            <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-3">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Laundry Room" class="btn-check" id="LaundryRoom">
                                <label class="btn-spaces" for="LaundryRoom" id="btn_LaundryRoom">Laundry Room</label>
                            </div>

                            <!-- STUDY ROOM -->
                            <div class="col-lg-3 col-4 pe-2 mt-3">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="StudyOffice" class="btn-check" id="StudyOffice">
                                <label class="btn-spaces" for="StudyOffice" id="btn_StudyOffice">Study/Office</label>
                            </div>

                            <!-- ENTERTAINMENT ROOM -->
                            <div class="col-lg-3 col-4 mt-3 pe-lg-0 pe-2">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Entertainment Room" class="btn-check" id="EntertainmentRoom">
                                <label class="btn-spaces" for="EntertainmentRoom" id="btn_EntertainmentRoom">Entertainment</label>
                            </div>

                        <!-- 3rd row  -->

                            <!-- Walk-in Closet-->
                            <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-3">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Walk In Closet" class="btn-check" id="WalkInCloset">
                                <label class="btn-spaces" for="WalkInCloset" id="btn_WalkInCloset">Walk-in Closet</label>
                            </div>

                            <!-- Hallways -->
                            <div class="col-lg-3 col-4 pe-2 mt-3">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Hallways" class="btn-check" id="Hallways">
                                <label class="btn-spaces" for="Hallways" id="btn_Hallways">Hallways</label>
                            </div>

                            <!-- Staircase -->
                            <div class="col-lg-3 col-4 pe-2 mt-3">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Staircase" class="btn-check" id="Staircases">
                                <label class="btn-spaces" for="Staircases" id="btn_Staircases">Staircases</label>
                            </div>

                            <!-- Other -->
                            <div class="col-lg-3 col-4 mt-3">
                                <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Other" class="btn-check" id="Other">
                                <label class="btn-spaces" for="Other" id="btn_Other">Other</label>
                            </div>

                        </div>
                        

                    <!-- OUTDOOR -->
                        <h6 class="ms-1 mt-4 mb-md-0 mb-sm-3 mb-3"><b>Outdoor</b></h6>
                        <div class="row">

                        <!-- 1st row -->
                            <!-- GARDEN -->
                            <div class="col-lg-3 col-4 pe-2 mt-lg-3 mt-0">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Garden" class="btn-check" id="Garden">
                                <label class="btn-spaces" for="Garden" id="btn_Garden">Garden</label>
                            </div>

                            <!-- OUTDOOR KITCHEN  -->
                            <div class="col-lg-3 col-4 pe-2 mt-lg-3 mt-0">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Outdoor Kitchen" class="btn-check" id="OutdoorKitchen">
                                <label class="btn-spaces" for="OutdoorKitchen" id="btn_OutdoorKitchen">Outdoor Kitchen</label>
                            </div>

                            <!-- FRONT YARD -->
                            <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-lg-3 mt-0">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Front Yard"  class="btn-check" id="FrontYard">
                                <label class="btn-spaces" for="FrontYard" id="btn_FrontYard">Front Yard</label>
                            </div>

                            <!-- BACKYARD -->
                            <div class="col-lg-3 col-4 pe-lg-0 pe-2 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Back Yard" class="btn-check" id="BackYard">
                                <label class="btn-spaces" for="BackYard" id="btn_BackYard">Back Yard</label>
                            </div>


                        <!-- 2nd row -->
                            <!-- Patio -->
                            <div class="col-lg-3 col-4 pe-2 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Patio" class="btn-check" id="Patio">
                                <label class="btn-spaces" for="Patio" id="btn_Patio">Patio</label>
                            </div>

                            <!-- Terrace -->
                            <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Terrace" class="btn-check" id="Terrace">
                                <label class="btn-spaces" for="Terrace" id="btn_Terrace">Terrace</label>
                            </div>

                            <!-- Deck -->
                            <div class="col-lg-3 col-4 pe-2 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Deck" class="btn-check" id="Deck">
                                <label class="btn-spaces" for="Deck" id="btn_Deck">Deck</label>
                            </div>

                            <!-- Play area -->
                            <div class="col-lg-3 col-4 pe-lg-0 pe-2 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Play Area" class="btn-check" id="PlayArea">
                            <label class="btn-spaces" for="PlayArea" id="btn_PlayArea">Play Area</label>
                            </div>


                        <!-- 3rd row -->
                            <!-- Swimming Pool -->
                            <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Swimming Pool" class="btn-check" id="SwimmingPool">
                                <label class="btn-spaces" for="SwimmingPool" id="btn_SwimmingPool">Swimming Pool</label>
                            </div>

                            <!-- Driveway -->
                            <div class="col-lg-3 col-4 pe-2 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Driveway" class="btn-check" id="Driveway">
                                <label class="btn-spaces" for="Driveway" id="btn_Driveway">Driveway</label>
                            </div>

                            <!-- Walkways -->
                            <div class="col-lg-3 col-4 pe-2 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Walkways" class="btn-check" id="Walkways">
                                <label class="btn-spaces" for="Walkways" id="btn_Walkways">Walkways</label>
                            </div>

                            <!-- Swimming Pool -->
                            <div class="col-lg-3 col-4 mt-3">
                                <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Storage Shed" class="btn-check" id="StorageShed">
                                <label class="btn-spaces" for="StorageShed" id="btn_StorageShed">Storage Shed</label>
                            </div>

                        </div>
                        
                        </div>
                    </section>

                    
                <!-- PHOTO SECTION -->
                    <section class="section-photos mt-5">
                        <h2 class="div-titles mt-3">Photos</h2>
                        <div class="container-inputs my-2">

                        <p class="ms-1 p-instruction">Based on the spaces you've checked in previous section, upload here the corresponding images <i class="landscape">(landscape orientation)</i>. 
                            <b> You are required to upload 3 photos on every spaces </b>. These might be in different angles to ensure that photos match your real property.</p>
                        
                            <!-- add photo -->
                            
                        <!-- MODAL ADD Living Room -->
                            <div class="modal fade" id="addLivingRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">living room</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload0" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload0">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages0" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas0" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon0">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload00" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload00">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages00" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas00" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon00">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload000" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload000">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages000" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas000" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon000">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavinglivingroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="savelivingroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Living room-->

                             <!-- MODAL ADD dining Room -->
                             <div class="modal fade" id="adddiningRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">dining room</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload1" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload1">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages1" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas1" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon1">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload1_1" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload1_1">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages1_1" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas1_1" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon1_1">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload1_1_1" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload1_1_1">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages1_1_1" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas1_1_1" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon1_1_1">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingdiningroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="savediningroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO dining room-->
                            
                            <!-- MODAL ADD Bed Room -->
                            <div class="modal fade" id="addBedRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">Bedroom</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload2">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages2" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas2" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload2_2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload2_2">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages2_2" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas2_2" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon2_2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload2_2_2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload2_2_2">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages2_2_2" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas2_2_2" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon2_2_2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingBedroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveBedroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Bed room-->
                            
                                <!-- MODAL ADD Bathroom -->
                                <div class="modal fade" id="addBathroom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">bathroom</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload3">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages3" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas3" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload3_3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload3_3">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages3_3" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas3_3" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon3_3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload3_3_3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload3_3_3">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages3_3_3" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas3_3_3" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon3_3_3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingBathroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveBathroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Bathroom room-->

                            <!-- MODAL ADD Kitchen -->
                            <div class="modal fade" id="addKitchen" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">kitchen</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload4">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages4" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas4" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload4_4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload4_4">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages4_4" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas4_4" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon4_4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload4_4_4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload4_4_4">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages4_4_4" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas4_4_4" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon4_4_4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingKitchen()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveKitchen()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Kitchen room-->
                            <!-- MODAL ADD Laundry Room -->
                            <div class="modal fade" id="addLaundryRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">laundry room</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload5" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload5">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages5" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas5" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon5">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload5_5" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload5_5">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages5_5" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas5_5" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon5_5">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload5_5_5" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload5_5_5">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages5_5_5" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas5_5_5" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon5_5_5">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingLaundryroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveLaundryroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Laundry Room room-->
                            <!-- MODAL ADD StudyOffice -->
                            <div class="modal fade" id="addStudyOffice" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">study/Office room</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload6">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages6" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas6" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload6_6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload6_6">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages6_6" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas6_6" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon6_6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload6_6_6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload6_6_6">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages6_6_6" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas6_6_6" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon6_6_6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingStudyOffice()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveStudyOffice()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO StudyOffice room-->
                            <!-- MODAL ADD Entertainment Room -->
                            <div class="modal fade" id="addEntertainmentRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">entertainment room</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload7" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload7">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages7" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas7" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon7">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload7_7" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload7_7">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages7_7" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas7_7" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon7_7">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload7_7_7" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload7_7_7">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages7_7_7" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas7_7_7" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon7_7_7">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingEntertainmentroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveEntertainmentroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Entertainment Room -->
                            <!-- MODAL ADD Walk in closet -->
                            <div class="modal fade" id="addwalkincloset" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">walk-in closet</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload8" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload8">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages8" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas8" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon8">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload8_8" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload8_8">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages8_8" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas8_8" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon8_8">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload8_8_8" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload8_8_8">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages8_8_8" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas8_8_8" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon8_8_8">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingwalkincloset()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="savewalkincloset()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Walk in closet room-->
                            <!-- MODAL ADD Hallways -->
                            <div class="modal fade" id="addHallways" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">hallways</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload9" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload9">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages9" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas9" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon9">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload9_9" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload9_9">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages9_9" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas9_9" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon9_9">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload9_9_9" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload9_9_9">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages9_9_9" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas9_9_9" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon9_9_9">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingHallways()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveHallways()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Hallways-->
                            <!-- MODAL ADD Staircase -->
                            <div class="modal fade" id="addStaircase" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">staircase</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload10">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages10" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas10" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload10_10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload10_10">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages10_10" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas10_10" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon10_10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload10_10_10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload10_10_10">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages10_10_10" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas10_10_10" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon10_10_10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingStaircase()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveStaircase()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Staircase-->
                            <!-- MODAL ADD Other -->
                            <div class="modal fade" id="addOther" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">other</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload11" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload11">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages11" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas11" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon11">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload11_11" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload11_11">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages11_11" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas11_11" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon11_11">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload11_11_11" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload11_11_11">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages11_11_11" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas11_11_11" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon11_11_11">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingOther()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveOther()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Other-->
                            <!-- MODAL ADD Garden -->
                            <div class="modal fade" id="addGarden" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">garden</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload12" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload12">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages12" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas12" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon12">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload12_12" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload12_12">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages12_12" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas12_12" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon12_12">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload12_12_12" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload12_12_12">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages12_12_12" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas12_12_12" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon12_12_12">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingGarden()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveGarden()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Garden-->
                            <!-- MODAL ADD Outdoorkitchen -->
                            <div class="modal fade" id="addOutdoorkitchen" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">outdoor kitchen</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload13" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload13">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages13" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas13" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon13">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload13_13" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload13_13">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages13_13" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas13_13" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon13_13">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload13_13_13" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload13_13_13">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages13_13_13" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas13_13_13" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon13_13_13">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingOutdoorkitchen()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveOutdoorkitchen()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Outdoorkitchen-->
                            <!-- MODAL ADD Frontyard -->
                            <div class="modal fade" id="addFrontyard" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">front yard</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload14" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload14">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages14" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas14" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon14">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload14_14" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload14_14">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages14_14" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas14_14" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon14_14">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload14_14_14" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload14_14_14">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages14_14_14" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas14_14_14" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon14_14_14">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingFrontyard()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveFrontyard()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Frontyard-->
                            <!-- MODAL ADD Backyard -->
                            <div class="modal fade" id="addBackyard" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">back yard</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload15" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload15">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages15" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas15" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon15">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload15_15" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload15_15">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages15_15" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas15_15" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon15_15">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload15_15_15" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload15_15_15">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages15_15_15" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas15_15_15" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon15_15_15">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingBackyard()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveBackyard()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Backyard-->
                            <!-- MODAL ADD Patio -->
                            <div class="modal fade" id="addPatio" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">patio</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload16" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload16">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages16" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas16" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon16">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload16_16" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload16_16">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages16_16" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas16_16" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon16_16">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload16_16_16" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload16_16_16">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages16_16_16" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas16_16_16" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon16_16_16">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingPatio()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="savePatio()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Patio-->
                            <!-- MODAL ADD terrace -->
                            <div class="modal fade" id="addTerrace" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">terrace</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload17" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload17">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages17" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas17" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon17">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload17_17" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload17_17">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages17_17" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas17_17" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon17_17">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload17_17_17" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload17_17_17">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages17_17_17" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas17_17_17" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon17_17_17">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingTerrace()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveTerrace()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Terrace-->
                            <!-- MODAL ADD deck -->
                            <div class="modal fade" id="addDeck" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">deck</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload18" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload18">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages18" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas18" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon18">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload18_18" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload18_18">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages18_18" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas18_18" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon18_18">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload18_18_18" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload18_18_18">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages18_18_18" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas18_18_18" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon18_18_18">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingDeck()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveDeck()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Deck-->
                            <!-- MODAL ADD playarea -->
                            <div class="modal fade" id="addplayarea" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">play area</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload19" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload19">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages19" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas19" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon19">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload19_19" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload19_19">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages19_19" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas19_19" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon19_19">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload19_19_19" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload19_19_19">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages19_19_19" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas19_19_19" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon19_19_19">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingplayarea()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveplayarea()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO playarea-->
                            <!-- MODAL ADD swimmingpool -->
                            <div class="modal fade" id="addswimmingpool" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">swimming pool</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload20" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload20">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages20" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas20" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon20">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload20_20" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload20_20">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages20_20" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas20_20" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon20_20">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload20_20_20" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload20_20_20">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages20_20_20" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas20_20_20" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon20_20_20">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingswimmingpool()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveswimmingpool()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO swimmingpool-->
                            <!-- MODAL ADD Driveway -->
                            <div class="modal fade" id="addDriveway" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">driveway</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload21">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages21" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas21" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload21_21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload21_21">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages21_21" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas21_21" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon21_21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload21_21_21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload21_21_21">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages21_21_21" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas21_21_21" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon21_21_21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingDriveway()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveDriveway()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Driveway-->
                            <!-- MODAL ADD Walkways -->
                            <div class="modal fade" id="addWalkways" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">walkways</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload22">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages22" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas22" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload22_22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload22_22">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages22_22" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas22_22" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon22_22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload22_22_22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload22_22_22">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages22_22_22" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas22_22_22" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon22_22_22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingWalkways()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveWalkways()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Walkways-->
                            <!-- MODAL ADD StorageShed -->
                            <div class="modal fade" id="addStorageShed" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">storage shed</span> photos</h5>

                                                    <div class="row px-3">
                                                        
                                                        <input type="file" class="d-none imgUpload23" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload23">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages23" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas23" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon23">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload23_23" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload23_23">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages23_23" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas23_23" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon23_23">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload23_23_23" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload23_23_23">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages23_23_23" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas23_23_23" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon23_23_23">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingStorageShed()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveStorageShed()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO StorageShed-->
                            <!-- list property view image -->
                            <div class="row mt-3 row-featured">
                                <!-- living -->
                                <div class="img0 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addLivingRoom" data-bs-toggle="modal">
                                    <img src="" id="existinglivingroom" class="d-none" alt="">
                                    <canvas id="imgCanvaslivingroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconlivingroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName0" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- dining -->
                                <div class="img1 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#adddiningRoom" data-bs-toggle="modal">
                                    <img src="" id="existingdiningroom" class="d-none" alt="">
                                    <canvas id="imgCanvasdiningroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_icondiningroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName1" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Bedroom -->
                                <div class="img2 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addBedRoom" data-bs-toggle="modal">
                                    <img src="" id="existingbedroom" class="d-none" alt="">
                                    <canvas id="imgCanvasbedroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconbedroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName2" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- bathroom -->
                                <div class="img3 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addBathroom" data-bs-toggle="modal">
                                    <img src="" id="existingbathroom" class="d-none" alt="">
                                    <canvas id="imgCanvasbathroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconbathroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName3" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- kitchen -->
                                <div class="img4 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addKitchen" data-bs-toggle="modal">
                                    <img src="" id="existingkitchen" class="d-none" alt="">
                                    <canvas id="imgCanvaskitchen" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconkitchen">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName4" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Laundryroom -->
                                <div class="img5 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addLaundryRoom" data-bs-toggle="modal">
                                    <img src="" id="existingLaundryroom" class="d-none" alt="">
                                    <canvas id="imgCanvasLaundryroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconLaundryroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName5" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- StudyOffice -->
                                <div class="img6 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addStudyOffice" data-bs-toggle="modal">
                                    <img src="" id="existingStudyOffice" class="d-none" alt="">
                                    <canvas id="imgCanvasStudyOffice" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconStudyOffice">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName6" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Entertainmentroom -->
                                <div class="img7 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addEntertainmentRoom" data-bs-toggle="modal">
                                    <img src="" id="existingEntertainmentroom" class="d-none" alt="">
                                    <canvas id="imgCanvasEntertainmentroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconEntertainmentroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName7" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- WalkInCloset -->
                                <div class="img8 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addwalkincloset" data-bs-toggle="modal">
                                    <img src="" id="existingWalkInCloset" class="d-none" alt="">
                                    <canvas id="imgCanvasWalkInCloset" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconWalkInCloset">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName8" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Hallways -->
                                <div class="img9 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addHallways" data-bs-toggle="modal">
                                    <img src="" id="existingHallways" class="d-none" alt="">
                                    <canvas id="imgCanvasHallways" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconHallways">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName9" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Staircase -->
                                <div class="img10 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addStaircase" data-bs-toggle="modal">
                                    <img src="" id="existingStaircase" class="d-none" alt="">
                                    <canvas id="imgCanvasStaircase" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconStaircase">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName10" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Other -->
                                <div class="img11 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addOther" data-bs-toggle="modal">
                                    <img src="" id="existingOther" class="d-none" alt="">
                                    <canvas id="imgCanvasOther" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconOther">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName11" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Garden -->
                                <div class="img12 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addGarden" data-bs-toggle="modal">
                                    <img src="" id="existingGarden" class="d-none" alt="">
                                    <canvas id="imgCanvasGarden" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconGarden">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName12" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Outdoorkitchen -->
                                <div class="img13 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addOutdoorkitchen" data-bs-toggle="modal">
                                    <img src="" id="existingOutdoorkitchen" class="d-none" alt="">
                                    <canvas id="imgCanvasOutdoorkitchen" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconOutdoorkitchen">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName13" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Frontyard -->
                                <div class="img14 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addFrontyard" data-bs-toggle="modal">
                                    <img src="" id="existingFrontyard" class="d-none" alt="">
                                    <canvas id="imgCanvasFrontyard" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconFrontyard">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName14" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Backyard -->
                                <div class="img15 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addBackyard" data-bs-toggle="modal">
                                    <img src="" id="existingBackyard" class="d-none" alt="">
                                    <canvas id="imgCanvasBackyard" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconBackyard">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName15" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Patio -->
                                <div class="img16 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addPatio" data-bs-toggle="modal">
                                    <img src="" id="existingPatio" class="d-none" alt="">
                                    <canvas id="imgCanvasPatio" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconPatio">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName16" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Terrace -->
                                <div class="img17 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addTerrace" data-bs-toggle="modal">
                                    <img src="" id="existingTerrace" class="d-none" alt="">
                                    <canvas id="imgCanvasTerrace" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconTerrace">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName17" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Deck -->
                                <div class="img18 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addDeck" data-bs-toggle="modal">
                                    <img src="" id="existingDeck" class="d-none" alt="">
                                    <canvas id="imgCanvasDeck" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconDeck">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName18" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Playarea -->
                                <div class="img19 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addplayarea" data-bs-toggle="modal">
                                    <img src="" id="existingPlayarea" class="d-none" alt="">
                                    <canvas id="imgCanvasPlayarea" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconPlayarea">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName19" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Swimmingpool -->
                                <div class="img20 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addswimmingpool" data-bs-toggle="modal">
                                    <img src="" id="existingSwimmingpool" class="d-none" alt="">
                                    <canvas id="imgCanvasSwimmingpool" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconSwimmingpool">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName20" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Driveway -->
                                <div class="img21 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addDriveway" data-bs-toggle="modal">
                                    <img src="" id="existingDriveway" class="d-none" alt="">
                                    <canvas id="imgCanvasDriveway" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconDriveway">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName21" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Walkways -->
                                <div class="img22 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addWalkways" data-bs-toggle="modal">
                                    <img src="" id="existingWalkways" class="d-none" alt="">
                                    <canvas id="imgCanvasWalkways" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconWalkways">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName22" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Storageshed -->
                                <div class="img23 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addStorageShed" data-bs-toggle="modal">
                                    <img src="" id="existingStorageshed" class="d-none" alt="">
                                    <canvas id="imgCanvasStorageshed" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconStorageshed">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <div id="imgName23" class="spaces-label mt-1 text-center"></div>
                                </div>
                            </div>

                        </div>
                    </section>


                <!-- FEATURED PHOTOS SECTION -->
                    <section class="section-featured mt-5">
                        <h2 class="div-titles mt-3">Featured Photos</h2>
                        <div class="container-inputs my-2" >

                            <p class="ms-1 p-instruction">Please upload 3 nice photos <i class="landscape">(landscape orientation)</i>  of your property that you want to feature to attract potential renters.</p>

                            <div class="row mt-3 row-featured">

                                <!--  -->
                                <input type="file" class="d-none imgUploadFeatured1" accept=".png, .jpg, .jpeg">
                                <div class="col-lg-4 col-md-6 col-12 col-featured imgFeatured1 pe-2 mx-md-0" id="img_uploadFeatured1">
                                    <img src="" id="existingfeatured1" class="d-none" alt="">
                                    <canvas id="imgCanvasFeatured1" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_icon1">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Featured 1</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                </div>

                                <!-- -->
                                <input type="file" class="d-none imgUploadFeatured2" accept=".png, .jpg, .jpeg">
                                <div class="col-lg-4 col-md-6 col-12 col-featured imgFeatured2 pe-2 mt-md-0 mt-3" id="img_uploadFeatured2">
                                    <img src="" id="existingfeatured2" class="d-none" alt="">
                                    <canvas id="imgCanvasFeatured2" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox2 d-flex flex-column justify-content-center align-items-center" id="image_icon2">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Featured 2</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                </div>

                                <!-- FEATURED PHOTO 3 -->
                                <input type="file" class="d-none imgUploadFeatured3" accept=".png, .jpg, .jpeg">
                                <div class="col-lg-4 col-md-6 col-12 col-featured mt-lg-0 mt-md-2 mx-auto mt-3  imgFeatured3 pe-2" id="img_uploadFeatured3">
                                    <img src="" id="existingfeatured3" class="d-none" alt="">
                                    <canvas id="imgCanvasFeatured3" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox3 d-flex flex-column justify-content-center align-items-center" id="image_icon3">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Featured 3</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                </div>

        

                                <!-- add photo -->
                                <!-- <div class="col-lg-4 col-md-6 col-12 pe-2 mx-md-0 mt-3" id="photo-uploader" data-bs-target="#addPhotoModal" data-bs-toggle="modal">
                                    <div class="d-flex justify-content-center align-items-center flex-column">
                                        <img src="" id="" class="canvasResult d-none" alt="">
                                        <canvas id="" class="canvasResult canvas-result-featured d-none"></canvas>
                                        <div class="upload-box-featured d-flex flex-column justify-content-center align-items-center" id="image_icon1">
                                            <i class="bi bi-image upload-icon"></i>
                                            <p class="featured">Upload</p>
                                            <p class="file-type">JPEG or PNG only</p>
                                        </div>
                                        <p class="text-center file-type">Living Room</p>
                                    </div>
                                </div> -->
                            

                            </div>

                        </div>
                    </section>

                <!-- AMENITIES SECTION -->
                    <section class="section-amenities mt-5">
                        <h2 class="div-titles mt-3">Amenities</h2>
                        <div class="container-inputs my-2 ">
                            
                            <p class="p-instruction mb-3">Please select all the amenities that renters can enjoy in your property.</p>
                            
                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Wi-Fi" id="WiFi"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Wi-Fi</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Air Conditioner" id="AirConditioner"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Air conditioner</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Soundproof Walls" id="SoundproofWalls"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Soundproof walls</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bath Tub" id="BathTub"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Bath tub </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Sofa" id="Sofa"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Sofa</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bed" id="Bed"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Bed</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Work Table" id="WorkTable"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Work table</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bar Stool"  id="BarStool"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Bar stool </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Dining Set"  id="DiningSet"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Dining set</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Fireplace"  id="Fireplace"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Fireplace </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Hardwood Floor"  id="HardwoodFloor"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Hardwood floor</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Wardrobe"  id="Wardrobe"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Wardrobe </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Washer-Dryer"  id="WasherDryer"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Washer-Dryer</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Washer-Dryer Hookup"  id="WasherDryerHookup"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Washer-Dryer Hookup</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Dishwasher"  id="Dishwasher"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Dishwasher</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Range Oven"  id="RangeOven"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Range oven </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="CCTV"  id="CCTV"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> CCTV</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="24-hr Security"  id="HrSecurity"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> 24-hr security </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Smart Lock"  id="SmartLock" /> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Smart lock</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Video Doorbell"  id="VideoDoorbell"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Video doorbell </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Pet Policy"  id="PetPolicy"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Pet Policy</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Court"  id="Court"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Court</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Garage"  id="Garage"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Garage</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Fitness Center"/> 
                                                <span class="checkbox"></span>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Fitness center </span> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </section>

                <!-- LOCATION SECTION -->
                    <section class="section-location mt-5">
                        <h2 class="div-titles mt-3">Location</h2>
                        <div class="container-inputs my-2 ">

                            <p class="p-instruction">Where is your property located?</p>

                            <div class="row ">

                            <!-- 1st row -->
                                <!-- REGION -->
                                <div class="col-lg-6 col-12 mt-3 pe-lg-2 pe-0">
                                    <label for="region" class="locLabel inputsLabel ms-1">Region<span class="text-danger"> *</span></label>
                                    <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" id="region" placeholder="" minlength="1" maxlength="30" required>
                                </div>

                                <!-- PROVINCE -->
                                <div class="col-lg-6 col-12 mt-3">
                                    <label for="province" class="locLabel inputsLabel ms-1">State/Province<span class="text-danger"> *</span></label>
                                    <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" id="province" placeholder="" minlength="1" maxlength="30" required>
                                </div>

                            <!-- 2nd row -->
                                <!-- CITY -->
                                <div class="col-lg-6 col-12 mt-3 pe-lg-2 pe-0">
                                    <label for="city" class="locLabel inputsLabel ms-1">City<span class="text-danger"> *</span></label>
                                    <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" id="city" placeholder="" minlength="1" maxlength="30" required>
                                </div>

                                <!-- BRGY -->
                                <div class="col-lg-6 col-12 mt-3">
                                    <label for="barangay" class="locLabel inputsLabel ms-1">Brgy., Street<span class="text-danger"> *</span></label>
                                    <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" id="barangay" placeholder="" minlength="1" maxlength="100" required>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="houseNum" class="locLabel inputsLabel ms-1">House No./Building No.<span class="text-danger"> *</span></label>
                                    <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" id="houseNum" placeholder="" minlength="1" maxlength="100" required>
                                </div>

                                <!-- Latitude -->
                                <div class="col-lg-6 col-12 mt-3 pe-lg-2 pe-0">
                                    <label for="latitude" class="locLabel inputsLabel ms-1">Latitude</label>
                                    <input type="text" oninput="locationTextbox()" id="latitude" class="locationText locInput mt-2 latLong" Disabled>
                                </div>

                                <!-- Longitude -->
                                <div class="col-lg-6 col-12 mt-3">
                                    <label for="longitude" class="locLabel inputsLabel ms-1">Longitude</label>
                                    <input type="text" oninput="locationTextbox()" id="longitude" class="locationText locInput mt-2 latLong" Disabled>
                                </div>

                                <!-- map div -->
                                <div id="locationInputDiv" class="col-12 mt-3">

                                </div> 
                                <!-- nearby places -->
                                <div class="d-none">
                                    <input type="text" id="nearbyPlaces">
                                </div>

                            </div>
                        </div>
                    </section>

                    <section class="section-contact mt-5">
                        <h2 class="div-titles mt-3">Contact Information</h2>
                        <div class="container-inputs my-2 ">

                            <div class="row">

                                <!-- MOBILE NUMBER -->
                                <div class="col-lg-6 col-12 mt-3 pe-lg-2 pe-0">
                                    <label for="mobileNum" class="contactLbl inputsLabel ms-1">Mobile Number<span class="text-danger"> *</span></label><br>
                                    <input type="number" id="mobileNum" class="input-containers mt-1 contact-input" placeholder="autofill" value="<?php echo $lgetId['lNumber']; ?>" min="0" max="999999999999" required><br>
                                </div>

                                <!-- EMAIL -->
                                <div class="col-lg-6 col-12 mt-3">
                                    <label for="email" class="contactLbl inputsLabel ms-1">Email<span class="text-danger"> *</span></label>
                                    <input type="email" id="email" class="input-containers mt-1 contact-input" value="<?php echo $lgetId['lEmail']; ?>" placeholder="landlord@gmail.com" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-none">
                            <input type="text" id="txt_id" value="">
                        </div>

                        <p class="mt-5 publish-note"><b> Note: </b> After publishing this property, please wait for the administrator to conduct an ocular visit to ensure that all the information you have entered matches your actual property in order to prevent fraudulent activities.  </p>
                    </section>

                    <section class="section-publish mt-4">
                        <div class="row">
                            <div class="col-md-6 col-12  pe-md-2 pe-0">
                                <button  class="propertyListBtn" id="cancelBtn" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button> 
                            </div>

                            <div class="col-md-6 col-12 ps-md-2 ps-0 mt-md-0 mt-3 ">
                                <button class="propertyListBtn" id="btnPublish" data-bs-toggle="modal" data-bs-target="#SaveProperty">Publish your Property</button>
                            </div>
                        </div>
                    </section>
                    <?php
        }
        else{
            $select_properties_data = "SELECT * FROM landing_properties WHERE landlord_id='".$_SESSION['landlordId']."' AND propertyID='".$_GET['propId']."'";
            $execute_properties_data = mysqli_query($con, $select_properties_data);
            $get_properties_data = mysqli_fetch_assoc($execute_properties_data);
            $property_data_count = mysqli_num_rows($execute_properties_data);

            $select_properties_data1 = "SELECT * FROM landing_properties_new WHERE landlord_id='".$_SESSION['landlordId']."' AND propertyID='".$_GET['propId']."'";
            $execute_properties_data1 = mysqli_query($con, $select_properties_data1);
            $get_properties_data1 = mysqli_fetch_assoc($execute_properties_data1);

            $select_new_data = "SELECT * FROM landing_properties WHERE landlord_id='".$_SESSION['landlordId']."' AND publishing_status='Not yet'";
            $execute_new_data = mysqli_query($con, $select_new_data);
            $property_new_data_count = mysqli_num_rows($execute_new_data);

            if($property_new_data_count == 0){
                $insertData = "INSERT INTO landing_properties (landlord_id, publishing_status) VALUES ('".$_SESSION['landlordId']."', 'Not yet')";
                $executeInsert = mysqli_query($con, $insertData);

                if($executeInsert){
                    $select_new_data1 = "SELECT * FROM landing_properties WHERE landlord_id='".$_SESSION['landlordId']."' AND publishing_status='Not yet'";
                    $execute_new_data1 = mysqli_query($con, $select_new_data1);
                    $property_get_new_data = mysqli_fetch_assoc($execute_new_data1);
    
                    $insertData1 = "INSERT INTO landing_properties_new (propertyID, landlord_id, publishing_status) VALUES ('".$property_get_new_data['propertyID']."', '".$_SESSION['landlordId']."', 'Not yet')";
                    $executeInsert1 = mysqli_query($con, $insertData1);
                }
            }

            if($property_data_count > 0){
            ?>
            <script>
                window.onload = function () {
                    propertyDetailsFunction();
                    propertySpacesFunction();
                    amenitiesSideBar();
                    locationTextbox();
                    propertyInformationFunction();
                    showcheck();
                };
            </script>
            <!-- MAIN -->
        <div class="wrapper_listAProperty">

<div class="row">
<!-- SIDEBAR COLUMN -->
    <div class="col-3 col_sidebar d-flex flex-column d-md-block d-none">
        
        <div class="sidebar-wrapper position-fixed">
        <!-- PROPERTY INFO -->
        <a href="#PropertyInfo" class="sideMenuTxt sidebar-item" id="propInfoTxt">
            <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="piDiv">
                <p class="sidebarLbl sidebar-txt mt-1">Property Information</p>
                
                <span class="sidebarBtn">
                    <img id="btnProperty" src="../imgs/add1.png" alt="">
                </span>
            </div>
        </a>

        <!-- DETAILS -->
        <a href="#Details" class="sideMenuTxt sidebar-item" id="propDetailsTxt">
            <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="dDiv">
                <p class="sidebarLbl sidebar-txt mt-1">Details</p>
                
                <span class="sidebarBtn">
                    <img id="btnDetails" src="../imgs/add1.png" alt="">
                </span>
            </div>
        </a>

        <!-- spaces -->
        <a href="#Spaces" class="sideMenuTxt sidebar-item" id="propSpacesTxt">
            <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="sDiv">
                <p class="sidebarLbl sidebar-txt mt-1">Spaces</p>
                
                <span class="sidebarBtn">
                    <img id="btn_Spaces" src="../imgs/add1.png" alt="">
                </span>
            </div>
        </a>

        <!-- PHOTOS -->
        <a href="#Photos" class="sideMenuTxt sidebar-item" id="propPhotosTxt">
            <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="pDiv">
                <p class="sidebarLbl sidebar-txt mt-1">Photos</p>
                
                <span class="sidebarBtn">
                    <img id="btnPhotos" src="../imgs/add1.png" alt="">
                </span>
            </div>
        </a>

        <!-- FEATURED -->
        <a href="#Featured" class="sideMenuTxt sidebar-item" id="propFeaturedTxt">
            <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="fDiv">
                <p class="sidebarLbl sidebar-txt mt-1">Featured</p>
                
                <span class="sidebarBtn">
                    <img id="btnFeatured" src="../imgs/add1.png" alt="">
                </span>
            </div>
        </a>

        <!-- AMENITIES -->
        <a href="#Amenities" class="sideMenuTxt sidebar-item" id="propSpacesTxt">
            <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="aDiv">
                <p class="sidebarLbl sidebar-txt mt-1">Amenities</p>
                
                <span class="sidebarBtn">
                    <img id="btn_Amenities" src="../imgs/done.png" alt="">
                </span>
            </div>
        </a>

        <!-- LOCATION -->
        <a href="#Location" class="sideMenuTxt sidebar-item" id="propLocationTxt">
            <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="lDiv">
                <p class="sidebarLbl sidebar-txt mt-1">Location</p>
                
                <span class="sidebarBtn">
                    <img id="btnLocation" src="../imgs/add1.png" alt="">
                </span>
            </div>
        </a>

        <!-- CONTACT -->
        <a href="#Contact" class="sideMenuTxt sidebar-item" id="propContactsTxt">
            <div class="sidebarOpt d-flex justify-content-between px-4 py-3" id="cDiv">
                <p class="sidebarLbl sidebar-txt mt-1">Contact</p>
                
                <span class="sidebarBtn">
                    <img id="btnContact" src="../imgs/done.png" alt="">
                </span>
            </div>
        </a>

    </div>
    </div>
    <!-- END OF SIDEBAR COLUMN -->


    <!-- FORMS COLUMN -->
    <div class="col-9 px-4 py-3 col_forms d-flex flex-column">
        
        <!-- PROPERTY INFO FORM -->
        <section id="infoDiv" class="section-property-info">
            <h2 class="div-titles">Property Information</h2>
            <div class="container-inputs my-2 ">

                <!-- PROPERTY TYPE -->
                <div class="div-property-type mb-3">
                    <label for="propertyType" class="inputsLabel mt-3">Property type <span class="text-danger"> *</span></label><br>
                    <div id="btnDiv" class="d-flex row-property-type">

                    <?php
                    $selectType = "SELECT * FROM property_types";
                    $executeSelectType = mysqli_query($con, $selectType);
                    $getType = mysqli_fetch_all($executeSelectType, MYSQLI_ASSOC);
                    
                    for($i = 0; $i < count($getType); $i++){
                        if($get_properties_data['propertyType'] == $getType[$i]['property_type']){
                        ?>
                        <input type="radio" name="property_type" id="<?php echo $getType[$i]['property_type'] ?>" value="<?php echo $getType[$i]['property_type'] ?>" onclick="propertyInformationFunction()" class="btn-check visually-hidden rad-property-type" checked="checked">
                        <label for="<?php echo $getType[$i]['property_type'] ?>" class="btnType text-center label-property-type mt-3" id="btn_<?php echo $getType[$i]['property_type'] ?>"><?php echo $getType[$i]['property_type'] ?></label>
                        <?php
                        }
                        else{
                            ?>
                        <input type="radio" name="property_type" id="<?php echo $getType[$i]['property_type'] ?>" value="<?php echo $getType[$i]['property_type'] ?>" onclick="propertyInformationFunction()" class="btn-check visually-hidden rad-property-type">
                        <label for="<?php echo $getType[$i]['property_type'] ?>" class="btnType text-center label-property-type mt-3" id="btn_<?php echo $getType[$i]['property_type'] ?>"><?php echo $getType[$i]['property_type'] ?></label>
                        <?php
                        }
                    }
                    ?>
                    </div>        
                </div>
            
                <!-- PROPERTY TITLE -->
                <div class="div-property-title mb-3">
                    <label for="propertyTitle" class="form-label ms-1">Property Title <span class="text-danger"> *</span></label>
                    <input type="text" class="form-control input-containers mt-1" id="propertyTitle" value="<?php echo $get_properties_data['propertyTitle']; ?>" oninput="propertyInformationFunction()" minlength="1" maxlength="29" required>
                    <div class="form-text ms-1">This will appear as the title of your listing.</div>
                </div>

                <!-- PROPERTY DESCRIPTION -->
                <div class="div-property-description mb-3">
                    <label for="propertyDescription" class="form-label ms-1">Property Description <span class="text-danger"> *</span></label>
                    <textarea id="propertyDescription" class="w-100 input-containers textarea-description mt-1" placeholder="" oninput="propertyInformationFunction()" rows="5" cols=""><?php echo trim($get_properties_data['propertyDescription']); ?></textarea>
                    <div class="form-text ms-1">Describe your property and its unique features here to attract potential renters.</div>
                </div>

                <!-- PROPERTY PRICE -->
                <div class="row row-price">
                                <div class="col-12">
                                    <label for="propertyPrice" class="form-label">Property Price <span class="text-danger"> *</span> </label>
                                    <div class="input-group">
                                        <span class="input-group-text mt-2 span-peso" id="">₱</span>
                                        <input type="text" class="form-control mt-2 input-containers" id="propertyPrice" minlength="1" value="<?php echo $get_properties_data['propertyPrice']; ?>" onkeyup="propertyInformationFunction()" maxlength="6" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" placeholder="Rent price per month">
                                    </div>
                                </div>
            </div>

        </section>
    

    <!-- PROPERTY DETAILS FORM -->
        <section class="section-property-details mt-5">
            <h2 class="div-titles mt-3">Property Details</h2>
            <div class="container-inputs my-2 ">
                <div class="row mt-3">

                    <!-- UNIT/FLOOR NUMBER -->
                    <div class="col-4 pe-3">
                        <label for="propertyNum" class="ms-1">Unit/Floor No. <span class="text-danger"> *</span> </label><br>
                        <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" value="<?php echo $get_properties_data['propertyUnit'];?>" id="propertyNum" minlength="1" maxlength="3" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                    </div>

                    <!-- FLOOR AREA -->
                    <div class="col-4 pe-3">
                        <label for="floorArea" class="ms-1">Floor Area (m&sup2) <span class="text-danger"> *</span> </label><br>
                        <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" value="<?php echo $get_properties_data['propertyFloorArea'];?>" id="floorArea" minlength="1" maxlength="3" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                    </div>

                    <!-- Max occupants number -->
                    <div class="col-4">
                        <label for="" class="ms-1 occupant">Max occupant no. <span class="text-danger"> *</span> </label><br>
                        <input type="text" class="input-containers details-input-num mt-2 " onkeyup="propertyDetailsFunction()" value="<?php echo $get_properties_data['maxOccupants'];?>" id="maxOccupants" placeholder="" minlength="1" maxlength="29" required><br>
                    </div>

                    <!-- another row -->

                    <!-- BEDROOMS -->
                    <div class="col-4 mt-3 pe-3">
                        <label for="bedNum" class="ms-1">Bedrooms <span class="text-danger"> *</span> </label><br>
                        <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" value="<?php echo $get_properties_data['propertyBedrooms'];?>" id="bedNum" placeholder="Quantity" minlength="1" maxlength="2" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                    </div>

                    <!-- BATHROOMS -->
                    <div class="col-4 mt-3 pe-3">
                        <label for="bathNum" class="ms-1">Bathrooms <span class="text-danger"> *</span> </label><br>
                    <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" value="<?php echo $get_properties_data['propertyBedrooms'];?>" id="bathNum" placeholder="Quantity" minlength="1" maxlength="2" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                    </div>

                    <!-- CAR SPACES -->
                    <div class="col-4 mt-3">
                        <label for="otherDetails" class="ms-1" >Car Spaces <span class="text-danger"> *</span> </label><br>
                        <input type="text" class="input-containers details-input-num mt-2" onkeyup="propertyDetailsFunction()" value="<?php echo $get_properties_data['propertyParkingArea'];?>" id="otherDetails" placeholder="Quantity" minlength="1" maxlength="2" onkeydown="return /^([0-9]|Backspace)*$/i.test(event.key) || event.key.length > 1" required><br>
                    </div>

                    <!-- another row -->

                    <!-- PET FRIENDLY -->
                    <div class="col-md-5 col-12 mt-3">
                        <label for="petFriendly" class="ms-1">Pet Friendly?</label><br>
                        <div class="btn-group mt-3 gap-1"> 
                            <?php
                                if($get_properties_data['propertyPetAllowed'] == "YES"){
                            ?>
                                <input type="radio" name="pet_friendly" value="YES" id="pet_yes" onclick="propertyDetailsFunction()" class="btn-check" checked>
                                <label for="pet_yes" class="btnPet" id="yes_pet">Yes</label>
                            <?php
                                }
                            else {
                                ?>
                                <input type="radio" name="pet_friendly" value="YES" id="pet_yes" onclick="propertyDetailsFunction()" class="btn-check">
                                <label for="pet_yes" class="btnPet" id="yes_pet">Yes</label>
                                <?php
                            }
                            ?>

<?php
                                if($get_properties_data['propertyPetAllowed'] == "NO"){
                            ?>
                                <input type="radio" name="pet_friendly" value="NO" id="pet_no" onclick="propertyDetailsFunction()" class="btn-check" checked>
                                <label for="pet_no" class="btnPet" id="no_pet">No</label>
                            <?php
                                }
                            else {
                                ?>
                                <input type="radio" name="pet_friendly" value="NO" id="pet_no" onclick="propertyDetailsFunction()" class="btn-check">
                                <label for="pet_no" class="btnPet" id="no_pet">No</label>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-7 col-12 mt-3">
                        <label for="furnished" class="ms-1">Fully Furnished?</label><br>
                        <div class="radio_furnished mt-3">
                        <?php
                                if($get_properties_data['propertyFullyFurnished'] == "YES"){
                            ?>
                                <input type="radio" name="furnished_friendly" value="YES" id="furnished_yes" onclick="propertyDetailsFunction()" class="btn-check" checked>
                                <label for="furnished_yes" class="btnfurnished" id="yes_furnished">Yes</label>
                            <?php
                                }
                            else {
                                ?>
                                    <input type="radio" name="furnished_friendly" value="YES" id="furnished_yes" onclick="propertyDetailsFunction()" class="btn-check">
                                    <label for="furnished_yes" class="btnfurnished" id="yes_furnished">Yes</label>
                                <?php
                            }
                            ?>

<?php
                                if($get_properties_data['propertyFullyFurnished'] == "NO"){
                            ?>
                                <input type="radio" name="furnished_friendly" value="NO" id="furnished_no" onclick="propertyDetailsFunction()" class="btn-check" checked>
                                <label for="furnished_no" class="btnfurnished" id="no_furnished">No</label>
                            <?php
                                }
                            else {
                                ?>
                                <input type="radio" name="furnished_friendly" value="NO" id="furnished_no" onclick="propertyDetailsFunction()" class="btn-check">
                                <label for="furnished_no" class="btnfurnished" id="no_furnished">No</label>
                                <?php
                            }
                            ?>

<?php
                                if($get_properties_data['propertyFullyFurnished'] == "SEMI"){
                            ?>
                                <input type="radio" name="furnished_friendly" value="SEMI" id="furnished_semi" onclick="propertyDetailsFunction()" class="btn-check" checked>
                                <label for="furnished_semi" class="btnfurnished" id="semi_furnished">Semi</label>
                            <?php
                                }
                            else {
                                ?>
                                <input type="radio" name="furnished_friendly" value="SEMI" id="furnished_semi" onclick="propertyDetailsFunction()" class="btn-check">
                                <label for="furnished_semi" class="btnfurnished" id="semi_furnished">Semi</label>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    

    <!-- SPACES SECTION -->
        <section class="section-spaces mt-5">
            <h2 class="div-titles mt-3">Spaces</h2>
            <div class="container-inputs my-2 ">
            
            <p class="ms-1 p-instruction">Please select all the house spaces that is included in your property to be rented. 
                <b> You are required to take photos and upload each spaces below </b>. These will appear in the property gallery to be viewed by your potential renters. </p>

            <!-- INDOOR -->
            <h6 class="ms-1 mt-3 mb-4"><b>Indoor</b></h6>
            <div class="row">

                <!-- living room -->
                <div class="col-lg-3 col-4 pe-2 mt-lg-3 mt-0">
                    <?php 
                    if($get_properties_data['imgLivingroom'] != NULL){
                        ?>
                    <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Living Room" class="btn-check" id="LivingRoom" checked>
                    <label class="btn-spaces" for="LivingRoom" id="btn_LivingRoom">Living Room</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Living Room" class="btn-check" id="LivingRoom">
                        <label class="btn-spaces" for="LivingRoom" id="btn_LivingRoom">Living Room</label>
                        <?php
                    }
                    ?>
                </div>
                
                <!-- Dining room -->
                <div class="col-lg-3 col-4 pe-2 mt-lg-3 mt-0">
                <?php 
                    if($get_properties_data['imgDiningroom'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Dining room" class="btn-check" id="Diningroom" checked>
                        <label class="btn-spaces" for="Diningroom" id="btn_Diningroom">Dining Room</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Dining room" class="btn-check" id="Diningroom">
                        <label class="btn-spaces" for="Diningroom" id="btn_Diningroom">Dining Room</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Bedroom -->
                <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-lg-3 mt-0">
                <?php 
                    if($get_properties_data['imgBedroom'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Bedrooms" class="btn-check" id="Bedrooms" checked>
                        <label class="btn-spaces" for="Bedrooms" id="btn_Bedrooms">Bedroom</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Bedrooms" class="btn-check" id="Bedrooms">
                        <label class="btn-spaces" for="Bedrooms" id="btn_Bedrooms">Bedroom</label>
                        <?php
                    }
                    ?>
                </div>
                
                <!-- Bathroom -->
                <div class="col-lg-3 col-4 mt-3 pe-lg-0 pe-2">
                <?php 
                    if($get_properties_data['imgBathroom'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Bathrooms" class="btn-check" id="Bathrooms" checked>
                        <label class="btn-spaces" for="Bathrooms" id="btn_Bathrooms">Bathroom</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Bathrooms" class="btn-check" id="Bathrooms">
                        <label class="btn-spaces" for="Bathrooms" id="btn_Bathrooms">Bathroom</label>
                        <?php
                    }
                    ?>
                </div>


            <!-- 2nd row -->

                <!-- KITCHEN -->
                <div class="col-lg-3 col-4 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgKitchen'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Kitchen" class="btn-check" id="Kitchen" checked>
                        <label class="btn-spaces" for="Kitchen" id="btn_Kitchen">Kitchen</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Kitchen" class="btn-check" id="Kitchen">
                        <label class="btn-spaces" for="Kitchen" id="btn_Kitchen">Kitchen</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- LAUNDRY ROOM -->
                <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-3">
                <?php 
                    if($get_properties_data['imgLaundryroom'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Laundry Room" class="btn-check" id="LaundryRoom" checked>
                        <label class="btn-spaces" for="LaundryRoom" id="btn_LaundryRoom">Laundry Room</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Laundry Room" class="btn-check" id="LaundryRoom">
                        <label class="btn-spaces" for="LaundryRoom" id="btn_LaundryRoom">Laundry Room</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- STUDY ROOM -->
                <div class="col-lg-3 col-4 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgStudyOffice'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="StudyOffice" class="btn-check" id="StudyOffice" checked>
                        <label class="btn-spaces" for="StudyOffice" id="btn_StudyOffice">Study/Office</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="StudyOffice" class="btn-check" id="StudyOffice">
                        <label class="btn-spaces" for="StudyOffice" id="btn_StudyOffice">Study/Office</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- ENTERTAINMENT ROOM -->
                <div class="col-lg-3 col-4 mt-3 pe-lg-0 pe-2">
                <?php 
                    if($get_properties_data['imgEntertainmentroom'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Entertainment Room" class="btn-check" id="EntertainmentRoom" checked>
                        <label class="btn-spaces" for="EntertainmentRoom" id="btn_EntertainmentRoom">Entertainment</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Entertainment Room" class="btn-check" id="EntertainmentRoom">
                        <label class="btn-spaces" for="EntertainmentRoom" id="btn_EntertainmentRoom">Entertainment</label>
                        <?php
                    }
                    ?>
                </div>

            <!-- 3rd row  -->

                <!-- Walk-in Closet-->
                <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-3">
                <?php 
                    if($get_properties_data['imgWalkInCloset'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Walk In Closet" class="btn-check" id="WalkInCloset" checked>
                        <label class="btn-spaces" for="WalkInCloset" id="btn_WalkInCloset">Walk-in Closet</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Walk In Closet" class="btn-check" id="WalkInCloset">
                        <label class="btn-spaces" for="WalkInCloset" id="btn_WalkInCloset">Walk-in Closet</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Hallways -->
                <div class="col-lg-3 col-4 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgHallway'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Hallways" class="btn-check" id="Hallways" checked>
                        <label class="btn-spaces" for="Hallways" id="btn_Hallways">Hallways</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Hallways" class="btn-check" id="Hallways">
                        <label class="btn-spaces" for="Hallways" id="btn_Hallways">Hallways</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Staircase -->
                <div class="col-lg-3 col-4 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgStaircase'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Staircase" class="btn-check" id="Staircases" checked>
                        <label class="btn-spaces" for="Staircases" id="btn_Staircases">Staircases</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Staircase" class="btn-check" id="Staircases">
                        <label class="btn-spaces" for="Staircases" id="btn_Staircases">Staircases</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Other -->
                <div class="col-lg-3 col-4 mt-3">
                <?php 
                    if($get_properties_data['imgOther'] != NULL){
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Other" class="btn-check" id="Other" checked>
                        <label class="btn-spaces" for="Other" id="btn_Other">Other</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="indoors" onclick="propertySpacesFunction()" value="Other" class="btn-check" id="Other">
                        <label class="btn-spaces" for="Other" id="btn_Other">Other</label>
                        <?php
                    }
                    ?>
                </div>

            </div>
            

        <!-- OUTDOOR -->
            <h6 class="ms-1 mt-5 mb-4"><b>Outdoor</b></h6>
            <div class="row">

            <!-- 1st row -->
                <!-- GARDEN -->
                <div class="col-lg-3 col-4 pe-2 mt-lg-3 mt-0">
                <?php 
                    if($get_properties_data['imgGarden'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Garden" class="btn-check" id="Garden" checked>
                        <label class="btn-spaces" for="Garden" id="btn_Garden">Garden</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Garden" class="btn-check" id="Garden">
                        <label class="btn-spaces" for="Garden" id="btn_Garden">Garden</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- OUTDOOR KITCHEN  -->
                <div class="col-lg-3 col-4 pe-2 mt-lg-3 mt-0">
                <?php 
                    if($get_properties_data['imgOutKitchen'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Outdoor Kitchen" class="btn-check" id="OutdoorKitchen" checked>
                        <label class="btn-spaces" for="OutdoorKitchen" id="btn_OutdoorKitchen">Outdoor Kitchen</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Outdoor Kitchen" class="btn-check" id="OutdoorKitchen">
                        <label class="btn-spaces" for="OutdoorKitchen" id="btn_OutdoorKitchen">Outdoor Kitchen</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- FRONT YARD -->
                <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-lg-3 mt-0">
                <?php 
                    if($get_properties_data['imgFrontyard'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Front Yard"  class="btn-check" id="FrontYard" checked>
                        <label class="btn-spaces" for="FrontYard" id="btn_FrontYard">Front Yard</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Front Yard"  class="btn-check" id="FrontYard">
                        <label class="btn-spaces" for="FrontYard" id="btn_FrontYard">Front Yard</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- BACKYARD -->
                <div class="col-lg-3 col-4 pe-lg-0 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgBackyard'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Back Yard" class="btn-check" id="BackYard" checked>
                        <label class="btn-spaces" for="BackYard" id="btn_BackYard">Back Yard</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Back Yard" class="btn-check" id="BackYard">
                        <label class="btn-spaces" for="BackYard" id="btn_BackYard">Back Yard</label>
                        <?php
                    }
                    ?>
                </div>


            <!-- 2nd row -->
                <!-- Patio -->
                <div class="col-lg-3 col-4 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgPatio'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Patio" class="btn-check" id="Patio" checked>
                        <label class="btn-spaces" for="Patio" id="btn_Patio">Patio</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Patio" class="btn-check" id="Patio">
                        <label class="btn-spaces" for="Patio" id="btn_Patio">Patio</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Terrace -->
                <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-3">
                <?php 
                    if($get_properties_data['imgTerrace'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Terrace" class="btn-check" id="Terrace" checked>
                        <label class="btn-spaces" for="Terrace" id="btn_Terrace">Terrace</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Terrace" class="btn-check" id="Terrace">
                        <label class="btn-spaces" for="Terrace" id="btn_Terrace">Terrace</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Deck -->
                <div class="col-lg-3 col-4 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgDeck'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Deck" class="btn-check" id="Deck" checked>
                        <label class="btn-spaces" for="Deck" id="btn_Deck">Deck</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Deck" class="btn-check" id="Deck">
                        <label class="btn-spaces" for="Deck" id="btn_Deck">Deck</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Play area -->
                <div class="col-lg-3 col-4 pe-lg-0 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgPlayarea'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Play Area" class="btn-check" id="PlayArea" checked>
                        <label class="btn-spaces" for="PlayArea" id="btn_PlayArea">Play Area</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Play Area" class="btn-check" id="PlayArea">
                        <label class="btn-spaces" for="PlayArea" id="btn_PlayArea">Play Area</label>
                        <?php
                    }
                    ?>
                </div>


            <!-- 3rd row -->
                <!-- Swimming Pool -->
                <div class="col-lg-3 col-4 pe-lg-2 pe-0 mt-3">
                <?php 
                    if($get_properties_data['imgPool'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Swimming Pool" class="btn-check" id="SwimmingPool" checked>
                        <label class="btn-spaces" for="SwimmingPool" id="btn_SwimmingPool">Swimming Pool</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Swimming Pool" class="btn-check" id="SwimmingPool">
                        <label class="btn-spaces" for="SwimmingPool" id="btn_SwimmingPool">Swimming Pool</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Driveway -->
                <div class="col-lg-3 col-4 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgDriveway'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Driveway" class="btn-check" id="Driveway" checked>
                        <label class="btn-spaces" for="Driveway" id="btn_Driveway">Driveway</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Driveway" class="btn-check" id="Driveway">
                        <label class="btn-spaces" for="Driveway" id="btn_Driveway">Driveway</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Walkways -->
                <div class="col-lg-3 col-4 pe-2 mt-3">
                <?php 
                    if($get_properties_data['imgDriveway'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Walkways" class="btn-check" id="Walkways" checked>
                        <label class="btn-spaces" for="Walkways" id="btn_Walkways">Walkways</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Walkways" class="btn-check" id="Walkways">
                        <label class="btn-spaces" for="Walkways" id="btn_Walkways">Walkways</label>
                        <?php
                    }
                    ?>
                </div>

                <!-- Swimming Pool -->
                <div class="col-lg-3 col-4 mt-3">
                <?php 
                    if($get_properties_data['imgStorageshed'] != NULL){
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Storage Shed" class="btn-check" id="StorageShed" checked>
                        <label class="btn-spaces" for="StorageShed" id="btn_StorageShed">Storage Shed</label>
                    <?php
                    }
                    else{
                        ?>
                        <input type="checkbox" name="outdoors" onclick="propertySpacesFunction()" value="Storage Shed" class="btn-check" id="StorageShed">
                        <label class="btn-spaces" for="StorageShed" id="btn_StorageShed">Storage Shed</label>
                        <?php
                    }
                    ?>
                </div>

            </div>
            
            </div>
        </section>

        <!-- ``````````````````````````````````````````` -->
    <!-- PHOTO SECTION -->
    <h2 class="div-titles mt-3">Photos</h2>
                        <div class="container-inputs my-2">

                        <p class="ms-1 p-instruction">Based on the spaces you've checked in previous section, upload here the corresponding images <i class="landscape">(landscape orientation)</i>. 
                            <b> You are required to upload 3 photos on every spaces </b>. These might be in different angles to ensure that photos match your real property.</p>
                        
        <!-- MODAL ADD Living Room -->
                            <div class="modal fade" id="addLivingRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">living room</span> photos</h5>

                                                    <div class="row px-3">
                                                        <?php
                                                        if($get_properties_data['imgLivingroom'] != NULL){
                                                            ?>
                                                            <input type="file" class="d-none imgUpload0" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload0">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgLivingroom']) ?>" id="existingImages0" class="canvasResult add-photo-result d-block" alt="">
                                                                    <canvas id="imgCanvas0" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon0">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload00" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload00">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgLivingroom1']) ?>" id="existingImages00" class="add-photo-result d-block" alt="">
                                                                    <canvas id="imgCanvas00" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon00">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload000" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload000">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgLivingroom2']) ?>" id="existingImages000" class="add-photo-result d-block" alt="">
                                                                    <canvas id="imgCanvas000" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon000">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload0" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload0">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages0" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas0" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon0">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload00" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload00">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages00" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas00" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon00">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload000" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload000">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages000" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas000" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon000">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavinglivingroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="savelivingroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Living room-->

                             <!-- MODAL ADD dining Room -->
                             <div class="modal fade" id="adddiningRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">dining room</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgDiningroom'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload1" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload1">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgDiningroom']) ?>" id="existingImages1" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas1" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon1">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload1_1" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload1_1">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgDiningroom1']) ?>" id="existingImages1_1" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas1_1" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon1_1">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload1_1_1" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload1_1_1">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgDiningroom2']) ?>" id="existingImages1_1_1" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas1_1_1" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon1_1_1">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload1" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload1">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages1" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas1" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon1">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload1_1" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload1_1">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages1_1" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas1_1" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon1_1">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload1_1_1" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload1_1_1">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages1_1_1" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas1_1_1" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon1_1_1">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingdiningroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="savediningroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO dining room-->
                            
                            <!-- MODAL ADD Bed Room -->
                            <div class="modal fade" id="addBedRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">Bedroom</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgBedroom'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload2">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgBedroom']) ?>" id="existingImages2" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas2" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload2_2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload2_2">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgBedroom1']) ?>" id="existingImages2_2" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas2_2" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon2_2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload2_2_2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload2_2_2">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgBedroom2']) ?>" id="existingImages2_2_2" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas2_2_2" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon2_2_2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload2">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages2" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas2" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload2_2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload2_2">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages2_2" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas2_2" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon2_2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload2_2_2" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload2_2_2">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages2_2_2" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas2_2_2" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon2_2_2">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingBedroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveBedroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Bed room-->
                            
                                <!-- MODAL ADD Bathroom -->
                                <div class="modal fade" id="addBathroom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">bathroom</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgBathroom'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload3">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgBathroom']) ?>" id="existingImages3" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas3" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload3_3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload3_3">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgBathroom1']) ?>" id="existingImages3_3" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas3_3" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon3_3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload3_3_3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload3_3_3">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgBathroom2']) ?>" id="existingImages3_3_3" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas3_3_3" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon3_3_3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload3">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages3" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas3" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload3_3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload3_3">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages3_3" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas3_3" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon3_3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload3_3_3" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload3_3_3">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages3_3_3" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas3_3_3" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon3_3_3">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingBathroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveBathroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Bathroom room-->

                            <!-- MODAL ADD Kitchen -->
                            <div class="modal fade" id="addKitchen" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">kitchen</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgKitchen'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload4">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgKitchen']) ?>" id="existingImages4" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas4" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload4_4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload4_4">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgKitchen1']) ?>" id="existingImages4_4" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas4_4" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon4_4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload4_4_4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload4_4_4">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgKitchen2']) ?>" id="existingImages4_4_4" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas4_4_4" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon4_4_4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                        <input type="file" class="d-none imgUpload4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload4">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages4" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas4" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload4_4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload4_4">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages4_4" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas4_4" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon4_4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload4_4_4" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload4_4_4">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages4_4_4" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas4_4_4" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon4_4_4">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingKitchen()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveKitchen()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Kitchen room-->
                            <!-- MODAL ADD Laundry Room -->
                            <div class="modal fade" id="addLaundryRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">laundry room</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgLaundryroom'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload5" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload5">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgLaundryroom']) ?>" id="existingImages5" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas5" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon5">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload5_5" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload5_5">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgLaundryroom1']) ?>" id="existingImages5_5" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas5_5" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon5_5">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload5_5_5" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload5_5_5">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgLaundryroom2']) ?>" id="existingImages5_5_5" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas5_5_5" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon5_5_5">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload5" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload5">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages5" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas5" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon5">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload5_5" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload5_5">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages5_5" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas5_5" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon5_5">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload5_5_5" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload5_5_5">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages5_5_5" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas5_5_5" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon5_5_5">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingLaundryroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveLaundryroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Laundry Room room-->
                            <!-- MODAL ADD StudyOffice -->
                            <div class="modal fade" id="addStudyOffice" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">study/Office room</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgStudyOffice'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload6">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgStudyOffice']) ?>" id="existingImages6" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas6" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload6_6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload6_6">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgStudyOffice1']) ?>" id="existingImages6_6" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas6_6" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon6_6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload6_6_6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload6_6_6">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgStudyOffice2']) ?>" id="existingImages6_6_6" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas6_6_6" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon6_6_6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                        <input type="file" class="d-none imgUpload6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload6">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages6" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas6" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload6_6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload6_6">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages6_6" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas6_6" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon6_6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload6_6_6" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload6_6_6">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages6_6_6" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas6_6_6" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon6_6_6">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingStudyOffice()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveStudyOffice()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO StudyOffice room-->
                            <!-- MODAL ADD Entertainment Room -->
                            <div class="modal fade" id="addEntertainmentRoom" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">entertainment room</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgEntertainmentroom'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload7" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload7">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgEntertainmentroom']) ?>" id="existingImages7" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas7" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon7">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload7_7" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload7_7">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgEntertainmentroom1']) ?>" id="existingImages7_7" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas7_7" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon7_7">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload7_7_7" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload7_7_7">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgEntertainmentroom2']) ?>" id="existingImages7_7_7" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas7_7_7" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon7_7_7">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload7" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload7">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages7" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas7" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon7">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload7_7" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload7_7">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages7_7" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas7_7" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon7_7">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload7_7_7" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload7_7_7">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages7_7_7" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas7_7_7" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon7_7_7">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingEntertainmentroom()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveEntertainmentroom()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Entertainment Room -->
                            <!-- MODAL ADD Walk in closet -->
                            <div class="modal fade" id="addwalkincloset" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">walk-in closet</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgWalkInCloset'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload8" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload8">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgWalkInCloset']) ?>" id="existingImages8" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas8" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon8">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload8_8" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload8_8">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgWalkInCloset1']) ?>" id="existingImages8_8" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas8_8" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon8_8">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload8_8_8" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload8_8_8">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgWalkInCloset2']) ?>" id="existingImages8_8_8" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas8_8_8" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon8_8_8">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload8" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload8">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages8" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas8" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon8">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload8_8" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload8_8">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages8_8" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas8_8" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon8_8">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload8_8_8" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload8_8_8">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages8_8_8" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas8_8_8" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon8_8_8">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingwalkincloset()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="savewalkincloset()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Walk in closet room-->
                            <!-- MODAL ADD Hallways -->
                            <div class="modal fade" id="addHallways" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">hallways</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgHallway'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload9" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload9">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgHallway']) ?>" id="existingImages9" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas9" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon9">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload9_9" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload9_9">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgHallway1']) ?>" id="existingImages9_9" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas9_9" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon9_9">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload9_9_9" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload9_9_9">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgHallway2']) ?>" id="existingImages9_9_9" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas9_9_9" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon9_9_9">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload9" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload9">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages9" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas9" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon9">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload9_9" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload9_9">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages9_9" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas9_9" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon9_9">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload9_9_9" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload9_9_9">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages9_9_9" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas9_9_9" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon9_9_9">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingHallways()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveHallways()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Hallways-->
                            <!-- MODAL ADD Staircase -->
                            <div class="modal fade" id="addStaircase" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">staircase</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgStaircase'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload10">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgStaircase']) ?>" id="existingImages10" class="canvasResult add-photo-result d-bock" alt="">
                                                                <canvas id="imgCanvas10" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload10_10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload10_10">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgStaircase1']) ?>" id="existingImages10_10" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas10_10" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon10_10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload10_10_10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload10_10_10">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgStaircase2']) ?>" id="existingImages10_10_10" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas10_10_10" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon10_10_10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                        <input type="file" class="d-none imgUpload10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload10">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages10" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas10" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload10_10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload10_10">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages10_10" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas10_10" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon10_10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload10_10_10" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload10_10_10">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages10_10_10" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas10_10_10" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon10_10_10">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingStaircase()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveStaircase()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Staircase-->
                            <!-- MODAL ADD Other -->
                            <div class="modal fade" id="addOther" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">other</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgOther'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload11" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload11">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgOther']) ?>" id="existingImages11" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas11" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon11">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload11_11" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload11_11">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgOther1']) ?>" id="existingImages11_11" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas11_11" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon11_11">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload11_11_11" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload11_11_11">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgOther2']) ?>" id="existingImages11_11_11" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas11_11_11" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon11_11_11">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload11" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload11">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages11" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas11" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon11">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload11_11" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload11_11">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages11_11" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas11_11" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon11_11">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload11_11_11" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload11_11_11">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages11_11_11" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas11_11_11" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon11_11_11">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingOther()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveOther()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Other-->
                            <!-- MODAL ADD Garden -->
                            <div class="modal fade" id="addGarden" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">garden</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgGarden'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload12" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload12">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgGarden']) ?>" id="existingImages12" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas12" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon12">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload12_12" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload12_12">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgGarden1']) ?>" id="existingImages12_12" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas12_12" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon12_12">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload12_12_12" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload12_12_12">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgGarden2']) ?>" id="existingImages12_12_12" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas12_12_12" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon12_12_12">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload12" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload12">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages12" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas12" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon12">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload12_12" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload12_12">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages12_12" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas12_12" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon12_12">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload12_12_12" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload12_12_12">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages12_12_12" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas12_12_12" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon12_12_12">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingGarden()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveGarden()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Garden-->
                            <!-- MODAL ADD Outdoorkitchen -->
                            <div class="modal fade" id="addOutdoorkitchen" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">outdoor kitchen</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgOutKitchen'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload13" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload13">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgOutKitchen']) ?>" id="existingImages13" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas13" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon13">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload13_13" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload13_13">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgOutKitchen1']) ?>" id="existingImages13_13" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas13_13" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon13_13">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload13_13_13" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload13_13_13">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgOutKitchen2']) ?>" id="existingImages13_13_13" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas13_13_13" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon13_13_13">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload13" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload13">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages13" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas13" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon13">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload13_13" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload13_13">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages13_13" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas13_13" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon13_13">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload13_13_13" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload13_13_13">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages13_13_13" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas13_13_13" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon13_13_13">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingOutdoorkitchen()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveOutdoorkitchen()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Outdoorkitchen-->
                            <!-- MODAL ADD Frontyard -->
                            <div class="modal fade" id="addFrontyard" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">front yard</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgFrontyard'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload14" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload14">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgFrontyard']) ?>" id="existingImages14" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas14" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon14">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload14_14" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload14_14">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgFrontyard1']) ?>" id="existingImages14_14" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas14_14" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon14_14">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload14_14_14" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload14_14_14">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgFrontyard2']) ?>" id="existingImages14_14_14" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas14_14_14" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon14_14_14">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload14" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload14">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages14" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas14" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon14">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload14_14" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload14_14">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages14_14" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas14_14" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon14_14">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload14_14_14" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload14_14_14">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages14_14_14" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas14_14_14" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon14_14_14">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingFrontyard()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveFrontyard()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Frontyard-->
                            <!-- MODAL ADD Backyard -->
                            <div class="modal fade" id="addBackyard" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">back yard</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgBackyard'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload15" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload15">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgBackyard']) ?>" id="existingImages15" class="canvasResult add-photo-result d-bock" alt="">
                                                                <canvas id="imgCanvas15" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon15">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload15_15" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload15_15">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgBackyard1']) ?>" id="existingImages15_15" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas15_15" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon15_15">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload15_15_15" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload15_15_15">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgBackyard2']) ?>" id="existingImages15_15_15" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas15_15_15" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon15_15_15">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload15" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload15">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages15" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas15" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon15">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload15_15" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload15_15">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages15_15" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas15_15" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon15_15">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload15_15_15" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload15_15_15">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages15_15_15" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas15_15_15" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon15_15_15">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingBackyard()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveBackyard()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Backyard-->
                            <!-- MODAL ADD Patio -->
                            <div class="modal fade" id="addPatio" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">patio</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgPatio'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload16" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload16">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgPatio']) ?>" id="existingImages16" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas16" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon16">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload16_16" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload16_16">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgPatio1']) ?>" id="existingImages16_16" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas16_16" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon16_16">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload16_16_16" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload16_16_16">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgPatio2']) ?>" id="existingImages16_16_16" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas16_16_16" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon16_16_16">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload16" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload16">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages16" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas16" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon16">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload16_16" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload16_16">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages16_16" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas16_16" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon16_16">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload16_16_16" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload16_16_16">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages16_16_16" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas16_16_16" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon16_16_16">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingPatio()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="savePatio()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Patio-->
                            <!-- MODAL ADD terrace -->
                            <div class="modal fade" id="addTerrace" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">terrace</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgTerrace'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload17" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload17">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgTerrace']) ?>" id="existingImages17" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas17" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon17">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload17_17" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload17_17">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgTerrace1']) ?>" id="existingImages17_17" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas17_17" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon17_17">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload17_17_17" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload17_17_17">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgTerrace2']) ?>" id="existingImages17_17_17" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas17_17_17" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon17_17_17">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload17" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload17">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages17" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas17" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon17">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload17_17" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload17_17">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages17_17" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas17_17" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon17_17">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload17_17_17" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload17_17_17">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages17_17_17" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas17_17_17" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon17_17_17">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingTerrace()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveTerrace()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Terrace-->
                            <!-- MODAL ADD deck -->
                            <div class="modal fade" id="addDeck" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">deck</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgDeck'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload18" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload18">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgDeck']) ?>" id="existingImages18" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas18" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon18">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload18_18" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload18_18">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgDeck1']) ?>" id="existingImages18_18" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas18_18" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon18_18">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload18_18_18" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload18_18_18">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgDeck2']) ?>" id="existingImages18_18_18" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas18_18_18" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon18_18_18">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload18" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload18">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages18" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas18" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon18">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload18_18" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload18_18">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages18_18" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas18_18" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon18_18">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload18_18_18" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload18_18_18">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages18_18_18" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas18_18_18" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon18_18_18">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingDeck()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveDeck()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Deck-->
                            <!-- MODAL ADD playarea -->
                            <div class="modal fade" id="addplayarea" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">play area</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgPlayarea'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload19" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload19">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgPlayarea']) ?>" id="existingImages19" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas19" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon19">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload19_19" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload19_19">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgPlayarea1']) ?>" id="existingImages19_19" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas19_19" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon19_19">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload19_19_19" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload19_19_19">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgPlayarea2']) ?>" id="existingImages19_19_19" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas19_19_19" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon19_19_19">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload19" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload19">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages19" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas19" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon19">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload19_19" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload19_19">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages19_19" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas19_19" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon19_19">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload19_19_19" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload19_19_19">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages19_19_19" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas19_19_19" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon19_19_19">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingplayarea()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveplayarea()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO playarea-->
                            <!-- MODAL ADD swimmingpool -->
                            <div class="modal fade" id="addswimmingpool" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">swimming pool</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgPool'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload20" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload20">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgPool']) ?>" id="existingImages20" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas20" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon20">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload20_20" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload20_20">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgPool1']) ?>" id="existingImages20_20" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas20_20" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon20_20">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload20_20_20" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload20_20_20">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgPool2']) ?>" id="existingImages20_20_20" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas20_20_20" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon20_20_20">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload20" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload20">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages20" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas20" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon20">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload20_20" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload20_20">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages20_20" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas20_20" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon20_20">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload20_20_20" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload20_20_20">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages20_20_20" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas20_20_20" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon20_20_20">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingswimmingpool()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveswimmingpool()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO swimmingpool-->
                            <!-- MODAL ADD Driveway -->
                            <div class="modal fade" id="addDriveway" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">driveway</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgDriveway'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload21">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgDriveway']) ?>" id="existingImages21" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas21" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload21_21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload21_21">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgDriveway1']) ?>" id="existingImages21_21" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas21_21" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon21_21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload21_21_21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload21_21_21">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgDriveway2']) ?>" id="existingImages21_21_21" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas21_21_21" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon21_21_21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                             <input type="file" class="d-none imgUpload21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload21">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages21" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas21" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload21_21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload21_21">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages21_21" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas21_21" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon21_21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload21_21_21" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload21_21_21">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages21_21_21" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas21_21_21" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon21_21_21">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingDriveway()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveDriveway()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Driveway-->
                            <!-- MODAL ADD Walkways -->
                            <div class="modal fade" id="addWalkways" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">walkways</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgWalkways'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload22">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgWalkways']) ?>" id="existingImages22" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas22" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload22_22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload22_22">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgWalkways1']) ?>" id="existingImages22_22" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas22_22" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon22_22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload22_22_22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload22_22_22">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgWalkways2']) ?>" id="existingImages22_22_22" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas22_22_22" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon22_22_22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                        <input type="file" class="d-none imgUpload22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload22">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages22" class="canvasResult add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas22" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload22_22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload22_22">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="" id="existingImages22_22" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas22_22" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon22_22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload22_22_22" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload22_22_22">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="" id="existingImages22_22_22" class="add-photo-result d-none" alt="">
                                                                <canvas id="imgCanvas22_22_22" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon22_22_22">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingWalkways()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveWalkways()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO Walkways-->
                            <!-- MODAL ADD StorageShed -->
                            <div class="modal fade" id="addStorageShed" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content modals container_modalAddPhoto">

                                            <div class="modal-header modal-header-logout p-3">
                                            </div>

                                            <div class="modal-body modal-body-logout">
                                                <section class="section_logout">
                                                    <h5 class="text-center">Add 3 <span class="space-name">storage shed</span> photos</h5>

                                                    <div class="row px-3">
                                                    <?php
                                                        if($get_properties_data['imgStorageshed'] != NULL){
                                                    ?>
                                                        <input type="file" class="d-none imgUpload23" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload23">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgStorageshed']) ?>" id="existingImages23" class="canvasResult add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas23" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon23">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload23_23" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload23_23">
                                                            <div class="d-flex justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgStorageshed1']) ?>" id="existingImages23_23" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas23_23" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon23_23">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="file" class="d-none imgUpload23_23_23" accept=".png, .jpg, .jpeg"> 
                                                        <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload23_23_23">
                                                            <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                <img src="<?php echo str_replace("../../", "../", $get_properties_data1['imgStorageshed2']) ?>" id="existingImages23_23_23" class="add-photo-result d-block" alt="">
                                                                <canvas id="imgCanvas23_23_23" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                <div class="add-photo d-none flex-column justify-content-center align-items-center" id="uploadIcon23_23_23">
                                                                    <i class="bi bi-image upload-icon"></i>
                                                                    <p class="featured">Add Photo</p>
                                                                    <p class="file-type">JPEG or PNG only</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <input type="file" class="d-none imgUpload23" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3"  id="img_upload23">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages23" class="canvasResult add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas23" class="canvasResult add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon23">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload23_23" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-6 col-12 mx-md-0 mt-3" id="img_upload23_23">
                                                                <div class="d-flex justify-content-center ">
                                                                    <img src="" id="existingImages23_23" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas23_23" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon23_23">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <input type="file" class="d-none imgUpload23_23_23" accept=".png, .jpg, .jpeg"> 
                                                            <div class="col-lg-4 col-md-12 col-12 mx-md-0 mt-3" id="img_upload23_23_23">
                                                                <div class="d-flex justify-content-lg-end justify-content-md-center justify-content-center ">
                                                                    <img src="" id="existingImages23_23_23" class="add-photo-result d-none" alt="">
                                                                    <canvas id="imgCanvas23_23_23" class="add-photo-result canvas-result-featured d-none"></canvas>
                                                                    <div class="add-photo d-flex flex-column justify-content-center align-items-center" id="uploadIcon23_23_23">
                                                                        <i class="bi bi-image upload-icon"></i>
                                                                        <p class="featured">Add Photo</p>
                                                                        <p class="file-type">JPEG or PNG only</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>

                                                    
                                                    
                                                </section>
                                            </div>

                                            <div class="modal-footer d-flex gap-2 p-3">
                                                <button type="button" class="btn btn-cancel modal-logout-btns" onclick="cancelsavingStorageShed()" data-bs-dismiss="modal">Cancel</button>
                                                <a id="btnConfirmLogout" class="btn btn-go text-light modal-logout-btns d-flex align-items-center justify-content-center" onclick="saveStorageShed()">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- modal end -  ADD PHOTO StorageShed-->
                        </div>
                            <!-- list property view image -->
                            <div class="row mt-3 row-featured">
                                <!-- living -->
                                <div class="img0 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addLivingRoom" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgLivingroom'] != NULL){
                                ?>    
                                        <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgLivingroom']) ?>" id="existinglivingroom" class="canvasResult d-block" alt="">
                                        <canvas id="imgCanvaslivingroom" class="canvas-result-featured d-none"></canvas>
                                        <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconlivingroom">
                                            <i class="bi bi-image upload-icon"></i>
                                            <p class="featured">Add Photo</p>
                                            <p class="file-type">JPEG or PNG only</p>
                                        </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existinglivingroom" class="d-none" alt="">
                                        <canvas id="imgCanvaslivingroom" class="canvas-result-featured d-none"></canvas>
                                        <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconlivingroom">
                                            <i class="bi bi-image upload-icon"></i>
                                            <p class="featured">Add Photo</p>
                                            <p class="file-type">JPEG or PNG only</p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName0" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- dining -->
                                <div class="img1 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#adddiningRoom" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgDiningroom'] != NULL){
                                ?> 
                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgDiningroom']) ?>" id="existingdiningroom" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasdiningroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_icondiningroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingdiningroom" class="canvasResult d-none" alt="">
                                        <canvas id="imgCanvasdiningroom" class="canvas-result-featured d-none"></canvas>
                                        <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_icondiningroom">
                                            <i class="bi bi-image upload-icon"></i>
                                            <p class="featured">Add Photo</p>
                                            <p class="file-type">JPEG or PNG only</p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName1" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Bedroom -->
                                <div class="img2 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addBedRoom" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgBedroom'] != NULL){
                                ?> 
                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgBedroom']) ?>" id="existingbedroom" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasbedroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconbedroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingbedroom" class="canvasResult d-none" alt="">
                                        <canvas id="imgCanvasbedroom" class="canvas-result-featured d-none"></canvas>
                                        <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconbedroom">
                                            <i class="bi bi-image upload-icon"></i>
                                            <p class="featured">Add Photo</p>
                                            <p class="file-type">JPEG or PNG only</p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName2" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- bathroom -->
                                <div class="img3 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addBathroom" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgBathroom'] != NULL){
                                ?> 
                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgBathroom']) ?>" id="existingbathroom" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasbathroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconbathroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingbathroom" class="d-none" alt="">
                                        <canvas id="imgCanvasbathroom" class="canvas-result-featured d-none"></canvas>
                                        <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconbathroom">
                                            <i class="bi bi-image upload-icon"></i>
                                            <p class="featured">Add Photo</p>
                                            <p class="file-type">JPEG or PNG only</p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName3" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- kitchen -->
                                <div class="img4 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addKitchen" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgKitchen'] != NULL){
                                ?> 
                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgKitchen']) ?>" id="existingkitchen" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvaskitchen" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconkitchen">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingkitchen" class="canvasResult d-none" alt="">
                                        <canvas id="imgCanvaskitchen" class="canvas-result-featured d-none"></canvas>
                                        <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconkitchen">
                                            <i class="bi bi-image upload-icon"></i>
                                            <p class="featured">Add Photo</p>
                                            <p class="file-type">JPEG or PNG only</p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName4" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Laundryroom -->
                                <div class="img5 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addLaundryRoom" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgLaundryroom'] != NULL){
                                ?> 
                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgLaundryroom']) ?>" id="existingLaundryroom" class="canvasResult d-bock" alt="">
                                    <canvas id="imgCanvasLaundryroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconLaundryroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingLaundryroom" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasLaundryroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconLaundryroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName5" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- StudyOffice -->
                                <div class="img6 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addStudyOffice" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgStudyOffice'] != NULL){
                                ?> 
                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgStudyOffice']) ?>" id="existingStudyOffice" class=" canvasResult d-block" alt="">
                                    <canvas id="imgCanvasStudyOffice" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconStudyOffice">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingStudyOffice" class=" canvasResult d-none" alt="">
                                    <canvas id="imgCanvasStudyOffice" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconStudyOffice">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName6" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Entertainmentroom -->
                                <div class="img7 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addEntertainmentRoom" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgEntertainmentroom'] != NULL){
                                ?>     
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgEntertainmentroom']) ?>" id="existingEntertainmentroom" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasEntertainmentroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconEntertainmentroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingEntertainmentroom" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasEntertainmentroom" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconEntertainmentroom">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName7" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- WalkInCloset -->
                                <div class="img8 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addwalkincloset" data-bs-toggle="modal">
                                    <?php
                                    if($get_properties_data['imgWalkInCloset'] != NULL){
                                ?>   
                                    <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgWalkInCloset']) ?>" id="existingWalkInCloset" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasWalkInCloset" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconWalkInCloset">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>  
                                    <img src="" id="existingWalkInCloset" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasWalkInCloset" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconWalkInCloset">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName8" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Hallways -->
                                <div class="img9 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addHallways" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgHallway'] != NULL){
                                ?>      
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgHallway']) ?>" id="existingHallways" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasHallways" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconHallways">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>    
                                <img src="" id="existingHallways" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasHallways" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconHallways">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName9" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Staircase -->
                                <div class="img10 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addStaircase" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgStaircase'] != NULL){
                                ?>          
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgStaircase']) ?>" id="existingStaircase" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasStaircase" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconStaircase">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>          
                                    <img src="" id="existingStaircase" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasStaircase" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconStaircase">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName10" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Other -->
                                <div class="img11 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addOther" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgOther'] != NULL){
                                ?>          
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgOther']) ?>" id="existingOther" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasOther" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconOther">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>         
                                <img src="" id="existingOther" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasOther" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconOther">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName11" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Garden -->
                                <div class="img12 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addGarden" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgGarden'] != NULL){
                                ?>       
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgGarden']) ?>" id="existingGarden" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasGarden" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconGarden">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>       
                                <img src="" id="existingGarden" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasGarden" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconGarden">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName12" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Outdoorkitchen -->
                                <div class="img13 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addOutdoorkitchen" data-bs-toggle="modal">
                                    <?php
                                    if($get_properties_data['imgOutKitchen'] != NULL){
                                ?>     
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgOutKitchen']) ?>" id="existingOutdoorkitchen" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasOutdoorkitchen" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconOutdoorkitchen">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>  
                                <img src="" id="existingOutdoorkitchen" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasOutdoorkitchen" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconOutdoorkitchen">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName13" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Frontyard -->
                                <div class="img14 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addFrontyard" data-bs-toggle="modal">
                                    <?php
                                    if($get_properties_data['imgFrontyard'] != NULL){
                                ?>   
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgFrontyard']) ?>" id="existingFrontyard" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasFrontyard" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconFrontyard">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>  
                                <img src="" id="existingFrontyard" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasFrontyard" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconFrontyard">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName14" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Backyard -->
                                <div class="img15 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addBackyard" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgBackyard'] != NULL){
                                ?>       
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgBackyard']) ?>" id="existingBackyard" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasBackyard" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconBackyard">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                <img src="" id="existingBackyard" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasBackyard" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconBackyard">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName15" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Patio -->
                                <div class="img16 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addPatio" data-bs-toggle="modal">
                                    <?php
                                    if($get_properties_data['imgPatio'] != NULL){
                                ?>    
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgPatio']) ?>" id="existingPatio" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasPatio" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconPatio">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>  
                                <img src="" id="existingPatio" class="canvasResult d-none" alt="">
                                    <canvas id="imgCanvasPatio" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconPatio">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName16" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Terrace -->
                                <div class="img17 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addTerrace" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgTerrace'] != NULL){
                                ?>    
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgTerrace']) ?>" id="existingTerrace" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasTerrace" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconTerrace">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>  
                                        <img src="" id="existingTerrace" class="canvasResult d-none" alt="">
                                            <canvas id="imgCanvasTerrace" class="canvas-result-featured d-none"></canvas>
                                            <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconTerrace">
                                                <i class="bi bi-image upload-icon"></i>
                                                <p class="featured">Add Photo</p>
                                                <p class="file-type">JPEG or PNG only</p>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName17" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Deck -->
                                <div class="img18 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addDeck" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgDeck'] != NULL){
                                ?>    
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgDeck']) ?>" id="existingDeck" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasDeck" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconDeck">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>   
                                        <img src="" id="existingDeck" class="canvasResult d-none" alt="">
                                            <canvas id="imgCanvasDeck" class="canvas-result-featured d-none"></canvas>
                                            <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconDeck">
                                                <i class="bi bi-image upload-icon"></i>
                                                <p class="featured">Add Photo</p>
                                                <p class="file-type">JPEG or PNG only</p>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName18" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Playarea -->
                                <div class="img19 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addplayarea" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgPlayarea'] != NULL){
                                ?>    
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgPlayarea']) ?>" id="existingPlayarea" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasPlayarea" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconPlayarea">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>  
                                        <img src="" id="existingPlayarea" class="canvasResult d-none" alt="">
                                            <canvas id="imgCanvasPlayarea" class="canvas-result-featured d-none"></canvas>
                                            <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconPlayarea">
                                                <i class="bi bi-image upload-icon"></i>
                                                <p class="featured">Add Photo</p>
                                                <p class="file-type">JPEG or PNG only</p>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName19" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Swimmingpool -->
                                <div class="img20 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addswimmingpool" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgPool'] != NULL){
                                ?>  
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgPool']) ?>" id="existingSwimmingpool" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasSwimmingpool" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconSwimmingpool">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingSwimmingpool" class="canvasResult d-none" alt="">
                                            <canvas id="imgCanvasSwimmingpool" class="canvas-result-featured d-none"></canvas>
                                            <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconSwimmingpool">
                                                <i class="bi bi-image upload-icon"></i>
                                                <p class="featured">Add Photo</p>
                                                <p class="file-type">JPEG or PNG only</p>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName20" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Driveway -->
                                <div class="img21 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addDriveway" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgDriveway'] != NULL){
                                ?> 
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgDriveway']) ?>" id="existingDriveway" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasDriveway" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconDriveway">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingDriveway" class="canvasResult d-none" alt="">
                                            <canvas id="imgCanvasDriveway" class="canvas-result-featured d-none"></canvas>
                                            <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconDriveway">
                                                <i class="bi bi-image upload-icon"></i>
                                                <p class="featured">Add Photo</p>
                                                <p class="file-type">JPEG or PNG only</p>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName21" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Walkways -->
                                <div class="img22 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addWalkways" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgWalkways'] != NULL){
                                ?> 
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgWalkways']) ?>" id="existingWalkways" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasWalkways" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconWalkways">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingWalkways" class="canvasResult d-none" alt="">
                                            <canvas id="imgCanvasWalkways" class="canvas-result-featured d-none"></canvas>
                                            <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconWalkways">
                                                <i class="bi bi-image upload-icon"></i>
                                                <p class="featured">Add Photo</p>
                                                <p class="file-type">JPEG or PNG only</p>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName22" class="spaces-label mt-1 text-center"></div>
                                </div>
                                <!-- Storageshed -->
                                <div class="img23 d-none col-lg-4 col-md-6 col-12 col-featured pe-2 mx-md-0 mt-3" id="" data-bs-target="#addStorageShed" data-bs-toggle="modal">
                                <?php
                                    if($get_properties_data['imgStorageshed'] != NULL){
                                ?> 
                                <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgStorageshed']) ?>" id="existingStorageshed" class="canvasResult d-block" alt="">
                                    <canvas id="imgCanvasStorageshed" class="canvas-result-featured d-none"></canvas>
                                    <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_iconStorageshed">
                                        <i class="bi bi-image upload-icon"></i>
                                        <p class="featured">Add Photo</p>
                                        <p class="file-type">JPEG or PNG only</p>
                                    </div>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <img src="" id="existingStorageshed" class="canvasResult d-none" alt="">
                                            <canvas id="imgCanvasStorageshed" class="canvas-result-featured d-none"></canvas>
                                            <div class="upload-box-featured uploadBox1 d-flex flex-column justify-content-center align-items-center" id="image_iconStorageshed">
                                                <i class="bi bi-image upload-icon"></i>
                                                <p class="featured">Add Photo</p>
                                                <p class="file-type">JPEG or PNG only</p>
                                            </div>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgName23" class="spaces-label mt-1 text-center"></div>
                                </div>
                            </div>
                    </section>


    <!-- FEATURED PHOTOS SECTION -->
    <section class="section-featured mt-5">
            <h2 class="div-titles mt-3">Featured Photos</h2>
            <div class="container-inputs my-2" >

                <p class="ms-1 p-instruction">Please upload 3 nice photos <i class="landscape">(landscape orientation)</i>  of your property that you want to feature to attract potential renters.</p>

                <div class="row mt-3 row-featured ">

                    <!-- FEATURED PHOTO 1 -->
                    <input type="file" class="d-none imgUploadFeatured1" accept=".png, .jpg, .jpeg">
                    <div class="col-lg-4 col-md-6 col-12 col-featured imgFeatured1 pe-2 mx-md-0" id="img_uploadFeatured1">
                        <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgFeatured1']) ?>" id="existingfeatured1" class="canvasResult d-block" alt="">
                        <canvas id="imgCanvasFeatured1" class="canvasResult canvas-result-featured d-none"></canvas>
                        <div class="upload-box-featured uploadBox1 d-none flex-column justify-content-center align-items-center" id="image_icon1">
                            <i class="bi bi-image upload-icon"></i>
                            <p class="featured">Featured 1</p>
                            <p class="file-type">JPEG or PNG only</p>
                        </div>
                    </div>

                    <!-- FEATURED PHOTO 2 -->
                    <input type="file" class="d-none imgUploadFeatured2" accept=".png, .jpg, .jpeg">
                    <div class="col-lg-4 col-md-6 col-12 col-featured imgFeatured2 pe-2 mt-md-0 mt-3" id="img_uploadFeatured2">
                        <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgFeatured2']) ?>" id="existingfeatured2" class="canvasResult d-block" alt="">
                        <canvas id="imgCanvasFeatured2" class="canvasResult canvas-result-featured d-none"></canvas>
                        <div class="upload-box-featured uploadBox2 d-none flex-column justify-content-center align-items-center" id="image_icon2">
                            <i class="bi bi-image upload-icon"></i>
                            <p class="featured">Featured 2</p>
                            <p class="file-type">JPEG or PNG only</p>
                        </div>
                    </div>

                    <!-- FEATURED PHOTO 3 -->
                    <input type="file" class="d-none imgUploadFeatured3" accept=".png, .jpg, .jpeg">
                    <div class="col-lg-4 col-md-6 col-12 col-featured mt-lg-0 mt-md-2 mx-auto mt-3  imgFeatured3 pe-2" id="img_uploadFeatured3">
                        <img src="<?php echo str_replace("../../", "../", $get_properties_data['imgFeatured3']) ?>" id="existingfeatured3" class="canvasResult d-block" alt="">
                        <canvas id="imgCanvasFeatured3" class="canvasResult canvas-result-featured d-none"></canvas>
                        <div class="upload-box-featured uploadBox3 d-none flex-column justify-content-center align-items-center" id="image_icon3">
                            <i class="bi bi-image upload-icon"></i>
                            <p class="featured">Featured 3</p>
                            <p class="file-type">JPEG or PNG only</p>
                        </div>
                    </div>

                    </div>

            </div>
        </section>
        
        <!-- AMENITIES SECTION -->
        <section class="section-amenities mt-5">
                        <h2 class="div-titles mt-3">Amenities</h2>
                        <div class="container-inputs my-2 ">
                            
                            <p class="p-instruction mb-3">Please select all the amenities that renters can enjoy in your property.</p>
                            
                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Wi-Fi') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Wi-Fi" id="WiFi" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Wi-Fi" id="WiFi"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Wi-Fi</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                            <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Air Conditioner') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Air Conditioner" id="AirConditioner" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Air Conditioner" id="AirConditioner"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Air conditioner</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                            <?php
                                                    if(strpos($get_properties_data['propertyAmenities'], 'Soundproof Walls') !== false){
                                                        ?>
                                                        <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Soundproof Walls" id="SoundproofWalls" checked/> 
                                                        <span class="checkbox"></span>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Soundproof Walls" id="SoundproofWalls"/> 
                                                        <span class="checkbox"></span>
                                                        <?php
                                                    }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Soundproof walls</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                 if(strpos($get_properties_data['propertyAmenities'], 'Bath Tub') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bath Tub" id="BathTub" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                 }
                                                 else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bath Tub" id="BathTub"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                 }
                                                 ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Bath tub </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Sofa') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Sofa" id="Sofa" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Sofa" id="Sofa"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Sofa</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                    if(strpos($get_properties_data['propertyAmenities'], 'Bed') !== false){
                                                        ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bed" id="Bed" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bed" id="Bed"/> 
                                                        <span class="checkbox"></span>
                                                        <?php
                                                    }
                                                    ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Bed</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                    if(strpos($get_properties_data['propertyAmenities'], 'Work Table') !== false){
                                                        ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Work Table" id="WorkTable" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Work Table" id="WorkTable"/> 
                                                        <span class="checkbox"></span>
                                                        <?php
                                                    }
                                                    ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Work table</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                 if(strpos($get_properties_data['propertyAmenities'], 'Bar Stool') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bar Stool"  id="BarStool" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                 }
                                                 else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Bar Stool"  id="BarStool"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                 }
                                                 ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Bar stool </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Dining Set') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Dining Set"  id="DiningSet" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Dining Set"  id="DiningSet"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Dining set</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Fireplace') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Fireplace"  id="Fireplace" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Fireplace"  id="Fireplace"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Fireplace </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Hardwood Floor') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Hardwood Floor"  id="HardwoodFloor" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Hardwood Floor"  id="HardwoodFloor"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Hardwood floor</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Wardrobe') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Wardrobe"  id="Wardrobe" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Wardrobe"  id="Wardrobe"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Wardrobe </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Washer-Dryer') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Washer-Dryer"  id="WasherDryer" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Washer-Dryer"  id="WasherDryer"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Washer-Dryer</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Washer-Dryer Hookup') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Washer-Dryer Hookup"  id="WasherDryerHookup" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Washer-Dryer Hookup"  id="WasherDryerHookup"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Washer-Dryer Hookup</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Dishwasher') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Dishwasher"  id="Dishwasher" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Dishwasher"  id="Dishwasher"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Dishwasher</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Range Oven') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Range Oven"  id="RangeOven" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Range Oven"  id="RangeOven"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Range oven </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'CCTV') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="CCTV"  id="CCTV" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="CCTV"  id="CCTV"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> CCTV</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], '24-hr Security') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="24-hr Security"  id="HrSecurity" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="24-hr Security"  id="HrSecurity"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> 24-hr security </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Smart Lock') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Smart Lock"  id="SmartLock" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Smart Lock"  id="SmartLock" /> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Smart lock</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Video Doorbell') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Video Doorbell"  id="VideoDoorbell" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Video Doorbell"  id="VideoDoorbell"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Video doorbell </span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Pet Policy') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Pet Policy"  id="PetPolicy" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Pet Policy"  id="PetPolicy"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Pet Policy</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Court') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Court"  id="Court" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Court"  id="Court"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label"> Court</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Garage') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Garage"  id="Garage" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Garage"  id="Garage"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Garage</span> 
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-4 mt-3">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="checkbox-wrapper">
                                            <label>
                                                <?php
                                                if(strpos($get_properties_data['propertyAmenities'], 'Fitness Center') !== false){
                                                    ?>
                                                <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Fitness Center" checked/> 
                                                <span class="checkbox"></span>
                                                <?php
                                                }
                                                else{
                                                    ?>
                                                    <input type="checkbox" name="someAmenities" onclick="amenitiesSideBar()" value="Fitness Center"/> 
                                                    <span class="checkbox"></span>
                                                    <?php
                                                }
                                                ?>
                                            </label>
                                        </div>
                                        <span class="amenity-label">Fitness center </span> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </section>

    <!-- LOCATION SECTION -->
        <section class="section-location mt-5">
            <h2 class="div-titles mt-3">Location</h2>
            <div class="container-inputs my-2 ">

                <p class="p-instruction">Where is your property located?</p>

                <div class="row ">

                <!-- 1st row -->
                    <!-- REGION -->
                    <div class="col-lg-6 col-12 mt-3 pe-lg-2 pe-0">
                        <label for="region" class="locLabel inputsLabel ms-1">Region<span class="text-danger"> *</span></label>
                        <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" value="<?php echo $get_properties_data['propertyRegion'];?>" id="region" placeholder="" minlength="1" maxlength="30" required>
                    </div>

                    <!-- PROVINCE -->
                    <div class="col-lg-6 col-12 mt-3">
                        <label for="province" class="locLabel inputsLabel ms-1">State/Province<span class="text-danger"> *</span></label>
                        <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" value="<?php echo $get_properties_data['propertyProvince'];?>" id="province" placeholder="" minlength="1" maxlength="30" required>
                    </div>

                <!-- 2nd row -->
                    <!-- CITY -->
                    <div class="col-lg-6 col-12 mt-3 pe-lg-2 pe-0">
                        <label for="city" class="locLabel inputsLabel ms-1">City<span class="text-danger"> *</span></label>
                        <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" value="<?php echo $get_properties_data['propertyCity'];?>" id="city" placeholder="" minlength="1" maxlength="30" required>
                    </div>

                    <!-- BRGY -->
                    <div class="col-lg-6 col-12 mt-3">
                        <label for="barangay" class="locLabel inputsLabel ms-1">Brgy., Street<span class="text-danger"> *</span></label>
                        <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" value="<?php echo $get_properties_data['propertyBarangay'];?>" id="barangay" placeholder="" minlength="1" maxlength="100" required>
                    </div>

                    <div class="col-12 mt-3">
                        <label for="houseNum" class="locLabel inputsLabel ms-1">House No./Building No.<span class="text-danger"> *</span></label>
                        <input type="text" oninput="locationTextbox()" class="locInput locationText input-containers mt-2" id="houseNum" value="<?php echo $get_properties_data['house_num'];?>" placeholder="" minlength="1" maxlength="100" required>
                    </div>

                    <!-- Latitude -->
                    <div class="col-lg-6 col-12 mt-3 pe-lg-2 pe-0">
                        <label for="latitude" class="locLabel inputsLabel ms-1">Latitude</label>
                        <input type="text" oninput="locationTextbox()" id="latitude" value="<?php echo $get_properties_data['propertyLatitude'];?>" class="locationText locInput mt-2 latLong" Disabled>
                    </div>

                    <!-- Longitude -->
                    <div class="col-lg-6 col-12 mt-3">
                        <label for="longitude" class="locLabel inputsLabel ms-1">Longitude</label>
                        <input type="text" oninput="locationTextbox()" id="longitude" value="<?php echo $get_properties_data['propertyLongitude'];?>" class="locationText locInput mt-2 latLong" Disabled>
                    </div>

                    <!-- map div -->
                    <div id="locationInputDiv" class="col-12 mt-3">

                    </div> 
                    <!-- nearby places -->
                    <div class="d-none">
                        <input type="text" id="nearbyPlaces" value="<?php echo $get_properties_data['propertyNearby'] ?>">
                    </div>

                </div>
            </div>
        </section>

        <section class="section-contact mt-5">
            <h2 class="div-titles mt-3">Contact Information</h2>
            <div class="container-inputs my-2 ">

                <div class="row">

                    <!-- MOBILE NUMBER -->
                    <div class="col-lg-6 col-12 mt-3 pe-lg-2 pe-0">
                        <label for="mobileNum" class="contactLbl inputsLabel ms-1">Mobile Number<span class="text-danger"> *</span></label><br>
                        <input type="number" id="mobileNum" class="input-containers mt-1 contact-input" placeholder="autofill" value="<?php echo $lgetId['lNumber']; ?>" min="0" max="999999999999" required><br>
                    </div>

                    <!-- EMAIL -->
                    <div class="col-lg-6 col-12 mt-3">
                        <label for="email" class="contactLbl inputsLabel ms-1">Email<span class="text-danger"> *</span></label>
                        <input type="email" id="email" class="input-containers mt-1 contact-input" value="<?php echo $lgetId['lEmail']; ?>" placeholder="landlord@gmail.com" required>
                    </div>
                </div>
            </div>

            <div class="d-none">
                <input type="text" id="txt_id" value="<?php echo $_GET['propId']; ?>">
            </div>
        </section>

        <section class="section-publish mt-5">
            <div class="row">
            <div class="col-md-6 col-12 pe-md-2 pe-0   ">
                    <button  class="propertyListBtn" id="cancelBtn" data-bs-toggle="modal" data-bs-target="#cancelModal">Cancel</button> 
                </div>
                <div class="col-md-6 col-12 ps-md-2 ps-0 mt-md-0 mt-3 ">
                    <button class="propertyListBtn" id="btnPublish" data-bs-toggle="modal" data-bs-target="#SaveProperty">Save Changes</button>
                </div>
            </div>
        </section>
        <?php
        }
        else{
            echo "<script>window.location.href = '../../../RentA/landlordPage/manageProperty.php'</script>";
        }
    }
        ?>




                </div>
                <!-- END OF FORMS COLUMN -->
            </div>
        </div>


    </div>
</body>
</html>
<?php
    }
    else{
        echo "<script>window.location.href = '../../../RentA/landlordPage/starterPage.php'</script>";
    }
    // Close the database connection
mysqli_close($con);
    ?>