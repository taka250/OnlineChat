<?php //从网上找的简单封装数据库类 自己改了下

error_reporting(0);
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
//简单封装数据库类
class con{
private $sql_host;
private $sql_lname;
private $sql_lpass;
private $sql_dbname;
private $sql_charset;
public $connect;
public $select_db;
public $sql_arr;
public $query_sql;
public $query_results;
//连接数据库
public function __construct(){
//引入文件赋值给$this->sql_arr
$this->sql_arr = require '../code/configdb.php';
//判断是否引入成功
if(!$this->sql_arr){
die('获取数据库信息失败');
}
//引入成功后开始赋值
$this->sql_host = $this->sql_arr['sql_host'];
$this->sql_lname = $this->sql_arr['sql_lname'];
$this->sql_lpass = $this->sql_arr['sql_lpass'];
$this->sql_dbname = $this->sql_arr['sql_dbname'];
$this->sql_charset  = $this->sql_arr['sql_charset'];
$this->connect = mysqli_connect($this->sql_host,$this->sql_lname,$this->sql_lpass);
if(!$this->connect){
die('数据库连接失败');
} 
$this->select_db = mysqli_select_db($this->connect,$this->sql_dbname);
if(!$this->select_db){
die('数据库选择失败');
}
mysqli_query("set names {$this->sql_charset}");
}
//简单操作类
public function query($query_sql){
$this->query_sql = $query_sql;
if(empty($this->query_sql)){
die('没有传入值');
}
$this->query_results = mysqli_query($this->connect,$this->query_sql);
if(!$this->query_results){
die('数据库错误');
}
return $this->query_results;
}
public function __destruct(){
if($this->connect){
mysqli_close($this->connect);
}
}
}
//构造聊天室操作类
class chat{
public $chatname;
public $yz_chatname;
//验证session用户名是否存在
public function yz_chatname($chatname){
$this->chatname = $chatname;
if(empty($this->chatname)){
return 0;
}
if(strlen($this->chatname) > 10){
return 3;
}
$regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\(|\)|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\||\s+/";
if(preg_match($regex, $this->chatname)){
return 4;
}
$sql_jc = new con();
$sql_sql = "select * from user where username = '{$this->chatname}'";
$sql_result = $sql_jc->query($sql_sql);
if(mysqli_num_rows($sql_result) >= 1){//如果存在记录这说明不是新用户
return 2;
}else {
return 1;
}
}

}
?>
