<?php
// PM notes: remove login dummy after testing (for implementation)
session_start();
include('db_conn.php');
 if (isset($_SESSION['student_id']) && isset($_SESSION['bumail'])) {
   $id = $_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname'];
   $_GET['id'] = $id;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <meta name="HandheldFriendly" content="true">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png">
    <link rel="stylesheet" href="../css/student_css/bootstrap_msgbox.css">
    <link rel="stylesheet" href="../css/student_css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../css/student_css/style_msgbox.css">
    <script src="../js/bootstrap.min_msgbox.js"></script>
    <script src="../js/jquery.min_msgbox.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../js/bootstrap4.1.min_msgbox.js"></script>
    <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>
    <script type="text/javascript" src="../js/student_session_timer.js"></script>
    <title>Chat Us  | BUCEILS HS Online Voting System</title>
</head>

<body>
    <?php include "navStudent.php"; ?>
   

<body>

    <div class="cheader">
        <h3>MESSAGE BOX</h3>
    </div>
    <div class="ccontainer">
      <button id = "exit" class="btn cbtn-button2"  data-title="close" data-toggle="modal" data-target="#close"data-placement="top" data-toggle="tooltip" title="End Session"><span class="fa fa-times-circle"></span> END CHAT</button>
        <div class="messaging">
              <div class="inbox_msg">
        
                <div class="mesgs">

                  <div id="chatbox" class="msg_history">
                    
        
    
                    </div>

          <!-- Typing area -->
        <form autocomplete="off" method="post" class="bg-light">
            <div class="type_msg">
              <input id="usermsg" type="text" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-0 bg-light">
              <div class="input-group-append">
                <button id = "submitmsg" type="submit" class="msg_send_btn"><i class="fa fa-paper-plane"></i></button>
              </div>
            </div>
          </form>
                  </div>
        
                </div>
              </div>
            
          </div>
          <div class="modal fade" id="close" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading">Are you sure you want to end this chat?</h4>
          <div class="modal-footer ">
          <button type="button" class="btn btn-success" id="go" ><span class= "fa fa-check-circle"></span> Continue</button>
          <button type="button" class="btn btn-default" id= "cancel" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
        </div>
          </div>
        </div>
        <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
      </div>
      <br><br><br> <!-- footer distance - PM-->
          <!-- <div class="footer">
            <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
        </div>     -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript">
	var notclose = false;
        // jQuery Document 
                var rpt = "";
                $('#usermsg').focus();
                $("#submitmsg").click(function () {
		    notclose = true;
                    var clientmsg = $("#usermsg").val();
                    var idin = "<?php echo $_GET['id']?>";
                    $.post("./backStudent/Student_post.php", { text: clientmsg,idup: idin });
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

                              me += '<div class="incoming_msg">';
                              me += '<div class="received_msg">';
                              me += '<div class="received_withd_msg">';
                              me += '<p>'+each[1]+'</p>';
                              me += ' <span class="time_date">'+each[2]+' '+each[3]+'</span></div></div></div>';
                            }
                            else if(each[0]==1){
                              me += ' <div class="outgoing_msg">';
                              me += ' <div class="sent_msg">';
                              me += '<p>'+each[1]+'</p>';
                              me += '<span class="time_date">'+each[2]+' '+each[3]+'</span></div></div>';
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
                
                $("#go").click(function () {
                    var fle = "<?php echo $_GET['id']?>";  
                    $.ajax({
                    url: './backStudent/Student_endses.php',
                    type: 'post',
                    data: {isid:fle},
                    success: function(data) {
                    }
                    });
                    window.location = "Student_studDash.php";
                });
                
                
                window.addEventListener('beforeunload', function (e) {
                if(notclose == false){
                var fle = "<?php echo $_GET['id']?>";  
                $.ajax({
                url: './backStudent/Student_endses.php',
                type: 'post',
                data: {isid:fle},
                });
                //Delay
                var start = Date.now(), now = start;
                var delay = 500; // msec
                while (now - start < delay) {
                now = Date.now();
                }
                // this is needed to avoid to show a confirmation prompt
                delete e['returnValue'];
                }
                });
                
            </script>
</body>

</html>
<?php
}else{
	header("Location: ..\index.php");
     exit();
}
 ?>
