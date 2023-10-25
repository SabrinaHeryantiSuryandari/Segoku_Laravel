<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";
    protected $primarykay = "id";

    protected $fillable = [
        'image',
        'nama_menu',
        'deskripsi_menu',
        'harga',
        'biaya_produksi',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
