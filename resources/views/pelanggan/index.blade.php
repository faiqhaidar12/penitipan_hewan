@extends('layout.app')
@section('title', 'Pelanggan')
@section('content')

    <a href="/pelanggan/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah Data</a>
    <div class="">
        <div class="pb-0">
            <div class="row">
                @foreach ($data as $item)
                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                        <div class="card bg-light d-flex flex-fill">
                            <div class="card-header text-muted border-bottom-0">
                                Digital Strategist
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>Nama Pemilik : {{ $item->nama_pelanggan }}</b></h2>
                                        <p class="text-muted text-sm"><i class="fas fa-lg fa-mail-bulk"></i> <b>E-mail: </b>
                                            {{ $item->email }} </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span>
                                                <b>Alamat:</b> {{ $item->alamat }}
                                            </li>
                                            <li class="small mt-1"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span>
                                                <b>Telepon:</b> {{ $item->telepon }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-5 text-center">
                                        <img style="max-height: 128px; max-width: 128px;"
                                            src="{{ $item->foto ? url('foto') . '/' . $item->foto : asset('AdminLTE') . '/dist/img/user1-128x128.jpg' }}"
                                            alt="user-avatar" class="img-circle img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <form onsubmit="return confirm('Apakah Anda Yakin Ingin Hapus Data?')" class="d-inline"
                                        action="{{ '/pelanggan/' . $item->id }}" method="POST">@csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm bg-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                    <a href="{{ url('/pelanggan/' . $item->id . '/edit') }}" class="btn btn-sm bg-orange">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ url('/pelanggan/' . $item->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{ $data->links() }}
@endsection
