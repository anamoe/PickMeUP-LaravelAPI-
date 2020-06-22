<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    		protected $table='transaksi';
          protected $fillable = [
        'poin_id','masyarakat_id','hadiah_id','file'
    ];

       public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
     }
       public function poin() {
    
        return $this->belongsTo('App\Poin','poin_id','id');
    }
       public function hadiah() {
    
        return $this->belongsTo('App\hadiah','hadiah_id','id');
    }
     public function masyarakat() {
    
        return $this->belongsTo('App\Masyarakat','masyarakat_id','id');
    }
}
