@extends('layout.app')
@section('title', 'Tambah Data Pelanggan')
@section('content')

    <div class="col-md-6">
        <form method="POST" action="{{ '/pelanggan/' . $data->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_pelanggan">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                        value="{{ $data->nama_pelanggan }}" placeholder="Masukan Nama Pelanggan">
                </div>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="email" class="form-control" id="email" name="email"value="{{ $data->email }}"
                        placeholder="Masukan E-Mail Pelanggan">
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" value="{{ $data->telepon }}"
                        placeholder="Masukan Telepon Pelanggan">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="3" name="alamat" placeholder="Masukan Alamat..">{{ $data->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label for="foto">Preview Foto</label>
                    @if ($data->foto)
                        <img style="max-height: 128px; max-width: 128px;" src="{{ url('foto') . '/' . $data->foto }}"
                            alt="user-avatar" class="img-circle img-fluid">
                    @endif
                </div>
                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/pelanggan" class="btn btn-warning float-right">Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection
