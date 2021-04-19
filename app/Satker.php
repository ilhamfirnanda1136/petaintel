<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satker extends Model
{
    protected $table ='satker';

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
