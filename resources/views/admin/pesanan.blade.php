@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'Data Pesanan'}}
    @endsection
    @section('title')
    {{'Data Pesanan Admin Segoku'}}
    @endsection

<!-- Tabel pesanan -->
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
                <br>

                <table id="data1" class="table table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pembeli</th>
                            <th>Menu</th>
                            <th>Alamat</th>
                            <th>Tanggal Pesanan</th>
                            <th>Jumlah Pesanan</th>
                            <th>Deskripsi Pesanan</th>
                            <th>Total</th>
                            <th>Bukti</th>
                            <th>Status Pesanan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php $i = 1; @endphp
                    @foreach ($pesanan as $psn)
                    <tbody>
                        <tr>
                            
                            <td>{{ $i++ }}</td>
                            <td>{{ $psn->name }}</td>
                            <td>{{ $psn->nama_menu }}</td>
                            <td>{{ $psn->alamat }}</td> 
                            <td>{{ date('l, d F Y, H:i:s', strtotime($psn->tanggal_pesanan)) }}</td>
                            {{-- <td>{{ date_format($psn->tanggal_pesanan, 'Y-m-d') }}</td> --}}
                            {{-- <td>{{ date('l, d F Y, h', strtotime($psn->tanggal_pesanan)) }}</td> --}}
                            {{-- <td>{{ $psn->tanggal_pesanan->Format('dddd, D MMMM Y')}}</td> --}}
                            {{-- <td>{{ $psn->tanggal_pesanan }}</td> --}}
                            <td>{{ $psn->jumlah_pesanan }}</td>
                            <td>{{ $psn->deskripsi_pesanan }}</td>
                            <td>Rp. {{number_format( $psn->total )}}</td>
                            <td><img src="{{ url('storage/photo/'.$psn->bukti) }}" style="height: 150px; width: 150px;"></td>
                            <td>{{ $psn->status }}</td>
                            <td>
                                <form action="{{ route('pesanan.destroy',$psn->id) }}" method="POST">
                                    <button type="button" class="btn btn-info " data-toggle="modal" data-target="#modalDetailPesanan{{$psn->id}}">
                                        Detail
                                    </button>
                                    <br><br>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditPesanan{{$psn->id}}">
                                        Edit
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
                    </tbody>
                    @endforeach
                </table> 
            </div>
            <br>
        </div>
    </div>
</div>

@php
use App\Models\Menu;
use App\Models\User;
    $menu = Menu::all();
    $user = User::all();
