<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BaseModels;

class KonsultasiDetail extends BaseModels
{
    use HasFactory;

    protected $table = 'tr_konsultasi_detail';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];


    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'id_gejala', 'id')->where('jawaban', 1);
    }
}
