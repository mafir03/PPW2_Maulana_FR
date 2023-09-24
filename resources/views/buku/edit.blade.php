@extends('layout')

@section('content')

    <div class="container">
        <h4>Edit buku</h4>
        <form method="post" action="{{ route('buku.update', $buku->id)}}">
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
                <input type="text" class="form-control" id="tgl_terbit" name="tgl_terbit" placeholder="Tgl. Terbit buku">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="/buku">Batal</a>
            </div>
        </form>
    </div>

@endsection