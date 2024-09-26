@extends('layouts.admin.admin_main')
@section('title', 'Add Room')
@section('content')
<div id="successMessage" class="message hide">
    <span class="fas fa-check-circle"></span>
    <span class="text"></span>
    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>
<div class="main-content" id="mainContent">


    <form id="add-room-form" enctype="multipart/form-data" class="mx-auto p-4border rounded p-4 user-form">
        @csrf
        <h3 class="my-4 text-center">Add Room to {{ $accommodation->type}}<br> {{ $accommodation->name}} </h3>

        <input value="{{$accommodation->id}}" name="accommodation_id" type="hidden">
        <div class="row mb-3 mt-5">
            <label for="type" class="form-label col-3">Room Type</label>
            <div class="col-md-12 col-lg-8">
                <select name="type" class="form-select">
                    <option value="">Select room type</option>
                    @foreach($roomTypes as $roomType)
                    <option value="{{$roomType}}"> {{$roomType}}</option>
                    @endforeach
                </select>
                <div class="error-message" id="error-type"></div>

            </div>
        </div>
        <div class="row mb-3">
            <label for="price" class="form-label col-3">Price ($)</label>
            <div class="col-md-12 col-lg-8">
                <input type="number" step="0.01" id="price" name="price" class="form-control">
                <div class="error-message" id="error-price"></div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="capacity" class="form-label col-3">Capacity</label>
            <div class="col-md-12 col-lg-8">

                <select id="capacity" name="capacity" class="form-select">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                </select>
                <div class="error-message" id="error-capacity"></div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="photo" class="col-sm-2 col-form-label">Room Photo</label>
            <div class=" col-sm-10">
                <input type="file" class="form-control mt-3" id="photo" name="photo" data-image-type="room" accept="image/*">
                <div class="mt-2">
                    <img id="photo_preview" src="" width="150" alt="Image preview" style="display:none;">
                </div>
                <div class="error-message" id="error-photo">
                </div>
            </div>
        </div>
        <div id="data-container" data-url=""></div>

        <div class="row mb-3 mt-2">
            <div class="mx-auto col-sm-6">
                <button type="submit" id="add-user-button" class="btn btn-primary w-100">Add Room</button>
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
<script src="{{asset('js/admin/form-validation.js')}}"></script>

<script src="{{asset('js/admin/add-room.js')}}">
</script>

@endsection