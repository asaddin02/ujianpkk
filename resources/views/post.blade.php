{{-- view post --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                {{-- tombol modal tambah post --}}
                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</a>
                <table class="table">
                    <tr class="bg-info text-white text-center">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Tanggal</th>
                        <th>Produk</th>
                        <th>Action</th>
                    </tr>
                    {{-- menampilkan data post --}}
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->judul }}</td>
                            <td>{{ $d->isi }}</td>
                            <td>{{ $d->tgl }}</td>
                            <td>{{ $d->produk->namaproduk}}</td>
                            <td>
                                {{-- tombol modal ubah post --}}
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Ubah</a>
                                {{-- tombol modal hapus post --}}
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Hapus</a>
                            </td>
                        </tr>

                        {{-- modal hapus post --}}
                        <div class="modal fade" id="hapus{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Yakin ingin menghapus?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <b>{{ $d->judul }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('post.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal ubah post --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Post</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('post.update', $d->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Judul</label>
                                                <input type="text" class="form-control" name="judul"
                                                    value="{{ $d->judul }}">
                                                <label class="col-form-label">Isi</label>
                                                <input type="text" class="form-control" name="isi"
                                                    value="{{ $d->isi }}">
                                                <label class="col-form-label">Tanggal</label>
                                                <input type="date" class="form-control" name="tgl"
                                                    value="{{ $d->tgl }}">
                                                <label class="col-form-label">Tampilkan</label>
                                                @if (Auth::user()->role == "admin")
                                                <select name="tampilkan" id="" class="form-control" required>
                                                    <option value="aktif">Tampil</option>
                                                    <option value="nonaktif">Tidak Tampil</option>
                                                </select>
                                                @else
                                                    <input type="hidden" name="tampilkan" value="aktif">
                                                @endif
                                                <label class="col-form-label">Produk</label>
                                                <select name="produk_id" id="" class="form-control">
                                                    <option value="{{ $d->produk_id }}">Pilih Produk</option>
                                                    @foreach ($join as $j)
                                                        <option value="{{ $j->id }}">{{ $j->namaproduk }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" value="Edit" class="btn btn-sm btn-primary">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>

                {{-- modal tambah post --}}
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('post.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Judul</label>
                                        <input type="text" class="form-control" name="judul" required>
                                        <label class="col-form-label">Isi</label>
                                        <input type="text" class="form-control" name="isi" required>
                                        <label class="col-form-label">Tanggal</label>
                                        <input type="date" class="form-control" name="tgl" required>
                                        @if (Auth::user()->role == "admin")
                                        <select name="tampilkan" id="" class="form-control" required>
                                            <option value="aktif">Tampil</option>
                                            <option value="nonaktif">Tidak Tampil</option>
                                        </select>
                                        @else
                                            <input type="hidden" name="tampilkan" value="aktif">
                                        @endif
                                        <label class="col-form-label">Produk</label>
                                        <select name="produk_id" id="" class="form-control" required>
                                            @foreach ($join as $j)
                                                <option value="{{ $j->id }}">{{ $j->namaproduk }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" value="Tambah" class="btn btn-sm btn-success">
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
