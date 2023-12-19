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
        <form action="{{route('buku.kategoriSearch')}}" method="get">
            @csrf
            <div class=form-group">
                <label for="kategori">Kategori</label>
                <select class="form-select" name = "kategori" multiple>
                    <option selected>Pilih Kategori</option>
                    <option value="1">Sci-fi</option>
                    <option value="2">Horror</option>
                    <option value="3">Romance</option>
                    <option value="4">Comedy</option>
                    <option value="5">Action</option>
                    <option value="6">Drama</option>
                    <option value="7">Fantasy</option>
                    <option value="8">Mystery</option>
                </select>
                <div class="mt-2 mb-2">
                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                </div>
            </div>
        </form>


        @if(isset($kategori))
            <table class="table table-sm table-striped table-condensed">
                <thead>
                    <th>Judul buku</th>
                    <th>Penulis</th>
                </thead>
                <tbody>
                    @foreach($kategori as $buku)
                    <tr>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </x-slot>
</x-app-layout>
