@extends('layouts.check')
@extends('layouts.app')
@section('content')
<ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
<?php foreach($book as $book){
    $name=$book->name;
    $type=$book->type;
}
?>
{!! Form::open(array('route' => 'bookForm_store', 'class' => 'form')) !!}
{!! Form::token(); !!}
<div class="form-group">
    {!! Form::label('Tên sách') !!}
    {!! Form::text('name', $name, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'nhập tên sách')) !!}
</div>

<div class="form-group">
    {!! Form::label('loại sách') !!}
    {!! Form::text('type', $type, 
        array('required', 
              'class'=>'form-control', 
              'placeholder'=>'nhập loại sách...')) !!}
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