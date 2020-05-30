<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasLapangan extends Model
{
    //
      protected $table = "petugas_lapangan";
         protected $fillable = [
        'nama','nohp','alamat','user_id'
    ];

  public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
    }

}
