<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
      protected $table = "masyarakat";
         protected $fillable = [
        'nama','nohp','alamat','user_id','file_gambar','poin'
    ];

       public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
    }
       public function transaksi() {
    
        return $this->belongsTo('App\Transaksi','id');
    }
     public function kode() {
    
        return $this->belongsTo('App\kode','id');
    }
   
}
