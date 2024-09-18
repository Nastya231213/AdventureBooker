@extends('layouts.admin.admin_main')
@section('title', 'Dashboard')
@section('content')
<div class="main-content" id="mainContent">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>Go Back</a>
    <h2 class="text-center">All the accommodation</h2>

    <div id="container_hotel">
        @foreach($accommodation as $item)
        <div class="card ">
            <img class="card-img-top" src="{{ asset('storage/'.$item->main_photo) }}" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $item->name}}</h5>
                <p class="card-text">{{Str::limit( $item->description,100)}}</p>
                <div class="d-flex justify-content-center ">
                    <a href="{{route('admin.accommodation.show',$item->id)}}" class="btn btn_about mx-2">About</a>
                    <a href="#" class="btn btn_add_service mx-2">Add Service</a>
                    <a href="{{route('admin.rooms.create',$item->id)}}" class="btn btn-success mx-2">Add Room</a>

                </div>
            </div>
        </div>

        @endforeach
        <div class="mt-4 p-4">
            {{$accommodation->links('pagination::bootstrap-5')}}
        </div>
    </div>
</div>

@endsection