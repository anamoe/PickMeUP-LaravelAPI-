<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kode extends Model
{
    //
    protected $table = "point";
 protected $fillable = [
        'kode_reward','nilai','masyarakat_id'
    ];

      public function masyarakat() {
    
        return $this->belongsTo('App\Masyarakat','masyarakat_id','id');
    }
}
