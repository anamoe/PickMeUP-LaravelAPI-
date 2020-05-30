<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hadiah extends Model
{
    //
       protected $table = "hadiah";
         protected $fillable = [
        'nama_hadiah','deskripsi','jumlah_poin','file'
    ];
    
      public function transaksi() {
        return $this->belongsTo('App\Transaksi','id');
    }
   
}
