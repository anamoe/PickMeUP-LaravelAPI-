<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hadiah extends Model
{
    //
       protected $table = "hadiah";
         protected $fillable = [
        'nama','deskripsi','harga_hadiah','file_gambar','jumlah_hadiah'
    ];
    
      public function transaksi() {
        return $this->belongsTo('App\Transaksi','id');
    }
   
}
