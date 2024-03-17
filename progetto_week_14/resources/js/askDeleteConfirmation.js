const deleteForm = document.querySelector('form#delete-form');

deleteForm.addEventListener('submit', (e) => {
    if (!confirm('Are you sure you want to delete this project?')) {
        e.preventDefault();
    }
});