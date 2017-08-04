@extends('layouts.check')
@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    <div id="msg"  class="alert alert-success  hidden">


    </div>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <br>

    <button type="button" class="btn btn-primary" data-pjax="0" data-toggle="modal" data-target="#myInsertModal">Thêm đầu sách</button>
    <a  type="button" class="btn btn-primary" data-pjax="0" data-toggle="modal" data-target="#myExcelModal">Xuất dữ liệu </a>
    <a  type="button" class="btn btn-primary" data-pjax="0" data-toggle="modal" data-target="#mySortModal">Bộ lọc</a>

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
                    <a href="#" data-sort="id">Tên khách hàng</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Tên sách</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Ngày mượn</a>
                </th>
                <th>
                    <a href="#" data-sort="id">NgàyTrả</a>
                </th>
                <th>
                    <a href="#" data-sort="id">Trạng thái</a>
                </th>
                <th class="action-column">&nbsp;</th>
                <th class="action-column">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php
            foreach ($deal as $deal) {
                $customer = DB::table('customer')->where('id', $deal->customer_id)->first();
                $book = DB::table('book')->where('id', $deal->book_id)->first();
                ?>
                <tr data-key="<?= $i ?>" id="ele<?= $deal->id ?>">
                    <td><?= $i ?></td>
                    <td><?= $customer->name ?> <button onclick="getInfoC(<?= $customer->id ?>)" class="btn btn-primary" data-toggle="modal" data-target="#myCustomerModal">Chi tiết</button></td>
                    <td><?= $book->name ?> <button onclick="getInfoB(<?= $book->id ?>)" class="btn btn-primary" data-toggle="modal" data-target="#myBookModal">Chi tiết</button></td>
                    <td><?= $deal->lend_date ?></td>
                    <td><?= $deal->give_date ?></td>
                    <?php
                    if ($deal->status == 0)
                        echo "<td>Đã trả</td>"
                        . '<td><button class="btn btn-primary">Hoàn thành</button>';
                    else
                        echo "<td>Chưa trả</td>"
                        . ' <td><button class="btn btn-primary" onclick="DealEnd(' . $deal->id . ')">Trả sách</button></td>';
                    ?>

                    <td onmouseenter="an()">
                        <a onclick="getInfo(<?= $deal->id ?>)" aria-label="View" data-pjax="0" data-toggle="modal" data-target="#myViewModal">
                            <span style="color: #337ab7" class="glyphicon glyphicon-eye-open">
                            </span>
                        </a>  <a onclick="updateInfo(<?= $deal->id ?>)" title="Update" aria-label="Update" data-pjax="0" data-toggle="modal" data-target="#myUpdateModal">
                            <span style="color: #337ab7" class="glyphicon glyphicon-pencil">
                            </span>
                        </a> <a onclick="deleteD(<?= $deal->id ?>)" data-method="post" data-pjax="0">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="mySortModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Xuất dữ liệu theo tháng</h4>

                </div>
                <div class="modal-body">
                    <br>
                    <form  action="/sortby" method="get">
                        <div class="form-group form-model2">
                            <label for="chọn sách">Chọn loại</label>
                            <select class="form-control" name="type">
                                <!--        <option value="book_name">Tên sách</option>
                                        <option value="customer_name">Tên khách hàng</option>-->
                                <option value="lend_date">Ngày đặt sách</option>
                                <option value="status">Trạng thái</option>
                            </select>
                        </div>
                        <div class="form-group form-model2">
                            <label for="chọn sách">Chọn kiểu</label>
                            <select class="form-control"  name="sort">
                                <option value="ASC">Tăng dần</option>
                                <option value="DESC">Giảm dần</option>
                            </select>
                        </div>
                        <div class="form-group form-model2">
                            <label for="chọn sách">Chọn trang</label>
                            <select class="form-control" name="page">
                                <?php
                                for ($i = 1; $i <= intval(($count - 1) / 5) + 1; $i++) {
                                    ?>
                                    <option value="<?= $i ?>">Trang <?= $i ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn btn-primary cratebutton" type="submit">Lọc</button>
                    </form>
                    <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " data-dismiss="modal">Thoát</button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myExcelModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Xuất dữ liệu theo tháng</h4>

                </div>
                <div class="modal-body">
                    <br>
                    <form action="/CustomerExport" method="post" accept-charset = "UTF-8" class = "form" >
                        <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                        <div class="form-group form-model2">
                            <label for="chọn sách">Chọn tháng</label>
                            <select required="" class="form-control" name="month">
                                <?php
                                for ($i = 1; $i < 13; $i++) {
                                    ?>
                                    <option value="<?= $i ?>">Tháng <?= $i ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group form-model2">
                            <label for="chọn sách">Chọn Năm</label>
                            <select required="" class="form-control" name="year">
                                <option value="2016"> Năm 2016 </option>
                                <option value="2017"> Năm 2017</option></select>

                        </div>
                        <button type="submit" class="btn btn-primary cratebutton" >Xuất dự liệu</button>
                    </form>
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
                    <h4 class="modal-title">Sửa giao dịch</h4>

                </div>
                <div class="modal-body">
                    <form id = "Dealform" accept-charset = "UTF-8" class = "form" >
                        <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>">
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">

                        <input name="id" type="hidden">
                        <div class="form-group form-model2">
                            <label for="ngày mượn">Ngày Mượn</label>
                            <input class="form-control" name="lend_date" type="date">

                        </div>
                        <div class="form-group form-model2">
                            <label for="ngày trả">Ngày Trả</label>
                            <input class="form-control" name="give_date" type="date">
                        </div>
                        <div class="form-group form-model2">
                            <button class="btn btn-primary cratebutton" onclick="updateD()" data-dismiss="modal">chỉnh sửa</button>
                        </div>
                    </form>
                    <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myInsertModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Thêm giao dịch</h4>

                </div>
                <div class="modal-body">
                    <?php
                    $book = DB::table('book')->where('check', '0')->get();
                    $customer = DB::table('customer')->where('BookNumber', '<', '3')->get();
                    ?>
                    <form id="Dealforminsert" accept-charset="  UTF-8" class="form" >
                        <input name="_token" type="hidden" value="<?= csrf_token() ?>">
                        <input name = "_token" type = "hidden" value = "<?= csrf_token() ?>" >
                        <div class = "form-group form-model2">
                            <label for = "chọn sách">Chọn khách hàng</label>
                            <select required = "" class = "form-control" name = "customer_id">
                                <?php foreach ($customer as $customer) { ?>
                                    <option value = "<?= $customer->id ?>"><?= $customer->name ?> </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class = "form-group form-model2">
                            <label for = "chọn sách">Chọn Sách</label>
                            <select required = "" class = "form-control" name = "book_id">';

                                <?php foreach ($book as $book) {
                                    ?>
                                    <option value = <?= $book->id ?>><?= $book->name ?> </option>
                                    <?php
                                }
                                ?>
                                $info = $info . '</select>
                        </div>
                        <div class = "form-group form-model2">
                            <label for = "ngày mượn">Ngày Mượn</label>
                            <input class = "form-control" name = "Lend_date" type = "date" value = <?= date("Y-m-d") ?> >

                        </div>
                        <div class = "form-group form-model2">
                            <label for = "ngày trả">Ngày Trả</label>
                            <input class = "form-control" name = "Pay_date" type = "date" value = <?= date("Y-m-d") ?> >
                        </div>
                        <div class = "form-group form-model2">
                            <button class = "btn btn-primary cratebutton" onclick = "insertD()" data-dismiss = "modal">Thêm giao dịch</button>
                        </div>
                    </form>
                    <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="myCustomerModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Xem thông tin người dùng</h4>

                </div>
                <div class="modal-body">
                    <div class="form-group form-model">
                        <label for="Tên khách hàng">Tên Khách Hàng</label>
                        <p id="infoShow"><span id="customerNameC"></span></p></div>
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
                <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="myBookModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                <h4 class="modal-title">Thông tin sách/h4>

            </div>
            <div class="modal-body">
                <div class="form-group form-model">
                    <label for="Tên khách hàng">Tên sách</label>
                    <p id="infoShow"><span id="bookNameB"></span></p></div>
                <div class="form-group form-model">
                    <label for="số điện thoại">loại sách</label>
                    <p id="infoShow"><span id="bookType"></span></p></div>
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
<div class="modal fade" tabindex="-1" role="dialog" id="myViewModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Thông tin giao dịch</h4>

            </div>
            <div class="modal-body">
                <div class="form-group form-model">
                    <label for="Tên khách hàng">Tên Khách Hàng</label>
                    <p id="infoShow"><span id="customerName"></span> 
                </div>
                <div class="form-group form-model">
                    <label for="chọn sách">Tên Sách</label>
                    <p id="infoShow"><span id="bookName"></span>
                </div>
                <div class="form-group form-model">
                    <label for="ngày mượn">Ngày Mượn</label>
                    <p id="infoShow"><span id="lend_date"></span> </p></div>
                <div class="form-group form-model">
                    <label for="ngày trả">Ngày Trả</label>
                    <p id="infoShow"><span id="give_date"></span> </p></div>
                <div class="form-group form-model">
                    <label for="ngày trả">Ngày Trả Thực tế</label>
                    <p id="infoShow"><span id="given_date"></span> </p>
                    <div class="form-group form-model">
                        <label for="ngày trả">Trạng thái</label>
                        <p id="infoShow"><span id="status"></span> </p></div>
                    <div class="form-group form-model">
                        <label for="ngày mượn">Ngày Tạo</label>
                        <p id="infoShow"><span id="CreateDate"></span> </p></div>
                    <div class="form-group form-model">
                        <label for="ngày trả">Ngày Cập Nhật</label>
                        <p id="infoShow"><span id="UpdateDate"></span> </p></div>

                    <img id="loading" style="display: none;padding-left: 26%;" src="{{URL::asset('images/loading.gif')}}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>
<div class="pagenavi">
    <form action="/pageNumberD" method="get">

        <label>Trang: </label>
        <input style="width: 20px;" class="inputnumber" name="number" type="text">
        <input  type="submit" hidden>
        <input  type="text" value="<?= $name ?>" name="name" hidden>
        <input  type="text" value="<?= $id ?>" name="id" hidden>
        <b class="pages">Trang <?= $page ?> / <?= intval(($count - 1) / 5) + 1 ?></b>
        <?php if ($page != 1) { ?><a class="paginate_button previous disabled" href="/<?= $link ?><?= $page - 1 ?>">« Trước</a><?php } ?>
        <?php
        for ($i = $page - 1; $i <= $page - 1; $i++) {
            if ($i <= 0)
                continue;
            ?>
            <a class="paginate_button" href="/<?= $link ?><?= $i ?>"><?= $i ?></a>
        <?php } ?>
        <b class="paginate_button current"><?= $page ?></b>
        <?php
        for ($i = $page + 1; $i < $page + 2; $i++) {
            if ($i > intval(($count - 1) / 5) + 1)
                break;
            ?>
            <a class="paginate_button" href="/<?= $link ?><?= $i ?>"><?= $i ?></a>
        <?php } ?>
        <?php if ($page != intval(($count - 1) / 5) + 1) { ?><a class="paginate_button previous disabled" href="/<?= $link ?><?= $page + 1 ?>" >Sau »</a><?php } ?>

    </form>

</div>
</div>
<script>
    function getInfoC(n) {
        $.ajax({
            type: 'GET',
            url: '/getinfoC/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#customerNameC").html(data.user.name);
                $("#customerPhone").html(data.user.phone_number);
                $("#customerCmt").html(data.user.cmt);
                $("#customerBN").html(data.user.BookNumber);
                $("#customerCreate").html(data.user.created_at);
                $("#customerUpdate").html(data.user.updated_at);
            }
        });
    }
    function getInfoB(n) {
        $.ajax({
            type: 'GET',
            url: '/getinfoB/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#bookNameB").html(data.book.name);
                $("#bookPub").html(data.book.Publication_date);
                $("#bookCreate").html(data.book.created_at);
                $("#bookUpdate").html(data.book.updated_at);
                $("#bookDes").html(data.book.description);
                $("#bookType").html(data.typeBookName + ' / ' + data.tagname);
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
            url: '/updateinfoD/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                document.getElementsByName('lend_date')[0].value = (data.yearl + "-" + data.monthl + "-" + data.dayl);
                document.getElementsByName('give_date')[0].value = (data.yearg + "-" + data.monthg + "-" + data.dayg);
                document.getElementsByName('id')[0].value = (data.id);
            }
        });
    }
    function updateD() {
        function updatechange(id) {
            var data = document.getElementById("ele" + id);
            var Ldate = document.getElementsByName('lend_date')[0].value.toString();
            var Gdate = document.getElementsByName('give_date')[0].value.toString();
            data.children[3].textContent = Ldate;
            data.children[4].textContent = Gdate;
        }
        document.getElementById('loading').style.display = "block";
        document.getElementById('msg').classList.remove("hidden");
        var id = document.getElementsByName('id')[0].value;
        var frm = $('#Dealform');
        $.ajax({
            type: 'POST',
            url: '/updateD',
            data: frm.serialize(),
            success: function (data) {
                $("#msg").html(data.msg);
                if (data.checkerror == 1) {
                    document.getElementById('msg').classList.remove("alert-success");
                    document.getElementById('msg').classList.add("alert-danger");
                }
            }
        });
        updatechange(id);
    }
    function getInfo(n) {
        $.ajax({
            type: 'GET',
            url: '/getinfoD/' + n,
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#bookName").html(data.bookName);
                $("#customerName").html(data.customerName);
                $("#status").html(data.status);
                $("#given_date").html(data.given_date);
                $("#lend_date").html(data.deal.lend_date);
                $("#give_date").html(data.deal.give_date);
                $("#CreateDate").html(data.deal.created_at);
                $("#UpdateDate").html(data.deal.updated_at);
            }
        });
    }
    function insertDeal() {
        $.ajax({
            type: 'GET',
            url: '/insertDeal',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                $("#info").html(data.info);
            }
        });
    }
    function insertD() {

        var frm = $('#Dealforminsert');
        $.ajax({
            type: 'POST',
            url: '/insertD',
            data: frm.serialize(),
            success: function (data) {
                document.getElementById('msg').classList.remove("hidden");
                $("#msg").html(data.msg);
                $("#insert_line").html(data.insert_line);
                setTimeout(function () {
                    location.reload();
                }, 100);
            }
        });
    }
    function deleteD(n) {
        if (confirm("Bạn có chắc muốn xóa bản ghi") == true) {
            $.ajax({
                type: 'GET',
                url: '/deleteD/' + n,
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    $("#msg").html(data.msg);
                    document.getElementById('msg').classList.remove("hidden");
                }
            });
            document.getElementById("ele" + n).remove();

        }

    }
    function an() {
        document.getElementById('loading').style.display = "none";
        document.getElementById('msg').classList.add("hidden");
        document.getElementById('msg').classList.add("alert-success");
        document.getElementById('msg').classList.remove("alert-danger");
    }
    function DealEnd(n) {
        if (confirm("Bạn có chắc muốn xóa trả sách") == true) {
            $.ajax({
                type: 'GET',
                url: '/DealEnd/' + n,
                data: '_token = <?php echo csrf_token() ?>',
                success: function (data) {
                    $("#msg").html(data.msg);
                    var data = document.getElementById("ele" + n);
                    data.children[5].textContent = 'Đã trả';
                    document.getElementById('msg').classList.remove("hidden");
                }
            });

        }
    }
</script>
@stop