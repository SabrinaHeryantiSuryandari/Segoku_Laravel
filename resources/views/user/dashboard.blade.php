@extends('layouts.user')

@section('content')
{{-- <div class="row">     --}}
    {{-- style="width: 23rem;" --}}
    <div class="row text-center" style="background-color: #ffffff">
        <div class="row px-5 my-3 ml-2">
            <h1>Pilihan Menu Catering</h1>
            @foreach ($menu as $mnu)
            <div class="p-4 col-sm-4">
                <div class="card"  style="width: 23rem;" >
                    <div class="center">
                        <img src="{{ url('storage/photo/'.$mnu->image) }}" class="card-img-top" alt="..." style="height: 200px; width: 200px;">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $mnu->nama_menu }}</h5>
                        <p class="card-text">{{ $mnu->deskripsi_menu }}</p>
                        <form action="{{ route('usermenu.destroy',$mnu->id) }}" method="POST">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPesanan{{$mnu->id}}">
                                Rp. {{number_format($mnu->harga) }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="p-4 col-sm-4 ">
                <div class="card" style="width: 23rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="p-4 col-sm-4 ">
                <div class="card" style="width: 23rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
{{-- </div> --}}
<!-- Input Modal -->
@foreach ( $menu as $m )
<div class="modal fade" id="modalPesanan{{$m->id}}" tabindex="-1" aria-labelledby="modalPesananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPesananLabel"><b>Data Masukan Pesanan</b></h5>
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
                <form method="POST" action="userpesanan" id="userpesanan" enctype="multipart/form-data">
                {{-- <form method="POST" action="{{ route('menu.store') }}" id="POST" > --}}
                    @csrf
                    {{-- <div class="form-group">
                        <div class="mb-4">
                            <label for="message-text" class="col-form-label">Nama Pemesan</label>
                
                            <select class="form-control" name="users_id">
                                <option value="">Pilih Pembeli</option>
                                @foreach ($user as $u)
                                <option value="{{$u->id}}">- {{ $u->name }} -</option>
                                @endforeach
                            </select>
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                    </div> --}}
                    {{-- <div class="mb-4">
                        <label for="message-text" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" id="users_id" name="users_id" placeholder="Tanggal Pesanan" value="{{ Auth::user()->name }}">
                        <small class="text-danger">{{ $errors->first('users_id') }}</small>
                    </div> --}}
                    <div class="form-group">
                        <div class="mb-4">
                            <label for="message-text" class="col-form-label">Nama Menu</label>
                            <br>
                            <img src="{{ url('storage/photo/'.$m->image) }}" alt="..." style="height: 200px; width: 200px;">
                            <br><br>
                            <select class="form-control" name="menus_id">
                                <option value="{{$m->id}}">- {{ $m->nama_menu }}  Rp. {{number_format($m->harga) }}</option>
                            </select>
                            <small class="text-danger">{{ $errors->first('nama_menu') }}</small>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Tanggal Pesanan</label>
                        <input type="datetime-local" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" placeholder="Tanggal Pesanan">
                        <small class="text-danger">{{ $errors->first('tanggal_pesanan') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Jumalh Pesanan</label>
                        <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" placeholder="25">
                        <small class="text-danger">{{ $errors->first('jumlah_pesanan') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Deskripsi Pesanan</label>
                        <input type="textarea" class="form-control" id="deskripsi_pesanan" name="deskripsi_pesanan" placeholder="Deskipsi Pesanan">
                        <small class="text-danger">{{ $errors->first('deskripsi_pesanan') }}</small>
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