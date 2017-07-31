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
{!! Form::open(array('route' => 'BookuploadForm', 'class' => 'form','enctype'=>'multipart/form-data')) !!}
{!! Form::token(); !!}
<div class="form-group">
    {!! Form::label('Tên sách') !!}
    {!! Form::text('name', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'nhập tên sách')) !!}
</div>

<div class="form-group">
    {!! Form::label('loại sách') !!}
    {!! Form::text('type', null, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'nhập loại sách...')) !!}
</div>
<div class="form-group">
    {!! Form::label('Ảnh bìa sách') !!}
  <input type="file" name="file" id="file">
</div>
<div class="form-group">
    {!! Form::label('ngày xuất bản') !!}
    {!! Form::date('publication', \Carbon\Carbon::now(),['class' => 'form-control']); !!}
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