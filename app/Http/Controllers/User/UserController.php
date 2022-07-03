<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

// ini karena dia berhubungan dengan user role maka di hubungkan dengan database
use App\Models\User;
use App\Models\User\Users;
use App\Models\User\Role;

use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class UserController extends Controller
{
    public function user(){
        $role = Role::all();

        return view('app.master.user', compact('role'));
    }

    public function generateButtonAct($status, $idu){

        $aksi = '';

        if(Omjin::permission('userUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('userDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }


        return $aksi;
    }


    public function getDataUser(Request $request){


        $qry = User::where('active', 1);

        $filters = $request->filters;
        $search = $request->search;
        $order = $request->order;

        $qryparam = [];
        $qryparam['filters'] = $filters;
        $qryparam['search'] = $search;
        $qryparam['order'] = $order;


        $sql = Omjin::dtGen($qry, $qryparam);


        $dataTable = Datatables::of($sql)->addIndexColumn()
		->addColumn('locked', function ($data){
            $ckd = $data->locked == 0 ? 'checked' : '';

			return '<div class="switch switch-alternative d-inline m-r-10">
                        <input type="checkbox" id="switch-'.$data->id.'" '.$ckd.' onchange="setAktif($(this), \''.$data->id.'\')">
                        <label for="switch-'.$data->id.'" class="cr"></label>
                    </div>';
		})->addColumn('aksi', function ($data){
			return Self::generateButtonAct(null, $data->id);
		})->rawColumns(['aksi', 'locked'])->make(true);

		$response = $dataTable->getData(true);
		$response['data'] = collect($response['data'])->map(function($res){

			$res = (Object) $res;
			return [
				'id'=>$res->id,
				'DT_RowIndex'=>$res->DT_RowIndex,
				'locked'=>$res->locked,
				'nama'=>$res->nama,
				'username'=>$res->username,
				'email'=>$res->email,
				'role_user'=>$res->role_user,
				'id_role'=>$res->id_role,
				'jenis_kelamin'=>$res->jenis_kelamin,
				'last_login'=>Omjin::tglWaktu($res->last_login),
				'aksi'=>$res->aksi];
		});

		return $response;


    }

    public function setActiveUser(Request $request){

        $idx = json_decode($request->id);
        if(is_array($idx)){

            $id = array_map(function($val) { return $val; }, $idx);

        } else {
            $id = [$request->id];
        }

        DB::beginTransaction();
        try {



            $user = Users::whereIn('id', $id)->update(['locked' => boolval($request->locked)]);

            $act = $request->locked == 0 ? 'Activated' : 'Deactivated';
            DB::commit();
            return $this->successResponse('Users succesfully '.$act, 'Success');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }

    }

    public function fdataUser(Request $request){
        $idu = $request->id;
        $data = User::find($idu);

        if($data){
            $datax = array(
                'nama' => $data->nama,
                'username' => $data->username,
                'email' => $data->email,
                'id_role' => $data->id_role,
                'usia' => $data->usia,
                'pekerjaan' =>$data->pekerjaan,
                'jenis_kelamin' =>$data->jenis_kelamin,
                'active' =>$data->active,
            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    public function ucUser(Request $request){

    	$idu = $request->id;

		$id_role = $request->id_role;
		$nama = $request->nama;
        $username = $request->username;
		$email = $request->email;
		$usia = $request->usia;
		$pekerjaan = $request->pekerjaan;
		$jenis_kelamin = $request->jenis_kelamin;
		$password = Hash::make(trim($request->password));



        

    }

    public function delUser(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql = Users::whereIn('id', $id);

                $sql1 = $sql->get();

                foreach ($sql1 as $row) {
                    if ($row->foto_user != "default.png") {
                        if(is_file("storage/foto_user/".$row->foto_user)) // Jika foto ada
                        unlink("storage/foto_user/".$row->foto_user); // Hapus file foto sebelumnya yang ada di folder foto
                    }
                }

                $sql2 = $sql->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql = Users::find($idu);
                if ($sql->foto_user != "default.png") {
                    if(is_file("storage/foto_user/".$sql->foto_user)) // Jika foto ada
                    unlink("storage/foto_user/".$sql->foto_user); // Hapus file foto sebelumnya yang ada di folder foto
                }

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Users succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }


}
