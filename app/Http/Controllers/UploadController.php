<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Image;
use App\Http\Requests;
use DB;
use QrCode;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class UploadController extends Controller {

    public function upload(Request $request) {

        $upload_folder = '/public/uploads/';
        if (Input::hasFile('file')) {
            echo 'Uploaded';
            $file = Input::file('file');
            $qrcode = new BaconQrCodeGenerator;
            $qrcode->size(500)->generate($file->getClientOriginalName());
            $file->move(base_path() . $upload_folder, $file->getClientOriginalName());
            echo '<img src="uploads/' . $file->getClientOriginalName() . '">';
            echo QrCode::format('png')->size(300)->generate('asdsadas');

            $image = $file;
            $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();
            echo $request->name;
            $destinationPath = public_path('/uploads');
            $img = Image::make(base_path() . $upload_folder . $file->getClientOriginalName());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
        }
    }

    public function BookuploadForm(Request $request) {
        echo "1234";
        $upload_folder = '/public/uploads/';
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $file->move(base_path() . $upload_folder, $file->getClientOriginalName());
            echo $file->getClientOriginalName();
            echo '<img src="http://35.192.32.4/uploads/'.$file->getClientOriginalName().'">';
//            $query = DB::table('book')->insert([
//                [
//                    'name' => $request->name,
//                    'type' => $request->type,
//                    'Publication_date' => $request->publication,
////                    'img' => 'http://lara.dev/uploads/' . $file->getClientOriginalName(),
//                    'img' => 'http://35.192.32.4/uploads/' . $file->getClientOriginalName(),
//                    'check' => 0,
//                    'created_at' => date("Y-m-d h:i:s"),
//                    'updated_at' => date("Y-m-d h:i:s"),]
//            ]);
        }
//        if($query) echo 'da in thanh cong';
        //return redirect('Bookview/1');
    }

    public function index() {
        return view('upload');
    }

    public function AjaxBookUpload(Request $request) {
        $upload_folder = '/public/uploads/';
        if ($request->file) {
            $file = $request->file;
            $file->move(base_path() . $upload_folder, $file->getClientOriginalName());
            $image = $file;
            $input['imagename'] = time() . '.' . $image->getClientOriginalName();
            $destinationPath = public_path('/uploads');
            $img = Image::make(base_path() . $upload_folder . $file->getClientOriginalName());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
            $que = DB::table('book')
                    ->where('id', $request->id)
//                    ->update(['img' => 'http://lara.dev/uploads/' . $file->getClientOriginalName()]);
                   ->update(['img' => 'http://35.192.32.4/uploads/' . $file->getClientOriginalName()]);
        }
        $que = DB::table('book')
                ->where('id', $request->id)
                ->update(
                ['name' => $request->name,
                    'type' => $request->type,
                    'Publication_date' => $request->publication,
                    'created_at' => date("Y-m-d h:i:s"),
                    'updated_at' => date("Y-m-d h:i:s"),]
        );
        if ($que) {
            $msg = "Đã cập nhật dữ liệu thành công ";
        } else {
            $msg = "Đã có lỗi trong quá trính cập nhật ";
        }
        return response()->json(array('msg' => $msg), 200);
    }

}
