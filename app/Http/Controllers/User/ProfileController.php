<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\User\Users; 

use Illuminate\Support\Facades\Auth;
use DB; 
use Omjin; 

use OwenIt\Auditing\Models\Audit;


class ProfileController extends Controller
{
    public function profile(){

        $data = User::find(Auth::user()->id);

        return view('app.setting.profile', compact('data'));
    }

    public function setProfile(Request $request){

        
        DB::beginTransaction();

        try {
            
            $data = User::find(Auth::user()->id); 
            $data->nama = ($request->nama != '' ? $request->nama : $data->nama);
            $data->email = ($request->email != '' ? $request->email : $data->email);
            $data->password = ($request->password != '' ? Hash::make($request->password) : $data->password);
    
            $data->save();

            DB::commit();

            return $this->successResponse('Success', null);

        } catch (\Exception $e) {
            DB::rollback();
            
            return $this->errorResponse($e->getMessage(), null);
            
        }
        
 

    }

    public function setAvatar(Request $request){

        
        DB::beginTransaction();

        try {
            
            $data = User::find(Auth::user()->id); 

            if (!empty($request->foto)) {

                $foto = $request->file('foto')->getClientOriginalName(); 
                $fotoBaru = 'user'.Auth::user()->id. date('Ymd').'.'.$request->file('foto')->getClientOriginalExtension();
                $pathfoto = "storage/foto_user/";
        
                if ($data->foto_user != "default.png") {
                    if(is_file("storage/foto_user/".$data->foto_user))  
                    unlink("storage/foto_user/".$data->foto_user);
                } 
                $request->file('foto')->move($pathfoto, $fotoBaru);
    
                $data->foto_user = $fotoBaru;
    
            }
    
            $data->save();

            DB::commit();

            return $this->successResponse('Success', null);

        } catch (\Exception $e) {
            DB::rollback();
            
            return $this->errorResponse($e->getMessage(), null);
            
        }
        
 

    }

    
}
