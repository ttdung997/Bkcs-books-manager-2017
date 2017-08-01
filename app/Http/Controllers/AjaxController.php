<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use QrCode;

class AjaxController extends Controller {

    function stripVietName($str) {
        if (!$str) {
            return false;
        }
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni)
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        return $str;
    }

    public function index() {
        if (Request::ajax()) {
            $msg = 'ajax';
        } else {
            $smg = "http";
        }

        return response()->json(array('msg' => $msg), 200);
    }

    public function showCustomer($n) {
        $user = DB::table('customer')->where('id', $n)->get();
        $info = "";
        $info = '<div class="form-group form-model">
    <label for="Tên khách hàng">Tên Khách Hàng</label>
    <p id="infoShow">' . $user[0]->name . '</span></div>
                <div class="form-group form-model">
    <label for="số điện thoại">Số điện Thoại</label>
      <p id="infoShow">' . $user[0]->phone_number . '</p></div>
                <div class="form-group form-model">
    <label for="chọn sách">Chọn Sách</label>
      <p id="infoShow">' . $user[0]->book_name . '</p></div>
                <div class="form-group form-model">
    <label for="ngày mượn">Ngày Mượn</label>
      <p id="infoShow">' . $user[0]->Lend_date . '</p></div>
                <div class="form-group form-model">
    <label for="ngày trả">Ngày Trả</label>
      <p id="infoShow">' . $user[0]->Pay_date . '</p></div>
         <div class="form-group form-model">
    <label for="ngày mượn">Ngày Tạo</label>
      <p id="infoShow">' . $user[0]->created_at . '</p></div>
                <div class="form-group form-model">
    <label for="ngày trả">Ngày Cập Nhật</label>
     <p id="infoShow"> ' . $user[0]->updated_at . '</p></div>'
                . ' <button class="btn btn-primary cratebutton" onclick="BookGive(' . $n . ')" data-dismiss="modal">Trả sách</button>';
        return response()->json(array('info' => $info), 200);
    }

    public function updateCustomer($n) {
        $book = DB::table('book')->where('check', '0')->get();
        $info = "";
        $user = DB::table('customer')->where('id', $n)->get();
        list($yearl, $monthl, $dayl) = explode('-', $user[0]->Lend_date);
        list($yearg, $monthg, $dayg) = explode('-', $user[0]->Pay_date);


        $info = '<form id="khachform" accept-charset="UTF-8" class="form" >
<input name="_token" type="hidden" value="' . csrf_token() . '"">
<input name="_token" type="hidden" value="' . csrf_token() . '">
<div class="form-group form-model2">
    <label for="Tên khách hàng">Tên Khách Hàng</label>
    <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text" value="' . $user[0]->name . '">
</div>

<div class="form-group form-model2">
<input name="id" type="hidden" value="' . $n . '">
    <label for="số điện thoại">Số điện Thoại</label>
    <input required="" class="form-control" placeholder="nhập số điện thoại" name="phone_number" type="text" value="' . $user[0]->phone_number . '">
</div>
<div class="form-group form-model2">
    <label for="chọn sách">Chọn Sách</label>
    <select required="" class="form-control" name="book_name">
    <option value="' . $user[0]->book_name . '" selected="selected">' . $user[0]->book_name . '</option>';
        foreach ($book as $book) {
            $info = $info . '<option value="' . $book->name . '">' . $book->name . '</option>';
        }
        $info = $info . '</select>
</div>
<div class="form-group form-model2">
    <label for="ngày mượn">Ngày Mượn</label>
    <input class="form-control" name="Lend_date" type="date" value="' . $yearl . '-' . $monthl . '-' . $dayl . '">
    
</div>
<div class="form-group form-model2">
    <label for="ngày trả">Ngày Trả</label>
    <input class="form-control" name="Pay_date" type="date" value="' . $yearg . '-' . $monthg . '-' . $dayg . '">
</div>
<div class="form-group form-model2">
    <button class="btn btn-primary cratebutton" onclick="updateC()" data-dismiss="modal">chỉnh sửa</button>
</div>
</form>';
        return response()->json(array('info' => $info), 200);
    }

    public function updateC() {
//        $msg = '';
//        $msg = $msg . $_POST['id'] . '<br>';
//        $msg = $msg . $_POST['name'] . '<br>';
//        $msg = $msg . $_POST['phone_number'] . '<br>';
//        $msg = $msg . $_POST['book_name'] . '<br>';
//        $msg = $msg . $_POST['Lend_date'] . '<br>';
//        $msg = $msg . $_POST['Pay_date'] . '<br>';
//        $msg = $msg . 'Tóm lại là lỗi cái vẹo gì?'. '<br>';
 //       return response()->json(array('msg' => $msg), 200);

        $customer = DB::table('customer')->where('id', $_POST['id'])->first();
        $query = DB::table('book')->where('name', $customer->book_name)->update(['check' => 0]);

//        $que = DB::table('customer')
//                ->where('id', $_POST['id'])
//                ->update(['name' => $_POST['name'],
//            'phone_number' => $_POST['phone_number'],
//            'book_name' => $_POST['book_name'],
//            'check' => 2,
//            'Lend_date' => $_POST['Lend_date'],
//            'Pay_date' => $_POST['Pay_date'],
//            'updated_at' => date("Y-m-d h:i:sa"),
//        ]);
        $query = DB::table('book')->where('name', $_POST['book_name'])->update(['check' => 2]);
        if ($query) {
            $msg = "Đã cập nhật dữ liệu thành công ";
        } else {
            $msg = "Đã có lỗi trong quá trính cập nhật ";
        }
        return response()->json(array('msg' => $msg), 200);
    }

    public function deleteC($n) {
        $customer = DB::table('customer')->where('id', $n)->first();
        $query = DB::table('book')->where('name', $customer->book_name)->update(['check' => 0]);
        DB::table('customer')->where('id', $n)->update(['check' => 1]);
        $msg = "Đã xóa bản ghi thành công";
        return response()->json(array('msg' => $msg), 200);
    }

    public function showBook($n) {
        $book = DB::table('book')->where('id', $n)->get();
        $info = "";
        if ($book[0]->img == NULL) {
            $img = "http://35.192.32.4/uploads/updateting.jpg";
        } else
            $img = $book[0]->img;
        $info = '<div class="form-group form-model">
    <label for="Tên khách hàng">Tên sách</label>
     <p id="infoShow">' . $book[0]->name . '</p></div>
                <div class="form-group form-model">
    <label for="số điện thoại">loại sách</label>
      <p id="infoShow">' . $book[0]->type . '</p></div>
                <div class="form-group form-model">
      <label for="ảnh bìa sách">Ảnh bìa sách</label>
                <img class="bookImg" src="' . $img . '">
                   
                    </div>
                     <div class="form-group form-model">
      <label for="QrCode">QrCode</label>
      <img id="QrCode" src="data:image/png;base64, ' . base64_encode(QrCode::format('png')->size(300)->encoding('UTF-8')->generate($book[0]->id)) . ' ">             
   <br><br><br> <a id="downloadQr" href="data:image/png;base64, ' . base64_encode(QrCode::format('png')->size(300)->encoding('UTF-8')->generate($book[0]->id)) . ' " download="' . $book[0]->name . '"  class="btn btn-primary codebutton">save QrCode</a>
                    </div>
                     <div class="form-group form-model">
    <label for="chọn sách">Ngày xuất bản</label>
     <p id="infoShow"> ' . $book[0]->Publication_date . '</p></div>'
                . ' <div class="form-group form-model">
    <label for="chọn sách">Ngày tạo</label>
      <p id="infoShow">' . $book[0]->created_at . '</p></div>'
                . ' <div class="form-group form-model">
    <label for="chọn sách">Ngày cập nhật</label>
      <p id="infoShow">' . $book[0]->updated_at . '</p></div>';
        return response()->json(array('info' => $info), 200);
    }

    public function updateBook($n) {
        $type = DB::table('book_type')->get();
        $book = DB::table('book')->where('id', $n)->get();
        list($year, $month, $day) = explode('-', $book[0]->Publication_date);
        if ($book[0]->img == NULL) {
            $img = "http://35.192.32.4/uploads/updateting.jpg";
        } else
            $img = $book[0]->img;

        $info = '<form id="bookform"  accept-charset="UTF-8" class="form" >
<input name="_token" type="hidden" value="' . csrf_token() . '"">
<input name="_token" type="hidden" value="' . csrf_token() . '">
<div class="form-group form-model2">
    <label for="Tên khách hàng">Tên Sách</label>
    <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text" value="' . $book[0]->name . '">
</div>

<div class="form-group form-model2">
<input name="id" type="hidden" value="' . $n . '">
    <label for="chọn thể loại">Chọn thể loại</label>
    <select required="" class="form-control" name="type">
    <option value="' . $book[0]->type . '">' . $book[0]->type . '</option>';
        foreach ($type as $type) {
            $info = $info . '<option value="' . $type->name . '">' . $type->name . '</option>';
        }
        $info = $info . '</select>
</div>
  <div class="form-group form-model2">
      <label for="ảnh bìa sách">Ảnh bìa sách hiện tại</label>
      
                <img class="bookImg" src="' . $img . '">
    </div>
    <div class="form-group form-model2">
    <label for="số điện thoại">Cập nhật ảnh</label>
  <input type="file" name="file" id="file">
</div>
<div class="form-group form-model2">
    <label for="ngày mượn">Ngày Xuất Bản</label>
    <input class="form-control" name="publication" type="date" value="' . $year . '-' . $month . '-' . $day . '">
</div>
<div class="form-group form-model2">
    <button class="btn btn-primary cratebutton" onclick="updateB2()" data-dismiss="modal">chỉnh sửa</button>
</div>';
        return response()->json(array('info' => $info), 200);
    }

    public function updateB() {
        $que = DB::table('book')
                ->where('id', $_POST['id'])
                ->update(['name' => $_POST['name'],
            'type' => $_POST['type'],
            'Publication_date' => $_POST['publication'],
            'updated_at' => date("Y-m-d h:i:sa"),
        ]);
        if ($que) {
            $msg = "Đã cập nhật dữ liệu thành công ";
        } else {
            $msg = "Đã có lỗi trong quá trính cập nhật ";
        }
        return response()->json(array('msg' => $msg), 200);
    }

    public function deleteB($n) {
        DB::table('book')->where('id', $n)->update(['check' => 1]);
        $msg = "Đã xóa bản ghi thành công";
        return response()->json(array('msg' => $msg), 200);
    }

    public function insertCustomer() {
        $book = DB::table('book')->where('check', '0')->get();
        $info = "";


        $info = '<form id="khachform" accept-charset="UTF-8" class="form" >
<input name="_token" type="hidden" value="' . csrf_token() . '"">
<input name="_token" type="hidden" value="' . csrf_token() . '">
<div class="form-group form-model2">
    <label for="Tên khách hàng">Tên Khách Hàng</label>
    <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text" >
</div>

<div class="form-group form-model2">
    <label for="số điện thoại">Số điện Thoại</label>
    <input required="" class="form-control" placeholder="nhập số điện thoại" name="phone_number" type="text" >
</div>
<div class="form-group form-model2">
    <label for="chọn sách">Chọn Sách</label>
    <select required="" class="form-control" name="book_name">';

        foreach ($book as $book) {
            $info = $info . '<option value="' . $book->name . '">' . $book->name . '</option>';
        }
        $info = $info . '</select>
</div>
<div class="form-group form-model2">
    <label for="ngày mượn">Ngày Mượn</label>
    <input class="form-control" name="Lend_date" type="date" value="' . date("Y-m-d") . '" >
    
</div>
<div class="form-group form-model2">
    <label for="ngày trả">Ngày Trả</label>
    <input class="form-control" name="Pay_date" type="date" value="' . date("Y-m-d") . '" >
</div>
<div class="form-group form-model2">
    <button class="btn btn-primary cratebutton" onclick="insertC()" data-dismiss="modal">Thêm bản ghi</button>
</div>
</form>';
        return response()->json(array('info' => $info), 200);
    }

    public function insertC() {
        $count = DB::table('customer')->where('check', '0')->count();
        $count = $count + 1;
        $id = DB::table('book')->max('id');
        $query = DB::table('customer')->insert([
            ['name' => $_POST['name'],
                'phone_number' => $_POST['phone_number'],
                'book_name' => $_POST['book_name'],
                'check' => 2,
                'Lend_date' => $_POST['Lend_date'],
                'Pay_date' => $_POST['Pay_date'],
                'created_at' => date("Y-m-d h:i:sa"),
                'updated_at' => date("Y-m-d h:i:sa"),]
        ]);
        $query = DB::table('book')->where('name', $_POST['book_name'])->update(['check' => 2]);
        $msg = "Đã thêm bản ghi thành công";
        if ((intval($count % 5) + 1) < 6) {
            $insert_line = ' <td>' . (intval($count / 5) + 1) . '</td>
                <td>' . $_POST['name'] . '</td>
                <td>' . $_POST['book_name'] . '</td>
                <td>Đang cập nhật</td>
                <td onmouseenter="an()">
                    <a onclick="getInfo(' . $id . ')" aria-label="View" data-pjax="0" data-toggle="modal" data-target="#myModal">
                        <span style="color: #337ab7" class="glyphicon glyphicon-eye-open">
                        </span>
                    </a>  <a onclick="updateInfo(' . $id . ')" title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myModal">
                        <span style="color: #337ab7" class="glyphicon glyphicon-pencil">
                        </span>
                    </a> <a onclick="deleteC(' . $id . ')" data-method="post" data-pjax="0">
                        <span style="color: #337ab7" class="glyphicon glyphicon-trash">
                        </span>
                    </a>
                </td>';
        } else {
            $insert_line = '';
        }
        return response()->json(array('msg' => $msg, 'insert_line' => $insert_line, 'id' => $id), 200);
    }

    public function insertBook() {
        $type = DB::table('book_type')->get();

        $info = '<form method="POST" action="/BookuploadForm"
                    accept-charset="UTF-8" class="form" enctype="multipart/form-data">
<input name="_token" type="hidden" value="' . csrf_token() . '"">
<input name="_token" type="hidden" value="' . csrf_token() . '">
<div class="form-group form-model2">
    <label for="Tên khách hàng">Tên Sách</label>
    <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text" >
</div>
<div class="form-group form-model2">
    <label for="chọn sách">Chọn Sách</label>
    <select required="" class="form-control" name="type">';
        foreach ($type as $type) {
            $info = $info . '<option value="' . $type->name . '">' . $type->name . '</option>';
        }
        $info = $info . '</select>
</div>
<div class="form-group form-model2">
    <label for="ảnh bìa sách">Ảnh bìa sách</label>
  <input type="file" name="file" id="file">
</div>
<div class="form-group form-model2">
    <label for="ngày mượn">Ngày Xuất Bản</label>
    <input class="form-control" name="publication" type="date" value="' . date("Y-m-d") . '">
</div>
<div class="form-group form-model2">
    <button class="btn btn-primary cratebutton" type="submit  data-dismiss="modal">thêm</button>
</div>';
        return response()->json(array('info' => $info), 200);
    }

    public function insertB() {
        $count = DB::table('book')->where('check', '<>', 1)->count();
        $count = $count + 1;


        $query = DB::table('book')->insert([
            [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'Publication_date' => $_POST['publication'],
                'check' => 0,
                'created_at' => date("Y-m-d h:i:sa"),
                'updated_at' => date("Y-m-d h:i:sa"),]
        ]);
        $id = DB::table('book')->max('id');
        $msg = "Đã thêm đầu sách thành công";
        if ((intval($count % 5) + 1) < 6) {
            $insert_line = ' <td>' . (intval($count / 5) + 1) . '</td>
                <td>' . $_POST['name'] . '</td>
                <td>' . $_POST['type'] . '</td>
                <td>Đang cập nhật</td>
                <td onmouseenter="an()">
                    <a onclick="getInfo(' . $id . ')" aria-label="View" data-pjax="0" data-toggle="modal" data-target="#myModal">
                        <span style="color: #337ab7" class="glyphicon glyphicon-eye-open">
                        </span>
                    </a>  <a onclick="updateInfo(' . $id . ')" title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myModal">
                        <span style="color: #337ab7" class="glyphicon glyphicon-pencil">
                        </span>
                    </a> <a onclick="deleteB(' . $id . ')" data-method="post" data-pjax="0">
                        <span style="color: #337ab7" class="glyphicon glyphicon-trash">
                        </span>
                    </a>
                </td>';
        } else {
            $insert_line = '';
        }
        return response()->json(array('msg' => $msg, 'insert_line' => $insert_line, 'id' => $id), 200);
    }

    public function BookGive($n) {

        $customer = DB::table('customer')->where('id', $n)->first();
        if ($customer->check == 2) {
            $query = DB::table('book')->where('name', $customer->book_name)->update(['check' => 0]);
            DB::table('customer')->where('id', $n)->update(['check' => 0]);
            $msg = "Đã trả sách thành công";
        } else
            $msg = "Không thành công,sách đã được trả từ trước";
        return response()->json(array('msg' => $msg), 200);
    }

    public function BookGive2($n) {


        $book = DB::table('book')->where('id', $n)->first();
        if ($book->check == 0) {
            $msg = "Không thành công,sách đã được trả từ trước";
        } else {
            $query = DB::table('book')->where('id', $n)->update(['check' => 0]);
            DB::table('customer')->where('book_name', $book->name)->update(['check' => 0]);
            $msg = "Đã trả sách thành công";
        }
        return response()->json(array('msg' => $msg), 200);
    }

    public function getBookForm($n) {
        $book = DB::table('book')->where('id', $n)->first();
        if ($book->check == 0) {

            $msg = "";


            $msg = '<form id="khachform" accept-charset="UTF-8" class="form" >
<input name="_token" type="hidden" value="' . csrf_token() . '"">
<input name="_token" type="hidden" value="' . csrf_token() . '">
<div class="form-group form-model2">
    <label for="Tên khách hàng">Tên Khách Hàng</label>
    <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text" >
</div>

<div class="form-group form-model2">
    <label for="số điện thoại">Số điện Thoại</label>
    <input required="" class="form-control" placeholder="nhập số điện thoại" name="phone_number" type="text" >
</div>
<div class="form-group form-model2">
    <label for="chọn sách">Chọn Sách</label>
    <select required="" class="form-control" name="book_name">
    <option value="' . $book->name . '">' . $book->name . '</option>
        </select>
</div>
<div class="form-group form-model2">
    <label for="ngày mượn">Ngày Mượn</label>
    <input class="form-control" name="Lend_date" type="date" value="' . date("Y-m-d") . '" >
    
</div>
<div class="form-group form-model2">
    <label for="ngày trả">Ngày Trả</label>
    <input class="form-control" name="Pay_date" type="date" value="' . date("Y-m-d") . '" >
</div>
<div class="form-group form-model2">
    <button class="btn btn-primary cratebutton" onclick="insertC()" data-dismiss="modal">Thêm bản ghi</button>
</div>
</form>';
        } else {
            $msg = "Đã có người mượn sách";
        }
        return response()->json(array('msg' => $msg), 200);
    }

}
