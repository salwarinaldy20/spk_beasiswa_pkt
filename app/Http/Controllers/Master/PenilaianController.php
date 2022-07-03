<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\Penilaian;


use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class PenilaianController extends Controller
{
    public function penilaian(){
        return view('app.master.penilaian');
    }

    public function generateButtonAct($status, $idu){

        $aksi = '';

        if(Omjin::permission('penilaianUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('penilaianDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }


        return $aksi;
    }


    public function getDataPenilaian(Request $request){

        // Penilaian disini itu nama Modelnya
        $qry = Penilaian::where('active', 1);

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
			return Self::generateButtonAct(null, $data->id);
		})->rawColumns(['aksi'])->make(true);

		$response = $dataTable->getData(true);
		$response['data'] = collect($response['data'])->map(function($res){

			$res = (Object) $res;
			return [
				'id'=>$res->id,
				'DT_RowIndex'=>$res->DT_RowIndex,
				'nama_penilaian'=>$res->nama_penilaian,
				'aksi'=>$res->aksi];
		});

		return $response;


    }


    public function fdataPenilaian(Request $request){
        $idu = $request->id;
        $data = Penilaian::find($idu);

        if($data){
            $datax = array(
                'nama_penilaian' => $data->nama_penilaian,

            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    public function ucPenilaian(Request $request){

    	$idu = $request->id;

		$nama_penilaian = $request->nama_penilaian;

		DB::beginTransaction();
        try {

            $query1 = [
                'nama_penilaian' => $nama_penilaian,


            ];

            $sql = Penilaian::updateOrCreate( ['id' => $idu], $query1 );


            DB::commit();
            return $this->successResponse('Data successfully saved.', 'Success!');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }

    public function delPenilaian(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql = Penilaian::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql = Penilaian::find($idu);

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Penilaian succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }



}
