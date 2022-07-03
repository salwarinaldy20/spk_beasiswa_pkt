<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\Atribut;


use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class AtributController extends Controller
{
    public function atribut(){
        return view('app.master.atribut');
    }

    public function generateButtonAct($status, $idu){

        $aksi = '';

        if(Omjin::permission('atributUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('atributDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }


        return $aksi;
    }


    public function getDataAtribut(Request $request){

        // Penyakit disini itu nama Modelnya
        $qry =Atribut::where('active', 1);

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
				'atribut'=>$res->atribut,
				'aksi'=>$res->aksi];
		});

		return $response;


    }



    public function fdataAtribut(Request $request){
        $idu = $request->id;
        $data =Atribut::find($idu);

        if($data){
            $datax = array(
                'atribut' => $data->atribut,
            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    // Update dan Create
    public function ucAtribut(Request $request){

    	$idu = $request->id;

		$atribut = $request->atribut;


		DB::beginTransaction();
        try {

            $query1 = [
                'atribut' => $atribut,

            ];

            $sql =Atribut::updateOrCreate( ['id' => $idu], $query1 );



            DB::commit();
            return $this->successResponse('Data successfully saved.', 'Success!');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }

    public function delAtribut(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql =Atribut::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql =Atribut::find($idu);

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Atribut succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }
}
