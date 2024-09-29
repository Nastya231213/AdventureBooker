@extends('layouts.admin.admin_main')
@section('title', 'Add Hotel')
@section('content')
<div id="successMessage" class="message hide">
    <span class="fas fa-check-circle"></span>
    <span class="text"></span>
    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>
<div class="main-content" id="mainContent">

    <a href="{{route('admin.amenities.index')}}" class="btn btn-primary">
        <i class="bi bi-arrow-left"></i> All Amenity
    </a>
    <form id="edit-amenity-form" enctype="multipart/form-data" class="mx-auto border rounded p-4 user-form">
        @csrf
        @method('PUT')
        <h3 class="my-4 text-center">Edit Amenity</h3>
        <input type="hidden" id="amenity-id" name="amenity_id" value="{{ $amenity->id }}">

        <div class="row mb-3">
            <label for="name" class="col-3 col-form-label">Name</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control" value="{{$amenity->name}}" id="name" name="name">
                <div class="error-message" id="error-name">
                </div>
            </div>
        </div>


        <div class="row mb-3">
            <label for="icon" class="col-3 col-form-label">Icon</label>
            <div class="col-sm-12 col-lg-9">
                <input type="file" class="form-control" id="icon" name="icon" accept="image/*">
                <div class="error-message" id="error-icon"></div>
                <div class="mt-2">
                    <img id="icon_preview" src="{{asset('storage/'.$amenity->icon)}}" width="50" height="50" alt="Image preview">
                </div>
            </div>
        </div>



        <div class="row mb-3">
            <div class="mx-auto col-sm-6">
                <button type="submit" id="add-user-button" class="btn btn-primary w-100">Edit Amenity</button>
            </div>
        </div>
    </form>
</div>


<script src="{{asset('js/admin/form-validation.js')}}"></script>
<script src="{{asset('js/admin/utils/imagePreview.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('edit-amenity-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData();

            formData.append('name', document.getElementById('name').value);
            formData.append('icon', document.getElementById('icon').files[0]);
            formData.append('_method', 'PUT');
            var url = `/admin/amenities/${document.getElementById('amenity-id').value}`;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const successMessageDiv = document.getElementById('successMessage');
                    const textElement = successMessageDiv.querySelector('.text');
                    document.querySelector('#successMessage .text').textContent = data.message;
                    successMessageDiv.classList.remove('hide');
                    successMessageDiv.classList.add('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
        setupImagePreview();
    });
</script>

@endsection