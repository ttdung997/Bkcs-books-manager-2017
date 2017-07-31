<html>
   <head>
      <title>Ajax Example</title>
      
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
      
      <script>
         function getMessage(){
            $.ajax({
               type:'GET',
               url:'/getmsg',
               data:'_token = <?php echo csrf_token() ?>',
               success:function(data){
                  $("#msg").html(data.msg);
               }
            });
         }
         function test(){
         return confirm("Are you sure?")
            alert("test");
         }
      </script>
   </head>
   
   <body>
      <div id = 'msg'>This message will be replaced using Ajax. 
         Click the button to replace the message.</div>
      <?php
         echo Form::button('Replace Message',['onClick'=>'getMessage()']);
          
      ?>
       <a onclick="test()" href="/form">click me</a>
       <a href="/form" onclick="return confirm('bạn có chắc muốn xóa không?');">Delete</a>
   </body>

</html>