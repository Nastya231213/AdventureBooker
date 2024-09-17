@extends('layouts.admin.admin_main')
@section('title', 'Edit User')
@section('content')
<div id="successMessage" class="message hide">
    <span class="fas fa-check-circle"></span>
    <span class="text"></span>
    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>
<div class="main-content" id="mainContent">

    <a href="{{route('admin.users.index')}}" class="btn btn-primary">
        <i class="bi bi-arrow-left"></i> All Users
    </a>

    <form id="edit-user-form" enctype="multipart/form-data" class="mx-auto border rounded p-4 user-form">
        @csrf
        @method('PUT')
        <input type="hidden" id="user-id" name="user_id" value="{{ $user->id }}">

        <h3 class="my-4 text-center">Edit User</h3>

        <div class="row mb-3">
            <label for="name" class="col-3 col-form-label">Name</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control" value="{{$user->name}}" id="name" name="name">
                <div class="error-message" id="error-name">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="name" class="col-3 col-form-label">Surname</label>
            <div class="col-md-12 col-lg-9">
                <input type="text" class="form-control" value="{{$user->surname}}" id="surname" name="surname">
                <div class="error-message" id="error-surname">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-3  col-form-label">Email</label>
            <div class=" col-12 col-lg-9">
                <input type="email" class="form-control" value="{{$user->email}}" id="email" name="email">
                <div class="error-message" id="error-email">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="phone_number" class="col-sm-3 col-form-label">Phone number</label>
            <div class="col-12 col-lg-9">
                <input type="text" class="form-control" value="{{$user->phone_number}}" id="phone_number" name="phone_number">
                <div class="error-message" id="error-phone_number">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-sm-3 col-form-label">New Password</label>
            <div class="col-md-12 col-lg-9">
                <input type="password" class="form-control" id="password" name="new_password">
                <div class="error-message" id="error-password">
                </div>
            </div>

        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-3 col-form-label">Confirm password</label>
            <div class="col-md-12 col-lg-9">
                <input type="password" class="form-control" name="password_confirmation">
             
            </div>

        </div>
        <div class="row mb-3">
            <label for="is_admin" class="col-sm-2 col-form-label">Admin</label>
            <div class="col-sm-12 col-lg-10">
                <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}>
                <label class="form-check-label fs-6 fs-md-5" for="is_admin">Check if the user should be an admin</label>
                <div class="error-message"></div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="profile_photo" class="col-sm-2 col-form-label">Profile Photo</label>
            <div class=" col-sm-10">
                <input type="file" class="form-control mt-3" id="photo" name="photo" data-image-type="profile" accept="image/*">
                <div class="mt-2">
                    <img id="photo_preview" src="{{ isset($user->profile_photo) ? asset('storage/profile_photos/' . $user->profile_photo) : '' }}" width="150" alt="Image preview" style="{{ isset($user->profile_photo) ? '' : 'display:none;' }}">

                </div>
                <div class="error-message" id="error-photo">
                </div>
            </div>

        </div>
        <div id="data-container" data-url=""></div>

        <div class="row mb-3">
            <div class="mx-auto col-sm-6">
                <button type="submit" id="add-user-button" class="btn btn-primary w-100">Edit User</button>
            </div>
        </div>
    </form>
</div>
<div class=" modal fade" id="cropper-modal" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="crop-image" src="" alt="Crop Image" style="max-width: 100%;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="cancel_button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop-button">Crop & Upload</button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/admin/cropper.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateForm = document.getElementById('edit-user-form');
        document.querySelector('.message .close-btn').addEventListener('click', function() {
            const messageBox = document.querySelector('.message');
            messageBox.classList.add('hide');
        });

        updateForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone_number: document.getElementById('phone_number').value,
                surname: document.getElementById('surname').value,
                password: document.getElementById('password').value,
                _method: 'PUT'
            };


            fetch('/admin/users/{{ $user->id }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const successMessageDiv = document.getElementById('successMessage');
                    const textElement = successMessageDiv.querySelector('.text');
                    document.querySelector('#successMessage .text').textContent = 'The user was updated successfully';
                    successMessageDiv.classList.remove('hide');
                    successMessageDiv.classList.add('show');
                })
                .catch(error => {
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