<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use DB;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MyFirstController extends Controller {

//test
    public function getController($stn, $sth) {
        $chuoi = $stn . " love " . $sth;
        return $chuoi;
    }

    public function testController($stn, $sth) {
        $chuoi = $stn . " ??? " . $sth;
        return $chuoi;
    }

    function mselect() {

        function multiexplode($delimiters, $string) {

            $ready = str_replace($delimiters, $delimiters[0], $string);
            $launch = explode($delimiters[0], $ready);
            return $launch;
        }

        $lx = $_POST['loaixe'];
        $tag = "";
        // echo count($lx);
        for ($i = 0; $i < count($lx); $i++) {
            $tag = $tag . $lx[$i] . ",";
        }
        $tag2 = multiexplode(array(","), $tag);
        for ($i = 0; $i < count($tag2); $i++) {
            echo $tag2[$i],'<br>';
        }
    }

    public function getView($stn, $sth) {
        $data['chuoi'] = $stn . " love " . $sth;
        return view('MyFirstView', $data);
    }

    public function data() {
        $user = DB::table('user')->get();

        return view('UserView', ['user' => $user]);
    }

//form
    public function getForm() {
        $book = DB::table('book')->where('check', '0')->get();
        return view('FormView', ['book' => $book]);
    }

    public function addBook() {
        $book = DB::table('book')->get();
        return view('bookForm', ['book' => $book]);
    }

    public function updateBook($stn) {
        $book = DB::table('book')->where('id', $stn)->get();
        DB::table('book')->where('id', $stn)->delete();
        return view('bookUpdate', ['book' => $book]);
    }

    public function deleteBook($stn) {

        DB::table('book')->where('id', $stn)->delete();
        $book = DB::table('book')->get();
        return view('FormView', ['book' => $book]);
    }

    public function addCustomer() {
        $book = DB::table('customer')->get();
        return view('bookForm', ['book' => $book]);
    }

    public function viewCustomer($stn) {
        $user = DB::table('customer')->where('id', $stn)->get();
        return view('khachSingle', ['user' => $user]);
    }

    public function updateCustomer($stn) {
        $book = DB::table('book')->get();
        $user = DB::table('customer')->where('id', $stn)->get();
        DB::table('customer')->where('id', $stn)->delete();
        return view('khachUpdate', ['user' => $user, 'book' => $book]);
    }

    public function deleteCustomer($stn) {

        DB::table('customer')->where('id', $stn)->delete();
        $user = DB::table('customer')->get();
        return view('KhachView', ['user' => $user]);
    }

//view
    public function getKhach($n) {
        $data['page'] = $n;
        $data['count'] = DB::table('customer')->where('check', '<>', 1)->count();
        $data['id'] = DB::table('customer')->where('check', '<>', 1)->max('id');
        if ($n > 0 && $n < ($data['count']) / 5 + 1) {
            $user = DB::table('customer')->where('check', '<>', 1)->offset(($n - 1) * 5)->take(5)->get();
            return view('KhachView', ['user' => $user], $data);
        } else {
            return view('PageError');
        }
    }

    public function login() {
        return view('login');
    }

    public function Bookview($n) {
        $data['page'] = $n;
        $data['count'] = DB::table('book')->where('check', '<>', 1)->count();
        $data['id'] = DB::table('book')->where('check', '<>', 1)->max('id');

        if ($n > 0 && $n < ($data['count']) / 5 + 1) {
            $book = DB::table('book')->where('check', '<>', 1)->offset(($n - 1) * 5)->take(5)->get();
            return view('Bookview', ['book' => $book], $data);
        } else {
            return view('PageError');
        }
    }

    public function Bookview1($n) {
        return view('Bookview/1');
    }

    public function Notfound() {
        return view('PageError');
    }

    public function userInfo() {
        $users = DB::table('users')->where('name', Auth::user()->name)->get();
        return view('userInfo', ['users' => $users]);
    }

    public function demo() {
        return view('demo');
    }

    public function output() {
        return view('output');
    }

    public function Loginon() {
        return view('auth.login');
    }

}
