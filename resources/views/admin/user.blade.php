@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'User'}}
    @endsection
    @section('title')
    {{'Data User Admin Segoku'}}
    @endsection

<div class="row">

</div>

<!-- Tabel pesanan -->
<div class="stretch-card">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                @if ($uessage = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $uessage }}</p>
                </div>
                @endif
                <br>
                <div class="row ">
                    <div class="col-md-8 mb-4">
                        <div class="justify-content-between ">
                            <h2 class="col-10">Data User</h2>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-right ">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detaildata">
                                Tambah Data User
                            </button>
                        </div>
                    </div>
                </div>
                <table id="data1" class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php $i = 1; @endphp
                    <tbody>
                        @foreach ($data as $user)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $user->name}}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            {{-- <td>{{ $user->satuan }}</td>
                            <td>Rp. {{number_format($user->harga_satuan) }}</td>--}}
                            <td>
                                
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDetail{{$user->id}}">
                                    Detail
                                </button>
                                <a class="btn btn-danger" href="/user/hapus/{{ $user->id}}">
                                    HAPUS 
                                    {{-- <i class="fa-solid fa-trash-can"></i> --}}
                                </a>
                            </td> 
                            {{-- <td>
                                <form action="{{ route('userdata.destroy',$user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah User  -->
<div class="modal fade" id="detaildata" tabindex="-1" aria-labelledby="detaildataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detaildataLabel"><b>Data Masukan User</b></h5>
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
                @csrf
                <form method="POST" action="postuserdata" id="postuserdata" enctype="multipart/form-data">
                {{-- <form method="POST" action="/postuserdata" enctype="multipart/form-data"> --}}
                    @csrf
                    {{-- <input type="hidden" name="hash" id="" "> --}}
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Role</label>
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role">
                        <small class="text-danger">{{ $errors->first('role') }}</small>
                    </div>
                    {{-- <div class="mb-4">
                        <label class="font-weight-bold">GAMBAR</label>
                        
                        <input type="file" class="form-control" name="profil" id="profil" >
                        @error('profil')
                            <div class="alert alert-danger mt-2">
                                {{ $uessage }}
                            </div>
                        @enderror
                    </div> --}}
                    <div class="mb-4">
                        <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $uessage }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Alamat</label>
                        <input type="textarea" class="form-control" id="alamat" name="alamat"  placeholder="Deskipsi Menu">
                        <small class="text-danger">{{ $errors->first('alamat') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Telepon</label>
                        <input type="text" class="form-control" id="tlp" name="tlp" placeholder="18000">
                        <small class="text-danger">{{ $errors->first('tlp') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $uessage }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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

<!-- Modal detail User  -->
@foreach ( $data as $u )
<div class="modal fade" id="modalDetail{{$u->id}}" tabindex="-1" aria-labelledby="detaildataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detaildataLabel"><b>Data Detail User</b></h5>
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
                @csrf
                <table class="" style="margin:20px auto;" id="dataTable" width="100%" cellspacing="0">
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12"> --}}
                    {{-- <div class="mb-4">
                        <div class="form-group">
                            <tr>
                                <td>Gambar</td>
                                <td>:</td>
                                <td><img src="{{ url('storage/photo/'.$u->image) }}"
                                    style="height: 150px; width: 150px;"></td>
                            </tr>
                        </div>
                    </div> --}}
                    <div class="mb-4">
                        <div class="form-group">
                            <tr>
                                <td>Nama </td>
                                <td>:</td>
                                <td>{{ $u->name }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $u->email }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Telepon</td>
                                <td>:</td>
                                <td> {{ $u->tlp }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td> {{ $u->alamat }}</td>
                            </tr>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection