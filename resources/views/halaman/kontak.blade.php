@extends('layout.app')
@section('content')
    <h1>ini kontak</h1>
    <p>Nama : {{ $nama }}</p>
    <p>Umur : {{ $umur }}</p>
    <ul>
        <li>{{ $skill['web'] }}</li>
        <li>{{ $skill['mobile'] }}</li>
    </ul>
@endsection
