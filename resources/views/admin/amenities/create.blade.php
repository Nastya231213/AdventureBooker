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
    <form id="add-amenity-form" enctype="multipart/form-data" class="mx-auto border rounded p-4 user-form">
        @csrf
        <h3 class="my-4 text-center">Add Amenity</h3>

        <div class="row mb-3">
            <label for="name" class="col-3 col-form-label">Name</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control" id="name" name="name">
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
                    <img id="icon_preview" src="" width="50" height="50" alt="Image preview" style="display:none;">
                </div>
            </div>
        </div>



        <div class="row mb-3">
            <div class="mx-auto col-sm-6">
                <button type="submit" id="add-user-button" class="btn btn-primary w-100">Add Amenity</button>
            </div>
        </div>
    </form>
</div>


<script src="{{asset('js/admin/form-validation.js')}}"></script>
<script  src="{{asset('js/admin/utils/imagePreview.js')}}"></script>

<script src="{{asset('js/admin/add-amenity.js')}}"></script>

@endsection