@extends('layouts.admin.admin_main')
@section('title', 'Dashboard')
@section('content')
<div class="main-content" id="mainContent">

    <div class="container">
        <div class="rating">

        </div>
        <h1>{{$accommodation->name}}</h1>
        <div class="address"><i class="bi bi-geo-alt-fill"></i> {{$accommodation->address}}</div>

        <div class="row mt-1">

            <div class="col-md-9">
                <div class="row">
                    <div class="col-12 col-md-9 d-flex flex-column">
                        <a href="{{asset('/storage/'.$accommodation->main_photo)}}" data-fancybox="gallery">
                            <img src="{{asset('/storage/'.$accommodation->main_photo)}}" class="img-fluid mb-3" alt="Main Photo">
                        </a>

                    </div>

                    <div class="col-12 col-md-3 d-flex flex-column">
                        @foreach($accommodation->photos as $photo)
                        @if($loop->index < 2 || count($accommodation->photos)< 4)
                                <a href="{{asset('/storage/'.$photo->path)}}" data-fancybox="gallery">

                                <img src="{{asset('/storage/'.$photo->path)}}" class="img-fluid mb-3" alt="Main Photo">
                                </a>
                                @elseif($loop->index==2)
                                <div class="position-relative">
                                    <div class="overlay"></div>

                                    <a href="{{ asset('/storage/'.$photo->path) }}" data-fancybox="gallery">
                                        <img src="{{ asset('/storage/'.$photo->path) }}" class="img-fluid" alt="Photo">
                                    </a>
                                    <div class="more_photos text-white p-2">
                                        <span class="text-white text-decoration-underline">More Photos </span>
                                    </div>
                                </div>
                                @else <a href="{{ asset('/storage/'.$photo->path) }}" data-fancybox="gallery" class="d-none">
                                    <img src="{{ asset('/storage/'.$photo->path) }}" alt="Photo">
                                </a>
                                @endif
                                @endforeach


                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 d-flex flex-column">
                <div class="card_review mb-3">
                    <div class="guest_rating">
                        <div class="d-flex flex-column align-items-end ">
                            <h3>Excellentsfs!</h3>
                            <p class="quantity_reviews">15 3543 reviews</p>

                        </div>

                        <div class="d-flex ">

                            <div class="value">
                                55
                            </div>
                        </div>

                    </div>
                    <hr>
                    What did guests who stayed here like?
                    <div class="review">
                        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <p class="review-text">"The hotel was very clean and the staff was incredibly friendly."</p>
                                </div>
                                <div class="carousel-item">
                                    <p class="review-text">"Great location, close to all the major attractions."</p>
                                </div>
                                <div class="carousel-item">
                                    <p class="review-text">"Comfortable beds and a quiet atmosphere."</p>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>

                <iframe width="100%" height="200" src="https://maps.google.com/maps?q={{ urlencode($accommodation->address) }}&output=embed"></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="description">
                    {{$accommodation->description}}
                </div>

            </div>
          

        </div>
        <h3> The most popular amenities and services</h3>
        <div class="row">

        </div>


    </div>


</div>

@endsection