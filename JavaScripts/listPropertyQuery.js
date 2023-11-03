$(document).ready(function(){
  //change the circle '+' button
  $('#btnProperty').attr('src', '../imgs/add2.png');      
  //automatically check the contact
  $('#btnContact').attr('src', '../imgs/done.png');
  // Smooth scrolling animation
  const allLinks = document.querySelectorAll("a:link");

  allLinks.forEach(function (link) {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const href = link.getAttribute("href");

      // Scroll back to top
      if (href === "#PropertyInfo"){
        //property
        if($('#btnProperty').attr('src') == '../imgs/done.png'){
          $('#piDiv').css("background-color", "#DDE0FF");
        }
        else{
          $('#piDiv').css("background-color", "#DDE0FF");
          $('#btnProperty').attr('src', '../imgs/add2.png');
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
          $('#pDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#pDiv').css("background-color", "#f3f6fb");
          $('#btnPhotos').attr('src', '../imgs/add1.png');
        }
        //Featured
        if($('#btnFeatured').attr('src') == '../imgs/done.png'){
          $('#fDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#fDiv').css("background-color", "#f3f6fb");
          $('#btnFeatured').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnLocation').attr('src') == '../imgs/done.png'){
          $('#lDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#lDiv').css("background-color", "#f3f6fb");
          $('#btnLocation').attr('src', '../imgs/add1.png');
        }
        //Contacts
        if($('#btnContact').attr('src') == '../imgs/done.png'){
          $('#cDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#cDiv').css("background-color", "#f3f6fb");
          $('#btnContact').attr('src', '../imgs/add1.png');
        }
        $('#aDiv').css("background-color", "#f3f6fb");
        //scroll function
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        });
      }

      // Scroll to other links
      else if (href === "#Details"){
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
          $('#dDiv').css("background-color", "#DDE0FF");
        }
        else{
          $('#dDiv').css("background-color", "#DDE0FF");
          $('#btnDetails').attr('src', '../imgs/add2.png');
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
          $('#pDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#pDiv').css("background-color", "#f3f6fb");
          $('#btnPhotos').attr('src', '../imgs/add1.png');
        }
        //Featured
        if($('#btnFeatured').attr('src') == '../imgs/done.png'){
          $('#fDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#fDiv').css("background-color", "#f3f6fb");
          $('#btnFeatured').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnLocation').attr('src') == '../imgs/done.png'){
          $('#lDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#lDiv').css("background-color", "#f3f6fb");
          $('#btnLocation').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnContact').attr('src') == '../imgs/done.png'){
          $('#cDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#cDiv').css("background-color", "#f3f6fb");
          $('#btnContact').attr('src', '../imgs/add1.png');
        }
        $('#aDiv').css("background-color", "#f3f6fb");
        window.scrollTo({
          top: 500,
          behavior: "smooth",
        });
      }

     //Amenities
      else if (href === "#Amenities"){
        $('#aDiv').css("background-color", "#DDE0FF");
        $('#piDiv').css("background-color", "#f3f6fb");
        $('#dDiv').css("background-color", "#f3f6fb");
        $('#sDiv').css("background-color", "#f3f6fb");
        $('#pDiv').css("background-color", "#f3f6fb");
        $('#fDiv').css("background-color", "#f3f6fb");
        $('#lDiv').css("background-color", "#f3f6fb");
        $('#cDiv').css("background-color", "#f3f6fb");
        window.scrollTo({
          top: 2600,
          behavior: "smooth",
        });
      }

      else if (href === "#Spaces"){
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
          $('#sDiv').css("background-color", "#DDE0FF");
        }
        else{
          $('#sDiv').css("background-color", "#DDE0FF");
          $('#btn_Spaces').attr('src', '../imgs/add2.png');
        }
        //Photos
        if($('#btnPhotos').attr('src') == '../imgs/done.png'){
          $('#pDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#pDiv').css("background-color", "#f3f6fb");
          $('#btnPhotos').attr('src', '../imgs/add1.png');
        }
        //Featured
        if($('#btnFeatured').attr('src') == '../imgs/done.png'){
          $('#fDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#fDiv').css("background-color", "#f3f6fb");
          $('#btnFeatured').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnLocation').attr('src') == '../imgs/done.png'){
          $('#lDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#lDiv').css("background-color", "#f3f6fb");
          $('#btnLocation').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnContact').attr('src') == '../imgs/done.png'){
          $('#cDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#cDiv').css("background-color", "#f3f6fb");
          $('#btnContact').attr('src', '../imgs/add1.png');
        }
        $('#aDiv').css("background-color", "#f3f6fb");
        window.scrollTo({
          top: 1000,
          behavior: "smooth",
        });
      }

      else if (href === "#Photos"){
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
          $('#pDiv').css("background-color", "#DDE0FF");
          $('#btnPhotos').attr('src', '../imgs/add2.png');
        }
        //Featured
        if($('#btnFeatured').attr('src') == '../imgs/done.png'){
          $('#fDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#fDiv').css("background-color", "#f3f6fb");
          $('#btnFeatured').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnLocation').attr('src') == '../imgs/done.png'){
          $('#lDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#lDiv').css("background-color", "#f3f6fb");
          $('#btnLocation').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnContact').attr('src') == '../imgs/done.png'){
          $('#cDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#cDiv').css("background-color", "#f3f6fb");
          $('#btnContact').attr('src', '../imgs/add1.png');
        }
        $('#aDiv').css("background-color", "#f3f6fb");
        window.scrollTo({
          top: 1640,
          behavior: "smooth",
        });
      }

      else if (href === "#Featured"){
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
          $('#pDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#pDiv').css("background-color", "#f3f6fb");
          $('#btnPhotos').attr('src', '../imgs/add1.png');
        }
        //Featured
        if($('#btnLocation').attr('src') == '../imgs/done.png'){
          $('#lDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#lDiv').css("background-color", "#f3f6fb");
          $('#btnLocation').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnFeatured').attr('src') == '../imgs/done.png'){
          $('flDiv').css("background-color", "#DDE0FF");
        }
        else{
          $('#fDiv').css("background-color", "#DDE0FF");
          $('#btnFeatured').attr('src', '../imgs/add2.png');
        }
        //Contact
        if($('#btnContact').attr('src') == '../imgs/done.png'){
          $('#cDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#cDiv').css("background-color", "#f3f6fb");
          $('#btnContact').attr('src', '../imgs/add1.png');
        }
        $('#aDiv').css("background-color", "#f3f6fb");
        window.scrollTo({
          top: 2200,
          behavior: "smooth",
        });
      }

      else if (href === "#Location"){
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
          $('#pDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#pDiv').css("background-color", "#f3f6fb");
          $('#btnPhotos').attr('src', '../imgs/add1.png');
        }
        //Featured
        if($('#btnFeatured').attr('src') == '../imgs/done.png'){
          $('#fDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#fDiv').css("background-color", "#f3f6fb");
          $('#btnFeatured').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnLocation').attr('src') == '../imgs/done.png'){
          $('#lDiv').css("background-color", "#DDE0FF");
        }
        else{
          $('#lDiv').css("background-color", "#DDE0FF");
          $('#btnLocation').attr('src', '../imgs/add2.png');
        }
        //Contact
        if($('#btnContact').attr('src') == '../imgs/done.png'){
          $('#cDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#cDiv').css("background-color", "#f3f6fb");
          $('#btnContact').attr('src', '../imgs/add1.png');
        }
        $('#aDiv').css("background-color", "#f3f6fb");
        window.scrollTo({
          top: 3200,
          behavior: "smooth",
        });
      }

      else if (href === "#Contact"){
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
          $('#pDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#pDiv').css("background-color", "#f3f6fb");
          $('#btnPhotos').attr('src', '../imgs/add1.png');
        }
        //Featured
        if($('#btnFeatured').attr('src') == '../imgs/done.png'){
          $('#fDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#fDiv').css("background-color", "#f3f6fb");
          $('#btnFeatured').attr('src', '../imgs/add1.png');
        }
        //Location
        if($('#btnLocation').attr('src') == '../imgs/done.png'){
          $('#lDiv').css("background-color", "#f3f6fb");
        }
        else{
          $('#lDiv').css("background-color", "#f3f6fb");
          $('#btnLocation').attr('src', '../imgs/add1.png');
        }
        //Contact
        if($('#btnContact').attr('src') == '../imgs/done.png'){
          $('#cDiv').css("background-color", "#DDE0FF");
        }
        else{
          $('#cDiv').css("background-color", "#DDE0FF");
          $('#btnContact').attr('src', '../imgs/add2.png');
        }
        $('#aDiv').css("background-color", "#f3f6fb");
        window.scrollTo({
          top: 3600,
          behavior: "smooth",
        });
      }
    });  
  });




});
//amenities sidebar
function amenitiesSideBar(){
  $('#aDiv').css("background-color", "#DDE0FF");
  $('#cDiv').css("background-color", "#f3f6fb");
  $('#fDiv').css("background-color", "#f3f6fb");
  $('#lDiv').css("background-color", "#f3f6fb");
  $('#pDiv').css("background-color", "#f3f6fb");
  $('#sDiv').css("background-color", "#f3f6fb");
  $('#dDiv').css("background-color", "#f3f6fb");
  $('#piDiv').css("background-color", "#f3f6fb");
}
// user input function in property information
function propertyInformationFunction(){ 
  $('#aDiv').css("background-color", "#f3f6fb");
  $('#cDiv').css("background-color", "#f3f6fb");
  $('#fDiv').css("background-color", "#f3f6fb");
  $('#lDiv').css("background-color", "#f3f6fb");
  $('#pDiv').css("background-color", "#f3f6fb");
  $('#sDiv').css("background-color", "#f3f6fb");
  $('#dDiv').css("background-color", "#f3f6fb");
  $('#piDiv').css("background-color", "#f3f6fb");
	//get the ridio button value in property type
  var txtPropertyType = document.getElementsByName("property_type");
  var selectedType = "";

  for(var propertyTypeResult of txtPropertyType){
    if(propertyTypeResult.checked){
      selectedType = propertyTypeResult.value;
      break;
    }
  }

  //Title Value
  var propertyTitle = document.getElementById("propertyTitle").value;
  //Title Value
  var propertyDescription = document.getElementById("propertyDescription").value;
  //Price Value
  var propertyPrice = document.getElementById("propertyPrice").value;

  if (selectedType != "" && propertyTitle != "" && propertyDescription != "" && propertyPrice != "") {
    $('#piDiv').css("background-color", "#f3f6fb");
    $('#btnProperty').attr('src', '../imgs/done.png');

    if($('#btnDetails').attr('src') != '../imgs/done.png'){
      $('#btnDetails').attr('src', '../imgs/add2.png');
    }
    else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
      $('#btn_Spaces').attr('src', '../imgs/add2.png');
    }
    else if($('#btnPhotos').attr('src') != '../imgs/done.png'){
      $('#btnPhotos').attr('src', '../imgs/add2.png');
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
  else{
    $('#piDiv').css("background-color", "#DDE0FF");
    $('#btnProperty').attr('src', '../imgs/add2.png');

    if($('#btnDetails').attr('src') != '../imgs/done.png'){
      $('#dDiv').css("background-color", "#f3f6fb");
      $('#btnDetails').attr('src', '../imgs/add1.png');
    }
    if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
      $('#sDiv').css("background-color", "#f3f6fb");
      $('#btn_Spaces').attr('src', '../imgs/add1.png');
    }
    if($('#btnPhotos').attr('src') != '../imgs/done.png'){
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    if($('#btnFeatured').attr('src') != '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    if($('#btnLocation').attr('src') != '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    if($('#btnContact').attr('src') != '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
  }
} 

// user input function in details
function propertyDetailsFunction(){
  $('#cDiv').css("background-color", "#f3f6fb");
  $('#fDiv').css("background-color", "#f3f6fb");
  $('#lDiv').css("background-color", "#f3f6fb");
  $('#pDiv').css("background-color", "#f3f6fb");
  $('#sDiv').css("background-color", "#f3f6fb");
  $('#dDiv').css("background-color", "#f3f6fb");
  $('#piDiv').css("background-color", "#f3f6fb");
  $('#aDiv').css("background-color", "#f3f6fb");
  //Unit/Floor Number
  var txtFloor = document.getElementById("propertyNum").value;
  //Floor Area
  var txtFloorArea = document.getElementById("floorArea").value;
  //Property Name
  var txtmaxOccupants = document.getElementById("maxOccupants").value;
  //Bathroom
  var txtBathroom = document.getElementById("bathNum").value;
  //Bedroom
  var txtBedroom = document.getElementById("bedNum").value;
  //Other details
  var txtOtherDetails = document.getElementById("otherDetails").value;

  //radio button for pets
  var txtPetAllowed = document.getElementsByName("pet_friendly");
  var selectAnswer = "";

  for(var petAllowed of txtPetAllowed){
    if(petAllowed.checked){
      selectAnswer = petAllowed.value;
      break;
    }
  }

  //radio button for furnised
  var txtFurnished = document.getElementsByName("furnished_friendly");
  var selectCheck = "";

  for(var Furnished of txtFurnished){
    if(Furnished.checked){
      selectCheck = Furnished.value;
      break;
    }
  }
  if (txtFloor != "" && txtFloorArea != "" && txtmaxOccupants != "" && txtBathroom != "" && txtBedroom != ""
  && txtOtherDetails != "" && selectAnswer != "" && selectCheck != "") {
    $('#dDiv').css("background-color", "#f3f6fb");
    $('#btnDetails').attr('src', '../imgs/done.png');

    if($('#btnProperty').attr('src') != '../imgs/done.png'){
      $('#btnProperty').attr('src', '../imgs/add2.png');
    }
    else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
      $('#btn_Spaces').attr('src', '../imgs/add2.png');
    }
    else if($('#btnPhotos').attr('src') != '../imgs/done.png'){
      $('#btnPhotos').attr('src', '../imgs/add2.png');
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
  else{
    $('#dDiv').css("background-color", "#DDE0FF");
    $('#btnDetails').attr('src', '../imgs/add2.png');

    if($('#btnProperty').attr('src') != '../imgs/done.png'){
      $('#piDiv').css("background-color", "#f3f6fb");
      $('#btnProperty').attr('src', '../imgs/add1.png');
    }
    if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
      $('#sDiv').css("background-color", "#f3f6fb");
      $('#btn_Spaces').attr('src', '../imgs/add1.png');
    }
    if($('#btnPhotos').attr('src') != '../imgs/done.png'){
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    if($('#btnFeatured').attr('src') != '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    if($('#btnLocation').attr('src') != '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    if($('#btnContact').attr('src') != '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
  }
} 
// user input function in Amenities
function propertySpacesFunction(){
  $('#aDiv').css("background-color", "#f3f6fb");
  //get the indoor checkboxes
  var checkIndoors = document.getElementsByName("indoors");
  var spacesValue = [];

  for (var Indoors of checkIndoors) {
    if (Indoors.checked) {
      spacesValue.push(Indoors.value);
    }
  }
  //get the outdoors checkboxes
  var checkOutdoors = document.getElementsByName("outdoors");

  for (var Outdoors of checkOutdoors) {
    if (Outdoors.checked) {
      spacesValue.push(Outdoors.value);
    }
  }

  for(i = 0; i < spacesValue.length; i++){
    if(spacesValue[i] == "Living Room"){
      document.getElementById("imgName0").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload0").attr("id", "uploadImg"+imgValue);

      $(".imgUpload00").attr("id", "uploadImg"+imgValue+"1");

      $(".imgUpload000").attr("id", "uploadImg"+imgValue+"2");
      
      $(".img0").removeClass("d-none").addClass("d-block");
      $('#uploadIcon0').show();
    }
    else if(spacesValue[i] == "Dining room"){
      document.getElementById("imgName1").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload1").attr("id", "uploadImg"+imgValue);

      $(".imgUpload1_1").attr("id", "uploadImg"+imgValue+"1");

      $(".imgUpload1_1_1").attr("id", "uploadImg"+imgValue+"2");

      $(".img1").removeClass("d-none").addClass("d-block");
      $('#uploadIcon1').show();
    }
    else if(spacesValue[i] == "Bedrooms"){
      document.getElementById("imgName2").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload2").attr("id", "uploadImg"+imgValue);

      $(".imgUpload2_2").attr("id", "uploadImg"+imgValue+"1");

      $(".imgUpload2_2_2").attr("id", "uploadImg"+imgValue+"2");

      $(".img2").removeClass("d-none").addClass("d-block");
      $('#uploadIcon2').show();
    }
    else if(spacesValue[i] == "Bathrooms"){
      document.getElementById("imgName3").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload3").attr("id", "uploadImg"+imgValue);

      $(".imgUpload3_3").attr("id", "uploadImg"+imgValue+"1");

      $(".imgUpload3_3_3").attr("id", "uploadImg"+imgValue+"2");

      $(".img3").removeClass("d-none").addClass("d-block");
      $('#uploadIcon3').show();
    }
    else if(spacesValue[i] == "Kitchen"){
      document.getElementById("imgName4").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload4").attr("id", "uploadImg"+imgValue);
      
      $(".imgUpload4_4").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload4_4_4").attr("id", "uploadImg"+imgValue+"2");

      $(".img4").removeClass("d-none").addClass("d-block");
      $('#uploadIcon4').show();
    }
    else if(spacesValue[i] == "Laundry Room"){
      document.getElementById("imgName5").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload5").attr("id", "uploadImg"+imgValue);

      $(".imgUpload5_5").attr("id", "uploadImg"+imgValue+"1");

      $(".imgUpload5_5_5").attr("id", "uploadImg"+imgValue+"2");
      
      $(".img5").removeClass("d-none").addClass("d-block");
      $('#uploadIcon5').show();
    }
    else if(spacesValue[i] == "StudyOffice"){
      document.getElementById("imgName6").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload6").attr("id", "uploadImg"+imgValue);

      $(".imgUpload6_6").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload6_6_6").attr("id", "uploadImg"+imgValue+"2");

      $(".img6").removeClass("d-none").addClass("d-block");
      $('#uploadIcon6').show();
    }
    else if(spacesValue[i] == "Entertainment Room"){
      document.getElementById("imgName7").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload7").attr("id", "uploadImg"+imgValue);

      $(".imgUpload7_7").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload7_7_7").attr("id", "uploadImg"+imgValue+"2");
      $(".img7").removeClass("d-none").addClass("d-block");
      $('#uploadIcon7').show();
    }
    else if(spacesValue[i] == "Walk In Closet"){
      document.getElementById("imgName8").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload8").attr("id", "uploadImg"+imgValue);

      $(".imgUpload8_8").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload8_8_8").attr("id", "uploadImg"+imgValue+"2");
      $(".img8").removeClass("d-none").addClass("d-block");
      $('#uploadIcon8').show();
    }
    else if(spacesValue[i] == "Hallways"){
      document.getElementById("imgName9").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload9").attr("id", "uploadImg"+imgValue);

      $(".imgUpload9_9").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload9_9_9").attr("id", "uploadImg"+imgValue+"2");
      $(".img9").removeClass("d-none").addClass("d-block");
      $('#uploadIcon9').show();
    }
    else if(spacesValue[i] == "Staircase"){
      document.getElementById("imgName10").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload10").attr("id", "uploadImg"+imgValue);

      $(".imgUpload10_10").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload10_10_10").attr("id", "uploadImg"+imgValue+"2");
      $(".img10").removeClass("d-none").addClass("d-block");
      $('#uploadIcon10').show();
    }
    else if(spacesValue[i] == "Other"){
      document.getElementById("imgName11").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload11").attr("id", "uploadImg"+imgValue);

      $(".imgUpload11_11").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload11_11_11").attr("id", "uploadImg"+imgValue+"2");
      $(".img11").removeClass("d-none").addClass("d-block");
      $('#uploadIcon11').show();
    }
    else if(spacesValue[i] == "Garden"){
      document.getElementById("imgName12").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload12").attr("id", "uploadImg"+imgValue);

      $(".imgUpload12_12").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload12_12_12").attr("id", "uploadImg"+imgValue+"2");
      $(".img12").removeClass("d-none").addClass("d-block");
      $('#uploadIcon12').show();
    }
    else if(spacesValue[i] == "Outdoor Kitchen"){
      document.getElementById("imgName13").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload13").attr("id", "uploadImg"+imgValue);

      $(".imgUpload13_13").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload13_13_13").attr("id", "uploadImg"+imgValue+"2");
      $(".img13").removeClass("d-none").addClass("d-block");
      $('#uploadIcon13').show();
    }
    else if(spacesValue[i] == "Front Yard"){
      document.getElementById("imgName14").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload14").attr("id", "uploadImg"+imgValue);

      $(".imgUpload14_14").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload14_14_14").attr("id", "uploadImg"+imgValue+"2");
      $(".img14").removeClass("d-none").addClass("d-block");
      $('#uploadIcon14').show();
    }
    else if(spacesValue[i] == "Back Yard"){
      document.getElementById("imgName15").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload15").attr("id", "uploadImg"+imgValue);
      
      $(".imgUpload15_15").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload15_15_15").attr("id", "uploadImg"+imgValue+"2");
      $(".img15").removeClass("d-none").addClass("d-block");
      $('#uploadIcon15').show();
    }
    else if(spacesValue[i] == "Patio"){
      document.getElementById("imgName16").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload16").attr("id", "uploadImg"+imgValue);

      $(".imgUpload16_16").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload16_16_16").attr("id", "uploadImg"+imgValue+"2");
      $(".img16").removeClass("d-none").addClass("d-block");
      $('#uploadIcon16').show();
    }
    else if(spacesValue[i] == "Terrace"){
      document.getElementById("imgName17").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload17").attr("id", "uploadImg"+imgValue);

      $(".imgUpload17_17").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload17_17_17").attr("id", "uploadImg"+imgValue+"2");
      $(".img17").removeClass("d-none").addClass("d-block");
      $('#uploadIcon17').show();
    }
    else if(spacesValue[i] == "Deck"){
      document.getElementById("imgName18").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload18").attr("id", "uploadImg"+imgValue);

      $(".imgUpload18_18").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload18_18_18").attr("id", "uploadImg"+imgValue+"2");
      $(".img18").removeClass("d-none").addClass("d-block");
      $('#uploadIcon18').show();
    }
    else if(spacesValue[i] == "Play Area"){
      document.getElementById("imgName19").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload19").attr("id", "uploadImg"+imgValue);

      $(".imgUpload19_19").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload19_19_19").attr("id", "uploadImg"+imgValue+"2");
      $(".img19").removeClass("d-none").addClass("d-block");
      $('#uploadIcon19').show();
    }
    else if(spacesValue[i] == "Swimming Pool"){
      document.getElementById("imgName20").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload20").attr("id", "uploadImg"+imgValue);

      $(".imgUpload20_20").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload20_20_20").attr("id", "uploadImg"+imgValue+"2");
      $(".img20").removeClass("d-none").addClass("d-block");
      $('#uploadIcon20').show();
    }
    else if(spacesValue[i] == "Driveway"){
      document.getElementById("imgName21").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload21").attr("id", "uploadImg"+imgValue);

      $(".imgUpload21_21").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload21_21_21").attr("id", "uploadImg"+imgValue+"2");
      $(".img21").removeClass("d-none").addClass("d-block");
      $('#uploadIcon21').show();
    }
    else if(spacesValue[i] == "Walkways"){
      document.getElementById("imgName22").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload22").attr("id", "uploadImg"+imgValue);

      $(".imgUpload22_22").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload22_22_22").attr("id", "uploadImg"+imgValue+"2");
      $(".img22").removeClass("d-none").addClass("d-block");
      $('#uploadIcon22').show();
    }
    else if(spacesValue[i] == "Storage Shed"){
      document.getElementById("imgName23").innerHTML =  spacesValue[i];
      var imgValue = spacesValue[i].replace(/\s/g, '');
      $(".imgUpload23").attr("id", "uploadImg"+imgValue);

      $(".imgUpload23_23").attr("id", "uploadImg"+imgValue+"1");
      
      $(".imgUpload23_23_23").attr("id", "uploadImg"+imgValue+"2");
      $(".img23").removeClass("d-none").addClass("d-block");
      $('#uploadIcon23').show();
    }
  }

  if(!spacesValue.includes("Living Room")){
    $('#imgCanvaslivingroom').removeClass("d-block").addClass("d-none");
    $('#image_iconlivingroom').removeClass("d-none").addClass("d-flex");

    $('.img0').removeClass("d-block").addClass("d-none");
    $('#imgCanvas0').removeClass("d-block").addClass("d-none");
    $('#existingImages0').removeClass("d-block").addClass("d-none");
    $('#uploadIcon0').show();
    $('#uploadIcon0').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas00').removeClass("d-block").addClass("d-none");
    $('#existingImages00').removeClass("d-block").addClass("d-none");
    $('#uploadIcon00').show();
    $('#uploadIcon00').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas000').removeClass("d-block").addClass("d-none");
    $('#existingImages000').removeClass("d-block").addClass("d-none");
    $('#uploadIcon000').show();
    $('#uploadIcon000').removeClass("d-none").addClass("d-flex");

    $('#existinglivingroom').removeClass("d-block").addClass("d-none");

    $('.imgUpload0').val('');
    $('.imgUpload00').val('');
    $('.imgUpload000').val('');
  }
  if(!spacesValue.includes("Dining room")){
    $('#imgCanvasdiningroom').removeClass("d-block").addClass("d-none");
    $('#image_icondiningroom').removeClass("d-none").addClass("d-flex");

    $('.img1').removeClass("d-block").addClass("d-none");
    $('#imgCanvas1').removeClass("d-block").addClass("d-none");
    $('#existingImages1').removeClass("d-block").addClass("d-none");
    $('#uploadIcon1').show();
    $('#uploadIcon1').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas1_1').removeClass("d-block").addClass("d-none");
    $('#existingImages1_1').removeClass("d-block").addClass("d-none");
    $('#uploadIcon1_1').show();
    $('#uploadIcon1_1').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas1_1_1').removeClass("d-block").addClass("d-none");
    $('#existingImages1_1_1').removeClass("d-block").addClass("d-none");
    $('#uploadIcon1_1_1').show();
    $('#uploadIcon1_1_1').removeClass("d-none").addClass("d-flex");

    $('#existingdiningroom').removeClass("d-block").addClass("d-none");

    $('.imgUpload1').val('');
    $('.imgUpload1_1').val('');
    $('.imgUpload1_1_1').val('');
  }
  if(!spacesValue.includes("Bedrooms")){
    $('#imgCanvasbedroom').removeClass("d-block").addClass("d-none");
    $('#image_iconbedroom').removeClass("d-none").addClass("d-flex");

    $('.img2').removeClass("d-block").addClass("d-none");
    $('#imgCanvas2').removeClass("d-block").addClass("d-none");
    $('#existingImages2').removeClass("d-block").addClass("d-none");
    $('#uploadIcon2').show();
    $('#uploadIcon2').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas2_2').removeClass("d-block").addClass("d-none");
    $('#existingImages2_2').removeClass("d-block").addClass("d-none");
    $('#uploadIcon2_2').show();
    $('#uploadIcon2_2').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas2_2_2').removeClass("d-block").addClass("d-none");
    $('#existingImages2_2_2').removeClass("d-block").addClass("d-none");
    $('#uploadIcon2_2_2').show();
    $('#uploadIcon2_2_2').removeClass("d-none").addClass("d-flex");

    $('#existingbedroom').removeClass("d-block").addClass("d-none");

    $('.imgUpload2').val('');
    $('.imgUpload2_2').val('');
    $('.imgUpload2_2_2').val('');
  }
  if(!spacesValue.includes("Bathrooms")){
    $('#imgCanvasbathroom').removeClass("d-block").addClass("d-none");
    $('#image_iconbathroom').removeClass("d-none").addClass("d-flex");

    $('.img3').removeClass("d-block").addClass("d-none");
    $('#imgCanvas3').removeClass("d-block").addClass("d-none");
    $('#existingImages3').removeClass("d-block").addClass("d-none");
    $('#uploadIcon3').show();
    $('#uploadIcon3').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas3_3').removeClass("d-block").addClass("d-none");
    $('#existingImages3_3').removeClass("d-block").addClass("d-none");
    $('#uploadIcon3_3').show();
    $('#uploadIcon3_3').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas3_3_3').removeClass("d-block").addClass("d-none");
    $('#existingImages3_3_3').removeClass("d-block").addClass("d-none");
    $('#uploadIcon3_3_3').show();
    $('#uploadIcon3_3_3').removeClass("d-none").addClass("d-flex");

    $('#existingbathroom').removeClass("d-block").addClass("d-none");

    $('.imgUpload3').val('');
    $('.imgUpload3_3').val('');
    $('.imgUpload3_3_3').val('');
  }
  if(!spacesValue.includes("Kitchen")){
    $('#imgCanvaskitchen').removeClass("d-block").addClass("d-none");
    $('#image_iconkitchen').removeClass("d-none").addClass("d-flex");

    $('.img4').removeClass("d-block").addClass("d-none");
    $('#imgCanvas4').removeClass("d-block").addClass("d-none");
    $('#existingImages4').removeClass("d-block").addClass("d-none");
    $('#uploadIcon4').show();
    $('#uploadIcon4').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas4_4').removeClass("d-block").addClass("d-none");
    $('#existingImages4_4').removeClass("d-block").addClass("d-none");
    $('#uploadIcon4_4').show();
    $('#uploadIcon4_4').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas4_4_4').removeClass("d-block").addClass("d-none");
    $('#existingImages4_4_4').removeClass("d-block").addClass("d-none");
    $('#uploadIcon4_4_4').show();
    $('#uploadIcon4_4_4').removeClass("d-none").addClass("d-flex");

    $('#existingkitchen').removeClass("d-block").addClass("d-none");

    $('.imgUpload4').val('');
    $('.imgUpload4_4').val('');
    $('.imgUpload4_4_4').val('');
  }
  if(!spacesValue.includes("Laundry Room")){
    $('#imgCanvasLaundryroom').removeClass("d-block").addClass("d-none");
    $('#image_iconLaundryroom').removeClass("d-none").addClass("d-flex");

    $('.img5').removeClass("d-block").addClass("d-none");
    $('#imgCanvas5').removeClass("d-block").addClass("d-none");
    $('#existingImages5').removeClass("d-block").addClass("d-none");
    $('#uploadIcon5').show();
    $('#uploadIcon5').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas5_5').removeClass("d-block").addClass("d-none");
    $('#existingImages5_5').removeClass("d-block").addClass("d-none");
    $('#uploadIcon5_5').show();
    $('#uploadIcon5_5').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas5_5_5').removeClass("d-block").addClass("d-none");
    $('#existingImages5_5_5').removeClass("d-block").addClass("d-none");
    $('#uploadIcon5_5_5').show();
    $('#uploadIcon5_5_5').removeClass("d-none").addClass("d-flex");

    $('#existingLaundryroom').removeClass("d-block").addClass("d-none");

    $('.imgUpload5').val('');
    $('.imgUpload5_5').val('');
    $('.imgUpload5_5_5').val('');
  }
  if(!spacesValue.includes("StudyOffice")){
    $('#imgCanvasStudyOffice').removeClass("d-block").addClass("d-none");
    $('#image_iconStudyOffice').removeClass("d-none").addClass("d-flex");

    $('.img6').removeClass("d-block").addClass("d-none");
    $('#imgCanvas6').removeClass("d-block").addClass("d-none");
    $('#existingImages6').removeClass("d-block").addClass("d-none");
    $('#uploadIcon6').show();
    $('#uploadIcon6').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas6_6').removeClass("d-block").addClass("d-none");
    $('#existingImages6_6').removeClass("d-block").addClass("d-none");
    $('#uploadIcon6_6').show();
    $('#uploadIcon6_6').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas6_6_6').removeClass("d-block").addClass("d-none");
    $('#existingImages6_6_6').removeClass("d-block").addClass("d-none");
    $('#uploadIcon6_6_6').show();
    $('#uploadIcon6_6_6').removeClass("d-none").addClass("d-flex");

    $('#existingStudyOffice').removeClass("d-block").addClass("d-none");

    $('.imgUpload6').val('');
    $('.imgUpload6_6').val('');
    $('.imgUpload6_6_6').val('');
  }
  if(!spacesValue.includes("Entertainment Room")){
    $('#imgCanvasEntertainmentroom').removeClass("d-block").addClass("d-none");
    $('#image_iconEntertainmentroom').removeClass("d-none").addClass("d-flex");

    $('.img7').removeClass("d-block").addClass("d-none");
    $('#imgCanvas7').removeClass("d-block").addClass("d-none");
    $('#existingImages7').removeClass("d-block").addClass("d-none");
    $('#uploadIcon7').show();
    $('#uploadIcon7').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas7_7').removeClass("d-block").addClass("d-none");
    $('#existingImages7_7').removeClass("d-block").addClass("d-none");
    $('#uploadIcon7_7').show();
    $('#uploadIcon7_7').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas7_7_7').removeClass("d-block").addClass("d-none");
    $('#existingImages7_7_7').removeClass("d-block").addClass("d-none");
    $('#uploadIcon7_7_7').show();
    $('#uploadIcon7_7_7').removeClass("d-none").addClass("d-flex");

    $('#existingEntertainmentroom').removeClass("d-block").addClass("d-none");

    $('.imgUpload7').val('');
    $('.imgUpload7_7').val('');
    $('.imgUpload7_7_7').val('');
  }
  if(!spacesValue.includes("Walk In Closet")){
    $('#imgCanvasWalkInCloset').removeClass("d-block").addClass("d-none");
    $('#image_iconWalkInCloset').removeClass("d-none").addClass("d-flex");

    $('.img8').removeClass("d-block").addClass("d-none");
    $('#imgCanvas8').removeClass("d-block").addClass("d-none");
    $('#existingImages8').removeClass("d-block").addClass("d-none");
    $('#uploadIcon8').show();
    $('#uploadIcon8').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas8_8').removeClass("d-block").addClass("d-none");
    $('#existingImages8_8').removeClass("d-block").addClass("d-none");
    $('#uploadIcon8_8').show();
    $('#uploadIcon8_8').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas8_8_8').removeClass("d-block").addClass("d-none");
    $('#existingImages8_8_8').removeClass("d-block").addClass("d-none");
    $('#uploadIcon8_8_8').show();
    $('#uploadIcon8_8_8').removeClass("d-none").addClass("d-flex");

    $('#existingWalkInCloset').removeClass("d-block").addClass("d-none");

    $('.imgUpload8').val('');
    $('.imgUpload8_8').val('');
    $('.imgUpload8_8_8').val('');
  }
  if(!spacesValue.includes("Hallways")){
    $('#imgCanvasHallways').removeClass("d-block").addClass("d-none");
    $('#image_iconHallways').removeClass("d-none").addClass("d-flex");

    $('.img9').removeClass("d-block").addClass("d-none");
    $('#imgCanvas9').removeClass("d-block").addClass("d-none");
    $('#existingImages9').removeClass("d-block").addClass("d-none");
    $('#uploadIcon9').show();
    $('#uploadIcon9').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas9_9').removeClass("d-block").addClass("d-none");
    $('#existingImages9_9').removeClass("d-block").addClass("d-none");
    $('#uploadIcon9_9').show();
    $('#uploadIcon9_9').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas9_9_9').removeClass("d-block").addClass("d-none");
    $('#existingImages9_9_9').removeClass("d-block").addClass("d-none");
    $('#uploadIcon9_9_9').show();
    $('#uploadIcon9_9_9').removeClass("d-none").addClass("d-flex");

    $('#existingHallways').removeClass("d-block").addClass("d-none");

    $('.imgUpload9').val('');
    $('.imgUpload9_9').val('');
    $('.imgUpload9_9_9').val('');
  }
  if(!spacesValue.includes("Staircase")){
    $('#imgCanvasStaircase').removeClass("d-block").addClass("d-none");
    $('#image_iconStaircase').removeClass("d-none").addClass("d-flex");

    $('.img10').removeClass("d-block").addClass("d-none");
    $('#imgCanvas10').removeClass("d-block").addClass("d-none");
    $('#existingImages10').removeClass("d-block").addClass("d-none");
    $('#uploadIcon10').show();
    $('#uploadIcon10').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas10_10').removeClass("d-block").addClass("d-none");
    $('#existingImages10_10').removeClass("d-block").addClass("d-none");
    $('#uploadIcon10_10').show();
    $('#uploadIcon10_10').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas10_10_10').removeClass("d-block").addClass("d-none");
    $('#existingImages10_10_10').removeClass("d-block").addClass("d-none");
    $('#uploadIcon10_10_10').show();
    $('#uploadIcon10_10_10').removeClass("d-none").addClass("d-flex");

    $('#existingStaircase').removeClass("d-block").addClass("d-none");

    $('.imgUpload10').val('');
    $('.imgUpload10_10').val('');
    $('.imgUpload10_10_10').val('');
  }
  if(!spacesValue.includes("Other")){
    $('#imgCanvasOther').removeClass("d-block").addClass("d-none");
    $('#image_iconOther').removeClass("d-none").addClass("d-flex");

    $('.img11').removeClass("d-block").addClass("d-none");
    $('#imgCanvas11').removeClass("d-block").addClass("d-none");
    $('#existingImages11').removeClass("d-block").addClass("d-none");
    $('#uploadIcon11').show();
    $('#uploadIcon11').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas11_11').removeClass("d-block").addClass("d-none");
    $('#existingImages11_11').removeClass("d-block").addClass("d-none");
    $('#uploadIcon11_11').show();
    $('#uploadIcon11_11').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas11_11_11').removeClass("d-block").addClass("d-none");
    $('#existingImages11_11_11').removeClass("d-block").addClass("d-none");
    $('#uploadIcon11_11_11').show();
    $('#uploadIcon11_11_11').removeClass("d-none").addClass("d-flex");

    $('#existingOther').removeClass("d-block").addClass("d-none");

    $('.imgUpload11').val('');
    $('.imgUpload11_11').val('');
    $('.imgUpload11_11_11').val('');
  }
  if(!spacesValue.includes("Garden")){
    $('#imgCanvasGarden').removeClass("d-block").addClass("d-none");
    $('#image_iconGarden').removeClass("d-none").addClass("d-flex");

    $('.img12').removeClass("d-block").addClass("d-none");
    $('#imgCanvas12').removeClass("d-block").addClass("d-none");
    $('#existingImages12').removeClass("d-block").addClass("d-none");
    $('#uploadIcon12').show();
    $('#uploadIcon12').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas12_12').removeClass("d-block").addClass("d-none");
    $('#existingImages12_12').removeClass("d-block").addClass("d-none");
    $('#uploadIcon12_12').show();
    $('#uploadIcon12_12').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas12_12_12').removeClass("d-block").addClass("d-none");
    $('#existingImages12_12_12').removeClass("d-block").addClass("d-none");
    $('#uploadIcon12_12_12').show();
    $('#uploadIcon12_12_12').removeClass("d-none").addClass("d-flex");

    $('#existingGarden').removeClass("d-block").addClass("d-none");

    $('.imgUpload12').val('');
    $('.imgUpload12_12').val('');
    $('.imgUpload12_12_12').val('');
  }
  if(!spacesValue.includes("Outdoor Kitchen")){
    $('#imgCanvasOutdoorkitchen').removeClass("d-block").addClass("d-none");
    $('#image_iconOutdoorkitchen').removeClass("d-none").addClass("d-flex");

    $('.img13').removeClass("d-block").addClass("d-none");
    $('#imgCanvas13').removeClass("d-block").addClass("d-none");
    $('#existingImages13').removeClass("d-block").addClass("d-none");
    $('#uploadIcon13').show();
    $('#uploadIcon13').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas13_13').removeClass("d-block").addClass("d-none");
    $('#existingImages13_13').removeClass("d-block").addClass("d-none");
    $('#uploadIcon13_13').show();
    $('#uploadIcon13_13').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas13_13_13').removeClass("d-block").addClass("d-none");
    $('#existingImages13_13_13').removeClass("d-block").addClass("d-none");
    $('#uploadIcon13_13_13').show();
    $('#uploadIcon13_13_13').removeClass("d-none").addClass("d-flex");

    $('#existingOutdoorkitchen').removeClass("d-block").addClass("d-none");

    $('.imgUpload13').val('');
    $('.imgUpload13_13').val('');
    $('.imgUpload13_13_13').val('');
  }
  if(!spacesValue.includes("Front Yard")){
    $('#imgCanvasFrontyard').removeClass("d-block").addClass("d-none");
    $('#image_iconFrontyard').removeClass("d-none").addClass("d-flex");

    $('.img14').removeClass("d-block").addClass("d-none");
    $('#imgCanvas14').removeClass("d-block").addClass("d-none");
    $('#existingImages14').removeClass("d-block").addClass("d-none");
    $('#uploadIcon14').show();
    $('#uploadIcon14').removeClass("d-none").addClass("d-flex");
    
    $('#imgCanvas14_14').removeClass("d-block").addClass("d-none");
    $('#existingImages14_14').removeClass("d-block").addClass("d-none");
    $('#uploadIcon14_14').show();
    $('#uploadIcon14_14').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas14_14_14').removeClass("d-block").addClass("d-none");
    $('#existingImages14_14_14').removeClass("d-block").addClass("d-none");
    $('#uploadIcon14_14_14').show();
    $('#uploadIcon14_14_14').removeClass("d-none").addClass("d-flex");

    $('#existingFrontyard').removeClass("d-block").addClass("d-none");

    $('.imgUpload14').val('');
    $('.imgUpload14_14').val('');
    $('.imgUpload14_14_14').val('');
  }
  if(!spacesValue.includes("Back Yard")){
    $('#imgCanvasBackyard').removeClass("d-block").addClass("d-none");
    $('#image_iconBackyard').removeClass("d-none").addClass("d-flex");

    $('.img15').removeClass("d-block").addClass("d-none");
    $('#imgCanvas15').removeClass("d-block").addClass("d-none");
    $('#existingImages15').removeClass("d-block").addClass("d-none");
    $('#uploadIcon15').show();
    $('#uploadIcon15').removeClass("d-none").addClass("d-flex");
    
    $('#imgCanvas15_15').removeClass("d-block").addClass("d-none");
    $('#existingImages15_15').removeClass("d-block").addClass("d-none");
    $('#uploadIcon15_15').show();
    $('#uploadIcon15_15').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas15_15_15').removeClass("d-block").addClass("d-none");
    $('#existingImages15_15_15').removeClass("d-block").addClass("d-none");
    $('#uploadIcon15_15_15').show();
    $('#uploadIcon15_15_15').removeClass("d-none").addClass("d-flex");

    $('#existingBackyard').removeClass("d-block").addClass("d-none");

    $('.imgUpload15').val('');
    $('.imgUpload15_15').val('');
    $('.imgUpload15_15_15').val('');
  }
  if(!spacesValue.includes("Patio")){
    $('#imgCanvasPatio').removeClass("d-block").addClass("d-none");
    $('#image_iconPatio').removeClass("d-none").addClass("d-flex");

    $('.img16').removeClass("d-block").addClass("d-none");
    $('#imgCanvas16').removeClass("d-block").addClass("d-none");
    $('#existingImages16').removeClass("d-block").addClass("d-none");
    $('#uploadIcon16').show();
    $('#uploadIcon16').removeClass("d-none").addClass("d-flex");
     
    $('#imgCanvas16_16').removeClass("d-block").addClass("d-none");
    $('#existingImages16_16').removeClass("d-block").addClass("d-none");
    $('#uploadIcon16_16').show();
    $('#uploadIcon16_16').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas16_16_16').removeClass("d-block").addClass("d-none");
    $('#existingImages16_16_16').removeClass("d-block").addClass("d-none");
    $('#uploadIcon16_16_16').show();
    $('#uploadIcon16_16_16').removeClass("d-none").addClass("d-flex");

    $('#existingPatio').removeClass("d-block").addClass("d-none");

    $('.imgUpload16').val('');
    $('.imgUpload16_16').val('');
    $('.imgUpload16_16_16').val('');
  }
  if(!spacesValue.includes("Terrace")){
    $('#imgCanvasTerrace').removeClass("d-block").addClass("d-none");
    $('#image_iconTerrace').removeClass("d-none").addClass("d-flex");
    
    $('.img17').removeClass("d-block").addClass("d-none");
    $('#imgCanvas17').removeClass("d-block").addClass("d-none");
    $('#existingImages17').removeClass("d-block").addClass("d-none");
    $('#uploadIcon17').show();
    $('#uploadIcon17').removeClass("d-none").addClass("d-flex");
     
    $('#imgCanvas17_17').removeClass("d-block").addClass("d-none");
    $('#existingImages17_17').removeClass("d-block").addClass("d-none");
    $('#uploadIcon17_17').show();
    $('#uploadIcon17_17').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas17_17_17').removeClass("d-block").addClass("d-none");
    $('#existingImages17_17_17').removeClass("d-block").addClass("d-none");
    $('#uploadIcon17_17_17').show();
    $('#uploadIcon17_17_17').removeClass("d-none").addClass("d-flex");

    $('#existingTerrace').removeClass("d-block").addClass("d-none");

    $('.imgUpload17').val('');
    $('.imgUpload17_17').val('');
    $('.imgUpload17_17_17').val('');
  }
  if(!spacesValue.includes("Deck")){
    $('#imgCanvasDeck').removeClass("d-block").addClass("d-none");
    $('#image_iconDeck').removeClass("d-none").addClass("d-flex");

    $('.img18').removeClass("d-block").addClass("d-none");
    $('#imgCanvas18').removeClass("d-block").addClass("d-none");
    $('#existingImages18').removeClass("d-block").addClass("d-none");
    $('#uploadIcon18').show();
    $('#uploadIcon18').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas18_18').removeClass("d-block").addClass("d-none");
    $('#existingImages18_18').removeClass("d-block").addClass("d-none");
    $('#uploadIcon18_18').show();
    $('#uploadIcon18_18').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas18_18_18').removeClass("d-block").addClass("d-none");
    $('#existingImages18_18_18').removeClass("d-block").addClass("d-none");
    $('#uploadIcon18_18_18').show();
    $('#uploadIcon18_18_18').removeClass("d-none").addClass("d-flex");

    $('#existingDeck').removeClass("d-block").addClass("d-none");

    $('.imgUpload18').val('');
    $('.imgUpload18_18').val('');
    $('.imgUpload18_18_18').val('');
  }
  if(!spacesValue.includes("Play Area")){
    $('#imgCanvasPlayarea').removeClass("d-block").addClass("d-none");
    $('#image_iconPlayarea').removeClass("d-none").addClass("d-flex");
    
    $('.img19').removeClass("d-block").addClass("d-none");
    $('#imgCanvas19').removeClass("d-block").addClass("d-none");
    $('#existingImages19').removeClass("d-block").addClass("d-none");
    $('#uploadIcon19').show();
    $('#uploadIcon19').removeClass("d-none").addClass("d-flex");
     
    $('#imgCanvas19_19').removeClass("d-block").addClass("d-none");
    $('#existingImages19_19').removeClass("d-block").addClass("d-none");
    $('#uploadIcon19_19').show();
    $('#uploadIcon19_19').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas19_19_19').removeClass("d-block").addClass("d-none");
    $('#existingImages19_19_19').removeClass("d-block").addClass("d-none");
    $('#uploadIcon19_19_19').show();
    $('#uploadIcon19_19_19').removeClass("d-none").addClass("d-flex");

    $('#existingPlayarea').removeClass("d-block").addClass("d-none");

    $('.imgUpload19').val('');
    $('.imgUpload19_19').val('');
    $('.imgUpload19_19_19').val('');
  }
  if(!spacesValue.includes("Swimming Pool")){
    $('#imgCanvasSwimmingpool').removeClass("d-block").addClass("d-none");
    $('#image_iconSwimmingpool').removeClass("d-none").addClass("d-flex");

    $('.img20').removeClass("d-block").addClass("d-none");
    $('#imgCanvas20').removeClass("d-block").addClass("d-none");
    $('#existingImages20').removeClass("d-block").addClass("d-none");
    $('#uploadIcon20').show();
    $('#uploadIcon20').removeClass("d-none").addClass("d-flex");
    
    $('#imgCanvas20_20').removeClass("d-block").addClass("d-none");
    $('#existingImages20_20').removeClass("d-block").addClass("d-none");
    $('#uploadIcon20_20').show();
    $('#uploadIcon20_20').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas20_20_20').removeClass("d-block").addClass("d-none");
    $('#existingImages20_20_20').removeClass("d-block").addClass("d-none");
    $('#uploadIcon20_20_20').show();
    $('#uploadIcon20_20_20').removeClass("d-none").addClass("d-flex");

    $('#existingSwimmingpool').removeClass("d-block").addClass("d-none");

    $('.imgUpload20').val('');
    $('.imgUpload20_20').val('');
    $('.imgUpload20_20_20').val('');
  }
  if(!spacesValue.includes("Driveway")){
    $('#imgCanvasDriveway').removeClass("d-block").addClass("d-none");
    $('#image_iconDriveway').removeClass("d-none").addClass("d-flex");

    $('.img21').removeClass("d-block").addClass("d-none");
    $('#imgCanvas21').removeClass("d-block").addClass("d-none");
    $('#existingImages21').removeClass("d-block").addClass("d-none");
    $('#uploadIcon21').show();
    $('#uploadIcon21').removeClass("d-none").addClass("d-flex");
    
    $('#imgCanvas21_21').removeClass("d-block").addClass("d-none");
    $('#existingImages21_21').removeClass("d-block").addClass("d-none");
    $('#uploadIcon21_21').show();
    $('#uploadIcon21_21').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas21_21_21').removeClass("d-block").addClass("d-none");
    $('#existingImages21_21_21').removeClass("d-block").addClass("d-none");
    $('#uploadIcon21_21_21').show();
    $('#uploadIcon21_21_21').removeClass("d-none").addClass("d-flex");

    $('#existingDriveway').removeClass("d-block").addClass("d-none");

    $('.imgUpload21').val('');
    $('.imgUpload21_21').val('');
    $('.imgUpload21_21_21').val('');
  }
  if(!spacesValue.includes("Walkways")){
    $('#imgCanvasWalkways').removeClass("d-block").addClass("d-none");
    $('#image_iconWalkways').removeClass("d-none").addClass("d-flex");

    $('.img22').removeClass("d-block").addClass("d-none");
    $('#imgCanvas22').removeClass("d-block").addClass("d-none");
    $('#existingImages22').removeClass("d-block").addClass("d-none");
    $('#uploadIcon22').show();
    $('#uploadIcon22').removeClass("d-none").addClass("d-flex");
    
    $('#imgCanvas22_22').removeClass("d-block").addClass("d-none");
    $('#existingImages22_22').removeClass("d-block").addClass("d-none");
    $('#uploadIcon22_22').show();
    $('#uploadIcon22_22').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas22_22_22').removeClass("d-block").addClass("d-none");
    $('#existingImages22_22_22').removeClass("d-block").addClass("d-none");
    $('#uploadIcon22_22_22').show();
    $('#uploadIcon22_22_22').removeClass("d-none").addClass("d-flex");

    $('#existingWalkways').removeClass("d-block").addClass("d-none");

    $('.imgUpload22').val('');
    $('.imgUpload22_22').val('');
    $('.imgUpload22_22_22').val('');
  }
  if(!spacesValue.includes("Storage Shed")){
    $('#imgCanvasStorageshed').removeClass("d-block").addClass("d-none");
    $('#image_iconStorageshed').removeClass("d-none").addClass("d-flex");

    $('.img23').removeClass("d-block").addClass("d-none");
    $('#imgCanvas23').removeClass("d-block").addClass("d-none");
    $('#existingImages23').removeClass("d-block").addClass("d-none");
    $('#uploadIcon23').show();
    $('#uploadIcon23').removeClass("d-none").addClass("d-flex");
    
    $('#imgCanvas23_23').removeClass("d-block").addClass("d-none");
    $('#existingImages23_23').removeClass("d-block").addClass("d-none");
    $('#uploadIcon23_23').show();
    $('#uploadIcon23_23').removeClass("d-none").addClass("d-flex");

    $('#imgCanvas23_23_23').removeClass("d-block").addClass("d-none");
    $('#existingImages23_23_23').removeClass("d-block").addClass("d-none");
    $('#uploadIcon23_23_23').show();
    $('#uploadIcon23_23_23').removeClass("d-none").addClass("d-flex");

    $('#existingStorageshed').removeClass("d-block").addClass("d-none");

    $('.imgUpload23').val('');
    $('.imgUpload23_23').val('');
    $('.imgUpload23_23_23').val('');
  }

  if (spacesValue.length > 1) {
    $('#sDiv').css("background-color", "#f3f6fb");
    $('#btn_Spaces').attr('src', '../imgs/done.png');

    if($('#btnProperty').attr('src') != '../imgs/done.png'){
      $('#piDiv').css("background-color", "#f3f6fb");
      $('#btnProperty').attr('src', '../imgs/add1.png');
    }
    if($('#btnDetails').attr('src') != '../imgs/done.png'){
      $('#dDiv').css("background-color", "#f3f6fb");
      $('#btnDetails').attr('src', '../imgs/add1.png');
    }
    if($('#btnPhotos').attr('src') == '../imgs/done.png'){
      $('#btnPhotos').attr('src', '../imgs/add2.png');

    if($('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none') && $('.img0').hasClass('d-block') || 
      $('#imgCanvasdiningroom').hasClass('d-none') && $('#existingdiningroom').hasClass('d-none') && $('.img1').hasClass('d-block') || 
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
    if($('#btnFeatured').attr('src') != '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    if($('#btnLocation').attr('src') != '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    if($('#btnContact').attr('src') != '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }


    if($('#btnProperty').attr('src') != '../imgs/done.png'){
      $('#btnProperty').attr('src', '../imgs/add2.png');
    }
    else if($('#btnDetails').attr('src') != '../imgs/done.png'){
      $('#btnDetails').attr('src', '../imgs/add2.png');
    }
    else if($('#btnPhotos').attr('src') != '../imgs/done.png'){
      $('#btnPhotos').attr('src', '../imgs/add2.png');
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
  else{
    $('#sDiv').css("background-color", "#DDE0FF");
    $('#btn_Spaces').attr('src', '../imgs/add2.png');

    if($('#btnProperty').attr('src') != '../imgs/done.png'){
      $('#piDiv').css("background-color", "#f3f6fb");
      $('#btnProperty').attr('src', '../imgs/add1.png');
    }
    if($('#btnDetails').attr('src') != '../imgs/done.png'){
      $('#dDiv').css("background-color", "#f3f6fb");
      $('#btnDetails').attr('src', '../imgs/add1.png');
    }
    if($('#btnPhotos').attr('src') == '../imgs/done.png'){
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    if($('#btnFeatured').attr('src') != '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    if($('#btnLocation').attr('src') != '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    if($('#btnContact').attr('src') != '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
  }
} 
function showcheck(){
  $('#btnPhotos').attr('src', '../imgs/done.png');
  $('#btnFeatured').attr('src', '../imgs/done.png');
}
//uploading image function
//to automatically click the <input type="file">

//Living room
$('#img_upload0').click(function (){
  $('.imgUpload0').click();
});
$('#img_upload00').click(function (){
  $('.imgUpload00').click();
});
$('#img_upload000').click(function (){
  $('.imgUpload000').click();
});
$('#img_upload1').click(function (){
  $('.imgUpload1').click();
});
$('#img_upload1_1').click(function (){
  $('.imgUpload1_1').click();
});
$('#img_upload1_1_1').click(function (){
  $('.imgUpload1_1_1').click();
});
$('#img_upload2').click(function (){
  $('.imgUpload2').click();
});
$('#img_upload2_2').click(function (){
  $('.imgUpload2_2').click();
});
$('#img_upload2_2_2').click(function (){
  $('.imgUpload2_2_2').click();
});
$('#img_upload3').click(function (){
  $('.imgUpload3').click();
});
$('#img_upload3_3').click(function (){
  $('.imgUpload3_3').click();
});
$('#img_upload3_3_3').click(function (){
  $('.imgUpload3_3_3').click();
});
$('#img_upload4').click(function (){
  $('.imgUpload4').click();
});
$('#img_upload4_4').click(function (){
  $('.imgUpload4_4').click();
});
$('#img_upload4_4_4').click(function (){
  $('.imgUpload4_4_4').click();
});
$('#img_upload5').click(function (){
  $('.imgUpload5').click();
});
$('#img_upload5_5').click(function (){
  $('.imgUpload5_5').click();
});
$('#img_upload5_5_5').click(function (){
  $('.imgUpload5_5_5').click();
});
$('#img_upload6').click(function (){
  $('.imgUpload6').click();
});
$('#img_upload6_6').click(function (){
  $('.imgUpload6_6').click();
});
$('#img_upload6_6_6').click(function (){
  $('.imgUpload6_6_6').click();
});
$('#img_upload7').click(function (){
  $('.imgUpload7').click();
});
$('#img_upload7_7').click(function (){
  $('.imgUpload7_7').click();
});
$('#img_upload7_7_7').click(function (){
  $('.imgUpload7_7_7').click();
});
$('#img_upload8').click(function (){
  $('.imgUpload8').click();
});
$('#img_upload8_8').click(function (){
  $('.imgUpload8_8').click();
});
$('#img_upload8_8_8').click(function (){
  $('.imgUpload8_8_8').click();
});
$('#img_upload9').click(function (){
  $('.imgUpload9').click();
});
$('#img_upload9_9').click(function (){
  $('.imgUpload9_9').click();
});
$('#img_upload9_9_9').click(function (){
  $('.imgUpload9_9_9').click();
});
$('#img_upload10').click(function (){
  $('.imgUpload10').click();
});
$('#img_upload10_10').click(function (){
  $('.imgUpload10_10').click();
});
$('#img_upload10_10_10').click(function (){
  $('.imgUpload10_10_10').click();
});
$('#img_upload11').click(function (){
  $('.imgUpload11').click();
});
$('#img_upload11_11').click(function (){
  $('.imgUpload11_11').click();
});
$('#img_upload11_11_11').click(function (){
  $('.imgUpload11_11_11').click();
});
$('#img_upload12').click(function (){
  $('.imgUpload12').click();
});
$('#img_upload12_12').click(function (){
  $('.imgUpload12_12').click();
});
$('#img_upload12_12_12').click(function (){
  $('.imgUpload12_12_12').click();
});
$('#img_upload13').click(function (){
  $('.imgUpload13').click();
});
$('#img_upload13_13').click(function (){
  $('.imgUpload13_13').click();
});
$('#img_upload13_13_13').click(function (){
  $('.imgUpload13_13_13').click();
});
$('#img_upload14').click(function (){
  $('.imgUpload14').click();
});
$('#img_upload14_14').click(function (){
  $('.imgUpload14_14').click();
});
$('#img_upload14_14_14').click(function (){
  $('.imgUpload14_14_14').click();
});
$('#img_upload15').click(function (){
  $('.imgUpload15').click();
});
$('#img_upload15_15').click(function (){
  $('.imgUpload15_15').click();
});
$('#img_upload15_15_15').click(function (){
  $('.imgUpload15_15_15').click();
});
$('#img_upload16').click(function (){
  $('.imgUpload16').click();
});
$('#img_upload16_16').click(function (){
  $('.imgUpload16_16').click();
});
$('#img_upload16_16_16').click(function (){
  $('.imgUpload16_16_16').click();
});
$('#img_upload17').click(function (){
  $('.imgUpload17').click();
});
$('#img_upload17_17').click(function (){
  $('.imgUpload17_17').click();
});
$('#img_upload17_17_17').click(function (){
  $('.imgUpload17_17_17').click();
});
$('#img_upload18').click(function (){
  $('.imgUpload18').click();
});
$('#img_upload18_18').click(function (){
  $('.imgUpload18_18').click();
});
$('#img_upload18_18_18').click(function (){
  $('.imgUpload18_18_18').click();
});
$('#img_upload19').click(function (){
  $('.imgUpload19').click();
});
$('#img_upload19_19').click(function (){
  $('.imgUpload19_19').click();
});
$('#img_upload19_19_19').click(function (){
  $('.imgUpload19_19_19').click();
});
$('#img_upload20').click(function (){
  $('.imgUpload20').click();
});
$('#img_upload20_20').click(function (){
  $('.imgUpload20_20').click();
});
$('#img_upload20_20_20').click(function (){
  $('.imgUpload20_20_20').click();
});
$('#img_upload21').click(function (){
  $('.imgUpload21').click();
});
$('#img_upload21_21').click(function (){
  $('.imgUpload21_21').click();
});
$('#img_upload21_21_21').click(function (){
  $('.imgUpload21_21_21').click();
});
$('#img_upload22').click(function (){
  $('.imgUpload22').click();
});
$('#img_upload22_22').click(function (){
  $('.imgUpload22_22').click();
});
$('#img_upload22_22_22').click(function (){
  $('.imgUpload22_22_22').click();
});
$('#img_upload23').click(function (){
  $('.imgUpload23').click();
});
$('#img_upload23_23').click(function (){
  $('.imgUpload23_23').click();
});
$('#img_upload23_23_23').click(function (){
  $('.imgUpload23_23_23').click();
});
//if the user uploaded a file this function will be 

//Living room
$('.imgUpload0').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload0').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas0');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
            $('#uploadIcon0').removeClass("d-block").addClass("d-none");
            $('#existingImages0').removeClass("d-block").addClass("d-none");
            $('#imgCanvas0').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload00').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload00').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas00');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
            $('#uploadIcon00').removeClass("d-block").addClass("d-none");
            $('#existingImages00').removeClass("d-block").addClass("d-none");
            $('#imgCanvas00').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload000').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload000').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas000');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon000').removeClass("d-block").addClass("d-none");
          $('#existingImages000').removeClass("d-block").addClass("d-none");
          $('#imgCanvas000').removeClass("d-none").addClass("d-block");
          }
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
//Dining room
$('.imgUpload1').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload1').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas1');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon1').removeClass("d-block").addClass("d-none");
          $('#existingImages1').removeClass("d-block").addClass("d-none");
          $('#imgCanvas1').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload1_1').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload1_1').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas1_1');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon1_1').removeClass("d-block").addClass("d-none");
          $('#existingImages1_1').removeClass("d-block").addClass("d-none");
          $('#imgCanvas1_1').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload1_1_1').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload1_1_1').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas1_1_1');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon1_1_1').removeClass("d-block").addClass("d-none");
          $('#existingImages1_1_1').removeClass("d-block").addClass("d-none");
          $('#imgCanvas1_1_1').removeClass("d-none").addClass("d-block");
          }
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
//Bed room
$('.imgUpload2').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload2').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas2');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon2').removeClass("d-block").addClass("d-none");
          $('#existingImages2').removeClass("d-block").addClass("d-none");
          $('#imgCanvas2').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload2_2').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload2_2').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas2_2');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon2_2').removeClass("d-block").addClass("d-none");
          $('#existingImages2_2').removeClass("d-block").addClass("d-none");
          $('#imgCanvas2_2').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload2_2_2').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload2_2_2').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas2_2_2');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon2_2_2').removeClass("d-block").addClass("d-none");
          $('#existingImages2_2_2').removeClass("d-block").addClass("d-none");
          $('#imgCanvas2_2_2').removeClass("d-none").addClass("d-block");
          }
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
//bathroom
$('.imgUpload3').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload3').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas3');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon3').removeClass("d-block").addClass("d-none");
          $('#existingImages3').removeClass("d-block").addClass("d-none");
          $('#imgCanvas3').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload3_3').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload3_3').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas3_3');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon3_3').removeClass("d-block").addClass("d-none");
          $('#existingImages3_3').removeClass("d-block").addClass("d-none");
          $('#imgCanvas3_3').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload3_3_3').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload3_3_3').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas3_3_3');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon3_3_3').removeClass("d-block").addClass("d-none");
          $('#existingImages3_3_3').removeClass("d-block").addClass("d-none");
          $('#imgCanvas3_3_3').removeClass("d-none").addClass("d-block");
          }
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
//kitchen
$('.imgUpload4').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload4').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas4');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon4').removeClass("d-block").addClass("d-none");
          $('#existingImages4').removeClass("d-block").addClass("d-none");
          $('#imgCanvas4').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload4_4').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload4_4').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas4_4');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon4_4').removeClass("d-block").addClass("d-none");
          $('#existingImages4_4').removeClass("d-block").addClass("d-none");
          $('#imgCanvas4_4').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload4_4_4').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload4_4_4').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas4_4_4');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon4_4_4').removeClass("d-block").addClass("d-none");
          $('#existingImages4_4_4').removeClass("d-block").addClass("d-none");
          $('#imgCanvas4_4_4').removeClass("d-none").addClass("d-block");
          }
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
//laundry room
$('.imgUpload5').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload5').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas5');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon5').removeClass("d-block").addClass("d-none");
          $('#existingImages5').removeClass("d-block").addClass("d-none");
          $('#imgCanvas5').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload5_5').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload5_5').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas5_5');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon5_5').removeClass("d-block").addClass("d-none");
          $('#existingImages5_5').removeClass("d-block").addClass("d-none");
          $('#imgCanvas5_5').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload5_5_5').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload5_5_5').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas5_5_5');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon5_5_5').removeClass("d-block").addClass("d-none");
          $('#existingImages5_5_5').removeClass("d-block").addClass("d-none");
          $('#imgCanvas5_5_5').removeClass("d-none").addClass("d-block");
          }
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
//study office
$('.imgUpload6').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload6').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas6');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon6').removeClass("d-block").addClass("d-none");
          $('#existingImages6').removeClass("d-block").addClass("d-none");
          $('#imgCanvas6').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload6_6').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload6_6').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas6_6');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon6_6').removeClass("d-block").addClass("d-none");
          $('#existingImages6_6').removeClass("d-block").addClass("d-none");
          $('#imgCanvas6_6').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload6_6_6').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload6_6_6').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas6_6_6');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon6_6_6').removeClass("d-block").addClass("d-none");
          $('#existingImages6_6_6').removeClass("d-block").addClass("d-none");
          $('#imgCanvas6_6_6').removeClass("d-none").addClass("d-block");
          }
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
//entertainment
$('.imgUpload7').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload7').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas7');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon7').removeClass("d-block").addClass("d-none");
          $('#existingImages7').removeClass("d-block").addClass("d-none");
          $('#imgCanvas7').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload7_7').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload7_7').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas7_7');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon7_7').removeClass("d-block").addClass("d-none");
          $('#existingImages7_7').removeClass("d-block").addClass("d-none");
          $('#imgCanvas7_7').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload7_7_7').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload7_7_7').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas7_7_7');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon7_7_7').removeClass("d-block").addClass("d-none");
          $('#existingImages7_7_7').removeClass("d-block").addClass("d-none");
          $('#imgCanvas7_7_7').removeClass("d-none").addClass("d-block");
          }
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
//walk in closet
$('.imgUpload8').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload8').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas8');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon8').removeClass("d-block").addClass("d-none");
          $('#existingImages8').removeClass("d-block").addClass("d-none");
          $('#imgCanvas8').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload8_8').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload8_8').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas8_8');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon8_8').removeClass("d-block").addClass("d-none");
          $('#existingImages8_8').removeClass("d-block").addClass("d-none");
          $('#imgCanvas8_8').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload8_8_8').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload8_8_8').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas8_8_8');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon8_8_8').removeClass("d-block").addClass("d-none");
          $('#existingImages8_8_8').removeClass("d-block").addClass("d-none");
          $('#imgCanvas8_8_8').removeClass("d-none").addClass("d-block");
          }
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
//hallways
$('.imgUpload9').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload9').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas9');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon9').removeClass("d-block").addClass("d-none");
          $('#existingImages9').removeClass("d-block").addClass("d-none");
          $('#imgCanvas9').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload9_9').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload9_9').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas9_9');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon9_9').removeClass("d-block").addClass("d-none");
          $('#existingImages9_9').removeClass("d-block").addClass("d-none");
          $('#imgCanvas9_9').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload9_9_9').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload9_9_9').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas9_9_9');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon9_9_9').removeClass("d-block").addClass("d-none");
          $('#existingImages9_9_9').removeClass("d-block").addClass("d-none");
          $('#imgCanvas9_9_9').removeClass("d-none").addClass("d-block");
          }
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
//staircase
$('.imgUpload10').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload10').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas10');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon10').removeClass("d-block").addClass("d-none");
          $('#existingImages10').removeClass("d-block").addClass("d-none");
          $('#imgCanvas10').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload10_10').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload10_10').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas10_10');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon10_10').removeClass("d-block").addClass("d-none");
          $('#existingImages10_10').removeClass("d-block").addClass("d-none");
          $('#imgCanvas10_10').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload10_10_10').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload10_10_10').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas10_10_10');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon10_10_10').removeClass("d-block").addClass("d-none");
          $('#existingImages10_10_10').removeClass("d-block").addClass("d-none");
          $('#imgCanvas10_10_10').removeClass("d-none").addClass("d-block");
          }
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
//other
$('.imgUpload11').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload11').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas11');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon11').removeClass("d-block").addClass("d-none");
          $('#existingImages11').removeClass("d-block").addClass("d-none");
          $('#imgCanvas11').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload11_11').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload11_11').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas11_11');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon11_11').removeClass("d-block").addClass("d-none");
          $('#existingImages11_11').removeClass("d-block").addClass("d-none");
          $('#imgCanvas11_11').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload11_11_11').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload11_11_11').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas11_11_11');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon11_11_11').removeClass("d-block").addClass("d-none");
          $('#existingImages11_11_11').removeClass("d-block").addClass("d-none");
          $('#imgCanvas11_11_11').removeClass("d-none").addClass("d-block");
          }
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
//garden
$('.imgUpload12').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload12').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas12');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon12').removeClass("d-block").addClass("d-none");
          $('#existingImages12').removeClass("d-block").addClass("d-none");
          $('#imgCanvas12').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload12_12').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload12_12').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas12_12');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon12_12').removeClass("d-block").addClass("d-none");
          $('#existingImages12_12').removeClass("d-block").addClass("d-none");
          $('#imgCanvas12_12').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload12_12_12').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload12_12_12').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas12_12_12');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon12_12_12').removeClass("d-block").addClass("d-none");
          $('#existingImages12_12_12').removeClass("d-block").addClass("d-none");
          $('#imgCanvas12_12_12').removeClass("d-none").addClass("d-block");
          }
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
//outdoor kitchen
$('.imgUpload13').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload13').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas13');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon13').removeClass("d-block").addClass("d-none");
          $('#existingImages13').removeClass("d-block").addClass("d-none");
          $('#imgCanvas13').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload13_13').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload13_13').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas13_13');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon13_13').removeClass("d-block").addClass("d-none");
          $('#existingImages13_13').removeClass("d-block").addClass("d-none");
          $('#imgCanvas13_13').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload13_13_13').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload13_13_13').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas13_13_13');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon13_13_13').removeClass("d-block").addClass("d-none");
          $('#existingImages13_13_13').removeClass("d-block").addClass("d-none");
          $('#imgCanvas13_13_13').removeClass("d-none").addClass("d-block");
          }
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
//front yard
$('.imgUpload14').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload14').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas14');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon14').removeClass("d-block").addClass("d-none");
          $('#existingImages14').removeClass("d-block").addClass("d-none");
          $('#imgCanvas14').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload14_14').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload14_14').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas14_14');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon14_14').removeClass("d-block").addClass("d-none");
          $('#existingImages14_14').removeClass("d-block").addClass("d-none");
          $('#imgCanvas14_14').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload14_14_14').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload14_14_14').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas14_14_14');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon14_14_14').removeClass("d-block").addClass("d-none");
          $('#existingImages14_14_14').removeClass("d-block").addClass("d-none");
          $('#imgCanvas14_14_14').removeClass("d-none").addClass("d-block");
          }
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
//back yard
$('.imgUpload15').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload15').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas15');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon15').removeClass("d-block").addClass("d-none");
          $('#existingImages15').removeClass("d-block").addClass("d-none");
          $('#imgCanvas15').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload15_15').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload15_15').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas15_15');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon15_15').removeClass("d-block").addClass("d-none");
          $('#existingImages15_15').removeClass("d-block").addClass("d-none");
          $('#imgCanvas15_15').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload15_15_15').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload15_15_15').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas15_15_15');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon15_15_15').removeClass("d-block").addClass("d-none");
          $('#existingImages15_15_15').removeClass("d-block").addClass("d-none");
          $('#imgCanvas15_15_15').removeClass("d-none").addClass("d-block");
          }
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
//patio
$('.imgUpload16').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload16').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas16');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon16').removeClass("d-block").addClass("d-none");
          $('#existingImages16').removeClass("d-block").addClass("d-none");
          $('#imgCanvas16').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload16_16').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload16_16').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas16_16');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon16_16').removeClass("d-block").addClass("d-none");
          $('#existingImages16_16').removeClass("d-block").addClass("d-none");
          $('#imgCanvas16_16').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload16_16_16').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload16_16_16').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas16_16_16');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon16_16_16').removeClass("d-block").addClass("d-none");
          $('#existingImages16_16_16').removeClass("d-block").addClass("d-none");
          $('#imgCanvas16_16_16').removeClass("d-none").addClass("d-block");
          }
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
//terrace
$('.imgUpload17').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload17').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas17');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon17').removeClass("d-block").addClass("d-none");
          $('#existingImages17').removeClass("d-block").addClass("d-none");
          $('#imgCanvas17').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload17_17').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload17_17').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas17_17');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon17_17').removeClass("d-block").addClass("d-none");
          $('#existingImages17_17').removeClass("d-block").addClass("d-none");
          $('#imgCanvas17_17').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload17_17_17').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload17_17_17').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas17_17_17');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon17_17_17').removeClass("d-block").addClass("d-none");
          $('#existingImages17_17_17').removeClass("d-block").addClass("d-none");
          $('#imgCanvas17_17_17').removeClass("d-none").addClass("d-block");
          }
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
//deck
$('.imgUpload18').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload18').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas18');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon18').removeClass("d-block").addClass("d-none");
          $('#existingImages18').removeClass("d-block").addClass("d-none");
          $('#imgCanvas18').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload18_18').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload18_18').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas18_18');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon18_18').removeClass("d-block").addClass("d-none");
          $('#existingImages18_18').removeClass("d-block").addClass("d-none");
          $('#imgCanvas18_18').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload18_18_18').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload18_18_18').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas18_18_18');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon18_18_18').removeClass("d-block").addClass("d-none");
          $('#existingImages18_18_18').removeClass("d-block").addClass("d-none");
          $('#imgCanvas18_18_18').removeClass("d-none").addClass("d-block");
          }
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
//play area
$('.imgUpload19').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload19').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas19');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon19').removeClass("d-block").addClass("d-none");
          $('#existingImages19').removeClass("d-block").addClass("d-none");
          $('#imgCanvas19').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload19_19').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload19_19').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas19_19');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon19_19').removeClass("d-block").addClass("d-none");
          $('#existingImages19_19').removeClass("d-block").addClass("d-none");
          $('#imgCanvas19_19').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload19_19_19').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload19_19_19').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas19_19_19');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon19_19_19').removeClass("d-block").addClass("d-none");
          $('#existingImages19_19_19').removeClass("d-block").addClass("d-none");
          $('#imgCanvas19_19_19').removeClass("d-none").addClass("d-block");
          }
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
//swimming pool
$('.imgUpload20').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload20').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas20');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon20').removeClass("d-block").addClass("d-none");
          $('#existingImages20').removeClass("d-block").addClass("d-none");
          $('#imgCanvas20').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload20_20').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload20_20').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas20_20');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon20_20').removeClass("d-block").addClass("d-none");
          $('#existingImages20_20').removeClass("d-block").addClass("d-none");
          $('#imgCanvas20_20').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload20_20_20').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload20_20_20').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas20_20_20');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon20_20_20').removeClass("d-block").addClass("d-none");
          $('#existingImages20_20_20').removeClass("d-block").addClass("d-none");
          $('#imgCanvas20_20_20').removeClass("d-none").addClass("d-block");
          }
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
//driveway
$('.imgUpload21').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload21').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas21');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon21').removeClass("d-block").addClass("d-none");
          $('#existingImages21').removeClass("d-block").addClass("d-none");
          $('#imgCanvas21').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload21_21').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload21_21').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas21_21');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon21_21').removeClass("d-block").addClass("d-none");
          $('#existingImages21_21').removeClass("d-block").addClass("d-none");
          $('#imgCanvas21_21').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload21_21_21').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload21_21_21').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas21_21_21');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon21_21_21').removeClass("d-block").addClass("d-none");
          $('#existingImages21_21_21').removeClass("d-block").addClass("d-none");
          $('#imgCanvas21_21_21').removeClass("d-none").addClass("d-block");
          }
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
//walkway
$('.imgUpload22').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload22').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas22');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon22').removeClass("d-block").addClass("d-none");
          $('#existingImages22').removeClass("d-block").addClass("d-none");
          $('#imgCanvas22').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload22_22').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload22_22').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas22_22');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon22_22').removeClass("d-block").addClass("d-none");
          $('#existingImages22_22').removeClass("d-block").addClass("d-none");
          $('#imgCanvas22_22').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload22_22_22').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload22_22_22').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas22_22_22');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon22_22_22').removeClass("d-block").addClass("d-none");
          $('#existingImages22_22_22').removeClass("d-block").addClass("d-none");
          $('#imgCanvas22_22_22').removeClass("d-none").addClass("d-block");
          }
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
//strorage shed
$('.imgUpload23').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload23').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas23');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon23').removeClass("d-block").addClass("d-none");
          $('#existingImages23').removeClass("d-block").addClass("d-none");
          $('#imgCanvas23').removeClass("d-none").addClass("d-block");
          }
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

