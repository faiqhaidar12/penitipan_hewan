@extends('layout.app')
@section('title', 'Penitipan')
@section('content')
    <a href="/penitipan/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Penitipan</a>
    <div class="float-right">
        <div class="card-tools">
            <form action="{{ url('/penitipan') }}" method="GET">
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
        @if ($count > 0)
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Hewan</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Pemilik</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->hewan->nama_hewan }}</td>
                            <td>{{ $item->tgl_masuk }}</td>
                            <td>{{ $item->tgl_keluar }}</td>
                            <td>Rp. {{ number_format($item->biaya, 0, ',', '.') }},00-</td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'dititipkan' => 'bg-warning',
                                        'diambil' => 'bg-success',
                                        'dibatalkan' => 'bg-danger',
                                    ];
                                @endphp
                                <span
                                    class="badge @isset($statusClasses[$item->status]){{ $statusClasses[$item->status] }}@else{{ '' }}@endisset">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td>{{ $item->hewan->pelanggan->nama_pelanggan }}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ '/penitipan/' . $item->id . '/edit' }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <form onsubmit="return confirm('Apakah Anda Yakin Ingin Hapus Data?')" class="d-inline"
                                    action="{{ url('/penitipan/' . $item->id) }}" method="POST">
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
        @else
            @if ($keyword)
                <p>Data tidak ditemukan</p>
            @endif
        @endif
        {{ $data->links() }}
    </div>
@endsection
