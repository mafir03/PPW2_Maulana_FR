<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Gallery;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $batas = 7;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $row_amount = Buku::count();
        $price_amount = Buku::sum('harga');
        $no = $batas * ($data_buku->currentPage() - 1);
        return view('dashboard', compact('data_buku', 'no', 'row_amount', 'price_amount', 'jumlah_buku'));
    }

    public function galeriBuku($title) {
        $buku = Buku::where('judul', $title)->first();
        $galleries = $buku->photos()->orderBy('id', 'desc')->paginate(6);
        return view('buku.galeri-buku', compact('buku', 'galleries'));
    }

    public function publicIndex()
    {
        $batas = 7;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $row_amount = Buku::count();
        $price_amount = Buku::sum('harga');
        $no = $batas * ($data_buku->currentPage() - 1);
        return view('public.dashboard', compact('data_buku', 'no', 'row_amount', 'price_amount', 'jumlah_buku'));
    }

    public function publicGaleriBuku($title) {
        $buku = Buku::where('judul', $title)->first();
        $galleries = $buku->photos()->orderBy('id', 'desc')->paginate(6);
        return view('public.galeri-buku', compact('buku', 'galleries'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * 
     */
    public function store(Request $request)
    {   
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => "image|mimes:jpeg,png,jpg|max:4192"
        ]);

        try{$file = $request->file('thumbnail');
            if($file) {$filename = time().'_'.$file->getClientOriginalName();
            } else {throw new Exception('File not found');}
        } catch(Exception $e) {return redirect()->back()->with('pesan', $e->getMessage());}

        $filepath = $request->file('thumbnail')->storeAs('uploads', $filename, 'public');
        Image::make(storage_path().'/app/public/uploads/'.$filename)
            ->fit(240, 320)
            ->save();

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga'=>$request->harga,
            'tgl_terbit'=>$request->tgl_terbit,
            'filename'=>$filename,
            'filepath'=>'/storage/' . $filepath,
        ]);
        
        $buku = Buku::where('judul', $request->judul)->first();
        $id = $buku->id;
        if($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/'. $filePath,
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
            }
        } return redirect('/dashboard')->with('pesan', 'Data buku berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);
        $request->validate([
            'thumbnail' => "image|mimes:jpeg,png,jpg|max:4192"
        ]);

        try{$file = $request->file('thumbnail');

            if($file) {$filename = time().'_'.$file->getClientOriginalName();
            } else {throw new Exception('File not found');}

        } catch(Exception $e) {return redirect()->back()->with('pesan', 'File thumbnail tidak ditemukan');}

        $filepath = $request->file('thumbnail')->storeAs('uploads', $filename, 'public');
        Image::make(storage_path().'/app/public/uploads/'.$filename)
            ->fit(240, 320)
            ->save();

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga'=>$request->harga,
            'tgl_terbit'=>$request->tgl_terbit,
            'filename'=>$filename,
            'filepath'=>'/storage/' . $filepath
        ]);

        if($request->file('gallery')) {
            foreach($request->file('gallery') as $key => $file) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/'. $filePath,
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
            }
        }
        return redirect('/dashboard')->with('pesan', 'Data buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/dashboard');
    }

    public function search(Request $request) {
        $batas = 7;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%".$cari."%")->orwhere('penulis', 'like', "%".$cari."%")
        ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        $row_amount = Buku::count();
        $price_amount = Buku::sum('harga');
        return view('buku.search', compact('data_buku', 'no', 'jumlah_buku', 'cari', 'row_amount', 'price_amount'));
    }
    


}
