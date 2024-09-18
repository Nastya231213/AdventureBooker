@extends('layouts.admin.admin_main')
@section('title', 'Add User')
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
        <div class="row mb-3 mt-5">
            <label for="type" class="form-label col-3">Room Type</label>
            <div class="col-md-12 col-lg-8">
                <select name="type" class="form-select">
                    <option value="">Select room type</option>
                    @foreach($roomTypes as $roomType)
                    <option value="{{$roomType}}"> {{$roomType}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="price" class="form-label col-3">Price ($)</label>
            <div class="col-md-12 col-lg-8">
                <input type="number" step="0.01" id="price" name="price" class="form-control" required>

            </div>
        </div>
        <div class="row mb-3">
            <label for="capacity" class="form-label col-3">Capacity</label>
            <div class="col-md-12 col-lg-8">

                <select id="capacity" name="capacity" class="form-select" required>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                </select>
            </div>
        </div>
        <div class="row mb-3 mt-2">
            <div class="mx-auto col-sm-6">
                <button type="submit" id="add-user-button" class="btn btn-primary w-100">Add Room</button>
            </div>
        </div>


    </form>
</div>
<script>


</script>

@endsection