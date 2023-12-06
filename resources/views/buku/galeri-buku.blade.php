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