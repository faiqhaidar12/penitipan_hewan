@extends('layout.app')
@section('title', 'Tambah Penitipan')
@section('content')
    <div class="col-md-6">
        <form method="POST" action="{{ '/penitipan/' . $data->id }}">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="hewan_id">Nama Hewan</label>
                    <select name="hewan_id" class="form-control select2" style="width: 250px;">
                        <option value="{{ $data->hewan->id }}" selected="selected">{{ $data->hewan->nama_hewan }}</option>
                        @foreach ($hewan as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_hewan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="tgl_masuk" class="mr-2">Tanggal Masuk</label>
                    <input type="date" name="tgl_masuk" id="tgl_masuk" value="{{ $data->tgl_masuk }}"
                        class="form-control" required>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="tgl_keluar">Tanggal Keluar</label>
                    <input type="date" name="tgl_keluar" id="tgl_keluar" value="{{ $data->tgl_keluar }}"
                        class="form-control" required>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="biaya">Biaya</label>
                    <input type="text" name="biaya" id="biaya" class="form-control" value="{{ $data->biaya }}"
                        readonly>
                </div>
                <div class="form-group" style="width: 150px">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control select2" style="width: 150px;">
                        <option selected="selected">{{ $data->status }}</option>
                        <option value="dititipkan">Dititipkan</option>
                        <option value="diambil">Diambil</option>
                        <option value="dibatalkan">Dibatalkan</option>

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
