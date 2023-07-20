@extends('layout.app')
@section('content')
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row">
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
                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small"><span class="fa-li"><i
                                                        class="fas fa-lg fa-building"></i></span>
                                                ALamat: {{ $item->alamat }}</li>
                                            <li class="small mt-2"><span class="fa-li"><i
                                                        class="fas fa-lg fa-phone"></i></span>
                                                Telepon : {{ $item->telepon }}</li>
                                        </ul>
                                    @endforeach
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ asset('AdminLTE') }}/dist/img/user1-128x128.jpg" alt="user-avatar"
                                        class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
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
