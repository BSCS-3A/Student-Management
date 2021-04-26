<?php
session_start();
$file = "../user/msg/".$_POST['isid'].".html";
unlink($file);
?>