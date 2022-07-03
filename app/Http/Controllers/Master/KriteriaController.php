<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\Kriteria;


use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class KriteriaController extends Controller
{
    public function kriteria(){
        return view('app.master.kriteria');
    }

    public function generateButtonAct($status, $idu){

        $aksi = '';

        if(Omjin::permission('kriteriaUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('kriteriaDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }


        return $aksi;
    }


    public function getDataKriteria(Request $request){

        // Kriteria disini itu nama Modelnya
        $qry = Kriteria::where('active', 1);

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
				'kode_kriteria'=>$res->kode_kriteria,
				'kriteria'=>$res->kriteria,
				'aksi'=>$res->aksi];
		});

		return $response;


    }



    public function fdataKriteria(Request $request){
        $idu = $request->id;
        $data = Kriteria::find($idu);

        if($data){
            $datax = array(
                'kode_kriteria' => $data->kode_kriteria,
                'kriteria' => $data->kriteria,
            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    public function ucKriteria(Request $request){

    	$idu = $request->id;

		$kode_kriteria = $request->kode_kriteria;
        $kriteria = $request->kriteria;

		DB::beginTransaction();
        try {

            $query1 = [
                'kode_kriteria' => $kode_kriteria,
                'kriteria' => $kriteria,

            ];

            $sql = Kriteria::updateOrCreate( ['id' => $idu], $query1 );


            DB::commit();
            return $this->successResponse('Data successfully saved.', 'Success!');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }

    public function delKriteria(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql = Kriteria::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql = Kriteria::find($idu);

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Kriteria succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }



}
