<?php
session_start();
include("db_conn.php");
  if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <!-- <link rel="icon" href="assets/img/buceils-logo.png"> -->
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="../css/admin_css/style_msgBox.css">
    <link rel="stylesheet" href="../css/admin_css/bootstrap4.3.1.min_msgbox.css">
    <script src="../js/jquery-3.3.1.slim.min_msgbox.js"></script>
    <script src="../js/bootstrap.bundle.min_msgbox.js"></script>   
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="../js/admin_session_timer.js"></script>
    <!-- <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script> -->
    <title> Message Box  | BUCEILS HS Online Voting System</title>
</head>
<body>

  <?php include "navAdmin.php";?>

    <div class="ccheader">
    <h3 class="ccheader-txt">MESSAGE BOX</h3>
</div>
<?php
  $server = strtolower($_SERVER['HTTP_USER_AGENT']);
  $isMob = is_numeric(strpos($server, "mobile"));
  if($isMob && !strstr($_SERVER['HTTP_USER_AGENT'], 'iPad')){
    echo '<div class="alert alert-secondary" id="alert"><button type="button" class="close" data-dismiss="alert">x</button>
    You are using a mobile device! It is recommended to switch into landscape mode.</div>';
  }
?>

  <div class="container">  
  <div class="row rounded-lg overflow-hidden shadow" style="background-color:white">
      <!-- Users box-->
      <div class="col-5 px-0">
        <div class="bg-white">
  
          <div class="bg-gray px-4 py-1 bg-light" id="recent">
            <p class="h4 mb-0 py-2">Recent</p>
          </div>
          <div id ="take" class="messages-box">
            <div class="list-group rounded-0">
           
            <!-- message list-->
            <?php
            $dir = '../user/msg';
            $files = scandir($dir);
            foreach($files as $open){
            if($open == "." || $open == ".." );
            else {
              $sname = explode(".", $open); 
              $file = file_get_contents("../user/msg/".$sname[0].".html");
              $rows = explode("##", $file);
              $nm = count($rows);
              $rowsx = explode("||",$rows[$nm-2]);
              if(isset($rows[0]) && $rowsx[4] == "unread"){
              echo   '<a href="Admin_MBox.php?id='.$sname[0].'" class="list-group-item list-group-item-action list-group-item-light rounded-0" style="background-color:#1D6986;color:white">                  
              <div class="media-body ml-4" >
              <div class="d-flex align-items-center justify-content-between mb-1" >
              <p class="cname">'.$sname[0].'</p>
              </div>
              <p class="cmessage">'.$rowsx[1].'</p>
              <div class="float-sm-right">
              <small class="small font-weight-bold" >'.$rowsx[2]." ".$rowsx[3].'</small></div>  
              </div></a>
              ';
            }}}
            foreach($files as $open){
            if($open == "." || $open == ".." );
            else {
              $sname = explode(".", $open); 
              $file = file_get_contents("../user/msg/".$sname[0].".html");
              $rows = explode("##", $file);
              $nm = count($rows);
              $rowsx = explode("||",$rows[$nm-2]);
              if(isset($rows[0]) && $rowsx[4] == "read"){
                echo   '<a href="Admin_MBox.php?id='.$sname[0].'" class="list-group-item list-group-item-action list-group-item-light rounded-0">                  
                <div class="media-body ml-4">
                <div class="d-flex align-items-center justify-content-between mb-1">
                <p class="cname">'.$sname[0].'</p>                
                </div>
                <p class="cmessage">'.$rowsx[1].'</p>
                <div class="float-sm-right">
                <small class="small font-weight-bold" >'.$rowsx[2]." ".$rowsx[3].'</small></div>  
                </div></a>
                ';
             }}}
            ?>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script type="text/javascript"> 

            if(window.innerHeight < window.innerWidth){
            $("#alert").fadeTo(0,0);
            }
            window.addEventListener("orientationchange", function() {
            if(window.innerHeight > window.innerWidth){
            $("#alert").fadeTo(0,0);
            }
            else if(window.innerHeight < window.innerWidth){
            $("#alert").fadeTo(1,500);
            }
            }, false);
            
           setInterval(function loading(){
            $.ajax({
            url : './backStudent/Admin_load.php',
            type : 'POST',
            success : function (result) {
              document.getElementById("take").innerHTML = result;
            },
            });
            }, 1000);
            
            </script>
            <!-- message list-->
  
            </div>
          </div>
        </div>
      </div>
      <!-- Chat Box-->
      <div class="col-7 px-0">
        <div  class="sender">
        <?php 
        if(isset($_GET['id'])){
        echo "<h4 style='color: #124254'>".$_GET['id']."<h4/>";
        }
        ?>
        </div>
        <div id = "chatbox" class="px-4 py-1 chat-box bg-white " >
        
        </div>
        
        <!-- Typing area -->
        <form autocomplete="off" method="POST" class="bg-light">
          <div class="input-group">
          <div class="input-group pr-5 pl-3 py-1" id="type">
          <input  type="text" id= "usermsg" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 pb-2 mt-1 bg-light">
            <div class="input-group-append">
            <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript"> 
                var rpt = "";
                $('#usermsg').focus();
                $("#button-addon2").click(function () {
                    var clientmsg = $("#usermsg").val();
                    var idin = "<?php echo $_GET['id']?>";
                    $.post("./backStudent/Admin_apost.php", { text: clientmsg,idup: idin });
                    $("#usermsg").val("");
                });
                
                    function loadLog(){
                    clearInterval(rpt);
                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
                    var sender = "<?php echo "../user/msg/".$_GET['id'].".html"?>";
                    $.ajax({
                        url: sender,
                        cache: false,
                        success: function (html) {
                          var res = html.split("##");
                          var me = '';
                          for(i = 0 ; i<res.length-1;i++){
                            var each = res[i].split("||");
                            if(each[0]==0){
                              me +='<div class="media w-50 ml-auto mb-3" id="box">';
                              me += '<div class="media-body">';
                              me += '<div class="bg-primary rounded py-3 px-3 mb-2"id="receive">';
                              me += '<p class="text-small mb-0 text-white">'+each[1]+'</p></div>';
                              me += '<p class="small text-muted">'+each[2]+' '+each[3]+'</p></div></div>';
                            }
                            else if(each[0]==1){
                              me += '<div class="media w-50 mb-3" alt="user" width="50" class="rounded-circle" id="box">';
                              me += '<div class="media-body ml-3">';
                              me += '<div class="bg-light rounded py-3 px-3 mb-2">';
                              me += '<p class="text-small mb-0 text-muted">'+each[1]+'</p></div>';
                              me += '<p class="small text-muted">'+each[2]+' '+each[3]+'</p></div></div>';
                            }
                          }
                          $("#chatbox").html(me);
                          rpt = setInterval (loadLog, 10);
                            //$("#chatbox").html(html); //Insert chat log into the #chatbox div
                              
                            //Auto-scroll           
                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                            if(newscrollHeight > oldscrollHeight){
                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 20); //Autoscroll to bottom of div
                            }   
                        }
                    });
                }

               rpt = setInterval (loadLog, 10);
                
                </script>
    </div>
    <br><br><br><br>
 </body>

</html>
<?php
}else{
    header("Location: AdminLogin.php");
     exit();
}
 ?>
