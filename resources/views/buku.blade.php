@extends('layout')

@section('content')
    <div class="row">
        <table class="table table-sm table-striped table-condensed">
            <thead>
                <th>NO</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tgl. Terbit</th>
                <th>Aksi</th>  
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <!-- <td>{{ ++$no }}</td> -->
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('Y-m-d') }}</td>
                        <td>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                @csrf
                                <button class="btn btn-primary" 
                                onclick="return confirm('Yakin mau diapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="container row">
            <h3 class="col-6">Jumlah baris di tabel: {{$row_amount}}</h3>
            <h3 class="col-6">Jumlah semua harga buku: {{$price_amount}}</h3>
            <p><a href="{{ route('buku.create') }}">Tambah Buku</a></p>
        </div>
    </div>
@endsection