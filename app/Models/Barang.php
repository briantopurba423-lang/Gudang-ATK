<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['kode_barang', 'nama', 'stok', 'stok_minimum', 'kategori_id', 'supplier_id'];

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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Cek apakah stok di bawah minimum
    public function isBelowMinimum(): bool
    {
        return $this->stok <= $this->stok_minimum;
    }

    public function getStatusStokAttribute(): string
    {
        if ($this->stok <= 0) return 'habis';
        if ($this->stok <= $this->stok_minimum) return 'menipis';
        return 'aman';
    }
}
