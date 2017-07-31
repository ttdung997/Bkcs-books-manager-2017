
@extends('layouts.app')
@section('content')
<?php 
if (isset(Auth::user()->name)) {
    header("Location:/Bookview/1");
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Bạn đã đăng nhập thành công</div>
            </div>
        </div>
    </div>
</div>
@endsection
