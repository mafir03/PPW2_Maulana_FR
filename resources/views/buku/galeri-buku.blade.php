<x-app-layout>

    <x-slot name="dashboard">

    </x-slot>
    <x-slot name="header">
        <div class="container-fluid row">
            <h2 class="col-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <a href="{{route('dashboard')}}">Dashboard</a>
            </h2>
            <h2 class="col-2 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Galeri Buku') }}
            </h2>
        </div>
        
    </x-slot>
    <x-slot name="content">
        <section id="album" class="py-1 text-center">
            <div class="container">
                @if(session('pesan'))
                <div class="alert alert-danger">
                    {{ session('pesan') }}
                </div>
                @endif
                <h1 id="text" style="font-size: 2em;">
                    Buku: {{$buku->judul}}
                    Rating: {{ app('App\Http\Controllers\BukuController')->getRating($buku->id) }}
                </h1>
                <div class="container mt-4 mb-4">
                    <form method="post" action="{{ route('setFavorite')}}">
                        @csrf
                        <input type="hidden" name="buku_id" value="{{$buku->id}}">
                        <button type="submit" class="btn btn-outline-primary">Add to Favorite</button>
                    </form>
                </div>
                <div class="container">
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
        <div class="container mt-4">
            <p>Choose a rating (1-5): </p>
            <form method="post" action="{{ route('setrating', $buku->id) }}">
                @csrf
                <div class="form-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating1" value="1">
                        <label class="form-check-label" for="rating1">1</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating2" value="2">
                        <label class="form-check-label" for="rating2">2</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating3" value="3">
                        <label class="form-check-label" for="rating3">3</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating4" value="4">
                        <label class="form-check-label" for="rating4">4</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rating" id="rating5" value="5">
                        <label class="form-check-label" for="rating5">5</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </form>
        </div>
    </x-slot>
</x-app-layout>