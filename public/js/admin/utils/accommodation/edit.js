document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('delete').addEventListener('submit', function (e) {

    });

    document.getElementById('edit-accommodation-form').addEventListener('submit', function (e) {
        e.preventDefault();
        var accommodationId = "{{ $accommodation->id }}";

        const formData = {
            name: document.getElementById('name').value,
            description: document.getElementById('description').value,
            address: document.getElementById('address').value,
            country: document.getElementById('country').value,
            city: document.getElementById('city').value,
            type: document.getElementById('type').value,

            _method: 'PUT'
        };

        const photosInput = document.getElementById('photos');
        if (photosInput.files.length > 0) {
            for (let i = 0; i < photosInput.files.length; i++) {
                formData.append('photos[]', photosInput.files[i]);
            }
        }
        fetch(`/admin/accommodation/update/${accommodationId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(formData)
        }).then(response => {
            if (!response.ok && response.status === 500) {
                return response.json().then(data => {
                    const errorMessageDiv = document.getElementById('errorMessage');
                    const textElement = errorMessageDiv.querySelector('.text');
                    textElement.textContent = data.error;
                    errorMessageDiv.classList.remove('hide');
                });
            }

            return response.json();
        }).then(data => {

            const successMessageDiv = document.getElementById('successMessage');

            const textElement = successMessageDiv.querySelector('.text');
            textElement.textContent = data.message;

            successMessageDiv.classList.remove('hide');


        }).catch(error => {
            console.error('Error:', error);
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
