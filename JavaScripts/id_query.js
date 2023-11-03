$(document).ready(function(){
  //////////////////// initialization ///////////////////
  //front
  var frontFileName = document.getElementById('frontfileName');

  //back
  var backFileName = document.getElementById('backFileName');

  //////////////////// for choosing file type upload/capture image ///////////////////
  $('.btn1').click(function() {
      var choice = document.getElementsByName("choice");
      var landlordaction = document.getElementById("txtLandlordAction");
    
      var choiceSelected = null;
      for (choices of choice) {
        if (choices.checked) {
          choiceSelected = choices.value;
          break;
        }
      }
    
      if (choiceSelected === "upload") {
          if(landlordaction.value == "listproperty"){
            window.location.href = "uploadId.php?action=listproperty";
          }
          else if(landlordaction.value == "resending"){
            window.location.href = "uploadId.php?action=resending";
          }
          else{
            window.location.href = "uploadId.php";
          }
      }
      else if(choiceSelected === "camera"){
        if(landlordaction.value == "listproperty"){
          window.location.href = "captureIdFront.php?action=listproperty";
        }
        else if(landlordaction.value == "resending"){
          window.location.href = "captureIdFront.php?action=resending";
        }
        else{
          window.location.href = "captureIdFront.php";
        }
      } 
      else {
        alert("Please select a choice.");
      }
  });

  //////////////////// uploading front id picture ///////////////////

  //back to choose upload or capture id
  $("#btn_ReturnChoice").click(function (){
    window.history.back();
  });

  //to automatically click the <input type="file">
  $('#btn_frontupload').click(function(){
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
            url: '../../Functions/Landlord/uploadfrontIdVerification.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              frontFileName.innerText = response;
              $('.front').css('display', 'none');
              $('#frontfileName').css('display', 'block');
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
          //display block canvas because by default it hidden
          $('#backCanvas').css('display', 'block');
    
          // Capture the image data from the canvas
          var backImgData = canvas.toDataURL('image/png'); // Change format if needed
          var backformData = new FormData();
          backformData.append('backImgData', backImgData);
          backformData.append('imgName', imgName);
    
          $.ajax({
            url: '../../Functions/Landlord/uploadbackIdVerification.php',
            type: 'POST',
            data: backformData,
            processData: false,
            contentType: false,
            success: function(response) {
              backFileName.innerText = response;
              $('.back').css('display', 'none');
              $('#backFileName').css('display', 'block');
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

  //////////////////// start the camera if this div is loaded ///////////////////

  //if the link "captureIdFront.php" is included in the link this function will run
  if (window.location.href.includes("captureIdFront.php")) {
    // This code will run when the entire window, including all elements, is loaded
    $(window).on('load', function() {
      var frontPicture;
      const frontWebcamElement = document.getElementById('frontwebcam');
      const frontCanvasElement = document.getElementById('frontcanvas');
      const frontwebcam = new Webcam(frontWebcamElement , 'user', frontCanvasElement);
      //start the front id camera if fully loaded
      frontwebcam.start();

      //////////////////// capturing id's front ///////////////////

      //back to choose upload or capture id
      $("#btn_btnReturnChoose").click(function (){
        window.history.back();
      });
      
      //capture front id function and result preview
      $("#btn_captureFrontid").click(function (){
        frontPicture = frontwebcam.snap();
        $('#imgFrontId').addClass("d-none");
        $('#imgFrontIdResult').removeClass("d-none");
      });

      //retake front id
      $("#btn_retakeFront").click(function (){
        $('#imgFrontId').removeClass("d-none");
        $('#imgFrontIdResult').addClass("d-none");
      });

      //submit front id
      $("#btn_confirmFrontId").click(function (){
        var landlordaction = document.getElementById('txtLandlordAction');
        var imageData = frontPicture.split(',')[1];
        // Create a FormData object
        var formData = new FormData();
                
        // Append the image data to the FormData object
        formData.append('frontCapturedData', imageData);
        
        // Send the FormData object to the server using AJAX
        $.ajax({
            url: '../../Functions/Landlord/captureFrontidFunction.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              if(landlordaction.value == "listproperty"){
                window.location.href = "captureIdBack.php?action=listproperty";
              }
              else if(landlordaction.value == "resending"){
                window.location.href = "captureIdBack.php?action=resending";
              }
              else{
                window.location.href = "captureIdBack.php";
              }
            },
            error: function(xhr, status, error) {
            // Handle the error
                alert('Error saving image: ' + error);
            }
        });
      });
    });
  }
  //if the link "captureIdBack.php" is included in the link this function will run
  else if (window.location.href.includes("captureIdBack.php")) {
    // This code will run when the entire window, including all elements, is loaded
    $(window).on('load', function() {
      //start the back id camera if fully loaded
      var backPicture;
      const backWebcamElement = document.getElementById('backwebcam');
      const backCanvasElement = document.getElementById('backcanvas');
      const backwebcam = new Webcam(backWebcamElement , 'user', backCanvasElement);
      backwebcam.start();

      //////////////////// capturing id's back ///////////////////

      //back to capture front
      $("#btn_btnReturnFront").click(function (){
        window.history.back();
      });
      //capture front id function and result preview
      $("#btn_captureBackid").click(function (){
        backPicture = backwebcam.snap();
        $('#imgBackId').addClass("d-none");
        $('#imgBackIdResult').removeClass("d-none");
      });

      //retake front id
      $("#btn_retakeBack").click(function (){
        $('#imgBackId').removeClass("d-none");
        $('#imgBackIdResult').addClass("d-none");
      });

      //submit front id
      $("#btn_confirmBackId").click(function (){
        var landlordaction = document.getElementById('txtLandlordAction');
        var imageData = backPicture.split(',')[1];
        // Create a FormData object
        var formData = new FormData();
                
        // Append the image data to the FormData object
        formData.append('backImgData', imageData);
        
        // Send the FormData object to the server using AJAX
        $.ajax({
            url: '../../Functions/Landlord/captureBackidFunction.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              if(landlordaction.value == "listproperty"){
                window.location.href = "idMatching.php?action=listproperty";
              }
              else if(landlordaction.value == "resending"){
                window.location.href = "idMatching.php?action=resending";
              }
              else{
                window.location.href = "idMatching.php";
              }
            },
            error: function(xhr, status, error) {
            // Handle the error
                alert('Error saving image: ' + error);
            }
        });
      });
    });
  }
  //if the link "idMatching.php" is included in the link this function will run
  else if (window.location.href.includes("idMatching.php")) {
    // This code will run when the entire window, including all elements, is loaded
    $(window).on('load', function() {
      //start the match id camera if fully loaded
      var matchPicture;
      const matchWebcamElement = document.getElementById('matchwebcam');
      const matchCanvasElement = document.getElementById('matchcanvas');
      const matchwebcam = new Webcam(matchWebcamElement , 'user', matchCanvasElement);
      matchwebcam.start();

      //////////////////// capturing id's match ///////////////////

      //match to capture front
      $("#btn_ReturnBack").click(function (){
        window.history.back();
      });
      //capture front id function and result preview
      $("#btn_capturematchid").click(function (){
        matchPicture = matchwebcam.snap();
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
        var landlordaction = document.getElementById('txtLandlordAction');
        var imageData = matchPicture.split(',')[1];
        // Create a FormData object
        var formData = new FormData();
                
        // Append the image data to the FormData object
        formData.append('matchImgData', imageData);
        
        // Send the FormData object to the server using AJAX
        $.ajax({
            url: '../../Functions/Landlord/capturematchidFunction.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
              if(landlordaction.value == "listproperty"){
                window.location.href = "verificationFinished.php?action=listproperty";
              }
              else if(landlordaction.value == "resending"){
                window.location.href = "verificationFinished.php?action=resending";
              }
              else{
                window.location.href = "verificationFinished.php";
              }
            },
            error: function(xhr, status, error) {
            // Handle the error
                alert('Error saving image: ' + error);
            }
        });
      });
    });
  }
  //in upload image after uploading image
  $('#btn_NextMatching').click(function(){
    var imgFront = document.getElementById('frontuploadFile').value;
    var imgBack = document.getElementById('uploadFileback').value;
    var landlordAction = document.getElementById('txtLandlordAction').value;

    if(imgFront === '' || imgBack === ''){
      alert("please upload img first");
    }
    else{
      if(landlordAction == "listproperty"){
        window.location.href = "idMatching.php?action=listproperty&#1";
      }
      else if(landlordAction == "resending"){
        window.location.href = "idMatching.php?action=resending";
      }
      else{
        window.location.href = "idMatching.php#1";
      }
    }
  });
  //after verifying the id's
  $('#btn_finish').click(function(){
    var landlordaction = document.getElementById('txtLandlordAction');
    if(landlordaction.value == "listproperty"){
      window.location.href = "../backupPhrase.php?action=listproperty";
    }
    else if(landlordaction.value == "resending"){
      window.location.href = "../landlordProfile.php";
    }
    else{
      window.location.href = "../backupPhrase.php";
    }
  });
});