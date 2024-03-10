document.getElementById("registerForm").addEventListener("submit", function (event) {
    var name = document.querySelector('input[name="name"]').value;
    var email = document.querySelector('input[name="email"]').value;
    var mobile = document.querySelector('input[name="mobile"]').value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var specialNote = document.querySelector('textarea[name="special_note"]').value;
    var userType = document.querySelector('select[name="user_type"]').value;
    var password = document.querySelector('input[name="password"]').value;
    var confirmPassword = document.querySelector('input[name="confirm_password"]').value;
    var profile_image = document.querySelector('input[name="profile_image"]').value;
    // Terms and conditions validation
    var terms = document.getElementById('terms').checked;
    var isValid = true;

    // Clear previous error messages
    document.querySelectorAll('.error').forEach(function (element) {
        element.innerText = '';
    });

    // Custom validation
    if (!name) {
        document.getElementById("nameError").innerText = "Please enter your name";
        isValid = false;
    }
    if (!email) {
        document.getElementById("emailError").innerText = "Please enter your email";
        isValid = false;
    }
    if (!mobile) {
        document.getElementById("mobileError").innerText = "Please enter your mobile number";
        isValid = false;
    }
    if (!gender) {
        document.getElementById("genderError").innerText = "Please select your gender";
        isValid = false;
    }
    if (!specialNote) {
        document.getElementById("specialNoteError").innerText = "Please enter a special note";
        isValid = false;
    }
    if (!userType) {
        document.getElementById("userTypeError").innerText = "Please select user type";
        isValid = false;
    }
    if (!password) {
        document.getElementById("passwordError").innerText = "Please enter a password";
        isValid = false;
    }
    if (!confirmPassword) {
        document.getElementById("confirmPasswordError").innerText = "Please confirm your password";
        isValid = false;
    }
    if (password !== confirmPassword) {
        document.getElementById("confirmPasswordError").innerText = "Passwords do not match";
        isValid = false;
    }

    if (!terms) {
        document.getElementById("termsError").innerText = "Please agree to the terms and conditions";
        isValid = false;
    }

    // Prevent form submission if validation fails
    if (!isValid) {
        event.preventDefault();
    }
});
