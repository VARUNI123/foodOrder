<?php
session_start();
unset($_SESSION['userid']);
unset($_SESSION['user_name']);
header("location:http://localhost/fprjct/index.php");
?>