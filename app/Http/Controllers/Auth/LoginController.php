<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginFromValidationRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    /**
     * Create a login controller.
     *
     * @return void
     */ 
    public function login(LoginFromValidationRequest $request)
    {   
        // get Parameter
        $input = $request->all();

        //check validation
        $request->Validated();   

        //check authenication email and password
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            //check role and redirect route
            if (auth()->user()->role == 'superadmin') {
                return redirect()->route('superadmin.home');
            }else if (auth()->user()->role == 'admin') {
                return redirect()->route('admin.home');
            }else{
                return redirect()->route('user.home');
            }
        }else{
            //redirect login with error message
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
}
