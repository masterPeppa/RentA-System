
$(document).ready(function(){
    var frontFileName = document.getElementById('frontfileName');
    var backFileName = document.getElementById('backFileName');
    var txtimgfront = document.getElementById('imgFronttext');
    var txtimgback = document.getElementById('imgBacktext');
    var txtimgmatch = document.getElementById('imgmatchtext');
    var docuFileName = document.getElementById('docufileName');
    var txtimgdocu = document.getElementById('imgDocuText');
    
    $('#btnUploadreceipt').click(function(){
        $('#receiptFile').click();
    });
    //if te user uploaded a file this function will be triggered
    $('#receiptFile').change(function(e) {
        var paymentId = document.getElementById('peymentId').value;
        //get the user input file
        var receiptImageData = e.target.files[0];
        //read the file
        var reader = new FileReader();
        //load the file to display in the canvas function
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
            var canvas = document.getElementById('receiptCanvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            //display block canvas because by default it hidden
            $('#receiptCanvas').css('display', 'block');
      
            // Capture the image data from the canvas
            var receiptImgData = canvas.toDataURL('image/png'); // Change format if needed
            var receiptformData = new FormData();
            receiptformData.append('receiptImgData', receiptImgData);
            receiptformData.append('paymentId', paymentId);
      
            $.ajax({
              url: '../Functions/Renters/uploadreceiptmonthlypayment.php',
              type: 'POST',
              data: receiptformData,
              processData: false,
              contentType: false,
              success: function(response) {
                document.getElementById('txtCheckImage').value = "Notnull";
                $('.receipt').css('display', 'none');
              },
              error: function(xhr, status, error) {
                alert('Error saving image: ' + error);
              }
            });
        };
        //image result
        img.src = event.target.result;
    };
    //read the image and display
    reader.readAsDataURL(receiptImageData);
    });

    //upload deposit payment receipt
    $('#btndeposit').click(function(){
        $('#depositFile').click();
    });
    //if te user uploaded a file this function will be triggered
    $('#depositFile').change(function(e) {
        //get the user input file
        var depositImageData = e.target.files[0];
        //read the file
        var reader = new FileReader();
        //load the file to display in the canvas function
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
            var canvas = document.getElementById('depositCanvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            //display block canvas because by default it hidden
            $('#depositCanvas').css('display', 'block');
      
            // Capture the image data from the canvas
            var depositImgData = canvas.toDataURL('image/png'); // Change format if needed
            var depositformData = new FormData();
            depositformData.append('depositImgData', depositImgData);
      
            $.ajax({
              url: '../Functions/Renters/uploaddepositIdVerification.php',
              type: 'POST',
              data: depositformData,
              processData: false,
              contentType: false,
              success: function(response) {
                $('.deposit').css('display', 'none');
              },
              error: function(xhr, status, error) {
                alert('Error saving image: ' + error);
              }
            });
        };
        //image result
        img.src = event.target.result;
    };
    //read the image and display
    reader.readAsDataURL(depositImageData);
    });

    //upload advance payment receipt
    $('#btnadvance').click(function(){
        $('#advanceFile').click();
    });
    //if te user uploaded a file this function will be triggered
    $('#advanceFile').change(function(e) {
        //get the user input file
        var advanceImageData = e.target.files[0];
        //read the file
        var reader = new FileReader();
        //load the file to display in the canvas function
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
            var canvas = document.getElementById('advanceCanvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            //display block canvas because by default it hidden
            $('#advanceCanvas').css('display', 'block');
      
            // Capture the image data from the canvas
            var advanceImgData = canvas.toDataURL('image/png'); // Change format if needed
            var advanceformData = new FormData();
            advanceformData.append('advanceImgData', advanceImgData);
      
            $.ajax({
              url: '../Functions/Renters/uploadadvanceIdVerification.php',
              type: 'POST',
              data: advanceformData,
              processData: false,
              contentType: false,
              success: function(response) {
                $('.advanceHide').css('display', 'none');
              },
              error: function(xhr, status, error) {
                alert('Error saving image: ' + error);
              }
            });
        };
        //image result
        img.src = event.target.result;
    };
    //read the image and display
    reader.readAsDataURL(advanceImageData);
    });

    //to automatically click the <input type="file">
    $('#uploadFilefront').click(function(){
        $('#frontuploadFile').click();
    });
    //if the user uploaded a file this function will be triggered
    $('#frontuploadFile').change(function(e) {
        //get the user input file
        var imageData = e.target.files[0];
        var imgName = imageData.name;
        //read the file
        var reader = new FileReader();
        //load the file to display in the canvas function
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
            var canvas = document.getElementById('frontcanvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            //display block canvas because by default it hidden
            $('#frontcanvas').css('display', 'block');
    
            // Capture the image data from the canvas
            var imgData = canvas.toDataURL('image/png'); // Change format if needed
            var formData = new FormData();
            formData.append('frontCapturedData', imgData);
            formData.append('imgName', imgName);
    
            $.ajax({
            url: '../Functions/Renters/uploadfrontIdVerification.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                frontFileName.innerText = response;
                $('.front').css('display', 'none');
                $('#frontfileName').css('display', 'block');
                txtimgfront.value = "notEmpty";
            },
            error: function(xhr, status, error) {
                alert('Error saving image: ' + error);
            }
            });
        };
        //image result
        img.src = event.target.result;
        };
        //read the image and display
        reader.readAsDataURL(imageData);
    });

    //////////////////// uploading back id picture ///////////////////
  $('#btn_backUpload').click(function(){
    $('#uploadFileback').click();
    });
    //if te user uploaded a file this function will be triggered
    $('#uploadFileback').change(function(e) {
        //get the user input file
        var backImageData = e.target.files[0];
        var imgName = backImageData.name;
        //read the file
        var reader = new FileReader();
        //load the file to display in the canvas function
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
            var canvas = document.getElementById('backCanvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
    
            // Capture the image data from the canvas
            var backImgData = canvas.toDataURL('image/png'); // Change format if needed
            var backformData = new FormData();
            backformData.append('backImgData', backImgData);
            backformData.append('imgName', imgName);
    
            $.ajax({
            url: '../Functions/Renters/uploadbackIdVerification.php',
            type: 'POST',
            data: backformData,
            processData: false,
            contentType: false,
            success: function(response) {
                backFileName.innerText = response;
                $('.back').css('display', 'none');
                $('#backFileName').css('display', 'block');
                $('#backCanvas').css('display', 'block');
                txtimgback.value = "notEmpty";
            },
            error: function(xhr, status, error) {
                alert('Error saving image: ' + error);
            }
            });
        };
        //image result
        img.src = event.target.result;
        };
        //read the image and display
        reader.readAsDataURL(backImageData);
        });

        

      //to automatically click the <input type="file">
    $('#uploadFiledocu').click(function(){
        $('#docuuploadFile').click();
    });
    //if the user uploaded a file this function will be triggered
    $('#docuuploadFile').change(function(e) {
        //get the user input file
        var imageData = e.target.files[0];
        var imgName = imageData.name;
        //read the file
        var reader = new FileReader();
        //load the file to display in the canvas function
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
            var canvas = document.getElementById('docucanvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            //display block canvas because by default it hidden
            $('#docucanvas').css('display', 'block');
    
            // Capture the image data from the canvas
            var imgData = canvas.toDataURL('image/png'); // Change format if needed
            var formData = new FormData();
            formData.append('docuCapturedData', imgData);
            formData.append('imgName', imgName);
    
            $.ajax({
            url: '../Functions/Renters/uploaddocuIdVerification.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                docuFileName.innerText = response;
                $('.docu').css('display', 'none');
                $('#docufileName').css('display', 'block');
                txtimgdocu.value = "notEmpty";
            },
            error: function(xhr, status, error) {
                alert('Error saving image: ' + error);
            }
            });
        };
        //image result
        img.src = event.target.result;
        };
        //read the image and display
        reader.readAsDataURL(imageData);
    });

