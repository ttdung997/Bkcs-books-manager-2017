@extends('layouts.check')
@extends('layouts.app')
@section('content')
<div class="col-lg-12">
    <div id="msg"  class="alert alert-success hidden">


    </div>
<div class="form-group">
    {!! Form::label('Tên quản trị') !!}
    <?php echo $users[0]->name; ?>
</div>
<div class="form-group">
    {!! Form::label('Email') !!}
     <?php echo $users[0]->email; ?>
</div>
 <form id="cpForm" accept-charset="UTF-8" class="form">
    <input name="_token" type="hidden" value="<?=csrf_token();?>">
<input name="_token" type="hidden" value="<?=csrf_token();?>">
<div class="form-group">
    <label for="Mật khẩu cũ">Mật Khẩu Cũ</label>
    <input required="" class="form-control" placeholder="nhập mật khẩu..." name="pass" type="password" value="">
</div>

<div class="form-group">
    <label for="Nhập mật khẩu mới">Nhập Mật Khẩu Mới</label>
    <input required="" class="form-control" placeholder="nhập mật khẩu..." name="newpass" type="password" value="">
</div>
<div class="form-group">
    <input class="btn btn-primary cratebutton"  onclick="changepass()"  value="Đổi mật khẩu">
</div>
</form>
@stop

<script>
    function changepass(){
         var frm = $('#cpForm');
        $.ajax({
            type: 'POST',
            url: '/changePass',
            data: frm.serialize(),
            success: function (data) {
                $("#msg").html(data.msg);
                document.getElementById('msg').classList.remove("hidden");
            }
        });
    }
</script>
