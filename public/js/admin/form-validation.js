
function clearErrors() {
    var allErrorDiv = document.querySelectorAll('.error-message');
    allErrorDiv.forEach(element => {
        element.textContent = '';
    });
}

function displayValidationErrors(errors) {
    for (let field in errors) {
        let errorDiv = document.getElementById(`error-${field}`);
        if (errorDiv) {
            errorDiv.textContent = errors[field][0];
        }
    }
}
