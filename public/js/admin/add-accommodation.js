document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.message .close-btn').addEventListener('click', function () {
        const messageBox = document.querySelector('.message');
        messageBox.classList.add('hide');
    });
    document.getElementById('main-photo').addEventListener('change', function (event) {
        const file = event.target.file;
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
        }

    });
    document.getElementById('main-photo').addEventListener('change', function (eveny) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('main-photo-preview');
        previewContainer.innerHTML = '';
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-thumbnail')
                img.style.maxWidth = '200px';
                previewContainer.appendChild(img);

            };
            reader.readAsDataURL(file);
        }


    });

    document.getElementById('photos').addEventListener('change', function (event) {
        const files = event.target.files;
        const gallery = document.getElementById('gallery');
        gallery.innerHTML = '';


        Array.from(files).forEach(
            file => {
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('row');
                        img.style.maxWidth = '200px';
                        img.style.marginRight = '10px';
                        gallery.appendChild(img);
                    }
                    reader.readAsDataURL(file);

                }
            }
        );

    })
    document.getElementById('add-hotel-form').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        var url = '/admin/accommodation/store';
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
                document.getElementById('add-hotel-form').reset();

                const successMessageDiv = document.getElementById('successMessage');
                const textElement = successMessageDiv.querySelector('.text');
                document.querySelector('#successMessage .text').textContent = 'The accommodation was added successfully';
                successMessageDiv.classList.remove('hide');
                successMessageDiv.classList.add('show');
                document.getElementById('main-photo-preview').innerHTML = '';
                document.getElementById('gallery').innerHTML = '';

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