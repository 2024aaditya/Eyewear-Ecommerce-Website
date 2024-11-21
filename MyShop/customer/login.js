document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const emailInput = document.getElementById("c_email");
    const passwordInput = document.getElementById("c_pass");
    const errorMessage = document.createElement("div");
    errorMessage.className = "error-message";
    
    form.addEventListener("submit", function (event) {
        // Client-side validation
        if (emailInput.value === "" || passwordInput.value === "") {
            event.preventDefault();
            errorMessage.textContent = "Please fill in all fields.";
            form.appendChild(errorMessage);
        }
    });
    
    emailInput.addEventListener("input", function () {
        errorMessage.textContent = ""; // Clear error message when user starts typing
    });
    
    passwordInput.addEventListener("input", function () {
        errorMessage.textContent = ""; // Clear error message when user starts typing
    });
});
