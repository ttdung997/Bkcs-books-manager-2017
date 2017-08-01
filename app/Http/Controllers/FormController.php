<?php

namespace App\Http\Controllers;

use App\Http\Kernel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FormController extends Controller {

    public function create() {
        return view('bookForm');
    }

    public function store(Request $request) {
        $user = DB::table('book')->insert([
            ['name' => $request->name,
                'type' => $request->type,
                'Publication_date' => $request->publication,
                'check' => $request->check,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at,]
        ]);
        return redirect('form');
    }

    public function customerCreate() {
        $book = DB::table('book')->get();
        return view('customerForm', ['book' => $book]);
    }

    public function customerStore(Request $request) {
        echo $request->name.$request->book_name;
        $query = DB::table('customer')->insert([
            ['name' => $request->name,
                'phone_number' => $request->phone_number,
                'book_name' => $request->book_name,
                'check' => $request->check,
                'Lend_date' => $request->Lend_date,
                'Pay_date' => $request->Pay_date,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at,]
        ]);

        //return redirect('quanlykhach');
    }
    public function pageNumberB(Request $request) {
        $number=$request->number;
         return redirect('Bookview/'.$number);
    }
    public function pageNumberC(Request $request) {
        $number=$request->number;
         return redirect('khachview/'.$number);
    }

}
