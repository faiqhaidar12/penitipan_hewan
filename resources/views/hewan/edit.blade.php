@extends('layout.app')
@section('title', 'Tambah Data Hewan')
@section('content')
    @extends('layout.app')
@section('title', 'Tambah Data Hewan')
@section('content')
    @extends('layout.app')
@section('title', 'Tambah Data Hewan')
@section('content')
    <div class="col-md-6">
        <form method="POST" action="/hewan" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_hewan">Nama Hewan</label>
                    <input type="text" class="form-control" id="nama_hewan" name="nama_hewan"
                        placeholder="Masukan Nama Hewan">
                </div>
                <div class="form-group">
                    <label for="jenis_hewan">Jenis Hewan</label>
                    <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">--Pilih Jenis--</option>
                        <option>Kucing</option>
                        <option>Anjing</option>
                        <option>Burung</option>
                    </select>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="umur" class="mr-2">Umur /Tahun</label>
                    <input type="number" class="form-control" id="umur" placeholder="Umur">
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="berat">Berat /Kg</label>
                    <input type="number" class="form-control" id="berat" placeholder="Berat">
                </div>
                <div class="form-group">
                    <label for="pemilik">Pemilik</label>
                    <select class="form-control select2" style="width: 100%;">
                        <option selected="selected">--Pilih Pemilik--</option>
                        <option>Faiq</option>
                        <option>Haidar</option>
                        <option>Budi</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/hewan" class="btn btn-warning float-right">Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection

@endsection

@endsection
