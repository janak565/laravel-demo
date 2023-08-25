<?php 
namespace App\Helpers;
use Illuminate\Support\Facades\File;
class Helper{
    public static function CheckUserRole($role_name)
    {
        if (auth()->user()->role == $role_name) {
        return true;
        }else if (auth()->user()->role == $role_name) {
        return true;
        }else if (auth()->user()->role == $role_name){
        return true;   
        }
        return false;
    }

    public static function userRole()
    {
        return auth()->user()->role;
    }

    public static function uploadUserImage($userImageObj){
        if($userImageObj->hasfile('image')){
            $image = 'user_image_'.time().'.'.$userImageObj->image->getClientOriginalExtension();
            $userImageObj->image->move(public_path('uploads'), $image);
            return $image;
        }else{
            return '';
        }
    }
    
    public static function deleteUserImage($image_name){
       $image_path         =    ('user_profile').'/'.$image_name;
        if(File::exists($image_path)) {
            File::delete($image_path);
            return true;
        }else{
            return false;
        }

    }
}