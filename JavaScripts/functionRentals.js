// PRICE RANGE
    const rangeInput = document.querySelectorAll(".range-input input"),
          priceInput = document.querySelectorAll(".price-input input"),
          range = document.querySelector(".slider .progress");
    let priceGap = 500;

    priceInput.forEach(input =>{
        input.addEventListener("input", e => {
            let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);
            
            if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
                if(e.target.className === "input-min"){
                    rangeInput[0].value = minPrice;
                    range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
                }
                else{
                    rangeInput[1].value = maxPrice;
                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                }
            }
        });
    });

    rangeInput.forEach(input =>{
        input.addEventListener("input", e =>{
            let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);
            if((maxVal - minVal) < priceGap){
                if(e.target.className === "range-min"){
                    rangeInput[0].value = maxVal - priceGap;
                }
                else{
                    rangeInput[1].value = minVal + priceGap;
                }
            }
            else{
                priceInput[0].value = minVal;
                priceInput[1].value = maxVal;
                range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
                range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                
                priceInputSm[0].value = minVal;
                priceInputSm[1].value = maxVal;
                rangeSm.style.left = ((minVal / rangeInputSm[0].max) * 100) + "%";
                rangeSm.style.right = 100 - (maxVal / rangeInputSm[1].max) * 100 + "%";
            }
        });
    });

// PRICE RANGE SM
    const rangeInputSm = document.querySelectorAll(".range-input-sm input"),
    priceInputSm = document.querySelectorAll(".price-input-sm input"),
    rangeSm = document.querySelector(".slider-sm .progress-sm");
    let priceGapSm = 500;

    priceInputSm.forEach(input =>{
        input.addEventListener("input", e => {
            let minPrice = parseInt(priceInputSm[0].value),
                maxPrice = parseInt(priceInputSm[1].value);
    
    if((maxPrice - minPrice >= priceGapSm) && maxPrice <= rangeInputSm[1].max){
        if(e.target.className === "input-min-sm"){
            rangeInputSm[0].value = minPrice;
            rangeSm.style.left = ((minPrice / rangeInputSm[0].max) * 100) + "%";
        }
        else{
            rangeInputSm[1].value = maxPrice;
            rangeSm.style.right = 100 - (maxPrice / rangeInputSm[1].max) * 100 + "%";
        }
    }
    });
    });

    rangeInputSm.forEach(input =>{
        input.addEventListener("input", e =>{
            let minVal = parseInt(rangeInputSm[0].value),
                maxVal = parseInt(rangeInputSm[1].value);
    if((maxVal - minVal) < priceGapSm){
        if(e.target.className === "range-min-sm"){
            rangeInputSm[0].value = maxVal - priceGapSm;
        }
        else{
            rangeInputSm[1].value = minVal + priceGapSm;
        }
    }
    else{
        priceInputSm[0].value = minVal;
        priceInputSm[1].value = maxVal;
        rangeSm.style.left = ((minVal / rangeInputSm[0].max) * 100) + "%";
        rangeSm.style.right = 100 - (maxVal / rangeInputSm[1].max) * 100 + "%";
        //big
        priceInput[0].value = minVal;
        priceInput[1].value = maxVal;
        range.style.left = ((minVal / rangeInputSm[0].max) * 100) + "%";
        range.style.right = 100 - (maxVal / rangeInputSm[1].max) * 100 + "%";
    }
    });
});

    
  


// DD PROPERTY TYPE
    var btnTypeValue = document.getElementById('propertyTypeValue');
    const typeMenu = document.querySelector(".typeMenu"),
        btnType = typeMenu.querySelector(".btn-type"),
        btnSetValue = typeMenu.querySelector(".btn-txt-type"),
        optionType = typeMenu.querySelectorAll(".type-option");


        optionType.forEach(typeOption => {
            typeOption.addEventListener("click", () => {
            
            let selectedTypeOption = typeOption.querySelector(".opt-type-text").innerText;
            btnSetValue.textContent = selectedTypeOption;
            btnType.value = selectedTypeOption;
            btnTypeValue.value = selectedTypeOption;
            btnTypeSm.value = selectedTypeOption;
            optionTypeSm.innerText = selectedTypeOption;
            btnTypeTxtSm.innerText = selectedTypeOption;
            })
        });

