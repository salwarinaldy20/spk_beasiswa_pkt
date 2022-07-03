<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\Models\User\Role; 
use App\Models\User\Permission; 
use App\User; 

use Session;
use DB; 
use Omjin; 
use Validator; 
use DataTables;


class ACLController extends Controller
{


    public function aclRole(){
        
    	return view('app.setting.acl');
    }

	// ========================================================================================================== //

	public function generateButtonActPermission($status, $idu){

        $aksi = '';
        
        if(Omjin::permission('permissionDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus1(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }

        
        return $aksi;
    }

    public function getListPermission(Request $request){

		$qry = Permission::where('active', 1);

        $filters = $request->filters;
        $search = $request->search;
        $order = $request->order;
        
        $qryparam = [];
        $qryparam['filters'] = $filters;
        $qryparam['search'] = $search;
        $qryparam['order'] = $order;

        $sql = Omjin::dtGen($qry, $qryparam);


        $dataTable = Datatables::of($sql)->addIndexColumn()->make(true);

		$response = $dataTable->getData(true);
		$response['data'] = collect($response['data'])->map(function($res){
			
			$res = (Object) $res;
			return [
				'id'=>$res->id, 
				'DT_RowIndex'=>$res->DT_RowIndex, 
				'kategori'=>$res->kategori, 
				'permission_key'=>$res->permission_key, 
				'keterangan'=>$res->keterangan];
		});

		return $response;
    }

	public function getDataPermission(Request $request){
		
        $qry = Permission::where('active', 1);

        $filters = $request->filters;
        $search = $request->search;
        $order = $request->order;
        
        $qryparam = [];
        $qryparam['filters'] = $filters;
        $qryparam['search'] = $search;
        $qryparam['order'] = $order;

        $sql = Omjin::dtGen($qry, $qryparam);


        $dataTable = Datatables::of($sql)->addIndexColumn()
		->addColumn('aksi', function ($data){ 
			return Self::generateButtonActPermission(null, $data->id);
		})->rawColumns(['aksi'])->make(true);

		$response = $dataTable->getData(true);
		$response['data'] = collect($response['data'])->map(function($res){
			
			$res = (Object) $res;
			return [
				'id'=>$res->id, 
				'DT_RowIndex'=>$res->DT_RowIndex, 
				'kategori'=>$res->kategori, 
				'permission_key'=>$res->permission_key, 
				'keterangan'=>$res->keterangan,
				'aksi'=>$res->aksi];
		});

		return $response;
  
	}
  
	public function ucPermission(Request $request){
    	$idr = $request->id;
		$permission_key = $request->permission_key;
		$keterangan = $request->keterangan;
		$kategori = ucwords(trim($request->kategori));
        

		$validator = Validator::make($request->all(),[
			'permission_key' => 'required',
		]);

		if ($validator->fails())
		{
			return response()->json(['status' => false, 'message'=> 'E13', 'errors'=>$validator->errors()->all()]);
			die();
        }

		
		$arr = ['permission_key' => $permission_key, 'keterangan' => $keterangan,'kategori' => $kategori];


		DB::beginTransaction();
        try {
            // store data
			$sql = Permission::updateOrCreate(['permission_key' => $permission_key], $arr);

			DB::commit();

			$listperm = Permission::orderBy('id', 'asc')->orderBy('permission_key', 'asc')->get()->map(function ($res) {
				return ['id'=>$res->id, 'permission_key'=>$res->permission_key, 'keterangan'=>$res->keterangan, 'kategori'=>$res->kategori];
			});

			return $this->successResponse('Data successfully saved.', null);
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }


	public function fdataPermission(Request $request){
    	$idr = $request->id;
    	$data = Permission::find($idr);
    	$datax = array('permission_key' => $data->permission_key,'kategori' => $data->kategori,'keterangan' => $data->keterangan);
    	return response()->json($datax);
    }

    public function delPermission(Request $request){

		DB::beginTransaction();
        try {

			$idx = json_decode($request->id);

			if(is_array($idx)){
                $id = array_map(function($val) { return $val; }, $idx);
            } else {
                $id = [$request->id];
            }

            Permission::whereIn('id', $id)->delete();

            DB::commit();
            return $this->successResponse();
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }


	// ======================================================================================== //


	public function generateButtonActRole($status, $idu){

        $aksi = array();

		$aksi = '';
        
        if(Omjin::permission('roleUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit2(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('roleDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus2(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }

        
        return $aksi;
    }

	public function getListRole(Request $request){
		$data = Role::all()->map(function ($res) {
            return [
              'id'=>$res->id,
              'role'=>$res->role,
              'views'=>$res->views,
              'priviledges'=>$res->priviledges,
            ];
		});
		return response()->json($data);
    }

    public function getDataRole(Request $request){
        

		$qry = Role::where('active', 1);

        $filters = $request->filters;
        $search = $request->search;
        $order = $request->order;
        
        $qryparam = [];
        $qryparam['filters'] = $filters;
        $qryparam['search'] = $search;
        $qryparam['order'] = $order;

        $sql = Omjin::dtGen($qry, $qryparam);


        $dataTable = Datatables::of($sql)->addIndexColumn()
		->addColumn('aksi', function ($data){ 
			return Self::generateButtonActRole(null, $data->id);
		})->rawColumns(['aksi'])->make(true);

		$response = $dataTable->getData(true);
		$response['data'] = collect($response['data'])->map(function($res){
			
			$res = (Object) $res;
			return [
				'id'=>$res->id, 
				'DT_RowIndex'=>$res->DT_RowIndex, 
				'role'=>$res->role,
				'aksi'=>$res->aksi];
		});

		return $response;
    }


    public function ucRole(Request $request){
    	$idr = $request->id;
		$role = $request->role;
		$permission = implode(",", json_decode($request->permission));

		$validator = Validator::make($request->all(),[
			'role' => 'required', 
			'permission' => 'required',
		]);

		if ($validator->fails())
		{
			return response()->json(['status' => false, 'message'=> 'E13', 'errors'=>$validator->errors()->all()]);
			die();
		}

		DB::beginTransaction();
		try {
			// store data
			$sql = Role::updateOrCreate(
					['id' => $idr],
					['role' => $role, /* 'views' => $views, */ 'priviledges' => $permission]
			);

			DB::commit();
			return $this->successResponse('Data successfully saved.', null);
		} catch (\Throwable $e) {
			DB::rollback();
			return $this->errorResponse($e->getMessage(), $e->getMessage());
		}
	}


    public function fdataRole(Request $request){
    	$idr = $request->id;
		$data = Role::find($idr);
		$priviledges = explode(',', $data->priviledges);
		
    	$datax = array(
        'role' => $data->role,
        'views' => $data->views,
        'priviledges' => $priviledges);
    	return response()->json($datax);
    }


    public function delRole(Request $request){

		DB::beginTransaction();
        try {
			
			$idx = json_decode($request->id);
            if(is_array($idx)){
                $id = array_map(function($val) { return $val; }, $idx);
            } else {
                $id = [$request->id]; 
            }

			Role::whereIn('id', $id)->delete();

            DB::commit();
            return $this->successResponse();
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }


}