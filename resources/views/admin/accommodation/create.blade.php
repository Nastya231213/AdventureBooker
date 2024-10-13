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
    <span class="text">sdfssssss</span>
    <span class="close-btn"><span class="fas fa-times"></span></span>
</div>

<div class="main-content" id="mainContent">

    <a href="{{route('admin.accommodation.index')}}" class="btn btn-primary">
        <i class="bi bi-arrow-left"></i> All Hotel
    </a>

    <form id="add-hotel-form" enctype="multipart/form-data" class="mx-auto border rounded p-4 user-form">
        @csrf
        <h3 class="my-4 text-center">Add Accommodation</h3>

        <div class="row mb-3">
            <label for="name" class="col-3 col-form-label">Name</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control" id="name" name="name">
                <div class="error-message" id="error-name">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-3 col-form-label">Description</label>
            <div class="col-md-12 col-lg-9">
                <textarea class="form-control" name="description" rows="4"></textarea>
                <div class="error-message" id="error-description">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="email" class="col-3  col-form-label">Address</label>
            <div class="col-md-12 col-lg-9">
                <textarea class="form-control" name="address" rows="3"></textarea>
                <div class="error-message" id="error-address">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label for="type" class="col-3  col-form-label">Type</label>

            <div class="col-md-12 col-lg-9">
                <select class="form-select form-select-md mb-3" name="type" aria-label=".form-select-lg example">
                    <option selected>Open this select menu</option>
                    @foreach($accommodationTypes as $type)
                    <option value="{{$type->value}}">{{ucfirst($type->value)}}</option>
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
                <input type="text" class="form-control" id="country" name="country">
                <div class="error-message" id="error-country">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="city" class="col-3 col-form-label">City</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control" id="city" name="city">
                <div class="error-message" id="error-city">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="mx-auto col-sm-6">
                <button type="submit" id="add-user-button" class="btn btn-primary w-100">Add Hotel</button>
            </div>
            
        </div>
    </form>
</div>

</div>
<script src="{{asset('js/admin/add-accommodation.js')}}"></script>
@endsection