<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = "pesanans";
    protected $primarykay = "id";
    protected $dates = ['tanggal_pesanan'];

    protected $fillable = [
        'users_id',
        'menus_id',
        'tanggal_pesanan',
        'jumlah_pesanan',
        'deskripsi_pesanan',
        'total',
        'status',
        'laba',
        'bukti'
    ];

    // public function getCreatedTanggalAttribute()
    // {
    //     return Carbon::parse($this->attributes['tanggal_pesanan'])
    //         ->translatedFormat('l, d F Y');
    // }
    public function getFromDateAttribute($tanggal_pesanan) {
        return \Carbon\Carbon::parse($tanggal_pesanan)->format('d-m-Y');
    }

    protected $casts = [
        // Biarkan sebagai string agar tidak diubah menjadi Carbon instance.
        'tanggal_pesanan' => 'string', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
