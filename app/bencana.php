<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bencana extends Model
{
    protected $table ='bencana';
    protected $fillable = ['bencana','tahun','kecamatan_id','satker_id','kota_id','januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];

    public function satker()
    {
        return $this->belongsTo(Satker::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
}
