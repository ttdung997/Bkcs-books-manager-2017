@extends('layouts.check')
@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    <div id="msg"  class="alert alert-success  hidden">

    </div>

    <button type="button" onclick="insertCustomer()" class="btn btn-primary" data-pjax="0" data-toggle="modal" data-target="#myModal">Thêm bản ghi</button>
    <a  type="button" class="btn btn-primary" onclick="seleteDate()" data-pjax="0" data-toggle="modal" data-target="#myModal">Xuất dữ liệu </a>


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
                    <a href="#" data-sort="id">Mượn sách</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Trạng thái</a>
                </th>

                <th class="action-column">&nbsp;</th>
            </tr>
            <tr id="w0-filters" class="filters">
                <td>&nbsp;</td>
                <td>
                    <input type="text" class="form-control" name="SinhVienSearch[id]">
                </td>
                <td>
                    <input type="text" class="form-control" name="SinhVienSearch[ten]">
                </td>
                <td>
                    <input type="text" class="form-control" name="SinhVienSearch[tieu_de]">
                </td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($user as $user) { ?>
                <tr data-key="<?= $i ?>" id="ele<?= $user->id ?>">
                    <td><?= $i ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->book_name ?></td>
                    <?php if ($user->check == 0) echo "<td>Đã trả</td>";
                          else echo "<td>Đang mượn</td>";
                    ?>
                    <td onmouseenter="an()">
                        <a onclick="getInfo(<?= $user->id ?>)" href="#" title="view" aria-label="view" data-pjax="0" data-toggle="modal" data-target="#myModal">
                            <span style="color: #337ab7" class="glyphicon glyphicon-eye-open">
                            </span>
                            <a onclick="updateInfo(<?= $user->id ?>)" href="#" title="update" aria-label="update" data-pjax="0" data-toggle="modal" data-target="#myModal">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Khung thông tin</h4>

                </div>
                <div class="modal-body">
                    <div id="info">
                    </div>
                    <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Thoát</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="pagenavi">

        <b class="pages">Trang <?= $page ?> / <?= intval(($count - 1) / 5) + 1 ?></b>
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
        <form action="/pageNumberC" method="get">

            <label>Trang: </label>
            <input style="width: 20px;s" class="inputnumber" name="number" type="text">
            <input type="submit" hidden>
        </form>

    </div>
</div>
<script>
    function insertCustomer() {
        $.ajax({
            type: 'GET',
            url: '/insertCustomer',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#info").html(data.info);
            }
        });
    }
    function insertC() {

        var frm = $('#khachform');
        $.ajax({
            type: 'POST',
            url: '/insertC',
            data: frm.serialize(),
            success: function (data) {
                $("#msg").html(data.msg);
                $("#insert_line").html(data.insert_line);
                if (<?= $page ?> == <?= intval(($count - 1) / 5) + 1 ?>) {
                    document.getElementById('msg').classList.remove("hidden");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
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
                $("#info").html(data.info);
            }
        });
    }
    function updateInfo(n) {
        $.ajax({
            type: 'GET',
            url: '/updateinfoC/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#info").html(data.info);
            }
        });
    }
    function updateC() {
        function updatechange(id) {
            var data = document.getElementById("ele" + id);
            var name = document.getElementsByName('name')[0].value.toString();
            var phone_number = document.getElementsByName('phone_number')[0].value.toString();
            var book_name = document.getElementsByName('book_name')[0].value.toString();
           
            data.children[1].textContent = name;
            data.children[2].textContent = book_name;
             data.children[3].textContent ="Đang mượn";
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
    function seleteDate() {
        $.ajax({
            type: 'GET',
            url: '/seleteDate/',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#info").html(data.info);
            }
        });
    }
    function BookGive(n){
     var data = document.getElementById("ele" + n);
     data.children[3].textContent ="Đã trả";
      document.getElementById('msg').classList.remove("hidden");
          $.ajax({
            type: 'GET',
            url: '/BookGive/'+n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#msg").html(data.msg);
                document.getElementById('msg').classList.remove("hidden");
                
            }
        });
    }
</script>
@stop