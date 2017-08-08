<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use QrCode;

class DealController extends Controller {

    function index($n) {
        $data['page'] = $n;
        $data['name'] = "DealView/";
        $data['link'] = "DealView/";
        $data['id'] = 0;
        $data['count'] = DB::table('book_deal')->where('status', '<>', 1)->count();
        if ($n > 0 && $n <= ($data['count']) / 5 + 1) {
            $book_deal = DB::table('book_deal')->where('status', '<>', 1)->orderBy('lend_date', 'desc')->offset(( $n - 1) * 5)->take(5)->get();
            return view('DealView', ['deal' => $book_deal], $data);
        } else {
            return view('PageError');
        }
    }

    function sortby(Request $request) {
        $n = $request->page;
        $type = $request->type;
        $sort = $request->sort;
        $data['page'] = $n;
        $data['name'] = "sortby?type=lend_date&sort=ASC&page=";
        $data['link'] = "sortby?type=lend_date&sort=ASC&page=";
        $data['id'] = 0;
        $data['count'] = DB::table('book_deal')->where('status', '<>', 1)->count();
        if ($n > 0 && $n <= ($data['count']) / 5 + 1) {
            $book_deal = DB::table('book_deal')->where('status', '<>', 1)->orderBy($type, $sort)->offset(( $n - 1) * 5)->take(5)->get();
            return view('DealView', ['deal' => $book_deal], $data);
        } else {
            return view('PageError');
        }
    }

    function HistoryCustomer($id, $n) {
        $data['page'] = $n;
        $data['name'] = "HistoryCustomer";
        $data['id'] = $id;
        $data['link'] = $data['name'] . "/" . $data['id'] . "/";
        $data['count'] = DB::table('book_deal')->where('customer_id', $id)->where('status', '<>', 1)->count();
        if ($n > 0 && $n <= ($data['count']) / 5 + 1) {
            $book_deal = DB::table('book_deal')->where('customer_id', $id)->where('status', '<>', 1)->offset(( $n - 1) * 5)->take(5)->get();
            return view('DealView', ['deal' => $book_deal], $data);
        } else {
            return view('PageError');
        }
    }

    function HistoryBook($id, $n) {
        $data['name'] = " HistoryBook";
        $data['id'] = $id;
        $date['link'] = $data['name'] . "/" . $data['id'];
        $data['page'] = $n;
        $data['count'] = DB::table('book_deal')->where('book_id', $id)->where('status', '<>', 1)->count();
        if ($n > 0 && $n <= ($data['count']) / 5 + 1) {
            $book_deal = DB::table('book_deal')->where('book_id', $id)->where('status', '<>', 1)->offset(( $n - 1) * 5)->take(5)->get();
            return view('DealView', ['deal' => $book_deal], $data);
        } else {
            return view('PageError');
        }
    }

    public function insertDeal() {
        $book = DB::table('book')->where('check', '0')->get();
        $customer = DB::table('customer')->where('BookNumber', '<', '3')->get();
        $info = "";
        $info = '<form id="Dealform" accept-charset="  UTF-8" class="form" >
<input name="_token" type="hidden" value="' . csrf_token() . '"">
                <input name = "_token" type = "hidden" value = "' . csrf_token() . '" >
                <div class = "form-group form-model2">
                <label for = "chọn sách">Chọn khách hàng</label>
                <select required = "" class = "form-control" name = "customer_id">';

        foreach ($customer as $customer) {
            $info = $info . '<option value = "' . $customer->id . '">' . $customer->name . ' </option>';
        }
        $info = $info . '</select>
                </div>
                <div class = "form-group form-model2">
                <label for = "chọn sách">Chọn Sách</label>
                <select required = "" class = "form-control" name = "book_id">';

        foreach ($book as $book) {
            $info = $info . '<option value = "' . $book->id . '">' . $book->name . ' </option>';
        }
        $info = $info . '</select>
                </div>
                <div class = "form-group form-model2">
                <label for = "ngày mượn">Ngày Mượn</label>
                <input class = "form-control" name = "Lend_date" type = "date" value = "' . date("Y-m-d") . '" >

                </div>
                <div class = "form-group form-model2">
                <label for = "ngày trả">Ngày Trả</label>
                <input class = "form-control" name = "Pay_date" type = "date" value = "' . date("Y-m-d") . '" >
                </div>
                <div class = "form-group form-model2">
                <button class = "btn btn-primary cratebutton" onclick = "insertD()" data-dismiss = "modal">Thêm bản ghi</button>
                </div>
                </form>';
        return response()->json(array('info' => $info), 200);
    }

