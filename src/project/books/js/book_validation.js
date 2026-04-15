// 09-2: Games-style form validation (formHandler pattern)

let submitBtn = document.getElementById('submit_btn');
let bookForm = document.getElementById('book_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let yearInput = document.getElementById('year');
let publisherIdInput = document.getElementById('publisher_id');
let descriptionInput = document.getElementById('description');
let formatIdsInput = document.getElementsByName('format_ids[]');
let imageInput = document.getElementById('image');
let isbnInput = document.getElementById('isbn');
let authorInput = document.getElementById('author');

let titleError = document.getElementById('title_error');
let yearError = document.getElementById('year_error');
let publisherIdError = document.getElementById('publisher_id_error');
let descriptionError = document.getElementById('description_error');
let formatIdsError = document.getElementById('format_ids_error');
let isbnError = document.getElementById('isbn_error');
let imageError = document.getElementById('image_error');
let authorError = document.getElementById('author_error');

let errors = {};

submitBtn.addEventListener('click', onSubmitForm);

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showErrorSummaryTop() {
    const messages = Object.values(errors);
    if (messages.length === 0) {
        errorSummaryTop.style.display = 'none';
        errorSummaryTop.innerHTML = '';
        return;
    }
    errorSummaryTop.innerHTML =
        '<strong>Please fix the following:</strong><ul>' +
        messages
            .map(function (m) {
                return '<li>' + m + '</li>';
            })
            .join('') +
        '</ul>';
    errorSummaryTop.style.display = 'block';
}

function showFieldErrors() {
    titleError.innerHTML = errors.title || '';
    yearError.innerHTML = errors.year || '';
    publisherIdError.innerHTML = errors.publisher_id || '';
    descriptionError.innerHTML = errors.description || '';
    formatIdsError.innerHTML = errors.format_ids || '';
    imageError.innerHTML = errors.image || '';
    isbnError.innerHTML = errors.isbn || '';
    authorError.innerHTML = errors.author || '';
}

function isRequired(value) {
    return String(value).trim() !== '';
}

function isMinLength(value, min) {
    return String(value).trim().length >= min;
}

function isMaxLength(value, max) {
    return String(value).trim().length <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = {};

   let titleMin = titleInput.dataset.minlength ||3;
    let titleMax = titleInput.dataset.maxlength ||255;
    let isbnMin = isbnInput.dataset.minlength ||13;
    let isbnMax = isbnInput.dataset.maxlength ||13;
    let descMin = 10;

    
    // title
    if (!isRequired(titleInput.value)) {
        addError('title', 'Title is required.');
    } else if (!isMinLength(titleInput.value, titleMin)) {
        addError(
            'title',
            'Title must be at least ' + titleMin + ' characters.'
        );
    } else if (!isMaxLength(titleInput.value, titleMax)) {
        addError('title', 'Title must be at most ' + titleMax + ' characters.');
    }

    //isbn
    if (!isRequired(isbnInput.value)) {
        addError('isbn', 'ISBN is required.');
    }
    else if (!isMinLength(isbnInput.value, isbnMin)) {
        addError(
            'isbn',
            'Isbn must be at least ' + isbnMin + ' characters.'
        );
    } else if (!isMaxLength(isbnInput.value, isbnMax)) {
        addError('isbn', 'Isbn must be at most ' + isbnMax + ' characters.');
    }

    // year
    if (!isRequired(yearInput.value)) {
        addError('year', 'Release year is required.');
    } else {
        const date = new Date(yearInput.value);
        if (Number.isNaN(date.getTime())) {
            addError('year', 'Please enter a valid date.');
        }
        let year = date.getFullYear();
        let today = new Date();
        if (year < 1900) {
            addError('year', 'Please enter a year greater than or equal to 1900.');
        }
        else if (year > today.getFullYear()) {
            addError('year', 'Please enter a year less than or equal to ' + today.getFullYear() + '.');
        }
    }

    // Publisher
    if (!isRequired(publisherIdInput.value)) {
        addError('publisher_id', 'Publisher is required.');
    }

    // description
    if (!isRequired(descriptionInput.value)) {
        addError('description', 'Description is required.');
    } else if (!isMinLength(descriptionInput.value, descMin)) {
        addError(
            'description', 
            `Description must be at least ${descMin} characters.`
        );
    }

    // platform_ids
    let formatChecked = false;
    for (let i = 0; i < formatIdsInput.length; i++) {
        if (formatIdsInput[i].checked) {
            formatChecked = true;
            break;
        }
    }
    if (!formatChecked) {
        addError('format_ids', 'Select at least one format.');
    }

    // image
    if (!imageInput.files || imageInput.files.length === 0) {
        addError('image', 'Image is required.');
    }

    showErrorSummaryTop();
    showFieldErrors();

    if (Object.keys(errors).length === 0) {
        // alert(
        //     'Book form is valid. In a real app, this would submit to the server.'
        // );
        bookForm.submit();
    }
}
