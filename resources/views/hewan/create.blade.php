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
                        value="{{ Session::get('nama_hewan') }}" placeholder="Masukan Nama Hewan">
                </div>
                <div class="form-group">
                    <label for="jenis_hewan">Jenis Hewan</label>
                    <select name="jenis_hewan" id="jenis_hewan" class="form-control select2" style="width: 100%;">
                        <option selected="selected">--Pilih Jenis--</option>
                        <option value="anjing" @if (Session::get('jenis_hewan') == 'anjing') selected @endif>Anjing</option>
                        <option value="kucing" @if (Session::get('jenis_hewan') == 'kucing') selected @endif>Kucing</option>
                        <option value="burung" @if (Session::get('jenis_hewan') == 'burung') selected @endif>Burung</option>
                    </select>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="umur" class="mr-2">Umur /Tahun</label>
                    <input name="umur" value="{{ Session::get('umur') }}" type="number" class="form-control"
                        id="umur" placeholder="Umur">
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="berat">Berat /Kg</label>
                    <input name="berat" value="{{ Session::get('berat') }}" type="number" class="form-control"
                        id="berat" placeholder="Berat">
                </div>
                <div class="form-group">
                    <label for="pelanggan_id">Pemilik</label>
                    <select name="pelanggan_id" class="form-control select2" style="width: 100%;">
                        <option selected="selected">--Pilih Pemilik--</option>
                        @foreach ($pelanggan as $item)
                            <option value="{{ $item->id }}" @if (Session::get('pelanggan_id') == $item->id) selected @endif>
                                {{ $item->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
