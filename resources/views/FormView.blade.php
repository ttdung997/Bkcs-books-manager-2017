@extends('layouts.check')
@extends('layouts.app')
@section('content')
<div id="msg"  class="alert alert-success hidden">


</div>

<div class="col-lg-12">
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
                <a href="#" data-sort="id">ngày xuất bản</a>
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
                <td><?= $book->Publication_date ?></td>
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
            
    </tbody>
</table>
    </div>
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
            data.children[3].textContent = date;
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
    $(document).ready(function () {
        $('#ViewTable').DataTable();
    });
</script>
@stop
