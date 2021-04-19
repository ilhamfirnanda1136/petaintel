<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengawasanasing extends Model
{
    protected $table = 'pengawasanasing';

    public function kecamatan() {
        return $this->belongsTo(kecamatan::class);
    }
}
