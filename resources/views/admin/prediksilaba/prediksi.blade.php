@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'Prediksi'}}
    @endsection
    @section('title')
    {{'Admin Segoku'}}
    @endsection

<div class="row justify-content-center">
    <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card">
            <div class="card-header text-white" style="background-color: #4b49ac">
                Prediksi
            </div>
            <div class="card-body " >
                <form class="form-inline justify-content-center" action="{{ route('prediksilaba.store') }}" method="POST" >
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="row justify-content-center">
                        <div class="input-group mb-3 mr-3">
                            <input type="month" name="tanggal" placeholder="Tanggal" class="form-control">
                        </div>
                        
                        <button type="submit" class="btn btn-primary mb-3" onclick="return confirm('Yakin ingin membuat prediksi?')">Buat Prediksi</button>
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
                            <h2 class="col-10">Hasil Prediksi</h2>
                        </div>
                    </div>
                </div>
                <br>

                <table id="data1" class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Bulan</th>
                            <th>Hasil</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php $i = 1; @endphp
                    <tbody>
                        @foreach ($prediksi as $p)
                        <tr>
                            {{-- dd('') --}}
                            <td>{{ $i++ }}</td>
                            <td>{{ $p->bulan }}</td>
                            <td>Rp. {{ number_format($p->hasil) }}</td>
                             <td>
                               <form action="{{ route('prediksilaba.destroy',$p->id) }}" method="POST">
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