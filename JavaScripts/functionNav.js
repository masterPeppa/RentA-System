    // function blurFunction(){
    //     var up = document.getElementById("chevron-up-manage");
    //     var down = document.getElementById("chevron-down-manage");
    //     var upAvatar = document.getElementById("chevron-up-avatar");
    //     var downAvatar = document.getElementById("chevron-down-avatar");
    //     var upAvatar2 = document.getElementById("chevron-up-avatar2");
    //     var downAvatar2 = document.getElementById("chevron-down-avatar2");

    //     up.style.display = "none";
    //     down.style.display = "inline-block";

    //     upAvatar.style.display = "none";
    //     downAvatar.style.display = "inline-block";

    //     upAvatar2.style.display = "none";
    //     downAvatar2.style.display = "inline-block";
    // }

// }

    // function blurFunction(){
    //     var up = document.getElementById("chevron-up-manage");
    //     var down = document.getElementById("chevron-down-manage");
    //     var upAvatar = document.getElementById("chevron-up-avatar");
    //     var downAvatar = document.getElementById("chevron-down-avatar");
    //     var upAvatar2 = document.getElementById("chevron-up-avatar2");
    //     var downAvatar2 = document.getElementById("chevron-down-avatar2");

    //     up.style.display = "none";
    //     down.style.display = "inline-block";

    //     upAvatar.style.display = "none";
    //     downAvatar.style.display = "inline-block";

    //     upAvatar2.style.display = "none";
    //     downAvatar2.style.display = "inline-block";
    // }

    function dropdownManageFunction(){
                
        var up = document.getElementById("chevron-up-manage");
        var down = document.getElementById("chevron-down-manage");

        if (up.style.display == "none")  {
            up.style.display = "inline-block";
            down.style.display = "none";
        }

        else if (up.style.display == "inline-block")  {
            up.style.display = "none";
            down.style.display = "inline-block";
        }

        else {
            up.style.display = "inline-block";
            down.style.display = "none";
        }
    }

    function dropdownAvatarFunction(){
                
        var up = document.getElementById("chevron-up-avatar");
        var down = document.getElementById("chevron-down-avatar");

        if (up.style.display == "none")  {
            up.style.display = "inline-block";
            down.style.display = "none";
        }

        else if (up.style.display == "inline-block")  {
            up.style.display = "none";
            down.style.display = "inline-block";
        }

        else {
            up.style.display = "inline-block";
            down.style.display = "none";
        }
    }

    function dropdownAvatarFunction2(){
        
        var up = document.getElementById("chevron-up-avatar2");
        var down = document.getElementById("chevron-down-avatar2");

        if (up.style.display == "none")  {
            up.style.display = "inline-block";
            down.style.display = "none";
        }

        else if (up.style.display == "inline-block")  {
            up.style.display = "none";
            down.style.display = "inline-block";
        }

        else {
            up.style.display = "inline-block";
            down.style.display = "none";
        }
    }

    function dropdownAvatarGuestFunction(){
        
        var up = document.getElementById("chevron-up-avatar-guest");
        var down = document.getElementById("chevron-down-avatar-guest");

        if (up.style.display == "none")  {
            up.style.display = "inline-block";
            down.style.display = "none";
        }

        else if (up.style.display == "inline-block")  {
            up.style.display = "none";
            down.style.display = "inline-block";
        }

        else {
            up.style.display = "inline-block";
            down.style.display = "none";
        }
    }


    function clickHeartFunction(){
        var heart_filled = document.getElementById("heartFilled");
        var heart_unfilled = document.getElementById("heartUnfilled");
        
        if (heart_filled.style.display == "none")  {
            heart_filled.style.display = "block";
            heart_unfilled.style.display = "none";
        }

        else if (heart_filled.style.display == "block")  {
            heart_filled.style.display = "none";
            heart_unfilled.style.display = "block";
        }

        else {
            heart_unfilled.style.display = "block";
            heart_filled.style.display = "none";
        }
    }

    function ddTypeFunction(){
        
        var upType = document.getElementById("upType");
        var downType = document.getElementById("downType");

        if (upType.style.display == "none")  {
            upType.style.display = "inline-block";
            downType.style.display = "none";
        }

        else if (upType.style.display == "inline-block")  {
            upType.style.display = "none";
            downType.style.display = "inline-block";
        }

        else {
            upType.style.display = "inline-block";
            downType.style.display = "none";
        }
    }

    function ddBedFunction(){
        
        var upBed = document.getElementById("upBed");
        var downBed = document.getElementById("downBed");

        if (upBed.style.display == "none")  {
            upBed.style.display = "inline-block";
            downBed.style.display = "none";
        }

        else if (upBed.style.display == "inline-block")  {
            upBed.style.display = "none";
            downBed.style.display = "inline-block";
        }

        else {
            upBed.style.display = "inline-block";
            downBed.style.display = "none";
        }
    }

    function ddBathFunction(){
        
        var upBath = document.getElementById("upBath");
        var downBath = document.getElementById("downBath");

        if (upBath.style.display == "none")  {
            upBath.style.display = "inline-block";
            downBath.style.display = "none";
        }

        else if (upBath.style.display == "inline-block")  {
            upBath.style.display = "none";
            downBath.style.display = "inline-block";
        }

        else {
            upBath.style.display = "inline-block";
            downBath.style.display = "none";
        }
    }

    function ddFloorFunction(){
        
        var upFloor = document.getElementById("upFloor");
        var downFloor = document.getElementById("downFloor");

        if (upFloor.style.display == "none")  {
            upFloor.style.display = "inline-block";
            downFloor.style.display = "none";
        }

        else if (upFloor.style.display == "inline-block")  {
            upFloor.style.display = "none";
            downFloor.style.display = "inline-block";
        }

        else {
            upFloor.style.display = "inline-block";
            downFloor.style.display = "none";
        }
    }

    function ddAmenityFunction(){
        
        var upAmenity = document.getElementById("upAmenity");
        var downAmenity = document.getElementById("downAmenity");
        var showAmenities = document.getElementById("ddAmenityMenu");

        if (upAmenity.style.display == "none")  {
            upAmenity.style.display = "inline-block";
            downAmenity.style.display = "none";
            showAmenities.style.display = "block";
        }

        else if (upAmenity.style.display == "inline-block")  {
            upAmenity.style.display = "none";
            downAmenity.style.display = "inline-block";
        }

        else {
            upAmenity.style.display = "inline-block";
            downAmenity.style.display = "none";
        }
    }

    // FOR MODAL FILTERS DROPDOWN ARROWS
    function ddsmTypeFunction(){
        
        var upTypeSm = document.getElementById("upTypeSm");
        var downTypeSm = document.getElementById("downTypeSm");

        if (upTypeSm.style.display == "none")  {
            upTypeSm.style.display = "inline-block";
            downTypeSm.style.display = "none";
        }

        else if (upTypeSm.style.display == "inline-block")  {
            upTypeSm.style.display = "none";
            downTypeSm.style.display = "inline-block";
        }

        else {
            upTypeSm.style.display = "inline-block";
            downTypeSm.style.display = "none";
        }
    }

    function ddsmBedFunction(){
        
        var upBedSm = document.getElementById("upBedSm");
        var downBedSm = document.getElementById("downBedSm");

        if (upBedSm.style.display == "none")  {
            upBedSm.style.display = "inline-block";
            downBedSm.style.display = "none";
        }

        else if (upBedSm.style.display == "inline-block")  {
            upBedSm.style.display = "none";
            downBedSm.style.display = "inline-block";
        }

        else {
            upBedSm.style.display = "inline-block";
            downBedSm.style.display = "none";
        }
    }

    function ddsmBathFunction(){
        
        var upBathSm = document.getElementById("upBathSm");
        var downBathSm = document.getElementById("downBathSm");

        if (upBathSm.style.display == "none")  {
            upBathSm.style.display = "inline-block";
            downBathSm.style.display = "none";
        }

        else if (upBathSm.style.display == "inline-block")  {
            upBathSm.style.display = "none";
            downBathSm.style.display = "inline-block";
        }

        else {
            upBathSm.style.display = "inline-block";
            downBathSm.style.display = "none";
        }
    }

    function ddsmFloorFunction(){
        
        var upFloorSm = document.getElementById("upFloorSm");
        var downFloorSm = document.getElementById("downFloorSm");

        if (upFloorSm.style.display == "none")  {
            upFloorSm.style.display = "inline-block";
            downFloorSm.style.display = "none";
        }

        else if (upFloorSm.style.display == "inline-block")  {
            upFloorSm.style.display = "none";
            downFloorSm.style.display = "inline-block";
        }

        else {
            upFloorSm.style.display = "inline-block";
            downFloorSm.style.display = "none";
        }
    }

    function ddsmAmenityFunction(){
        
        var upAmenitySm = document.getElementById("upAmenitySm");
        var downAmenitySm = document.getElementById("downAmenitySm");

        if (upAmenitySm.style.display == "none")  {
            upAmenitySm.style.display = "inline-block";
            downAmenitySm.style.display = "none";
        }

        else if (upAmenitySm.style.display == "inline-block")  {
            upAmenitySm.style.display = "none";
            downAmenitySm.style.display = "inline-block";
        }

        else {
            upAmenitySm.style.display = "inline-block";
            downAmenitySm.style.display = "none";
        }
    }

    function ddAmenityMenuFunction(){
        
        // var ddAmenityMenu = document.getElementById("upAmenitySm");
        // var amenityMenuShown = document.getElementById("downAmenitySm");

        // if (upAmenitySm.style.display == "none")  {
        //     upAmenitySm.style.display = "inline-block";
        //     downAmenitySm.style.display = "none";
        // }

        // else if (upAmenitySm.style.display == "inline-block")  {
        //     upAmenitySm.style.display = "none";
        //     downAmenitySm.style.display = "inline-block";
        // }

        // else {
        //     upAmenitySm.style.display = "inline-block";
        //     downAmenitySm.style.display = "none";
        // }
    }

    // function blurFunction(){
    //     var up = document.getElementById("chevron-up-manage");
    //     var down = document.getElementById("chevron-down-manage");
    //     var upAvatar = document.getElementById("chevron-up-avatar");
    //     var downAvatar = document.getElementById("chevron-down-avatar");
    //     var upAvatar2 = document.getElementById("chevron-up-avatar2");
    //     var downAvatar2 = document.getElementById("chevron-down-avatar2");

    //     up.style.display = "none";
    //     down.style.display = "inline-block";

    //     upAvatar.style.display = "none";
    //     downAvatar.style.display = "inline-block";

    //     upAvatar2.style.display = "none";
    //     downAvatar2.style.display = "inline-block";
    // }

