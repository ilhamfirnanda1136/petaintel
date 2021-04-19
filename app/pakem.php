<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pakem extends Model
{
    protected $table = 'pakem';

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
}