//////////////////////////////////////////////////////////////////////////////////////
        
         //if the link "captureIdFront.php" is included in the link this function will run
  if (window.location.href.includes("application1Submit.php")) {
      var matchPicture;
      const matchWebcamElement = document.getElementById('idmatchwebcam');
      const matchCanvasElement = document.getElementById('idmatchcanvas');
      const matchWebcam = new Webcam(matchWebcamElement , 'user', matchCanvasElement);
      //start the front id camera if fully loaded
      matchWebcam.start();

      //capture front id function and result preview
      $("#btn_capturematchid").click(function (){
        matchPicture = matchWebcam.snap();
        $('#imgmatchId').addClass("d-none");
        $('#imgmatchIdResult').removeClass("d-none");
      });

      //retake front id
      $("#btn_retakematch").click(function (){
        $('#imgmatchId').removeClass("d-none");
        $('#imgmatchIdResult').addClass("d-none");
      });

      //submit front id
      $("#btn_confirmmatchId").click(function (){
        var imageData = matchPicture.split(',')[1];
        // Create a FormData object
        var formData = new FormData();
                
        // Append the image data to the FormData object
        formData.append('matchCapturedData', imageData);
        
        // Send the FormData object to the server using AJAX
        $.ajax({
            url: '../Functions/Renters/matchid.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $("#btn_retakematch").addClass("d-none");
                $("#btn_confirmmatchId").addClass("d-none");
                txtimgmatch.value = "notEmpty";
            },
            error: function(xhr, status, error) {
            // Handle the error
                alert('Error saving image: ' + error);
            }
        });
      });

      var preferredDateValue = document.getElementById('preferredDateValue');
      const preferredDateMenu = document.querySelector(".preferred-date-menu"),
            preferredDatedata = preferredDateMenu.querySelector(".preferred-date-data"),
            preferredOption = preferredDateMenu.querySelectorAll(".advance-option"),
            preferreddatespanvalue = preferredDateMenu.querySelector(".preferreddatespanvalue");
      
      
            preferredOption.forEach(preferredselectoption => {
                preferredselectoption.addEventListener("click", () => {
                
                let selectedpreferreddate = preferredselectoption.querySelector(".dropdownNth").innerText;
                preferreddatespanvalue.innerText = selectedpreferreddate;
                preferredDateValue.value = selectedpreferreddate;
              });
            });
   
