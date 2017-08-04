@extends('layouts.check')
@extends('layouts.app')
@section('content')
<div id="msg"  class="alert alert-danger">
    <h1>Chúng tôi không thể truy cập email qua facebook của ban,vui lòng đăng kí</h1>
    <a class="btn btn-danger" href="{{ route('register') }}">Đăng kí</a>
</div>
@stop