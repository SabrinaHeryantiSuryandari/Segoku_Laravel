<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPrediksiPenjualan extends Model
{
    use HasFactory;

    protected $table = "prediksi_penjualans";
    protected $primarykay = "id";

    protected $fillable = [
        'menus_id',
        'bulan',
        'hasil',
    ];

}
