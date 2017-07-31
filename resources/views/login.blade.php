@extends('layouts.app')
@section('content')
{!! Form::open(array('route' => 'loginme', 'class' => 'form')) !!}
{!! Form::token(); !!}
<div class="form-group">
    {!! Form::label('Tên đăng nhập') !!}
    {!! Form::text('name', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'nhập tên ..')) !!}
</div>

<div class="form-group">
    {!! Form::label('Mật khẩu') !!}
    {!! Form::password('pass', 
        array('required', 
              'class'=>'form-control',
              'placeholder'=>'nhập mật khẩu...',)) !!}
</div>
<div class="form-group">
    {!! Form::submit('Đăng nhập', 
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
@stop

