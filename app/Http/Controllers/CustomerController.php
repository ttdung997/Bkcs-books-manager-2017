<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use QrCode;

class CustomerController extends Controller {

    public function showCustomer($n) {
        $user = DB::table('customer')->where('id', $n)->first();
        return response()->json(array('user' => $user), 200);
    }

    public function updateCustomer($n) {
        $user = DB::table('customer')->where('id', $n)->first();
        return response()->json(array('user' => $user), 200);
      
    }

    public function updateC() {
        $customer = DB::table('customer')->where('id', $_POST['id'])->first();
        $que = DB::table('customer')
                ->where('id', $_POST['id'])
                ->update(['name' => $_POST['name'],
            'phone_number' => $_POST['phone_number'],
            'cmt' => $_POST['cmt'],
            'updated_at' => date("Y-m-d h:i:s"),
        ]);
        $que=1;
        if ($que) {
            $msg = "Đã cập nhật dữ liệu thành công ";
        } else {
            $msg = "Đã có lỗi trong quá trình cập nhật ";
        }
        return response()->json(array('msg' => $msg), 200);
    }

    public function deleteC($n) {
        $customer = DB::table('customer')->where('id', $n)->first();
        DB::table('customer')->where('id', $n)->update(['check' => 1]);
        $msg = "Đã xóa bản ghi thành công";
        return response()->json(array('msg' => $msg), 200);
    }

    public function insertC() {
        $query = DB::table('customer')->insert([
            ['name' => $_POST['name'],
                'phone_number' => $_POST['phone_number'],
                'cmt' => $_POST['cmt'],
                'BookNumber'=>0,
//                'created_at' => date("Y-m-d h:i:s"),
//                'updated_at' => date("Y-m-d h:i:s"),
            ]
        ]);
        
        $msg = "Đã thêm bản ghi thành công";
        $insert_line = '';
        
        return response()->json(array('msg' => $msg, 'insert_line' => $insert_line), 200);
    }

}
