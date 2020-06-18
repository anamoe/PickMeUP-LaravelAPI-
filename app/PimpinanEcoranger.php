<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PimpinanEcoranger extends Model
{
	  protected $table = "pimpinan_ecoranger";
         protected $fillable = [
        'nama','nohp','alamat','file','user_id'
    ];

    //
       public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
    }
}
