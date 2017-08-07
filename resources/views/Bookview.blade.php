@extends('layouts.check')
@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    <div id="msg"  class="alert alert-success hidden">


    </div>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <br>
    <button type="button" class="btn btn-primary" data-pjax="0" data-toggle="modal" data-target="#myInsertModal">Thêm đầu sách</button>
    <a href="/BookExport" type="button" class="btn btn-primary">Xuất dữ liệu</a>
    <a onclick="updateInfoTest(80)" title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myUpdateModal">TEST</a>

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
                    <a href="#" data-sort="id">Ảnh minh họa</a>
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
                <th>
                    <a href="#" data-sort="id">Lịch sử</a>
                </th>
                <th class="action-column">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php
            foreach ($book as $book) {
                if ($book->img == NULL) {
                    $img = "http://35.192.32.4/uploads/updateting.jpg";
                } else
                    $img = $book->img;
                ?>
                <tr data-key="<?= $i ?>" id="ele<?= $book->id ?>">
                    <td><?= $i ?></td>
                    <td><img class="bookImg2" src="<?= $img ?>"></td>
                    <td><?= $book->name ?></td>
                    <?php
                    if ($book->type) {
                        $typedb = DB::table('book_type')->where('id', $book->type)->first();
                        $type = $typedb->name;
                    } else {
                        $type = "Đang cập nhật";
                    }
                    ?>
                    <td><?= $type ?></td>
                    <?php
                    if ($book->check == 0)
                        echo "<td>Trống</td>";
                    else
                        echo "<td>Đang mượn</td>";
                    ?>
                    <td><a class="btn btn-primary" href="/HistoryBook/<?= $book->id ?>/1">Chi tiết</a></td>
                    <td onmouseenter="an()">
                        <a onclick="getInfo(<?= $book->id ?>)" aria-label="View" data-pjax="0" data-toggle="modal" data-target="#myShowModal">
                            <span style="color: #337ab7" class="glyphicon glyphicon-eye-open">
                            </span>
                        </a>  <a onclick="updateInfo(<?= $book->id ?>)" title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myUpdateModal">
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


    <div class="modal fade" tabindex="-1" role="dialog" id="myShowModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thông tin khách hàng</h4>

                </div>
                <div class="modal-body">
                    <div class="form-group form-model">
                        <label for="Tên khách hàng">Tên sách</label>
                        <p id="infoShow"><span id="bookName"></span></p></div>
                    <div class="form-group form-model">
                        <label for="số điện thoại">loại sách</label>
                        <p id="infoShow"><span id="bookType"></span></p></div>
                    <div class="form-group form-model">
                        <label for="số điện thoại">Thể loại</label>
                        <p id="infoShow"><span id="bookTag"></span></p></div>
                    <div class="form-group form-model">
                        <label for="ảnh bìa sách">Ảnh bìa sách</label>
                        <img id="bookImg" class="bookImg">

                    </div>
                    <div class="form-group form-model">
                        <label for="QrCode">QrCode</label>
                        <img id="QrCodeImg">             
                        <br><br><br> <a id="downloadQr" download=""  class="btn btn-primary codebutton">save QrCode</a>
                    </div>
                    <div class="form-group form-model">
                        <label for="mieu ta">Mô tả</label>
                        <p id="infoShow"> <span id="bookDes"></span></p></div>
                    <div class="form-group form-model">
                        <label for="chọn sách">Ngày xuất bản</label>
                        <p id="infoShow"> <span id="bookPub"></span></p></div>
                    <div class="form-group form-model">
                        <label for="chọn sách">Ngày tạo</label>
                        <p id="infoShow"><span id="bookCreate"></span></p></div>
                    <div class="form-group form-model">
                        <label for="chọn sách">Ngày cập nhật</label>
                        <p id="infoShow"><span id="bookUpdate"></span></div>
                    <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myUpdateModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cập nhật thông tin sách</h4>

                </div>
                <div class="modal-body">
                    <form id = "bookform" accept-charset = "UTF-8" class = "form" >
                        <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                        <div class="form-group form-model2">
                            <label for="Tên khách hàng">Tên Sách</label>
                            <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text">
                        </div>
                        <input name="id" type="hidden">
                        <div class="form-group form-model2">
                            <label for="chọn thể loại">Chọn thể loại</label>
                            <select onchange="changeTagUpdate(this.options[selectedIndex].value);" required="" class="form-control" name="type">
                                <option id="typeDefault"></option>
                                <?php
                                $type = DB::table('book_type')->where('status', '0')->get();
                                foreach ($type as $type) {
                                    ?>
                                    <option value="<?= $type->id ?>" > <?= $type->name ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group form-model2">
                            <label for="chọn thể loại">Chọn Tag</label>
                            <select multiple="multiple" size="6" class="form-control" name="tag[]" id="TagUpdateInfo" style="height: 200px;" >
                                <?php
                                $tag = DB::table('book_tag')->where('type_id', 2)->where('status', '0')->get();
                                foreach ($tag as $tag) {
                                    ?>
                                    <option value="<?= $tag->id ?>" > <?= $tag->name ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group form-model2">
                            <label for="ảnh bìa sách">Ảnh bìa sách hiện tại</label>
                            <img id="bookImgNow" class="bookImg">
                        </div>
                        <div class="form-group form-model2">
                            <label for="số điện thoại">Cập nhật ảnh</label>
                            <input type="file" name="file" id="file">
                        </div>
                        <div class="form-group form-model2">
                            <label for="mô tả">Nhập mô tả</label>
                            <input required="" class="form-control" placeholder="nhập mô tả.." name="des" type="text">
                        </div> 
                        <div class="form-group form-model2">
                            <label for="chọn sách">Ngày xuất bản</label>
                            <input class="form-control" name="publication" type="date">
                        </div>
                        <div class="form-group form-model2">
                            <br><br>
                            <div class="form-group form-model2">
                                <button class="btn btn-primary cratebutton" onclick="updateB2()" data-dismiss="modal">chỉnh sửa</button>
                            </div>
                            <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
                    <h4 class="modal-title">Thêm sách</h4>

                </div>
                <div class="modal-body">
                    <form method="POST" action="/BookuploadForm"  accept-charset="UTF-8" class="form" enctype="multipart/form-data">
                        <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                        <div class="form-group form-model2">
                            <label for="Tên khách hàng">Tên Sách</label>
                            <input required="" class="form-control" placeholder="nhập tên..." name="name" type="text">
                        </div>

                        <div class="form-group form-model2">
                            <label for="chọn thể loại">Chọn thể loại</label>
                            <select onchange="changeTag(this.options[selectedIndex].value);" required="" class="form-control" name="type">

                                <?php
                                $type = DB::table('book_type')->where('status', '0')->get();
                                foreach ($type as $type) {
                                    ?>
                                    <option value="<?= $type->id ?>" > <?= $type->name ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group form-model2">
                            <label for="chọn thể loại">Chọn Tag</label>
                            <select multiple="multiple" size="6" class="form-control" name="tag1[]" id="TagInfo" style="height: 200px;" >
                                <?php
                                $tag = DB::table('book_tag')->where('type_id', 2)->where('status', '0')->get();
                                foreach ($tag as $tag) {
                                    ?>
                                    <option value="<?= $tag->id ?>" > <?= $tag->name ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group form-model2">
                            <label for="số điện thoại">Chọn ảnh</label>
                            <input type="file" name="file" id="file">
                        </div>
                        <div class="form-group form-model2">
                            <label for="mô tả">Nhập mô tả</label>
                            <input required="" class="form-control" placeholder="nhập mô tả.." name="des" type="text">
                        </div> 
                        <div class="form-group form-model2">
                            <label for="chọn sách">Ngày xuất bản</label>
                            <input class="form-control" name="publication" type="date">
                        </div>
                        <br><br>
                        <div class="form-group form-model2">
                            <button class = "btn btn-primary cratebutton" type = "submit  data-dismiss="modal">Thêm sách</button>
                        </div>
                        <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="pagenavi">
        <form action="/pageNumberB" method="get">

            <label>Trang: </label>
            <input style="width: 20px;s" class="inputnumber" name="number" type="text">
            <input  type="submit" hidden>

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

        </form>
    </div>
</div>

<script>
    function changeTag(n) {
        $.ajax({
            type: 'GET',
            url: '/changeBookTag/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#TagInfo").html(data.info);
            }
        });

    }
    function changeTagUpdate(n) {
        $.ajax({
            type: 'GET',
            url: '/changeBookTag/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#TagUpdateInfo").html(data.info);
            }
        });

    }
    function getInfo(n) {
        $.ajax({
            type: 'GET',
            url: '/getinfoB/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#bookName").html(data.book.name);
                $("#bookPub").html(data.book.Publication_date);
                $("#bookCreate").html(data.book.created_at);
                $("#bookUpdate").html(data.book.updated_at);
                $("#bookDes").html(data.book.description);
                $("#bookType").html(data.typeBookName);
                $("#bookTag").html(data.tagname);
                document.getElementById("bookImg").src = data.img;
                document.getElementById("downloadQr").download = data.book.name + "png";
                document.getElementById("QrCodeImg").src = data.QrCodeImg;
                document.getElementById("downloadQr").href = data.QrCodeImg;
            }
        });
    }
    function updateInfo(n) {
        $.ajax({
            type: 'GET',
            url: '/updateinfoB/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                document.getElementsByName('name')[0].value = data.book.name;
                document.getElementsByName('des')[0].value = data.book.description;
                document.getElementsByName('id')[0].value = data.book.id;
                document.getElementsByName('publication')[0].value = (data.year + "-" + data.month + "-" + data.day);
                document.getElementById("bookImgNow").src = data.img;
                document.getElementById('typeDefault').value = data.typeBookid;
                $("#TagUpdateInfo").html(data.tagname);
                 $("#TagUpdateInfo").html(data.tagname);
                $("#typeDefault").html(data.typeBookName);


            }
        });
    }
//    function updateInfoTest(n) {
//        $.ajax({
//            type: 'GET',
//            url: '/updateinfoB/' + n,
//            data: '_token = <?php echo csrf_token() ?>',
//            success: function (data) {
//                $("#info").html(data.info);
//            }
//        });
//    }
//    function updateB() {
//        function updatechange(id) {
//            var data = document.getElementById("ele" + id);
//            var name = document.getElementsByName('name')[0].value.toString();
//            var type = document.getElementsByName('type')[0].value.toString();
//            var date = document.getElementsByName('publication')[0].value.toString();
//            data.children[2].textContent = name;
//            data.children[3].textContent = type;
//        }
//        document.getElementById('msg').classList.remove("hidden");
//        document.getElementById('loading').style.display = "block";
//        var id = document.getElementsByName('id')[0].value;
//        var frm = $('#bookform');
//        $.ajax({
//            type: 'POST',
//            url: '/updateB',
//            data: frm.serialize(),
//            success: function (data) {
//                $("#msg").html(data.msg);
//            }
//        });
//        updatechange(id);
//
//    }
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
//    function insertB() {
//
//        var frm = $('#bookform');
//        $.ajax({
//            type: 'POST',
//            url: '/insertB',
//            data: frm.serialize(),
//            success: function (data) {
//                document.getElementById('msg').classList.remove("hidden");
//                $("#msg").html(data.msg);
//                $("#insert_line").html(data.insert_line);
//                    setTimeout(function () {
//                        location.reload();
//                    }, 2000);
//                }
//
//            }
//        });
//
//
//    }
    function updateB2() {
        function updatechange(id) {
            var data = document.getElementById("ele" + id);
            var name = document.getElementsByName('name')[0].value.toString();
            var type = document.getElementsByName('type')[0].value.toString();
            var date = document.getElementsByName('publication')[0].value.toString();
            data.children[2].textContent = name;
<?php
$type = DB::table('book_type')->get();
foreach ($type as $type) {
    ?>
                if (type == <?= $type->id ?>) {
                    data.children[3].textContent = "<?= $type->name ?>";
                }
    <?php
}
?>
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


    //    function getInfoTest(n) {
    //        $.ajax({
    //            type: 'GET',
    //            url: '/getinfoB/' + n,
    //            success: function (data) {
    //                $("#info").html(data.info);
    //            }
    //        });
    //    }
</script>
@stop
