@extends('layouts.admin.admin_main')
@section('title', 'Add Hotel')
@section('content')
<div id="successMessage" class="message success hide">
    <span class="fas fa-check-circle"></span>
    <span class="text"></span>
    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>

<div id="errorMessage" class="message error hide">
    <span class="fas fa-exclamation-circle"></span>
    <span class="text"></span>
    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>

<div class="main-content" id="mainContent">

    <a href="{{route('admin.accommodation.index')}}" class="btn btn-primary">
        <i class="bi bi-arrow-left"></i> All Hotel
    </a>

    <form id="add-hotel-form" enctype="multipart/form-data" class="mx-auto border rounded p-4 user-form">
        @csrf
        <h3 class="my-4 text-center">Edit Accommodation</h3>

        <div class="row mb-3">
            <label for="name" class="col-3 col-form-label">Name</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control" id="name" name="name" value="{{$accommodation->name}}">
                <div class="error-message" id="error-name">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-3 col-form-label">Description</label>
            <div class="col-md-12 col-lg-9">
                <textarea class="form-control" name="description" rows="4">{{ $accommodation->description }}</textarea>
                <div class="error-message" id="error-description">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-3  col-form-label">Address</label>
            <div class="col-md-12 col-lg-9">
                <textarea class="form-control" name="address" rows="3">{{$accommodation->address}}</textarea>
                <div class="error-message" id="error-address">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="type" class="col-3  col-form-label">Type</label>

            <div class="col-md-12 col-lg-9">
                <select class="form-select form-select-md mb-3" name="type" aria-label=".form-select-lg example">
                    @foreach($accommodationTypes as $type)
                    <option value="{{$type->value}}" {{$type==$accommodation->type ?'selected':''}}>
                        {{ucfirst($type->value)}}

                    </option>
                    @endforeach
                </select>
                <div class="error-message" id="error-type">
                </div>

            </div>

        </div>
        <div class="row mb-3">
            <label for="main-photo" class="col-3 col-form-label">Main Photo</label>
            <div class="col-sm-12 col-lg-9">
                <input type="file" class="form-control" id="main-photo" name="main_photo" accept="image/*">
                <div class="error-message" id="error-main_photo"></div>
                <div id="main-photo-preview" class="mt-3"></div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="photos" class="col-3 col-form-label">Photos</label>
            <div class="col-sm-12 col-lg-9">
                <input type="file" class="form-control" id="photos" name="photos[]" multiple accept="image/*">
                <div class="error-message" id="error-photos"></div>
                <div id="gallery" class="mt-3 "></div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="city" class="col-3 col-form-label">Country</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control" value="{{$accommodation->country}}" id="country" name="country">
                <div class="error-message" id="error-country">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="city" class="col-3 col-form-label">City</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control" id="city" value="{{$accommodation->city}}" name="city">
                <div class="error-message" id="error-city">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="mx-auto col-sm-6">
                <button type="submit" id="edit-user-button" class="btn btn-primary w-100">Edit Hotel</button>
            </div>
        </div>
    </form>
</div>

</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('edit-accommodation-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = {
                name: document.getElementById('name').value,
                description: document.getElementById('description').value,
                address: document.getElementById('address').value,
                type: document.getElementById('type').value,
                main_photo: document.getElementById('main_photo').value,
                country: document.getElementById('country').value,
                city: document.getElementById('city').value,
                _method: 'PUT'

            };
            const photosInput = document.getElementById('photos');
            if (photosInput.files.length > 0) {
                for (let i = 0; i < photosInput.files.length; i++) {
                    formData.append('photos[]', photosInput.files[i]);
                }
            }
            fetch('/admin/accommodation/{{$accommodation->id}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');

                }

                return response.json();
            }).then(data => {
                const successMessageDiv = document.getElementById('successMessage');
                const textElement = successMessageDiv.querySelectors('.text');
                textElement.textContent = data.message;
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
</script>
@endsection