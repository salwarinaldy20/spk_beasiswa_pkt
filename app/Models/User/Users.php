<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BaseModels;


class Users extends BaseModels
{ 
    use HasFactory;


    protected $table = 'usr_user';
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
