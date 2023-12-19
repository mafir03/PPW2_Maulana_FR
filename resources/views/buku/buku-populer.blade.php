<x-app-layout>
    <x-slot name="dashboard">
        @if(Auth::user()->role == 'admin')
            @include('layouts.navigation-admin')
        @elseif(Auth::user()->role == 'users')
            @include('layouts.navigation')
        @endif
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="content">
        <table class="table table-sm table-striped table-condensed">
            <thead>
                <th>Judul buku</th>
                <th>Penulis</th>
                <th>Rating</th>
            </thead>
            <tbody>
                @foreach($buku_rating as $rating)
                <tr>
                    <td>{{ $rating->buku->judul }}</td>
                    <td>{{ $rating->buku->penulis }}</td>
                    <!-- calculate the rating and put them here -->
                    @php
                        $book_rating = app('App\Http\Controllers\BukuController')->getRating($rating->buku->id);
                    @endphp
                    <td>{{ $book_rating }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
