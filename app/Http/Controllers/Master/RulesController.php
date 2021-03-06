<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\RulesPenilaian;
use App\Models\Master\Penilaian;
use App\Models\Master\Kriteria;
use App\Models\Master\Atribut;
use App\Models\View\VRulesPenilaian;

use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class RulesController extends Controller
{
    public function rules(){
        $penilaian = Penilaian::where('active', 1)->get();
        $kriteria = Kriteria::where('active', 1)->get();
        $atribut = Atribut::where('active', 1)->get();

        return view('app.master.rules', compact('penilaian','kriteria','atribut'));
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
        $qry = VRulesPenilaian::where('active', 1);

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
				'nama_penilaian'=>$res->nama_penilaian,
				'kode_kriteria'=>$res->kode_kriteria,
				'kriteria'=>$res->kriteria,
				'kepentingan_kriteria'=>$res->kepentingan_kriteria,
				'atribut'=>$res->atribut,
				'nilai_atribut'=>$res->nilai_atribut,
				'aksi'=>$res->aksi];
		});

		return $response;


    }

    public function fdataRules(Request $request){
        $idu = $request->id;
        $data = RulesPenilaian::find($idu);

        if($data){
            $datax = array(
                'id_penilaian'=>$data->id_penilaian,
				'id_kriteria'=>$data->id_kriteria,
				'kepentingan_kriteria'=>$data->kepentingan_kriteria,
				'id_atribut'=>$data->id_atribut,
				'nilai_atribut'=>$data->nilai_atribut,
            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    public function ucRules(Request $request){

    	$idu = $request->id;

		$id_penilaian = $request->id_penilaian;
        $id_kriteria = $request->id_kriteria;
        $kepentingan_kriteria = $request->kepentingan_kriteria;
        $id_atribut = $request->id_atribut;
        $nilai_atribut = $request->nilai_atribut;

		DB::beginTransaction();
        try {

            $query1 = [
                'id_penilaian' => $id_penilaian,
                'id_kriteria' => $id_kriteria,
                'kepentingan_kriteria' => $kepentingan_kriteria,
                'id_atribut' => $id_atribut,
                'nilai_atribut' => $nilai_atribut,
            ];

            $sql = RulesPenilaian::updateOrCreate( ['id' => $idu], $query1 );


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
                $sql = RulesPenilaian::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql = RulesPenilaian::find($idu);

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
