<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class petakonflik extends Model
{
    protected $table = 'petakonflik';

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }

    public function konflik()
    {
        return $this->belongsTo(konflik::class);
    }
}
