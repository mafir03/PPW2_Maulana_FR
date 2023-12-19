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
        @if(count($data_buku))
            <div class="alert alert-success">
            Ditemukan <strong>{{count($data_buku)}}</strong> data dengan kata : <strong> {{$cari}}</strong>
            </div>
        <div class="row">
            <div class="container row">
                <form action="{{route('buku.search')}}" method="get">
                    @csrf
                    <input type="text" name="kata" class="form-control" placeholder="Cari buku .." style="width: 30%; float: right">
                </form>
            </div>
            <table class="table table-striped table-hover table-bordered table-responsive mt-3">
                <thead>
                    <th>NO</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tgl. Terbit</th>
                    <th>Hapus</th>
                    <th>Update</th>  
                </thead>
                <tbody>
                    @foreach($data_buku as $buku)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ "Rp ".number_format($buku->harga, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                            <td>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-primary" 
                                    onclick="return confirm('Yakin mau diapus?')">Hapus</button>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('buku.edit', $buku->id) }}">Update</a>
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
            @else
                <div class="alert alert-warning"><h4>Data {{ $cari } tidak ditemukan}</h4>
                <a href="/buku" class="btn btn-warning">Kembali</a>
                </div>
            @endif
            <script type="text/javascript">
                    $('.date').datepicker({
                        format:'yyyy/mm/dd',
                        autoclose: 'true'
                    });
            </script>
        </div>
    </x-slot>
</x-app-layout>
