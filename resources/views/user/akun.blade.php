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
            @foreach ( $user as $u)
            <div class="p-5 col-sm-5 ">
                <div class="card text-center"  style="width: 23rem; height: 20rem" >
                    <img src="{{ url('storage/photo/'.$u->profil) }}" class="card-img-top" alt="..." style="width: 23rem; height: 20rem">
                
                </div>
            </div>
            <div class="p-5 col-sm-5">
                    <br>
                    <h5>Nama: {{ $u->name }}</h5>
                    <h5>Email: {{ $u->email }}</h5>
                    <h5>Telepon: {{ $u->tlp }}</h5>
                    <h5>Alamat: {{ $u->alamat }}</h5>
                    <br>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edituser{{$u->id}}">
                        EDIT AKUN
                    </button>
            </div>
            @endforeach
        </div>
    </div>
    <br>
</div>

@foreach ( $user as $us )
<div class="modal fade" id="edituser{{$us->id}}" tabindex="-1" aria-labelledby="edituserLabel" aria-hidden="true">
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
                        <label class="font-weight-bold">GAMBAR</label>
                        <br>
                        <img src="{{ url('storage/photo/'.$us->profil) }}" style="height: 150px; width: 150px;">
                        <br><br>
                        <input type="file" class="form-control" name="profil" id="profil" value="{{ $us->profil }}">
                        @error('profil')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $us->name }}" placeholder="Nama">
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Alamat</label>
                        <input type="textarea" class="form-control" id="alamat" name="alamat" value="{{ $us->alamat }}" placeholder="Deskipsi Menu">
                        <small class="text-danger">{{ $errors->first('alamat') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Telepon</label>
                        <input type="text" class="form-control" id="tlp" name="tlp" value="{{ $us->tlp }}" placeholder="18000">
                        <small class="text-danger">{{ $errors->first('tlp') }}</small>
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