@extends('layouts.app')
@section('title','Main')
@section('content')
<div class=" bg-image" style="background-image: url('{{ asset('images/hotel.webp') }}');">
    <div id="search-accommodation">
        <div class="booking-section">
            <div>
                <p>Where would you like to stay?</p>
                <select id="city" name="city" class=" form-select">>
                    <option value="">Select your destination</option>
                    <option value="Kyiv">Kyiv</option>
                    <option value="Paris">Paris</option>

                </select>
            </div>
            <div class="date">
                <p>Arrival date</p>
                <input type="date" id="start-date" name="start-date" class="form-control " placeholder="Start Date">
            </div>
            <div class="date">
                <p>Departure date</p>
                <input type="date" id="end-date" name="end-date" class="form-control  " placeholder="End Date">
            </div>
            <div>
                <p>Rooms and guests</p>

                <div class="dropdown w-100">
                    <input type="text" class="form-control dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" placeholder="Guests & Rooms" readonly>
                    <ul class="dropdown-menu p-3" aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                            <label for="adults" class="form-label">Adults</label>
                            <select id="adults" name="adults" class="form-select" onchange="updateDropdown()">
                                <option value="1">1 Adult</option>
                                <option value="2">2 Adults</option>
                                <option value="3">3 Adults</option>
                                <option value="4">4 Adults</option>
                                <option value="5">5 Adults</option>
                            </select>
                        </li>
                        <li class="mb-2">
                            <label for="children" class="form-label">Children</label>
                            <select id="children" name="children" class="form-select" onchange="updateDropdown()">
                                <option value="0">0 Children</option>
                                <option value="1">1 Child</option>
                                <option value="2">2 Children</option>
                                <option value="3">3 Children</option>
                                <option value="4">4 Children</option>
                                <option value="5">5 Children</option>
                            </select>
                        </li>
                        <li class="mb-2">
                            <label for="rooms" class="form-label">Rooms</label>
                            <select id="rooms" name="rooms" class="form-select" onchange="updateDropdown()">
                                <option value="1">1 Room</option>
                                <option value="2">2 Rooms</option>
                                <option value="3">3 Rooms</option>
                                <option value="4">4 Rooms</option>
                                <option value="5">5 Rooms</option>
                            </select>
                        </li>
                        <li>
                            <button class="btn btn-primary w-100" onclick="updateDropdown()">Confirm</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-100 d-flex justify-content-end mt-3">
            <button class="btn " id="btn-find-accommodation">Find accommodation</button>
        </div>
    </div>
