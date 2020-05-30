<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonitoringSampah extends Model
{
	protected $table = "monitoring_sampah";
	protected $fillable = [

        'nama','keterangan','lat','lng','file'
    ];
}
