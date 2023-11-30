<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\BukuRating;
use App\Models\Gallery;
use App\Models\UserFavorite;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;


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

    public function galeriBuku($id) {
        $buku = Buku::where('id', $id)->first();
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

    public function publicGaleriBuku($id) {
        $buku = Buku::where('id', $id)->first();
        $galleries = $buku->photos()->orderBy('id', 'desc')->paginate(6);
        return view('public.galeri-buku', compact('buku', 'galleries'));
    }

    public function favorite() {
        $user = auth()->user()->id;
        $favorite = UserFavorite::where('user_id', $user)->get();
        $favorites = Buku::whereIn('id', $favorite->pluck('buku_id'))->get();
        return view('buku.buku-favorite', compact('favorites'));
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
    
    public function setRating(Request $request, String $bukuId) {
        $rating = $request->input("rating");
        $rating_table = BukuRating::where('buku_id', $bukuId)->first();
        dump($rating);
        if($rating_table){
            switch($rating){
                case "1":
                    $rating_table->update([
                        'rating_1_count' => $rating_table->rating_1_count + 1,
                    ]);
                    break;
                case "2":
                    $rating_table->update([
                        'rating_2_count' => $rating_table->rating_2_count + 1,
                    ]);
                    break;
                case "3":
                    $rating_table->update([
                        'rating_3_count' => $rating_table->rating_3_count + 1,
                    ]);
                    break;
                case "4":
                    $rating_table->update([
                        'rating_4_count' => $rating_table->rating_4_count + 1,
                    ]);
                    break;
                case "5":
                    $rating_table->update([
                        'rating_5_count' => $rating_table->rating_5_count + 1,
                    ]);
                    break;
            }
        } else {
            switch($rating){
                case "1":
                    BukuRating::create([
                        'buku_id' => $bukuId,
                        'rating_1_count' => 1,
                    ]);
                    break;
                case "2":
                    BukuRating::create([
                        'buku_id' => $bukuId,
                        'rating_2_count' => 1,
                    ]);
                    break;
                case "3":
                    BukuRating::create([
                        'buku_id' => $bukuId,
                        'rating_3_count' => 1,
                    ]);
                    break;
                case "4":
                    BukuRating::create([
                        'buku_id' => $bukuId,
                        'rating_4_count' => 1,
                    ]);
                    break;
                case "5":
                    BukuRating::create([
                        'buku_id' => $bukuId,
                        'rating_5_count' => 1,
                    ]);
                    break;
            }
        }
        return redirect()->back();
    }

    public function getRating($bukuId) {
        $rating_table = BukuRating::where('buku_id', $bukuId)->first();
        if($rating_table){
            $rating_1_count = $rating_table->rating_1_count;
            $rating_2_count = $rating_table->rating_2_count;
            $rating_3_count = $rating_table->rating_3_count;
            $rating_4_count = $rating_table->rating_4_count;
            $rating_5_count = $rating_table->rating_5_count;
            $total_rating = $rating_1_count + $rating_2_count + $rating_3_count + $rating_4_count + $rating_5_count;
            $rating = (($rating_1_count * 1) + ($rating_2_count * 2) + ($rating_3_count * 3) + ($rating_4_count * 4) + ($rating_5_count * 5)) / $total_rating;
            return $rating;
        } else {
            return "Rating not available";
        }
    }

    public function setFavorite(Request $request) {
        $bukuId = $request->input('buku_id');
        $user = auth()->user();
        $favorite_table = UserFavorite::where('buku_id', $bukuId)->first();
        if(!$favorite_table){
            UserFavorite::create([
                'user_id' => $user->id,
                'buku_id' => $bukuId,
            ]);
            return redirect()->back()->with('pesan', 'Buku berhasil ditambahkan ke favorite');
        }  else {
            return redirect()->back()->with('pesan', 'Buku sudah ada di favorite');
        }
    }
}
