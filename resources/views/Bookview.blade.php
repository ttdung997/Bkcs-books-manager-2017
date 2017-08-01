@extends('layouts.check')
@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    <div id="msg"  class="alert alert-success hidden">


    </div>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <br>
    <button type="button" onclick="insertBook()" class="btn btn-primary" data-pjax="0" data-toggle="modal" data-target="#myModal">Thêm đầu sách</button>
    <a href="/BookExport" type="button" class="btn btn-primary">Xuất dữ liệu</a>
    <br>
    <br>
    <br>
    <table id="ViewTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>
                    <a href="#" data-sort="id">STT</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Tên sách</a>
                </th>
                <th>
                    <a href="#" data-sort="id">loại sách</a>
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
                    <input type="publication" class="form-control" name="SinhVienSearch[tieu_de]">
                </td>
                <td>&nbsp;</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($book as $book) { ?>
                <tr data-key="<?= $i ?>" id="ele<?= $book->id ?>">
                    <td><?= $i ?></td>
                    <td><?= $book->name ?></td>
                    <td><?= $book->type ?></td>
                    <?php if ($book->check == 0) echo "<td>Trống</td>";
                          else echo "<td>Đang mượn</td>";
                    ?>
                    <td onmouseenter="an()">
                        <a onclick="getInfo(<?= $book->id ?>)" aria-label="View" data-pjax="0" data-toggle="modal" data-target="#myModal">
                            <span style="color: #337ab7" class="glyphicon glyphicon-eye-open">
                            </span>
                        </a>  <a onclick="updateInfo(<?= $book->id ?>)" title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myModal">
                            <span style="color: #337ab7" class="glyphicon glyphicon-pencil">
                            </span>
                        </a> <a onclick="deleteB(<?= $book->id ?>)" data-method="post" data-pjax="0">
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="pagenavi">

        <b class="pages">Trang <?= $page ?> / <?= intval(($count - 1) / 5) + 1 ?></b>
        <?php if ($page != 1) { ?><a class="paginate_button previous disabled" href="/Bookview/<?= $page - 1 ?>">« Trước</a><?php } ?>
        <?php
        for ($i = $page - 1; $i <= $page - 1; $i++) {
            if ($i <= 0)
                continue;
            ?>
            <a class="paginate_button" href="/Bookview/<?= $i ?>"><?= $i ?></a>
        <?php } ?>
        <b class="paginate_button current"><?= $page ?></b>
        <?php
        for ($i = $page + 1; $i < $page + 2; $i++) {
            if ($i > intval(($count - 1) / 5) + 1)
                break;
            ?>
            <a class="paginate_button" href="/Bookview/<?= $i ?>"><?= $i ?></a>
        <?php } ?>
        <?php if ($page != intval(($count - 1) / 5) + 1) { ?><a class="paginate_button previous disabled" href="/Bookview/<?= $page + 1 ?>" >Sau »</a><?php } ?>
        <form action="/pageNumberB" method="get">

            <label>Trang: </label>
            <input style="width: 20px;s" class="inputnumber" name="number" type="text">
            <input type="submit" hidden>
        </form>

    </div>
</div>

<script>
    function getInfo(n) {
        $.ajax({
            type: 'GET',
            url: '/getinfoB/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#info").html(data.info);
            }
        });
    }
    function updateInfo(n) {
        $.ajax({
            type: 'GET',
            url: '/updateinfoB/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#info").html(data.info);
            }
        });
    }
    function updateB() {
        function updatechange(id) {
            var data = document.getElementById("ele" + id);
            var name = document.getElementsByName('name')[0].value.toString();
            var type = document.getElementsByName('type')[0].value.toString();
            var date = document.getElementsByName('publication')[0].value.toString();
            data.children[1].textContent = name;
            data.children[2].textContent = type;
        }
        document.getElementById('msg').classList.remove("hidden");
        document.getElementById('loading').style.display = "block";
        var id = document.getElementsByName('id')[0].value;
        var frm = $('#bookform');
        $.ajax({
            type: 'POST',
            url: '/updateB',
            data: frm.serialize(),
            success: function (data) {
                $("#msg").html(data.msg);
            }
        });
        updatechange(id);

    }
    function deleteB(n) {
        if (confirm("Bạn có chắc muốn xóa bản ghi") == true) {
            $.ajax({
                type: 'GET',
                url: '/deleteB/' + n,
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    $("#msg").html(data.msg);
                }
            });
            document.getElementById('msg').classList.remove("hidden");
            document.getElementById("ele" + n).remove();

        }

    }
    function an() {
        document.getElementById('loading').style.display = "none";
        document.getElementById('msg').classList.add("hidden");

    }
    function insertBook() {
        $.ajax({
            type: 'GET',
            url: '/insertBook',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#info").html(data.info);
            }
        });
    }
    function insertB() {

        var frm = $('#bookform');
        $.ajax({
            type: 'POST',
            url: '/insertB',
            data: frm.serialize(),
            success: function (data) {
                document.getElementById('msg').classList.remove("hidden");
                $("#msg").html(data.msg);
                $("#insert_line").html(data.insert_line);
                if (<?= $page ?> == <?= intval(($count - 1) / 5) + 1 ?>) {
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }

            }
        });


    }
    function updateB2() {
        function updatechange(id) {
            var data = document.getElementById("ele" + id);
            var name = document.getElementsByName('name')[0].value.toString();
            var type = document.getElementsByName('type')[0].value.toString();
            var date = document.getElementsByName('publication')[0].value.toString();
            data.children[1].textContent = name;
            data.children[2].textContent = type;
        }
        var id = document.getElementsByName('id')[0].value;
        var form = $('#bookform')[0];
        var form = new FormData('#bookform')[0];
        var name = document.getElementsByName('name')[0];
        $.ajax({
            url: "/AjaxBookUpload",
            type: 'POST',
            data: new FormData($("#bookform")[0]),
            processData: false,
            contentType: false,
            success: function (data)
            {

                console.log(data.msg);
                $("#msg").html(data.msg);
                document.getElementById('msg').classList.remove("hidden");

            }
        });
        updatechange(id);
    }
    function saveImg() {
        var img = document.getElementById('QrCode');
        window.location.href = img.src.replace('image/png', 'image/octet-stream');
    }
</script>
@stop
