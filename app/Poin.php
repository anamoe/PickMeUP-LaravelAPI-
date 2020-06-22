<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
        protected $table = "point";
 protected $fillable = [
        'kode_reward','nilai','masyarakat_id','tempat_sampah_id'
    ];

      public function masyarakat() {
    
        return $this->belongsTo('App\Masyarakat','masyarakat_id','id');
    }
       public function user() {
    
        return $this->belongsTo('App\User','user_id','id');
    }
     public function tempat_sampah() {
    
        return $this->belongsTo('App\TempatSampah','tempat_sampah_id','id');
    }
}
