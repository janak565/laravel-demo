<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\UpdateProfileFormValidationRequest;
use Helper; 

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $this->middleware('guest');
         return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    /**
     * Create a edit profile user.
     *
     */
    public function editProfile()
    {
        $user = auth()->user();  

        $user = User::UserId($user->id)->with('images')->first();

        //check role and diplay edit profile page 
        if(Helper::CheckUserRole('superadmin')){
            return view('superadmin.editprofile',compact('user'));
        }else if(Helper::CheckUserRole('admin',)){
            return view('admin.editprofile',compact('user'));
        }else if(Helper::CheckUserRole('user')){
            return view('user.editprofile',compact('user'));
        }
    }

    /**
     * Create a update profile user.
     *
     */
    public function updateprofile(UpdateProfileFormValidationRequest $request){
        
        //get all request
        $requestObj = $request->all();

        //check validation 
        $request->Validated(); 

        //check user
        if(auth()->check()){

            $user = auth()->user();
            $id = $requestObj['id'];
            
            //check parameter and update data in user object 
            if($request->has('user_name')) $user->name = $requestObj['user_name'];
            if($request->has('password')) $user->password = $requestObj['password'];
            if($request->has('gender')) $user->gender = $requestObj['gender'];
            if($request->has('company_name')) $user->company_name = $requestObj['company_name'];
            if($request->has('mobile_no')) $user->mobile_no = $requestObj['mobile_no'];

            if(!empty( $image_name =  Helper::uploadUserImage(request()))){
                
                $userImageObj = UserImages::userId($id)->first();
                $image = new UserImages(['file' => $image_name, 'is_index' => true]);
              
                if($userImageObj){
                    
                    //delete old image when upload new userimage
                    Helper::deleteUserImage($userImageObj->file);

                    $userImageObj->file = $image_name;
                    
                    $image =  $userImageObj;
                }
                //save userimage
                $user->images()->save($image);
            }
            $userRole = Helper::userRole();
            
            //save user 
            $user->save();

            return redirect()->route($userRole.'.editprofile')->with('success','Profile updated successfull');
        }else{
            
            return redirect()->route('login')
            ->with('error','we can not update please do login');
        }
    }
}
