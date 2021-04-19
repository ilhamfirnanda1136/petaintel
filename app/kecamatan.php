<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    protected $table = 'kecamatan';
    public function kota()
    {
        return $this->belongsTo(kota::class);
    }
    public function petakonflik() {
        return $this->hasMany(petakonflik::class);
    }
    public function petaradikalisme() {
        return $this->hasMany(petaradikalisme::class);
    }
    public function petalsm() {
        return $this->hasMany(petalsm::class);
    }
    public function pakem() {
        return $this->hasMany(pakem::class);
    }
    public function pengawasanasing() {
        return $this->hasMany(pengawasanasing::class);
    }
    public function suarapilkada() {
        return $this->hasMany(suarapilkada::class);
    }
    public function suaraparpol() {
        return $this->hasMany(suaraparpol::class);
    }
    public function vaksinasi() {
        return $this->hasMany(vaksinasi::class);
    }
    public function bencana() {
        return $this->hasMany(bencana::class);
    }
}
