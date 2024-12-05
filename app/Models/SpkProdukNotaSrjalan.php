<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkProdukNotaSrjalan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function spk_produk_nota() {
        return $this->hasOne(SpkProdukNota::class, 'id', 'spk_produk_nota_id');
    }
}
