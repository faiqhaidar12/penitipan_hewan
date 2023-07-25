@extends('layout.app')
@section('title', 'Tambah Penitipan')
@section('content')
    <div class="col-md-6">
        <form method="POST" action="/penitipan">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="hewan_id">Nama Hewan</label>
                    <select name="hewan_id" class="form-control select2" style="width: 250px;">
                        <option selected="selected">---Pilih Nama Hewan---</option>
                        @foreach ($hewan as $item)
                            <option value="{{ $item->id }}" @if (Session::get('hewan_id') == $item->id) selected @endif>
                                {{ $item->nama_hewan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="tgl_masuk" class="mr-2">Tanggal Masuk</label>
                    <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" required>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="tgl_keluar">Tanggal Keluar</label>
                    <input type="date" name="tgl_keluar" id="tgl_keluar" class="form-control" required>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="biaya">Biaya</label>
                    <input type="text" name="biaya" id="biaya" class="form-control" value="{{ $biayaTotal ?? '' }}"
                        readonly>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control select2" style="width: 150px;">
                        <option value="dititipkan" @if (Session::get('status') == 'dititipkan') selected @endif selected="selected">
                            Dititipkan</option>
                        <option value="diambil" @if (Session::get('status') == 'diambil') selected @endif>Diambil</option>
                        <option value="dibatalkan" @if (Session::get('status') == 'dibatalkan') selected @endif>Dibatalkan</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        // Fungsi untuk mengubah angka menjadi format rupiah
        function formatRupiah(angka) {
            return angka.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });
        }

        // Fungsi untuk menghitung biaya berdasarkan tanggal masuk dan tanggal keluar
        function hitungBiaya() {
            var tanggalMasuk = new Date(document.getElementById('tgl_masuk').value);
            var tanggalKeluar = new Date(document.getElementById('tgl_keluar').value);

            var selisihHari = Math.floor((tanggalKeluar - tanggalMasuk) / (1000 * 60 * 60 * 24)) + 1;
            var biayaPerHari = 50000;
            var biayaTotal = selisihHari * biayaPerHari;

            document.getElementById('biaya').value = formatRupiah(biayaTotal);
        }

        // Panggil fungsi hitungBiaya saat tanggal masuk atau tanggal keluar berubah
        document.getElementById('tgl_masuk').addEventListener('change', hitungBiaya);
        document.getElementById('tgl_keluar').addEventListener('change', hitungBiaya);
    </script>
@endsection
