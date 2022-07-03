<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
// use App\Mail\NotifMail;


use Carbon\Carbon;
use Session;
use Auth;
use DB;
use Route;
use Crypt;
use DateTime;
use Omjin;


class Helpers {


    public static function permission($views){

    	if(!Auth::check()){
    		return redirect('/signin');
    	}
    	$idu = Auth::user()->id;

		$db = Auth::user()->priviledges;
		if (!empty($db)) { //kalo ada priviledges ada
			$data = $db;
			$prv = explode(',', $data);

			if (is_array($views)) {

				$readx = 0;
				foreach ($views as $key) {
					if (in_array($key, $prv)) {
						$readx++;
					}
				}

    			return ($readx > 0 ? true :  false);

    		} else {

				$read = (in_array($views, $prv) ? true : false);

    			return $read;
    		}

    	} else { //kalo rolenya gada
    		return false;
    	}
    }


	public static function set_active($uri, $output = 'active') {
		if( is_array($uri) ) {
			foreach ($uri as $u) {
				if (Route::is($u)) {
					return $output;
				}
			}
		} else {
			if (Route::is($uri)){
				return $output;
					}
		}
	}


	public static function encx($data){
		$output = base64_encode($data);
	    $outputx = strtr(
	                $output,
	                array(
	                    '+' => '.',
	                    '=' => '-',
	                    '/' => '~'
	                )
	            );

		return $outputx;
	}

	public static function decx($data){
		$string = strtr(
			$data,
			array(
				'.' => '+',
				'-' => '=',
				'~' => '/'
			)
		);
		$output = base64_decode($string);

		return $output;
	}

	public static function encodex( $string, $key="", $url_safe=TRUE) {
	    // you may change these values to your own
	    $secret_key = 'my_simple_secret_key';
	    $secret_iv = 'my_simple_secret_iv';

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	    $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );

	    if ($url_safe)
	    {
	        $output = strtr(
	                $output,
	                array(
	                    '+' => '.',
	                    '=' => '-',
	                    '/' => '~'
	                )
	            );
	    }

