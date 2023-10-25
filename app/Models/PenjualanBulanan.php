<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBulanan extends Model
{
    use HasFactory;

    protected $table = "penjualan_bulanans";
    protected $primarykay = "id";

    protected $fillable = [
        'menus_id',
        'bulan',
        'penjualan',
    ];

    protected $ui = 1;

    public function setUi($u) {
    	$this->ui = $u;
    }

    public function getUi() {
    	return $this->ui;
    }
}
