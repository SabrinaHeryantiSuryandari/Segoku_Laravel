<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabaBulanan extends Model
{
    use HasFactory;

    protected $table = "laba_bulanans";
    // protected $primarykay = "id";

    protected $fillable = [
        'bulan',
        'laba_bulanan',
    ];

    protected $dates = ['bulan'];

    // protected $ui = -1;
    protected $ui = 0;

    public function setUi($u) {
    	$this->ui = $u;
    }

    public function getUi() {
    	return $this->ui;
    }
}
