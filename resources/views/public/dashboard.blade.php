<x-app-layout>
    <x-slot name="dashboard">
        @include('layouts.navigation-public')
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <x-slot name="content">
        <table class="table table-striped table-hover table-bordered table-responsive">
            <thead>
                <th>NO</th>
                <th>Gambar</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tgl. Terbit</th>
                <th>Galeri</th>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <td>{{ ++$no }}</td>
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
                        <td>
                            <a class="btn btn-primary btn-sm"" href="{{ route('public.galeri-buku', $buku->id) }}">Galeri</a>
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
