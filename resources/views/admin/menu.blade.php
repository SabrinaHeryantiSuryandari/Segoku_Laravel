@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'Menu'}}
    @endsection
    @section('title')
    {{'Data Menu Admin Segoku'}}
    @endsection

<!-- Tabel Menu -->
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
                            <h2 class="col-10">Data Menu</h2>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="text-right ">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMenu">
                                Tambah Data Menu
                            </button>
                        </div>
                    </div>
                </div>
                <br>

                <table id="data1" class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th >Gambar</th>
                            <th >Nama Menu</th>
                            <th >Deskripsi Menu</th>
                            <th >Harga</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    @php $i = 1; @endphp
                    <tbody>
                        @foreach ($menu as $mnu)
                        <tr>

                            <td>{{$i++}}</td>
                            <td><img src="{{ url('storage/photo/'.$mnu->image) }}"
                                style="height: 150px; width: 150px;"></td>
                                <td>{{ $mnu->deskripsi_menu }}</td>
                            <td>{{ $mnu->nama_menu }}</td>
                            <td>Rp. {{number_format($mnu->harga) }}</td>
                            {{-- <td><div style = "width:10px; white-space: nowrap; text-overflow: ellipsis;">{{ $mnu->nama_menu }}</div></td> --}}
                            {{-- <td><div style = "width:80px; overflow: hidden; white-space: nowrap;">{{ $mnu->deskripsi_menu }}..</div></td> --}}
                            {{-- <td> <div style = "width:100px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">Rp. {{number_format($mnu->harga) }}</div></td> --}}
                            
                            {{-- <td><div style="width: 20px"> --}}
                            <td>
                                <form action="{{ route('menu.destroy',$mnu->id) }}" method="POST">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDetailMenu{{$mnu->id}}">
                                        Detail
                                    </button>
                                    <br>
                                    <br>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditMenu{{$mnu->id}}">
                                        Edit
                                    </button>
                                    <br>
                                    <br>
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

{{-- <div class="stretch-card">
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
                            <h2 class="col-10">Data Menu</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                        <div class="text-right ">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalMenu">
                                Tambah Data Menu
                            </button>
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
                    
                    <tbody>
                        @foreach ($menu as $mnu)
                        <tr>


                            <td><img src="{{ url('storage/photo/'.$mnu->image) }}"
                                style="height: 150px; width: 150px;"></td>
                            <td>{{ $mnu->nama_menu }}</td>
                            <td>{{ $mnu->deskripsi_menu }}</td>
                            <td>Rp. {{number_format($mnu->harga) }}</td>
                            
                            <td>
                                <form action="{{ route('menu.destroy',$mnu->id) }}" method="POST">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalDetailMenu{{$mnu->id}}">
                                        Detail
                                    </button>

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditMenu{{$mnu->id}}">
                                        Edit
                                    </button>

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
</div> --}}

