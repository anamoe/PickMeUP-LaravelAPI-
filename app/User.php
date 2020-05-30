<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class User extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $table = "user";
    protected $fillable = [
        'username', 'email', 'password','role','token'
    ];
       public function masyarakat() {
    
        return $this->belongsTo('App\Masyarakat','id');
    }
       public function pimpinanecoranger() {
    
        return $this->belongsTo('App\PimpinanEcoranger','id');
    }

     public function feedback() {
    
        return $this->belongsTo('App\Feedback','id');
    }
   
   public function poin() {
    
        return $this->belongsTo('App\Poin','id');
    }
       public function transaksi() {
    
        return $this->belongsTo('App\Transaksi','id');
    }
   


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
   }
