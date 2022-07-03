<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;

use App\Models\Master\Kategori;


use Session;
use DB;
use Omjin;
use Validator;
use DataTables;

class KategoriController extends Controller
{
    public function kategori(){
        return view('app.master.kategori');
    }

    public function generateButtonAct($status, $idu){

        $aksi = '';

        if(Omjin::permission('kategoriUpdate')){
            $aksi .= '<a class="btnx btn-primary btnx-xs text-white me-2" onclick="edit(\''.$idu.'\');"> <i class="fa fa-pencil-alt text-white"></i></a>';
        }
        if(Omjin::permission('kategoriDelete')){
            $aksi .= '<a class="btnx btn-danger btnx-xs text-white" onclick="hapus(\''.$idu.'\');"> <i class="fa fa-times text-white"></i></a>';
        }


        return $aksi;
    }


    public function getDataKategori(Request $request){

        // Kategori disini itu nama Modelnya
        $qry = Kategori::where('active', 1);

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
				'kode_kategori'=>$res->kode_kategori,
				'kategori'=>$res->kategori,
				'aksi'=>$res->aksi];
		});

		return $response;


    }



    public function fdataKategori(Request $request){
        $idu = $request->id;
        $data = Kategori::find($idu);

        if($data){
            $datax = array(
                'kode_kategori' => $data->kode_kategori,
                'kategori' => $data->kategori,
            );
        } else {
            $datax = null;
        }

    	return response()->json($datax);
    }

    public function ucKategori(Request $request){

    	$idu = $request->id;

		$kode_kategori = $request->kode_kategori;
        $kategori = $request->kategori;

		DB::beginTransaction();
        try {

            $query1 = [
                'kode_kategori' => $kode_kategori,
                'kategori' => $kategori,

            ];

            $sql = Kategori::updateOrCreate( ['id' => $idu], $query1 );


            DB::commit();
            return $this->successResponse('Data successfully saved.', 'Success!');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }


    }

    public function delKategori(Request $request){


		DB::beginTransaction();
        try {

            $idx = json_decode($request->id);
            if(is_array($idx)){

                $id = array_map(function($val) { return $val; }, $idx);
                $sql = Kategori::whereIn('id', $id)->update(['active' => 0]);

            } else {

                $idu = $request->id;
                $sql = Kategori::find($idu);

                $sql1 = $sql->update(['active' => 0]);


            }


            DB::commit();
            return $this->successResponse('Kategori succesfully deleted', null);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }
    }



}
