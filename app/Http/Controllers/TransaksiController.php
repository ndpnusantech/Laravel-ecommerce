<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type_menu = 'Invoices';
        $datas = DB::table('transaksis')
                ->join('produks', 'produks.id', '=', 'transaksis.id_produk')
                ->join('users', 'users.id', '=', 'transaksis.id_user')
                ->select('transaksis.*', 'produks.nama_produk', 'users.name')
                ->where('transaksis.id_user', '=', Auth::user()->id)
                ->where('transaksis.status', '!=', 'keranjang')
                ->get();
        if(Auth::user()->status == 'admin'){
            return view('ecommerce.admin.invoice', compact('datas', 'type_menu'));
        }else{
            return view('ecommerce.transaksi.invoice', compact('datas', 'type_menu'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiRequest $request)
    {
        if ($request->button == "keranjang") {
            $status = 'keranjang';
        } else {
            $status = 'pembelian';
        }

        $data = new Transaksi;
        $data->id_produk = $request->idproduk;
        $data->id_user = Auth::user()->id;
        $data->jumlah = $request->jumlah;
        $data->kode_transaksi = '';
        $data->harga = $request->harga;
        $data->status = $status;
        $data->save();
        if($request->button == "keranjang"){
            return redirect()->back()->with('message', 'Berhasil Menambahkan ke Keranjang!');
        }else{
            return redirect('transaksi/create')->with('message', 'Silahkan Lanjutkan Pembayaran!');
        }
    }
    // keranjang
    // pembelian
    // diproses
    // selesai

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $type_menu = 'Invoices';
        if(Auth::user()->level == 'admin'){
            $datas = DB::table('transaksis')
            ->join('produks', 'produks.id', '=', 'transaksis.id_produk')
            ->join('users', 'users.id', '=', 'transaksis.id_user')
            ->select('produks.*', 'users.*','transaksis.*')
            ->where('transaksis.status', '!=', 'keranjang')
            ->get();
        }else{
            $datas = DB::table('transaksis')
            ->join('produks', 'produks.id', '=', 'transaksis.id_produk')
            ->join('users', 'users.id', '=', 'transaksis.id_user')
            ->select('produks.*', 'users.*','transaksis.*')
            ->where('transaksis.id', '=', $transaksi->id)
            ->where('transaksis.status', '!=', 'keranjang')
            ->get();
        }
        if(Auth::user()->status == 'admin'){
            return view('ecommerce.admin.invoice_detail', compact('datas', 'type_menu'));            
        }else{
            return view('ecommerce.transaksi.invoice_detail', compact('datas', 'type_menu'));            
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiRequest  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        $data =  Transaksi::find($transaksi->id);
        if (isset($request->jumlah)) {
            $data->jumlah = $request->jumlah;
        }
        if (isset($request->bukti)) {
            // store to local folder
            $bukti = $request->bukti;
            $buktiname = time().'.'.$bukti->getClientOriginalExtension();
            $bukti->storeAs('public/img/bukti', $buktiname);
            // store to table
            $data->bukti = $buktiname;
        }
        if($request->jenis == 'terima'){
            $data->status = 'diterima';
        }
        if($request->jenis == 'gagal'){
            $data->status = 'digagalkan';
        }
        $data->save();
        return redirect()->back()->with('message', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $data = Transaksi::find($transaksi->id);
        $data->delete();
        return redirect()->back()->with('message', 'Berhasil menghapus data');
    }
}
