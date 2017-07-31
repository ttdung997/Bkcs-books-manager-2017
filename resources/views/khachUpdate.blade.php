@extends('layouts.check')
@extends('layouts.app')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>

<?php $i = 1;
$chuoi = [];
?>
<?php
foreach ($user as $user) {
    $name=$user->name;
    $phone_number=$user->phone_number;
    $bookname=$user->book_name;
    $lend=$user->date_lend;
    $give=$user->date_give;
}


 list($yearl, $monthl, $dayl) = explode('-', $lend);
 list($yearg, $monthg, $dayg) = explode('-', $give);
 
foreach ($book as $book) {
    $chuoi[$book->name] = $book->name;
}
?>
{!! Form::open(array('route' => 'customerForm_store', 'class' => 'form')) !!}
{!! Form::token(); !!}
<div class="form-group">
    {!! Form::label('Tên khách hàng') !!}
    {!! Form::text('name', $name, 
    array('required', 
    'class'=>'form-control', 
    'placeholder'=>'nhập tên...')) !!}
</div>

<div class="form-group">
    {!! Form::label('số điện thoại') !!}
    {!! Form::text('phone_number', $phone_number, 
    array('required', 
    'class'=>'form-control', 
    'placeholder'=>'nhập số điện thoại')) !!}
</div>
<div class="form-group">
    {!! Form::label('chọn sách') !!}
    {!! Form::select('book_name', $chuoi,$bookname, array('required', 
    'class'=>'form-control', ))!!}
</div>
<div class="form-group">
    {!! Form::label('ngày mượn') !!}
    {!! Form::date('lend',\Carbon\Carbon::createFromDate($yearl, $monthl, $dayl),['class' => 'form-control']); !!}
    
</div>
<div class="form-group">
    {!! Form::label('ngày trả') !!}
    {!! Form::date('give',\Carbon\Carbon::createFromDate($yearg, $monthg, $dayg),['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::submit('Tạo', 
    array('class'=>'btn btn-primary cratebutton')) !!}
</div>
{!! Form::close() !!}
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@stop