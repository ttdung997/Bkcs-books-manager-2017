@extends('layouts.check')
@extends('layouts.app')
@section('content')
 <script type="text/javascript" src="{{ URL::asset('js/QrCode/webqr.js') }}"></script>
 <link rel="stylesheet" href="{{ URL::asset('css/QrCode.css') }}">
</head>
<select name="choice" onchange="load()" class="form-control Qrform">
    <option value="1">Trả sách</option>
    <option value="2">Đăng kí mượn sách</option>
    <option value="3">Xem thông tin sách</option>
</select>
<div class="col-lg-12">
<div id="mainbody" style="display: inline;">
    <h1>Tiện ích QrCode</h1>
    <table class="tsel" border="0" width="100%">
        <tbody><tr>
                <td valign="top" align="center" width="50%">
                    <table class="tsel" border="0">
                        <tbody><tr>
                                <td><img class="selector" id="webcamimg" src="<?= URL::asset('images/vid.png') ?>" onclick="setwebcam()" align="left" style="opacity: 1;"></td>
                                <td><img class="selector" id="qrimg" src="<?= URL::asset('images/cam.png') ?>" onclick="setimg()" align="right" style="opacity: 0.2;"></td></tr>
                            <tr><td colspan="2" align="center">
                                    <div id="outdiv"><video id="v" autoplay="" src="blob:https://webqr.com/9e1096a7-592e-4c30-81f7-d0b61d283468"></video></div></td></tr>
                        </tbody></table>
                </td>
            </tr>
            <tr><td colspan="3" align="center">
                    <img src="<?= URL::asset('images/down.png') ?>">
                </td></tr>
            <tr><td colspan="3" align="center">
                    <div id="result">- đang đọc -</div>
                </td></tr>
        </tbody></table>
    <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- webqr_2016 -->
    <ins class="adsbygoogle" style="display: block; height: 90px;" data-ad-client="ca-pub-8418802408648518" data-ad-slot="2527990541" data-ad-format="auto" data-adsbygoogle-status="done"><ins id="aswift_0_expand" style="display:inline-table;border:none;height:90px;margin:0;padding:0;position:relative;visibility:visible;width:1200px;background-color:transparent"><ins id="aswift_0_anchor" style="display:block;border:none;height:90px;margin:0;padding:0;position:relative;visibility:visible;width:1200px;background-color:transparent"><iframe width="1200" height="90" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allowfullscreen="true" onload="var i = this.id, s = window.google_iframe_oncopy, H = s & amp; & amp; s.handlers, h = H & amp; & amp; H[i], w = this.contentWindow, d; try{d = w.document} catch (e){}if (h & amp; & amp; d & amp; & amp; (!d.body || !d.body.firstChild)){if (h.call){setTimeout(h, 0)} else if (h.match){try{h = s.upd(h, i)} catch (e){}w.location.replace(h)}}" id="aswift_0" name="aswift_0" style="left:0;position:absolute;top:0;width:1200px;height:90px;"></iframe></ins></ins></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>&nbsp;
</div>
<input name="token" type="hidden" value="<?= csrf_token() ?>">
<canvas id="qr-canvas" width="800" height="600" hidden style="width: 800px; height: 600px;"></canvas>
<script type="text/javascript">load();</script>


</body>
</html>
<script>
 function insertC() {

        var frm = $('#khachform');
        $.ajax({
            type: 'POST',
            url: '/insertC',
            data: frm.serialize(),
            success: function (data) {
                $("#result").html(data.msg);
            }
        });
    }
</script>
@stop