$('.imgUpload23_23').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload23_23').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas23_23');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon23_23').removeClass("d-block").addClass("d-none");
          $('#existingImages23_23').removeClass("d-block").addClass("d-none");
          $('#imgCanvas23_23').removeClass("d-none").addClass("d-block");
          }
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


$('.imgUpload23_23_23').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = $('.imgUpload23_23_23').attr('id');
  //read the file
  var reader = new FileReader();
  $('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvas23_23_23');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#uploadIcon23_23_23').removeClass("d-block").addClass("d-none");
          $('#existingImages23_23_23').removeClass("d-block").addClass("d-none");
          $('#imgCanvas23_23_23').removeClass("d-none").addClass("d-block");
          }
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
//publish your property function
$('#btnConfirmPublish').click(function (){
  //get the ridio button value in property type
  var txtPropertyType = document.getElementsByName("property_type");
  var selectedType = "";

  for(var propertyTypeResult of txtPropertyType){
    if(propertyTypeResult.checked){
      selectedType = propertyTypeResult.value;
      break;
    }
  }
  //Title Value
  var propertyTitle = document.getElementById("propertyTitle").value;
  //Title Value
  var propertyDescription = document.getElementById("propertyDescription").value;
  //Price Value
  var propertyPrice = document.getElementById("propertyPrice").value;

  //Unit/Floor Number
  var txtFloor = document.getElementById("propertyNum").value;
  //Floor Area
  var txtFloorArea = document.getElementById("floorArea").value;
  //Property Name
  var txtmaxOccupants = document.getElementById("maxOccupants").value;
  //Bathroom
  var txtBathroom = document.getElementById("bathNum").value;
  //Bedroom
  var txtBedroom = document.getElementById("bedNum").value;
  //Other details
  var txtOtherDetails = document.getElementById("otherDetails").value;

  //radio button for pets
  var txtPetAllowed = document.getElementsByName("pet_friendly");
  var selectAnswer = "";

  for(var petAllowed of txtPetAllowed){
    if(petAllowed.checked){
      selectAnswer = petAllowed.value;
      break;
    }
  }

  //radio button for furnised
  var txtFurnished = document.getElementsByName("furnished_friendly");
  var selectCheck = "";

  for(var Furnished of txtFurnished){
    if(Furnished.checked){
      selectCheck = Furnished.value;
      break;
    }
  }

  //get the indoor checkboxes
  var checkIndoors = document.getElementsByName("indoors");
  var SpaceValues = [];

  for (var Indoors of checkIndoors) {
    if (Indoors.checked) {
      SpaceValues.push(Indoors.value);
    }
  }
  //get the outdoors checkboxes
  var checkOutdoors = document.getElementsByName("outdoors");

  for (var Outdoors of checkOutdoors) {
    if (Outdoors.checked) {
      SpaceValues.push(Outdoors.value);
    }
  }
  //to change the array separator sign in array
  const arraySpaceSeparator = '~!';
  const spaceValuesResult = SpaceValues.join(arraySpaceSeparator);

  var checkAmenities = document.getElementsByName("someAmenities");
  var amenitiesValue = [];

  for (var amenities of checkAmenities) {
    if (amenities.checked) {
      amenitiesValue.push(amenities.value);
    }
  }
  //to change the array separator sign in array
  const arraySeparator = '~-';
  const amenitiesValueResult = amenitiesValue.join(arraySeparator);
  
  // alert(amenitiesValueResult);

  //location textbox
  //set the textboxes in location
  var txtRegion = document.getElementById('region').value;
  var txtProvince  = document.getElementById('province').value;
  var txtCity = document.getElementById('city').value;
  var txtBarangay = document.getElementById('barangay').value;
  var txtHouseNum = document.getElementById('houseNum').value;
  var txtLongitude = document.getElementById('longitude').value;
  var txtlatitude = document.getElementById('latitude').value;
  var txtNearby = document.getElementById('nearbyPlaces').value;

  var txtPropId = document.getElementById('txt_id').value;

  if(txtPropId == ""){
    txtpropertyId = "Null";
  }
  else{
    txtpropertyId = txtPropId;
  }

  //You will be navigated in Properties if not yet complete
  if ($('#btnProperty').attr('src') != '../imgs/done.png') {
    $('#btnProperty').attr('src', '../imgs/add2.png');
    $('#piDiv').css("background-color", "#DDE0FF");
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
      $('#pDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    //Featured
    if($('#btnFeatured').attr('src') == '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    //Location
    if($('#btnLocation').attr('src') == '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    //Contacts
    if($('#btnContact').attr('src') == '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
    $('#aDiv').css("background-color", "#f3f6fb");
    
    $('#SaveProperty').modal('hide');

    $('#savingfailed').modal('show');

    $('#savingfailed').on('shown.bs.modal', function () {
      // Scroll to the top when the modal is shown
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });
  }
  //You will be navigated in Properties if not yet complete
  else if ($('#btnDetails').attr('src') != '../imgs/done.png') {
    $('#btnDetails').attr('src', '../imgs/add2.png');
    $('#dDiv').css("background-color", "#DDE0FF");
    //property
    if($('#btnProperty').attr('src') == '../imgs/done.png'){
      $('#piDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#piDiv').css("background-color", "#f3f6fb");
      $('#btnProperty').attr('src', '../imgs/add1.png');
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
      $('#pDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    //Featured
    if($('#btnFeatured').attr('src') == '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    //Location
    if($('#btnLocation').attr('src') == '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    //Contacts
    if($('#btnContact').attr('src') == '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
    $('#aDiv').css("background-color", "#f3f6fb");
    
    $('#SaveProperty').modal('hide');

    $('#savingfailed').modal('show');

    $('#savingfailed').on('shown.bs.modal', function () {
        //scroll function to Details
        window.scrollTo({
          top: 400,
          behavior: "smooth",
      });
    });
  }
  //You will be navigated in Properties if not yet complete
  else if ($('#btn_Spaces').attr('src') != '../imgs/done.png') {
    $('#btn_Spaces').attr('src', '../imgs/add2.png');
    $('#sDiv').css("background-color", "#DDE0FF");
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
    //Photos
    if($('#btnPhotos').attr('src') == '../imgs/done.png'){
      $('#pDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    //Featured
    if($('#btnFeatured').attr('src') == '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    //Location
    if($('#btnLocation').attr('src') == '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    //Contacts
    if($('#btnContact').attr('src') == '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
    $('#aDiv').css("background-color", "#f3f6fb");

    $('#SaveProperty').modal('hide');

    $('#savingfailed').modal('show');

    $('#savingfailed').on('shown.bs.modal', function () {
        //scroll function to property
        window.scrollTo({
          top: 1000,
          behavior: "smooth",
        });
      });
  }
  //You will be navigated in Properties if not yet complete
  else if ($('#btnPhotos').attr('src') != '../imgs/done.png') {
    $('#btnPhotos').attr('src', '../imgs/add2.png');
    $('#pDiv').css("background-color", "#DDE0FF");
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
    //Photos
    if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
      $('#sDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#sDiv').css("background-color", "#f3f6fb");
      $('#btn_Spaces').attr('src', '../imgs/add1.png');
    }
    //Featured
    if($('#btnFeatured').attr('src') == '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    //Location
    if($('#btnLocation').attr('src') == '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    //Contacts
    if($('#btnContact').attr('src') == '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
    $('#aDiv').css("background-color", "#f3f6fb");

    $('#SaveProperty').modal('hide');

    $('#savingfailed').modal('show');

    $('#savingfailed').on('shown.bs.modal', function () {
        //scroll function to property
        window.scrollTo({
          top: 1640,
          behavior: "smooth",
        });
    });
  }
  //You will be navigated in Properties if not yet complete
  else if ($('#btnFeatured').attr('src') != '../imgs/done.png') {
    $('#btnFeatured').attr('src', '../imgs/add2.png');
    $('#fDiv').css("background-color", "#DDE0FF");
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
      $('#pDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    //Location
    if($('#btnLocation').attr('src') == '../imgs/done.png'){
      $('#lDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#lDiv').css("background-color", "#f3f6fb");
      $('#btnLocation').attr('src', '../imgs/add1.png');
    }
    //Contacts
    if($('#btnContact').attr('src') == '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
    $('#aDiv').css("background-color", "#f3f6fb");

    $('#SaveProperty').modal('hide');

    $('#savingfailed').modal('show');

    $('#savingfailed').on('shown.bs.modal', function () {
        //scroll function to property
        window.scrollTo({
          top: 2200,
          behavior: "smooth",
        });
    });
  }
  //You will be navigated in Properties if not yet complete
  else if ($('#btnLocation').attr('src') != '../imgs/done.png') {
    $('#btnLocation').attr('src', '../imgs/add2.png');
    $('#lDiv').css("background-color", "#DDE0FF");
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
    //Photos
    if($('#btn_Spaces').attr('src') == '../imgs/done.png'){
      $('#sDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#sDiv').css("background-color", "#f3f6fb");
      $('#btn_Spaces').attr('src', '../imgs/add1.png');
    }
    //Featured
    if($('#btnFeatured').attr('src') == '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    //Location
    if($('#btnPhotos').attr('src') == '../imgs/done.png'){
      $('#pDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    //Contacts
    if($('#btnContact').attr('src') == '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
    $('#aDiv').css("background-color", "#f3f6fb");

    $('#SaveProperty').modal('hide');

    $('#savingfailed').modal('show');

    $('#savingfailed').on('shown.bs.modal', function () {
        //scroll function to property
        window.scrollTo({
          top: 3200,
          behavior: "smooth",
        });
    });
  }
  else{
    $('#SaveProperty').modal('hide');
    $('#waitModal').modal('show');
    
    http = new XMLHttpRequest();
    
    http.onreadystatechange = function() {
        
        if (http.readyState == 4 && http.status == 200) {
          // alert(http.responseText);
          window.location.href = http.responseText;
        }
    };
    http.open("GET", "../Functions/Landlord/saveProperties.php?q=" + 
    selectedType + '~?' + //0
    propertyTitle + '~?' + //1
    encodeURIComponent(propertyDescription) + '~?' + //2
    propertyPrice + '~?' + //3
    txtFloor + '~?' + //4
    txtFloorArea + '~?' + //5
    txtmaxOccupants + '~?' + //6
    txtBathroom + '~?' + //7
    txtBedroom + '~?' + //8
    txtOtherDetails + '~?' + //9
    selectAnswer + '~?' + //10
    selectCheck + '~?' + //11
    spaceValuesResult + "~?" + //12
    txtProvince + "~?" + //13
    txtCity + "~?" + //14
    txtBarangay + "~?" + //15
    txtRegion + "~?" + //16
    txtlatitude + "~?" + //17
    txtLongitude + '~?' + //18
    txtNearby + "~?" + //19
    amenitiesValueResult + "~?" + //20
    txtpropertyId + "~?" + //21
    txtHouseNum, true); //22
    http.send(); 
}
});

function locationTextbox(){
  var txtRegion = document.getElementById('region').value;
  var txtProvince  = document.getElementById('province').value;
  var txtCity = document.getElementById('city').value;
  var txtBarangay = document.getElementById('barangay').value;
  var txtHouseNum = document.getElementById('houseNum').value;
  $('#aDiv').css("background-color", "#f3f6fb");

  if(txtRegion == "" || txtProvince == "" || txtCity == "" || txtBarangay == "" || txtHouseNum == ""){
    $('#btnLocation').attr('src', '../imgs/add1.png');
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
      $('#pDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    //Featured
    if($('#btnFeatured').attr('src') == '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    //Location
    if($('#btnLocation').attr('src') == '../imgs/done.png'){
      $('#lDiv').css("background-color", "#DDE0FF");
    }
    else{
      $('#lDiv').css("background-color", "#DDE0FF");
      $('#btnLocation').attr('src', '../imgs/add2.png');
    }
    //Contact
    if($('#btnContact').attr('src') == '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
  }
  else{
    $('#btnLocation').attr('src', '../imgs/done.png');
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
      $('#pDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#pDiv').css("background-color", "#f3f6fb");
      $('#btnPhotos').attr('src', '../imgs/add1.png');
    }
    //Featured
    if($('#btnFeatured').attr('src') == '../imgs/done.png'){
      $('#fDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#fDiv').css("background-color", "#f3f6fb");
      $('#btnFeatured').attr('src', '../imgs/add1.png');
    }
    //Location
    if($('#btnLocation').attr('src') == '../imgs/done.png'){
      $('#lDiv').css("background-color", "#DDE0FF");
    }
    else{
      $('#lDiv').css("background-color", "#DDE0FF");
      $('#btnLocation').attr('src', '../imgs/add2.png');
    }
    //Contact
    if($('#btnContact').attr('src') == '../imgs/done.png'){
      $('#cDiv').css("background-color", "#f3f6fb");
    }
    else{
      $('#cDiv').css("background-color", "#f3f6fb");
      $('#btnContact').attr('src', '../imgs/add1.png');
    }
  }
}

//featured function
$('#img_uploadFeatured1').click(function (){
  $('.imgUploadFeatured1').click();
});
$('#img_uploadFeatured2').click(function (){
  $('.imgUploadFeatured2').click();
});
$('#img_uploadFeatured3').click(function (){
  $('.imgUploadFeatured3').click();
});
//if the user uploaded a file this function will be triggered
//feature1
$('.imgUploadFeatured1').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = "Featured1";
  //read the file
  var reader = new FileReader();
$('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvasFeatured1');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#imgCanvasFeatured1').removeClass("d-none").addClass("d-block");
          $('#image_icon1').removeClass("d-flex").addClass("d-none");
          $('#existingfeatured1').removeClass("d-block").addClass("d-none");
          }
          if(($('#imgCanvasFeatured2').hasClass('d-none') && $('#existingfeatured2').hasClass('d-none')) || ($('#imgCanvasFeatured3').hasClass('d-none') && $('#existingfeatured3').hasClass('d-none'))){
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
              $('#pDiv').css("background-color", "#f3f6fb");
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/add1.png');
              $('#pDiv').css("background-color", "#f3f6fb");
            }
            //featured
            if($('#btnFeatured').attr('src') == '../imgs/done.png'){
              $('#fDiv').css("background-color", "#DDE0FF");
            }
            else{
              $('#fDiv').css("background-color", "#DDE0FF");
              $('#btnFeatured').attr('src', '../imgs/add2.png');
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
            $('#btnFeatured').attr('src', '../imgs/done.png');

            if($('#btnProperty').attr('src') != '../imgs/done.png'){
              $('#btnProperty').attr('src', '../imgs/add2.png');
            }
            else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
              $('#btn_Spaces').attr('src', '../imgs/add2.png');
            }
            else if($('#btnDetails').attr('src') != '../imgs/done.png'){
              $('#btnDetails').attr('src', '../imgs/add2.png');
            }
            else if($('#btnPhotos').attr('src') != '../imgs/done.png'){
              $('#btnPhotos').attr('src', '../imgs/add2.png');
            }
            else if($('#btnLocation').attr('src') != '../imgs/done.png'){
              $('#btnLocation').attr('src', '../imgs/add2.png');
            }
            else if($('#btnContact').attr('src') != '../imgs/done.png'){
              $('#btnContact').attr('src', '../imgs/add2.png');
            }
          }
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
//featured2
$('.imgUploadFeatured2').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = "Featured2";
  //read the file
  var reader = new FileReader();
$('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvasFeatured2');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#image_icon2').removeClass('d-flex').addClass('d-none');
          $('#imgCanvasFeatured2').removeClass("d-none").addClass("d-block");
          $('#existingfeatured2').removeClass("d-block").addClass("d-none");
          }
          if(($('#imgCanvasFeatured1').hasClass('d-none') && $('#existingfeatured1').hasClass('d-none')) || ($('#imgCanvasFeatured3').hasClass('d-none') && $('#existingfeatured3').hasClass('d-none'))){
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
              $('#pDiv').css("background-color", "#f3f6fb");
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/add1.png');
              $('#pDiv').css("background-color", "#f3f6fb");
            }
            //featured
            if($('#btnFeatured').attr('src') == '../imgs/done.png'){
              $('#fDiv').css("background-color", "#DDE0FF");
            }
            else{
              $('#fDiv').css("background-color", "#DDE0FF");
              $('#btnFeatured').attr('src', '../imgs/add2.png');
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
            $('#btnFeatured').attr('src', '../imgs/done.png');

            if($('#btnProperty').attr('src') != '../imgs/done.png'){
              $('#btnProperty').attr('src', '../imgs/add2.png');
            }
            else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
              $('#btn_Spaces').attr('src', '../imgs/add2.png');
            }
            else if($('#btnDetails').attr('src') != '../imgs/done.png'){
              $('#btnDetails').attr('src', '../imgs/add2.png');
            }
            else if($('#btnPhotos').attr('src') != '../imgs/done.png'){
              $('#btnPhotos').attr('src', '../imgs/add2.png');
            }
            else if($('#btnLocation').attr('src') != '../imgs/done.png'){
              $('#btnLocation').attr('src', '../imgs/add2.png');
            }
            else if($('#btnContact').attr('src') != '../imgs/done.png'){
              $('#btnContact').attr('src', '../imgs/add2.png');
            }
          }
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
//featured3
$('.imgUploadFeatured3').change(function(e) {
  //get the user input file
  var imageData = e.target.files[0];
  var imgName = "Featured3";
  //read the file
  var reader = new FileReader();
$('#aDiv').css("background-color", "#f3f6fb");
  //load the file to display in the canvas function
  reader.onload = function(event) {
      var img = new Image();
      img.onload = function() {
      var canvas = document.getElementById('imgCanvasFeatured3');
      var ctx = canvas.getContext('2d');
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);

      // Capture the image data from the canvas
      var imgData = event.target.result;
      var formData = new FormData();
      formData.append('imageFile', imgData);
      formData.append('imgName', imgName);

      $.ajax({
        url: '../Functions/Landlord/uploadedSpacesImage.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          if(response == "success"){
          $('#image_icon3').removeClass('d-flex').addClass('d-none');
          $('#existingfeatured3').removeClass("d-block").addClass("d-none");
          $('#imgCanvasFeatured3').removeClass("d-none").addClass("d-block");
          }
          if(($('#imgCanvasFeatured2').hasClass('d-none') && $('#existingfeatured2').hasClass('d-none')) || ($('#imgCanvasFeatured1').hasClass('d-none') && $('#existingfeatured1').hasClass('d-none'))){
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
              $('#pDiv').css("background-color", "#f3f6fb");
            }
            else{
              $('#btnPhotos').attr('src', '../imgs/add1.png');
              $('#pDiv').css("background-color", "#f3f6fb");
            }
            //featured
            if($('#btnFeatured').attr('src') == '../imgs/done.png'){
              $('#fDiv').css("background-color", "#DDE0FF");
            }
            else{
              $('#fDiv').css("background-color", "#DDE0FF");
              $('#btnFeatured').attr('src', '../imgs/add2.png');
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
            $('#btnFeatured').attr('src', '../imgs/done.png');

            if($('#btnProperty').attr('src') != '../imgs/done.png'){
              $('#btnProperty').attr('src', '../imgs/add2.png');
            }
            else if($('#btn_Spaces').attr('src') != '../imgs/done.png'){
              $('#btn_Spaces').attr('src', '../imgs/add2.png');
            }
            else if($('#btnDetails').attr('src') != '../imgs/done.png'){
              $('#btnDetails').attr('src', '../imgs/add2.png');
            }
            else if($('#btnPhotos').attr('src') != '../imgs/done.png'){
              $('#btnPhotos').attr('src', '../imgs/add2.png');
            }
            else if($('#btnLocation').attr('src') != '../imgs/done.png'){
              $('#btnLocation').attr('src', '../imgs/add2.png');
            }
            else if($('#btnContact').attr('src') != '../imgs/done.png'){
              $('#btnContact').attr('src', '../imgs/add2.png');
            }
          }
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

$('#btnConfirmLogout').click(function(){
  window.location.href = "../index.php?status=logout"
});

function cancelsavinglivingroom() {
  if($('#imgCanvaslivingroom').hasClass('d-none') && $('#existinglivingroom').hasClass('d-none')){
    $.ajax({
      url: "../Functions/Landlord/cancelUploadProperty.php",
      method: "POST",
      data: {
        userid: $("#txtUserId").val(),
        propertyInfo: "Livingroom"
      },
      dataType: "text",
      success: function(data) {
        $('#uploadIcon0').removeClass("d-none").addClass("d-flex");
        $('#imgCanvas0').removeClass("d-block").addClass("d-none");
        $('#existingImages0').removeClass("d-block").addClass("d-none");

        $('#uploadIcon00').removeClass("d-none").addClass("d-flex");
        $('#imgCanvas00').removeClass("d-block").addClass("d-none");
        $('#existingImages00').removeClass("d-block").addClass("d-none");

        $('#uploadIcon000').removeClass("d-none").addClass("d-flex");
        $('#imgCanvas000').removeClass("d-block").addClass("d-none");
        $('#existingImages000').removeClass("d-block").addClass("d-none");

        $('#image_iconlivingroom').removeClass("d-none").addClass("d-flex");
        $('#imgCanvaslivingroom').removeClass("d-block").addClass("d-none");
        
        $('#existinglivingroom').removeClass("d-block").addClass("d-none");

        $('.imgUpload0').val('');
        $('.imgUpload00').val('');
        $('.imgUpload000').val('');
      }
    });
  }
}