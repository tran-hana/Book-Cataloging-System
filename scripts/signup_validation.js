/*
 * Name: Ha Nhu Y Tran, Cheng Qian - Group 9
 * Assignment 2
 * Date: Nov 23, 2024
 * Description: This file contains JavaScript validation for sign-up form. Each field is validated with a corresponding error message and the hightlited field
 * in order to notify users and ensure the correct format of entered data.
 */

// Initialize global variables to track validation status
let usernameValid = false;
let emailValid = false;
let passwordValid = false;
let passwordConfirmationValid = false;
let genresValid = false;

// Create validation function
function validate() {
    validateUsername();
    validateEmail();
    validatePassword();
    validatePasswordConfirmation();
    validateGenres();
    if (usernameValid && emailValid && passwordValid && passwordConfirmationValid && genresValid) {
        return true;
    } else {
        return false;
    }
}

// Perform validation
const usernameField = document.getElementById("username");
usernameField.addEventListener("input", validateUsername);
function validateUsername() {
    if (usernameField.value.trim().length > 0 && usernameField.value.trim().length <= 30) {
        usernameValid = true;
        clearError(usernameField);
    } else {
        usernameValid = false;
        showError(usernameField, "⨉ Username should be non-empty, and within 30 characters long.");
    }
}

const emailField = document.getElementById("email");
emailField.addEventListener("input", validateEmail);
function validateEmail() {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  /* [^\s@] matches any characters that are not space or @ */
    if (emailPattern.test(emailField.value)) {
        emailValid = true;
        clearError(emailField);
    } else {
        emailValid = false;
        showError(emailField, "⨉ Email address should be non-empty with the format xyz@xyz.xyz.");
    }
}

const passwordField = document.getElementById("password");
passwordField.addEventListener("input", validatePassword);
function validatePassword() {
    if (passwordField.value.length >= 8) {
        passwordValid = true;
        clearError(passwordField);
    } else {
        passwordValid = false;
        showError(passwordField, "⨉ Password should be at least 8 characters long.");
    }
}

const passwordConfirmationField = document.getElementById("password-confirmation");
passwordConfirmationField.addEventListener("input", validatePasswordConfirmation);
function validatePasswordConfirmation() {
    if (passwordConfirmationField.value === passwordField.value && passwordConfirmationField.value.length > 0) {
        passwordConfirmationValid = true;
        clearError(passwordConfirmationField);
    } else {
        passwordConfirmationValid = false;
        showError(passwordConfirmationField, "⨉ Please retype password.");
    }
}

const genresLabel = document.getElementById("genresLabel");
const genresSelection = document.querySelectorAll("input[name='genres[]']");
genresSelection.forEach(genre => {
    genre.addEventListener("change", validateGenres);
});
function validateGenres() {
    const genresSelected = Array.from(genresSelection).filter(genre => genre.checked);
    if (genresSelected.length > 0) {
        genresValid = true;
        clearError(genresLabel);
    } else {
        genresValid = false;
        showError(genresLabel, "⨉ At least one genre should be selected.");
    }
}

// Create showError function
function showError(input, message) {
    let errorMessage = input.parentNode.querySelector(".error-message");
    if(!errorMessage) {
        errorMessage = document.createElement("p");
        errorMessage.className = "error-message";
        input.parentNode.appendChild(errorMessage);
    }
    errorMessage.innerText = message;
    input.style.borderColor = "red";
}

// Create clearError function
function clearError(input) {
    const errorMessage = input.parentNode.querySelector(".error-message");
    if(errorMessage) {
        errorMessage.remove();
        input.style.borderColor = "";
    }
}

// Clear all error messages on form reset
function resetFormErrors() {
    clearError(usernameField);
    clearError(emailField);
    clearError(passwordField);
    clearError(passwordConfirmationField);
    clearError(genresLabel);
}
document.querySelector("form").addEventListener("reset", resetFormErrors);