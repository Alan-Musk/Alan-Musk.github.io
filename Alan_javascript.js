document.addEventListener('DOMContentLoaded', function () {



    // Common validation function
    function validateForm(form) {
        let phoneNumber = form.querySelector('input[name="PhoneNumber"]').value.trim();
        let password = form.querySelector('input[name="Password"]').value.trim();
        console.log(phoneNumber,password);

        // Check if fields are empty
        if (!phoneNumber || !password) {
            alert("Please fill out both the PhoneNumber and Password fields.");
            return false; // Invalid
        }

        // Check if the phone number is valid
        if (!isValidPhoneNumber(phoneNumber)) {
            alert("Please enter a valid phone number. Only digits and no more than 10 characters are allowed.");
            return false; // Invalid
        }

        return true; // Valid
    }

    // Function to check if the phone number is valid
    function isValidPhoneNumber(phoneNumber) {
        console.log(/^\d{1,10}$/.test(phoneNumber));
        return /^\d{1,10}$/.test(phoneNumber);

    }


    // Validate Registration Form
    document.getElementById('registrationForm').addEventListener('submit', function (event) {
        if (!validateForm(this)) {
            event.preventDefault(); // Prevent form submission
        }
    });

    // Validate Login Form
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        if (!validateForm(this)) {
            event.preventDefault(); // Prevent form submission
        }
    });
});


