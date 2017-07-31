<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use DB;
use Auth;

class loginController extends BaseController {

    public function login(Request $req) {
        $username = $req->input('name');
        $password = $req->input('pass');
        echo $username . "----" . $password;
        $checkLogin = DB::table('user')->where(['username' => $username, 'id' => $password])->get();
        if (count($checkLogin) > 0) {
            echo "Login SuccessFull<br/>";
            ;
        } else {
            echo "Login Faield Wrong Data Passed";
        }
    }

    public function changePass() {
          $users=DB::table('users')->where('id',Auth::user()->id )->first();
          $newpass=Hash::make($_POST['newpass']);
        if (Hash::check($_POST['pass'], $users->password)) {
              $que=DB::table('users')->where('name',Auth::user()->name )->update(['password' => $newpass]);
              if($que)$msg="Đã đổi password thành công";
              else $msg="Đã có lỗi xảy ra";
          }else $msg="Bạn đã nhập sai mật khẩu<br>";
           return response()->json(array('msg' => $msg), 200);
    }

}

?>