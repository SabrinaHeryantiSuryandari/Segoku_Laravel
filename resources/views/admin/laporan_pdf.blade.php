@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div>
    <!-- Kop Surat -->
    <div>
        <table class="table" border="0" align="center">
            <tr>
                {{-- <td> --}}
                    {{-- <a href='https://postimages.org/' target='_blank'>
                        <img src='' width="https://i.postimg.cc/v1ydbYrP/segoku.png90" height="110" alt='' />
                    </a> --}}
                    {{-- <a href='https://postimg.cc/v1ydbYrP' target='_blank'><img src='https://i.postimg.cc/v1ydbYrP/segoku.png' border='0' alt='segoku'/></a> --}}
                    {{-- <a href='https://postimages.org/' target='_blank'><img src='https://i.postimg.cc/CKBMCdzV/segoku.png' border='0' alt='segoku'/></a> --}}
                    {{-- <a href='https://postimages.org/' target='_blank'><img src='https://i.postimg.cc/CKBMCdzV/segoku.png' height="110" border='0' alt='segoku'/></a> --}}
                {{-- </td> --}}
                {{-- <td width="40"> </td> --}}
                <td style="text-align: center" width="500px">
                    <font color="black">
                        <p align="center">
                            <b>Food & beverage Catering Surabaya </b>
                            <br> Segoku Catering Surabaya
                            <br> Graha Kebraon Mas Blok B No 2, Jl. Balas Klumprik-wiyung-Surabaya
                            <br> Telp. 083834417766 SURABAYA, JAWA TIMUR-60227
                        </p>
                    </font>
                </td>
            </tr>
        </table>
        <hr>
    </div>
    <!-- Judul -->
    <div class="row">
        <table border="0" align="center">
            <tr>
                <td style="text-align: center">
                    <h1><u><b> Laporan Penjualan</b></u></h1>
                </td>
            <tr>
        </table>
    </div>
    <!-- ISI -->
    <div class="table-responsive">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <table id="data1" class="table table-bordered" cellspacing="0" border="1">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama Pembeli</th>
                    <th>Alamat Pembeli</th>
                    <th>Pesanan</th>
                    <th>Tanggal Pesanan</th>
                    <th>Jumlah Pesanan</th>
                    <th>Deskripsi Pesanan</th>
                    <th>Total</th>
                    <th>laba</th>
                </tr>
            </thead>
            @php $i = 1; @endphp
            <tbody>
                @foreach ($pesanan as $psn)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{ $psn->name }}</td>
                    <td>{{ $psn->alamat }}</td>
                    <td>{{ $psn->nama_menu }}</td>
                    {{-- <td>{{ $psn->tanggal_pesanan }}</td> --}}
                    <td>{{ date('l, d F Y, H:i:s', strtotime($psn->tanggal_pesanan)) }}</td>
                    {{-- <td>{{ $psn->tanggal_pesanan->isoFormat('D MMMM Y, H') }}</td> --}}
                    <td>{{ $psn->jumlah_pesanan }}</td>
                    <td>{{ $psn->deskripsi_pesanan }}</td>
                    <td>Rp. {{number_format( $psn->total )}}</td>
                    <td>Rp. {{number_format( $psn->laba )}}</td>
                </tr>
                @endforeach
            </tbody>
        </table> 
    </div>
</div>