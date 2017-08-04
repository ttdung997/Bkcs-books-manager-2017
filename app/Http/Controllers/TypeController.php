<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use QrCode;

class TypeController extends Controller {

    function index() {
        return view('TypeTagManager');
    }

    function changeTag($n) {
        $info = "";
        $tag = DB::table('book_tag')->where('type_id', $n)->where('status', '0')->get();
        if (strlen($tag) > 3) {
            foreach ($tag as $tag) {
                $info = $info . '<li class = "list-group-item" id = "tag' . $tag->id . '">' . $tag->name . ''
                        . '   <span style="float: right">

                                                </a>  <a onclick="updateTag('. $tag->id .', &#39;'. $tag->name .'&#39;)" title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myUpdateModal">
                                                <span style="color: #337ab7" class="glyphicon glyphicon-pencil">
                                                </span>
                                            </a> <a onclick="updateTag('. $tag->id .')" data-method="post" data-pjax="0">
                                                <span style="color: #337ab7" class="glyphicon glyphicon-trash">
                                                </span>
                                            </a>
                                        </span>'
                        . '</li>';
            }
        } else
            $info = '<li class = "list-group-item">Đang cập nhật</li>';
        return response()->json(array('info' => $info), 200);
    }

    function deleteType($n) {
        $que = DB::table('book')->where('type', $n)->update(['type' => 0]);
        $que = DB::table('book_type')->where('id', $n)->update(['status' => 1]);
        
        if ($que)
            $msg = "Đã xóa bản ghi thành công";
        else
            $msg = "Đã xảy ra lỗi khi xóa bản ghi";
        return response()->json(array('msg' => $msg), 200);
    }
    function updateType() {
        $que = DB::table('book_type')->where('id', $_POST['updateId'])->update(['name' => $_POST['updateName']]);
        
        return redirect("/TypeTagManager");
    }

    function insertType() {
        $que = DB::table('book_type')->insert([
            [
                'name' => $_POST['name'],
                'status' => 0
            ]
        ]);
        return redirect("/TypeTagManager");
    }
    function deleteTag($n) {
        $que = DB::table('book')->where('tag', $n)->update(['tag' => 0]);
        $que = DB::table('book_tag')->where('id', $n)->update(['status' => 1]);
        
        if ($que)
            $msg = "Đã xóa bản ghi thành công";
        else
            $msg = "Đã xảy ra lỗi khi xóa bản ghi";
        return response()->json(array('msg' => $msg), 200);
    }
    function updateTag() {
        $que = DB::table('book_tag')->where('id', $_POST['updateTagId'])->update(['name' => $_POST['updateTag']]);
        
        return redirect("/TypeTagManager");
    }

    function insertTag() {
        $que = DB::table('book_tag')->insert([
            [
                'name' => $_POST['tag'],
                'type_id' => $_POST['typeId'],
                'status' => 0
            ]
        ]);
        return redirect("/TypeTagManager");
    }

}
