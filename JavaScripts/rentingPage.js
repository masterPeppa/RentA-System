// Get the slider input element
var slider = document.getElementById('priceRange');

// Get the output element to display the slider value
var sliderValue = document.getElementById('priceValue');

// Display the initial slider value
sliderValue.innerHTML = slider.value;

// Update the displayed value when the slider value changes
slider.oninput = function() {
    sliderValue.innerHTML = this.value;
};