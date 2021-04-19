<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suaraparpol extends Model
{
    protected $table = 'suaraparpol';

    protected $fillable = ['parpol_id','periode_pemilu','kecamatan_id','jml_suara','satker_id'];

    public function parpol()
    {
        return $this->belongsTo(parpol::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
}
