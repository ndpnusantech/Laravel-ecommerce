<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $type_menu = 'produk';
        $datas = DB::table('produks')
                ->join('kategoris', 'kategoris.id', '=', 'produks.id_kategori')
                ->select('produks.*', 'kategoris.nama_kategori')
                ->get();
        $kategoris = Kategori::all();
        return view('ecommerce.admin.produk', compact('datas', 'type_menu', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukRequest $request)
    {
        $data = new Produk;
        $gambar = $request->gambar;
        $gambarname = time().'.'.$gambar->getClientOriginalExtension();
        $gambar->storeAs('public/img/gambar', $gambarname);
        $data->id_kategori = $request->id_kategori;
        $data->nama_produk = $request->nama_produk;
        $data->desk_produk = $request->desk_produk;
        $data->jumlah = $request->jumlah;
        $data->diskon = $request->diskon;
        $data->harga = $request->harga;
        $data->gambar = $gambarname;
        $data->save();

        return redirect()->back()->with('message', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        $data =  Produk::find($produk->id);
        $gambar = $request->gambar;
        $data->id_kategori = $request->id_kategori;
        $data->nama_produk = $request->nama_produk;
        $data->desk_produk = $request->desk_produk;
        $data->jumlah = $request->jumlah;
        $data->diskon = $request->diskon;
        $data->harga = $request->harga;
        if(!empty($gambar)){
            $gambarname = time().'.'.$gambar->getClientOriginalExtension();
            $gambar->storeAs('public/img/gambar', $gambarname);
            $data->gambar = $gambarname;
        }
        $data->save();

        return redirect()->back()->with('message', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
