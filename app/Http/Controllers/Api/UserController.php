<?php
namespace App\Http\Controllers\Api;

use App\User; 
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 

class UserController extends Controller 
{

    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){ 
        
        if(Auth::attempt([
            
            'email' => $request['email'], 
            'password' => $request['password'],
            // 'device_token' => request('device_token'),
            // 'app_version' => request('app_version'),

        ]))
        { 
            
        $user = Auth::user(); 
        
        $token = $user->createToken('MyApp');
        $access_token = $token->token;


        // No sabemos si las vamos a usar
        $access_token->device_token = $request->device_token ?? 0;
        $access_token->app_version = $request->app ?? env('APP_VERSION','0.1');
        

        $access_token->expires_at = Carbon::now()->addHours(16);
        $accessToken =  $token->accessToken; 
        $access_token->save();

        

        return response()->json([
            'status' => true,
            'data' => $accessToken

        ], 
            200); 
            } 

        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            // 'id_empresa' => 'required', 
            // 'c_password' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
                
        // $input = $request->all(); 

        $user = new User();
        $user->name           = $request->name;
        $user->role_id        = 2;
        $user->email          = $request->email;
        // $user->id_empresa     = $request->id_empresa ?? 1;
        $user->password       = bcrypt($request->password);
        // $user->remember_token = $token,
        $user->save();


        Auth::login($user);
        $user  = Auth::user();


        $token        = $user->createToken('MyApp');
        $access_token = $token->token;


        // No sabemos si las vamos a usar
        $access_token->device_token = $request->device_token ?? 0;
        $access_token->app_version  = $request->app ?? env('APP_VERSION','0.1');
        

        $access_token->expires_at = Carbon::now()->addHours(16);
        $accessToken              = $token->accessToken; 
        $access_token->save();

        

        return response()->json([
            'status' => true,
            'token'  => $accessToken
        ], 
            200); 
    }
 
 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], 200); 
    } 
   
}