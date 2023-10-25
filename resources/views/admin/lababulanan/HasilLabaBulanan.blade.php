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
            <div class="card-header text-white" style="background-color: #4b49ac">
                Hasil Prediksi
            </div>
            <div class="card-body">
                @foreach ($monthlyData as $mon)
                <p class="make-bold">Hasil Laba Bulan <span class="text-danger">{{ $mon->bulan }}</span> adalah <span class="text-danger"> Rp. {{ number_format($mon->laba) }}</span>.</p>
                @endforeach 
            </div>
            <a href="/lababulanan">
                <button class="btn btn-primary ">Kembali <i class="fa fa-save"></i></button>
            </a>
        </div>
    </div>
</div>

@endsection