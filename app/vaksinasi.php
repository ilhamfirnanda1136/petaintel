<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vaksinasi extends Model
{
    protected $table ='vaksinasi';
    protected $fillable = ['vaksinasi','tahun','kecamatan_id','satker_id','kota_id','januari','februari','maret','april','mei','juni','juli','agustus','september','oktober','november','desember'];

    public function satker()
    {
        return $this->belongsTo(Satker::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(kecamatan::class);
    }
}
