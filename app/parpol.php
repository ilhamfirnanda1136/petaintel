<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parpol extends Model
{
    protected $table = 'parpol';

    protected $fillable = ['no_urut','nama_parpol','satker_id'];

    public function suaraparpol()
    {
        return $this->hasMany(suaraparpol::class);
    }
}
