<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPrediksiLaba extends Model
{
    use HasFactory;

    protected $table = "prediksi_labas";
    protected $primarykay = "id";

    protected $fillable = [
        'bulan',
        'hasil',
    ];

}
