// 08-1: Basic event listeners

const box = document.getElementById('box');
const toggleBoxBtn = document.getElementById('toggle_box_btn');
const preview = document.getElementById('preview');
const previewInput = document.getElementById('preview_input');

function toggleBoxVisibility(box) {
    box.classList.toggle('hidden');
}

function updatePreview(previewElement, text) {
    const trimmed = text.trim();
    if (trimmed === '') {
        previewElement.textContent = '(nothing yet)';
        previewElement.classList.add('empty');
    } else {
        previewElement.textContent = trimmed;
        previewElement.classList.remove('empty');
    }
}

toggleBoxBtn.addEventListener('click', () => {
    toggleBoxVisibility(box);
});

previewInput.addEventListener('input', (event) => {
    updatePreview(preview, event.target.value);
});
