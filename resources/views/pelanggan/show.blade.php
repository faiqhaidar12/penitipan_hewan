@extends('layout.app')
@section('title', 'Profile Pelanggan')
@section('content')
    <div class=" card-solid">
        <div class="card-body pb-0">
            <div class="row flex justify-content-center">
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            Data Pelanggan
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    @foreach ($data as $item)
                                        <h2 class="lead"><b>Nama Pemilik : {{ $item->nama_pelanggan }}</b></h2>
                                        <p class="text-muted text-sm"><i class="fas fa-lg fa-mail-bulk"></i> <b>E-mail: </b>
                                            {{ $item->email }} </p>
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span>
                                                <b>ALamat </b>: {{ $item->alamat }}
                                            </li>
                                            <li class="small mt-2"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span>
                                                <b>Telepon</b> : {{ $item->telepon }}
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                                <div class="col-5 text-center">
                                    <img style="max-height: 128px; max-width: 128px;"
                                        src="{{ $item->foto ? url('foto') . '/' . $item->foto : asset('AdminLTE') . '/dist/img/user1-128x128.jpg' }}"
                                        alt="user-avatar" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-center">
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