// }
    
    // function blurFunction(){
    //     var up = document.getElementById("chevron-up-manage");
    //     var down = document.getElementById("chevron-down-manage");
    //     var upAvatar = document.getElementById("chevron-up-avatar");
    //     var downAvatar = document.getElementById("chevron-down-avatar");
    //     var upAvatar2 = document.getElementById("chevron-up-avatar2");
    //     var downAvatar2 = document.getElementById("chevron-down-avatar2");

    //     up.style.display = "none";
    //     down.style.display = "inline-block";

    //     upAvatar.style.display = "none";
    //     downAvatar.style.display = "inline-block";

    //     upAvatar2.style.display = "none";
    //     downAvatar2.style.display = "inline-block";
    // }

    function dropdownManageFunction(){
                
        var up = document.getElementById("chevron-up-manage");
        var down = document.getElementById("chevron-down-manage");

        if (up.style.display == "none")  {
            up.style.display = "inline-block";
            down.style.display = "none";
        }

        else if (up.style.display == "inline-block")  {
            up.style.display = "none";
            down.style.display = "inline-block";
        }

        else {
            up.style.display = "inline-block";
            down.style.display = "none";
        }
    }

    function dropdownAvatarFunction(){
                
        var up = document.getElementById("chevron-up-avatar");
        var down = document.getElementById("chevron-down-avatar");

        if (up.style.display == "none")  {
            up.style.display = "inline-block";
            down.style.display = "none";
        }

        else if (up.style.display == "inline-block")  {
            up.style.display = "none";
            down.style.display = "inline-block";
        }

        else {
            up.style.display = "inline-block";
            down.style.display = "none";
        }
    }

    function dropdownAvatarFunction2(){
        
        var up = document.getElementById("chevron-up-avatar2");
        var down = document.getElementById("chevron-down-avatar2");

        if (up.style.display == "none")  {
            up.style.display = "inline-block";
            down.style.display = "none";
        }

        else if (up.style.display == "inline-block")  {
            up.style.display = "none";
            down.style.display = "inline-block";
        }

        else {
            up.style.display = "inline-block";
            down.style.display = "none";
        }
    }

    function clickHeartFunction(){
        var heart_filled = document.getElementById("heartFilled");
        var heart_unfilled = document.getElementById("heartUnfilled");
        
        if (heart_filled.style.display == "none")  {
            heart_filled.style.display = "block";
            heart_unfilled.style.display = "none";
        }

        else if (heart_filled.style.display == "block")  {
            heart_filled.style.display = "none";
            heart_unfilled.style.display = "block";
        }

        else {
            heart_unfilled.style.display = "block";
            heart_filled.style.display = "none";
        }
    }
    

    function favoriteData(saveId, savedId){

        // to check if the class exist
        function hasClass(element, className) {
            return element.classList.contains(className);
        }
        var save = document.getElementById(saveId);
        var saved = document.getElementById(savedId);
        var userEmail = document.getElementById("txtEmail");
        const modal = new bootstrap.Modal(document.getElementById('modal_loginAs'));
    
        if (userEmail.value == "") {
            modal.show();
        }
        else if (hasClass(saved, "d-none"))  {
            save.classList.remove("d-block");
            save.classList.add("d-none");
            saved.classList.add("d-block");
            saved.classList.remove("d-none");
            http = new XMLHttpRequest();
            http.open("GET", "Functions/savingFavoriteProperty.php?q=" + save.value, true); 
            http.send(); 
        }
        else if(hasClass(save, "d-none")){
            save.classList.remove("d-none");
            save.classList.add("d-block");
            saved.classList.remove("d-block");
            saved.classList.add("d-none");
            http = new XMLHttpRequest();
            http.open("GET", "Functions/savingFavoriteProperty.php?q=" + saved.value + "&v=" + save.value, true); 
            http.send(); 
        }
    }    

    function saveFunction(){
        
        // to check if the class exist
        function hasClass(element, className) {
            return element.classList.contains(className);
        }
        var save = document.getElementById("btnSave");
        var saved = document.getElementById("btnSaved");
        var Navsave = document.getElementById("btnNavSave");
        var Navsaved = document.getElementById("btnNavSaved");
        var userEmail = document.getElementById("txtEmail");
        const modal = new bootstrap.Modal(document.getElementById('modal_loginAs'));
    
        if (userEmail.value == "null") {
            modal.show();
        }
        else if (hasClass(saved, "d-none"))  {
            //save button
            save.classList.remove("d-block");
            save.classList.add("d-none");
            saved.classList.add("d-block");
            saved.classList.remove("d-none");
            //navbar
            Navsave.classList.remove("d-block");
            Navsave.classList.add("d-none");
            Navsaved.classList.add("d-block");
            Navsaved.classList.remove("d-none");

            http = new XMLHttpRequest();
            http.open("GET", "Functions/savingFavoriteProperty.php?q=" + save.value, true); 
            http.send(); 
        }
        else if(hasClass(save, "d-none")){
            //save button
            save.classList.remove("d-none");
            save.classList.add("d-block");
            saved.classList.remove("d-block");
            saved.classList.add("d-none");
            //navbar
            Navsave.classList.remove("d-none");
            Navsave.classList.add("d-block");
            Navsaved.classList.add("d-none");
            Navsaved.classList.remove("d-block");

            http = new XMLHttpRequest();
            http.open("GET", "Functions/savingFavoriteProperty.php?q=" + saved.value + "&v=" + save.value, true); 
            http.send(); 
        }
    }
