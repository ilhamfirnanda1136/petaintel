<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class radikalisme extends Model
{
    protected $table = 'radikalisme';

    protected $fillable = ['deksripsi_radikalisme'];

    public function petaradikalisme()
    {
        return $this->hasMany(petaradikalisme::class);
    }

}
