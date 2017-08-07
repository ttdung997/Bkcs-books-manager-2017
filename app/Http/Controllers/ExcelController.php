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

    public function CustomerExport(Request $request) {
        //echo $request->year.'-'.$request->month.'<br>';

        $customer = DB::table('customer')
                        ->whereBetween('created_at', array($request->date1, $request->date2))->where('check', '<>', 1)->get();

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

    public function DealExport(Request $request) {
        //echo $request->year.'-'.$request->month.'<br>';

        $deal = DB::table('book_deal')
                        ->whereBetween('created_at', array($request->date1, $request->date2))->where('status', '<>', 1)->get();

        if (strlen($deal) > 3) {
            $i = 1;
            foreach ($deal as $deal) {
                $customer = DB::table('customer')->where('id', $deal->customer_id)->first();
                $book = DB::table('book')->where('id', $deal->book_id)->first();
                if($deal->status == 0)$status="Đã trả";
                else $status="Chưa trả";
                $data[] = array(
                    $i,
                    $customer->name,
                    $book->name,
                    $deal->lend_date,
                    $deal->give_date,
                    $status,
                );
                $i++;
            }
            Excel::create('Dữ liệu khách hàng', function($excel) use ($data) {
                $excel->setTitle('Bảng giao dịch khách hàng');
                $excel->setCreator('admin')->setCompany('BKCS');
                $excel->setDescription('bảng thống kê ');
                $excel->sheet('Sheet 1', function($cell) use ($data) {
                    $title = array('danh sách khách hàng mượn sách');

                    $headings = array('id', 'Tên khách hàng', 'Tên sách', 'Ngày mượn', 'Ngày trả','Trạng Thái');
                    // Font family

                    $cell->setFontFamily('Calibri');
                    $cell->fromArray($data, null, 'A1', false, false);
                    $cell->prependRow(1, $headings);
                    $cell->setPageMargin(array(
                        0.25, 0.30, 0.25, 0.30
                    ));
                    $cell->setWidth(array(
                        'A' => 5,
                        'B' => 40,
                        'C' => 40,
                        'D' => 30,
                        'E' => 30,
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
