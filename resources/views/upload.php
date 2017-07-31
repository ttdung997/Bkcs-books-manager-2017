<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
<script>
//    navigator.getUserMedia = navigator.getUserMedia ||
//            navigator.webkitGetUserMedia ||
//            navigator.mozGetUserMedia;
//    
//    if (navigator.getUserMedia) {
//        navigator.getUserMedia({audio: true, video: {width: 1280, height: 720}},
//                function (stream) {
//                    var video = document.querySelector('video');
//                     if (window.webkitURL) {
//        video.src = window.webkitURL.createObjectURL(stream);
//    } else {
//        video.src = stream;
//    }
//                    video.srcObject = stream;
//                    video.onloadedmetadata = function (e) {
//                        video.play();
//                    };
//                },
//                function (err) {
//                    console.log("The following error occurred: " + err.name);
//                }
//        );
//    } else {
//        console.log("getUserMedia not supported");
//    }
navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

var constraints = {audio: false, video: true};
var video = document.querySelector("video");

function successCallback(stream) {
  window.stream = stream; // stream available to console
  if (window.URL) {
    video.src = window.URL.createObjectURL(stream);
  } else {
    video.src = stream;
  }
}

function errorCallback(error){
  console.log("navigator.getUserMedia error: ", error);
}

navigator.getUserMedia(constraints, successCallback, errorCallback);
</script>
<video id="video" width="160" height="120" autoplay></video><br>
<div id="div"></div>