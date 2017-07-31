@extends('layouts.check')
@extends('layouts.app')
@section('content')
<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
<br>
<br>
<br>
<br>
<br>
<br>
<?php $i = 1;
$chuoi = [];
?>
<?php
foreach ($book as $book) {
    $chuoi[$book->name] = $book->name;
}
?>
{!! Form::open(array('route' => 'customerForm_store', 'class' => 'form')) !!}
{!! Form::token(); !!}
<div class="form-group">
    {!! Form::label('Tên khách hàng') !!}
    {!! Form::text('name', null, 
    array('required', 
    'class'=>'form-control', 
    'placeholder'=>'nhập tên...')) !!}
</div>

<div class="form-group">
    {!! Form::label('số điện thoại') !!}
    {!! Form::text('phone_number', null, 
    array('required', 
    'class'=>'form-control', 
    'placeholder'=>'nhập số điện thoại')) !!}
</div>
<div class="form-group">
    {!! Form::label('chọn sách') !!}
    {!! Form::select('book_name', $chuoi,"đại số", array('required', 
    'class'=>'form-control', ))!!}
</div>
<div class="form-group">
    {!! Form::label('ngày mượn') !!}
    {!! Form::date('Lend_date', \Carbon\Carbon::now(),['class' => 'form-control']); !!}
</div>
<div class="form-group">
    {!! Form::label('ngày trả') !!}
    {!! Form::date('Pay_date', \Carbon\Carbon::now(),['class' => 'form-control']); !!}
</div>
  {!! Form::text('check', '0', 
        array('required', 
              'class'=>'form-hidden')) !!}
   <input name="created_at" type="hidden" value="<?=date("Y-m-d h:i:sa")?>">
<input name="updated_at" type="hidden" value="<?=date("Y-m-d h:i:sa")?> '">

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