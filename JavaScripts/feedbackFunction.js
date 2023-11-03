
const stars1 = document.querySelectorAll(".stars-container .stars1");
const stars2 = document.querySelectorAll(".stars-container .stars2");
const stars3 = document.querySelectorAll(".stars-container .stars3");
const stars4 = document.querySelectorAll(".stars-container .stars4");
let cleanlinessactiveStarCount = 0;
let communicationactiveStarCount = 0;
let accuracyactiveStarCount = 0; 
let locationactiveStarCount = 0; 

// Loop through the stars NodeList
stars1.forEach((star, index1) => {
    // Event listener that runs a function when the "click" event is triggered
    star.addEventListener("click", () => {
        cleanlinessactiveStarCount = 0;
        // Loop through stars again
        stars1.forEach((star, index2) => {
            // Add the active class to the clicked star and any stars with lower index
            // Remove the active class from any stars with higher index
            if (index1 >= index2) {
                star.classList.add("active");
                cleanlinessactiveStarCount++; // Increment the count of "active" stars
            } else {
                star.classList.remove("active");
            }
        });
        document.getElementById('txtCleanliness').value = `${cleanlinessactiveStarCount}`;
    });
});

stars2.forEach((star, index1) => {

    star.addEventListener("click", () => {
        communicationactiveStarCount = 0;
        stars2.forEach((star, index2) => {
            if (index1 >= index2) {
                star.classList.add("active");
                communicationactiveStarCount++; // Increment the count of "active" stars
            } else {
                star.classList.remove("active");
            }
        });
        document.getElementById('txtCommunication').value = `${communicationactiveStarCount}`;
    })
})

stars3.forEach((star, index1) => {

    star.addEventListener("click", () => {
        accuracyactiveStarCount = 0; 
        stars3.forEach((star, index2) => {
            if (index1 >= index2) {
                star.classList.add("active");
                accuracyactiveStarCount++; // Increment the count of "active" stars
            } else {
                star.classList.remove("active");
            }
        });
        document.getElementById('txtaccuracy').value = `${accuracyactiveStarCount}`;
    })
})


stars4.forEach((star, index1) => {

    star.addEventListener("click", () => {
        locationactiveStarCount = 0; 
        stars4.forEach((star, index2) => {
            if (index1 >= index2) {
                star.classList.add("active");
                locationactiveStarCount++; // Increment the count of "active" stars
            } else {
                star.classList.remove("active");
            }
        });
        document.getElementById('txtlocation').value = `${locationactiveStarCount}`;
    })
})

function submitfeedback(){
    var cleanliness = document.getElementById('txtCleanliness').value;
    var communication = document.getElementById('txtCommunication').value;
    var accuracy = document.getElementById('txtaccuracy').value;
    var location = document.getElementById('txtlocation').value;
    var txtComment = document.getElementById('txtComment').value;
    var txtLandlordid = document.getElementById('txtLandlordId').value;
    var txtRenterId = document.getElementById('txtrenterId').value;
    var txtPropertyId = document.getElementById('txtpropertyId').value;
    const modal = new bootstrap.Modal(document.getElementById('incompleteFeedbackModal'));

    if (!txtComment.trim()) {
        modal.show();
    }
    else{
        http = new XMLHttpRequest();
        
        http.onreadystatechange = function() {
            
            if (http.readyState == 4 && http.status == 200) {
                window.location.href = http.responseText;
            }
        };
        
        http.open("GET", "../Functions/Renters/insertingfeedback.php?q=" + cleanliness + "~~>" + communication + "~~>" 
        + accuracy + "~~>" + location + "~~>" + txtComment + "~~>" + txtLandlordid + "~~>" + txtRenterId + "~~>" + 
        txtPropertyId, true); 
        http.send(); 
    }
}