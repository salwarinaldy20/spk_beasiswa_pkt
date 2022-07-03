<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\Jawaban;
use App\Models\Master\Gejala;
use App\Models\Master\Penyakit;
use App\Models\Master\Rules;
use App\Models\User;
use App\Models\View\VRules;
use App\Models\View\VKonsultasiHasil;
use App\Models\View\VKonsultasiHeader;
use App\Models\Transaksi\KonsultasiDetail;
use App\Models\Transaksi\KonsultasiHasil;
use App\Models\Transaksi\KonsultasiHeader;


use Session;
use DB;
use Omjin;
use Validator;
use DataTables;
use Illuminate\Support\Str;

class TrainingController extends Controller
{
    public function training(){

        $gejala = Gejala::where('active', 1)->get();
        $penyakit = Penyakit::where('active', 1)->get();
        $pasien = User::where('role_user', 'like', '%pasien%')->where('active', 1)->get();

        return view('app.transaksi.training', compact('gejala', 'penyakit', 'pasien'));
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


    public function getDataTraining(Request $request){

        // Penyakit disini itu nama Modelnya
        $qry = VKonsultasiHeader::with(['gejala','hasil'])->where('active', 1)->where('is_data_training', 1);

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
        // dd($response['data']);

		$response['data'] = collect($response['data'])->map(function($res){

			$res = (Object) $res;

			return [
				'id'=>$res->id,
				'DT_RowIndex'=>$res->DT_RowIndex,
				'nama_pasien'=>$res->nama_pasien,
				'gejala'=>$res->gejala,
				'pertanyaan'=>$res->pertanyaan,
				'aksi'=>$res->aksi];
		});

		return $response;


    }



    public function fdataTraining(Request $request){
        $idu = $request->id;
        $data = KonsultasiHeader::with(['user', 'gejala','hasil'])->where('id', $idu)->first();

        if($data){
            $datax = $data;
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    // Update dan Create
    public function ucTraining(Request $request){

    	$idu = $request->id;

		$id_user = $request->id_user;
		$id_penyakit = $request->id_penyakit;
		$jawaban = $request->jawaban;


		DB::beginTransaction();
        try {

            $header = [
                'id_user' => $id_user,
            ];

            $sql = KonsultasiHeader::updateOrCreate( ['id' => $idu], $header );

            $id_header = $sql->id;


            foreach($jawaban as $item){
                $id_gejala = isset($item[0]) ? $item[0] : 0;
                $jawaban = isset($item[1]) ? $item[1] : 0;

                $data_detail = [
                    'id_header' => $id_header,
                    'id_gejala' => $id_gejala,
                    'jawaban' => (boolean) $jawaban,
                ];

                KonsultasiDetail::updateOrCreate(['id_header' => $id_header, 'id_gejala' => $id_gejala], $data_detail);
            }

            $hasil = [
                'id_header' => $id_header,
                'id_penyakit' => $id_penyakit,
                'probabilitas' => 1,
            ];

            KonsultasiHasil::updateOrCreate(['id_header' => $id_header], $hasil);


            DB::commit();
            return $this->successResponse('Data successfully saved.', 'Success!');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }

    public function delTraining(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql = KonsultasiHeader::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql = KonsultasiHeader::find($idu);

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Training succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }
}
