<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class konflik extends Model
{
    protected $table = 'konflik';

    protected $fillable = ['deskripsi_konflik'];

    public function petakonflik()
    {
        return $this->hasMany(petakonflik::class);
    }
}
