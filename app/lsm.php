<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lsm extends Model
{
    protected $table = 'lsm';

    protected $fillable = ['deskripsi_lsm'];

    public function petalsm()
    {
        return $this->hasMany(petalsm::class);
    }
}
