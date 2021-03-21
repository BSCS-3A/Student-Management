<?php
session_start();
$file = "chats/".$_POST['isid'].".html";
unlink($file);
?>