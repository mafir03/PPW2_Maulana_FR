<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="content">
        <div class="container row">
            <div class="col-4">
                <p><a class="btn btn-primary" href="{{ route('buku.create') }}">Tambah Buku</a></p>
            </div>
            <div class="col-8">
                <form action="{{route('buku.search')}}" method="get">
                    @csrf
                    <input type="text" name="kata" class="form-control" placeholder="Cari buku .." style="width: 30%; float: right">
                </form>
            </div>
        </div>
        <table class="table table-sm table-striped table-condensed">
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
            <div class="col-6">{{$data_buku->links()}}</div>
            <div class="col-6"><strong>Jumlah buku : {{$jumlah_buku}}</strong></div>
        </div>
        <div class="container row">
            <h3 class="col-6">Jumlah baris di tabel: {{$row_amount}}</h3>
            <h3 class="col-6">Jumlah semua harga buku: {{$price_amount}}</h3>
        </div>
        <script type="text/javascript">
                $('.date').datepicker({
                    format:'yyyy/mm/dd',
                    autoclose: 'true'
                });
        </script>
    </x-slot>
</x-app-layout>
