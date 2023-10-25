@extends('layouts.admin')
@section('content')
    @section('judul')
    {{'Hasil Prediksi'}}
    @endsection
    @section('title')
    {{'Admin Segoku'}}
    @endsection


    <div class="row justify-content-center">
        <div class="col-md-10">
        
            <div class="card">
                <div class="card-header text-white" style="background-color: #4b49ac">Hasil Prediksi</div>
                <div class="card-body">
                    <p class="make-bold">Hasil prediksi fuzzy time series untuk laba pada bulan <span class="text-danger">{{ $predictionYear }}</span> adalah <span class="text-danger"> Rp. {{ number_format($predictionResult) }}</span>.</p>
                </div>
                <button class="btn btn-primary" style="width: 120px; margin: 10px;" onclick="myFunction()">Lihat detail</button>
                <div class="px-3" id="detail" style="display: none;">
                    <div class="bs-callout bs-callout-info">
                        <h4>Interval data</h4>
                    </div>
                    <div class="bs-example">                            
                    <table class="table table-condensed table-dang">
                        <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Interval</th>
                            <th>Himpunan Fuzzy</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($u as $key => $ui)
                            <tr>
                            <td>{{ $key+1 }}</td>
                            <td><code>[{{ $ui['start'] }}, {{ $ui['end'] }}]</code></td>
                            <td class="text-success">A{{ $key+1 }}</td>                                 
                            </tr>
                        @endforeach                                          
                        </tbody>
                    </table>
                    </div>
  
                    <!-- Fuzzified Debt -->
                    <div class="bs-callout bs-callout-info">
                    <h4>Fuzzifikasi data</h4>
                    </div>
                    <div class="bs-example">                              
                    <table class="table table-condensed table-dang">
                        <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Tahun</th>
                            <th>laba</th>
                            <th>Data Terfuzifikasi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $a1=0;$a2=0;$a3=0;$a4=0;$a5=0;$a6=0;$a7=0;$a8=0;$a9=0;
                        @endphp  
                        @foreach ($data as $datum)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code>{{ $datum->bulan }}</code></td>
                            <td><code>{{ $datum->laba_bulanan }}</code></td>   
                            <td class="text-success">A{{ $datum->getUi()+1 }}</td>  
                            <?php
                            if($datum->getUi()+1==1){
                                $a1+=1;
                            }
                            if($datum->getUi()+1==2){
                                $a2+=1;
                            }
                            if($datum->getUi()+1==3){
                                $a3+=1;
                            }
                            if($datum->getUi()+1==4){
                                $a4+=1;
                            }
                            if($datum->getUi()+1==5){
                                $a5+=1;
                            }
                            if($datum->getUi()+1==6){
                                $a6+=1;
                            }
                            if($datum->getUi()+1==7){
                                $a7+=1;
                            }
                            if($datum->getUi()+1==8){
                                $a8+=1;
                            }
                            if($datum->getUi()+1==9){
                                $a9+=1;
                            }
                            ?>
                            </tr>
                        @endforeach                                          
                        </tbody>
                    </table>
                        {{-- A1 = {{$a1}}, 
                        A2 = {{$a2}}, 
                        A3 = {{$a3}}, 
                        A4 = {{$a4}}, 
                        A5 = {{$a5}}, 
                        A6 = {{$a6}}, 
                        A7 = {{$a7}}, 
                        A8 = {{$a8}}, 
                        A9 = {{$a9}}<br><br> --}}
                    </div>
  
                    <!-- Fuzzy Logic Relation Group -->
                    <div class="bs-callout bs-callout-info">
                    <h4>Kelompok relasi logika fuzzy</h4>
                    </div>
                    <div class="bs-example">                  
                    <table class="table table-condensed">
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach ($flrg as $key=>$fg)                   
                            <tr>                        
                                <td><strong>Kelompok {{ $i }} : </strong></td>
                                <td class="text-success">
                                @foreach($fg as $k => $f)
                                A{{ $key+1 }} &#8618; A{{ $f+1 }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                @endforeach
                                </td>
                            </tr>
                            <?php $i++; ?>                        
                        @endforeach                             
                        </tbody>
                    </table>
                    </div>
  
                    <div class="bs-callout bs-callout-info">
                    <h4>Prediksi Fuzzy time series</h4>
                    </div>
                    <div class="bs-example">
                    <table class="table table-condensed table-dang">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Laba</th>
                            <th>Terfuzifikasi</th>
                            <th>Prediksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $datum)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><code>{{ $datum->bulan }}</code></td>
                            <td><code>{{ $datum->laba_bulanan }}</code></td>
                            <td class="text-success">A{{ $datum->getUi()+1 }}</td>
                            <td>
                            @if ($loop->index != 0) 
                            <code>Rp. {{ number_format($pr[$loop->index]) }}</code>
                            @endif
                            </td>
                        </tr>
                        @endforeach  
                        </tbody>
                    </table>
                    </div>
                </div>
  
                <script>
                    function myFunction() {
                        var x = document.getElementById("detail");
                        if (x.style.display === "none") {
                        x.style.display = "block";
                        } else {
                        x.style.display = "none";
                        }
                    }
                </script>
            </div>
        </div>
    </div>

@endsection