// DD PROPERTY TYPE SM
    const typeMenuSm = document.querySelector(".typeMenuSm"),
    btnTypeSm = typeMenuSm.querySelector(".btn-type-sm"),
    optionTypeSm = typeMenuSm.querySelectorAll(".type-option-sm"),
    btnTypeTxtSm = typeMenuSm.querySelector(".btn-txt-type-sm");


    optionTypeSm.forEach(typeOption => {
        typeOption.addEventListener("click", () => {
        
        let selectedTypeOption = typeOption.querySelector(".opt-type-text-sm").innerText;
        btnTypeTxtSm.innerText = selectedTypeOption;
        btnSetValue.textContent = selectedTypeOption;
        btnType.value = selectedTypeOption;
        btnTypeValue.value = selectedTypeOption;
        })
    });

// DD BED COUNT
    var btnBedCount = document.getElementById('bedCount');
    const bedMenu = document.querySelector(".bedMenu"),
    btnBed = bedMenu.querySelector(".btn-bed"),
    optionBed = bedMenu.querySelectorAll(".bed-option"),
    btnBedTxt = bedMenu.querySelector(".btn-txt-bed");


    optionBed.forEach(bedOption => {
        bedOption.addEventListener("click", () => {
        
        let selectedBedOption = bedOption.querySelector(".opt-bed-text").innerText;
        btnBedTxt.innerText = selectedBedOption;
        btnBedCount.value = selectedBedOption;
        btnBedTxtSm.innerText = selectedBedOption;
        })
    });

// DD BED COUNT SM
    const bedMenuSm = document.querySelector(".bedMenuSm"),
    btnBedSm = bedMenuSm.querySelector(".btn-bed-sm"),
    optionBedSm = bedMenuSm.querySelectorAll(".bed-option-sm"),
    btnBedTxtSm = bedMenuSm.querySelector(".btn-txt-bed-sm");


    optionBedSm.forEach(bedOption => {
        bedOption.addEventListener("click", () => {
        
        let selectedBedOption = bedOption.querySelector(".opt-bed-text-sm").innerText;
        btnBedCount.value = selectedBedOption;
        btnBedTxtSm.innerText = selectedBedOption;
        btnBedTxt.innerText = selectedBedOption;
        })
    });

// DD BATH COUNT
    var btnBathCount = document.getElementById('bathCount');
    const bathMenu = document.querySelector(".bathMenu"),
        btnBath = bathMenu.querySelector(".btn-bath"),
        optionBath = bathMenu.querySelectorAll(".bath-option"),
        btnBathTxt = bathMenu.querySelector(".btn-txt-bath");


        optionBath.forEach(bathOption => {
            bathOption.addEventListener("click", () => {
            
            let selectedBathOption = bathOption.querySelector(".opt-bath-text").innerText;
            btnBathTxt.innerText = selectedBathOption;
            btnBathTxtSm.innerText = selectedBathOption;
            btnBathCount.value = selectedBathOption;
            })
        });


// DD BATH COUNT SM
    const bathMenuSm = document.querySelector(".bathMenuSm"),
    btnBathSm = bathMenuSm.querySelector(".btn-bath-sm"),
    optionBathSm = bathMenuSm.querySelectorAll(".bath-option-sm"),
    btnBathTxtSm = bathMenuSm.querySelector(".btn-txt-bath-sm");

        optionBathSm.forEach(bathOption => {
        bathOption.addEventListener("click", () => {
        
        let selectedBathOption = bathOption.querySelector(".opt-bath-text-sm").innerText;
        btnBathTxtSm.innerText = selectedBathOption;
        btnBathTxt.innerText = selectedBathOption;
        btnBathCount.value = selectedBathOption;
        })
    });


