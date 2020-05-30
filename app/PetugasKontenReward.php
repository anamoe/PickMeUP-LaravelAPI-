<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasKontenReward extends Model
{
	protected $table = "petugas_konten_reward";
	protected $fillable = [
        'nama','nohp','alamat','user_id'
    ];
      public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
    }
}
