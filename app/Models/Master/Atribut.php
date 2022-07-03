<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BaseModels;



class Atribut extends BaseModels
{
    use HasFactory;

    protected $table = 'ms_atribut';
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
