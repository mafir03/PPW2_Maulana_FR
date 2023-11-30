<x-app-layout>
    <x-slot name="dashboard">
    </x-slot>
    <x-slot name="header">
          <div class="container row">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight col-2">
                <a class="nav-link" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight col-2">
                {{ __('Favorite') }}
            </h2>
            </div>
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
