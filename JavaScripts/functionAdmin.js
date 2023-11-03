$(document).ready(function(){
    //sidebar
    $(".sidebar-btn").click(function(){
        if ($(".admin-sidebar").hasClass("active")) {
            $(".admin-sidebar").removeClass("active");
        } else {
            $(".admin-sidebar").addClass("active");
        }
    });    

    deleteType();
    getverifyid();
    getBlockedId();
    getrejectedid();
    getapprovepropertyid();
    getdisapprovedpropertyid();
    getdeletepropertyid();
    getrenterblockedid();
});

function addType() {
    var userinput = document.getElementById('input-prop-type');

    if (userinput.value == "") {
        userinput.setCustomValidity("Please enter property type!");
        userinput.reportValidity();
    } else {
        var http = new XMLHttpRequest();

        http.onreadystatechange = function () {
            if (http.readyState == 4 && http.status == 200) {
                var reqVal = http.responseText;
                if (reqVal.toLowerCase() == userinput.value.toLowerCase()) { // Use toLowerCase() here
                    userinput.setCustomValidity("'" + userinput.value + "' is already exist!");
                    userinput.reportValidity();
                } else {
                    userinput.setCustomValidity("");
                    location.reload();
                }
            }
        };

        http.open("GET", "../Functions/Admin/insertType.php?q=" + userinput.value, true);
        http.send();
    }
}

function deleteType() {
    var btndelete = document.getElementsByClassName("btnTypeDeleteId");
    var deleteId = document.getElementById("deleteId");

    for (var i = 0; i < btndelete.length; i++) {
        btndelete[i].addEventListener("click", function() {
            deleteId.value = this.id;
        });
    }
}

function confirmDelete() {
    var deleteId = document.getElementById("deleteId");
    var http = new XMLHttpRequest();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            location.reload();
        }
    };

    http.open("GET", "../Functions/Admin/deleteType.php?q=" + deleteId.value, true);
    http.send();
}

function getverifyid(){
    var btnverify = document.getElementsByClassName("btnverifyId");
    var verifyId = document.getElementById("verifyId");

    for (var i = 0; i < btnverify.length; i++) {
        btnverify[i].addEventListener("click", function() {
            verifyId.value = this.id;
        });
    }
}

function confirmverifylandlord(){
    var user_id = document.getElementById('verifyId');
    var http = new XMLHttpRequest();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            $.ajax({
                url: "../Functions/Admin/sendverificationcomplete.php",
                method:"POST",
                data:{
                    receiver: user_id.value
                },
                dataType:"text"
            });
            location.reload();
        }
    };

    http.open("GET", "../Functions/Admin/userverified.php?q=" + user_id.value, true);
    http.send();
}

function getBlockedId(){
    var btnblocked = document.getElementsByClassName("getblockedid");
    var blockedId = document.getElementById("blockedId");

    for (var i = 0; i < btnblocked.length; i++) {
        btnblocked[i].addEventListener("click", function() {
            blockedId.value = this.id;
        });
    }
}

function confirmblocked(){
    var user_id = document.getElementById('blockedId');
    var txt_blocked_reason = document.getElementById('txtReasonblocked');
    var http = new XMLHttpRequest();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            $.ajax({
                url: "../Functions/Admin/sendlandlordblocked.php",
                method:"POST",
                data:{
                    receiver: user_id.value,
                    reason: txt_blocked_reason.value
                },
                dataType:"text"
            });
            location.reload();
        }
    };

    http.open("GET", "../Functions/Admin/landlordblocked.php?q=" + user_id.value + "~~>" + encodeURIComponent(txt_blocked_reason.value), true);
    http.send();
}

function getrejectedid(){
    var btnrejected = document.getElementsByClassName("btnrejected");
    var rejectedId = document.getElementById("verifyId");

    for (var i = 0; i < btnrejected.length; i++) {
        btnrejected[i].addEventListener("click", function() {
            rejectedId.value = this.id;
        });
    }
}

