// 09-1: Comment-style form validation (formHandler pattern)

let submitBtn = document.getElementById('submit_btn');
let commentForm = document.getElementById('comment_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let nameInput = document.getElementById('name');
let categoryInput = document.getElementById('category');
let experienceInput = document.getElementsByName('experience');
let languagesInput = document.getElementsByName('languages[]');

let nameError = document.getElementById('name_error');
let categoryError = document.getElementById('category_error');
let experienceError = document.getElementById('experience_error');
let languagesError = document.getElementById('languages_error');

let errors = {};

if (commentForm && submitBtn) {
    submitBtn.addEventListener('click', onSubmitForm);
}

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showFieldErrors() {
    nameError.innerHTML = errors.name || '';
    categoryError.innerHTML = errors.category || '';
    experienceError.innerHTML = errors.experience || '';
    languagesError.innerHTML = errors.languages || '';
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errorMessages = [];
    errors = {};

    // name validation
    if (nameInput.value.trim() === '') {
        addError('name', 'Name is required.');
    } else if (!/^[a-zA-Z\-' ]*$/.test(nameInput.value)) {
        addError('name', 'Name can only contain letters and white space.');
    }

    // category validation
    if (categoryInput.value === '') {
        addError('category', 'Category is required.');
    }

    // experience validation
    let expSelected = false;
    for (let i = 0; i !== experienceInput.length; i++) {
        if (experienceInput[i].checked) {
            expSelected = true;
            break;
        }
    }
    if (!expSelected) {
        addError('experience', 'Experience is required.');
    }

    // languages validation
    let langSelected = false;
    for (let i = 0; i !== languagesInput.length; i++) {
        if (languagesInput[i].checked) {
            langSelected = true;
            break;
        }
    }
    if (!langSelected) {
        addError('languages', 'Select at least one language.');
    }

    showFieldErrors();

    if (Object.keys(errors).length === 0) {
        commentForm.submit();
    }
}
