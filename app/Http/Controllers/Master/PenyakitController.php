<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\Penyakit;


use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class PenyakitController extends Controller
{
    public function penyakit(){
        return view('app.master.penyakit');
    }

    public function generateButtonAct($status, $idu){

        $aksi = '';

        if(Omjin::permission('penyakitUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('penyakitDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }


        return $aksi;
    }


    public function getDataPenyakit(Request $request){

        // Penyakit disini itu nama Modelnya
        $qry = Penyakit::where('active', 1);

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
				'nama_penyakit'=>$res->nama_penyakit,
				'penyebab'=>$res->penyebab,
				'solusi'=>$res->solusi,
				'aksi'=>$res->aksi];
		});

		return $response;


    }



    public function fdataPenyakit(Request $request){
        $idu = $request->id;
        $data = Penyakit::find($idu);

        if($data){
            $datax = array(
                'nama_penyakit' => $data->nama_penyakit,
                'penyebab' => $data->penyebab,
                'solusi' => $data->solusi,
            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    public function ucPenyakit(Request $request){

    	$idu = $request->id;

		$nama_penyakit = $request->nama_penyakit;
        $penyebab = $request->penyebab;
		$solusi = $request->solusi;



		DB::beginTransaction();
        try {

            $query1 = [
                'nama_penyakit' => $nama_penyakit,
                'penyebab' => $penyebab,
                'solusi' => $solusi,
            ];

            $sql = Penyakit::updateOrCreate( ['id' => $idu], $query1 );


            DB::commit();
            return $this->successResponse('Data successfully saved.', 'Success!');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }

    public function delPenyakit(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql = Penyakit::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql = Penyakit::find($idu);

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Penyakit succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }



}
