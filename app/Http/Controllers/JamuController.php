<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // menampilkan dashboard jamu
        return view('dashboard');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // fungsi rekomendasi jamu
        $d = new Coba($request->tahun, $request->keluhan);
        $keluhan = $request->keluhan;
        $data = [
            'nama' => $d->namaJamu(),
            'khasiat' => $d->khasiat(),
            'keluhan' => $keluhan,
            'umur' => $d->hitungUmur(),
            'saran' => $d->Saran(),
        ];
        return view('dashboard',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

class Jamu{
    public function __construct($tahun,$keluhan)
    {
        $this->keluhan = $keluhan;
        $this->tgl = $tahun;
    }

    public function namaJamu()
    {
        if($this->keluhan == 'keseleo dan kurang nafsu makan'){
            return 'Beras Kencur';
        } else if($this->keluhan == 'pegal-pegal'){
            return 'Kunyit Asam';
        } else if($this->keluhan == 'darah tinggi dan gula darah'){
            return 'Brotowali';
        } else if($this->keluhan == 'kram perut dan masuk angin'){
            return 'Temulawak';
        } else {
            return 'Gaono Jamu liyane aku mek dodol iku tok';
        }
    }

    public function khasiat()
    {
        if($this->namaJamu() == 'Beras Kencur'){
            return 'mengurangi sakit karena keseleo dan mengatasi kurang nafsu makan';
        } else if($this->namaJamu() == 'Kunyit Asam'){
            return 'mengurangi pegal-pegal';
        } else if($this->namaJamu() == 'Brotowali'){
            return 'mengurangi darah tinggi dan gula darah';
        }else if($this->namaJamu() == 'Temulawak'){
            return 'mengobati keram perut dan masuk angin';
        } else {
            return 'gak berkhasiat';
        }
    }

    public function hitungUmur()
    {
        $umur = $this->tgl;
        return 2022 - $umur;
    }
}

class Coba extends Jamu{
    public function Saran()
    {
        if($this->hitungUmur() >= 10){
            if($this->namaJamu() == 'Beras Kencur'){
                $saran = 'Dioleskan';
            } else {
                $saran = 'Dikonsumsi';
            }
            return 'Dikonsumsi 1x' . $saran;
        } else {
            if($this->namaJamu() == 'Beras Kencur'){
                $saran = 'Dioleskan';
            } else {
                $saran = 'Dikonsumsi';
            }
            return 'Dikonsumsi 2x' . $saran;
        }
    }
}
