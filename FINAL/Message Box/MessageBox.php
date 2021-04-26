<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="icon" href="assets/img/buceils-logo.png">
    <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap4.3.1.min.css">
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>   
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <title> Message Box</title>
</head>
<body>
    <nav class="cnavie">
        <input id="nav-toggle" type="checkbox">
        <div class="logo">
            <h4>BUCEILS HS</h4>
            <h5>ONLINE VOTING SYSTEM</h5>
        </div>
        <label for="btn" class="icon"><span class="fa fa-bars"></span></label>
        <input type="checkbox" id="btn">
        <ul>
            <li>
                <label for="btn-1" class="show">ACCOUNTS</label>
                <a href="#">ACCOUNTS</a>
                <input type="checkbox" id="btn-1">
                <ul>
                    <li><a href="#">Students</a></li>
                    <li><a href="#">Admin</a></li>
                </ul>
            </li>
            <li>
                <label for="btn-2" class="show">ELECTION</label>
                <a href="#">ELECTION</a>
                <input type="checkbox" id="btn-2">
                <ul>
                    <li><a href="#">Archive</a></li>
                    <li><a href="#">Vote Status</a></li>
                    <li><a href="#">Vote Result</a>
                        <ul>
                            <li><a href="#">Make Report</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Configuration</a>
                    
                </ul>
            </li>
            <li><a href="#">CANDIDATES</a></li>
            <li>
                <label for="btn-4" class="show">LOGS</label>
                <a href="#">LOGS</a>
                <input type="checkbox" id="btn-4">
                <ul>
                    <li><a href="#">Access Log</a></li>
                    <li><a href="#">Activity Log</a></li>
                    <li><a href="#">Vote Summary</a></li>
                </ul>
            </li>
            <li><a href="#">MESSAGES</a></li>
            <li>
                <label for="btn-5" class="show">Admin Name</label>
                <a class="user" href="#"><img class="user-profile" src="assets/img/user.png"></a>
                <input type="checkbox" id="btn-5">
                <ul>
                    <li><a class="username" href="#">Admin Name</a></li>
                    <li class="logout">
                        <span class="fa fa-sign-out"></span><a href="#">LOGOUT</a></span>
                    </li>
                </ul>
            </li>
        </ul>
        <!--end of list-->
    </nav>
  <div class="ccheader">
    <h3>MESSAGE BOX</h3>
</div>
  <div class="container">  
    <div class="row rounded-lg overflow-hidden shadow">
      <!-- Users box-->
      <div class="col-5 px-0">
        <div class="bg-white">
  
          <div class="bg-gray px-4 py-1 bg-light" id="recent">
            <p class="h5 mb-0 py-2">Recent</p>
          </div>
          <div class="messages-box">
            <div class="list-group rounded-0">
            <?php
            $dir = '../user/msg';
            $files = scandir($dir);
            foreach($files as $open){
            if($open == "." || $open == ".." );
            else {
              $sname = explode(".", $open); 
              $file = file_get_contents("../user/msg/".$sname[0].".html");
              $rows = explode("##", $file);
              $rowsx = explode("||",$rows[0]);
              if(isset($rows[0])){
              echo   '<a href="MessageBox.php?id='.$sname[0].'" class="list-group-item list-group-item-action list-group-item-light rounded-0">                  
              <div class="media-body ml-4">
              <div class="d-flex align-items-center justify-content-between mb-1">
              <p class="cname">'.$sname[0].'</p><small class="small font-weight-bold">'.$rowsx[2]." ".$rowsx[3].'</small>
              </div>
              <p class="cmessage">'.$rowsx[1].'</p>  
              </div></a>
              ';
            }
            }
          }
            ?>
          
  
            </div>
          </div>
        </div>
      </div>
      <!-- Chat Box-->
      <div class="col-7 px-0">
        <div id = "chatbox" class="px-4 py-5 chat-box bg-white " ></div>
        <!-- Typing area -->
        <form method="POST" class="bg-light">
          <div class="input-group">
            <input  type="text" id= "usermsg" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light">
            <div class="input-group-append">
            <button id="button-addon2" type="submit" class="btn btn-link"> <i class="fa fa-paper-plane"></i></button>
            </div>
          </div>
        </form>
    
        </div>
      </div>
    </div>
    <div class="footer">
      <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
  </div>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript"> 
                var rpt = "";
                $('#usermsg').focus();
                $("#button-addon2").click(function () {
                    var clientmsg = $("#usermsg").val();
                    var idin = "<?php echo $_GET['id']?>";
                    $.post("apost.php", { text: clientmsg,idup: idin });
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
                              me +='<div class="media w-50 ml-auto mb-3" >';
                              me += '<div class="media-body">';
                              me += '<div class="bg-primary rounded py-3 px-3 mb-2"id="receive">';
                              me += '<p class="text-small mb-0 text-white">'+each[1]+'</p></div>';
                              me += '<p class="small text-muted">'+each[2]+' '+each[3]+'</p></div></div>';
                            }
                            else if(each[0]==1){
                              me += '<div class="media w-50 mb-3" alt="user" width="50" class="rounded-circle">';
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
         
                
        
 </body>

</html>