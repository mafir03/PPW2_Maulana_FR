<x-app-layout>

    <x-slot name="dashboard">

    </x-slot>
    <x-slot name="header">
        <div class="container-fluid row">
            <h2 class="col-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <a href="{{route('public.dashboard')}}">Dashboard</a>
            </h2>
            <h2 class="col-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Galeri Buku') }}
            </h2>
        </div>
        
    </x-slot>
    <x-slot name="content">
        <section id="album" class="py-1 text-center">
            <div class="container">
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
                <div class="container mt-5">
                    <div class="row">
                        @foreach($buku->galleries()->get() as $gallery)
                            <div class="col-6">
                                <a href="{{ $gallery->path }}" data-lightbox="mygallery">
                                    <img class="object-cover" src="{{ $gallery->path }}" alt="{{$buku->judul}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </section>
    </x-slot>

</x-app-layout>