@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'Laba Bulanan'}}
    @endsection
    @section('title')
    {{'Data Laba Bulanan Admin Segoku'}}
    @endsection

@php
    use App\Models\Menu;
        $menu = Menu::all();
@endphp
<div class="row justify-content-center">
    <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card">
            <div class="card-header text-white" style="background-color: #4b49ac">
                Penjualan Bulanan
            </div>
            <div class="card-body " >
                <form class="form-inline justify-content-center" action="{{ route('penjualanbulanan.store') }}" method="POST" >
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="row justify-content-center">
                        <div class="input-group mb-3 mr-3">
                            <div class="mb-4">
                                {{-- <label for="message-text" class="col-form-label">Nama Menu</label> --}}
                    
                                <select class="form-control" name="menus_id">
                                    <option value="">Pilih Menu</option>
                                    @foreach ($menu as $m)
                                    <option value="{{$m->id}}">- {{ $m->nama_menu }} - <img src="{{ asset('storage/photo/'.$m->image) }}"
                                        style="height: 100px; width: 100px;"> </option>
                                    @endforeach
                                </select>
                                <small class="text-danger">{{ $errors->first('nama_menu') }}</small>
                            </div>
                        </div>
                        <div class="input-group mb-3 mr-3">
                            <input type="month" name="bulan" placeholder="bulan" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mb-3" onclick="return confirm('Yakin ingin membuat penjualan bulanan?')">Buat Penjualan Bulanan</button>
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
                            <h2 class="col-10">Penjualan Bulanan</h2>
                        </div>
                    </div>
                </div>
                <br>

                <table id="data1" class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Menu</th>
                            <th>Bulan</th>
                            <th>Laba</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php $i = 1; @endphp
                    <tbody>
                        @foreach ($penjualanbulanan as $pb)
                        <tr>
                            {{-- dd('') --}}
                            <td>{{ $i++ }}</td>
                            <td>{{ $pb->nama_menu }}</td>
                            <td>{{ $pb->bulan }}</td>
                            <td>{{ $pb->penjualan }}</td>
                            <td>
                                <form action="{{ route('penjualanbulanan.destroy',$pb->id) }}" method="POST">
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