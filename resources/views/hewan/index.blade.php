@extends('layout.app')
@section('title', 'Hewan')
@section('content')
    <a href="/hewan/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Hewan</a>
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
                            <a class="btn btn-primary btn-sm" href="#">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm" href="#">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
