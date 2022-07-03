<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BaseModels;


class Penyakit extends BaseModels
{
    use HasFactory;

// Sesuaikan dengan nama database jadi penyakit itu ms_penyakit
    protected $table = 'ms_penyakit';
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

}
