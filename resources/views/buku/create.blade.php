<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="content"> 
        @if (count($errors) > 0)
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error) 
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="container">
            <h4>Tambah buku</h4>
            <form method="post" action="{{ route('buku.store') }}">
                @csrf
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul buku">
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis buku">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga buku">
                </div>
                <div class="form-group">
                    <label for="tgl_terbit">Tgl. Terbit</label>
                    <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" placeholder="yyyy/mm/dd">
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    <a href="/buku">Batal</a>
                </div>
            </form>
        </div>
        <script type="text/javascript">
                    $('.date').datepicker({
                        format:'yyyy/mm/dd',
                        autoclose: 'true'
                    });
        </script>
    </x-slot>
</x-app-layout>