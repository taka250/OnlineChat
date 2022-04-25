<?php
session_start();
unset($_SESSION['chatname']);
echo "<script>location.href='login.php'</script>";
?>