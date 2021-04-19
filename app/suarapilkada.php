<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suarapilkada extends Model
{
    protected $table = 'suarapilkada';

    protected $fillable = ['paslon_id','periode_pemilu','kecamatan_id','jml_suara','satker_id'];

    public function paslon()
    {
        return $this->belongsTo(paslon::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
}
