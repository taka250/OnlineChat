<?php
// 允许上传的图片后缀
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);

$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20480000)   // 小于 200 00kb
&& in_array($extension, $allowedExts))
{
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        die();
    }
    else
    {
        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        
        $uploaded_file='picture/'.$_FILES['file']['name'];
       
       

        if (is_uploaded_file($_FILES['file']['tmp_name'])){
            if(!move_uploaded_file($_FILES['file']['tmp_name'],$uploaded_file)){
                        echo "error:couldn't move";
            }
        }else{
            echo 'file attack';
        }
      
      
        }
    }

else
{
    echo "非法的文件格式".$_FILES["file"]["type"];
    die();
}
?>