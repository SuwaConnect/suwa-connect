document.addEventListener("DOMContentLoaded", function() {
    const dateElement = document.getElementById("current-date");
    const currentDate = new Date().toLocaleDateString();
    dateElement.textContent = currentDate;
});

// Function to calculate thumb position on the slider based on BMI value
function updateSliderPosition(bmiValue) {
    const minBMI = 15;
    const maxBMI = 40;
    const sliderThumb = document.getElementById('slider-thumb');

    const thumbPosition = ((bmiValue - minBMI) / (maxBMI - minBMI)) * 100;
    sliderThumb.style.left = thumbPosition + '%';

    // Update status based on BMI
    const status = document.getElementById('bmi-status');
    if (bmiValue < 18.5) {
        status.textContent = "You are underweight";
        status.style.backgroundColor = 'yellow';
    } else if (bmiValue >= 18.5 && bmiValue <= 24.9) {
        status.textContent = "You are healthy";
        status.style.backgroundColor = 'green';
    } else if (bmiValue >= 25 && bmiValue <= 29.9) {
        status.textContent = "You are overweight";
        status.style.backgroundColor = 'orange';
    } else {
        status.textContent = "You are obese";
        status.style.backgroundColor = 'red';
    }
}

// Initialize the slider with the default BMI value of 24.5
document.addEventListener('DOMContentLoaded', function() {
    const bmiValue = 24.5;
    updateSliderPosition(bmiValue);
});

