@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'Laporan'}}
    @endsection
    @section('title')
    {{'Data Laporan Admin Segoku'}}
    @endsection


<!-- Tabel pesanan -->
<div class="stretch-card">
    <div class="card shadow">
        <div class="card-body">
            <div class="row ">
                <div class="col-md-8 mb-4">
                    <div class="justify-content-between ">
                        <h2 class="col-10">Laporan</h2>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-right ">
                        <a href="/laporan/cetak_pdf" class="btn btn-primary" target="_blank">CETAK PDF</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <table id="data1" class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Pembeli</th>
                            <th>Alamat Pembeli</th>
                            <th>Pesanan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Jumlah Pesanan</th>
                            <th>Deskripsi Pesanan</th>
                            <th>Total</th>
                            <th>laba</th>
                        </tr>
                    </thead>
                    @php $i = 1; @endphp
                    <tbody>
                        @foreach ($pesanan as $psn)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $psn->name }}</td>
                            <td>{{ $psn->alamat }}</td>
                            <td>{{ $psn->nama_menu }}</td>
                            {{-- <td>{{ $psn->tanggal_pesanan }}</td> --}}
                            {{-- <td>{{ $psn->tanggal_pesanan->format('d/m/Y') }}</td> --}}
                            <td>{{ date('l, d F Y, H:i:s', strtotime($psn->tanggal_pesanan)) }}</td>
                            <td>{{ $psn->jumlah_pesanan }}</td>
                            <td>{{ $psn->deskripsi_pesanan }}</td>
                            <td>Rp. {{number_format( $psn->total )}}</td>
                            <td>Rp. {{number_format( $psn->laba )}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
            <br>
            {{-- <a href="/input_jadwal" class="btn btn-light">Kembali</a>
            <a href="#" type="submit" class="btn btn-primary mr-2">Selesai</a> --}}
        </div>
    </div>
</div>
@endsection