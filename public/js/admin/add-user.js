document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.message .close-btn').addEventListener('click', function () {
        const messageBox = document.querySelector('.message');
        messageBox.classList.add('hide');
    });

    document.getElementById('add-user-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        clearErrors();
        var url = '/admin/users/store';
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            if (response.status === 422) {
                return response.json().then(errorData => {
                    if (errorData.errors) {
                        $allErrorDiv = document.querySelectorAll('.error-message');
                        displayValidationErrors(errorData.errors);
                    }
                });
            } else {
                return response.json();
            }
        }).then(data => {
            if (data && data.success) {
                document.getElementById('add-user-form').reset();
                const successMessageDiv = document.getElementById('successMessage');
                const textElement = successMessageDiv.querySelector('.text');
                document.querySelector('#successMessage .text').textContent = 'The user was added successfully';
                successMessageDiv.classList.remove('hide');
                successMessageDiv.classList.add('show');

            }
        }).catch(error => {
            console.error('Error:', error);
            alert(error.message);
        });
    });

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
});