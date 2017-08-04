<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Excel;
use Carbon\Carbon;

class ExcelController extends Controller {

    public function BookExport() {
        Excel::create('Dữ liệu sách', function($excel) {
            $excel->setTitle('Bảng sách');
            $excel->setCreator('admin')->setCompany('BKCS');
            $excel->setDescription('bảng thống kê các loại sách');

            $excel->sheet('Sheet 1', function($sheet) {
                $headings = array('id', 'Tên sách', 'Loại sách', 'ngày xuất bản');



                $book = DB::table('book')->select('id', 'name', 'type', 'Publication_date')->where('check', '0')->get();
                $i = 1;
                foreach ($book as $book) {
                    $data[] = array(
                        $i,
                        $book->name,
                        $book->type,
                        $book->Publication_date,
                    );
                    $i++;
                }
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->prependRow(1, $headings);
                $sheet->setPageMargin(array(
                    0.25, 0.30, 0.25, 0.30
                ));
                $sheet->setWidth(array(
                    'A' => 5,
                    'B' => 30,
                    'C' => 30,
                    'D' => 20
                ));
// Set alignment to center
            });
        })->download('xls');
    }

    public function seleteDate() {
        $info = "";
        $info = ' <label>Chọn dữ liệu theo tháng trong năm</label>
            <br>
                <form action="http://35.192.32.4/CustomerExport" method="post" accept-charset = "UTF-8" class = "form" >
                <input name = "_token" type = "hidden" value = "' . csrf_token() . '"">
                <input name="_token" type="hidden" value="' . csrf_token() . '">
                <div class="form-group form-model2">
    <label for="chọn sách">Chọn tháng</label>
    <select required="" class="form-control" name="month">';
        for ($i = 1; $i < 13; $i++) {
            $info = $info . '<option value="' . $i . '"> Tháng ' . $i . '</option>';
        }
        $info = $info . '</select>
</div>
<div class="form-group form-model2">
    <label for="chọn sách">Chọn Năm</label>
    <select required="" class="form-control" name="year">
    <option value="2016"> Năm 2016 </option>
        <option value="2017"> Năm 2017</option></select>
         
</div>
<button type="submit" class="btn btn-primary cratebutton" >Xuất dự liệu</button>
</form>';
        return response()->json(array('info' => $info), 200);
    }

    public function CustomerExport(Request $request) {
        //echo $request->year.'-'.$request->month.'<br>';
        $from = Carbon::createFromDate($request->year, $request->month, '01');
        $to = Carbon::createFromDate($request->year, $request->month, '30');
        $customer = DB::table('customer')
                        ->whereBetween('created_at', array($from, $to))->where('check', '<>', 1)->get();

        if (strlen($customer) > 3) {
            $i = 1;
            foreach ($customer as $customer) {
                $data[] = array(
                    $i,
                    $customer->name,
                    $customer->phone_number,
                    $customer->cmt,
                );
                $i++;
            }
            Excel::create('Dữ liệu khách hàng', function($excel) use ($data) {
                $excel->setTitle('Bảng khách hàng');
                $excel->setCreator('admin')->setCompany('BKCS');
                $excel->setDescription('bảng thống kê ');
                $excel->sheet('Sheet 1', function($cell) use ($data) {
                 $title = array('danh sách khách hàng mượn sách');
                   
                    $headings = array('id', 'Tên khách hàng', 'Số điện thoại', 'Chứng minh thư',);
                    // Font family
                    
                    $cell->setFontFamily('Calibri');
                    $cell->fromArray($data, null, 'A1', false, false);
                    $cell->prependRow(1, $headings);
                    $cell->setPageMargin(array(
                        0.25, 0.30, 0.25, 0.30
                    ));
                    $cell->setWidth(array(
                        'A' => 5,
                        'B' => 30,
                        'C' => 20,
                        'D' => 30,
                        'E' => 30,
                        'F' => 20,
                        'G' => 20
                    ));
// Set alignment to center
                });
            })->export('xls');
        } else {
            $data['msg'] = "không thể trích xuất dữ liệu";
            return view('Error', $data);
        }
    }

    public function ExcelView() {
        $book = DB::table('book')->where('check', '0')->get();
        Excel::create('New file', function($excel) use ($book) {

            $excel->sheet('New sheet', function($sheet) use ($book) {

                $sheet->loadView('output');
            });
        })->download('xls');
    }

}