	    return $output;
	}

	public static function decodex( $string, $key="", $url_safe=TRUE) {
	    // you may change these values to your own
	    $secret_key = 'my_simple_secret_key';
	    $secret_iv = 'my_simple_secret_iv';

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	    $string = strtr(
	            $string,
	            array(
	                '.' => '+',
	                '-' => '=',
	                '~' => '/'
	            )
	        );
	    $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );

	    return $output;
	}


	public static function diffTanggal($days, $tgl){
		$tgl = strtotime($tgl);
		$date = strtotime($days." day", $tgl);
		$tanggalnew = date('Y-m-d', $date);

		return $tanggalnew;
	}

	public static function cekUmur($a){
	    $tanggal = new DateTime($a);
	    $today = new DateTime('today');
	    $y = $today->diff($tanggal)->y;

	    return $y;
	}

	public static function cekNilai($a){
		//dd(Hash::make('guekuncen###'));
	    $nilai = trim($a);
	    if (is_numeric($nilai) && $nilai > 0 && $nilai < 6) {
	        return true;
	    }else{
	        return false;
	    }
	}

	public static function batasi($a, $b){
	    if(strlen($a) <= $b){
	        return $a;
	    }else{
	        return substr($a, 0, $b).'[...]';
	    }
	}

	public static function cekTanggal($selisih, $tglAwal){
		$hari = ($selisih < 1 ? $selisih : "+".$selisih);
		$hitung = date('Y-m-d', strtotime($hari." day", strtotime($tglAwal)));
		return $hitung;
	}

	public static function tglWaktu($tanggal){

		$pecah1=explode(" ", $tanggal);
		$tgl = self::tanggal($pecah1[0]);
		if (isset($pecah1[1])){
			$waktu = date('H:i:s', strtotime($pecah1[1]));
		} else {
			$waktu = "";
		}
		return $tgl.' '.$waktu;
	}

	public static function tglWaktu1($tanggal){

		$pecah1=explode(" ", $tanggal);
		$tgl = self::tanggal1($pecah1[0]);
		if (isset($pecah1[1])){
			$waktu = date('H:i:s', strtotime($pecah1[1]));
		} else {
			$waktu = "";
		}
		return $tgl.' '.$waktu;
	}

	public static function tanggal($tgl){

		$tanggal = substr($tgl,8,2);
		$bulan   = self::getBulan(substr($tgl,5,2));
		$tahun   = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;
	}

	public static function tanggal1($tgl){

		$tanggal = substr($tgl,8,2);
		$bulan   = self::getBulan1(substr($tgl,5,2));
		$tahun   = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;
	}

	public static function tglWaktuHari($tgl){

		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);

		$pecah1=explode(" ", $tgl);
		$tgl = self::tanggal($pecah1[0]);

		$idxday = date('D', strtotime($pecah1[0]));

		$hari = $dayList[$idxday] ? $dayList[$idxday].', ' : '';

		if (isset($pecah1[1])){
			$waktu = date('H:i:s', strtotime($pecah1[1]));
		} else {
			$waktu = "";
		}

		return $hari.$tgl.' '.$waktu;
	}

	public static function getBulan($bln){
		switch ($bln){
		case 1:
		return "Januari";
		break;
		case 2:
		return "Februari";
		break;
		case 3:
		return "Maret";
		break;
		case 4:
		return "April";
		break;
		case 5:
		return "Mei";
		break;
		case 6:
		return "Juni";
		break;
		case 7:
		return "Juli";
		break;
		case 8:
		return "Agustus";
		break;
		case 9:
		return "September";
		break;
		case 10:
		return "Oktober";
		break;
		case 11:
		return "November";
		break;
		case 12:
		return "Desember";
		break;
		}
	}

	public static function getBulan1($bln){
		switch ($bln){
		case 1:
		return "Jan";
		break;
		case 2:
		return "Feb";
		break;
		case 3:
		return "Mar";
		break;
		case 4:
		return "Apr";
		break;
		case 5:
		return "Mei";
		break;
		case 6:
		return "Jun";
		break;
		case 7:
		return "Jul";
		break;
		case 8:
		return "Ags";
		break;
		case 9:
		return "Sep";
		break;
		case 10:
		return "Okt";
		break;
		case 11:
		return "Nov";
		break;
		case 12:
		return "Des";
		break;
		}
	}


	public static function getRomawi($bln){
        switch ($bln){
        case 1:
            return "I";
        break;
        case 2:
            return "II";
        break;
        case 3:
            return "III";
        break;
        case 4:
            return "IV";
        break;
        case 5:
            return "V";
        break;
        case 6:
            return "VI";
        break;
        case 7:
            return "VII";
        break;
        case 8:
            return "VIII";
        break;
        case 9:
            return "IX";
        break;
        case 10:
            return "X";
        break;
        case 11:
            return "XI";
        break;
        case 12:
            return "XII";
        break;
        }
	}

	public static function duration($timestamp){
			$selisih = time() - strtotime($timestamp) ;
			$detik = $selisih ;
			$menit = round($selisih / 60 );
			$jam = round($selisih / 3600 );
			$hari = round($selisih / 86400 );
			$minggu = round($selisih / 604800 );
			$bulan = round($selisih / 2419200 );
			$tahun = round($selisih / 29030400 );
			if ($detik <= 60) {
				$waktu = $detik.' second ago';
			} else if ($menit <= 60) {
				$waktu = $menit.' minute ago';
			} else if ($jam <= 24) {
				$waktu = $jam.' hours ago';
			} else if ($hari <= 7) {
				$waktu = $hari.' days ago';
			} else if ($minggu <= 4) {
				$waktu = $minggu.' weeks ago';
			} else if ($bulan <= 12) {
				$waktu = $bulan.' months ago';
			} else {
				$waktu = $tahun.' years ago';
			}
			return $waktu;
	}


	public static function numberFormat($angka){
		return number_format($angka, 0, ',', '.');
	}

	public static function numberFormat1($angka){
		return number_format($angka, 0, '.', ',');
	}

	public static function generateKey($length){
		return substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'),1,$length);
	}

	public static function generateUniqueID($limit){
		return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
	}

	public static function generateUniqueID1($limit){
		return substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$limit);
	}

	public static function dtGenAPI($qry, $param){

		$search = $param['search'];
        $filter = $param['filter'];
        $order = $param['order'];
        $skip = $param['skip'];
        $take = $param['take'];
        $kolom = $param['kolom'];

		if(!empty(trim($search))){
			$qry->where(function($q) use($search, $kolom){
				foreach($kolom as $key => $item){
					if($key == 0){
						$q->where($item, 'like', '%'.$search.'%');
					} else {
						$q->orWhere($item, 'like', '%'.$search.'%');
					}
				}
			});
		}

		if(is_array($filter)){

			$qry->where(function($q) use($filter){
				foreach($filter as $item){
					if(isset($item[0]) && isset($item[1]) && isset($item[2])){
						if(!empty(trim($item[0])) && !empty(trim($item[1])) && trim($item[2]) != ""){
							if($item[1] == "in"){
								$arr = explode(",", $item[2]);
								$q->whereIn($item[0], $arr);
							} else {
								$q->where($item[0], $item[1], $item[2]);
							}
						}
					}
				}
			});
		}


		if(is_array($order)){
			if(!empty($order[0] && !empty($order[1]))){
				$qry->orderBy($order[0], $order[1]);
			}
		}

		return $qry;

	}

	public static function dtGen($qry, $param){

		$filters = $param['filters'];
        $search = $param['search'];
        $order = $param['order'];


		if(is_array($filters)){
            foreach($filters as $key => $val){
				if(isset($val[1])){
					if(!is_null($val[1])){
						if(trim($val[1]) != ''){
							if($val[0] == '><' || $val[0] == '>=<'){
								$qry->where(function($q) use ($key, $val){
									$filter = Self::dtTranslate($val);
									$q->where($key, $filter[0], $filter[1])->where($key, $filter[2], $filter[3]);
								});
							} else {
								$filter = Self::dtTranslate($val);
								$qry->where($key, $filter[0], $filter[1]);
							}
						}
					}
				}
            }
        }


        if(isset($search['value'])){
            $qry->where(function($q) use ($filters, $search){
                $no = 0;
                foreach($filters as $key => $val){
                    $no++;
                    if($no == 1){
                        $q->where($key, 'like', '%'.$search['value'].'%');
                    } else {
                        $q->orWhere($key, 'like', '%'.$search['value'].'%');
                    }
                }
            });
        }

		if(!is_null($order)){
			foreach ($order as $key => $val) {
				$qry->orderBy($val['column_name'], $val['dir']);
			}
		}

		return $qry;
	}

	public static function dtTranslate($filter){
		$trans = [];


		if($filter[0] == '%') {
			$trans[0] = 'like';
			$trans[1] = '%'.$filter[1].'%';
		} elseif($filter[0] == '!%') {
			$trans[0] = 'not like';
			$trans[1] = '%'.$filter[1].'%';
		} elseif($filter[0] == '*%') {
			$trans[0] = 'like';
			$trans[1] = $filter[1].'%';
		} elseif($filter[0] == '%*') {
			$trans[0] = 'like';
			$trans[1] = '%'.$filter[1];
		} elseif($filter[0] == '=') {
			$trans[0] = '=';
			$trans[1] = $filter[1];
		} elseif($filter[0] == '!=') {
			$trans[0] = '!=';
			$trans[1] = $filter[1];
		} elseif($filter[0] == '>') {
			$trans[0] = '>';
			$trans[1] = $filter[1];
		} elseif($filter[0] == '<') {
			$trans[0] = '<';
			$trans[1] = $filter[1];
		}  elseif($filter[0] == '>=') {
			$trans[0] = '>=';
			$trans[1] = $filter[1];
		} elseif($filter[0] == '<=') {
			$trans[0] = '<=';
			$trans[1] = $filter[1];
		} elseif($filter[0] == '><') {

			$exp = explode(',', $filter[1]);

			$trans[0] = '>=';
			$trans[1] = $exp[0];
			$trans[2] = '<=';
			$trans[3] = $exp[1];
		} elseif($filter[0] == '>=<') {

			$exp = explode(',', $filter[1]);

			$trans[0] = '>';
			$trans[1] = $exp[0];
			$trans[2] = '<';
			$trans[3] = $exp[1];
		} else {
			$trans[0] = 'like';
			$trans[1] = '%'.$filter[1].'%';
		}

		return $trans;
	}

	public static function dtFilterCategory($type){

		$filter = array();

		if($type == 'string'){
			$filter[] = ["%", 'Contains ( % )'];
			$filter[] = ["!%", 'Does Not Contain ( !% )'];
			$filter[] = ["*%", 'Starts With ( *% )'];
			$filter[] = ["%*", 'Ends With ( %* )'];
			$filter[] = ["=", 'Equals ( = )'];
			$filter[] = ["!=", 'Does Not Equal ( != )'];
		} else if($type == 'numeric'){
			$filter[] = ["%", 'Contains ( % )'];
			$filter[] = ["!%", 'Does Not Contain ( !% )'];
			$filter[] = ["*%", 'Starts With ( *% )'];
			$filter[] = ["%*", 'Ends With ( %* )'];
			$filter[] = ["=", 'Equals ( = )'];
			$filter[] = ["!=", 'Does Not Equal ( != )'];
			$filter[] = [">", 'More Than ( > )'];
			$filter[] = ["<", 'Less Than ( < )'];
			$filter[] = [">=", 'More Than Equal ( >= )'];
			$filter[] = ["<=", 'Less Than Equal ( <= )'];
			$filter[] = ["><", 'Between ( >< )'];
			$filter[] = [">=<", 'Between The Middle ( >=< )'];
		} else if($type == 'date1'){
			$filter[] = ["=", 'Equals ( = )'];
			$filter[] = ["!=", 'Does Not Equal ( != )'];
			$filter[] = [">", 'More Than ( > )'];
			$filter[] = ["<", 'Less Than ( < )'];
			$filter[] = [">=", 'More Than Equal ( >= )'];
			$filter[] = ["<=", 'Less Than Equal ( <= )'];
		} else if($type == 'date2'){
			$filter[] = ["=", 'Equals ( = )'];
			$filter[] = ["!=", 'Does Not Equal ( != )'];
			$filter[] = [">", 'More Than ( > )'];
			$filter[] = ["<", 'Less Than ( < )'];
			$filter[] = [">=", 'More Than Equal ( >= )'];
			$filter[] = ["<=", 'Less Than Equal ( <= )'];
			$filter[] = ["><", 'Between ( >< )'];
			$filter[] = [">=<", 'Between The Middle ( >=< )'];
		} else if($type == 'range'){
			$filter[] = [">", 'More Than ( > )'];
			$filter[] = ["<", 'Less Than ( < )'];
			$filter[] = [">=", 'More Than Equal ( >= )'];
			$filter[] = ["<=", 'Less Than Equal ( <= )'];
			$filter[] = ["><", 'Between ( >< )'];
			$filter[] = [">=<", 'Between The Middle ( >=< )'];
		} else if($type == 'equals') {
			$filter[] = ["=", 'Equals ( = )'];
			$filter[] = ["!=", 'Does Not Equal ( != )'];
		} else {
			$filter[] = ["%", 'Contains ( % )'];
			$filter[] = ["!%", 'Does Not Contain ( !% )'];
			$filter[] = ["*%", 'Starts With ( *% )'];
			$filter[] = ["%*", 'Ends With ( %* )'];
			$filter[] = ["=", 'Equals ( = )'];
			$filter[] = ["!=", 'Does Not Equal ( != )'];
		}
		$filter[] = ["&#128270;", 'Reset'];

		return $filter;
	}

	public static function getIPAddress() {
		//whether ip is from the share internet
		if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
					$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		//whether ip is from the proxy
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		//whether ip is from the remote address
		else{
				 $ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}

	public static function getOS($user_agent){

		$os_platform  = "Unknown OS Platform";

		$os_array     = array(
							'/windows nt 10/i'      =>  'Windows 10',
							'/windows nt 6.3/i'     =>  'Windows 8.1',
							'/windows nt 6.2/i'     =>  'Windows 8',
							'/windows nt 6.1/i'     =>  'Windows 7',
							'/windows nt 6.0/i'     =>  'Windows Vista',
							'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
							'/windows nt 5.1/i'     =>  'Windows XP',
							'/windows xp/i'         =>  'Windows XP',
							'/windows nt 5.0/i'     =>  'Windows 2000',
							'/windows me/i'         =>  'Windows ME',
							'/win98/i'              =>  'Windows 98',
							'/win95/i'              =>  'Windows 95',
							'/win16/i'              =>  'Windows 3.11',
							'/macintosh|mac os x/i' =>  'Mac OS X',
							'/mac_powerpc/i'        =>  'Mac OS 9',
							'/linux/i'              =>  'Linux',
							'/ubuntu/i'             =>  'Ubuntu',
							'/iphone/i'             =>  'iPhone',
							'/ipod/i'               =>  'iPod',
							'/ipad/i'               =>  'iPad',
							'/android/i'            =>  'Android',
							'/blackberry/i'         =>  'BlackBerry',
							'/webos/i'              =>  'Mobile'
						);


		foreach ($os_array as $regex => $value){
			if (preg_match($regex, $user_agent))
				$os_platform = $value;
		}

		return $os_platform;
	}

	public static function getBrowser($user_agent) {

		global $user_agent;

		$browser        = "Unknown Browser";

		$browser_array = array(
								'/msie/i'      => 'Internet Explorer',
								'/firefox/i'   => 'Firefox',
								'/safari/i'    => 'Safari',
								'/chrome/i'    => 'Chrome',
								'/edge/i'      => 'Edge',
								'/opera/i'     => 'Opera',
								'/netscape/i'  => 'Netscape',
								'/maxthon/i'   => 'Maxthon',
								'/konqueror/i' => 'Konqueror',
								'/mobile/i'    => 'Handheld Browser'
						 );

		foreach ($browser_array as $regex => $value){
			if (preg_match($regex, $user_agent))
				$browser = $value;
		}

		return $browser;
	}

	public static function getUserDevice($user_agent){
		$os = Self::getOS($user_agent);
		$browser = Self::getOS($user_agent);
		return $os.' / '.$browser;
	}


	// public static function sendNotif($idx){

	// 	$job = (new \App\Jobs\SendNotif($idx))->delay( now()->addSeconds(3) );

    //     dispatch($job);

	// }



}