// current dropdown for year of residence
var currentResidenceValue = document.getElementById('currentResidenceValue');
const currentResidenceMenu = document.querySelector(".current-residence-menu"),
      currentbuttonResidence = currentResidenceMenu.querySelector(".current-btnresidency"),
      currentoptionResidence = currentResidenceMenu.querySelectorAll(".current-residence-option"),
      currentTextResidence = currentResidenceMenu.querySelector(".current-btn-txt-residence");


      currentoptionResidence.forEach(currentresidenceOption => {
        currentresidenceOption.addEventListener("click", () => {
          
          let selectedFloorOption = currentresidenceOption.querySelector(".current-opt-type-text").innerText;
          currentTextResidence.innerText = selectedFloorOption;
          currentResidenceValue.value = selectedFloorOption;
        });
      });

    // past dropdown for year of residence
    var pastResidenceValue = document.getElementById('pastResidenceValue');
    const pastResidenceMenu = document.querySelector(".past-residence-menu"),
        pastbuttonResidence = pastResidenceMenu.querySelector(".past-btnresidency"),
        pastoptionResidence = pastResidenceMenu.querySelectorAll(".past-residence-option"),
        pastTextResidence = pastResidenceMenu.querySelector(".past-btn-txt-residence");


        pastoptionResidence.forEach(pastresidenceOption => {
            pastresidenceOption.addEventListener("click", () => {
            
            let selectedFloorOption = pastresidenceOption.querySelector(".past-opt-type-text").innerText;
            pastTextResidence.innerText = selectedFloorOption;
            pastResidenceValue.value = selectedFloorOption;
            });
        });
  }
});

