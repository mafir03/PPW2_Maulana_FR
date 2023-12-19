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
                    <option value="Sci-fi">Sci-fi</option>
                    <option value="Horror">Horror</option>
                    <option value="Romance">Romance</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Action">Action</option>
                    <option value="Drama">Drama</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Mystery">Mystery</option>
                </select>
                <div class="mt-2 mb-2">
                    <button type="submit" class="btn btn-outline-primary">Cari</button>
                </div>
            </div>
        </form>
        <table class="table table-striped table-hover table-bordered table-responsive mt-3">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Tgl. Terbit</th>
                    @if(Auth::user()->role == 'admin')
                        <th scope="col">Hapus</th>
                        <th scope="col">Update</th>
                    @endif
                    <th scope="col">Galeri</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <th scope="row">{{ ++$no }}</th>
                        <td>
                            @if($buku->filepath)
                                <div class="relative h-10 w-full">
                                    <img class="absolute h-full w-full rounded-full object-cover"
                                        src="{{ $buku->filepath }}" alt="">
                                </div>
                            @endif
                        </td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp ".number_format($buku->harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                        @if(Auth::user()->role == 'admin')
                            <td>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('buku.edit', $buku->id) }}">Update</a>
                            </td>
                        @endif
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('galeri-buku', $buku->id) }}">Galeri</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-slot>
</x-app-layout>
