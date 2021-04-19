<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class petaradikalisme extends Model
{
    protected $table ='petaradikalisme';

    public function radikalisme()
    {
        return $this->belongsTo(radikalisme::class);
    }

     public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
}
