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
        <div class="container row">
            @if(Auth::user()->role == 'admin')
            <div class="col-4">
                <p><a class="btn btn-primary" href="{{ route('buku.create') }}">Tambah Buku</a></p>
            </div>
            @endif
            <div class="col-8">
                <form action="{{route('buku.search')}}" method="get">
                    @csrf
                    <input type="text" name="kata" class="form-control" placeholder="Cari buku .." style="width: 30%; float: right">
                </form>
            </div>
        </div>
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
        <div class="container-fluid row">
            <div class="col-6"><strong>Jumlah buku : {{$jumlah_buku}}</strong></div>
            <div class="col-6">{{$data_buku->links()}}</div>
        </div>
        <div class="container row">
            <h3 class="col-6">Jumlah baris di tabel: {{$row_amount}}</h3>
            <h3 class="col-6" align="right">Jumlah semua harga buku: {{$price_amount}}</h3>
        </div>
        <script type="text/javascript">
                $('.date').datepicker({
                    format:'yyyy/mm/dd',
                    autoclose: 'true'
                });
        </script>
    </x-slot>
</x-app-layout>
