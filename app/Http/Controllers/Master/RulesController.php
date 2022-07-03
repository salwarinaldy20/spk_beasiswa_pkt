<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\Rules;
use App\Models\Master\Gejala;
use App\Models\Master\Penyakit;
use App\Models\View\VRules;

use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class RulesController extends Controller
{
    public function rules(){
        $gejala = Gejala::where('active', 1)->get();
        $penyakit = Penyakit::where('active', 1)->get();

        return view('app.master.rules', compact('gejala','penyakit'));
    }

    public function generateButtonAct($status, $idu){

        $aksi = '';

        if(Omjin::permission('ruleUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('ruleDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }


        return $aksi;
    }

// nampilin ke tabel
    public function getDataRules(Request $request){

        // Penyakit disini itu nama Modelnya
        $qry = VRules::where('active', 1);

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
                // Sesuaikan dengan database
				'id'=>$res->id,
				'DT_RowIndex'=>$res->DT_RowIndex,
				'nama_penyakit'=>$res->nama_penyakit,
				'gejala'=>$res->gejala,
				'bobot'=>$res->bobot,
				'aksi'=>$res->aksi];
		});

		return $response;


    }



    public function fdataRules(Request $request){
        $idu = $request->id;
        $data = Rules::find($idu);

        if($data){
            $datax = array(
                'id_penyakit'=>$data->id_penyakit,
				'id_gejala'=>$data->id_gejala,
				'bobot'=>$data->bobot,
            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    public function ucRules(Request $request){

    	$idu = $request->id;

		$id_penyakit = $request->id_penyakit;
        $id_gejala = $request->id_gejala;
		$bobot = $request->bobot;



		DB::beginTransaction();
        try {

            $query1 = [
                'id_penyakit' => $id_penyakit,
                'id_gejala' => $id_gejala,
                'bobot' => $bobot,
            ];

            $sql = Rules::updateOrCreate( ['id' => $idu], $query1 );


            DB::commit();
            return $this->successResponse('Data successfully saved.', 'Success!');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }

    public function delRules(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql = Rules::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql = Rules::find($idu);

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Rules succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }

}
