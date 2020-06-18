<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KontenAnimasi extends Model
{
    //
 protected $table = "konten_animasi";
 protected $fillable = [
        'nama','deskripsi','file_gambar'
    ];
}
