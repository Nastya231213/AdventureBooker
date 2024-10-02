@extends('layouts.admin.admin_main')
@section('title', 'Dashboard')
@section('content')

<div class="main-content" id="mainContent">
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Users <i class="bi bi-people-fill"></i></h5>
                    <p class="card-text">Total users: </p>
                    <a href="{{route('admin.users.index')}}" class="btn btn-primary">View All Users</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Accommodation <i class="bi bi-building"></i></h5>
                    <p class="card-text">Total places to stay :</p>
                    <a href="{{route('admin.accommodation.index')}}" class="btn btn-primary">Manage Hotels</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Tours <i class="bi bi-map"></i></h5>
                    <p class="card-text">Total tours: </p>
                    <a href="#" class="btn btn-primary">Manage Tours</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Bookings <i class="bi bi-calendar-check"></i></h5>
                    <p class="card-text">Total bookings:</p>
                    <a href="#" class="btn btn-primary">Manage Bookings</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Services <i class="bi bi-calendar-check"></i></h5>
                    <p class="card-text">Total services:</p>
                    <a href="#" class="btn btn-primary">Manage Bookings</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Revenue <i class="bi bi-currency-dollar"></i></h5>
                    <p class="card-text">Total revenue: </p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Amenities <i class="bi bi-tools"></i></h5>
                    <p class="card-text">Total amenities: {{$amenitiesCount}}</p>
                    <a href="{{route('admin.amenities.index')}}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection