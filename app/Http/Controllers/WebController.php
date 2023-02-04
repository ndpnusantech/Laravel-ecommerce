<?php

namespace App\Http\Controllers;

use App\Models\Web;
use App\Http\Requests\StoreWebRequest;
use App\Http\Requests\UpdateWebRequest;
use Illuminate\Http\Request;
class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // bagian session web start
        $webSession = Web::first();
        $nama_web = isset($webSession->nama_web)?$webSession->nama_web:'';
        $inis_web = isset($webSession->inis_web)?$webSession->inis_web:'';
        $desk_web = isset($webSession->desk_web)?$webSession->desk_web:'';
        $logo_web = isset($webSession->logo_web)?$webSession->logo_web:'';
        $copy_web = isset($webSession->copy_web)?$webSession->copy_web:'';
        $year_web = isset($webSession->year_web)?$webSession->year_web:'';
        $request->session()->put('namaWeb', $nama_web);
        $request->session()->put('inisWeb', $inis_web);
        $request->session()->put('deskWeb', $desk_web);
        $request->session()->put('logoWeb', $logo_web);
        $request->session()->put('copyWeb', $copy_web);
        $request->session()->put('yearWeb', $year_web);
        // bagian session web end
        $type_menu = '';
        $webs = Web::all();
        return view('ecommerce.web', compact('webs', 'type_menu'));
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
     * @param  \App\Http\Requests\StoreWebRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWebRequest $request)
    {
        $data = new Web;
        $logo = $request->logo;
        $logoname = time().'.'.$logo->getClientOriginalExtension();
        $logo->storeAs('public/img/logo', $logoname);

        $data->nama_web = $request->nama;
        $data->inis_web = $request->inisial;
        $data->desk_web = $request->deskripsi;
        $data->logo_web = $logoname;
        $data->copy_web = $request->copy;
        $data->year_web = $request->tahun;
        $data->save();

        return redirect()->back()->with('message', 'Berhasil Menambahkan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Web  $web
     * @return \Illuminate\Http\Response
     */
    public function show(Web $web)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Web  $web
     * @return \Illuminate\Http\Response
     */
    public function edit(Web $web)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWebRequest  $request
     * @param  \App\Models\Web  $web
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWebRequest $request, Web $web)
    {
        $logo = $request->logo;
        if (!empty($request->logo)) {
        $logoname = time().'.'.$logo->getClientOriginalExtension();
        $logo->storeAs('public/img/logo', $logoname);
        }

        $data =  Web::find($web->id);
        $data->nama_web = $request->nama;
        $data->inis_web = $request->inisial;
        $data->desk_web = $request->deskripsi;
        if (!empty($request->logo)) {
            $data->logo_web = $logoname;
        }
        $data->copy_web = $request->copy;
        $data->year_web = $request->tahun;
        $data->save();

        return redirect()->back()->with('message', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Web  $web
     * @return \Illuminate\Http\Response
     */
    public function destroy(Web $web)
    {
        $data = Web::find($web->id);
        $data->delete();
        return redirect()->back()->with('message', 'Berhasil menghapus data');
    }
}
