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
use App\Models\User\Users;
use App\Models\View\VRules;
use App\Models\View\VKonsultasiHasil;
use App\Models\Transaksi\KonsultasiDetail;
use App\Models\Transaksi\KonsultasiHasil;
use App\Models\Transaksi\KonsultasiHeader;


use Session;
use DB;
use Omjin;
use Validator;
use DataTables;
use Illuminate\Support\Str;


class DiagnosaController extends Controller
{
    public function diagnosa(){

        $gejala = Gejala::where('active', 1)->get();

        return view('app.transaksi.diagnosa', compact('gejala'));
    }

    public function addDataTraining(Request $request){

        $usia = $request->usia;
        $pekerjaan = $request->pekerjaan;
        $jenis_kelamin = $request->jenis_kelamin;
        $jawaban = $request->jawaban;


        DB::beginTransaction();
        try {

            //UPDATE DATA PASIEN
            $data_pasien = [
                'usia' => $usia,
                'pekerjaan' => $pekerjaan,
                'jenis_kelamin' => $jenis_kelamin,
            ];

            Users::where( 'id', Auth::user()->id )->update($data_pasien);


            //TAMBAH DATA HEADER
            $data_header = [
                'id_user' => Auth::user()->id,
            ];

            $header = KonsultasiHeader::create($data_header);

            $id_header = $header->id;


            $data_detail = [];
            $gejala_pasien = [];
            foreach ($jawaban as $key => $item) {
                $id_gejala = isset($item[0]) ? $item[0] : 0;
                $jawaban = isset($item[1]) ? $item[1] : null;

                if($jawaban){
                    $gejala_pasien[] = $id_gejala;
                }

                $data_detail[] = [
                    'id' => (string) Str::uuid(),
                    'id_header' => $id_header,
                    'id_gejala' => $id_gejala,
                    'jawaban' => (boolean) $jawaban,
                ];
            }


            $detail = KonsultasiDetail::insert($data_detail);

            //PERHITUNGAN NAIVE BAYES
            //AMBIL DATA PENYAKIT
            $penyakit = Penyakit::where('active', 1)->get();

            //LOOPING PENYAKIT
            $probabilitas_penyakit = [];
            foreach ($penyakit as $key => $item) {

                $ndata_rekam_medis = KonsultasiHeader::where('active', 1)->count();
                $ndata_mengalami_penyakit = KonsultasiHasil::where('id_penyakit', $item->id)->where('active', 1)->count();

                //NDATA MENGALAMI PENYAKIT / NREKAM MEDIS
                $probabilitas_prior = $ndata_mengalami_penyakit / $ndata_rekam_medis;

                $probabilitas_posterior = 0;

                foreach ($gejala_pasien as $key => $gejala) {
                    $ndata_rekam_medis_mengalami_gejala = KonsultasiDetail::where('id_gejala', $gejala)->where('jawaban', 1)->count();

                    $probabilitas_likehood = $ndata_rekam_medis_mengalami_gejala / $ndata_mengalami_penyakit;

                    if($key == 0){
                        $probabilitas_posterior = $probabilitas_prior * $probabilitas_likehood;
                    } else {
                        $probabilitas_posterior = $probabilitas_posterior * $probabilitas_likehood;
                    }
                }

                $probabilitas_penyakit[] = [
                    'id_user' => Auth::user()->id,
                    'id_header' => $id_header,
                    'id_penyakit' => $item->id,
                    'probabilitas' => $probabilitas_posterior
                ];


            }


            KonsultasiHasil::insert($probabilitas_penyakit);

            $rekam_medis = KonsultasiHeader::with(['detail', 'detail.gejala', 'hasil'])->where('id', $id_header)->first();



            DB::commit();
            return $this->successResponse('Data successfully saved.', $rekam_medis);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }

    }

    public function prosesDiagnosa(Request $request){

        $usia = $request->usia;
        $pekerjaan = $request->pekerjaan;
        $jenis_kelamin = $request->jenis_kelamin;
        $jawaban = $request->jawaban;


        DB::beginTransaction();
        try {

            //UPDATE DATA PASIEN
            $data_pasien = [
                'usia' => $usia,
                'pekerjaan' => $pekerjaan,
                'jenis_kelamin' => $jenis_kelamin,
            ];

            Users::where( 'id', Auth::user()->id )->update($data_pasien);


            //TAMBAH DATA HEADER
            $data_header = [
                'id_user' => Auth::user()->id,
            ];

            $header = KonsultasiHeader::create($data_header);

            $id_header = $header->id;


            $data_detail = [];
            $gejala_pasien = [];
            foreach ($jawaban as $key => $item) {
                $id_gejala = isset($item[0]) ? $item[0] : 0;
                $jawaban = isset($item[1]) ? $item[1] : null;

                if($jawaban){
                    $gejala_pasien[] = $id_gejala;
                }

                $data_detail[] = [
                    'id' => (string) Str::uuid(),
                    'id_header' => $id_header,
                    'id_gejala' => $id_gejala,
                    'jawaban' => (boolean) $jawaban,
                ];
            }


            $detail = KonsultasiDetail::insert($data_detail);

            //PERHITUNGAN NAIVE BAYES
            //AMBIL DATA PENYAKIT
            $penyakit = Penyakit::where('active', 1)->get();

            //LOOPING PENYAKIT
            $probabilitas_penyakit = [];
            foreach ($penyakit as $key => $item) {

                $ndata_rekam_medis = KonsultasiHeader::where('active', 1)->count();
                $ndata_mengalami_penyakit = KonsultasiHasil::where('id_penyakit', $item->id)->where('active', 1)->count();

                //NDATA MENGALAMI PENYAKIT / NREKAM MEDIS
                $probabilitas_prior = $ndata_mengalami_penyakit / $ndata_rekam_medis;

                $probabilitas_posterior = 0;

                foreach ($gejala_pasien as $key => $gejala) {
                    $ndata_rekam_medis_mengalami_gejala = KonsultasiDetail::where('id_gejala', $gejala)->where('jawaban', 1)->count();

                    $probabilitas_likehood = $ndata_rekam_medis_mengalami_gejala / $ndata_mengalami_penyakit;

                    if($key == 0){
                        $probabilitas_posterior = $probabilitas_prior * $probabilitas_likehood;
                    } else {
                        $probabilitas_posterior = $probabilitas_posterior * $probabilitas_likehood;
                    }
                }

                $probabilitas_penyakit[] = [
                    'id_user' => Auth::user()->id,
                    'id_header' => $id_header,
                    'id_penyakit' => $item->id,
                    'probabilitas' => $probabilitas_posterior
                ];


            }


            KonsultasiHasil::insert($probabilitas_penyakit);

            $rekam_medis = KonsultasiHeader::with(['detail', 'detail.gejala', 'hasil'])->where('id', $id_header)->first();



            DB::commit();
            return $this->successResponse('Data successfully saved.', $rekam_medis);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage(), $e->getMessage());
        }

    }
}
