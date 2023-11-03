


function savelivingroom() {
    var uploadImgLivingRoom = document.getElementById("uploadImgLivingRoom");
    var uploadImgLivingRoom1 = document.getElementById("uploadImgLivingRoom1");
    var uploadImgLivingRoom2 = document.getElementById("uploadImgLivingRoom2");
    var canvas = document.getElementById("imgCanvaslivingroom");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgLivingRoom2.files.length != 0 && $('#imgCanvas000').hasClass('d-block')) {
      file = uploadImgLivingRoom2.files[0];
      count++;
    }
  
    if (uploadImgLivingRoom1.files.length != 0 && $('#imgCanvas00').hasClass('d-block')) {
      file = uploadImgLivingRoom1.files[0];
      count++;
    }
  
    if (uploadImgLivingRoom.files.length != 0 && $('#imgCanvas0').hasClass('d-block')) {
      file = uploadImgLivingRoom.files[0];
      count++;
    }

    if($('#imgCanvas0').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas00').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas000').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages0').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages00').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages000').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addLivingRoom').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvaslivingroom').removeClass("d-none").addClass("d-block");
      $('#image_iconlivingroom').removeClass("d-block").addClass("d-none");
      $('#existinglivingroom').removeClass("d-block").addClass("d-none");
    }
    else if(exist >= 3){
      if(uploadImgLivingRoom.files.length != 0){
        file = uploadImgLivingRoom.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addLivingRoom').modal('hide');
        $('#imgCanvaslivingroom').removeClass("d-none").addClass("d-block");
        $('#image_iconlivingroom').removeClass("d-block").addClass("d-none");
        $('#existinglivingroom').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addLivingRoom').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  //dining room
  function cancelsavingdiningroom() {
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Diningroom"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon1').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas1').removeClass("d-block").addClass("d-none");
          $('#existingImages1').removeClass("d-block").addClass("d-none");
  
          $('#uploadIcon1_1').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas1_1').removeClass("d-block").addClass("d-none");
          $('#existingImages1_1').removeClass("d-block").addClass("d-none");
  
          $('#uploadIcon1_1_1').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas1_1_1').removeClass("d-block").addClass("d-none");
          $('#existingImages1_1_1').removeClass("d-block").addClass("d-none");
  
          $('#image_icondiningroom').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasdiningroom').removeClass("d-block").addClass("d-none");
  
          $('#existingdiningroom').removeClass("d-block").addClass("d-none");

          $('.imgUpload1').val('');
          $('.imgUpload1_1').val('');
          $('.imgUpload1_1_1').val('');
        }
      });
    }
  }
  
  
  function savediningroom() {
    var uploadImgDiningRoom = document.getElementById("uploadImgDiningroom");
    var uploadImgDiningRoom1 = document.getElementById("uploadImgDiningroom1");
    var uploadImgDiningRoom2 = document.getElementById("uploadImgDiningroom2");
    var canvas = document.getElementById("imgCanvasdiningroom");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgDiningRoom2.files.length != 0 && $('#imgCanvas1_1_1').hasClass('d-block')) {
      file = uploadImgDiningRoom2.files[0];
      count++;
    }
  
    if (uploadImgDiningRoom1.files.length != 0 && $('#imgCanvas1_1').hasClass('d-block')) {
      file = uploadImgDiningRoom1.files[0];
      count++;
    }
  
    if (uploadImgDiningRoom.files.length != 0 && $('#imgCanvas1').hasClass('d-block')) {
      file = uploadImgDiningRoom.files[0];
      count++;
    }

    if($('#imgCanvas1').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas1_1').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas1_1_1').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages1').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages1_1').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages1_1_1').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#adddiningRoom').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasdiningroom').removeClass("d-none").addClass("d-block");
      $('#image_icondiningroom').removeClass("d-block").addClass("d-none");
      $('#existingdiningroom').removeClass("d-block").addClass("d-none");
    }
    else if(exist >= 3){
      if(uploadImgDiningRoom.files.length != 0){
        file = uploadImgDiningRoom.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#adddiningRoom').modal('hide');
        $('#imgCanvasdiningroom').removeClass("d-none").addClass("d-block");
        $('#image_icondiningroom').removeClass("d-block").addClass("d-none");
        $('#existingdiningroom').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#adddiningRoom').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingBedroom() {
    if($('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Bedroom"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon2').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas2').removeClass("d-block").addClass("d-none");
          $('#existingImages2').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon2_2').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas2_2').removeClass("d-block").addClass("d-none");
          $('#existingImages2_2').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon2_2_2').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas2_2_2').removeClass("d-block").addClass("d-none");
          $('#existingImages2_2_2').removeClass("d-block").addClass("d-none");
    
          $('#image_iconBedroom').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasBedroom').removeClass("d-block").addClass("d-none");
          
          $('#existingbedroom').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload2').val('');
          $('.imgUpload2_2').val('');
          $('.imgUpload2_2_2').val('');
        }
      });
    }
  }
  //bedroom
  function saveBedroom() {
    var uploadImgBedRoom = document.getElementById("uploadImgBedrooms");
    var uploadImgBedRoom1 = document.getElementById("uploadImgBedrooms1");
    var uploadImgBedRoom2 = document.getElementById("uploadImgBedrooms2");
    var canvas = document.getElementById("imgCanvasbedroom");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgBedRoom2.files.length != 0 && $('#imgCanvas2_2_2').hasClass('d-block')) {
      file = uploadImgBedRoom2.files[0];
      count++;
    }
  
    if (uploadImgBedRoom1.files.length != 0 && $('#imgCanvas2_2').hasClass('d-block')) {
      file = uploadImgBedRoom1.files[0];
      count++;
    }
  
    if (uploadImgBedRoom.files.length != 0 && $('#imgCanvas2').hasClass('d-block')) {
      file = uploadImgBedRoom.files[0];
      count++;
    }

    if($('#imgCanvas2').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas2_2').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas2_2_2').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages2').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages2_2').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages2_2_2').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addBedRoom').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
      }
      $('#imgCanvasbedroom').removeClass("d-none").addClass("d-block");
      $('#image_iconbedroom').removeClass("d-block").addClass("d-none");
      $('#existingbedroom').removeClass("d-block").addClass("d-none");
    }
    else if(exist >= 3){
      if(uploadImgDiningRoom.files.length != 0){
        file = uploadImgDiningRoom.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addBedRoom').modal('hide');
        $('#imgCanvasbedroom').removeClass("d-none").addClass("d-block");
        $('#image_iconbedroom').removeClass("d-block").addClass("d-none");
        $('#existingbedroom').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addBedRoom').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  //bathroom
  function saveBathroom() {
    var uploadImgbathRoom = document.getElementById("uploadImgBathrooms");
    var uploadImgbathRoom1 = document.getElementById("uploadImgBathrooms1");
    var uploadImgbathRoom2 = document.getElementById("uploadImgBathrooms2");
    var canvas = document.getElementById("imgCanvasbathroom");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgbathRoom2.files.length != 0 && $('#imgCanvas3_3_3').hasClass('d-block')) {
      file = uploadImgbathRoom2.files[0];
      count++;
    }
  
    if (uploadImgbathRoom1.files.length != 0 && $('#imgCanvas3_3').hasClass('d-block')) {
      file = uploadImgbathRoom1.files[0];
      count++;
    }
  
    if (uploadImgbathRoom.files.length != 0 && $('#imgCanvas3').hasClass('d-block')) {
      file = uploadImgbathRoom.files[0];
      count++;
    }
    
    if($('#imgCanvas3').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas3_3').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas3_3_3').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages3').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages3_3').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages3_3_3').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addBathroom').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasbathroom').removeClass("d-none").addClass("d-block");
      $('#image_iconbathroom').removeClass("d-block").addClass("d-none");
      $('#existingbathroom').removeClass("d-block").addClass("d-none");
    }
    else if(exist >= 3){
      if(uploadImgbathRoom.files.length != 0){
        file = uploadImgbathRoom.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addBathroom').modal('hide');
        $('#imgCanvasbathroom').removeClass("d-none").addClass("d-block");
        $('#image_iconbathroom').removeClass("d-block").addClass("d-none");
        $('#existingbathroom').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addBathroom').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingBathroom() {
    if($('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Bathroom"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon3').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas3').removeClass("d-block").addClass("d-none");
          $('#existingImages3').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon3_3').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas3_3').removeClass("d-block").addClass("d-none");
          $('#existingImages3_3').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon3_3_3').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas3_3_3').removeClass("d-block").addClass("d-none");
          $('#existingImages3_3_3').removeClass("d-block").addClass("d-none");
    
          $('#image_iconbathroom').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasbathroom').removeClass("d-block").addClass("d-none");
          
          $('#existingbathroom').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload3').val('');
          $('.imgUpload3_3').val('');
          $('.imgUpload3_3_3').val('');
        }
      });
    }
  }
  function saveKitchen() {
    var uploadImgKitchen = document.getElementById("uploadImgKitchen");
    var uploadImgKitchen1 = document.getElementById("uploadImgKitchen1");
    var uploadImgKitchen2 = document.getElementById("uploadImgKitchen2");
    var canvas = document.getElementById("imgCanvaskitchen");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgKitchen2.files.length != 0 && $('#imgCanvas4_4_4').hasClass('d-block')) {
      file = uploadImgKitchen2.files[0];
      count++;
    }
  
    if (uploadImgKitchen1.files.length != 0 && $('#imgCanvas4_4').hasClass('d-block')) {
      file = uploadImgKitchen1.files[0];
      count++;
    }
  
    if (uploadImgKitchen.files.length != 0 && $('#imgCanvas4').hasClass('d-block')) {
      file = uploadImgKitchen.files[0];
      count++;
    }
    
    if($('#imgCanvas4').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas4_4').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas4_4_4').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages4').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages4_4').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages4_4_4').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addKitchen').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvaskitchen').removeClass("d-none").addClass("d-block");
      $('#image_iconkitchen').removeClass("d-block").addClass("d-none");
      $('#existingkitchen').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgKitchen.files.length != 0){
        file = uploadImgKitchen.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addKitchen').modal('hide');
        $('#imgCanvaskitchen').removeClass("d-none").addClass("d-block");
        $('#image_iconkitchen').removeClass("d-block").addClass("d-none");
        $('#existingkitchen').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addKitchen').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingKitchen() {
    if($('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Kitchen"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon4').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas4').removeClass("d-block").addClass("d-none");
          $('#existingImages4').removeClass("d-block").addClass("d-none");

          $('#uploadIcon4_4').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas4_4').removeClass("d-block").addClass("d-none");
          $('#existingImages4_4').removeClass("d-block").addClass("d-none");

          $('#uploadIcon4_4_4').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas4_4_4').removeClass("d-block").addClass("d-none");
          $('#existingImages4_4_4').removeClass("d-block").addClass("d-none");

          $('#image_iconkitchen').removeClass("d-none").addClass("d-flex");
          $('#imgCanvaskitchen').removeClass("d-block").addClass("d-none");
          
          $('#existingkitchen').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload4').val('');
          $('.imgUpload4_4').val('');
          $('.imgUpload4_4_4').val('');
        }
      });
    }
  }
  //laundry room
  function saveLaundryroom() {
    var uploadImgLaundryRoom = document.getElementById("uploadImgLaundryRoom");
    var uploadImgLaundryRoom1 = document.getElementById("uploadImgLaundryRoom1");
    var uploadImgLaundryRoom2 = document.getElementById("uploadImgLaundryRoom2");
    var canvas = document.getElementById("imgCanvasLaundryroom");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgLaundryRoom2.files.length != 0 && $('#imgCanvas5_5_5').hasClass('d-block')) {
      file = uploadImgLaundryRoom2.files[0];
      count++;
    }
  
    if (uploadImgLaundryRoom1.files.length != 0 && $('#imgCanvas5_5').hasClass('d-block')) {
      file = uploadImgLaundryRoom1.files[0];
      count++;
    }
  
    if (uploadImgLaundryRoom.files.length != 0 && $('#imgCanvas5').hasClass('d-block')) {
      file = uploadImgLaundryRoom.files[0];
      count++;
    }
    
    if($('#imgCanvas5').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas5_5').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas5_5_5').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages5').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages5_5').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages5_5_5').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addLaundryRoom').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasLaundryroom').removeClass("d-none").addClass("d-block");
      $('#image_iconLaundryroom').removeClass("d-block").addClass("d-none");
      $('#existingLaundryroom').removeClass("d-block").addClass("d-none");
    }  
    else if(exist >= 3){
      if(uploadImgLaundryRoom.files.length != 0){
        file = uploadImgLaundryRoom.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addLaundryRoom').modal('hide');
        $('#imgCanvasLaundryroom').removeClass("d-none").addClass("d-block");
        $('#image_iconLaundryroom').removeClass("d-block").addClass("d-none");
        $('#existingLaundryroom').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addLaundryRoom').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingLaundryroom() {
    if($('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Laundryroom"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon5').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas5').removeClass("d-block").addClass("d-none");
          $('#existingImages5').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon5_5').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas5_5').removeClass("d-block").addClass("d-none");
          $('#existingImages5_5').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon5_5_5').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas5_5_5').removeClass("d-block").addClass("d-none");
          $('#existingImages5_5_5').removeClass("d-block").addClass("d-none");
    
          $('#image_iconLaundryroom').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasLaundryroom').removeClass("d-block").addClass("d-none");
          
          $('#existingLaundryroom').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload5').val('');
          $('.imgUpload5_5').val('');
          $('.imgUpload5_5_5').val('');
        }
      });
    }
  }
  //studyoffice
  function saveStudyOffice() {
    var uploadImgStudyOffice = document.getElementById("uploadImgStudyOffice");
    var uploadImgStudyOffice1 = document.getElementById("uploadImgStudyOffice1");
    var uploadImgStudyOffice2 = document.getElementById("uploadImgStudyOffice2");
    var canvas = document.getElementById("imgCanvasStudyOffice");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgStudyOffice2.files.length != 0 && $('#imgCanvas6_6_6').hasClass('d-block')) {
      file = uploadImgStudyOffice2.files[0];
      count++;
    }
  
    if (uploadImgStudyOffice1.files.length != 0 && $('#imgCanvas6_6').hasClass('d-block')) {
      file = uploadImgStudyOffice1.files[0];
      count++;
    }
  
    if (uploadImgStudyOffice.files.length != 0 && $('#imgCanvas6').hasClass('d-block')) {
      file = uploadImgStudyOffice.files[0];
      count++;
    }
    
    if($('#imgCanvas6').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas6_6').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas6_6_6').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages6').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages6_6').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages6_6_6').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addStudyOffice').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasStudyOffice').removeClass("d-none").addClass("d-block");
      $('#image_iconStudyOffice').removeClass("d-block").addClass("d-none");
      $('#existingStudyOffice').removeClass("d-block").addClass("d-none");
    }
    else if(exist >= 3){
      if(uploadImgStudyOffice.files.length != 0){
        file = uploadImgStudyOffice.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addStudyOffice').modal('hide');
        $('#imgCanvasStudyOffice').removeClass("d-none").addClass("d-block");
        $('#image_iconStudyOffice').removeClass("d-block").addClass("d-none");
        $('#existingStudyOffice').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addStudyOffice').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingStudyOffice() {
    if($('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Studyoffice"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon6').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas6').removeClass("d-block").addClass("d-none");
          $('#existingImages6').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon6_6').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas6_6').removeClass("d-block").addClass("d-none");
          $('#existingImages6_6').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon6_6_6').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas6_6_6').removeClass("d-block").addClass("d-none");
          $('#existingImages6_6_6').removeClass("d-block").addClass("d-none");
    
          $('#image_iconStudyOffice').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasStudyOffice').removeClass("d-block").addClass("d-none");
          
          $('#existingStudyOffice').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload6').val('');
          $('.imgUpload6_6').val('');
          $('.imgUpload6_6_6').val('');
        }
      });
    }
  }
  //Entertainment
  function saveEntertainmentroom() {
    var uploadImgEntertainmentRoom = document.getElementById("uploadImgEntertainmentRoom");
    var uploadImgEntertainmentRoom1 = document.getElementById("uploadImgEntertainmentRoom1");
    var uploadImgEntertainmentRoom2 = document.getElementById("uploadImgEntertainmentRoom2");
    var canvas = document.getElementById("imgCanvasEntertainmentroom");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgEntertainmentRoom2.files.length != 0 && $('#imgCanvas7_7_7').hasClass('d-block')) {
      file = uploadImgEntertainmentRoom2.files[0];
      count++;
    }
  
    if (uploadImgEntertainmentRoom1.files.length != 0 && $('#imgCanvas7_7').hasClass('d-block')) {
      file = uploadImgEntertainmentRoom1.files[0];
      count++;
    }
  
    if (uploadImgEntertainmentRoom.files.length != 0 && $('#imgCanvas7').hasClass('d-block')) {
      file = uploadImgEntertainmentRoom.files[0];
      count++;
    }
    
    if($('#imgCanvas7').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas7_7').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas7_7_7').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages7').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages7_7').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages7_7_7').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addEntertainmentRoom').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasEntertainmentroom').removeClass("d-none").addClass("d-block");
      $('#image_iconEntertainmentroom').removeClass("d-block").addClass("d-none");
      $('#existingEntertainmentroom').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgEntertainmentRoom.files.length != 0){
        file = uploadImgEntertainmentRoom.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addEntertainmentRoom').modal('hide');
        $('#imgCanvasEntertainmentroom').removeClass("d-none").addClass("d-block");
        $('#image_iconEntertainmentroom').removeClass("d-block").addClass("d-none");
        $('#existingEntertainmentroom').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addEntertainmentRoom').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingEntertainmentroom() {
    if($('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Entertainment"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon7').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas7').removeClass("d-block").addClass("d-none");
          $('#existingImages7').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon7_7').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas7_7').removeClass("d-block").addClass("d-none");
          $('#existingImages7_7').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon7_7_7').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas7_7_7').removeClass("d-block").addClass("d-none");
          $('#existingImages7_7_7').removeClass("d-block").addClass("d-none");
    
          $('#image_iconEntertainmentroom').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasEntertainmentroom').removeClass("d-block").addClass("d-none");
          
          $('#existingEntertainmentroom').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload7').val('');
          $('.imgUpload7_7').val('');
          $('.imgUpload7_7_7').val('');
        }
      });
    }
  }
  //Walkin closet
  function savewalkincloset() {
    var uploadImgWalkInCloset = document.getElementById("uploadImgWalkInCloset");
    var uploadImgWalkInCloset1 = document.getElementById("uploadImgWalkInCloset1");
    var uploadImgWalkInCloset2 = document.getElementById("uploadImgWalkInCloset2");
    var canvas = document.getElementById("imgCanvasWalkInCloset");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgWalkInCloset2.files.length != 0 && $('#imgCanvas8_8_8').hasClass('d-block')) {
      file = uploadImgWalkInCloset2.files[0];
      count++;
    }
  
    if (uploadImgWalkInCloset1.files.length != 0 && $('#imgCanvas8_8').hasClass('d-block')) {
      file = uploadImgWalkInCloset1.files[0];
      count++;
    }
  
    if (uploadImgWalkInCloset.files.length != 0 && $('#imgCanvas8').hasClass('d-block')) {
      file = uploadImgWalkInCloset.files[0];
      count++;
    }
    
    if($('#imgCanvas8').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas8_8').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas8_8_8').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages8').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages8_8').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages8_8_8').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addwalkincloset').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasWalkInCloset').removeClass("d-none").addClass("d-block");
      $('#image_iconWalkInCloset').removeClass("d-block").addClass("d-none");
      $('#existingWalkInCloset').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgWalkInCloset.files.length != 0){
        file = uploadImgWalkInCloset.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addwalkincloset').modal('hide');
        $('#imgCanvasWalkInCloset').removeClass("d-none").addClass("d-block");
        $('#image_iconWalkInCloset').removeClass("d-block").addClass("d-none");
        $('#existingWalkInCloset').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addwalkincloset').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingwalkincloset() {
    if($('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Walkincloset"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon8').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas8').removeClass("d-block").addClass("d-none");
          $('#existingImages8').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon8_8').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas8_8').removeClass("d-block").addClass("d-none");
          $('#existingImages8_8').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon8_8_8').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas8_8_8').removeClass("d-block").addClass("d-none");
          $('#existingImages8_8_8').removeClass("d-block").addClass("d-none");
    
          $('#image_iconWalkInCloset').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasWalkInCloset').removeClass("d-block").addClass("d-none");
          
          $('#existingWalkInCloset').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload8').val('');
          $('.imgUpload8_8').val('');
          $('.imgUpload8_8_8').val('');
        }
      });
    }
  }
  //hallways
  function saveHallways() {
    var uploadImgHallways = document.getElementById("uploadImgHallways");
    var uploadImgHallways1 = document.getElementById("uploadImgHallways1");
    var uploadImgHallways2 = document.getElementById("uploadImgHallways2");
    var canvas = document.getElementById("imgCanvasHallways");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgHallways2.files.length != 0 && $('#imgCanvas9_9_9').hasClass('d-block')) {
      file = uploadImgHallways2.files[0];
      count++;
    }
  
    if (uploadImgHallways1.files.length != 0 && $('#imgCanvas9_9').hasClass('d-block')) {
      file = uploadImgHallways1.files[0];
      count++;
    }
  
    if (uploadImgHallways.files.length != 0 && $('#imgCanvas9').hasClass('d-block')) {
      file = uploadImgHallways.files[0];
      count++;
    }
    
    if($('#imgCanvas9').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas9_9').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas9_9_9').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages9').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages9_9').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages9_9_9').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addHallways').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasHallways').removeClass("d-none").addClass("d-block");
      $('#image_iconHallways').removeClass("d-block").addClass("d-none");
      $('#existingHallways').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgHallways.files.length != 0){
        file = uploadImgHallways.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addHallways').modal('hide');
        $('#imgCanvasHallways').removeClass("d-none").addClass("d-block");
        $('#image_iconHallways').removeClass("d-block").addClass("d-none");
        $('#existingHallways').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addHallways').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingHallways() {
    if($('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Hallways"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon9').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas9').removeClass("d-block").addClass("d-none");
          $('#existingImages9').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon9_9').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas9_9').removeClass("d-block").addClass("d-none");
          $('#existingImages9_9').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon9_9_9').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas9_9_9').removeClass("d-block").addClass("d-none");
          $('#existingImages9_9_9').removeClass("d-block").addClass("d-none");
    
          $('#image_iconHallways').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasHallways').removeClass("d-block").addClass("d-none");
          
          $('#existingHallways').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload9').val('');
          $('.imgUpload9_9').val('');
          $('.imgUpload9_9_9').val('');
        }
      });
    }
  }
  //staircase
  function saveStaircase() {
    var uploadImgStaircase = document.getElementById("uploadImgStaircase");
    var uploadImgStaircase1 = document.getElementById("uploadImgStaircase1");
    var uploadImgStaircase2 = document.getElementById("uploadImgStaircase2");
    var canvas = document.getElementById("imgCanvasStaircase");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgStaircase2.files.length != 0 && $('#imgCanvas10_10_10').hasClass('d-block')) {
      file = uploadImgStaircase2.files[0];
      count++;
    }
  
    if (uploadImgStaircase1.files.length != 0 && $('#imgCanvas10_10').hasClass('d-block')) {
      file = uploadImgStaircase1.files[0];
      count++;
    }
  
    if (uploadImgStaircase.files.length != 0 && $('#imgCanvas10').hasClass('d-block')) {
      file = uploadImgStaircase.files[0];
      count++;
    }
    
    if($('#imgCanvas10').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas10_10').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas10_10_10').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages10').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages10_10').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages10_10_10').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addStaircase').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasStaircase').removeClass("d-none").addClass("d-block");
      $('#image_iconStaircase').removeClass("d-block").addClass("d-none");
      $('#existingStaircase').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgStaircase.files.length != 0){
        file = uploadImgStaircase.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addStaircase').modal('hide');
        $('#imgCanvasStaircase').removeClass("d-none").addClass("d-block");
        $('#image_iconStaircase').removeClass("d-block").addClass("d-none");
        $('#existingStaircase').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addStaircase').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingStaircase() {
    if($('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Staircase"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon10').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas10').removeClass("d-block").addClass("d-none");
          $('#existingImages10').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon10_10').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas10_10').removeClass("d-block").addClass("d-none");
          $('#existingImages10_10').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon10_10_10').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas10_10_10').removeClass("d-block").addClass("d-none");
          $('#existingImages10_10_10').removeClass("d-block").addClass("d-none");
    
          $('#image_iconStaircase').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasStaircase').removeClass("d-block").addClass("d-none");
          
          $('#existingStaircase').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload10').val('');
          $('.imgUpload10_10').val('');
          $('.imgUpload10_10_10').val('');
        }
      });
    }
  }
  //Other
  function saveOther() {
    var uploadImgOther = document.getElementById("uploadImgOther");
    var uploadImgOther1 = document.getElementById("uploadImgOther1");
    var uploadImgOther2 = document.getElementById("uploadImgOther2");
    var canvas = document.getElementById("imgCanvasOther");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgOther2.files.length != 0 && $('#imgCanvas11_11_11').hasClass('d-block')) {
      file = uploadImgOther2.files[0];
      count++;
    }
  
    if (uploadImgOther1.files.length != 0 && $('#imgCanvas11_11').hasClass('d-block')) {
      file = uploadImgOther1.files[0];
      count++;
    }
  
    if (uploadImgOther.files.length != 0 && $('#imgCanvas11').hasClass('d-block')) {
      file = uploadImgOther.files[0];
      count++;
    }
    
    if($('#imgCanvas11').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas11_11').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas11_11_11').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages11').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages11_11').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages11_11_11').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addOther').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasOther').removeClass("d-none").addClass("d-block");
      $('#image_iconOther').removeClass("d-block").addClass("d-none");
      $('#existingOther').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgOther.files.length != 0){
        file = uploadImgOther.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addOther').modal('hide');
        $('#imgCanvasOther').removeClass("d-none").addClass("d-block");
        $('#image_iconOther').removeClass("d-block").addClass("d-none");
        $('#existingOther').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addOther').modal('hide');
      }
    }
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingOther() {
    if($('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Other"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon11').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas11').removeClass("d-block").addClass("d-none");
          $('#existingImages11').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon11_11').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas11_11').removeClass("d-block").addClass("d-none");
          $('#existingImages11_11').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon11_11_11').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas11_11_11').removeClass("d-block").addClass("d-none");
          $('#existingImages11_11_11').removeClass("d-block").addClass("d-none");
    
          $('#image_iconOther').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasOther').removeClass("d-block").addClass("d-none");
          
          $('#existingOther').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload11').val('');
          $('.imgUpload11_11').val('');
          $('.imgUpload11_11_11').val('');
        }
      });
    }
  }
  //Garden
  function saveGarden() {
    var uploadImgGarden = document.getElementById("uploadImgGarden");
    var uploadImgGarden1 = document.getElementById("uploadImgGarden1");
    var uploadImgGarden2 = document.getElementById("uploadImgGarden2");
    var canvas = document.getElementById("imgCanvasGarden");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
    var file;
  
    if (uploadImgGarden2.files.length != 0 && $('#imgCanvas12_12_12').hasClass('d-block')) {
      file = uploadImgGarden2.files[0];
      count++;
    }
  
    if (uploadImgGarden1.files.length != 0 && $('#imgCanvas12_12').hasClass('d-block')) {
      file = uploadImgGarden1.files[0];
      count++;
    }
  
    if (uploadImgGarden.files.length != 0 && $('#imgCanvas12').hasClass('d-block')) {
      file = uploadImgGarden.files[0];
      count++;
    }
    
    if($('#imgCanvas12').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas12_12').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas12_12_12').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages12').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages12_12').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages12_12_12').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addGarden').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasGarden').removeClass("d-none").addClass("d-block");
      $('#image_iconGarden').removeClass("d-block").addClass("d-none");
      $('#existingGarden').removeClass("d-block").addClass("d-none");
    }
    else if(exist >= 3){
      if(uploadImgGarden.files.length != 0){
        file = uploadImgGarden.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addGarden').modal('hide');
        $('#imgCanvasGarden').removeClass("d-none").addClass("d-block");
        $('#image_iconGarden').removeClass("d-block").addClass("d-none");
        $('#existingGarden').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addGarden').modal('hide');
      }
    } 
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingGarden() {
    if($('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Garden"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon12').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas12').removeClass("d-block").addClass("d-none");
          $('#existingImages12').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon12_12').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas12_12').removeClass("d-block").addClass("d-none");
          $('#existingImages12_12').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon12_12_12').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas12_12_12').removeClass("d-block").addClass("d-none");
          $('#existingImages12_12_12').removeClass("d-block").addClass("d-none");
    
          $('#image_iconGarden').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasGarden').removeClass("d-block").addClass("d-none");
          
          $('#existingGarden').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload12').val('');
          $('.imgUpload12_12').val('');
          $('.imgUpload12_12_12').val('');
        }
      });
    }
  }
  //Outdoorkitchen
  function saveOutdoorkitchen() {
    var uploadImgOutdoorKitchen = document.getElementById("uploadImgOutdoorKitchen");
    var uploadImgOutdoorKitchen1 = document.getElementById("uploadImgOutdoorKitchen1");
    var uploadImgOutdoorKitchen2 = document.getElementById("uploadImgOutdoorKitchen2");
    var canvas = document.getElementById("imgCanvasOutdoorkitchen");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgOutdoorKitchen2.files.length != 0 && $('#imgCanvas13_13_13').hasClass('d-block')) {
      file = uploadImgOutdoorKitchen2.files[0];
      count++;
    }
  
    if (uploadImgOutdoorKitchen1.files.length != 0 && $('#imgCanvas13_13').hasClass('d-block')) {
      file = uploadImgOutdoorKitchen1.files[0];
      count++;
    }
  
    if (uploadImgOutdoorKitchen.files.length != 0 && $('#imgCanvas13').hasClass('d-block')) {
      file = uploadImgOutdoorKitchen.files[0];
      count++;
    }
    
    if($('#imgCanvas13').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas13_13').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas13_13_13').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages13').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages13_13').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages13_13_13').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addOutdoorkitchen').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasOutdoorkitchen').removeClass("d-none").addClass("d-block");
      $('#image_iconOutdoorkitchen').removeClass("d-block").addClass("d-none");
      $('#existingOutdoorkitchen').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgOutdoorKitchen.files.length != 0){
        file = uploadImgOutdoorKitchen.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addOutdoorkitchen').modal('hide');
        $('#imgCanvasOutdoorkitchen').removeClass("d-none").addClass("d-block");
        $('#image_iconOutdoorkitchen').removeClass("d-block").addClass("d-none");
        $('#existingOutdoorkitchen').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addOutdoorkitchen').modal('hide');
      }
    } 
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingOutdoorkitchen() {
    if($('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Outkitchen"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon13').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas13').removeClass("d-block").addClass("d-none");
          $('#existingImages13').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon13_13').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas13_13').removeClass("d-block").addClass("d-none");
          $('#existingImages13_13').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon13_13_13').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas13_13_13').removeClass("d-block").addClass("d-none");
          $('#existingImages13_13_13').removeClass("d-block").addClass("d-none");
    
          $('#image_iconOutdoorkitchen').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasOutdoorkitchen').removeClass("d-block").addClass("d-none");
          
          $('#existingOutdoorkitchen').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload13').val('');
          $('.imgUpload13_13').val('');
          $('.imgUpload13_13_13').val('');
        }
      });
    }
  }
  //frontyard
  function saveFrontyard() {
    var uploadImgFrontYard = document.getElementById("uploadImgFrontYard");
    var uploadImgFrontYard1 = document.getElementById("uploadImgFrontYard1");
    var uploadImgFrontYard2 = document.getElementById("uploadImgFrontYard2");
    var canvas = document.getElementById("imgCanvasFrontyard");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgFrontYard2.files.length != 0 && $('#imgCanvas14_14_14').hasClass('d-block')) {
      file = uploadImgFrontYard2.files[0];
      count++;
    }
  
    if (uploadImgFrontYard1.files.length != 0 && $('#imgCanvas14_14').hasClass('d-block')) {
      file = uploadImgFrontYard1.files[0];
      count++;
    }
  
    if (uploadImgFrontYard.files.length != 0 && $('#imgCanvas14').hasClass('d-block')) {
      file = uploadImgFrontYard.files[0];
      count++;
    }
    if($('#imgCanvas14').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas14_14').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas14_14_14').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages14').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages14_14').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages14_14_14').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addFrontyard').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasFrontyard').removeClass("d-none").addClass("d-block");
      $('#image_iconFrontyard').removeClass("d-block").addClass("d-none");
      $('#existingFrontyard').removeClass("d-block").addClass("d-none");
    }
    else if(exist >= 3){
      if(uploadImgFrontYard.files.length != 0){
        file = uploadImgFrontYard.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addFrontyard').modal('hide');
        $('#imgCanvasFrontyard').removeClass("d-none").addClass("d-block");
        $('#image_iconFrontyard').removeClass("d-block").addClass("d-none");
        $('#existingFrontyard').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addFrontyard').modal('hide');
      }
    }  
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingFrontyard() {
    if($('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Frontyard"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon14').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas14').removeClass("d-block").addClass("d-none");
          $('#existingImages14').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon14_14').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas14_14').removeClass("d-block").addClass("d-none");
          $('#existingImages14_14').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon14_14_14').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas14_14_14').removeClass("d-block").addClass("d-none");
          $('#existingImages14_14_14').removeClass("d-block").addClass("d-none");
    
          $('#image_iconFrontyard').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasFrontyard').removeClass("d-block").addClass("d-none");
          
          $('#existingFrontyard').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload14').val('');
          $('.imgUpload14_14').val('');
          $('.imgUpload14_14_14').val('');
        }
      });
    }
  }
  //baackyard
  function saveBackyard() {
    var uploadImgBackYard = document.getElementById("uploadImgBackYard");
    var uploadImgBackYard1 = document.getElementById("uploadImgBackYard1");
    var uploadImgBackYard2 = document.getElementById("uploadImgBackYard2");
    var canvas = document.getElementById("imgCanvasBackyard");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgBackYard2.files.length != 0 && $('#imgCanvas15_15_15').hasClass('d-block')) {
      file = uploadImgBackYard2.files[0];
      count++;
    }
  
    if (uploadImgBackYard1.files.length != 0 && $('#imgCanvas15_15').hasClass('d-block')) {
      file = uploadImgBackYard1.files[0];
      count++;
    }
  
    if (uploadImgBackYard.files.length != 0 && $('#imgCanvas15').hasClass('d-block')) {
      file = uploadImgBackYard.files[0];
      count++;
    }
    if($('#imgCanvas15').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas15_15').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas15_15_15').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages15').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages15_15').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages15_15_15').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addBackyard').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasBackyard').removeClass("d-none").addClass("d-block");
      $('#image_iconBackyard').removeClass("d-block").addClass("d-none");
      $('#existingBackyard').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgBackYard.files.length != 0){
        file = uploadImgBackYard.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addBackyard').modal('hide');
        $('#imgCanvasBackyard').removeClass("d-none").addClass("d-block");
        $('#image_iconBackyard').removeClass("d-block").addClass("d-none");
        $('#existingBackyard').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addBackyard').modal('hide');
      }
    }  
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingBackyard() {
    if($('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Backyard"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon15').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas15').removeClass("d-block").addClass("d-none");
          $('#existingImages15').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon15_15').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas15_15').removeClass("d-block").addClass("d-none");
          $('#existingImages15_15').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon15_15_15').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas15_15_15').removeClass("d-block").addClass("d-none");
          $('#existingImages15_15_15').removeClass("d-block").addClass("d-none");
    
          $('#image_iconBackyard').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasBackyard').removeClass("d-block").addClass("d-none");
          
          $('#existingBackyard').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload15').val('');
          $('.imgUpload15_15').val('');
          $('.imgUpload15_15_15').val('');
        }
      });
    }
  }
  //patio
  function savePatio() {
    var uploadImgPatio = document.getElementById("uploadImgPatio");
    var uploadImgPatio1 = document.getElementById("uploadImgPatio1");
    var uploadImgPatio2 = document.getElementById("uploadImgPatio2");
    var canvas = document.getElementById("imgCanvasPatio");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgPatio2.files.length != 0 && $('#imgCanvas16_16_16').hasClass('d-block')) {
      file = uploadImgPatio2.files[0];
      count++;
    }
  
    if (uploadImgPatio1.files.length != 0 && $('#imgCanvas16_16').hasClass('d-block')) {
      file = uploadImgPatio1.files[0];
      count++;
    }
  
    if (uploadImgPatio.files.length != 0 && $('#imgCanvas16').hasClass('d-block')) {
      file = uploadImgPatio.files[0];
      count++;
    }
    if($('#imgCanvas16').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas16_16').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas16_16_16').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages16').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages16_16').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages16_16_16').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addPatio').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasPatio').removeClass("d-none").addClass("d-block");
      $('#image_iconPatio').removeClass("d-block").addClass("d-none");
      $('#existingPatio').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgPatio.files.length != 0){
        file = uploadImgPatio.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addPatio').modal('hide');
        $('#imgCanvasPatio').removeClass("d-none").addClass("d-block");
        $('#image_iconPatio').removeClass("d-block").addClass("d-none");
        $('#existingPatio').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addPatio').modal('hide');
      }
    }  
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingPatio() {
    if($('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Patio"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon16').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas16').removeClass("d-block").addClass("d-none");
          $('#existingImages16').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon16_16').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas16_16').removeClass("d-block").addClass("d-none");
          $('#existingImages16_16').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon16_16_16').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas16_16_16').removeClass("d-block").addClass("d-none");
          $('#existingImages16_16_16').removeClass("d-block").addClass("d-none");
    
          $('#image_iconPatio').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasPatio').removeClass("d-block").addClass("d-none");
          
          $('#existingPatio').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload16').val('');
          $('.imgUpload16_16').val('');
          $('.imgUpload16_16_16').val('');
        }
      });
    }
  }
  //terrace
  function saveTerrace() {
    var uploadImgTerrace = document.getElementById("uploadImgTerrace");
    var uploadImgTerrace1 = document.getElementById("uploadImgTerrace1");
    var uploadImgTerrace2 = document.getElementById("uploadImgTerrace2");
    var canvas = document.getElementById("imgCanvasTerrace");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgTerrace2.files.length != 0 && $('#imgCanvas17_17_17').hasClass('d-block')) {
      file = uploadImgTerrace2.files[0];
      count++;
    }
  
    if (uploadImgTerrace1.files.length != 0 && $('#imgCanvas17_17').hasClass('d-block')) {
      file = uploadImgTerrace1.files[0];
      count++;
    }
  
    if (uploadImgTerrace.files.length != 0 && $('#imgCanvas17').hasClass('d-block')) {
      file = uploadImgTerrace.files[0];
      count++;
    }
    if($('#imgCanvas17').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas17_17').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas17_17_17').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages17').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages17_17').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages17_17_17').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addTerrace').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasTerrace').removeClass("d-none").addClass("d-block");
      $('#image_iconTerrace').removeClass("d-block").addClass("d-none");
      $('#existingTerrace').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgTerrace.files.length != 0){
        file = uploadImgTerrace.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addTerrace').modal('hide');
        $('#imgCanvasTerrace').removeClass("d-none").addClass("d-block");
        $('#image_iconTerrace').removeClass("d-block").addClass("d-none");
        $('#existingTerrace').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addTerrace').modal('hide');
      }
    }  
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingTerrace() {
    if($('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Terrace"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon17').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas17').removeClass("d-block").addClass("d-none");
          $('#existingImages17').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon17_17').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas17_17').removeClass("d-block").addClass("d-none");
          $('#existingImages17_17').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon17_17_17').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas17_17_17').removeClass("d-block").addClass("d-none");
          $('#existingImages17_17_17').removeClass("d-block").addClass("d-none");
    
          $('#image_iconTerrace').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasTerrace').removeClass("d-block").addClass("d-none");
          
          $('#existingTerrace').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload17').val('');
          $('.imgUpload17_17').val('');
          $('.imgUpload17_17_17').val('');
        }
      });
    }
  }
  //Deck
  function saveDeck() {
    var uploadImgDeck = document.getElementById("uploadImgDeck");
    var uploadImgDeck1 = document.getElementById("uploadImgDeck1");
    var uploadImgDeck2 = document.getElementById("uploadImgDeck2");
    var canvas = document.getElementById("imgCanvasDeck");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgDeck2.files.length != 0 && $('#imgCanvas18_18_18').hasClass('d-block')) {
      file = uploadImgDeck2.files[0];
      count++;
    }
  
    if (uploadImgDeck1.files.length != 0 && $('#imgCanvas18_18').hasClass('d-block')) {
      file = uploadImgDeck1.files[0];
      count++;
    }
  
    if (uploadImgDeck.files.length != 0 && $('#imgCanvas18').hasClass('d-block')) {
      file = uploadImgDeck.files[0];
      count++;
    }
    if($('#imgCanvas18').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas18_18').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas18_18_18').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages18').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages18_18').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages18_18_18').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addDeck').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasDeck').removeClass("d-none").addClass("d-block");
      $('#image_iconDeck').removeClass("d-block").addClass("d-none");
      $('#existingDeck').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgDeck.files.length != 0){
        file = uploadImgDeck.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addDeck').modal('hide');
        $('#imgCanvasDeck').removeClass("d-none").addClass("d-block");
        $('#image_iconDeck').removeClass("d-block").addClass("d-none");
        $('#existingDeck').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addDeck').modal('hide');
      }
    }  
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingDeck() {
    if($('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Deck"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon18').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas18').removeClass("d-block").addClass("d-none");
          $('#existingImages18').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon18_18').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas18_18').removeClass("d-block").addClass("d-none");
          $('#existingImages18_18').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon18_18_18').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas18_18_18').removeClass("d-block").addClass("d-none");
          $('#existingImages18_18_18').removeClass("d-block").addClass("d-none");
    
          $('#image_iconDeck').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasDeck').removeClass("d-block").addClass("d-none");
          
          $('#existingDeck').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload18').val('');
          $('.imgUpload18_18').val('');
          $('.imgUpload18_18_18').val('');
        }
      });
    }
  }
  //playarea
  function saveplayarea() {
    var uploadImgPlayArea = document.getElementById("uploadImgPlayArea");
    var uploadImgPlayArea1 = document.getElementById("uploadImgPlayArea1");
    var uploadImgPlayArea2 = document.getElementById("uploadImgPlayArea2");
    var canvas = document.getElementById("imgCanvasPlayarea");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgPlayArea2.files.length != 0 && $('#imgCanvas19_19_19').hasClass('d-block')) {
      file = uploadImgPlayArea2.files[0];
      count++;
    }
  
    if (uploadImgPlayArea1.files.length != 0 && $('#imgCanvas19_19').hasClass('d-block')) {
      file = uploadImgPlayArea1.files[0];
      count++;
    }
  
    if (uploadImgPlayArea.files.length != 0 && $('#imgCanvas19').hasClass('d-block')) {
      file = uploadImgPlayArea.files[0];
      count++;
    }
    if($('#imgCanvas19').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas19_19').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas19_19_19').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages19').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages19_19').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages19_19_19').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addplayarea').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasPlayarea').removeClass("d-none").addClass("d-block");
      $('#image_iconPlayarea').removeClass("d-block").addClass("d-none");
      $('#existingPlayarea').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgPlayArea.files.length != 0){
        file = uploadImgPlayArea.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addplayarea').modal('hide');
        $('#imgCanvasPlayarea').removeClass("d-none").addClass("d-block");
        $('#image_iconPlayarea').removeClass("d-block").addClass("d-none");
        $('#existingPlayarea').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addplayarea').modal('hide');
      }
    } 
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingplayarea() {
    if($('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Playarea"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon19').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas19').removeClass("d-block").addClass("d-none");
          $('#existingImages19').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon19_19').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas19_19').removeClass("d-block").addClass("d-none");
          $('#existingImages19_19').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon19_19_19').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas19_19_19').removeClass("d-block").addClass("d-none");
          $('#existingImages19_19_19').removeClass("d-block").addClass("d-none");
    
          $('#image_iconPlayarea').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasPlayarea').removeClass("d-block").addClass("d-none");
          
          $('#existingPlayarea').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload19').val('');
          $('.imgUpload19_19').val('');
          $('.imgUpload19_19_19').val('');
        }
      });
    }
  }
  //swimming pool
  function saveswimmingpool() {
    var uploadImgSwimmingPool = document.getElementById("uploadImgSwimmingPool");
    var uploadImgSwimmingPool1 = document.getElementById("uploadImgSwimmingPool1");
    var uploadImgSwimmingPool2 = document.getElementById("uploadImgSwimmingPool2");
    var canvas = document.getElementById("imgCanvasSwimmingpool");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgSwimmingPool2.files.length != 0 && $('#imgCanvas20_20_20').hasClass('d-block')) {
      file = uploadImgSwimmingPool2.files[0];
      count++;
    }
  
    if (uploadImgSwimmingPool1.files.length != 0 && $('#imgCanvas20_20').hasClass('d-block')) {
      file = uploadImgSwimmingPool1.files[0];
      count++;
    }
  
    if (uploadImgSwimmingPool.files.length != 0 && $('#imgCanvas20').hasClass('d-block')) {
      file = uploadImgSwimmingPool.files[0];
      count++;
    }
    if($('#imgCanvas20').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas20_20').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas20_20_20').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages20').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages20_20').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages20_20_20').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addswimmingpool').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasSwimmingpool').removeClass("d-none").addClass("d-block");
      $('#image_iconSwimmingpool').removeClass("d-block").addClass("d-none");
      $('#existingSwimmingpool').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgSwimmingPool.files.length != 0){
        file = uploadImgSwimmingPool.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addswimmingpool').modal('hide');
        $('#imgCanvasSwimmingpool').removeClass("d-none").addClass("d-block");
        $('#image_iconSwimmingpool').removeClass("d-block").addClass("d-none");
        $('#existingSwimmingpool').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addswimmingpool').modal('hide');
      }
    } 
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingswimmingpool() {
    if($('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Swimmingpool"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon20').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas20').removeClass("d-block").addClass("d-none");
          $('#existingImages20').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon20_20').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas20_20').removeClass("d-block").addClass("d-none");
          $('#existingImages20_20').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon20_20_20').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas20_20_20').removeClass("d-block").addClass("d-none");
          $('#existingImages20_20_20').removeClass("d-block").addClass("d-none");
    
          $('#image_iconSwimmingpool').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasSwimmingpool').removeClass("d-block").addClass("d-none");
          
          $('#existingSwimmingpool').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload20').val('');
          $('.imgUpload20_20').val('');
          $('.imgUpload20_20_20').val('');
        }
      });
    }
  }
  //driveway
  function saveDriveway() {
    var uploadImgDriveway = document.getElementById("uploadImgDriveway");
    var uploadImgDriveway1 = document.getElementById("uploadImgDriveway1");
    var uploadImgDriveway2 = document.getElementById("uploadImgDriveway2");
    var canvas = document.getElementById("imgCanvasDriveway");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgDriveway2.files.length != 0 && $('#imgCanvas21_21_21').hasClass('d-block')) {
      file = uploadImgDriveway2.files[0];
      count++;
    }
  
    if (uploadImgDriveway1.files.length != 0 && $('#imgCanvas21_21').hasClass('d-block')) {
      file = uploadImgDriveway1.files[0];
      count++;
    }
  
    if (uploadImgDriveway.files.length != 0 && $('#imgCanvas21').hasClass('d-block')) {
      file = uploadImgDriveway.files[0];
      count++;
    }
    
    if($('#imgCanvas21').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas21_21').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas21_21_21').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages21').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages21_21').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages21_21_21').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addDriveway').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasDriveway').removeClass("d-none").addClass("d-block");
      $('#image_iconDriveway').removeClass("d-block").addClass("d-none");
      $('#existingDriveway').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgDriveway.files.length != 0){
        file = uploadImgDriveway.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addDriveway').modal('hide');
        $('#imgCanvasDriveway').removeClass("d-none").addClass("d-block");
        $('#image_iconDriveway').removeClass("d-block").addClass("d-none");
        $('#existingDriveway').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addDriveway').modal('hide');
      }
    } 
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingDriveway() {
    if($('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Driveway"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon21').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas21').removeClass("d-block").addClass("d-none");
          $('#existingImages21').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon21_21').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas21_21').removeClass("d-block").addClass("d-none");
          $('#existingImages21_21').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon21_21_21').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas21_21_21').removeClass("d-block").addClass("d-none");
          $('#existingImages21_21_21').removeClass("d-block").addClass("d-none");
    
          $('#image_iconDriveway').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasDriveway').removeClass("d-block").addClass("d-none");
          
          $('#existingDriveway').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload21').val('');
          $('.imgUpload21_21').val('');
          $('.imgUpload21_21_21').val('');
        }
      });
    }
  }
  //Walkways
  function saveWalkways() {
    var uploadImgWalkways = document.getElementById("uploadImgWalkways");
    var uploadImgWalkways1 = document.getElementById("uploadImgWalkways1");
    var uploadImgWalkways2 = document.getElementById("uploadImgWalkways2");
    var canvas = document.getElementById("imgCanvasWalkways");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgWalkways2.files.length != 0 && $('#imgCanvas22_22_22').hasClass('d-block')) {
      file = uploadImgWalkways2.files[0];
      count++;
    }
  
    if (uploadImgWalkways1.files.length != 0 && $('#imgCanvas22_22').hasClass('d-block')) {
      file = uploadImgWalkways1.files[0];
      count++;
    }
  
    if (uploadImgWalkways.files.length != 0 && $('#imgCanvas22').hasClass('d-block')) {
      file = uploadImgWalkways.files[0];
      count++;
    }
    
    if($('#imgCanvas22').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas22_22').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas22_22_22').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages22').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages22_22').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages22_22_22').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addWalkways').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasWalkways').removeClass("d-none").addClass("d-block");
      $('#image_iconWalkways').removeClass("d-block").addClass("d-none");
      $('#existingWalkways').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgWalkways.files.length != 0){
        file = uploadImgWalkways.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addWalkways').modal('hide');
        $('#imgCanvasWalkways').removeClass("d-none").addClass("d-block");
        $('#image_iconWalkways').removeClass("d-block").addClass("d-none");
        $('#existingWalkways').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addWalkways').modal('hide');
      }
    } 
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
            $('#imgCanvasStorageshed').hasClass('d-none') &&  $('#existingStorageshed').hasClass('d-none') && $('.img23').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingWalkways() {
    if($('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Walkways"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon22').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas22').removeClass("d-block").addClass("d-none");
          $('#existingImages22').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon22_22').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas22_22').removeClass("d-block").addClass("d-none");
          $('#existingImages22_22').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon22_22_22').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas22_22_22').removeClass("d-block").addClass("d-none");
          $('#existingImages22_22_22').removeClass("d-block").addClass("d-none");
    
          $('#image_iconWalkways').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasWalkways').removeClass("d-block").addClass("d-none");
          
          $('#existingWalkways').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload22').val('');
          $('.imgUpload22_22').val('');
          $('.imgUpload22_22_22').val('');
        }
      });
    }
  }
  
  
  function saveStorageShed() {
    var uploadImgStorageShed = document.getElementById("uploadImgStorageShed");
    var uploadImgStorageShed1 = document.getElementById("uploadImgStorageShed1");
    var uploadImgStorageShed2 = document.getElementById("uploadImgStorageShed2");
    var canvas = document.getElementById("imgCanvasStorageshed");
    var ctx = canvas.getContext("2d");
  
    var count = 0;
    var exist = 0;
  
    var file;
  
    if (uploadImgStorageShed2.files.length != 0 && $('#imgCanvas23_23_23').hasClass('d-block')) {
      file = uploadImgStorageShed2.files[0];
      count++;
    }
  
    if (uploadImgStorageShed1.files.length != 0 && $('#imgCanvas23_23').hasClass('d-block')) {
      file = uploadImgStorageShed1.files[0];
      count++;
    }
  
    if (uploadImgStorageShed.files.length != 0 && $('#imgCanvas23').hasClass('d-block')) {
      file = uploadImgStorageShed.files[0];
      count++;
    }
    
    if($('#imgCanvas23').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas23_23').hasClass('d-block')){
      exist++;
    }
    if($('#imgCanvas23_23_23').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages23').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages23_23').hasClass('d-block')){
      exist++;
    }
    if($('#existingImages23_23_23').hasClass('d-block')){
      exist++;
    }
  
    if (count >= 3) {
      $('#addStorageShed').modal('hide');
  
      if (file) {
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
  
        reader.readAsDataURL(file);
      }
      $('#imgCanvasStorageshed').removeClass("d-none").addClass("d-block");
      $('#image_iconStorageshed').removeClass("d-block").addClass("d-none");
      $('#existingStorageshed').removeClass("d-block").addClass("d-none");
    } 
    else if(exist >= 3){
      if(uploadImgStorageShed.files.length != 0){
        file = uploadImgStorageShed.files[0];
        var reader = new FileReader();
  
        reader.onload = function (e) {
          // Display the image in the canvas element
          var img = new Image();
          img.src = e.target.result;
  
          img.onload = function () {
            // Clear the canvas
            ctx.clearRect(0, 0, canvas.width, canvas.height);
  
            // Draw the image on the canvas
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
          };
        };
        reader.readAsDataURL(file);
        $('#addStorageShed').modal('hide');
        $('#imgCanvasStorageshed').removeClass("d-none").addClass("d-block");
        $('#image_iconStorageshed').removeClass("d-block").addClass("d-none");
        $('#existingStorageshed').removeClass("d-block").addClass("d-none");
      }
      else{
        $('#addStorageShed').modal('hide');
      }
    } 
    else {
      $('#notEnoughPhotoModal').modal('show');
    }
    if($('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
            $('#imgCanvasbedroom').hasClass('d-none') && $('#existingbedroom').hasClass('d-none') && $('.img2').hasClass('d-block') || 
            $('#imgCanvasbathroom').hasClass('d-none') && $('#existingbathroom').hasClass('d-none') && $('.img3').hasClass('d-block') || 
            $('#imgCanvaskitchen').hasClass('d-none') && $('#existingkitchen').hasClass('d-none') && $('.img4').hasClass('d-block') || 
            $('#imgCanvasLaundryroom').hasClass('d-none') && $('#existingLaundryroom').hasClass('d-none') && $('.img5').hasClass('d-block') || 
            $('#imgCanvasStudyOffice').hasClass('d-none') && $('#existingStudyOffice').hasClass('d-none') && $('.img6').hasClass('d-block') || 
            $('#imgCanvasEntertainmentroom').hasClass('d-none') && $('#existingEntertainmentroom').hasClass('d-none') && $('.img7').hasClass('d-block') || 
            $('#imgCanvasWalkInCloset').hasClass('d-none') && $('#existingWalkInCloset').hasClass('d-none') && $('.img8').hasClass('d-block') || 
            $('#imgCanvasHallways').hasClass('d-none') && $('#existingHallways').hasClass('d-none') && $('.img9').hasClass('d-block') || 
            $('#imgCanvasStaircase').hasClass('d-none') && $('#existingStaircase').hasClass('d-none') && $('.img10').hasClass('d-block') || 
            $('#imgCanvasOther').hasClass('d-none') && $('#existingOther').hasClass('d-none') && $('.img11').hasClass('d-block') || 
            $('#imgCanvasGarden').hasClass('d-none') && $('#existingGarden').hasClass('d-none') && $('.img12').hasClass('d-block') || 
            $('#imgCanvasOutdoorkitchen').hasClass('d-none') && $('#existingOutdoorkitchen').hasClass('d-none') && $('.img13').hasClass('d-block') || 
            $('#imgCanvasFrontyard').hasClass('d-none') && $('#existingFrontyard').hasClass('d-none') && $('.img14').hasClass('d-block') || 
            $('#imgCanvasBackyard').hasClass('d-none') && $('#existingBackyard').hasClass('d-none') && $('.img15').hasClass('d-block') || 
            $('#imgCanvasPatio').hasClass('d-none') && $('#existingPatio').hasClass('d-none') && $('.img16').hasClass('d-block') || 
            $('#imgCanvasTerrace').hasClass('d-none') && $('#existingTerrace').hasClass('d-none') && $('.img17').hasClass('d-block') || 
            $('#imgCanvasDeck').hasClass('d-none') && $('#existingDeck').hasClass('d-none') && $('.img18').hasClass('d-block') || 
            $('#imgCanvasPlayarea').hasClass('d-none') && $('#existingPlayarea').hasClass('d-none') && $('.img19').hasClass('d-block') || 
            $('#imgCanvasSwimmingpool').hasClass('d-none') && $('#existingSwimmingpool').hasClass('d-none') && $('.img20').hasClass('d-block') || 
            $('#imgCanvasDriveway').hasClass('d-none') && $('#existingDriveway').hasClass('d-none') && $('.img21').hasClass('d-block') || 
            $('#imgCanvasWalkways').hasClass('d-none') && $('#existingWalkways').hasClass('d-none') && $('.img22').hasClass('d-block') || 
            $('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block')){
              //property
              if($('#btnProperty').attr('src') == '../imgs/done.png'){
                $('#piDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#piDiv').css("background-color", "#f3f6fb");
                $('#btnProperty').attr('src', '../imgs/add1.png');
              }
              //details
              if($('#btnDetails').attr('src') == '../imgs/done.png'){
                $('#dDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#dDiv').css("background-color", "#f3f6fb");
                $('#btnDetails').attr('src', '../imgs/add1.png');
              }
              //Amenities
              if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
                $('#sDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#sDiv').css("background-color", "#f3f6fb");
                $('#btn_Spaces').attr('src', '../imgs/add1.png');
              }
              //Photos
              if($('#btnPhotos').attr('src') == '../imgs/done.png'){
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              else{
                $('#btnPhotos').attr('src', '../imgs/add2.png');
                $('#pDiv').css("background-color", "#DDE0FF");
              }
              //featured
              if($('#btnFeatured').attr('src') == '../imgs/done.png'){
                $('#fDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#fDiv').css("background-color", "#f3f6fb");
                $('#btnFeatured').attr('src', '../imgs/add1.png');
              }
              //location
              if($('#btnLocation').attr('src') == '../imgs/done.png'){
                $('#lDiv').css("background-color", "#f3f6fb");
              }
              else{
                $('#lDiv').css("background-color", "#f3f6fb");
                $('#btnLocation').attr('src', '../imgs/add1.png');
              }
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/done.png');
  
              if($('#btnProperty').attr('src') != '../imgs/done.png'){
                $('#btnProperty').attr('src', '../imgs/add2.png');
              }
              else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
                $('#btn_Spaces').attr('src', '../imgs/add2.png');
              }
              else if($('#btnDetails').attr('src') != '../imgs/done.png'){
                $('#btnDetails').attr('src', '../imgs/add2.png');
              }
              else if($('#btnFeatured').attr('src') != '../imgs/done.png'){
                $('#btnFeatured').attr('src', '../imgs/add2.png');
              }
              else if($('#btnLocation').attr('src') != '../imgs/done.png'){
                $('#btnLocation').attr('src', '../imgs/add2.png');
              }
              else if($('#btnContact').attr('src') != '../imgs/done.png'){
                $('#btnContact').attr('src', '../imgs/add2.png');
              }
            }
  }
  function cancelsavingStorageShed() {
    if($('#imgCanvasStorageshed').hasClass('d-none') && $('#existingStorageshed').hasClass('d-none')){
      $.ajax({
        url: "../Functions/Landlord/cancelUploadProperty.php",
        method: "POST",
        data: {
          userid: $("#txtUserId").val(),
          propertyInfo: "Storageshed"
        },
        dataType: "text",
        success: function(data) {
          $('#uploadIcon23').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas23').removeClass("d-block").addClass("d-none");
          $('#existingImages23').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon23_23').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas23_23').removeClass("d-block").addClass("d-none");
          $('#existingImages23_23').removeClass("d-block").addClass("d-none");
    
          $('#uploadIcon23_23_23').removeClass("d-none").addClass("d-flex");
          $('#imgCanvas23_23_23').removeClass("d-block").addClass("d-none");
          $('#existingImages23_23_23').removeClass("d-block").addClass("d-none");
    
          $('#image_iconStorageshed').removeClass("d-none").addClass("d-flex");
          $('#imgCanvasStorageshed').removeClass("d-block").addClass("d-none");
          
          $('#existingStorageshed').removeClass("d-block").addClass("d-none");
  
          $('.imgUpload23').val('');
          $('.imgUpload23_23').val('');
          $('.imgUpload23_23_23').val('');
        }
      });
    }
  }