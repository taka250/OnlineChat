<?php
require_once'class_cof.php';
$out = new con();
$out_sql = "SELECT * FROM (select * from public ORDER BY id DESC LIMIT 15)aa order by id";
$out_query = $out->query($out_sql);
echo "<ul>";
while($out_arr = mysqli_fetch_assoc($out_query)){
$raw=$out_arr['saycontent'];
if($out_arr['hehehe']==='picture'){
echo "<li><b>{$out_arr['sayname']}</b><small>{$out_arr['saytime']}</small><br><img src='picture/{$out_arr['saycontent']}' height='200' width='200'></li>";
}else{
echo "<li><b>{$out_arr['sayname']}</b><small>{$out_arr['saytime']}</small><br><span >{$out_arr['saycontent']}</span></li>";}
}   
echo "</ul>";
?>