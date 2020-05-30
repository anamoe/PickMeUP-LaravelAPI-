<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
    //
         protected $table = "poin";
         protected $fillable = [
        'poin','user_id'
    ];

       public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
    }
       public function transaksi() {
    
        return $this->belongsTo('App\Transaksi','id');
    }
   
}
