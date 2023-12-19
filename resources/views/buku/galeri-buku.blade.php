<x-app-layout>
    <x-slot name="dashboard">
        @if(Auth::user()->role == 'admin')
            @include('layouts.navigation-admin')
        @else
            @include('layouts.navigation')
        @endif
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="content">
        <section id="album" class="py-1 text-center">
            <div class="container">
                @if(session('pesan'))
                <div class="alert alert-success">
                    {{ session('pesan') }}
                </div>
                @endif
                <h1 id="text" style="font-size: 3.5em;">
                   {{$buku->judul}}
                </h1>
                <div id="star" style="font-size: 1.5em;">
                    Rating:                    
                    @php
                        $rating = app('App\Http\Controllers\BukuController')->getRating($buku->id);
                        $rating = floatval($rating); // Convert $rating to float
                        $fullStars = floor($rating);
                        $halfStar = $rating - $fullStars >= 0.1;
                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                    @endphp

                    @if ($rating > 0)
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fa-solid fa-star" style="color: orange;"></i>
                        @endfor

                        @if ($halfStar)
                            <i class="fa-solid fa-star-half-stroke" style="color: orange;"></i>
                        @endif

                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="fa-regular fa-star" style="color: orange;"></i>
                        @endfor

                        @for ($i = 0; $i < (5 - $fullStars - ($halfStar ? 1 : 0) - $emptyStars); $i++)
                            <i class="fa-regular fa-star" style="color: orange"></i>
                        @endfor

                        <span>{{ number_format(round($rating, 2), 1) }}</span>
                    @else
                        <p>No rating available.</p>
                    @endif
                </div>
                <div class="container mt-4 mb-4">
                    <form method="post" action="{{ route('setFavorite')}}">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{$buku->id}}">
                        <button type="submit" class="btn btn-outline-primary">Add to Favorite</button>
                    </form>
                </div>
                <div class="container">
                    <div class="row">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach($buku->galleries()->get() as $key => $gallery)
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $key }}" @if($key === 0) class="active"
                                 aria-current="true" @endif aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach($buku->galleries()->get() as $key => $gallery)
                                <div class="carousel-item{{ $key === 0 ? ' active' : '' }} col-6" style="height: 50%;">
                                    <a href="{{ $gallery->path }}" data-lightbox="mygallery">
                                        <img class="d-block w-100" style="height: 100%; object-fit: cover;" src="{{ $gallery->path }}" alt="{{$buku->judul}}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-4">
                <p>Choose a rating (1-5): </p>
                <form method="post" action="{{ route('setrating', $buku->id) }}">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 mt-4 mb-4">
                                <select class="form-control" name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </form>
            </div>
            </div>
            
        </section>
    </x-slot>
</x-app-layout>