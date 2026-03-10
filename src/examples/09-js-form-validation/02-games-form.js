// 09-2: Games-style form validation (formHandler pattern)

let submitBtn = document.getElementById('submit_btn');
let gameForm = document.getElementById('game_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let releaseDateInput = document.getElementById('release_date');
let genreIdInput = document.getElementById('genre_id');
let descriptionInput = document.getElementById('description');
let platformIdsInput = document.getElementsByName('platform_ids[]');
let imageInput = document.getElementById('image');

let titleError = document.getElementById('title_error');
let releaseDateError = document.getElementById('release_date_error');
let genreIdError = document.getElementById('genre_id_error');
let descriptionError = document.getElementById('description_error');
let platformIdsError = document.getElementById('platform_ids_error');
let imageError = document.getElementById('image_error');

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
    releaseDateError.innerHTML = errors.release_date || '';
    genreIdError.innerHTML = errors.genre_id || '';
    descriptionError.innerHTML = errors.description || '';
    platformIdsError.innerHTML = errors.platform_ids || '';
    imageError.innerHTML = errors.image || '';
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

    const titleMin = Number(titleInput.dataset.minlength || 3);
    const titleMax = Number(titleInput.dataset.maxlength || 255);
    const descMin = Number(descriptionInput.dataset.minlength || 10);

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

    // release_date
    if (!isRequired(releaseDateInput.value)) {
        addError('release_date', 'Release year is required.');
    } else {
        const date = new Date(releaseDateInput.value);
        if (Number.isNaN(date.getTime())) {
            addError('release_date', 'Please enter a valid date.');
        }
    }

    // genre_id
    if (!isRequired(genreIdInput.value)) {
        addError('genre_id', 'Genre is required.');
    }

    // description
    if (!isRequired(descriptionInput.value)) {
        addError('description', 'Description is required.');
    } else if (!isMinLength(descriptionInput.value, descMin)) {
        addError(
            'description',
            'Description must be at least ' + descMin + ' characters.'
        );
    }

    // platform_ids
    let platformChecked = false;
    for (let i = 0; i < platformIdsInput.length; i++) {
        if (platformIdsInput[i].checked) {
            platformChecked = true;
            break;
        }
    }
    if (!platformChecked) {
        addError('platform_ids', 'Select at least one platform.');
    }

    // image
    if (!imageInput.files || imageInput.files.length === 0) {
        addError('image', 'Image is required.');
    }

    showErrorSummaryTop();
    showFieldErrors();

    if (Object.keys(errors).length === 0) {
        alert(
            'Game form is valid. In a real app, this would submit to the server.'
        );
        // gameForm.submit();
    }
}
