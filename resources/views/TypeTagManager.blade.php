@extends('layouts.check')
@extends('layouts.app')
@section('content')
<div id="msg"  class="alert alert-success hidden">


</div>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div>
                <div  role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Danh sách thể loại</h4>
                        </div>
                        <div class="modal-body">
                            <div id="info">
                                <ul>
                                    <?php
                                    $type = DB::table('book_type')->where('status', '0')->get();
                                    foreach ($type as $type) {
                                        ?>
                                        <li class="list-group-item" id="type<?= $type->id ?>" > <a onclick="changeTag(<?= $type->id ?>)" href="#" aria-label="View" data-pjax="0" data-toggle="modal" data-target="#myShowModal"><?= $type->name ?></a>  
                                            <span style="float: right">
                                                <a onclick="changeTag(<?= $type->id ?>)" href="#" aria-label="View" data-pjax="0" data-toggle="modal" data-target="#myShowModal">
                                                    <span style="color: #337ab7" class="glyphicon glyphicon-eye-open">
                                                    </span>
                                                </a>  <a  href="#" onclick="updateType(<?= $type->id ?>, '<?= $type->name ?>')" title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myUpdateModal">
                                                    <span style="color: #337ab7" class="glyphicon glyphicon-pencil">
                                                    </span>
                                                </a> <a onclick="deleteType(<?= $type->id ?>)" href="#" data-method="post" data-pjax="0">
                                                    <span style="color: #337ab7" class="glyphicon glyphicon-trash">
                                                    </span>
                                                </a>
                                            </span>
                                        </li>

                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick ="openTypeForm()">Thêm thể loại</button>
                        </div>
                        <div class="modal-footer form-hidden" id="typeForm">
                            <form id="booktypeform" class="form-inline " method="post" action="/insertType">
                                <label for="chọn sách">Thêm thể loại</label>
                                <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                                <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                                <input style="width: 69%" class="form-control" name="name" type="text">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>
                        </div>
                        <div class="modal-footer form-hidden" id="typeUpdateForm">
                            <form id="edittypeform" class="form-inline " method="post" action="/updateType">
                                <label for="chọn sách">sửa thể loại</label>
                                <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                                <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                                <input name="updateId" type="hidden">
                                <input style="width: 69%" class="form-control" name="updateName" type="text">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
        <div class="col-lg-6">
            <div>
                <div  role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title">Danh sách tag</h4>

                        </div>
                        <div class="modal-body">
                            <div id="info">

                                <div >
                                    <ul id="TagInfo">
                                        <?php
                                        $tag = DB::table('book_tag')->where('type_id', 2)->where('status', '0')->get();
                                        foreach ($tag as $tag) {
                                            ?>
                                            <li class="list-group-item" id="tag<?= $tag->id ?>"><?= $tag->name ?>
                                                <span style="float: right">

                                                </a>  <a onclick="updateTag(<?= $tag->id ?>, '<?= $tag->name ?>')" href="#"  title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myUpdateModal">
                                                <span  style="color: #337ab7" class="glyphicon glyphicon-pencil">
                                                </span>
                                            </a> <a onclick="updateTag(<?= $tag->id ?>)" href="#" data-method="post" data-pjax="0">
                                                <span style="color: #337ab7" class="glyphicon glyphicon-trash">
                                                </span>
                                            </a>
                                        </span>
                                    </li>

                                    <?php
                                }
                                ?>
                            </ul>
                        </div>

                    </div>
                    <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick ="opentagForm()">Thêm tag</button>
                </div>
                <div class="modal-footer form-hidden" id="tagForm">
                    <form id="booktagform" class="form-inline " method="post" action="/insertTag">
                        <label for="chọn sách">Thêm tag</label>
                        <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                        <input name="typeId" type="hidden" value="2">
                        <input style="width: 69%" class="form-control" name="tag" type="text">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
                <div class="modal-footer form-hidden" id="tagUpdateForm">
                    <form id="edittagform" class="form-inline " method="post" action="/updateTag">
                        <label for="chọn sách">sửa tag</label>
                        <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                        <input name="updateTagId" type="hidden">
                        <input style="width: 69%" class="form-control" name="updateTag" type="text">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</div>
</div>
<script>
    function changeTag(n) {
        $.ajax({
            type: 'GET',
            url: '/changeTag/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#TagInfo").html(data.info);
            }
        });
        document.getElementsByName('typeId')[0].value = n;

    }
    function updateType(n, name) {
        document.getElementById('typeUpdateForm').classList.remove("form-hidden");
        document.getElementsByName('updateName')[0].value = name.toString();
        document.getElementsByName('updateId')[0].value = n;
        window.location.hash = '#edittypeform';
    }
    function deleteType(n) {
        if (confirm("Bạn có chắc muốn xóa thể loại này") == true) {
            $.ajax({
                type: 'GET',
                url: '/deleteType/' + n,
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    $("#msg").html(data.msg);
                }
            });
            document.getElementById('msg').classList.remove("hidden");
            document.getElementById("type" + n).remove();
        }
    }

    function updateTag(n, name) {
        document.getElementById('tagUpdateForm').classList.remove("form-hidden");
        document.getElementsByName('updateTag')[0].value = name.toString();
        document.getElementsByName('updateTagId')[0].value = n;
        window.location.hash = '#edittagform';
    }
    function deleteTag(n) {
        if (confirm("Bạn có chắc muốn xóa thể loại này") == true) {
            $.ajax({
                type: 'GET',
                url: '/deleteTag/' + n,
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    $("#msg").html(data.msg);
                }
            });
            document.getElementById('msg').classList.remove("hidden");
            document.getElementById("tag" + n).remove();
        }


    }
    function an() {
        document.getElementById('msg').classList.add("hidden");
    }
    function openTypeForm() {
        document.getElementById('typeForm').classList.remove("form-hidden");
    }
    function opentagForm() {
        document.getElementById('tagForm').classList.remove("form-hidden");
    }
    
</script>
@stop