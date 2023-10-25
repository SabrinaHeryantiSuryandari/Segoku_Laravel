@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'Laba Bulanan'}}
    @endsection
    @section('title')
    {{'Data Laba Bulanan Admin Segoku'}}
    @endsection

<div class="row justify-content-center">
    <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card">
            <div class="card-header text-white" style="background-color: #4b49ac">
                Laba Bulanan
            </div>
            <div class="card-body " >
                <form class="form-inline justify-content-center" action="{{ route('lababulanan.store') }}" method="POST" >
                {{-- <form class="form-inline justify-content-center" action="/hasillababulanan" method="GET"> --}}
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="row justify-content-center">
                        <div class="input-group mb-3 mr-3">
                            <input type="month" name="bulan" placeholder="bulan" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mb-3" onclick="return confirm('Yakin ingin membuat laba bulanan?')">Buat Laba Bulanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Laba -->
<div class="stretch-card">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <br>
                <div class="row ">
                    <div class="col-md-8 mb-4">
                        <div class="justify-content-between ">
                            <h2 class="col-10">Laba Bulanan</h2>
                        </div>
                    </div>
                </div>
                <br>

                <table id="data1" class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Bulan</th>
                            <th>Laba</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php $i = 1; @endphp
                    <tbody>
                        @foreach ($lababulanan as $lb)
                        <tr>
                            {{-- dd('') --}}
                            <td>{{ $i++ }}</td>
                            <td>{{ $lb->bulan }}</td>
                            <td>Rp. {{ number_format($lb->laba_bulanan) }}</td>
                            <td>
                                <form action="{{ route('lababulanan.destroy',$lb->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
            <br>
        </div>
    </div>
</div>


@endsection