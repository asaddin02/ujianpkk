@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($data as $d)
            
        <div class="col-md-3">
            <div class="card">
                <h4 class="card-header">{{ $d->judul }}</h4>
                <div class="card-body">
                    <p><b>{{ $d->produk->penulis }}</b></p>
                    <p><b>{{ $d->tgl }}</b></p>
                    <p><b>{{ $d->isi }}</b></p>
                    
            </div>
        </div>
        @endforeach
        @foreach ($join as $j)
        <div class="col-md-3">
            <div class="card">
                <h4 class="card-header">{{ $d->namaproduk }}</h4>
                <div class="card-body">
                    <img src="{{ asset('Storage/'.$d->produk->foto) }}" alt="" width="100px">
            </div>
        </div>
        @endforeach
    </div>
    <a href="{{ url('home') }}" class="btn btn-danger text-white">Back</a>
</div>
@endsection
