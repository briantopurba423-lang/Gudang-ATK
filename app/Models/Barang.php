<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['kode_barang', 'nama', 'stok', 'kategori_id'];

    protected static function booted(): void
    {
        static::creating(function ($barang) {
            if (empty($barang->kode_barang)) {
                $last = static::max('id') ?? 0;
                $barang->kode_barang = 'ATK-' . str_pad($last + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
