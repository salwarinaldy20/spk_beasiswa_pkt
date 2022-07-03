<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use App\Models\User\Users; 

use Carbon\Carbon;

use Session;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
use Validator; 
use Omjin;

class HomeController extends Controller
{
    public function landing(){
        return view('home.index');
    }
    
    public function signin(){

        if (Auth::check()) {
    		return redirect('/app');
    	}else{
	    	return view('home.signin');
    	}
    }

	public function signup(){
		return view('home.signup');
	}


}
