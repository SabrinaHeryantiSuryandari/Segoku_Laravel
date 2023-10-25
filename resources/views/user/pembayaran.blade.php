@extends('layouts.user')

@section('content')
<div class="row text-center" style="background-color: #ffffff">
 {{-- <div class="row "> --}}
    <div class="row px-5 my-3 ml-2">
        <h1>Status Pembayaran</h1>
            {{-- <div class="card shadow"> --}}
                {{-- <div class="card-body"> --}}
                    <div class="table-responsive">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <table style="border: 0cm">
                        {{-- <table class="table-bordered"> --}}
                            <thead>
                                <tr>
                                    <th >Transfer ke</th>
                                    <th>:</th>
                                    {{-- <th colspan="2">Transfer ke:</th> --}}
                                    <th>a/n. Yeni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>BNI</th>
                                    <th>:</th>
                                    <th>0400030053</th>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table id="data2" class="table table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Pembeli</th>
                                    <th>Menu</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Jumlah Pesanan</th>
                                    <th>Total</th>
                                    <th>Status Pesanan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $i=1;
                            @endphp
                            <tbody>
                                @foreach ($pesanan as $psn)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $psn->name }}</td>
                                    <td>
                                        <img src="{{ url('storage/photo/'.$psn->image) }}" class="card-img-top" alt="..." style="height: 200px; width: 200px;">
                                        <br>
                                        {{ $psn->nama_menu }}
                                    </td>
                                    <td>{{ $psn->alamat }}</td> 
                                    {{-- <td>{{ $psn->tanggal_pesanan }}</td> --}}
                                    <td>{{ date('l, d F Y, H:i:s', strtotime($psn->tanggal_pesanan)) }}</td>
                                    <td>{{ $psn->jumlah_pesanan }}</td>
                                    <td>Rp. {{number_format($psn->total) }}</td>
                                    <td>{{ $psn->status }}</td>
                                    <td>
                                        <form action="{{ route('pesanan.destroy',$psn->id) }}" method="POST">
                                            
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modaldetail{{$psn->id}}">
                                                DETAIL
                                            </button> 
                                            <br><br>    
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaluploadbukti{{$psn->id}}">
                                                UPLOAD BUKTI
                                            </button>
                                            @csrf
                                            {{-- @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Hapus
                                            </button> --}}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                    <br>
                {{-- </div>
            </div> --}}
    </div>
 {{-- </div> --}}
</div>
  
<!-- Modal Detail -->
@foreach ( $pesanan as $p )
<div class="modal fade" id="modaldetail{{$p->id}}" tabindex="-1" aria-labelledby="modaluploadbuktiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaluploadbuktiLabel"><b>Data Masukan Pesanan</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                @csrf
                <div class="row">
                    <div class="p-5 col-sm-5 ">
                        <div class="card text-center"  style="width: 23rem; height: 20rem" >
                            <img src="{{ url('storage/photo/'.$p->image) }}" class="card-img-top" alt="..." style="width: 23rem; height: 20rem">
                            <h5>{{ $p->name_menu}}</h5>
                            <h5>{{ $p->deskripsi_menu}}</h5>
                        </div>
                    </div>
                    <br>
                    <div class="p-5 col-sm-10">
                        {{-- <div class="text-center"  > --}}
                        {{-- @foreach ($pser as $p) --}}
                            <br>
                            <p><b>Nama Pembeli</b>: {{ $p->name }}</p>
                            <p><b>Alamat Pesanan</b>: {{ $p->email }}</p>
                            <p><b>Telepon</b>: {{ $p->tlp }}</p>
                            <p><b>Tanggal Pesanan</b>: {{ $p->tanggal_pesanan }}</p>
                            <p><b>Jumlah Pesanan</b>: {{ $p->jumlah_pesanan }}</p>
                            <p><b>Deskripsi Pesanan</b>: {{ $p->deskripsi_pesanan }}</p>
                            <p><b>Total</b>: {{ $p->deskripsi_pesanan }}</p>
                            <p><b>Status</b>: {{ $p->status }}</p>
                            <br>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
  
<!-- Modal upload -->
@foreach ( $pesanan as $p )
{{-- <div class="modal fade" id="modaluploadbukti" tabindex="-1" aria-labelledby="modaluploadbuktiLabel" aria-hidden="true"> --}}
<div class="modal fade" id="modaluploadbukti{{$p->id}}" tabindex="-1" aria-labelledby="modaluploadbuktiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaluploadbuktiLabel"><b>Data Upload Pesanan</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                @csrf
                <form method="POST" action="{{ url('pembayaranuser/update', $p->id) }}" id="pembayaran" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="font-weight-bold">Upload Bukti Transfer</label>
                        <br>
                        <img src="{{ url('storage/photo/'.$p->bukti) }}" style="height: 150px; width: 150px;">
                        <br><br>
                        <input type="file" class="form-control" name="bukti" id="bukti" value="{{ url('storage/photo/'.$p->bukti) }}">
                        @error('bukti')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <p style="color: rgb(236, 109, 130)">Note: Pastikan Semua Data Terisi</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach



@endsection