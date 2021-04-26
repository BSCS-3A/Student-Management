<?php
if(isset($_POST['text'])){
    $text = $_POST['text'];
    if($text != ""){
        $text_message = "0||".$text."||".date('h:i')."||".date('Y/m/d')."||read"."##\n";
        $file = "../user/msg/".$_POST['idup'].".html";
        file_put_contents($file, $text_message, FILE_APPEND | LOCK_EX);
    }
}
?>