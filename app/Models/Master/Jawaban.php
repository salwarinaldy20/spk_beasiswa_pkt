<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BaseModels;

class Jawaban extends BaseModels
{
    use HasFactory;
    
    protected $table = 'ms_jawaban';
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
