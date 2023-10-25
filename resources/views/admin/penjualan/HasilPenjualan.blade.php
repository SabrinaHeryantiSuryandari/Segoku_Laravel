@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'Hasil Prediksi'}}
    @endsection
    @section('title')
    {{'Admin Segoku'}}
    @endsection


<div class="row justify-content-center">
    <div class="col-md-10">
        
        <div class="card">
            @foreach ($penjualanbulanan as $mon)
            <div class="card-header text-white" style="background-color: #4b49ac">
                Hasil Penjualan {{ $mon->nama_menu }}
            </div>
            <div class="card-body">
                <p class="make-bold">Hasil Penjualan Bulan <span class="text-danger">{{ $mon->bulan }}</span> adalah <span class="text-danger"> {{ $mon->penjualan }} </span>.</p>
            </div>
            @endforeach 
            <a href="/penjualanbulanan">
                <button class="btn btn-primary ">Kembali <i class="fa fa-save"></i></button>
            </a>
        </div>
    </div>
</div>

@endsection