function validation(){
    var renter_firstname = document.getElementById("rFName");
    var renter_lastname = document.getElementById("rLName");
    var renter_email = document.getElementById("rEmail");
    var renter_number = document.getElementById("rNum");
    var renter_birthday = document.getElementById("rBday");
    var renter_occupation = document.getElementById("rOccupation");
    var renter_Occupants = document.getElementById("rOccupants");
    var preferredDateValues = document.getElementById("preferredDateValue");
    var renter_address = document.getElementById("rAddress");
    var renter_landlordname = document.getElementById('rcurLandlordName');
    var renter_landlordnumber = document.getElementById('rcurLandlordNum');
    var renter_reason = document.getElementById('rcurReason');
    var past_renter_landlordname = document.getElementById('rLandlordName');
    var past_renter_landlordnumber = document.getElementById('rLandlordNum');
    var past_renter_reason = document.getElementById('rReason');
    var past_renter_address = document.getElementById('pastrAddress');
    var txtimgfront = document.getElementById('imgFronttext');
    var txtimgback = document.getElementById('imgBacktext');
    var txtimgdocu = document.getElementById('imgDocuText');
    var txtimgmatch = document.getElementById('imgmatchtext');
    var txtLandlordid = document.getElementById('txtLandlordid'); 
    var txtRenterId = document.getElementById('txtRenterid');
    var txtPropertyid = document.getElementById('txtPropertyId');
    var past_recidency = document.getElementById('past_recidency');
    var currentResidenceValue = document.getElementById('currentResidenceValue');
    var pastResidenceValue = document.getElementById('pastResidenceValue');

    //radio
    var select_recidency = document.querySelector('input[name="rad-residency"]:checked');
    var select_past_recidency = document.querySelector('input[name="rad-residency2"]:checked');
    var select_evicted = document.querySelector('input[name="rad-evicted"]:checked');
    var select_broken = document.querySelector('input[name="rad-broken"]:checked');
    var radio_residency = document.getElementById("rad-rent");
    var radio_evict = document.getElementById("rad-yes");
    var radio_broken = document.getElementById("rad-bYes");

    const modal = new bootstrap.Modal(document.getElementById('submitdoneModal'));

    var datePattern= /^\d{2}\/\d{2}\/\d{4}$/;

    var isValid = true;
    
    if(renter_occupation.value === ""){
        renter_occupation.setCustomValidity("Please enter your occupation.");
        renter_occupation.reportValidity();
        isValid = false;
    }
    
    if(renter_Occupants.value === ""){
        renter_Occupants.setCustomValidity("Please enter the total number of occupants.");
        renter_Occupants.reportValidity();
        isValid = false;
    }
    
    if(renter_address.value === ""){
        renter_address.setCustomValidity("Please enter your current address.");
        renter_address.reportValidity();
        isValid = false;
    }

    if(currentResidenceValue.value == "Please select one"){
        currentResidenceValue.setCustomValidity("Please select one!");
        currentResidenceValue.reportValidity();
        isValid = false;
    }

    if(preferredDateValues.value == "Please select one"){
        preferredDateValues.setCustomValidity("Please select one!");
        preferredDateValues.reportValidity();
        isValid = false;
    }

    if(pastResidenceValue.value == "Please select one"){
        pastResidenceValue.value = "N/A";
    }

    if (!select_recidency) {
        radio_residency.setCustomValidity("Please choose one");
        radio_residency.reportValidity();
        isValid = false;
    }
    if (!select_evicted) {
        radio_evict.setCustomValidity("Please choose one");
        radio_evict.reportValidity();
        isValid = false;
    }
    if (!select_broken) {
        radio_broken.setCustomValidity("Please choose one");
        radio_broken.reportValidity();
        isValid = false;
    }
    if (!select_past_recidency) {
        past_recidency.value = "N/A";
    }
    else{
        past_recidency.value = select_past_recidency.value;
    }
    if(select_recidency.value == "Rent"){
        
        if(renter_landlordname.value === ""){
            renter_landlordname.setCustomValidity("Please enter the your current landlord name.");
            renter_landlordname.reportValidity();
            isValid = false;
        }
        else if(renter_landlordnumber.value === ""){
            renter_landlordnumber.value = "N/A";
        }
    }
    if(renter_reason.value === ""){
        renter_reason.value = "N/A";
    }
    if(past_renter_landlordname.value === ""){
        past_renter_landlordname.value = "N/A";
    }
    if(past_renter_landlordnumber.value === ""){
        past_renter_landlordnumber.value = "N/A";
    }
    if(past_renter_reason.value === ""){
        past_renter_reason.value = "N/A";
    }

    if(txtimgfront.value != "notEmpty"){
        alert("Please upload front id");
        isValid = false;
    }
    if(txtimgback.value != "notEmpty"){
        alert("Please upload back id");
        isValid = false;
    }
    if(txtimgdocu.value != "notEmpty"){
        alert("Please upload back id");
        isValid = false;
    }
    if(txtimgmatch.value != "notEmpty"){
        alert("Please submit image to confirm your identity");
        isValid = false;
    }
    if(past_renter_address.value == ""){
        past_renter_address.value = "N/A"
    }
    if(renter_landlordnumber.value == ""){
        renter_landlordnumber.value = "N/A"
    }
    if(renter_landlordname.value == ""){
        renter_landlordname.value = "N/A"
    }
    if(isValid){
        http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                modal.show();
                $.ajax({
                    url: "../Functions/Renters/sendemailapplication.php",
                    method:"POST",
                    data:{
                        receiver: $("#txtLandlordid").val()
                    },
                    dataType:"text"
                });
            }
        };
        http.open("GET", "../Functions/Renters/savingApplicationData.php?q=" 
        +  txtLandlordid.value + "~~>" //0
        + renter_firstname.value + "~~>" //1
        + renter_lastname.value+ "~~>" //2
        + renter_email.value + "~~>" //3
        + renter_number.value + "~~>" //4
        + renter_birthday.value + "~~>" //5
        + renter_occupation.value+ "~~>" //6
        + renter_Occupants.value + "~~>" //7
        + renter_address.value + "~~>"  //8
        + renter_landlordname.value+ "~~>" //9
        + renter_landlordnumber.value + "~~>" //10
        + renter_reason.value + "~~>" //11
        + past_renter_landlordname.value + "~~>" //12
        + past_renter_landlordnumber.value + "~~>" //13
        + past_renter_reason.value + "~~>" //14
        + select_recidency.value + "~~>" //15
        + select_evicted.value + "~~>" //16
        + select_broken.value + "~~>" //17
        + past_renter_address.value + "~~>" //18
        + past_recidency.value + "~~>" //19
        + txtRenterId.value + "~~>" //20
        + txtPropertyid.value + "~~>" //21
        + currentResidenceValue.value + "~~>" //22
        + pastResidenceValue.value + "~~>" //23
        + preferredDateValue.value, true); //24
        http.send(); 
    }
}

