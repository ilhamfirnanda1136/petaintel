<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paslon extends Model
{
    protected $table = 'paslon';

    protected $fillable = ['periode_pemilu','no_urut','nama_paslon','wakil_paslon','partai','satker_id'];

    public function suarapilkada()
    {
        return $this->hasMany(suarapilkada::class);
    }
}
