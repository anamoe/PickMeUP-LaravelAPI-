<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitoringSampah extends Model
{
	protected $table = "tempat_sampah";
	protected $fillable = [

        'nama','status','latitude','longitude','file'
    ];
}
