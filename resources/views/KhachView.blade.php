@extends('layouts.check')
@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    <div id="msg"  class="alert alert-success  hidden">

    </div>

    <button type="button" class="btn btn-primary" data-pjax="0" data-toggle="modal" data-target="#myInsertModal">Thêm bản ghi</button>
    <a  type="button" class="btn btn-primary" data-pjax="0" data-toggle="modal" data-target="#myExcelModal">Xuất dữ liệu </a>


    <br>
    <br>
    <Br>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>
                    <a href="#" data-sort="id">STT</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Tên khách hàng</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Số điện thoại</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Chứng minh thư</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Số sách đang mượn</a>
                </th>

                <th class="action-column">Lich sử</th>
                <th class="action-column">&nbsp;</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1 ?>
            <?php foreach ($user as $user) { ?>
                <tr data-key="<?= $i ?>" id="ele<?= $user->id ?>">
                    <td><?= $i ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->phone_number ?></td>
                    <td><?= $user->cmt ?></td>
                    <td><?= $user->BookNumber ?></td>
                    <td><a class="btn btn-primary" href="/HistoryCustomer/<?= $user->id ?>/1">Chi tiết</a></td>
                    <td onmouseenter="an()">
                        <a onclick="getInfo(<?= $user->id ?>)" href="#" title="view" aria-label="view" data-pjax="0" data-toggle="modal" data-target="#myViewModal">
                            <span style="color: #337ab7" class="glyphicon glyphicon-eye-open">
                            </span>
                            <a onclick="updateInfo(<?= $user->id ?>)" href="#" title="update" aria-label="update" data-pjax="0" data-toggle="modal" data-target="#myUpdateModal">
                                <span style="color: #337ab7" class="glyphicon glyphicon-pencil">
                                </span>
                            </a> <a title="Delete" onclick="deleteC(<?= $user->id ?>)" data-method="post" data-pjax="0">
                                <span style="color: #337ab7" class="glyphicon glyphicon-trash">
                                </span>
                            </a>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr data-key="<?= $i ?>" id="insert_line">
            </tr>
        </tbody>
    </table>
    <div class="modal fade" tabindex="-1" role="dialog" id="myViewModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Xem thông tin người dùng</h4>

                </div>
                <div class="modal-body">
                    <div class="form-group form-model">
                        <label for="Tên khách hàng">Tên Khách Hàng</label>
                        <p id="infoShow"><span id="customerName"></span></p></div>
                    <div class="form-group form-model">
                        <label for="số điện thoại">Số điện Thoại</label>
                        <p id="infoShow"><span id="customerPhone"></span></p></div>
                    <div class="form-group form-model">
                        <label for="chọn sách">Chứng minh thư</label>
                        <p id="infoShow"><span id="customerCmt"></span></p></div>
                    <div class="form-group form-model">
                        <label for="chọn sách">Số sách đang mượn</label>
                        <p id="infoShow"><span id="customerBN"></span></p></div>
                    <div class="form-group form-model">
                        <label for="ngày mượn">Ngày Tạo</label>
                        <p id="infoShow"><span id="customerCreate"></span></p></div>
                    <div class="form-group form-model">
                        <label for="ngày trả">Ngày Cập Nhật</label>
                        <p id="infoShow"><span id="customerUpdate"></span></p></div>
                    <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myUpdateModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thêm thông tin người dùng</h4>

                </div>
                <div class="modal-body">
                    <form id="khachform" accept-charset="UTF-8" class="form" >
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>"">
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                        <div class="form-group form-model2">
                            <label for="Tên khách hàng">Tên Khách Hàng</label>
                            <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text" >
                        </div>

                        <div class="form-group form-model2">
                            <input name="id" type="hidden">
                            <label for="số điện thoại">Số điện Thoại</label>
                            <input required="" class="form-control" placeholder="nhập số điện thoại" name="phone_number" type="text" >
                        </div>
                        <div class="form-group form-model2">
                            <label for="số điện thoại">Chứng minh thư</label>
                            <input required="" class="form-control" placeholder="nhập chứng minh" name="cmt" type="text" value>
                        </div>

                        <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                        <div class="modal-footer">
                            <button class="btn btn-success" onclick="updateC()" data-dismiss="modal">chỉnh sửa</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                        </div>
                    </form>
                </div>  
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

     <div class="modal fade" tabindex="-1" role="dialog" id="myExcelModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Xuất dữ liệu</h4>

                </div>
                <div class="modal-body">
                    <br>
                    <form action="/CustomerExport" method="post" accept-charset = "UTF-8" class = "form" >
                        <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                        <div class="form-group form-model2">
                            <label for="ngày trả"> Từ Ngày</label>
                            <?php
                            $date2 = \Carbon\Carbon::now();
                            $date1 = \Carbon\Carbon::now()->subMonth();
                            ;
                            ?>
                            <input class="form-control" name="date1" type="date" value="<?= $date1->toDateString(); ?>">
                        </div>
                        <div class="form-group form-model2">
                            <label for="ngày trả">Đến Ngày</label>
                            <input class="form-control" name="date2" type="date" value="<?= $date2->toDateString(); ?>">
                        </div>

                        <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" >Xuất dự liệu</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>


                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myInsertModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thêm người dùng mới</h4>

                </div>
                <div class="modal-body">
                    <form id="khachforminsert" accept-charset="UTF-8" class="form" >
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                        <div class="form-group form-model2">
                            <label for="Tên khách hàng">Tên Khách Hàng</label>
                            <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text" >
                        </div>

                        <div class="form-group form-model2">
                            <label for="số điện thoại">Số điện Thoại</label>
                            <input required="" class="form-control" placeholder="nhập số điện thoại" name="phone_number" type="text" >
                        </div>
                        <div class="form-group form-model2">
                            <label for="số điện thoại">Chứng minh thư</label>
                            <input required="" class="form-control" placeholder="nhập chứng minh thư" name="cmt" type="text" >
                        </div>

                        <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                        <div class="modal-footer"> 
                            <button class="btn btn-success" onclick="insertC()" data-dismiss="modal">Thêm Người dùng</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="pagenavi">
        <form action="/pageNumberC" method="get">

            <label>Trang: </label>
            <input style="width: 20px;" class="inputnumber" name="number" type="text">
            <input type="submit" hidden>
            <b class="pages">Trang <?= $page ?> / <?= intval(($count - 1) / 5) + 1 ?></b>
            <a class="paginate_button" href="/khachview/1">« Đầu</a>
            <?php if ($page != 1) { ?><a class="paginate_button previous disabled" href="/khachview/<?= $page - 1 ?>">« Trước</a><?php } ?>
            <?php
            for ($i = $page - 1; $i <= $page - 1; $i++) {
                if ($i <= 0)
                    continue;
                ?>
                <a class="paginate_button" href="/khachview/<?= $i ?>"><?= $i ?></a>
            <?php } ?>
            <b class="paginate_button current"><?= $page ?></b>
            <?php
            for ($i = $page + 1; $i < $page + 2; $i++) {
                if ($i > intval(($count - 1) / 5) + 1)
                    break;
                ?>
                <a class="paginate_button" href="/khachview/<?= $i ?>"><?= $i ?></a>
            <?php } ?>
            <?php if ($page != intval(($count - 1) / 5) + 1) { ?><a class="paginate_button previous disabled" href="/khachview/<?= $page + 1 ?>" >Sau »</a><?php } ?>
            <a class="paginate_button" href="/khachview/<?= intval(($count - 1) / 5) + 1 ?>">Cuối »</a>
        </form>

    </div>
</div>
<script>
    //    function insertCustomer() {
    //        $.ajax({
    //            type: 'GET',
    //            url: '/insertCustomer',
    //            success: function (data) {
    //                $("#info").html(data.info);
    //            }
    //        });
    //    }
    function insertC() {

        var frm = $('#khachforminsert');
        alert(frm.serialize());
        $.ajax({
            type: 'POST',
            url: '/insertC',
            data: frm.serialize(),
            success: function (data) {
                $("#msg").html(data.msg);
                if (<?= $page ?> == <?= intval(($count - 1) / 5) + 1 ?>) {
                    document.getElementById('msg').classList.remove("hidden");
                    setTimeout(function () {
                        location.reload();
                    }, 100);
                }
            }
        });
    }
    function getInfo(n) {
        $.ajax({
            type: 'GET',
            url: '/getinfoC/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#customerName").html(data.user.name);
                $("#customerPhone").html(data.user.phone_number);
                $("#customerCmt").html(data.user.cmt);
                $("#customerBN").html(data.user.BookNumber);
                $("#customerCreate").html(data.user.created_at);
                $("#customerUpdate").html(data.user.updated_at);
            }
        });
    }
    function updateInfo(n) {
        $.ajax({
            type: 'GET',
            url: '/updateinfoC/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                document.getElementsByName('name')[0].value = data.user.name;
                document.getElementsByName('phone_number')[0].value = data.user.phone_number;
                document.getElementsByName('cmt')[0].value = data.user.cmt;
                document.getElementsByName('id')[0].value = data.user.id;
            }
        });
    }
    function updateC() {
        function updatechange(id) {
            var data = document.getElementById("ele" + id);
            var name = document.getElementsByName('name')[0].value.toString();
            var cmt = document.getElementsByName('cmt')[0].value.toString();
            var phone_number = document.getElementsByName('phone_number')[0].value.toString();


            data.children[1].textContent = name;
            data.children[3].textContent = cmt;
        }
        document.getElementById('loading').style.display = "block";
        document.getElementById('msg').classList.remove("hidden");
        var id = document.getElementsByName('id')[0].value;
        var frm = $('#khachform');
        $.ajax({
            type: 'POST',
            url: '/updateC',
            data: frm.serialize(),
            success: function (data) {
                $("#msg").html(data.msg);
            }
        });
        updatechange(id);
    }
    function deleteC(n) {
        if (confirm("Bạn có chắc muốn xóa bản ghi") == true) {
            $.ajax({
                type: 'GET',
                url: '/deleteC/' + n,
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    $("#msg").html(data.msg);
                }
            });
            document.getElementById("ele" + n).remove();

        }

    }
    function an() {
        document.getElementById('loading').style.display = "none";
        document.getElementById('msg').classList.add("hidden");
    }
//    function seleteDate() {
//        $.ajax({
//            type: 'GET',
//            url: '/seleteDate/',
//            data: '_token = <?php echo csrf_token() ?>',
//            success: function (data) {
//                $("#info").html(data.info);
//            }
//        });
//    }
    function BookGive(n) {
        var data = document.getElementById("ele" + n);
        data.children[3].textContent = "Đã trả";
        document.getElementById('msg').classList.remove("hidden");
        $.ajax({
            type: 'GET',
            url: '/BookGive/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#msg").html(data.msg);
                document.getElementById('msg').classList.remove("hidden");

            }
        });
    }
</script>
@stop