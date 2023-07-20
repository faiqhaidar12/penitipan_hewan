@extends('layout.app')
@section('title', 'Tambah Data Pelanggan')
@section('content')
    <div class="col-md-6">
        <form method="POST" action="/pelanggan">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                        value="{{ Session::get('nama_pelanggan') }}" placeholder="Masukan Nama Pelanggan">
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" id="email"
                        name="email"value="{{ Session::get('email') }}" placeholder="Masukan E-Mail Pelanggan">
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon"
                        value="{{ Session::get('telepon') }}" placeholder="Masukan Telepon Pelanggan">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="3" name="alamat" placeholder="Masukan Alamat..">{{ Session::get('alamat') }}</textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
