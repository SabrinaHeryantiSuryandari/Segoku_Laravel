@extends('layouts.admin')

@section('content')
    @section('judul')
    {{'Dashboard'}}
    @endsection
    @section('title')
    {{'Admin Segoku'}}
    @endsection

<div class="row ">
    <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-tale">
            <div class="card-body">
                {{-- <h4 class="mb-4 pt-2">Input Pelaksana</h4> --}}
                <h4 class="mb-4 pt-2">Pesanan Dalam Proses</h4>
                <div class="pt-2 px-5">
                    <h2>{{ $terbayar }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-dark-blue">
            <div class="card-body">
                <h4 class="mb-4 pt-2 ">Pesanan Selesai</h4>
                <div class="pt-2 px-5">
                    <h2>{{$selesai}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="stretch-card">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <div class="row ">
                    <div class="col-md-8 mb-4">
                        <div class="justify-content-between ">
                            <h2 class="col-10">Data Pesanan</h2>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-right ">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPesanan">
                                Tambah Data Pesanan
                            </button>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif
                {{-- <br>
                
                <br> --}}
                <div>
                <table id="data1" class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Pembeli</th>
                            <th>Menu</th>
                            <th>Alamat</th>
                            <th>Tanggal Pesanan</th>
                            <th>Jumlah Pesanan</th>
                            <th>Deskripsi Pesanan</th>
                            <th>Total</th>
                            <th>Status Pesanan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php $i = 1;@endphp
                    @foreach ($pesananmingguan as $psn)
                    <tbody>
                        <tr>
                            {{-- <td>{{ $psn->id }}</td> --}}
                            <td>{{ $i++ }}</td>
                            <td>{{ $psn->name }}</td>
                            <td>{{ $psn->nama_menu }}</td>
                            <td>{{ $psn->alamat }}</td> 
                            {{-- <td>{{ $psn->tanggal_pesanan }}</td> --}}
                            <td>{{ date('l, d F Y, H:i:s', strtotime($psn->tanggal_pesanan)) }}</td>
                            <td>{{ $psn->jumlah_pesanan }}</td>
                            <td>{{ $psn->deskripsi_pesanan }}</td>
                            <td>Rp. {{number_format( $psn->total )}}</td>
                            <td>{{ $psn->status }}</td>
                            <td>
                                <form action="{{ route('pesanan.destroy',$psn->id) }}" method="POST">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditPesanan{{$psn->id}}">
                                        Edit
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table> </div>
            </div>
            {{-- <br> --}}
        </div>
    </div>
</div>

@foreach ( $pesananmingguan as $p )
<div class="modal fade" id="modalEditPesanan{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditPesananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Edit Data Pesanan</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <form method="POST" action="{{ url('admin/update', $p->id) }}">
                    @csrf
                    <div class="form-group">
                        <div class="mb-4">
                            <label for="message-text" class="col-form-label">Status</label>
                
                            <select class="form-control" name="status">
                                <option value="{{$p->status}}">{{$p->status}}</option>
                                <br>
                                <option value="">Pilih Status</option>
                                <option value="Selesai">- Selesai - </option>
                                
                            </select>
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                        </div>
                    </div>
                    
                    <p style="color: rgb(236, 109, 130)">Note: Pastikan Semua Data Terisi</p>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary ">Simpan <i class="fa fa-save"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection
