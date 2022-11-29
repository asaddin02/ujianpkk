@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <form action="{{ route('dashboard.store') }}" method="post">
                    @csrf
                    <label class="col-form-label">Keluhan</label>
                    <input type="text" class="form-control" name="keluhan" required>
                    <label class="col-form-label">Tahun</label>
                    <input type="number" class="form-control" name="tahun" required>
                    <input type="submit" value="Check" class="btn btn-primary text-white">
                </form>
            </div>
            <div class="col-lg-6">
                @isset($data)
                    <table class="table table-bordered">
                        <tr class="bg-dark text-white">
                            <td><h4>Rekomendasi Jamu</h4></td>
                        </tr>
                        <tr>
                            <th>Nama Jamu</th>
                            <td>{{ $data['nama'] }}</td>
                        </tr>
                        <tr>
                            <th>Khasiat</th>
                            <td>{{ $data['khasiat'] }}</td>
                        </tr>
                        <tr>
                            <th>Keluhan</th>
                            <td>{{ $data['keluhan'] }}</td>
                        </tr>
                        <tr>
                            <th>Umur</th>
                            <td>{{ $data['umur'] }}</td>
                        </tr>
                        <tr>
                            <th>Saran Penggunaan</th>
                            <td>{{ $data['saran'] }}</td>
                        </tr>
                    </table>
                @endisset
            </div>
        </div>
    </div>
@endsection