</div>
<div class="main_content  mt-5">
    <h3>Search by accommodation type</h3>
    <div id="accommodationTypeCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4 col-sm-5 mt-2 ">
                        <div class="card">
                            <img src="{{ asset('images/apartment.jpg') }}" class="card-img-top" alt="Apartment">
                            <div class="card-body">
                                <h5 class="card-title">Apartment</h5>
                                <p class="card-text">Comfortable apartments in the city center.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4  col-sm-5 mt-2">
                        <div class="card">
                            <img src="{{ asset('images/hostel.jpg') }}" class="card-img-top" alt="Hostel">
                            <div class="card-body">
                                <h5 class="card-title">Hostel</h5>
                                <p class="card-text">Affordable hostels for budget travelers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4  col-sm-5 mt-2">
                        <div class="card">
                            <img src="{{ asset('images/villa.webp') }}" class="card-img-top" alt="Villa">
                            <div class="card-body">
                                <h5 class="card-title">Villa</h5>
                                <p class="card-text">Luxurious villas for an exclusive stay.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#accommodationTypeCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        </div>
    </div>


    <h3 class="mt-3">Hotels in your country</h3>

    <ul class="nav nav-tabs" id="cityTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="kyiv-tab" data-bs-toggle="tab" href="#kyiv" role="tab" aria-controls="kyiv" aria-selected="true">Kyiv</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="lviv-tab" data-bs-toggle="tab" href="#lviv" role="tab" aria-controls="lviv" aria-selected="false">Lviv</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="odessa-tab" data-bs-toggle="tab" href="#odessa" role="tab" aria-controls="odessa" aria-selected="false">Odessa</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="kharkiv-tab" data-bs-toggle="tab" href="#kharkiv" role="tab" aria-controls="kharkiv" aria-selected="false">Kharkiv</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="dnipro-tab" data-bs-toggle="tab" href="#dnipro" role="tab" aria-controls="dnipro" aria-selected="false">Dnipro</a>
        </li>
    </ul>

    <div class="tab-content " id="cityTabsContent">

        <div class="tab-pane fade show active" id="kyiv" role="tabpanel" aria-labelledby="kyiv-tab">
            <div id="kyivCarousel" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-4  col-sm-5 mt-2">
                                <div class="card shadow">
                                    <img src="{{ asset('images/hotelKyiv1.jpg') }}" class="card-img-top" alt="Kyiv Hotel 1">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h5>Kyiv Hotel 2 </h5>
                                            <div class="rating">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                        <p class="card-text">Luxurious stay in the heart of Kyiv.</p>
                                        <hr>
                                        <div class="price">
                                            <h5>15500грн.</h5>
                                            <span>Days:1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-5 mt-2">
                                <div class="card shadow">
                                    <img src="{{ asset('images/hotelKyiv2.jfif') }}" class="card-img-top" alt="Kyiv Hotel 2">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h5>Kyiv Hotel 2 </h5>
                                            <div class="rating">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                        <p class="card-text">Luxurious stay in the heart of Kyiv.</p>
                                        <hr>
                                        <div class="price">
                                            <h5>12000грн.</h5>
                                            <span>Days:1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-5 mt-2">
                                <div class="card shadow">
                                    <img src="{{ asset('images/hotelKyiv3.jpeg') }}" class="card-img-top" alt="Kyiv Hotel 3">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h5>Kyiv Hotel 2 </h5>
                                            <div class="rating">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                        <p class="card-text">Luxurious stay in the heart of Kyiv.</p>
                                        <hr>
                                        <div class="price">
                                            <h5>15000грн.</h5>
                                            <span>Days:1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#kyivCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#kyivCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#kyivCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="lviv" role="tabpanel" aria-labelledby="lviv-tab">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('images/lviv.jpg') }}" class="card-img-top" alt="Lviv">
                        <div class="card-body">
                            <h5 class="card-title">Lviv</h5>
                            <p class="card-text">Explore charming hotels in Lviv.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="odessa" role="tabpanel" aria-labelledby="odessa-tab">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('images/odessa.jpg') }}" class="card-img-top" alt="Odessa">
                        <div class="card-body">
                            <h5 class="card-title">Odessa</h5>
                            <p class="card-text">Stay in beautiful hotels in Odessa.</p>
                            <a href="#" class="btn btn-primary">View Hotels</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="kharkiv" role="tabpanel" aria-labelledby="kharkiv-tab">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('images/kharkiv.jpg') }}" class="card-img-top" alt="Kharkiv">
                        <div class="card-body">
                            <h5 class="card-title">Kharkiv</h5>
                            <p class="card-text">Find great accommodations in Kharkiv.</p>
                            <a href="#" class="btn btn-primary">View Hotels</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="dnipro" role="tabpanel" aria-labelledby="dnipro-tab">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('images/dnipro.jpg') }}" class="card-img-top" alt="Dnipro">
                        <div class="card-body">
                            <h5 class="card-title">Dnipro</h5>
                            <p class="card-text">Choose from hotels in Dnipro.</p>
                            <a href="#" class="btn btn-primary">View Hotels</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <h3 class="mt-5">Guest Reviews</h3>
    <div id="accommodationTypeCarousel" class="carousel slide mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card ">

                            <div class="card-body review">
                                <div class="rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <img src="{{asset('images/default.jpg')}}" alt="">
                                <h5 class="mt-2">Fullname</h5>
                                <span class="date">3 months ago</span>
                                <p class="text-center">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Sed ligula augue, tristique eu volutpat vitae
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card ">

                            <div class="card-body review">
                                <div class="rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <img src="{{asset('images/default.jpg')}}" alt="">
                                <h5 class="mt-2">Fullname</h5>
                                <span class="date">3 months ago</span>
                                <p class="text-center">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Sed ligula augue, tristique eu volutpat vitae
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="card-body review">
                                <div class="rating">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <img src="{{asset('images/default.jpg')}}" alt="">
                                <h5 class="mt-2">Fullname</h5>
                                <span class="date">3 months ago</span>
                                <p class="text-center">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Sed ligula augue, tristique eu volutpat vitae
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main_facts">
        <div class="fact">

            <img src="{{asset('images/discount.png')}}">

            <h4>Great hotel deals </h4>
            <p>
                We search for deals from the best hotels around the world and share these finds with you.</p>
        </div>
        <div class="fact">
            <img src="{{asset('images/hotel_bell.png')}}">
            <h4>Up-to-date pricing
            </h4>
            <p>We always show you the most recent pricing overview we can find, so you know exactly what to expect.
            </p>
        </div>
        <div class="fact">
            <img src="{{asset('images/time.png')}}">
            <h4>Precise searching
            </h4>
            <p>Find hotels with swimming pools, free cancellation, and flexible booking.
                Or whatever matters most to you. </p>
        </div>
    </div>

    <script>
        function updateDropdown() {
            const adults = document.getElementById('adults').value;
            const children = document.getElementById('children').value;
            const rooms = document.getElementById('rooms').value;

            const dropdownInput = document.getElementById('dropdownMenuButton');
            dropdownInput.value = `${adults} Adult(s), ${children} Child(ren), ${rooms} Room(s)`;
        }
    </script>
    @endsection