// DD FLOOR AREA
var floorAreaVal = document.getElementById('floorAreaValue');
const floorAreaMenu = document.querySelector(".floorAreaMenu"),
      btnFloorArea = floorAreaMenu.querySelector(".btn-floor-area"),
      optionFloor = floorAreaMenu.querySelectorAll(".floor-option"),
      btnFloorTxt = floorAreaMenu.querySelector(".btn-txt-floor");


      optionFloor.forEach(floorOption => {
        floorOption.addEventListener("click", () => {
          
          let selectedFloorOption = floorOption.querySelector(".opt-floor-text").innerText;
          btnFloorTxt.innerText = selectedFloorOption;
          btnFloorTxtSm.innerText = selectedFloorOption;
          floorAreaVal.value = selectedFloorOption;
        })
      });

// DD FLOOR AREA SM
const floorAreaMenuSm = document.querySelector(".floorAreaMenuSm"),
      btnFloorAreaSm = floorAreaMenuSm.querySelector(".btn-floor-area-sm"),
      optionFloorSm = floorAreaMenuSm.querySelectorAll(".floor-option-sm"),
      btnFloorTxtSm = floorAreaMenuSm.querySelector(".btn-txt-floor-sm");


      optionFloorSm.forEach(floorOption => {
        floorOption.addEventListener("click", () => {
          
          let selectedFloorOption = floorOption.querySelector(".opt-floor-text-sm").innerText;
          btnFloorTxtSm.innerText = selectedFloorOption;
          btnFloorTxt.innerText = selectedFloorOption;
          floorAreaVal.value = selectedFloorOption;
        })
      });
      

    // DROPDOWN AMENITIES
    var amenitiesValues = document.getElementById("dropdownValues");
    const selectBtn = document.querySelector(".select-btn"),
        options = document.querySelectorAll(".amenity-option");

        // add open class when select btn is clicked
        selectBtn.addEventListener("click", () => {
            selectBtn.classList.toggle("open");

        });

        options.forEach(item => {
        item.addEventListener("click", () => {
        item.classList.toggle("checked");

        const checked = document.querySelectorAll(".checked");
        const btnTxt = document.querySelector(".select-btn-txt");
        const selectedAmenities = [];

        checked.forEach(checkedItem => {
            const amenityText = checkedItem.querySelector(".amenity-text-option").textContent;
            selectedAmenities.push(amenityText);
        });
        amenitiesValues.value = selectedAmenities.join(",");

            if(checked && checked.length > 0){
                btnTxt.innerText = `${checked.length} amenity selected`;
            }
            else{
                btnTxt.innerText = "Select Amenity";
            }
        });
});

