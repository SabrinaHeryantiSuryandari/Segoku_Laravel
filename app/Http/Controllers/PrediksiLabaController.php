<?php

namespace App\Http\Controllers;

use App\Models\HasilPrediksiLaba;
use App\Models\LabaBulanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Array_;

class PrediksiLabaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $charts = LabaBulanan::select('bulan','laba')->get();
        $charts = LabaBulanan::all();
        $prediksi = HasilPrediksiLaba::all();

        return view('admin.prediksilaba.prediksi',compact('charts', 'prediksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     // $rata = LabaBulanan::avg('jumlahPenumpang');
    //     // $Dmax = LabaBulanan::orderBy('jumlahPenumpang','DESC')->first();
    //     // $Dmin = LabaBulanan::orderBy('jumlahPenumpang','ASC')->first();
    //     // $data = LabaBulanan::all();
    //     // $R = $Dmax->jumlahPenumpang-$Dmin->jumlahPenumpang;
    //     // $K = 1+3.332*log(count($data));
    //     // $I = $R/$K;
    //     // $mi = ($Dmax->jumlahPenumpang+$Dmin->jumlahPenumpang)/2;


    //     // $startYear = LabaBulanan::orderBy('tanggal','ASC')->firts;
    //     // $endYear = request('endYear');
    //     if($request->get('tanggal')<'2023-10-02' or $request->get('tanggal')>'2024-08-31'){
    //         return view('admin.errorPrediksi');
    //     }else{
    //         $predictedData = LabaBulanan::select('bulan','laba',DB::raw('sum(laba) as laba'))
    //             ->where('tanggal',$request->get('tanggal'))
    //             ->groupBy('tanggal')->first();
    //         $predictionYear = $request->get('tanggal');

    //         $data = LabaBulanan::all();
    //         // $data = LabaBulanan::select('tanggal','jumlahPenumpang',DB::raw('sum(jumlahPenumpang) as jumlahPenumpang'))
    //         //     ->where('bul','<',$request->get('tanggal'))
    //         //     ->orderBy('tanggal','ASC')
    //         //     ->groupBy('tanggal')
    //         //     ->get();

    //         $numData = $data->count();
    //         $min = $data->min('jumlahPenumpang');
    //         $max = $data->max('jumlahPenumpang');
    //         // calculate interval I
    //         // a. calculate difference between Dvt, Dvt-1 then compute the average
    //         $av = 0;
    //         $difference = array();
    //         for ($i=1; $i < $numData; $i++) { 
    //             $difference[$i] = $data[$i]->jumlahPenumpang - $data[$i-1]->jumlahPenumpang;            
    //             $av = $av + abs($difference[$i]);           
    //         }
            
    //         $av = $av / ($numData-1);       

    //         $B = $av / 2;

    //         // $I = $this->getBase($B);
            
    //         // $m = ceil(($max - $min) / $I);
    //         $m = 1+3.322*log($numData,10);

    //         $m=round($m);
    //         $I = ($max-$min)/($m);
    //         $I=round($I);
    //         $u = array();

    //         $startInterval = $min;

    //         for ($i = 0; $i < $m; $i++) {
    //             $endInterval = $startInterval + $I;
    //             array_push($u, array('start' => $startInterval, 'end' => $endInterval));
    //             $startInterval = $startInterval + $I;
    //         }

    //         // fuzzified debt, calculate the fuzzy category of the data
    //         for ($i=0; $i < $numData; $i++) { 
    //             $this->getFuzzySet($u, $data[$i]);
    //         }

    //         // make fuzzy logic relationship

    //         $flr = array();
            
    //         for ($i=0; $i < $numData - 1; $i++) { 
    //             $ai = $data[$i]->getUi();
    //             $aj = $data[$i+1]->getUi();
    //             if (!$this->checkDuplicateRelationship($flr, $ai, $aj)) {
    //                 array_push($flr, array($ai, $aj));              
    //             }
    //         }

    //         // make flr group
    //         $flrg = array();
    //         foreach ($flr as $key => $value) {
    //             if (empty($flrg[$value[0]])) {
    //                 $flrg[$value[0]] = array($value[1]);
    //             } else {
    //                 array_push($flrg[$value[0]], $value[1]);
    //             }
    //         }

    //         // dd($flrg);

    //         $sumerror = 0;
    //         $pr = array(0);
    //         $af = array(0);
    //         $errorPrediction = array(0);
    //         for ($i=1; $i < $numData; $i++) { 
    //             $pr[$i] = $this->calcPrediction($flrg, $u, $data[$i-1]);
                
    //             $af[$i] = $pr[$i] - $data[$i]->jumlahPenumpang;
    //             $errorPrediction[$i] = abs($af[$i])/$data[$i]->jumlahPenumpang;
    //             $sumerror = $sumerror + $errorPrediction[$i];
    //         }

    //         $MAPE = $sumerror/($numData-1);

    //         // $g = new Graph;
    //         // $g->name = date("Y-m-d h:i:sa");
    //         // $XAP = $this->getXAPString($data, $pr);
    //         // $g->x = $XAP[0];
    //         // $g->actual = $XAP[1];
    //         // $g->prediction = $XAP[2];
    //         // $g->confirmed = 0;

    //         $predictionResult = $this->calcPrediction($flrg, $u, $data[$numData-1]);
    //         $actualValueOfPredictedData = $predictedData->jumlahPenumpang;

    //         //calc error prediction
    //         // $err = abs(($actualValueOfPredictedData - $predictionResult)/$actualValueOfPredictedData);
    //         // $perr = $err / $actualValueOfPredictedData;
    //         $err = abs($predictionResult - $actualValueOfPredictedData);
    //         $perr = $err / $actualValueOfPredictedData;

    //         // $XAP[0] = $XAP[0].$predictionYear;
    //         // $XAP[1] = $XAP[1].$actualValueOfPredictedData;
    //         // $XAP[2] = $XAP[2].$predictionResult;


    //         // $pieces = explode("|", $XAP[1]);
    //         // dd($pieces);
    //         // $g->save();
            
    //         return view('hasilPrediksi',compact('data', 'difference', 'av', 'B', 'u', 'flr', 'flrg', 'pr', 'af', 'errorPrediction', 'MAPE', 'startYear', 'endYear', 'predictionYear', 'predictionResult', 'err', 'perr', 'XAP','actualValueOfPredictedData', 'min','endInterval','max','I','m','numData'));
    //     }
    // }
    public function store(Request $request)
    {
        $predictionYear = $request->get('tanggal');

        $data = LabaBulanan::all();

        $numData = $data->count();
        $min = $data->min('laba_bulanan');
        $max = $data->max('laba_bulanan');

        $av = 0;
        $difference = array();
        for ($i=1; $i < $numData; $i++) { 
            $difference[$i] = $data[$i]->laba - $data[$i-1]->laba;            
            $av = $av + abs($difference[$i]);           
        }

        $av = $av / ($numData-1);       

        $B = $av / 2;

        $B = $this->getBase($B);

        $m = 1+3.322*log($numData,10);
        $m=round($m);

        $I = ($max-$min)/($m);
        $I=round($I);
        $u = array();
        
        $startInterval = $min;
        
        $a =0;
        for ($i = 0; $i < $m; $i++) {
            $endInterval = $startInterval + $I;
            $a = $a + 1;
            array_push($u, array('start' => $startInterval, 'end' => $endInterval, 'nilai' => $a));
            $startInterval = $startInterval + $I;
        }
        

        // fuzzified debt, calculate the fuzzy category of the data
        for ($i=0; $i < $numData; $i++) { 
            $this->getFuzzySet($u, $data[$i]);
        }        

        // make fuzzifikasi
        $fuzzifikasi = array();
        for ($i=0; $i < $numData; $i++) { 
            $tgl = $data[$i]->bulan;
            $laba_bln = $data[$i]->laba_bulanan;
            $x = "0";
            foreach($u as $key => $current)
            {
            if( ($laba_bln - $current['start']) >= $x && ($laba_bln - $current['end']) <= $x )
                {
                    $a = $current['nilai'];
                    array_push($fuzzifikasi, array('bln' => $tgl,'laba_bln' => $laba_bln,'hasil' => $a));     
                }
            }
        }

        $flr = array();
        // make fuzzy logic relationship
        for ($i=0; $i < $numData - 1; $i++) { 
            // $aj = $fuzzifikasi['hasil'];
            // $ai = $fuzzifikasi['hasil'+1];
            $aj = $fuzzifikasi[$i]['hasil'];
            $ai = $fuzzifikasi[$i+1]['hasil'];
            // dd($aj);
            // $ai = $data[$i]->getUi();
            // $aj = $data[$i+1]->getUi();
            // $aj = $data[$i];
            // $ai = $data[$i+1];
            if (!$this->checkDuplicateRelationship($flr, $ai, $aj)) {
                array_push($flr, array($aj, $ai));              
            }
        }

        // make flr group
        $flrg = array();
        foreach ($flr as $key => $value) {
            // dd ($flrg[$value[0]]) ;
            if (empty($flrg[$value[0]])) {
                $flrg[$value[0]] = array($value[1]);
            } else {
                array_push( $flrg[$value[0]], $value[1]);
            }
        }

        $nilai_tengah = array();
        for ($i=0; $i < $numData -2; $i++) { 
            $nt = ($u[$i]['start'] + $u[$i]['end'])/2;
            // array_push($nilai_tengah, array('bln' => $fuzzifikasi[$i]['bln'],'laba_bln' => $fuzzifikasi[$i]['laba_bln'], 'hasil' => $fuzzifikasi[$i]['hasil'], 'nt' => $nt ));
            array_push($nilai_tengah, array('start' => $u[$i]['start'], 'end' => $u[$i]['end'], 'nilai' => $u[$i]['nilai'], 'nt' => $nt ));
        }

            $pr = array();
            // for ($i=1; $i < count($flrg)+1; $i++) { 
            for ($i=1; $i <= count($flrg); $i++) { 
                $pr[$i] = $this->calcPrediction($flrg, $i, $u, $fuzzifikasi[$i]);
                // $flrgurp = $flrg[$i][$key];
                // array_push($defuzzifikasi, array($flrg[$i], 'pr' => $pr[$i] ));
                // array_push($defuzzifikasi, array($flrgurp, 'af' => $af[$i], 'pr' => $pr[$i] ));
                // array_push($defuzzifikasi, array('1'=>$flrg[$i][0], '2'=>$flrg[$i][1], 'af' => $af[$i], 'pr' => $pr[$i] ));
                // $af[$i] = $pr[$i] - $data[$i]->laba_bulanan;
                // // make APE
                // $errorPrediction[$i] = abs($af[$i])/$data[$i]->jumlahPenumpang;
                // $sumMAPE = $sumerror + $errorPrediction[$i];
            }

            // make defuzzifikasi
            $defuzzifikasi = array();
            $af = array();
            $errorPrediction = array();
            $sumMAPE = 0;
            for ($i=0; $i < $numData; $i++) { 
                $tgl = $data[$i]->bulan;
                $laba_bln = $data[$i]->laba_bulanan;
                $hasil = $fuzzifikasi[$i]['hasil'];
                foreach($flrg as $key => $current)
                {
                if( $hasil == $key )
                    {
                        $df = $pr[$key];
                        // make APE
                        $af[$i] = $df - $data[$i]->laba_bulanan;
                
                $errorPrediction = abs($af[$i]) / $data[$i]->laba_bulanan;
                // $sumMAPE = $sumMAPE + $errorPrediction;
                        array_push($defuzzifikasi, array('bln' => $tgl,'laba_bln' => $laba_bln,'hasil' => $hasil,'df' => $df, 'APE' => $errorPrediction));     
                    }
                }
            }
            
            // foreach($defuzzifikasi as $key => $value)
            for ($i=1; $i < $numData; $i++) { 
                // {
                // dd($defuzzifikasi);
                // $errorPrediction = abs($defuzzifikasi[$i]['APE']) / $data[$i]->laba_bulanan;
                $sumMAPE = $sumMAPE + $defuzzifikasi[$i]['APE'];
                        // array_push($defuzzifikasi, array('bln' => $tgl,'laba_bln' => $laba_bln,'hasil' => $hasil,'df' => $df, 'APE' => $errorPrediction));     

                // }
            }
            $MAPE = $sumMAPE/($numData-1);
            // dd($sumMAPE, $MAPE);
        
        $i = count($flrg);
        $predictionResult = $this->calcPrediction($flrg, $i, $u, $fuzzifikasi[$numData-1]);;

        $actualValueOfPredictedData = LabaBulanan::select('laba');

        // dd($predictionYear, $predictionResult, $numData);
        $laba['bulan'] = $predictionYear;
        $laba['hasil'] = $predictionResult;
        HasilPrediksiLaba::create($laba);
        // dd($laba);

        return view('admin.prediksilaba.hasilprediksi',
            compact('data', 'difference', 'av', 'B', 'u', 'fuzzifikasi', 'flr', 'flrg', 'af', 'errorPrediction', 'MAPE', 
            'predictionYear', 'predictionResult', 'nilai_tengah', 'pr', 'defuzzifikasi', 'MAPE',
            'actualValueOfPredictedData', 'min','endInterval','max','I','m','numData',

        ));
    }

    private function getBase($base) {
        $initBase = 10000;
        if ($base > 10000) {
            $initBase = 10000;
        } elseif ($base > 1000) {
            $initBase = 1000;
        } elseif ($base > 100) {
            $initBase = 100;
        } elseif ($base > 10) {
            $initBase = 10;
        } elseif ($base > 1) {
            $initBase = 1;
        } elseif ($base > 0) {
            $initBase = 0.1;
        }

        return ceil($base*10 / $initBase) / 10 * $initBase;
    }

    private function getFuzzySet($u, $data) {
        // dd($data->laba);
        foreach ($u as $key => $uItem) {
            if ($data->laba >= $uItem['start'] && $data->laba < $uItem['end']) {
                $data->setUi($key);
            }
        }
    }  
    
    private function checkDuplicateRelationship($flr, $ai, $aj) {

        foreach ($flr as $key => $value) {   
            if ($ai == $value[0] && $aj == $value[0]) {
                return true;
            }
            
        }

        // return null; 
        return false; 
    }

    private function calcPrediction($flrg, $i, $u, $fuzzifikasi) {
        // if (empty($flrg[$i])) {            
        //     return ($u[$i]['start'] + $u[$i]['end']) / 2;
        // }

        $aj = $flrg[$i];

        $sumOfMidPoint = 0;
        foreach ($aj as $key => $value) {
            
            $midPoint = ($u[$value-1]['start'] + $u[$value-1]['end']) / 2;
            
            $sumOfMidPoint = $sumOfMidPoint + $midPoint;
            
        }
        $result = $sumOfMidPoint / count($aj);
        return $result;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HasilPrediksiLaba $hasilPrediksiLaba)
    {
        $hasilPrediksiLaba->delete();

        return redirect()->route('prediksilaba.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