function Ok(){
    window.location.href = "application2Approval.php";
}

function radiorecidence(){
    var select_recidency = document.querySelector('input[name="rad-residency"]:checked');
    var landlordname = document.getElementById('divlandlordname');
    var landlordnumber = document.getElementById('divlandlordnumber');
    
    if(select_recidency.value == "Rent"){
        landlordname.classList.remove("d-none");
        landlordnumber.classList.remove("d-none");
    }
    else if(select_recidency.value == "Own"){
        landlordname.classList.add("d-none");
        landlordnumber.classList.add("d-none");
    }
}

function pastradiorecidence(){
    var select_recidency = document.querySelector('input[name="rad-residency2"]:checked');
    var landlordname = document.getElementById('pastdivlandlordname');
    var landlordnumber = document.getElementById('pastdivlandlordnumber');
    
    if(select_recidency.value == "Rent"){
        landlordname.classList.remove("d-none");
        landlordnumber.classList.remove("d-none");
    }
    else if(select_recidency.value == "Own"){
        landlordname.classList.add("d-none");
        landlordnumber.classList.add("d-none");
    }
}

function rejectApplication(){
    txtProperty = document.getElementById('txtPropertyId');
    txtRenter = document.getElementById('txtrenterId');
    txtLandlord = document.getElementById('txtLandlordid');
    txtReason = document.getElementById('txtReason');

    if(txtReason.value == ""){
        txtReason.value = "Perhaps there was no reason; maybe you didn't provide the information the landlord was looking for.";
    }

    http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                $.ajax({
                    url: "../Functions/Landlord/sendemailapplication.php",
                    method:"POST",
                    data:{
                        receiver: $("#txtrenterId").val()
                    },
                    dataType:"text"
                });
                window.location.href = "manageApplicants.php";
            }
        };
        http.open("GET", "../Functions/Landlord/rejectedApplication.php?q=" + txtProperty.value + "~~>" + txtRenter.value
         + "~~>" + txtLandlord.value + "~~>" + txtReason.value, true); 
        http.send(); 
}

