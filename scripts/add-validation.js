/*
 * Name: Ha Nhu Y Tran, Qian Cheng - Group 9
 * Assignment 2
 * Date: Nov 23, 2024
 * Description: This file contains JavaScript validation for a form to add a new book. Each field is validated with a corresponding error message and the hightlited field
 * in order to notify users and ensure the correct format of entered data.
 */

// Select all input fields by their id
let titleInput = document.querySelector("#title");
let authorInput = document.querySelector("#author");
let isbnInput = document.querySelector("#isbn");
let publicationYearInput = document.querySelector("#publication_year");
let summaryInput = document.querySelector("#summary");
let referenceSourceInput = document.querySelector("#reference_source");
let genreInputs = document.querySelectorAll('input[name="genre_id"]');

// Create paragraphs for error messages and append them to the respective fields
let titleError = document.createElement('p');
titleError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[0].append(titleError);

let authorError = document.createElement('p');
authorError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[1].append(authorError);

let isbnError = document.createElement('p');
isbnError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[2].append(isbnError);

let genreError = document.createElement('p');
genreError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[3].append(genreError);

let publicationYearError = document.createElement('p');
publicationYearError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[4].append(publicationYearError);

let summaryError = document.createElement('p');
summaryError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[5].append(summaryError);

let referenceSourceError = document.createElement('p');
referenceSourceError.setAttribute("class", "warning");
document.querySelectorAll(".textfield")[6].append(referenceSourceError);



// Define error messages
let defaultMsg = "";
let titleErrorMsg = "X Book title is required and cannot exceed 100 characters long.";
let authorErrorMsg = "X Author name is required and cannot exceed 50 characters long.";
let isbnErrorMsg = "X ISBN must be exactly 13 digit long.";
let publicationYearErrorMsg = "X Publication year must be 4-digit.";
let summaryErrorMsg = "X Summary is required and cannot exceed 1500 characters.";
let referenceSourceErrorMsg = " X Reference link is required and cannot exceed 200 characters.";
let genreErrorMsg = "X Please select a genre for the added book.";

// Validate Title
function validateTitle() {
    let title = titleInput.value;
    if (title.length === 0 || title.length > 100) {
        return titleErrorMsg;}
    else if (title.length >0 && title.length <= 100){
        return defaultMsg;
    }
    }

// Validate Author
function validateAuthor() {
    let author = authorInput.value;
    if (author.length ===0 || author.length > 50) {
        return authorErrorMsg;} 
    else if (author.length >0 && author.length <=50) {
        return defaultMsg;
    }
}

// Validate ISBN
function validateIsbn() {
    let isbn = isbnInput.value;
    let isbnRegex = /^\d{13}$/; // Matches exactly 13 digits

    if (isbnRegex.test(isbn)) {
        return defaultMsg;
    } else {
        return isbnErrorMsg;
    }
}


// Validate Genre
function validateGenre() {
    let genreChecked = false;
    
    // Loop through each genre input and check if it's checked
    for (let input of genreInputs) {
        if (input.checked) {
            genreChecked = true;
            break; // Exit loop as soon as one is checked
        }
    }
    
    if (genreChecked) {
        genreError.textContent = "";
        return defaultMsg;
    } else {
        genreError.textContent = genreErrorMsg;
        return genreErrorMsg;
    }
}

// Validate Publication Year
function validatePublicationYear() {
    let publicationYear = publicationYearInput.value;
    let yearRegex = /^\d{4}$/; // Regular expression to match exactly 4 digits
    
    if (yearRegex.test(publicationYear) ) {
        return defaultMsg;
    } else {
        return publicationYearErrorMsg;
    }
}

// Validate Summary
function validateSummary() {
    let summary = summaryInput.value;
    if (summary.length === 0 || summary.length > 1500) {
        return summaryErrorMsg;}
    else if (summary.length >0 && summary.length <= 1500){
        return defaultMsg;
    }
    }

// Validate Reference Source
function  validateReferenceSource() {
    let referenceSource = referenceSourceInput.value;
    if (referenceSource.length === 0 || referenceSource.length > 200) {
        return referenceSourceErrorMsg;}
    else if (referenceSource.length >0 && referenceSource.length <= 200){
        return defaultMsg;
    }
    }