$(document).ready(function (){
    $('.aRenter').click(function(){
        window.location.href = "RentersPage/starterPage.php";
    });
    $('.aLandlord').click(function(){
        window.location.href = "landlordPage/starterPage.php";
    });
});

function messageButton(){
    var userValue = document.getElementById('textUser');
    var startingMessage = document.getElementById('startMessage').value;
    const modal = new bootstrap.Modal(document.getElementById('modal_loginAs'));
    var userEmail = document.getElementById("txtEmail");
    var landlordId = document.getElementById('messagingButton').value;
    
    if (userEmail.value == "null") {
        modal.show();
    }
    else if (userValue.value !== "null") {
        http = new XMLHttpRequest();
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                window.location.href = "messages.php?landlordId=" + landlordId;
            }
        };
        http.open("GET", "Functions/sendingDataFunction.php?q=" + startingMessage + "~~" + "messagedata", true); 
        http.send(); 
    }

}

function applyButton(){
    var userValue = document.getElementById('textUser');
    var userEmail = document.getElementById("txtEmail");
    var propertyid = document.getElementById('property_id').value;
    
    if (userEmail.value == "null") {
        window.location.href = "RentersPage/starterPage.php?property="+propertyid;
    }
    else if (userValue.value !== "") {
        window.location.href = "RentersPage/application1Submit.php?property=" + propertyid;
    }
}




    
function Prev() {
    http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                 window.history.back();
            }
        };
        http.open("GET", "../Functions/Landlord/CancelSavingProperty.php", true); 
        http.send(); 
  }
  
