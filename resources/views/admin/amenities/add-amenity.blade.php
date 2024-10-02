@extends('layouts.admin.admin_main')
@section('title', 'Add Room')
@section('content')

@include('partials.flash-messages')
<div class="main-content" id="mainContent">


    <a href="{{route('admin.accommodation.show',$accommodation->id)}}" class="btn btn-primary">
        <i class="bi bi-arrow-left"></i> Back
    </a>
    <form id="add-amenity-to-accommodation" enctype="multipart/form-data" class="mx-auto p-4border rounded p-4 user-form">
        <h3 class="my-4 text-center">Add Amenity to {{ $accommodation->type}}<br> {{ $accommodation->name}} </h3>
        <div class="row mb-3 mt-5">
            <label for="amenity" class="form-label col-3">Amenity</label>
            <div class="col-md-12 col-lg-8">
                <select name="amenity" class="form-select">
                    <option>Select amenity</option>
                    @foreach($amenities as $amenity)
                    <option value="{{$amenity->id}}">
                        {{$amenity->name}}
                    </option>
                    @endforeach

                </select>

                <div class="error-message" id="error-amenity"></div>

            </div>
        </div>
        <div class="row mb-3 mt-2">
            <div class="mx-auto col-sm-6">
                <button type="submit" id="add-user-button" class="btn btn-primary w-100">Add Amenity</button>
            </div>
        </div>
    </form>
</div>
<script src=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-amenity-to-accommodation').addEventListener('submit', function() {
            event.preventDefault();
            const formData = new FormData(this);;
            var accommodationId = "{{ $accommodation->id }}";
            var url = `/admin/amenities/${accommodationId}/store`;

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
                } else if (response.status === 404) {
                    return response.json().then(data => {
                        const errorMessageDiv = document.getElementById('errorMessage');
                        const textElement = errorMessageDiv.querySelector('.text');
                        document.querySelector('#errorMessage .text').textContent = data.message;
                        errorMessageDiv.classList.remove('hide');
                        errorMessageDiv.classList.add('show');
                    });
                } else {
                    return response.json();
                }
            }).then(data => {
                if (data && data.success) {
                    document.getElementById('add-amenity-to-accommodation').reset();
                    const successMessageDiv = document.getElementById('successMessage');
                    const textElement = successMessageDiv.querySelector('.text');
                    document.querySelector('#successMessage .text').textContent = data.message;
                    successMessageDiv.classList.remove('hide');
                    successMessageDiv.classList.add('show');

                }
            }).catch(error => {
                console.error('Error:', error);
                alert(error.message);
            });
        });
    });
</script>


@endsection