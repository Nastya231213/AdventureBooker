document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('add-amenity-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        var url = '/admin/amenities/store';
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
        }

        ).then(
            data => {
                if (data && data.success) {
                    document.getElementById('add-amenity-form').reset();
                    const successMessageDiv = document.getElementById('successMessage');
                    const textElement = successMessageDiv.querySelector('.text');
                    document.querySelector('#successMessage .text').textContent = data.message;
                    successMessageDiv.classList.remove('hide');
                    successMessageDiv.classList.add('show');
                    document.getElementById('main-photo-preview').innerHTML = '';
                    document.getElementById('gallery').innerHTML = '';
                }
            }
        );
    });
    setupImagePreview();
});