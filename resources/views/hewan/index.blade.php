@extends('layout.app')
@section('title', 'Hewan')
@section('content')
    <a href="/hewan/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Hewan</a>
    <div class="float-right">
        <div class="card-tools">
            <form action="{{ url('/hewan') }}" method="GET">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="keyword" class="form-control float-right" placeholder="Search"
                        value="{{ request('keyword') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive text-center p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Hewan</th>
                    <th>Jenis Hewan</th>
                    <th>Umur /Tahun</th>
                    <th>Berat</th>
                    <th>Pemilik</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama_hewan }}</td>
                        <td>{{ $item->jenis_hewan }}</td>
                        <td>{{ $item->umur }} <span class="text-bold">Tahun</span></td>
                        <td>{{ $item->berat }} <span class="text-bold">Kg</span></td>
                        <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ url('/hewan/' . $item->id . '/edit') }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <form onsubmit="return confirm('Apakah Anda Yakin Ingin Hapus Data?')" class="d-inline"
                                action="{{ url('/hewan/' . $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">
                                    <i class="fas fa-trash">
                                    </i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data->links() }}
    </div>
@endsection
