<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class petalsm extends Model
{
    protected $table = 'petalsm';

    public function lsm()
    {
        return $this->belongsTo(lsm::class);
    }
     public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
}
