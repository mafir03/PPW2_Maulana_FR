<x-app-layout>
    <x-slot name="dashboard"></x-slot>
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
            <form method="post" action="{{ route('buku.store') }}" enctype="multipart/form-data">
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
                <div class="mt-2">
                    <div>File Name</div>
                    <input type="file" class="btn btn-outline-primary" id="thumbnail" name="thumbnail" placeholder="Thumbnail">
                </div>
                <div class="mt-2 mb-2">
                    <button type="submit" class="btn btn-outline-primary">Simpan</button>
                    <a class="btn btn-outline-primary"href="/dashboard">Batal</a>
                </div>
                <div class="form-group">
                    <label for="filepath">Gallery</label>
                    <div id="fileinput_wrapper" class="mt-2 mb-2">

                    </div>
                    <a href="javascript:void(0)" onclick="addFileInput()" class="btn btn-outline-primary">Tambah</a>
                    <script type="text/javascript">
                        function addFileInput() {
                            var div = document.getElementById('fileinput_wrapper');
                            div.innerHTML += '<input type="file" class="btn btn-outline-primary mb-2" id="gallery" name="gallery[]" placeholder="Gallery">';
                        }
                    </script>
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