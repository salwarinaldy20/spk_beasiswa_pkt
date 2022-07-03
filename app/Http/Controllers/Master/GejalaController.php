<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\Gejala;


use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class GejalaController extends Controller
{
    public function gejala(){
        return view('app.master.gejala');
    }

    public function generateButtonAct($status, $idu){

        $aksi = '';

        if(Omjin::permission('gejalaUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('gejalaDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }


        return $aksi;
    }


    public function getDataGejala(Request $request){

        // Penyakit disini itu nama Modelnya
        $qry =Gejala::where('active', 1);

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
				'gejala'=>$res->gejala,
				'pertanyaan'=>$res->pertanyaan,
				'aksi'=>$res->aksi];
		});

		return $response;


    }



    public function fdataGejala(Request $request){
        $idu = $request->id;
        $data =Gejala::find($idu);

        if($data){
            $datax = array(
                'gejala' => $data->gejala,
                'pertanyaan' => $data->pertanyaan,
            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    // Update dan Create
    public function ucGejala(Request $request){

    	$idu = $request->id;

		$gejala = $request->gejala;
		$pertanyaan = $request->pertanyaan;


		DB::beginTransaction();
        try {

            $query1 = [
                'gejala' => $gejala,
                'pertanyaan' => $pertanyaan,
            ];

            $sql =Gejala::updateOrCreate( ['id' => $idu], $query1 );



            DB::commit();
            return $this->successResponse('Data successfully saved.', 'Success!');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }

    public function delGejala(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql =Gejala::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql =Gejala::find($idu);

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Gejala succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }
}
