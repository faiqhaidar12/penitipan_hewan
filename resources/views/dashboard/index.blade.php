@extends('layout.app')
@section('name', 'Dashboard')
@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalPelanggan }}</h3>

                        <p>Jumlah Pelanggan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/pelanggan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalHewan }}</h3>

                        <p>Jumlah Hewan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/hewan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>Rp. {{ number_format($totalPendapatan, 0, ',', '.') }},00</h3>
                        <p>Jumlah Pendapatan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a href="/penitipan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalDititipkan }}<span class="text-sm">
                                dititipkan</span> | {{ $totalDiambil }} <span class="text-sm">
                                diambil</span> | {{ $totalDibatalkan }} <span class="text-sm">
                                dibatalkan</span></h3>
                        <p>Status Penitipan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-happy"></i>
                    </div>
                    <a href="/penitipan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