// DROPDOWN AMENITIES SM
var amenitiesValuessm = document.getElementById("dropdownValuessm");
const smSelectBtn = document.querySelector(".select-btn-sm"),
      smOptions = document.querySelectorAll(".amenity-option-sm");


        // add open class when select btn is clicked
        smSelectBtn.addEventListener("click", () => {
            smSelectBtn.classList.toggle("open");
        });

    smOptions.forEach(item => {
    item.addEventListener("click", () => {
        item.classList.toggle("checked");

            const checked = document.querySelectorAll(".checked");
            const smBtnTxt = document.querySelector(".select-btn-txt-sm");
            const selectedAmenities = [];

            checked.forEach(checkedItem => {
                const amenityText = checkedItem.querySelector(".amenity-text-option-sm").textContent;
                selectedAmenities.push(amenityText);
            });
            amenitiesValuessm.value = selectedAmenities.join(",");


            if(checked && checked.length > 0){
                smBtnTxt.innerText = `${checked.length} amenity selected`;
            }
            else{
                smBtnTxt.innerText = "Select Amenity";
            }
        });
});
function NavlocationTextboxFunction(txtLocation){
    modal_txtLocation = document.getElementById('modalfilterLocation').value = txtLocation;

    if (txtLocation.length == 0) {
        document.getElementById("suggestionList").innerHTML = "";
        document.getElementById("suggestionList").style.visibility = "hidden";
        return;
    }
    else{
        http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) { 
            
                document.getElementById("suggestionList").innerHTML = http.responseText;
                document.getElementById("suggestionList").style.visibility = "visible";
            }
            else{
                
                document.getElementById("suggestionList").innerHTML = "Loading...";
                document.getElementById("suggestionList").style.visibility = "visible";
            }
        };
        if (txtLocation.includes("sto")) {
            txtLocation = txtLocation.replace(/\bsto\b/g, "santo");
        }
        if (txtLocation.includes(".")) {
            txtLocation = txtLocation.replace(".", " ");
        }
        if (txtLocation.includes(",")) {
            txtLocation = txtLocation.replace(",", " ");
        }
        if (txtLocation.includes("  ")) {
            txtLocation = txtLocation.replace("  ", " ");
        }
        if (txtLocation.includes("sta")) {
            txtLocation = txtLocation.replace(/\bsta\b/g, "santa");
        }
        http.open("GET", "Functions/getTextlocaationrentals.php?q=" + txtLocation, true); 
        http.send(); 
    }
}
function ModallocationTextboxFunction(txtLocation){
    nav_txtLocation = document.getElementById('navfilterLocation').value = txtLocation;
    if (txtLocation.length == 0) {
        document.getElementById("suggestionList1").innerHTML = "";
        document.getElementById("suggestionList1").style.visibility = "hidden";
        return;
    }
    else{
        http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) { 
            
                document.getElementById("suggestionList1").innerHTML = http.responseText;
                document.getElementById("suggestionList1").style.visibility = "visible";
            }
            else{
                
                document.getElementById("suggestionList1").innerHTML = "Loading...";
                document.getElementById("suggestionList1").style.visibility = "visible";
            }
        };
        if (txtLocation.includes("sto")) {
            txtLocation = txtLocation.replace(/\bsto\b/g, "santo");
        }
        if (txtLocation.includes(".")) {
            txtLocation = txtLocation.replace(".", " ");
        }
        if (txtLocation.includes(",")) {
            txtLocation = txtLocation.replace(",", " ");
        }
        if (txtLocation.includes("  ")) {
            txtLocation = txtLocation.replace(" ", "");
        }
        if (txtLocation.includes("sta")) {
            txtLocation = txtLocation.replace(/\bsta\b/g, "santa");
        }
        http.open("GET", "Functions/getTextlocaationrentals.php?q=" + txtLocation, true); 
        http.send(); 
    }
}

function filterButton(){
    property_Type = document.getElementById('propertyTypeValue').value;
    property_Location = document.getElementById('navfilterLocation');
    property_minimum_price = document.getElementById('minimumValue').value;
    property_maximum_price = document.getElementById('maximumValue').value;
    property_bed_count = document.getElementById('bedCount').value;
    property_bath_count = document.getElementById('bathCount').value;
    property_floor_area = document.getElementById('floorAreaValue').value;
    bigpropertyAmenities = document.getElementById("dropdownValues").value;
    smallpropertyAmenities = document.getElementById("dropdownValuessm").value;
    
    if(bigpropertyAmenities != ""){
        amenitiesValue = bigpropertyAmenities;
    }
    else if(smallpropertyAmenities != ""){
        amenitiesValue = smallpropertyAmenities;
    }
    else{
        amenitiesValue = "null";
    }

    if(property_Location.value == ""){
        prop_txtLocation = "null";
    }
    else{
        prop_txtLocation = property_Location.value;
    }

    http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                location.reload();
            }
        };
        
        http.open("GET", "Functions/filterFunction.php?q=" + property_Type + "~~" + prop_txtLocation + "~~" + property_minimum_price
        + "~~" + property_maximum_price + "~~" + property_bed_count + "~~" + property_bath_count + "~~" + amenitiesValue + "~~" + property_floor_area, true); 
        http.send(); 
}