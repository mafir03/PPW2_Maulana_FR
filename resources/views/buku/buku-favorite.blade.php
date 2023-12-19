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
    <table class="table table-sm table-striped table-condensed">
            <thead>
                <th>Judul buku</th>
                <th>Penulis</th>
            </thead>
            <tbody>
                @foreach($favorites as $favorite)
                <tr>
                    <td>{{ $favorite->judul }}</td>
                    <td>{{ $favorite->penulis }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
