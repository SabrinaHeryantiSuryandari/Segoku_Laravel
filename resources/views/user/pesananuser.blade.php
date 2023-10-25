@extends('layouts.user')

@section('content')
@php
use App\Models\Menu;
use App\Models\User;
    $menu = Menu::all();
    $user = User::all();
@endphp

<div class="row text-center" style="background-color: #ffffff">
 {{-- <div class="row "> --}}
    <div class="row px-5 my-3 ml-2">
        <h1>Pesanan Saya</h1>
            {{-- <div class="card shadow"> --}}
                {{-- <div class="card-body"> --}}
                    <div class="table-responsive">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                        <table id="data1" class="display table table-bordered" cellspacing="0">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php $i=1; @endphp
                            <tbody>
                                @foreach ($pesanan as $psn)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    {{-- <td>{{ $psn->user->name }}</td> --}}
                                    <td>{{ $psn->name }}</td>
                                    {{-- <td>{{ $psn->menu->nama_menu }}</td> --}}
                                    <td>
                                        <img src="{{ url('storage/photo/'.$psn->image) }}" class="card-img-top" alt="..." style="height: 200px; width: 200px;">
                                        <br>{{ $psn->nama_menu }}
                                    </td>
                                    <td>{{ $psn->alamat }}</td> 
                                    {{-- <td>{{ $psn->users_id }}</td>
                                    <td>{{ $psn->menus_id }}</td> --}}
                                    {{-- <td>{{ $psn->tanggal_pesanan }}</td> --}}
                                    <td>{{ date('l, d F Y, H:i:s', strtotime($psn->tanggal_pesanan)) }}</td>
                                    <td>{{ $psn->jumlah_pesanan }}</td>
                                    <td>{{ $psn->deskripsi_pesanan }}</td>
                                    <td>Rp. {{number_format($psn->total) }}</td>
                                    <td>
                                        <form action="{{ route('pesananuser.destroy',$psn->id) }}" method="POST">
                                            
                                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditPesanan{{$psn->id}}">
                                                EDIT
                                            </button>   --}}
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modaldetailpesanan{{$psn->id}}">
                                                DETAIL
                                            </button>
                                            <br><br>
        
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
                {{-- </div>
            </div> --}}
    </div>
 {{-- </div> --}}
</div>

{{-- Detal Pesanan --}}
@foreach ( $pesanan as $p )
<div class="modal fade" id="modaldetailpesanan{{$p->id}}" tabindex="-1" aria-labelledby="modaluploadbuktiLabel" aria-hidden="true">
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

{{-- Edit Pesanan --}}
@foreach ( $pesanan as $m )
<div class="modal fade" id="modalEditPesanan{{$m->id}}" tabindex="-1" aria-labelledby="modalEditPesananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPesananLabel"><b>Data Edit Pesanan</b></h5>
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
                {{-- <form method="PUT" action="{{ url('pesananuser/update', $m->id) }}" id="pesananuser" enctype="multipart/form-data"> --}}
                {{-- <form method="POST" action="editpesananuser" id="editpesananuser" enctype="multipart/form-data"> --}}
                {{-- <form method="GET" action="{{ url('pesananuser/update', $m->id) }}"> --}}
                <form method="POST" action="{{ url('pesananuser/update', $m->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="mb-4">
                            <label for="message-text" class="col-form-label">Nama Menu</label>
                            <br>
                            <img src="{{ url('storage/photo/'.$m->image) }}" alt="..." style="height: 200px; width: 200px;">
                            <br><br>
                            <select class="form-control" name="menus_id">
                                <option value="{{$m->menus_id}}">- {{ $m->nama_menu }}  Rp. {{number_format($m->harga) }}</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('menus_id') }}</small>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Tanggal Pesanan</label>
                        <input type="datetime-local" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="{{ $m->tanggal_pesanan }}">
                        <small class="text-danger">{{ $errors->first('tanggal_pesanan') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Jumalah Pesanan</label>
                        <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" value="{{ $m->jumlah_pesanan }}">
                        <small class="text-danger">{{ $errors->first('jumlah_pesanan') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Deskripsi Pesanan</label>
                        <input type="textarea" class="form-control" id="deskripsi_pesanan" name="deskripsi_pesanan" value="{{ $m->deskripsi_pesanan }}">
                        <small class="text-danger">{{ $errors->first('deskripsi_pesanan') }}</small>
                    </div>
                    <p style="color: rgb(236, 109, 130)">Note: <br> - Pastikan Semua Data Terisi <br> - Jika Ingin Mengganti Pesana Hapus Pesanan dan Buat Baru </p>
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

{{-- @section('js')
<script type="text/javascript">

    $(function () {
  
        
  
      var table = $('.data2').DataTable({
  
          processing: true,
  
          serverSide: true,
  
          ajax: "{{ route('pesananuser.index') }}",
  
          columns: [
  
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'alamat', name: 'alamat'},
              {data: 'tlp', name: 'tlp'},
              {data: 'nama_menu', name: 'nama_menu'},
              {data: 'deskripsi_menu', name: 'deskripsi_menu'},
              {data: 'harga', name: 'harga'},
              {data: 'tanggal_pesanan', name: 'tanggal_pesanan'},
              {data: 'jumlah_pesanan', name: 'jumlah_pesanan'},
              {data: 'deskripsi_pesanan', name: 'deskripsi_pesanan'},
              {data: 'status', name: 'status'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
  
          ]
  
      });
  
        
  
    });
  
  </script>
@endsection --}}