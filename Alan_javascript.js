document.addEventListener('DOMContentLoaded', function () {
    // Function to check if the phone number is valid
    function isValidPhoneNumber(phoneNumber) {
        return /^\d{1,10}$/.test(phoneNumber);
    }
    

    // Common validation function
    function validateForm(form) {
        let phoneNumber = form.querySelector('input[name="PhoneNumber"]').value.trim();
        let password = form.querySelector('input[name="Password"]').value.trim();

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

// Existing jQuery code for image animations
$(document).ready(function(){
    $('.image-ad img').on('mouseenter', function(){
        $(this).animate({
            opacity: 0.5
        }, 500, function() { // Half-transparent
            // Scale up animation
            $(this).animate({ 
                width: '+=10px', 
                height: '+=10px'
            }, 500, function() { 
                // Scale down animation
                $(this).animate({ 
                    width: '-=10px', 
                    height: '-=10px',
                    opacity: 1 // Back to fully visible
                }, 500);
            });
        });
    });
});
