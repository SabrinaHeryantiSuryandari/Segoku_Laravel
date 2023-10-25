<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    use HasFactory;

    protected $table = "laba_bulanans";
    protected $primarykay = "id";

    protected $fillable = [
        'tanggal',
        'laba',
    ];

    protected $ui = 1;

    public function setUi($u) {
    	$this->ui = $u;
    }

    public function getUi() {
    	return $this->ui;
    }
}
