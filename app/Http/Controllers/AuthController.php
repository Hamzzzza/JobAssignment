<?php

namespace App\Http\Controllers;

use App\User;
// use Exception;
// use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
//use Laravel\Socialite\Facades\Socialite;


// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

// use Illuminate\Foundation\Auth\ResetsPasswords;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signup','handleGoogleCallback','redirectToGoogle','forgot','doReset','googleLoginRegister']]);
    }

       
    public function googleLoginRegister()
    {

            
            // $user = Socialite::driver('google')->stateless()->user();
     
           // $finduser = User::where('google_id', $user->id)->first();
           $finduser = User::where('email', request()->email)->first();
     
            if($finduser){
                
                $token = auth('api')->login($finduser);
              
                return $this->respondWithToken($token);
     
            }else{
                $newUser = User::create([
                    'name' => request()->name,
                    'email' => request()->email,
                    //'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
                
                 
                $token = auth('api')->login($newUser);

                return $this->respondWithToken($token);
            }

    }










    public function signup(Request $request)
    {

    
        $validatedUserData = request()->validate(
            ['name' => ['required', 'string', 'max:255'],
            'designation' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],]
        ); 


         if($validatedUserData){
        return User::create([
            'name' => $request->name ,
            'email' => $request->email,
            'designation' => $request->designation,
            'password' => Hash::make($request->password),
        ]);
        


         }
        else
        { 
            
            return response()->json([
            "error" => $validatedUserData
        ], 404);
    
    }

    }



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
       $credentials = request(['email', 'password']);
       
    //    $credentials = [
    //     'email' => request()->email,
    //     'password' => request()->password,
        
    //         ];

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function guard(){
        return \Auth::Guard('api');
    }





    public function redirectToGoogle()
    {
        //return  Socialite::driver('google')->redirect()->getTargetUrl();
      $url= Socialite::driver('google')->stateless()->redirect()->getTargetUrl();

          return response()->json(["url"=>$url]);
    }
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        
    
            $user = Socialite::driver('google')->stateless()->user();
     
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
                
            
                
                $token = auth('api')->login($finduser);
             

                return $this->respondWithToken($token);
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => encrypt('123456dummy')
                ]);
                
                 
                $token = auth('api')->login($newUser);

                return $this->respondWithToken($token);
            }
     
          }
    

    



    






}
