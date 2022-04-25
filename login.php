<?php
SESSION_start();
if(isset($_SESSION['chatname'])) //如果已经有记录则直接跳转到聊天界面
{
    echo "<script>location.href='index.php'</script>";
    die();
}
require('class_cof.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width",initial->
    <link rel="stylesheet" href="//at.alicdn.com/t/font_1803712_190aham4mrt.css">
    <link rel="stylesheet" href="style.css">
    <title>LOGIN</title>
</head>
<body background="img/moroccan-flower-dark.png"  title="tupian"></body>>
<form action='' method='post'>
<div class="form-wrapper">

    <div class="header">
        login
    </div>
    <div class="input-wrapper">
    <div class="border-wrapper">
        <input type="text" name="username" placeholder="username" class="border-item" id="username">
    </div>
        <div class="border-wrapper">
            <input  id ="password" type="text" name="password" placeholder="password" class="border-item">
        </div>
    </div>

<div class="action">
    <input   class="btn" type='submit' name='button' value='login'><br/>
    <a href="register.php"><font color="#FF0000">没有账号?立即注册</font>
</a>
</div>

<div class="icon-wrapper">
        <i class="iconfont icon-weixin"></i>
        <i class="iconfont icon-weibo"></i>
        <i class="iconfont icon-github"></i>
</div>
</div>
</form>
</body>
</html>

  
   <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
   <script type="text/javascript">
       /* 鼠标特效 */
       var a_idx = 0;
       jQuery(document).ready(function($) {
           $("body").click(function(e) {
               var a = new Array("❤滕凯哥哥好帅❤","❤我的网站不可能有洞❤","❤前端太有意思了❤","❤欢迎骚扰❤","❤点我试试❤","❤你贼帅❤","❤呵呵❤","❤哈哈啊❤","❤web真难玩❤","❤别点啦❤","❤别再点啦❤","❤再点一下试试❤","❤点你咋滴❤","❤好玩么❤","❤溜了溜了❤");
               var $i = $("<span></span>").text(a[a_idx]);
               a_idx = (a_idx + 1) % a.length;
               var x = e.pageX,
               y = e.pageY;
               $i.css({
                   "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
                   "top": y - 20,
                   "left": x,
                   "position": "absolute",
                   "font-weight": "bold",
                   "color": "rgb("+~~(255*Math.random())+","+~~(255*Math.random())+","+~~(255*Math.random())+")"
               });
               $("body").append($i);
               $i.animate({
                   "top": y - 180,
                   "opacity": 0
               },
               1500,
               function() {
                   $i.remove();
               });
           });
       });
       </script>
       
<?php
    if(isset($_POST['button']))
        {
             $chatname=trim($_POST['username']);
             $chatpw=trim($_POST['password']);
             if(empty($chatname)||empty($chatpw)){
                echo "<script>alert('请输入')</script>";
                die();
             }
       
             $login_check=new chat();
             $login_results_1=$login_check->yz_chatname($chatname);
             
             if($login_results_1===2){//如果是老用户
                $user_con=new con();
                $user_con_sql="select password from user where username = '{$chatname}'";
                $user_con_result=$user_con->query($user_con_sql);
                $user_pw=mysqli_fetch_array($user_con_result,MYSQLI_ASSOC);


                if (!password_verify($chatpw, $user_pw['password'])){
                    echo "<script>alert('密码错误')</script>";
                    die();
                }
                
                if(!$user_con_sql){
                    die("hacker!");
                }
                $session_id=$_SESSION['chatname']=$chatname;
                if(!$session_id)
                {
                    die("hacker!");
                }
                echo "<script>location.href='index.php'</script>";
            }
            elseif($login_results_1===1){//如果是新用户
                echo "<script>alert('此用户不存在')</script>";
                echo "<script>location.href='login.php'</script>";
            }
            elseif($login_results_1===3){
                echo "<script>alert('用户名长度应小于等于11')</script>";
                die();
            }
            elseif($login_results_1===4){
                echo "<script>alert('用户名不能包含除了_的特殊字符')</script>";
                die();
            }
        
        
    }

?>
