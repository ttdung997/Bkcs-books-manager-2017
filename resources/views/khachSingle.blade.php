@extends('layouts.check')
@extends('layouts.app')
@section('content')

<?php
foreach ($user as $user) {
    $name=$user->name;
    $phone_number=$user->phone_number;
    $bookname=$user->book_name;
    $lend=$user->date_lend;
    $give=$user->date_give;
    
}
?>




<div class="form-group">
    {!! Form::label('Tên khách hàng') !!}
    <?php echo $name ?>
</div>
<div class="form-group">
    {!! Form::label('số điện thoại') !!}
     <?php echo $phone_number ?>
</div>
<div class="form-group">
    {!! Form::label('chọn sách') !!}
     <?php echo $bookname ?>
</div>
<div class="form-group">
    {!! Form::label('ngày mượn') !!}
     <?php echo $lend ?>
</div>
<div class="form-group">
    {!! Form::label('ngày trả') !!}
     <?php echo $give ?>
</div>
@stop

