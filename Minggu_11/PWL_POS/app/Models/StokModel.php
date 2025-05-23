<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokModel extends Model
{
    use HasFactory;

    protected $table = "t_stok";
    protected $primaryKey = "stok_id";
    protected $fillable = [
        'barang_id',
        'user_id',
        'stok_jumlah'
    ];

    public $timestamps = true; // Aktifkan timestamps

    // Relasi ke barang
    public function barang(): BelongsTo
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    // Relasi ke user
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id'); // Ganti User::class ke UserModel::class
    }
}