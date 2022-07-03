<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Omjin;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BaseModels extends Model
{
    public static function boot() {
        parent::boot();

        static::creating(function($model)
        {  
            $hasColumn = $model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'created_by');

            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }

            if($hasColumn){
                $model->created_by = Auth::user() ? Auth::user()->username : null;
                $model->created_on = Carbon::now()->format('Y-m-d H:i:s');    
            }
        });
 
        static::updating(function($model)
        { 
            $route = Route::currentRouteName();
            if ($route != 'verifyuser'){ 

                $hasColumn = $model->getConnection()->getSchemaBuilder()->hasColumn($model->getTable(), 'updated_by');

                if($hasColumn){
                    $model->updated_by = Auth::user() ? Auth::user()->username : null;
                    $model->updated_on = Carbon::now()->format('Y-m-d H:i:s'); 
                }   
            }
        });
 
 
    }

}