function confirmreject(){
    var user_id = document.getElementById('verifyId');
    var txt_reject_reason = document.getElementById('txtReasonverifying');
    var http = new XMLHttpRequest();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            $.ajax({
                url: "../Functions/Admin/sendaccountrejected.php",
                method:"POST",
                data:{
                    receiver: user_id.value,
                    reason: txt_reject_reason.value
                },
                dataType:"text"
            });
            location.reload();
        }
    };

    http.open("GET", "../Functions/Admin/userrejected.php?q=" + user_id.value + "~~>" + txt_reject_reason.value, true);
    http.send();
}

function getapprovepropertyid(){
    var btnprop = document.getElementsByClassName("propertyIdvalue");
    var propId = document.getElementById("propertyidvalue");

    for (var i = 0; i < btnprop.length; i++) {
        btnprop[i].addEventListener("click", function() {
            propId.value = this.id;
        });
    }
}

function approveProperty(){
    var prop_id = document.getElementById('propertyidvalue');
    var http = new XMLHttpRequest();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            $.ajax({
                url: "../Functions/Admin/sendacceptedproperty.php",
                method:"POST",
                data:{
                    propertyId: prop_id.value
                },
                dataType:"text"
            });
            location.reload();
        }
    };

    http.open("GET", "../Functions/Admin/propertyaccepted.php?q=" + prop_id.value, true);
    http.send();
}

function getdisapprovedpropertyid(){
    var btnprop = document.getElementsByClassName("propertydisapproveIdvalue");
    var propId = document.getElementById("propertyidvalue");

    for (var i = 0; i < btnprop.length; i++) {
        btnprop[i].addEventListener("click", function() {
            propId.value = this.id;
        });
    }
}

function disapprovedProperty(){
    var prop_id = document.getElementById('propertyidvalue');
    var http = new XMLHttpRequest();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            $.ajax({
                url: "../Functions/Admin/sendrejectedproperty.php",
                method:"POST",
                data:{
                    propertyId: prop_id.value
                },
                dataType:"text"
            });
            location.reload();
        }
    };

    http.open("GET", "../Functions/Admin/propertyrejected.php?q=" + prop_id.value, true);
    http.send();
}

function getdeletepropertyid(){
    var btnprop = document.getElementsByClassName("deletepropertyid");
    var propId = document.getElementById("propertyidtodelete");

    for (var i = 0; i < btnprop.length; i++) {
        btnprop[i].addEventListener("click", function() {
            propId.value = this.id;
        });
    }
}

function forcedeleteProperty(){
    var prop_id = document.getElementById('propertyidtodelete');
    var http = new XMLHttpRequest();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            var resultvalue = http.responseText;
            var arrayresult = resultvalue.split("~>");
            var landlordid = arrayresult[0];
            var propertyName = arrayresult[1];
            $.ajax({
                url: "../Functions/Admin/sendforceddeleteproperty.php",
                method:"POST",
                data:{
                    landlordid: landlordid,
                    propertyname: propertyName
                },
                dataType:"text"
            });
            location.reload();
        }
    };

    http.open("GET", "../Functions/Admin/propertyforceddelete.php?q=" + prop_id.value, true);
    http.send();
}

function getrenterblockedid(){
    var btnrenter = document.getElementsByClassName("blockedid");
    var renterId = document.getElementById("txtrenterid");

    for (var i = 0; i < btnrenter.length; i++) {
        btnrenter[i].addEventListener("click", function() {
            renterId.value = this.id;
        });
    }
}

function confirmblockedrenter(){
    var renter_id = document.getElementById('txtrenterid');
    var txt_blocked_reason = document.getElementById('txtReason');
    var http = new XMLHttpRequest();

    http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200) {
            $.ajax({
                url: "../Functions/Admin/sendblockedrenter.php",
                method:"POST",
                data:{
                    renterId: renter_id.value,
                    reason: txt_blocked_reason.value
                },
                dataType:"text"
            });
            location.reload();
        }
    };

    http.open("GET", "../Functions/Admin/renterblocked.php?q=" + renter_id.value + "~~>" + txt_blocked_reason.value, true);
    http.send();
}

function notificationwindow(){
    window.location.href = "adminNotifications.php";
}



function removeNotification(notifid) {
    $.ajax({
        url: "../Functions/Admin/deleteNotif.php",
        method: "POST",
        data: {
            notifid: notifid
        },
        dataType: "text",
        success: function (data) {
            $("#divNotifBody").html(data);
        }
    });
}
