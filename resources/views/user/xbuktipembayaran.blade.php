@extends('layouts.user')

@section('content')
<div class="row px-5 my-3 ml-2" style="background-color: #ffffff">
    <h1 class=" text-center">Akun Saya</h1>
    <div class="table-responsive">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div class="row">
            @foreach ($menu as $mnu)
            <div class="p-4 col-sm-4">
                <div class="card"  style="width: 23rem;" >
                    <div class="center">
                        <h5>Pesanan</h5>
                    </div>
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
            
        </div>

        <div class="row">
            <div class="p-5 col-sm-5 ">
                <div class="card text-center"  style="width: 23rem; height: 20rem" >
                    @foreach ( $user as $u)
                    <img src="{{ url('storage/photo/'.$u->image) }}" class="card-img-top" alt="..." style="width: 23rem; height: 20rem">
                {{-- @endforeach --}}
                </div>
            </div>
            <div class="p-5 col-sm-5">
                {{-- @foreach ($user as $u) --}}
                    <br>
                    <h5>Nama: {{ $u->name }}</h5>
                    <h5>Email: {{ $u->email }}</h5>
                    <h5>Telepon: {{ $u->tlp }}</h5>
                    <h5>Alamat: {{ $u->alamat }}</h5>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edituser{{$u->id}}">
                        EDIT AKUN
                    </button>
                @endforeach
            </div>
        </div>
    </div>
    <br>
</div>

<div class="modal fade" id="upload" tabindex="-1" aria-labelledby="edituserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituserLabel"><b>Data Masukan Pesanan</b></h5>
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
                <form method="POST" action="{{ url('userakun/update', $us->id) }}" enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="hash" id="" value="{{ csrf_token() }}"> --}}
                    <div class="mb-4">
                        <label class="font-weight-bold">UPLOAD BUKTI PEMBAYARAN</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
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

@endsection