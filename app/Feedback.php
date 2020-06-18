<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    //
    protected $table = "feedback";
	protected $fillable = [
        'email','kritik_saran','file_gambar','user_id'
    ];

   public function User() {
    
    	return $this->belongsTo('App\User','user_id','id');
    }
}
