<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Connection;
use Illuminate\Support\Facades\Response;

class CheckSign
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->secure() && App::environment() === 'production') {
            return redirect()->secure($request->getRequestUri());
        }

        if($request->ajax()){
            try {
                DB::connection()->getPdo();
            } catch (\Exception $e) {
                return response()->json(['status' => false, 'message' => 'Failed to connect Database', 'data' => null]);
            }    
        } 


        if (Auth::check()) {
            header('Access-Control-Allow-Origin: *');
            

            $headers = [
                'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Headers'=> 'Content-Type, X-Auth-Token, Origin'
            ];
            if($request->getMethod() == "OPTIONS") {
                return Response::make('OK', 200, $headers);
            }
            

            $response = $next($request);
            foreach($headers as $key => $value)
                $response->header($key, $value);
            return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }

        return redirect('/signin');
    
    }
}