function sendingSearchValue(){
  var txtSearchValue = document.getElementById('searchbar').value;

  http = new XMLHttpRequest();
  http.onreadystatechange = function() {
    
    if (http.readyState == 4 && http.status == 200) {
        window.location.href = "Functions/filterFunction.php";
    }
};
http.open("GET", "Functions/sendingDataFunction.php?q=" + txtSearchValue + "~~" + "searchdata", true); 
http.send(); 
}

function GobackPage(){
    window.history.back();
}

function GorentalsPage(){
    window.location.href = "rentals.php";
}

function movedin(){
    var renterid = document.getElementById('txtUserId');
    var propertyId = document.getElementById('propertyId');
    var landlordId = document.getElementById('idlandlord');
    http = new XMLHttpRequest();
        
    http.onreadystatechange = function() {
            
        if (http.readyState == 4 && http.status == 200) {
            window.location.href="application5Feedback.php";
        }
    };
    http.open("GET", "../Functions/Renters/moveinfunction.php?q=" + renterid.value + "~~>" + propertyId.value + "~~>" + landlordId.value, true); 
    http.send(); 
}

$(document).on('keyup', '.rVrificationCode', function(event) {
    if (event.keyCode === 13) {
        $('#btn_verify').click();
    }
});

//check if the landlord is verified or not
function checklistProperty() {
    const modal = new bootstrap.Modal(document.getElementById('cantListModal'));
    $.ajax({
        url: 'Functions/Landlord/cantList.php',
        type: 'POST',
        success: function (response) {
            if (response === "done") {
                window.location.href = "landlordPage/listAProperty.php";
            } else {
                modal.show();
            }
        },
        error: function (xhr, status, error) {
            alert('An error occurred while processing your request. Please try again later.');
        }
    });
}

