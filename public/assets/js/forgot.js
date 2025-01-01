document.getElementById("sendCodeButton").addEventListener("click", function() {
    var email = document.getElementById("email").value;
    if (email) {
        document.getElementById("step1").classList.remove("active");
        document.getElementById("step2").classList.add("active");
        
        // Enable the code input and verify button
        document.getElementById("code").disabled = false;
        document.getElementById("verifyButton").disabled = false;
    } else {
        alert("Please enter a valid email.");
    }
});

document.getElementById("verifyButton").addEventListener("click", function() {
    var code = document.getElementById("code").value;
    if (code) {
        alert("Code verified successfully! You can now reset your password.");
    } else {
        alert("Please enter the reset code.");
    }
});