// Event handler for submit event
function validateForm() {
    let valid = true; // global validation 

    // Validate each field and update corresponding error message
    let titleValidation = validateTitle();
    if (titleValidation !== defaultMsg) {
        titleInput.classList.add("field-highlight");
        titleError.textContent = titleValidation;
        valid = false;
    }

    let authorValidation = validateAuthor();
    if (authorValidation !== defaultMsg) {
        authorInput.classList.add("field-highlight");
        authorError.textContent = authorValidation;
        valid = false;
    }

    let isbnValidation = validateIsbn();
    if (isbnValidation !== defaultMsg) {
        isbnInput.classList.add("field-highlight");
        isbnError.textContent = isbnValidation;
        valid = false;
    }

    let genreValidation = validateGenre();
    if (genreValidation !== defaultMsg) {
        genreError.textContent = genreValidation;
        valid = false;
    }

    let publicationYearValidation = validatePublicationYear();
    if (publicationYearValidation !== defaultMsg) {
        publicationYearInput.classList.add("field-highlight");
        publicationYearError.textContent = publicationYearValidation;
        valid = false;
    }

    let summaryValidation = validateSummary();
    if (summaryValidation !== defaultMsg) {
        summaryInput.classList.add("field-highlight");
        summaryError.textContent = summaryValidation;
        valid = false;
    }

    let referenceSourceValidation = validateReferenceSource();
    if (referenceSourceValidation !== defaultMsg) {
        referenceSourceInput.classList.add("field-highlight");
        referenceSourceError.textContent = referenceSourceValidation;
        valid = false;
    }

    return valid;
}

// Clear all error messages and remove highlights
function resetFormErrors() {
    titleError.textContent = defaultMsg;
    authorError.textContent = defaultMsg;
    isbnError.textContent = defaultMsg;
    genreError.textContent = defaultMsg;
    publicationYearError.textContent = defaultMsg;
    summaryError.textContent = defaultMsg;
    referenceSourceError.textContent = defaultMsg;

    titleInput.classList.remove("field-highlight");
    authorInput.classList.remove("field-highlight");
    isbnInput.classList.remove("field-highlight");
    publicationYearInput.classList.remove("field-highlight")
    summaryInput.classList.remove("field-highlight");
    referenceSourceInput.classList.remove("field-highlight");

}
document.querySelector("form").addEventListener("reset", resetFormErrors);

// Event listener for title validation to clear error message if valid title entered
titleInput.addEventListener("blur", () => { 
    let x = validateTitle();
    if (x === defaultMsg) {
        titleError.textContent = defaultMsg; 
        titleInput.classList.remove("field-highlight");
    }
});

// Event listener for author validation to clear error message if valid author entered
authorInput.addEventListener("blur", () => { 
    let x = validateAuthor();
    if (x === defaultMsg) {
        authorError.textContent = defaultMsg; 
        authorInput.classList.remove("field-highlight");
    }
});

// Event listener for ISBN validation to clear error message if valid ISBN entered
isbnInput.addEventListener("blur", () => { 
    let x = validateIsbn();
    if (x === defaultMsg) {
        isbnError.textContent = defaultMsg; 
        isbnInput.classList.remove("field-highlight");
    }
});

// Event listener for publication year validation to clear error message if valid year entered
publicationYearInput.addEventListener("blur", () => { 
    let x = validatePublicationYear();
    if (x === defaultMsg) {
        publicationYearError.textContent = defaultMsg; 
        publicationYearInput.classList.remove("field-highlight");
    }
});

genreInputs.forEach(function(genreRadio) {
    genreRadio.addEventListener("change", function() {
        if (this.checked) {
            genreError.textContent = defaultMsg;  // Clear the error message when a radio button is selected
        }
    });
});

// Event listener for summary validation to clear error message if valid summary length entered
summaryInput.addEventListener("blur", () => { 
    let x = validateSummary();
    if (x === defaultMsg) {
        summaryError.textContent = defaultMsg; 
        summaryInput.classList.remove("field-highlight");
    }
});

// Event listener for reference source validation to clear error message if valid reference source entered
referenceSourceInput.addEventListener("blur", () => { 
    let x = validateReferenceSource();
    if (x === defaultMsg) {
        referenceSourceError.textContent = defaultMsg; 
        referenceSourceInput.classList.remove("field-highlight");
    }
});


