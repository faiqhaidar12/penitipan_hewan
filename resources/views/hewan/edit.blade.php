@extends('layout.app')
@section('title', 'Edit Data Hewan')
@section('content')
    <div class="col-md-6">
        <form method="POST" action="{{ '/hewan/' . $data->id }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_hewan">Nama Hewan</label>
                    <input type="text" class="form-control" id="nama_hewan" name="nama_hewan" value="{{ $data->nama_hewan }}"
                        placeholder="Masukan Nama Hewan">
                </div>
                <div class="form-group">
                    <label for="jenis_hewan">Jenis Hewan</label>
                    <select name="jenis_hewan" class="form-control select2" style="width: 100%;">
                        <option selected="selected">{{ $data->jenis_hewan }}
                        </option>
                        <option value="kucing">Kucing</option>
                        <option value="anjing">Anjing</option>
                        <option value="burung">Burung</option>
                    </select>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="umur" class="mr-2">Umur /Tahun</label>
                    <input name="umur" value="{{ $data->umur }}" type="number" class="form-control" id="umur"
                        placeholder="Umur">
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="berat">Berat /Kg</label>
                    <input name="berat" value="{{ $data->berat }}" type="number" class="form-control" id="berat"
                        placeholder="Berat">
                </div>
                <div class="form-group">
                    <label for="pemilik">Pemilik</label>
                    <select name="pelanggan_id" class="form-control select2" style="width: 100%;">
                        <option value="{{ $data->id }}" selected="selected">{{ $data->pelanggan->nama_pelanggan }}
                        </option>
                        @foreach ($pelanggan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_pelanggan }}
                            </option>
                        @endforeach
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
