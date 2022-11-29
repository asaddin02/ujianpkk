@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- @if (Post()->tampilkan == "nonaktif")
            
        @else --}}
            
        @foreach ($data as $d)
            
        <div class="col-md-3">
            <div class="card">
                <h4 class="card-header">{{ $d->judul }}</h4>

                <div class="card-body">
                    <img src="{{ asset('Storage/'.$d->produk->foto) }}" alt="" width="100px">
                </div>
                <div class="card-footer text-center">
                    <p><b>{{ $d->tgl }}</b></p>
                    <p><b>{{ $d->isi }}</b></p>
                    <a href="{{ url('detail'.$d->produk->id) }}" class="btn btn-warning text-white">detail</a>
                </div>
            </div>
        </div>
        @endforeach
        {{-- @endif --}}
    </div>
</div>
@endsection