function checklistProperty1() {
    const modal = new bootstrap.Modal(document.getElementById('cantListModal'));
    $.ajax({
        url: '../Functions/Landlord/cantList.php',
        type: 'POST',
        success: function (response) {
            if (response === "done") {
                window.location.href = "listAProperty.php";
            } else {
                modal.show();
            }
        },
        error: function (xhr, status, error) {
            alert('An error occurred while processing your request. Please try again later.');
        }
    });
}

function checklistProperty2() {
    const modal = new bootstrap.Modal(document.getElementById('cantListModal'));
    $.ajax({
        url: '../../Functions/Landlord/cantList.php',
        type: 'POST',
        success: function (response) {
            if (response === "done") {
                window.location.href = "../listAProperty.php";
            } else {
                modal.show();
            }
        },
        error: function (xhr, status, error) {
            alert('An error occurred while processing your request. Please try again later.');
        }
    });
}

function refreshPage(){
    location.reload();
}


function requestNewReceipt() {
    var txtrenterNewReq = document.getElementById('txtreqnew');
    $.ajax({
        url: "../Functions/Landlord/requestnewpayment.php",
        method: "POST",
        data: {
            userid: $("#txtUserId").val(),
            renterId: txtrenterNewReq.value
        },
        dataType: "text",
        success: function (data) {
            if(data == "success"){
                location.reload();
            }
        }
    });
}

function attachClickEventToAnchors() {
    var anchors = document.querySelectorAll("a.renterId");

    anchors.forEach(function (anchor) {
        anchor.addEventListener("mouseenter", function (event) {
            var buttonValue = this.getAttribute("data-value");
            document.getElementById('txtreqnew').value = buttonValue;
        });
    });
}

if (window.location.href.includes("manageAdvancePayments.php")) {
    attachClickEventToAnchors();
    
    window.onload = function () {
        attachClickEventToAnchors();
    };
}

function removenotiffunction(notifId) {
    $.ajax({
        url: "../Functions/Renters/removenotiffunction.php",
        method: "POST",
        data: {
            notifid: notifId
        },
        dataType: "text",
        success: function (data) {
            $("#notifBody").html(data);
        }
    });
}

function lremovenotiffunction(notifId){
    $.ajax({
        url: "../Functions/Landlord/removenotiffunction.php",
        method: "POST",
        data: {
            notifid: notifId
        },
        dataType: "text",
        success: function (data) {
            $("#notifBody").html(data);
        }
    });
}

function approvedmonthlypayment(){
    var paymentrecordid= document.getElementById('paymentId');
    
    http = new XMLHttpRequest();
        
    http.onreadystatechange = function() {
            
        if (http.readyState == 4 && http.status == 200) {
            window.history.back();
        }
    };
    http.open("GET", "../Functions/Landlord/acceptedPaymentRecord.php?q=" + paymentrecordid.value, true); 
    http.send(); 
}

function reqnewMonthlyPayment(){
    var txtReasonValue = document.getElementById('txtReason');
    var paymentrecordid= document.getElementById('paymentId');

    http = new XMLHttpRequest();
        
    http.onreadystatechange = function() {
            
        if (http.readyState == 4 && http.status == 200) {
            window.history.back();
        }
    };
    http.open("GET", "../Functions/Landlord/reqnewmonthlypayment.php?q=" + paymentrecordid.value + "~~>" +
    txtReasonValue.value, true); 
    http.send(); 
}