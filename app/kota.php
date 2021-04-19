<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kota extends Model
{
    protected $table = 'kota';

    public function kecamatan() {
        return $this->hasMany(kecamatan::class);
    }
}
