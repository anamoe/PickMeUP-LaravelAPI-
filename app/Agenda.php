<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
	protected $table = "agenda";
	protected $fillable = [
        'nama_agenda','keterangan','file'
    ];
}
