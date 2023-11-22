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
                <h1 id="text" style="font-size: 2em;">
                    Buku: {{$buku->judul}}
                </h1>
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
    </x-slot>

</x-app-layout>