@endphp
<!-- Modal Tambah Pesanan  -->
<div class="modal fade" id="modalPesanan" tabindex="-1" role="dialog" aria-labelledby="modalMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><b>Data Masukan Pesanan</b></h5>
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
                <form method="POST" action="postpesanan" id="postpesanan" enctype="multipart/form-data">
                {{-- <form method="POST" action="{{ route('menu.store') }}" id="POST" > --}}
                    @csrf
                    <div class="form-group">
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
                    </div>
                    <div class="form-group">
                        <div class="mb-4">
                            <label for="message-text" class="col-form-label">Nama Menu</label>
                
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

                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Tanggal Pesanan</label>
                        <input type="datetime-local" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" placeholder="Tanggal Pesanan">
                        <small class="text-danger">{{ $errors->first('tanggal_pesanan') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Jumalh Pesanan</label>
                        <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" placeholder="12">
                        <small class="text-danger">{{ $errors->first('jumlah_pesanan') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Deskripsi Pesanan</label>
                        <input type="textarea" class="form-control" id="deskripsi_pesanan" name="deskripsi_pesanan" placeholder="Deskipsi Pesanan">
                        <small class="text-danger">{{ $errors->first('deskripsi_pesanan') }}</small>
                    </div>
                    {{-- <div class="mb-4">
                        <label for="message-text" class="col-form-label">Biaya Produksi</label>
                        <input type="text" class="form-control" id="biaya_produksi" name="biaya_produksi" placeholder="Deskipsi Pesanan">
                        <small class="text-danger">{{ $errors->first('biaya_produksi') }}</small>
                    </div> --}}
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
@foreach ( $pesanan as $ps )
<div class="modal fade" id="modalDetailPesanan{{$ps->id}}" tabindex="-2" role="dialog" aria-labelledby="modalEditMenuLabel" aria-hidden="true">
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
                                <td colspan="3"> <img src="{{ url('storage/photo/'.$ps->image) }}" class="card-img-top" alt="..." style="width: 23rem; height: 20rem"></td>
                            </tr>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-group">
                            <tr>
                                <td>Nama Menu</td>
                                <td>:</td>
                                <td>{{$ps->nama_menu}}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-group">
                            <tr>
                                <td>Pembeli</td>
                                <td>:</td>
                                <td>{{$ps->name}}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="form-group">
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $ps->alamat }}</td>
                            </tr>
                        </div>
                    </div>
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Nama Menu</td>
                                <td>:</td>
                                <td>{{ $ps->nama_menu }}</td>
                            </tr>
                        </div>
                    </div> --}}
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Tanggal Pesanan</td>
                                <td>:</td>
                                <td>{{ $ps->tanggal_pesanan }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Deskripsi Pesanan</td>
                                <td>:</td>
                                <td>{{ $ps->deskripsi_pesanan }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Total</td>
                                <td>:</td>
                                <td>Rp. {{number_format($ps->total) }}</td>
                            </tr>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{ $ps->status }}</td>
                            </tr>
                        </div>
                    </div>
                    {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <tr>
                                <td>Laba</td>
                                <td>:</td>
                                <td>Rp. {{ number_format($ps->laba) }}</td>
                            </tr>
                        </div>
                    </div> --}}
                </table>
            </div>
            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditPesanan{{$ps->id}}">
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Edit Pesanan -->
@foreach ( $pesanan as $p )
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
                <form method="POST" action="{{ url('pesanan/update', $p->id) }}">
                    @csrf
                    {{-- <input type="hidden" name="hash" id="" value="{{ csrf_token() }}"> --}}
                    <div class="form-group">
                        <div class="mb-4">
                            <label for="message-text" class="col-form-label">Nama Pemesan</label>
                
                            <select class="form-control" name="users_id">
                                <option value="{{$u->id}}">{{$u->name}}</option>
                                <option value=""><br></option>

                                <option value="">Pilih Pembeli</option>
                                {{-- @foreach ($user as $u) --}}
                                <option value="{{$m->id}}">- {{ $m->name }} -</option>
                                {{-- @endforeach --}}
                            </select>
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-4">
                            <label for="message-text" class="col-form-label">Nama Menu</label>
                
                            <select class="form-control" name="menus_id">
                                <option value="{{$m->id}}">{{$m->nama_menu}}</option>

                                {{-- <option value="">Pilih Menu</option>
                                @foreach ($menu as $m)
                                <option value="{{$m->id}}">- {{ $m->nama_menu }} - <img src="{{ asset('storage/photo/'.$m->image) }}"
                                    style="height: 100px; width: 100px;"> </option>
                                @endforeach --}}
                            </select>
                            <small class="text-danger">{{ $errors->first('nama_menu') }}</small>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Tanggal Pesanan</label>
                        <input type="datetime-local" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="{{ $p->tanggal_pesanan }}" placeholder="Tanggal Pesanan">
                        <small class="text-danger">{{ $errors->first('tanggal_pesanan') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Jumalh Pesanan</label>
                        <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" value="{{ $p->jumlah_pesanan }}" placeholder="12">
                        <small class="text-danger">{{ $errors->first('jumlah_pesanan') }}</small>
                    </div>
                    <div class="mb-4">
                        <label for="message-text" class="col-form-label">Deskripsi Pesanan</label>
                        <input type="textarea" class="form-control" id="deskripsi_pesanan" name="deskripsi_pesanan" value="{{ $p->deskripsi_pesanan }}" placeholder="Deskipsi Pesanan">
                        <small class="text-danger">{{ $errors->first('deskripsi_pesanan') }}</small>
                    </div>
                    <div class="form-group">
                        <div class="mb-4">
                            <label for="message-text" class="col-form-label">Status</label>
                
                            <select class="form-control" name="status">
                                <option value="{{$p->status}}">{{$p->status}}</option>
                                <br>
                                <option value="">Pilih Status</option>
                                <option value="Pembayaran">- Pembayaran - </option>
                                <option value="Terbayar">- Terbayar - </option>
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