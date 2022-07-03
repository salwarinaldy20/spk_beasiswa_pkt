<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BaseModels;

class KonsultasiHeader extends BaseModels
{
    use HasFactory;

    protected $table = 'tr_konsultasi_header';
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

    public function pasien(){
        $this->belongsTo(Users::class, 'id_user', 'id');
    }

    public function detail(){
        $this->hasMany(KonsultasiDetail::class, 'id_header', 'id');
    }

    public function hasil(){
        $this->belongsTo(VKonsultasiHasil::class, 'id_header', 'id')->orderBy('probabilitas', 'desc')->take(1);
    }
}
