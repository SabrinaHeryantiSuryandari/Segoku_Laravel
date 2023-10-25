<?php

namespace App\Http\Controllers;

use App\Models\HasilPrediksiPenjualan;
use App\Models\PenjualanBulanan;
use Illuminate\Http\Request;

class PrediksiPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $charts = PenjualanBulanan::select('bulan','laba')->get();
        $charts = PenjualanBulanan::all();
        // $prediksi = HasilPrediksiPenjualan::all();
        $prediksi = HasilPrediksiPenjualan::join('menus', 'Prediksi_Penjualans.menus_id', '=', 'menus.id')
            ->select('menus.*', 'Prediksi_Penjualans.*')
        ->get();

        return view('admin.prediksipenjualan.prediksi',compact('charts', 'prediksi'));
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
    public function store(Request $request)
    {
        $menu_id = $request->get('menus_id');
        $predictionYear = $request->get('tanggal');

        // $data = PenjualanBulanan::all();
        $data = PenjualanBulanan::where('penjualan_bulanans.menus_id', 'like', "%" . $menu_id . "%")
            ->join('menus', 'penjualan_bulanans.menus_id', '=', 'menus.id')
            ->select('menus.*', 'penjualan_bulanans.*')
        ->get();
        // dd($data);
        $numData = $data->count();
        $min = $data->min('penjualan');
        $max = $data->max('penjualan');

        // selisih
        $av = 0;
        $difference = array();
        for ($i=1; $i < $numData; $i++) { 
            $difference[$i] = $data[$i]->laba - $data[$i-1]->laba;            
            $av = $av + abs($difference[$i]);           
            $menu = $data[$i]->nama_menu;
        }

        $av = $av / ($numData-1);       

        $B = $av / 2;

        $B = $this->getBase($B);

        $m = 1+3.322*log($numData,10);
        $m=round($m);

        $I = ($max-$min)/($m);
        $I=round($I);
        // dd($I);
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
// dd($u);
        // make fuzzifikasi
        $fuzzifikasi = array();
        for ($i=0; $i < $numData; $i++) { 
            $tgl = $data[$i]->bulan;
            $penjualan = $data[$i]->penjualan;
            $x = "0";
            foreach($u as $key => $current)
            {
            if( ($penjualan - $current['start']) >= $x && ($penjualan - $current['end']) <= $x )
                {
                    $a = $current['nilai'];
                    array_push($fuzzifikasi, array('bln' => $tgl,'penjualan' => $penjualan,'hasil' => $a));     
                }
            }
        }
        // dd($fuzzifikasi);
        // make fuzzy logic relationship
        $flr = array();  
        for ($i=0; $i < $numData - 1; $i++) { 
            $aj = $fuzzifikasi[$i]['hasil'];
            $ai = $fuzzifikasi[$i+1]['hasil'];
            if (!$this->checkDuplicateRelationship($flr, $ai, $aj)) {
                array_push($flr, array($aj, $ai));              
            }
        }

        // make flr group
        $flrg = array();
        foreach ($flr as $key => $value) {
            if (empty($flrg[$value[0]])) {
                $flrg[$value[0]] = array($value[1]);
            } else {
                array_push($flrg[$value[0]], $value[1]);
            }
        }
// dd($flrg);
        $pr = array();
        for ($i=1; $i < count($flrg)+1; $i++) { 
            $pr[$i] = $this->calcPrediction($flrg, $i, $u, $fuzzifikasi[$i]);
        }
// dd($pr);
            // make defuzzifikasi
            $defuzzifikasi = array();
            $af = array();
            $errorPrediction = array();
            $sumMAPE = 0;
            for ($i=0; $i < $numData; $i++) { 
                $tgl = $data[$i]->bulan;
                $penjualan = $data[$i]->penjualan;
                $hasil = $fuzzifikasi[$i]['hasil'];
                foreach($flrg as $key => $current)
                {
                if( $hasil == $key )
                    {
                        $df = $pr[$key];
                        // make APE
                        $af[$i] = $df - $data[$i]->laba_bulanan;
                
                $errorPrediction = abs($af[$i]) / $data[$i]->penjualan;
                // $sumMAPE = $sumMAPE + $errorPrediction;
                        array_push($defuzzifikasi, array('bln' => $tgl,'penjualan' => $penjualan,'hasil' => $hasil,'df' => $df, 'APE' => $errorPrediction));     
                    }
                }
            }
            // dd($defuzzifikasi);
            for ($i=1; $i < $numData; $i++) { 
                $sumMAPE = $sumMAPE + $defuzzifikasi[$i]['APE'];
            }
            $MAPE = $sumMAPE/($numData-1);

            $i = count($flrg);
            $predictionResult = $this->calcPrediction($flrg, $i, $u, $fuzzifikasi[$numData-1]);;
            $actualValueOfPredictedData = PenjualanBulanan::select('penjualan');
    
            // dd($predictionYear, $predictionResult, $numData);
            // $penjualan['menus_id'] = $menu_id;
            // $penjualan['bulan'] = $predictionYear;
            // $penjualan['hasil'] = $predictionResult;
            // HasilPrediksiPenjualan::create($penjualan);
            // dd($data);
            foreach ($data as $d) {
                $datapenjualan['menus_id']          = $menu_id;
                $datapenjualan['bulan']          = $predictionYear;
                $datapenjualan['hasil']   = $predictionResult;
                HasilPrediksiPenjualan::create($datapenjualan);
            }
    
            return view('admin.prediksipenjualan.hasilprediksi',
            compact('data', 'difference', 'av', 'B', 'u', 'fuzzifikasi', 'flr', 'flrg', 'af', 'errorPrediction', 'MAPE', 
            'predictionYear', 'predictionResult', 'pr', 'defuzzifikasi', 'MAPE', 'menu',
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

        return false; 
    }

    private function calcPrediction($flrg,$i, $u, $fuzzifikasi) {
        // if (empty($flrg[$data->getUi()])) {            
        //     return ($u[$data->getUi()]['start'] + $u[$data->getUi()]['end']) / 2;
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
    public function destroy(HasilPrediksiPenjualan $HasilPrediksiPenjualan)
    {
        $HasilPrediksiPenjualan->delete();

        return redirect()->route('prediksipenjualan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
