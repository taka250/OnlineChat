<?php
session_start();
if(!isset($_SESSION['chatname'])){
  echo "<script>location.href='login.php'</script>";
  die();
}
require_once('class_cof.php');?>

<!DOCTYPE html>
<html>

<head>

<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js">
</script>

    <meta charset="utf-8">
    <title>tk提供的聊天室</title>

</head>

<body  background="img/moroccan-flower.png"   >
    <ul>
        <li><img src='/img/tk.jpg' alt='杰哥不要啊'></li>
        <li><a href="javascript:void(alert('此功能尚在开发，敬请期待!'))">个人信息界面</a></li>
        <li><a href="javascript:void(alert('此功能尚在开发，敬请期待!'))">好友名单</a></li>
        <li><a href="login_out.php">登出</a></li>
    </ul>

    <div class="public_chat_show">
        <?php
            include 'content.php';
        ?>
    </div>
    <form action='' method='post'>
        <!--post要发送的内容-->
        <lable>请输入发送的内容</lable>
        <input type='text' name='public_say'>
        <input type='submit' name='public_sub' value='发送'>
    </form>
    <div class='tk'>
  <form action="" method="post" enctype="multipart/form-data">
    <label for="file">请上传图片：</label>
    <input type="file" name="file" id="file"value='选择图片'>
    <input type="submit" name="file_submit" value="发送图片">
</form></div>

    <?php //将要发送的内容insert到对应的表中
  if(isset($_POST['public_sub']))
    {
      $saycontent = test_input($_POST['public_say']);
      $sayname = $_SESSION['chatname'];
      $saytime = date("Y-m-d H:i:s");
      $hehehe=123134590234;  
      $sql_arr = require '../code/configdb.php';
        $sql_host = $sql_arr['sql_host'];
        $sql_lname = $sql_arr['sql_lname'];
        $sql_lpass = $sql_arr['sql_lpass'];
        $sql_dbname = $sql_arr['sql_dbname'];
        $sql_charset  = $sql_arr['sql_charset'];
        $user_con=new mysqli($sql_host,$sql_lname,$sql_lpass,$sql_dbname);
        $stmt = $user_con->prepare("insert into public(sayname,saycontent,hehehe,saytime)values(?,?,?,?)");
        $stmt->bind_param('ssss', $sayname, $saycontent,$hehehe,$saytime);
        $stmt->execute();
        if($stmt->affected_rows<=0){
          echo 'error';
          die();
      }}
      if(isset($_POST['file_submit']))
    {
      require_once('upload.php');
      $sayname = $_SESSION['chatname'];
      $saytime = date("Y-m-d H:i:s");
      $hehehe='picture';  
      $sql_arr = require '../code/configdb.php';
        $sql_host = $sql_arr['sql_host'];
        $sql_lname = $sql_arr['sql_lname'];
        $sql_lpass = $sql_arr['sql_lpass'];
        $sql_dbname = $sql_arr['sql_dbname'];
        $sql_charset  = $sql_arr['sql_charset'];
        $user_con=new mysqli($sql_host,$sql_lname,$sql_lpass,$sql_dbname);
        $stmt = $user_con->prepare("insert into public(sayname,saycontent,hehehe,saytime)values(?,?,?,?)");
        $content=$_FILES['file']['name'];
        $stmt->bind_param('ssss', $sayname, $content,$hehehe,$saytime);
        $stmt->execute();
        if($stmt->affected_rows<=0){
          echo 'error';
          die();
      }}
   
    ?>
    <script type="text/javascript">
    $(function() {
        function getmsg() {
            $.ajax({
                url: 'content.php',
                async: 'true',
                cache: 'false',
                success: function(data) {
                    $('.public_chat_show').html(data);
                }
            });
        }
        //定时获取数据
        setInterval(getmsg, 1000);

    })
    </script>
    
</body>

</html>

 <!--网页动态背景——随鼠标变换的动态线条-->
 <script type="text/javascript" src="https://cdn.bootcss.com/canvas-nest.js/1.0.1/canvas-nest.min.js"></script>
   <script src="https://eqcn.ajz.miesnfu.com/wp-content/plugins/wp-3d-pony/live2dw/lib/L2Dwidget.min.js"></script>
   <script>
     L2Dwidget.init({
       "model": {
         jsonPath: "https://unpkg.com/live2d-widget-model-koharu@1.0.5/assets/koharu.model.json",
         "scale": 1
       },
       "display": {
         "position": "right",
         "width": 150,
         "height": 300,
         "hOffset": 0,
         "vOffset": -20
       },
       "mobile": {
         "show": true,
         "scale": 0.5
       },
       "react": {
         "opacityDefault": 0.7,
         "opacityOnHover": 0.2
       }
     });
     console.log(L2Dwidget)
   </script>
    