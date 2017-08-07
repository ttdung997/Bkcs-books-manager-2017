<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use QrCode;

class BookController extends Controller {

    public function showBookTest($n) {
        $book = DB::table('book')->where('id', $n)->get();
        $book = DB::table('book')->where('id', $n)->get();

        if ($book[0]->type == 0)
            $typeBookName = "Đang cập nhật";
        else {
            $typeBook = DB::table('book_type')->where('id', $book[0]->type)->first();
            $typeBookName = $typeBook->name;
        }
        if ($book[0]->tag == 0)
            $tagname = "";
        else {
            $tag = DB::table('book_tag')->where('id', $book[0]->tag)->first();
            $tagname = $tag->name;
        }

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
      <p id="infoShow"> ' . $typeBookName . " / " . $tagname . '</p></div>
                <div class="form-group form-model">
      <label for="ảnh bìa sách">Ảnh bìa sách</label>
                <img class="bookImg" src="' . $img . '">              </div>
                     <div class="form-group form-model">
      <label for="QrCode">QrCode</label>
      <img id="QrCode" src="data:image/png;base64, ' . base64_encode(QrCode::format('png')->size(300)->encoding('UTF-8')->generate($book[0]->id)) . ' ">             
   <br><br><br> <a id="downloadQr" href="data:image/png;base64, ' . base64_encode(QrCode::format('png')->size(300)->encoding('UTF-8')->generate($book[0]->id)) . ' " download="' . $book[0]->name . '"  class="btn btn-primary codebutton">save QrCode</a>
                    </div>
                     <div class="form-group form-model">
                       <label for="mieu ta">Mô tả</label>
     <p id="infoShow"> ' . $book[0]->description . '</p></div>'
                . ' <div class="form-group form-model">
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

    public function showBook($n) {

        function multiexplode($delimiters, $string) {

            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch = explode($delimiters[0], $ready);
            return $launch;
        }

        $book = DB::table('book')->where('id', $n)->first();
        if ($book->type == 0)
            $typeBookName = "Đang cập nhật";
        else {
            $typeBook = DB::table('book_type')->where('id', $book->type)->first();
            $typeBookName = $typeBook->name;
        }
        $tagname = "";
        if (strlen($book->tag) < 2)
            $tagname = "Đang cập nhật";
        else {
            $tagname = "";
            $tag2 = multiexplode(array(","), $book->tag);
            for ($i = 0; $i < count($tag2) - 1; $i++) {
                $tag = DB::table('book_tag')->where('id', intval($tag2[$i]))->first();
                if ($tag)
                    $tagname = $tagname . $tag->name . ",";
                else
                    $tagname = "Đang cập nhật";
            }
        }

        $info = "";
        if ($book->img == NULL) {
            $img = "http://35.192.32.4/uploads/updateting.jpg";
        } else
            $img = $book->img;
        $QrCodeImg = 'data:image/png;base64, ' . base64_encode(QrCode::format('png')->size(300)->encoding('UTF-8')->generate($book->id));
        return response()->json(array('typeBookName' => $typeBookName,
                    'QrCodeImg' => $QrCodeImg,
                    'img' => $img,
                    'tagname' => $tagname,
                    'book' => $book), 200);
    }

    public function updateBook($n) {

        function multiexplode($delimiters, $string) {

            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch = explode($delimiters[0], $ready);
            return $launch;
        }

        $book = DB::table('book')->where('id', $n)->first();
        $tag2 = multiexplode(array(","), $book->tag);
        if ($book->type == 0) {
            $typeBookName = "Chọn loại sách";
            $typeBookid = 0;
        } else {
            $typeBook = DB::table('book_type')->where('id', $book->type)->first();
            $typeBookName = $typeBook->name;
            $typeBookid = $typeBook->id;
        }
        $tagname = "";
        $tag = DB::table('book_tag')->where('type_id', $typeBookid)->where('status', '0')->get();
        if (strlen($tag) > 3) {
            foreach ($tag as $tag) {
                if(in_array($tag->id, $tag2)) $tagname = $tagname . ' <option selected value="' . $tag->id . '" >' . $tag->name . '</option>';
                else $tagname = $tagname . ' <option value="' . $tag->id . '" >' . $tag->name . '</option>';
            }
        } else
            $tagname = ' <option value="0" >Đang cập nhật</option>';

        $info = "";
        if ($book->img == NULL) {
            $img = "http://35.192.32.4/uploads/updateting.jpg";
        } else
            $img = $book->img;
        list($year, $month, $day) = explode('-', $book->Publication_date);
        return response()->json(array('typeBookName' => $typeBookName,
                    'typeBookid' => $typeBookid,
                    'tagname' => $tagname,
                    'year' => $year,
                    'month' => $month,
                    'day' => $day,
                    'img' => $img,
                    'tagname' => $tagname,
                    'book' => $book), 200);
    }

    public function updateB() {


        $que = DB::table('book')
                ->where('id', $_POST['id'])
                ->update(['name' => $_POST['name'],
            'type' => $_POST['type'],
            'Publication_date' => $_POST['publication'],
            'updated_at' => date("Y- m-d h:i:s"),
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

    public function insertBook() {
        $type = DB::table('book_type')->get();

        $info = '<form method="POST" action="/BookuploadForm"
                    accept-charset="UTF-8" class="form" enctype="multipart/form-data">
<input name="_token" type="hidden" value="' . csrf_token() . '"">
                <input name = "_token" type = "hidden" value = "' . csrf_token() . '">
                <div class = "form-group form-model2">
                <label for = "Tên khách hàng">Tên Sách</label>
                <input required = "" class = "form-control" placeholder = "nhập tên..." name = "name" type = "text" >
                </div>
                <div class = "form-group form-model2">
                <label for = "chọn sách">Chọn Sách</label>
                <select onchange = "changeTag(this.options[selectedIndex].value);" required = "" class = "form-control" name = "type">
                <option value = "0">Chọn loại sách</option>';
        foreach ($type as $type) {
            $info = $info . '<option value = "' . $type->id . '">' . $type->name . '</option>';
        }
        $info = $info . '</select>
                </div>
                <div class = "form-group form-model2">
                <label for = "chọn thể loại">Chọn Tag</label>
                 <select required = "" class = "form-control" name = "tag" id = "tag">
                <option value = "0">Chọn tag</option>
                </select>
                </div>
                <div class = "form-group form-model2">
                <label for = "ảnh bìa sách">Ảnh bìa sách</label>
                <input type = "file" name = "file" id = "file">
                </div>
                <div class = "form-group form-model2">
                <label for = "ngày mượn">Ngày Xuất Bản</label>
                <input class = "form-control" name = "publication" type = "date" value = "' . date("Y-m-d") . '">
                </div>
                <div class = "form-group form-model2">
                <button class = "btn btn-primary cratebutton" type = "submit  data-dismiss="modal">thêm</button>
</div>';
        return response()->json(array('info' => $info), 200);
    }

    public function insertB() {
        $count = DB::table('book')->where('check', '<>', 1)->count();
        $count = $count + 1;


        $query = DB::table('book')->insert([
            [
                'name' => $_POST['name'],
                'type' => $_POST[
                'type'],
                'Publication_date' => $_POST['publication'],
                'check' => 0,
                'created_at' => date("Y -m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),]
        ]);
        $id = DB::table('book')->max('id');
        $msg = "Đã thêm đầu sách thành công";
        if ((intval($count % 5) + 1) < 6) {
            $insert_line = ' <td>' . (intval($count / 5) + 1) . '</td>
                <td>' . $_POST['name'] . '</td>
                <td>' . $_POST

                    ['type'] . '</td>
                <td>Đang cập nhật</td>
                <td onmouseenter="an()">
                    <a onclick="getInfo(' . $id . '

)" aria-label="View  " data-pjax="0" data-toggle="modal" data-target="#myModal">
                <span style = "color: #337ab7" class = "glyphicon glyphicon-eye-open">
                </span>
                </a> <a onclick = "updateInfo(' . $id . ')" title = "Update" aria-label = "Update" data-pjax = "0" data-toggle = "modal" data-target = "#myModal">
                <span style = "color: #337ab7" class = "glyphicon glyphicon-pencil">
                </span>
                </a> <a onclick = "deleteB(' . $id . ')" data-method = "post" data-pjax = "0">
                <span style = "color: #337ab7" class = "glyphicon glyphicon-trash">
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
        $deal = DB::table('book_deal')->where('book_id', $n)->orderBy('book_id', 'desc')->first();
        if ($deal->status !== 0) {
            $query = DB::table('book')->where('id', $deal->book_id)->update(['check' => 0]);
            $query = DB::table('customer')->where('id', $deal->customer_id)->first();
            $BN = $query->BookNumber - 1;
            $query = DB::table('customer')->where('id', $deal->customer_id)->update(['BookNumber' => $BN]);
            DB::table('book_deal')->where('book_id', $n)->update(['status' => 0]);
            DB::table('book_deal')->where('book_id', $n)->update(['given_date' => date("Y-m-d")]);
            $msg = "Đã trả sách thành công";
        } else
            $msg = "giao dịch đã hoàn thành từ trước";
        $msg = "<br>";
        $msg = "Thông tin giao dịch: <br>";
        $customer = DB::table('customer')->where('id', $deal->customer_id)->first();
        $book = DB::table('book')->where('id', $deal->book_id)->first();
        $msg = '<table class = "table table-striped table-bordered">'
                . '<tbody>'
                . '<tr data-key = "$i " id = "ele' . $deal->id . '">
                <td>' . $customer->name . '<button onclick = "getInfoC(' . $customer->id . ')" class = "btn btn-primary" data-toggle = "modal" data-target = "#myModal">Chi tiết</button></td>
                <td>' . $book->name . '<button onclick = "getInfoB(' . $book->id . ')" class = "btn btn-primary" data-toggle = "modal" data-target = "#myModal">Chi tiết</button></td>
                <td>' . $deal->lend_date . '</td>
                <td>' . $deal->give_date . '</td>
                <td>Hoàn thành</td>
                </tr></tbody></table>';

        return response()->json(array('msg' => $msg), 200);
    }

    public function getBookForm($n) {
        $book = DB::table('book')->where('id', $n)->first();
        if ($book->check == 0) {

            $msg = "";


            $msg = '<form id = "khachform" accept-charset = "UTF-8" class = "form" >
                <input name = "_token" type = "hidden" value = "' . csrf_token() . '"">
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
        return response()->json(array('msg' => $msg
                        ), 200);
    }

    public function updateBookTest($n) {
        $type = DB::table('book_type')->get();
        $book = DB::table('book')->where('id', $n)->get();

        if ($book[0]->type == 0) {
            $typeBookName = "tin học";
            $typeBookid = 2;
        } else {
            $typeBook = DB::table('book_type')->where('id', $book[0]->type)->first();
            $typeBookName = $typeBook->name;
            $typeBookid = $typeBook->id;
        }
        list($year, $month, $day) = explode('-', $book[0]->Publication_date);
        if ($book[0]->img == NULL) {
            $img = "http://35.192.32.4/uploads/updateting.jpg";
        } else
            $img = $book[0]->img;

        $info = '<form id = "bookform" accept-charset = "UTF-8" class = "form" >
                <input name = "_token" type = "hidden" value = "' . csrf_token() . '"">
<input name="_token" type="hidden" value="' . csrf_token() . '">
<div class="form-group form-model2">
    <label for="Tên khách hàng">Tên Sách</label>
    <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text" value="' . $book[0]->name . '">
</div>

<div class="form-group form-model2">
<input name="id" type="hidden" value="' . $n . '">
    <label for="chọn thể loại">Chọn thể loại</label>
    <select onmouseenter="changeTag(this.options[selectedIndex].value);
                " required="" class="form-control" name="type">
    <option value="' . $typeBookid . '">' . $typeBookName . '</option>';
        foreach ($type as $type) {
            if ($type->id == $book[0]->type)
                continue;
            $info = $info . '<option value="' . $type->id . '">' . $type->name . '</option>';
        }
        $info = $info . '</select>
</div>
<div class="form-group form-model2">
 <label for="chọn thể loại">Chọn Tag</label>
 <select required="" class="form-control" name="tag" id="tag">
            <option value="0">Chọn tag</option>
</select>

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
    <input class="form-control" name="publication" type="date" value="' . $year . ' - ' . $month . ' - ' . $day . '">
</div>
<div class="form-group form-model2">
    <button class="btn btn-primary cratebutton" onclick="updateB2()" data-dismiss="modal">chỉnh sửa</button>
</div>';
        return response()->json(array('info' => $info), 200);
    }

    function changeTag($n) {
        $info = "";
        $tag = DB::table('book_tag')->where('type_id', $n)->where('status', '0')->get();
        if (strlen($tag) > 3) {
            foreach ($tag as $tag) {
                $info = $info . ' <option value="' . $tag->id . '" >' . $tag->name . '</option>';
            }
        } else
            $info = ' <option value="0" >Đang cập nhật</option>';
        return response()->json(array('info' => $info), 200);
    }

}
