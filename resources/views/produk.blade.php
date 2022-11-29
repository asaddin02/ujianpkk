{{-- view produk --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                {{-- tombol modal tambah produk --}}
                <a href="#" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</a>
                <table class="table">
                    <tr class="bg-info text-white text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                    {{-- menampilkan data produk --}}
                    @foreach ($data as $d)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->namaproduk }}</td>
                            <td><img src="{{ asset('Storage/' . $d->foto) }}" alt="" width="50px"></td>
                            <td>{{ $d->harga }}</td>
                            <td>{{ $d->descproduk }}</td>
                            <td>{{ $d->category->namakategori }}</td>
                            <td>
                                {{-- tombol modal ubah produk --}}
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $d->id }}">Ubah</a>
                                {{-- tombol modal hapus produk --}}
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapus{{ $d->id }}">Hapus</a>
                            </td>
                        </tr>

                        {{-- modal hapus produk --}}
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
                                        <b>{{ $d->namaproduk }}</b>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('produk.destroy', $d->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- modal ubah produk --}}
                        <div class="modal fade" id="edit{{ $d->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ubah Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('produk.update', $d->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="mb-3">
                                                <label class="col-form-label">Nama Produk</label>
                                                <input type="text" class="form-control" name="namaproduk"
                                                    value="{{ $d->namaproduk }}">
                                                <label class="col-form-label">Harga</label>
                                                <input type="number" class="form-control" name="harga"
                                                    value="{{ $d->harga }}">
                                                <label class="col-form-label">Deskripsi</label>
                                                <input type="text" class="form-control" name="descproduk"
                                                    value="{{ $d->descproduk }}">
                                                <img src="{{ asset('Storage/' . $d->foto) }}" alt=""
                                                    width="100px">
                                                <label class="col-form-label">Foto</label>
                                                <input type="file" class="form-control" name="foto"
                                                    value="{{ $d->foto }}">
                                                @if (Auth::user()->role == 'admin')
                                                    <select name="tampilkan" id="" class="form-control" required>
                                                        <option value="aktif">Tampil</option>
                                                        <option value="nonaktif">Tidak Tampil</option>
                                                    </select>
                                                @else
                                                    <input type="hidden" name="tampilkan" value="aktif">
                                                @endif
                                                <label class="col-form-label">Category</label>
                                                <select name="category_id" id="" class="form-control">
                                                    <option value="{{ $d->category_id }}">Pilih Category</option>
                                                    @foreach ($join as $j)
                                                        <option value="{{ $j->id }}">{{ $j->namakategori }}
                                                        </option>
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

                {{-- modal tambah produk --}}
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="col-form-label">Nama Produk</label>
                                        <input type="text" class="form-control" name="namaproduk" required>
                                        <label class="col-form-label">Harga</label>
                                        <input type="number" class="form-control" name="harga" required>
                                        <label class="col-form-label">Deskripsi</label>
                                        <input type="text" class="form-control" name="descproduk" required>
                                        <label class="col-form-label">Penulis</label>
                                        <input type="text" class="form-control" name="penulis"
                                            value="{{ $user->name }}" readonly>
                                        <label class="col-form-label">Foto</label>
                                        <input type="file" class="form-control" name="foto" required>
                                        @if (Auth::user()->role == 'admin')
                                            <select name="tampilkan" id="" class="form-control" required>
                                                <option value="aktif">Tampil</option>
                                                <option value="nonaktif">Tidak Tampil</option>
                                            </select>
                                        @else
                                            <input type="hidden" name="tampilkan" value="aktif">
                                        @endif
                                        <label class="col-form-label">Category</label>
                                        <select name="category_id" id="" class="form-control" required>
                                            @foreach ($join as $j)
                                                <option value="{{ $j->id }}">{{ $j->namakategori }}
                                                </option>
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