<!-- Modal Tambah Menu  -->
<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="modalMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Data Masukan Menu</b></h5>
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
                <form method="POST" action="postmenu" id="postmenu" enctype="multipart/form-data">
                {{-- <form method="POST" action="{{ route('menu.store') }}" id="POST" > --}}
                    @csrf
                    {{-- <div class="form-group"> --}}
                    <div class="mb-4">
                        <label class="font-weight-bold">GAMBAR</label>
                        <input type="file" class="form-control" name="photo" id="photo">
                        {{-- <input type="file" class="form-control" name="photo" id="photo"> --}}
                        {{-- <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"> --}}
                    
                        <!-- error message untuk title -->
                        @error('photo')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- <input type="hidden" name="hash" id="" value="{{ csrf_token() }}">
                    <div class="mb-4">
                        <label for="recipient-name" class="col-form-label">Gambar</label>
                        <select class="form-control" name="pengadaan_id" id="pengadaan_id" placeholder="Pilih Pengadaan">
                            <option value="">Pilih Jenis Pengadaan</option>
                            <option value=""></option>
                            @foreach ($pengadaan as $item)
                            <option value="{{$item->id}}">-{{$item->pelaksana->pt_pelaksana}} Pengadaan {{ $item->jenis_pengadaan }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger">{{ $errors->first('jenis_pengadaan') }}</small>
                    </div> --}}
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Nama Menu">
                        <small class="text-danger">{{ $errors->first('nama_menu') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Deskripsi Menu</label>
                        <input type="textarea" class="form-control" id="deskripsi_menu" name="deskripsi_menu" placeholder="Deskipsi Menu">
                        <small class="text-danger">{{ $errors->first('deskripsi_menu') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" placeholder="18000">
                        <small class="text-danger">{{ $errors->first('harga') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Biaya Produksi</label>
                        <input type="number" class="form-control" id="biaya_produksi" name="biaya_produksi" placeholder="12000">
                        <small class="text-danger">{{ $errors->first('biaya_produksi') }}</small>
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

<!-- Modal Detail Barang -->
@foreach ( $menu as $m )
<div class="modal fade" id="modalDetailMenu{{$m->id}}" tabindex="-2" role="dialog" aria-labelledby="modalEditMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Detail Data Barang</b></h5>
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
                <table class="" style="margin:20px auto;" id="dataTable" width="100%" cellspacing="0">
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12"> --}}
                    <div class="mb-4">
                        <div class="form-group">
                            <tr>
                                <td>Gambar</td>
                                <td>:</td>
                                <td><img src="{{ url('storage/photo/'.$m->image) }}"
                                    style="height: 150px; width: 150px;"></td>
                            </tr>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-group">
                            <tr>
                                <td>Nama Menu</td>
                                <td>:</td>
                                <td>{{ $m->nama_menu }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Deskripsi Menu</td>
                                <td>:</td>
                                <td>{{ $m->deskripsi_menu }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Harga</td>
                                <td>:</td>
                                <td>Rp. {{number_format($m->harga) }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Biaya Produksi</td>
                                <td>:</td>
                                <td>Rp. {{ number_format($m->biaya_produksi) }}</td>
                            </tr>
                        </div>
                    </div>
                </table>
            </div>
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditMenu{{$mnu->id}}">
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Edit Menu -->
@foreach ( $menu as $mn )
<div class="modal fade" id="modalEditMenu{{$mn->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEditBarangLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Edit Data Menu</b></h5>
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
                <form method="POST" action="{{ url('menu/update', $mn->id) }}" enctype="multipart/form-data">
                    @csrf
                    {{-- <input type="hidden" name="hash" id="" value="{{ csrf_token() }}"> --}}
                    <div class="mb-4">
                        <label class="font-weight-bold">GAMBAR</label>
                        <br>
                        <img src="{{ url('storage/photo/'.$mn->image) }}" style="height: 150px; width: 150px;">
                        <br><br>
                        <input type="file" class="form-control" name="photo" id="photo" value="{{ url('storage/photo/'.$mn->image) }}">
                        @error('photo')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Nama Menu</label>
                        <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="{{ $mn->nama_menu }}" placeholder="Nama Menu">
                        <small class="text-danger">{{ $errors->first('nama_menu') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Deskripsi Menu</label>
                        <input type="textarea" class="form-control" id="deskripsi_menu" name="deskripsi_menu" value="{{ $mn->deskripsi_menu }}" placeholder="Deskipsi Menu">
                        <small class="text-danger">{{ $errors->first('deskripsi_menu') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="{{ $mn->harga }}" placeholder="18000">
                        <small class="text-danger">{{ $errors->first('harga') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Biaya Produksi</label>
                        <input type="number" class="form-control" id="biaya_produksi" name="biaya_produksi" value="{{ $mn->biaya_produksi }}" placeholder="10000">
                        <small class="text-danger">{{ $errors->first('biaya_produksi') }}</small>
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
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> --}}
{{-- <script>
    CKEDITOR.replace( 'deskripsi_menu' );
</script> --}}