    public function updateDeal($n) {
        $deal = DB::table('book_deal')->where('id', $n)->first();
        list($yearl, $monthl, $dayl) = explode('-', $deal->lend_date);
        list($yearg, $monthg, $dayg) = explode('-', $deal->give_date);
        $id = $deal->id;
        return response()->json(array(
                    'yearl' => $yearl,
                    'monthl' => $monthl,
                    'dayl' => $dayl,
                    'yearg' => $yearg,
                    'monthg' => $monthg,
                    'dayg' => $dayg,
                    'id' => $id,
                        ), 200);
    }

    public function updateD() {
            $que = DB::table('book_deal')
                    ->where('id', $_POST['id'])
                    ->update([
                'give_date' => $_POST['give_date'],
            ]);
            if ($que) {
                $msg = "Đã  cập nhật dữ liệu thành công ";
                $checkerror = 0;
            } else {
                $msg = "Đã có lỗi trong quá trình cập nhật ";
                $checkerror = 1;
            }
        
        return response()->json(array('msg' => $msg, 'checkerror' => $checkerror), 200);
    }

    public function insertD() {
        if ($_POST['Lend_date'] > $_POST['Pay_date']) {
            $msg = "Ngày trả phải bé hơn ngày nhận";
            $insertCheck = 0;
        } else {
            $queryInsert = DB::table('book_deal')->insert([
                [
                    'customer_id' => $_POST['customer_id'],
                    'book_id' => $_POST[
                    'book_id'],
                    'lend_date' => $_POST['Lend_date'],
                    'give_date' => $_POST['Pay_date'],
                    'status' => 2,
                ]
            ]);
            $query = DB::table('book')->where('id', $_POST['book_id'])->update(['check' => 2]);
            $query = DB::table('customer')->where('id', $_POST['customer_id'])->first();
            $BN = $query->BookNumber + 1;
            $query = DB::table('customer')->where('id', $_POST['customer_id'])->update(['BookNumber' => $BN]);
            if ($queryInsert) {
                $msg = "Đã thêm giao dịch thành công";
                $insertCheck = 1;
            } else {
                $msg = "Đã có lỗi khi thêm giao dịch";
                $insertCheck = 0;
            }
        }

        return response()->json(array('msg' => $msg, 'insertCheck' => $insertCheck), 200);
    }

    public function deleteD($n) {
        $deal = DB::table('book_deal')->where('id', $n)->first();
        $query = DB::table('book')->where('id', $deal->book_id)->update(['check' => 0]);
        $query = DB::table('customer')->where('id', $deal->customer_id)->first();
        $BN = $query->BookNumber - 1;
        $query = DB::table('customer')->where('id', $deal->customer_id)->update(['BookNumber' => $BN]);
        DB::table('book_deal')->where('id', $n)->update(['status' => 1]);
        $msg = "Đã xóa bản ghi thành công";
        return response()->json(array('msg' => $msg), 200);
    }

    public function DealEnd($n) {
        $deal = DB::table('book_deal')->where('id', $n)->first();
        if ($deal->status !== 0) {
            $query = DB::table('book')->where('id', $deal->book_id)->update(['check' => 0]);
            $query = DB::table('customer')->where('id', $deal->customer_id)->first();
            $BN = $query->BookNumber - 1;
            $query = DB::table('customer')->where('id', $deal->customer_id)->update(['BookNumber' => $BN]);
            DB::table('book_deal')->where('id', $n)->update(['status' => 0]);
            DB::table('book_deal')->where('id', $n)->update(['given_date' => date("Y-m-d")]);
            $msg = "Đã trả sách thành công";
        } else
            $msg = "giao dịch đã hoàn thành từ trước";
        return response()->json(array('msg' => $msg), 200);
    }

    public function showDeal($n) {
        $deal = DB::table('book_deal')->where('id', $n)->first();
        $book = DB::table('book')->where('id', $deal->book_id)->first();
        $customer = DB::table('customer')->where('id', $deal->customer_id)->first();
        if ($deal->status !== 0) {
            $status = "Chưa trả";
        } else {
            if ($deal->given_date > $deal->give_date)
                $status = "Quá hạn trả";
            else
                $status = "Đã trả";
        }
        if ($deal->given_date == '0000-00-00')
            $given_date = "Đang cập nhật";
        else
            $given_date = $deal->given_date;
        $bookName = $book->name;
        $bookId = $book->id;
        $customerName = $customer->name;
        $CustomerId = $customer->id;
        return response()->json(array(
                    'bookName' => $bookName,
                    'bookId' => $bookId,
                    'customerName' => $customerName,
                    'CustomerId' => $CustomerId,
                    'given_date' => $given_date,
                    'status' => $status,
                    'deal' => $deal,
                        ), 200);
    }

}