function acceptApplication(){
    txtProperty = document.getElementById('txtPropertyId');
    txtRenter = document.getElementById('txtrenterId');
    txtLandlord = document.getElementById('txtLandlordid');

    http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                $.ajax({
                    url: "../Functions/Landlord/sendemailapplication.php",
                    method:"POST",
                    data:{
                        receiver: $("#txtrenterId").val()
                    },
                    dataType:"text"
                });
                window.location.href = "manageLeases.php";
            }
        };
        http.open("GET", "../Functions/Landlord/acceptedApplication.php?q=" + txtProperty.value + "~~>" + txtRenter.value
         + "~~>" + txtLandlord.value + "~~>" + txtReason.value, true); 
        http.send(); 
}

function cancelApplication(){
    http = new XMLHttpRequest();
        
    http.onreadystatechange = function() {
            
        if (http.readyState == 4 && http.status == 200) {
            window.history.back();
        }
    };
    http.open("GET", "../Functions/Renters/cancelApplication.php", true); 
    http.send(); 
}

function submitsign(){
    var renterid = document.getElementById('txtUserId');
    var propertyId = document.getElementById('propertyId');
    var landlordId = document.getElementById('idlandlord');
    var depositFile = document.getElementById('depositFile');
    var advanceFile = document.getElementById('advanceFile');

    http = new XMLHttpRequest();
    
    if (depositFile && depositFile.files.length === 0) {
        $('#submitLeaseModal').modal('hide');
        alert("Please ensure you've uploaded the deposit receipt.");
    } 
    else if (advanceFile && advanceFile.files.length === 0) {
        $('#submitLeaseModal').modal('hide');
        alert("Please make sure you've uploaded the receipt for advance payment.");
    }
    else{
        http.onreadystatechange = function() {
                
            if (http.readyState == 4 && http.status == 200) {
                $.ajax({
                    url: "../Functions/Renters/sendemailsigned.php",
                    method:"POST",
                    data:{
                        receiver: $("#idlandlord").val()
                    },
                    dataType:"text"
                });
                window.location.href="application4Move.php";
            }
        };
        http.open("GET", "../Functions/Renters/saveReceipt.php?q=" + renterid.value + "~~>" + propertyId.value + "~~>" + landlordId.value, true); 
        http.send(); 
    }
}

function cancelApply(){
    var renterid = document.getElementById('txtUserId');
    var propertyId = document.getElementById('propertyId');
    var landlordId = document.getElementById('idlandlord');
    http = new XMLHttpRequest();
        
    http.onreadystatechange = function() {
            
        if (http.readyState == 4 && http.status == 200) {
            window.location.href="application1Submit.php";
        }
    };
    http.open("GET", "../Functions/Renters/cancelApply.php?q=" + renterid.value + "~~>" + propertyId.value + "~~>" + landlordId.value, true); 
    http.send(); 
}

function submitMonthlyPayment(){
    var paymentId = document.getElementById('peymentId').value;
    var txtPaymentAmount = document.getElementById('txtPaymentAmount');
    var topaidValue = document.getElementById('txtMinimumValue');
    var paymentvalue = document.getElementById('txtPaymentAmount');
    var imageValue = document.getElementById('txtCheckImage');

    if(txtPaymentAmount.value == ""){
        txtPaymentAmount.setCustomValidity("Please enter the desired payment amount.");
        txtPaymentAmount.reportValidity();
    }
    else if(topaidValue.value > paymentvalue.value){
        txtPaymentAmount.setCustomValidity("Please enter atleast "+topaidValue.value+".");
        txtPaymentAmount.reportValidity();
    }
    else if(imageValue.value == ""){
        alert("Please upload receipt!");
    }
    else{
        txtPaymentAmount.setCustomValidity("");

        http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
                
            if (http.readyState == 4 && http.status == 200) {
                window.history.back();
            }
        };
        http.open("GET", "../Functions/Renters/sendPaymenttolandlord.php?q=" + paymentId + "~~>" + txtPaymentAmount.value, true); 
        http.send(); 
    }
}