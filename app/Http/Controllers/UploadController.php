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
        $upload_folder = '/public/uploads/';
        if ($request->file) {
            $file = $request->file;
            $file->move(base_path() . $upload_folder, $file->getClientOriginalName());
            echo $file->getClientOriginalName();
            echo '<img src="/uploads/' . $file->getClientOriginalName() . '">';
            $tag = $_POST['tag1'];
            // print_r($tag);
            $text = '';
            for ($i = 0; $i < count($tag); $i++) {
                $text = $text . $tag[$i] . ",";
            }
            $query = DB::table('book')->insert([
                [
                    'name' => $request->name,
                    'type' => $request->type,
                    'tag' => $text,
                    'description' => $request->des,
                    'Publication_date' => $request->publication,
//                    'img' => 'http://lara.dev/uploads/' . $file->getClientOriginalName(),
                    'img' => '/uploads/' . $file->getClientOriginalName(),
                    'check' => 0,
                    'created_at' => date("Y-m-d h:i:s"),
                    'updated_at' => date("Y-m-d h:i:s"),]
            ]);
        }
        return redirect('Bookview/1');
    }

    public function multiexplode($delimiters, $string) {

        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return $launch;
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
                    ->update(['img' => '/uploads/' . $file->getClientOriginalName()]);
        }
        $tag = $_POST['tag'];
        // print_r($tag);
        $text = '';
        for ($i = 0; $i < count($tag); $i++) {
            $text = $text . $tag[$i] . ",";
        }
        $que = DB::table('book')
                ->where('id', $request->id)
                ->update(
                ['name' => $request->name,
                    'type' => $request->type,
                    'tag' => $text,
                    'Publication_date' => $request->publication,
                    'description' => $request->des,]
        );
        if ($que) {
            $msg = "Đã cập nhật dữ liệu thành công ";
        } else {
            $msg = "Đã có lỗi trong quá trính cập nhật ";
        }
        return response()->json(array('msg' => $msg), 200);
    }

}
