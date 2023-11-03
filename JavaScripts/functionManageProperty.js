$(document).ready(function(){

    // $(".btn-mMarkRented").click(function(){
    //     $(".not-rented").hide();
    //     $(".if-rented").show();
    //     $(".btn-mMarkRented").hide();
    //     $(".btn-mMarkAvailable").show();
    // });

    // $(".btn-mMarkAvailable").click(function(){
    //     $(".if-rented").hide();
    //     $(".not-rented").show();
    //     $(".btn-mMarkRented").show();
    //     $(".btn-mMarkAvailable").hide();
    // });
    $('#uploadrenewlease').click(function (){
        $('#uploadrenewLandlordSign').click();
    });
    $('#uploadrenewLandlordSign').change(function(e) {
        //get the user input file
        var imglease = e.target.files[0];
        var renterid = document.getElementById('txtRenter').value;
        var property_id = document.getElementById('txtpropid').value;
        //read the file
        var reader = new FileReader();
        //load the file to display in the canvas function
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
            var canvas = document.getElementById('landlordrenewCanvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
    
            // Capture the image data from the canvas
            var imgleaseform = canvas.toDataURL('image/png'); // Change format if needed
            var leaseformdata = new FormData();
            leaseformdata.append('leaseimgdata', imgleaseform);
            leaseformdata.append('leaserenterid', renterid);
            leaseformdata.append('leasepropertyid', property_id);
    
            $.ajax({
            url: '../Functions/Landlord/uploadrenewlandlordlease.php',
            type: 'POST',
            data: leaseformdata,
            processData: false,
            contentType: false,
            success: function(response) {
                document.getElementById('checkupload').value = "SUCCESS";
                $('.renewback').css('display', 'none');
                $('#landlordrenewCanvas').css('display', 'block');
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
        reader.readAsDataURL(imglease);
        });

    $('#uploadlease').click(function (){
        $('#uploadLandlordSign').click();
    });
    $('#uploadLandlordSign').change(function(e) {
        //get the user input file
        var imglease = e.target.files[0];
        var renterid = document.getElementById('txtRenter').value;
        var property_id = document.getElementById('txtpropid').value;
        //read the file
        var reader = new FileReader();
        //load the file to display in the canvas function
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
            var canvas = document.getElementById('landlordCanvas');
            var ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
    
            // Capture the image data from the canvas
            var imgleaseform = canvas.toDataURL('image/png'); // Change format if needed
            var leaseformdata = new FormData();
            leaseformdata.append('leaseimgdata', imgleaseform);
            leaseformdata.append('leaserenterid', renterid);
            leaseformdata.append('leasepropertyid', property_id);
    
            $.ajax({
            url: '../Functions/Landlord/uploadlandlordlease.php',
            type: 'POST',
            data: leaseformdata,
            processData: false,
            contentType: false,
            success: function(response) {
                $('.back').css('display', 'none');
                $('#landlordCanvas').css('display', 'block');
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
        reader.readAsDataURL(imglease);
        });

        $('#editProfilepic').click(function (){
            $('#newprofile').click();
        });

        $('#newprofile').change(function(e) {
            var imgnewprofile = e.target.files[0];
        
            var reader = new FileReader();
        
            reader.onload = function(event) {
                var imgnewprofileform = event.target.result;
        
                var newprofiledata = new FormData();
                newprofiledata.append('newprofilepic', imgnewprofileform);
        
                $.ajax({
                    url: '../Functions/Landlord/uploadnewprofile.php',
                    type: 'POST',
                    data: newprofiledata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Error uploading profile picture: ' + error);
                    }
                });
            };
            reader.readAsDataURL(imgnewprofile);
        });
            

        $('#editRenterProfile').click(function (){
            $('#renternewprofile').click();
        });

        $('#renternewprofile').change(function(e) {
            var imgnewprofile = e.target.files[0];
        
            var reader = new FileReader();
        
            reader.onload = function(event) {
                var imgnewprofileform = event.target.result;
        
                var newprofiledata = new FormData();
                newprofiledata.append('newprofilepic', imgnewprofileform);
        
                $.ajax({
                    url: '../Functions/Renters/uploadnewprofile.php',
                    type: 'POST',
                    data: newprofiledata,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('Error uploading profile picture: ' + error);
                    }
                });
            };
            reader.readAsDataURL(imgnewprofile);
        });

        if(window.location.href.includes("uploadLease.php")){
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
        }
});

function sendlease(){
    var selectleasetype = document.querySelector('input[name="choice"]:checked');
    var radionoinput = document.getElementById('idUpload');
    var renterid = document.getElementById('txtRenter');
    var property_id = document.getElementById('txtpropid');

    if(!selectleasetype){
        radionoinput.setCustomValidity("please choose one");
        radionoinput.reportValidity();
    }
    else if(selectleasetype.value == "upload"){
        window.location.href = "send2UploadLease.php?renter=" + renterid.value + "&property=" + property_id.value;
    }
    else if(selectleasetype.value == "create"){
        window.location.href = "send3CreateLease.php?renter=" + renterid.value + "&property=" + property_id.value;
    }
}
function formatDate(input) {
    const value = input.value.replace(/\D/g, '');

    if (value.length >= 2) {
        let month = value.slice(0, 2);
        let day = value.slice(2, 4);
        let year = value.slice(4, 8);

        if (month[0] > 1) {
            month = '0' + month[0];
        }
        if (day[0] > 3) {
            day = '0' + day[0];
        }

        // Get the current year
        const currentYear = new Date().getFullYear();

        if (parseInt(year) > currentYear) {
            year = currentYear.toString();
        }

        if (value.length >= 1) {
            month = month;
        }
        if (value.length >= 3) {
            day = '/' + day;
        }
        if (value.length >= 5) {
            year = '/' + year;
        }

        input.value = month + day + year;
    }

    const startDateInput = document.getElementById('startingleasedate');
    const endDateInput = document.getElementById('endleasedate');

    if(startDateInput.value != ""){
        if (startDateInput.value === endDateInput.value) {
            const endDate = new Date(endDateInput.value);
            endDate.setFullYear(endDate.getFullYear() + 1);
            endDateInput.value = formatDateForInput(endDate);
        }
    }
}

function formatDateForInput(date) {
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const day = date.getDate().toString().padStart(2, '0');
    const year = date.getFullYear();
    return `${month}/${day}/${year}`;
}

if(window.location.href.includes("uploadLease.php")){
    const startdateInput = document.getElementById('startingleasedate');
    const enddateInput = document.getElementById('endleasedate');

    startdateInput.addEventListener('input', function () {
        formatDate(startdateInput);
    });

    enddateInput.addEventListener('input', function () {
        formatDate(enddateInput);
    });
}



function Sendleasetorenter(){
    const cbDeposit = document.getElementById('cbDeposit');
    const cbAmount = document.getElementById('cbAmount');
    const cbpenalty = document.getElementById('cbpenalty');
    var renterid = document.getElementById('txtRenter');
    var property_id = document.getElementById('txtpropid');
    var txtDepositValue = document.getElementById('txtdeposit');
    var advanceValue = document.getElementById('btnAdvanceamountvalue');
    var filevalue = document.getElementById('uploadLandlordSign');
    var advanceTextValue = document.getElementById('advanceTextValue');
    var preferredatepayment = document.getElementById('preferredDateValue');
    const startDateInput = document.getElementById('startingleasedate');
    const endDateInput = document.getElementById('endleasedate');

    const startDateValue = startDateInput.value;
    const endDateValue = endDateInput.value;

    const startDate = new Date(startDateValue);
    const endDate = new Date(endDateValue);

    if(startDateValue == "" || endDateValue == ""){
        alert("Please enter date");
    }
    else if (startDate > endDate) {
        alert("Starting date cannot be greater than the ending date.");
    }
    else if (cbDeposit.checked && txtDepositValue.value === "") {
        alert("Please enter the deposit amount.");
    } 
    else if (cbAmount.checked && advanceValue.value === "Please select one") {
        alert('Please select an option from the dropdown menu.');
    } 
    else if(cbpenalty.checked && txtpenalty.value === ""){
        alert("Please enter the penalty amount.");
    }
    else if (!filevalue.files.length) {
        alert("Please upload a file.");
    } 
    else if (!cbDeposit.checked && !cbAmount.checked) {
        alert("Please select at least one option.");
    }  
    else if(preferredatepayment.value == "Please select one"){
        alert("Please select at least one option.");
    }  
    else{
        if (cbDeposit.checked) {
            var depositAmount = txtDepositValue.value;
        }
        else{
            var depositAmount = 0;
        }
        if(cbAmount.checked){
            var depositcontent = advanceTextValue.textContent
            var advancedepositamount = depositcontent.replace(/,/g, '');
            var advancedepositperiod = advanceValue.value;
        }
        else{
            var advancedepositperiod = "NULL";
            var advancedepositamount = 0;
        }
        if(cbpenalty.checked){
            var penaltyAmount = txtpenalty.value;
        }
        else{
            var penaltyAmount = 0;
        }
        http = new XMLHttpRequest();
            
            http.onreadystatechange = function() {
                
                if (http.readyState == 4 && http.status == 200) {
                    window.location.href = "manageLeases.php";
                }
            };
            
            http.open("GET", "../Functions/Landlord/sendlease.php?q=" 
            + renterid.value + "~~>" //0
            + property_id.value + "~~>" //1
            + depositAmount + "~~>" //2
            + advancedepositamount + "~~>" //3
            + advancedepositperiod + "~~>" //4
            + startDateValue + "~~>" //5
            + endDateValue + "~~>" //6
            + preferredatepayment.value + "~~>" //7
            + penaltyAmount, true); //8
            http.send(); 
    }
}

function savedate(btnValue){
    const buttonId = btnValue.id;
    const buttonValue = btnValue.getAttribute("value");
    
    var txtdate = document.getElementById('txtdate'+buttonValue+buttonId);
    
    if(txtdate.value != ""){
        http = new XMLHttpRequest();
            
        http.onreadystatechange = function() {
            if (http.readyState == 4 && http.status == 200) {
                $.ajax({
                    url: "../Functions/Landlord/sendemailsetdate.php",
                    method:"POST",
                    data:{
                        receiver: buttonId
                    },
                    dataType:"text"
                });
                location.reload();
            }
        };
        http.open("GET", "../Functions/Landlord/savedatemove.php?q=" + txtdate.value + "~~>" + buttonValue + "~~>" + buttonId, true); 
        http.send(); 
    }
    else{
        location.reload();
    }
 }

 function editdate(editvalue){
    const buttonId = editvalue.id;
    var divset = document.getElementById('set'+buttonId);
    var divnotset = document.getElementById('not_set'+buttonId);
    divset.classList.remove("d-none");
    divnotset.classList.add("d-none");
 }

 if (window.location.href.includes("uploadLease.php")) {
    const advanceMenu = document.querySelector(".advanceMenu"),
        buttonAdvance = advanceMenu.querySelector(".btn-advance"),
        advance_button = advanceMenu.querySelectorAll(".advance-option"),
        optionAdvance = advanceMenu.querySelector(".advanceValue");


        advance_button.forEach(advanceOption => {
                advanceOption.addEventListener("click", () => {
            
                let selectedadvanceOption = advanceOption.querySelector(".dropdownAdvance").innerText;
                optionAdvance.innerText = selectedadvanceOption;
                buttonAdvance.value = selectedadvanceOption;
                const advanceTextValue = document.getElementById('advanceTextValue');
                var txtAmount = document.getElementById('txtAmountAdvance').value;

                if(selectedadvanceOption == "1 month advance"){
                    advanceTextValue.textContent = parseInt(txtAmount).toLocaleString();
                }
                else if(selectedadvanceOption == "2 months advance"){
                    var amount = txtAmount.toLocaleString() * 2;
                    advanceTextValue.textContent = parseInt(amount).toLocaleString();
                }
                else if(selectedadvanceOption == "3 months advance"){
                    var amount = txtAmount.toLocaleString() * 3;
                    advanceTextValue.textContent = parseInt(amount).toLocaleString();
                }
            });
            });
        }

        




        function setformatDate(input) {
            const value = input.value.replace(/\D/g, '');
        
            if (value.length >= 2) {
                let month = value.slice(0, 2);
                let day = value.slice(2, 4);
                let year = value.slice(4, 8);
        
                if (month[0] > 1) {
                    month = '0' + month[0];
                }
                if (day[0] > 3) {
                    day = '0' + day[0];
                }
        
                // Get the current year
                const currentYear = new Date().getFullYear();
        
                if (parseInt(year) > currentYear) {
                    year = currentYear.toString();
                }
        
                if (value.length >= 1) {
                    month = month;
                }
                if (value.length >= 3) {
                    day = '/' + day;
                }
                if (value.length >= 5) {
                    year = '/' + year;
                }
        
                input.value = month + day + year;
            }
        }

        if (window.location.href.includes("manageResidents.php")) {
            const startdateInputs = document.getElementsByClassName('txtbox-date');
          
            for (let i = 0; i < startdateInputs.length; i++) {
              startdateInputs[i].addEventListener('input', function () {
                setformatDate(startdateInputs[i]);
              });
            }
          }