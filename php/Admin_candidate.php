<!-- 
    proj mngr notes:
    - changed navigation barr
    - changed db_conn
    - change photo fix
    - fix responsiveness table


   OKE - delete previous photo when changed 
    - 1:1 ratio requirement of photo size
    - change echo something

    - den: fix layout candidate view

-->

<!DOCTYPE html>
<?php 
    include "db_conn.php";
    session_start();
    if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])){
        $idletime=900;//after 15 minutes the user gets logged out

        if (time()-$_SESSION['timestamp']>$idletime){
            $_GET['inactivityError'] = "Session ended: You are logged out due to inactivity.";
            header("Location: AdminLogout.php");
        }else{
            $_SESSION['timestamp']=time();
        }
    }else{ 
        header("Location: AdminLogin.php");
        exit();
    }
    
   

?> 
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta charset="utf-8">
    <link rel="icon" href="../img/BUHS LOGO.png" type="image/png"> 
    <link rel="stylesheet" type="text/css" href="../css/admin_css/admin_Pos.css">
    <link rel="stylesheet" href="../css/admin_css/bootstrap_Pos.css"> 
    <link rel="stylesheet" href="../css/admin_css/font-awesome.css">
    <link rel="stylesheet" href="https://unpkg.com/simplebar@2.0.1/umd/simplebar.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    

     
    <!-- <script src="assets/js/a076d05399.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/jQuery.dataTables.min_Pos.js"></script>
    <!-- <script src="../js/jquery.dataTables.min_studAcc.js"></script> -->
    <script src="../js/bootstrap.min_Pos.js"></script> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" crossorigin="anonymous">
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
    <link type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js">
    <script src="../js/cropper.js"></script>

    <!-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script> -->
    
    <script>
    $(document).ready(function(){
        //adding candidate
        reloadTable();

        $(document).on("click","#add-candidate",function(){
            var temp = true;
            $.ajax({
            url:'backCandidate/addCandidate.php',
            method:'post',
            data:{dropdownadd:temp},
            success:function(response){
              $("#position-add").html(response);
            }
          });
        });
        $("#addform").submit(function(e){
            $("#add").modal("hide");
            e.preventDefault();
            var temp = true;
            var lname = $("#lastnamesearch").val();
            var fname = $("#firstnamesearch").val();
            var hid = $("#position-add option:selected").val();
            var party = $("#etc-add1").val();
            var plat = $("#etc-add2").val();
            var cred = $("#etc-add3").val();

            $.ajax({
              url:'backCandidate/addCandidate.php',
              method:'post',
              data:{savebtn:temp,lastname:lname,firstname:fname,heirarchy_id:hid,partylist:party,platform:plat,credentials:cred},
              success:function(response){
                  formClear();
                  if(response !=""){
                      alert(response);
                  }else{
                      table.destroy();
                      reloadTable();
                  }
              }
            });
        });
        //editing candidate
        $("#editform").submit(function(e){
            e.preventDefault();
            $("#edit").modal("hide");
            var temp = true;
            var candid = $("#cid").attr("candidate");
            var lname = $("#editlastnamesearch").val();
            var fname = $("#editfirstnamesearch").val();
            var hid = $("#position-edit option:selected").val();
            var party = $("#etc-edit1").val();
            var plat = $("#etc-edit2").val();
            var cred = $("#etc-edit3").val();

            $.ajax({
              url:'backCandidate/addCandidate.php',
              method:'post',
              data:{editsavebtn:temp,candidateid:candid,editlastname:lname,editfirstname:fname,editheirarchy_id:hid,editpartylist:party,editplatform:plat,editcredentials:cred},
              success:function(response){
                  
                  if(response !=""){
                      alert(response);
                  }else{
                      table.destroy();
                      reloadTable();
                  }
                  
              }
            });
        });
        //deleting a candidate
        $("#deleteForm").submit(function(e){
            e.preventDefault();
            $("#delete").modal("hide");
            var temp=true;
            var candid = $("#HeadingDelete").attr("candidate");
            $.ajax({
                url:'backCandidate/confirmDeleteCandidate.php',
                method:'post',
                data:{delete:temp,candidateid:candid},
                success:function(response){
                    console.log(response);
                  if(response !=""){
                      alert(response);
                  }else{
                      table.destroy();
                      reloadTable();
                  }
                }

            });
        });
        //upload photo 


        //searching candidate
        $("#lastnamesearch").keyup(function(){
            var lastname = $(this).val();
            if(lastname != ''){
                $.ajax({
                    url:'./backCandidate/lastnamesearch.php',
                    method:'post', 
                    data:{query:lastname},
                    success:function(response){ 
                        $(".lastname-list").html(response);
                        $(".lastname-list").show();
                        console.log(response);
                    }
                });
            }
            else{
                $(".lastname-list").html('');
            } 
        });
        $(document).on("click","#l",function(){
            var message = $(this).text();
            var split = message.split("_");
            $("#lastnamesearch").val(split[0]);
            $("#firstnamesearch").val(split[1]); 
            $(".lastname-list").html('');
            $(".firstname-list").html('');
            
        }); 
        $(document).on("click","#f",function(){
            var message = $(this).text();
            var split = message.split("_");
            $("#firstnamesearch").val(split[0]);
            $("#lastnamesearch").val(split[1]); 
            $(".lastname-list").html('');
            $(".firstname-list").html('');
        });
        $("#lastnamesearch").focus(function(){
            $(".lastname-list").show();
            $(".firstname-list").hide(); 
        }); 
        $("#firstnamesearch").focus(function(){
            $(".lastname-list").hide();
            $(".firstname-list").show();
        });
        
        //when clicked other forms
        $("#etc-add1").focus(function(){
            $(".firstname-list").hide();
            $(".lastname-list").hide();
        });
        $("#etc-add2").focus(function(){
            $(".firstname-list").hide();
            $(".lastname-list").hide(); 
        });
        $("#etc-add3").focus(function(){
            $(".firstname-list").hide();
            $(".lastname-list").hide();  
        });
        $("#etc-edit1").focus(function(){
            $(".edit-firstname-list").hide(); 
            $(".edit-lastname-list").hide();
        });
        $("#etc-edit2").focus(function(){
            $(".edit-firstname-list").hide(); 
            $(".edit-lastname-list").hide();
        });
        $("#etc-edit3").focus(function(){
            $(".edit-firstname-list").hide();
            $(".edit-lastname-list").hide();
        });
        $("#position-add").focus(function(){
            $(".firstname-list").hide();
            $(".lastname-list").hide();
        });
        $("#position-edit").focus(function(){
            $(".edit-firstname-list").hide();
            $(".edit-lastname-list").hide();
        });
    
        
        //remove list when clcicking elsewhere
        $(document).on("click",".modal-header",function(e){
            if(e.target !== this){
                return;
            }
            $(".edit-firstname-list").hide();
            $(".edit-lastname-list").hide(); 
            $(".firstname-list").hide();
            $(".lastname-list").hide();
        });
        $(document).on("click",".modal-body",function(e){
            if(e.target !== this){
                return;
            }
            $(".edit-firstname-list").hide();
            $(".edit-lastname-list").hide();
            $(".firstname-list").hide();
            $(".lastname-list").hide(); 
        });
        
        $(document).on("click",".modal-footer",function(e){
            if(e.target !== this){
                return;
            }
            $(".edit-firstname-list").hide();
            $(".edit-lastname-list").hide();
            $(".firstname-list").hide();
            $(".lastname-list").hide();
        });

        //first name search
        $("#firstnamesearch").keyup(function(){
            var firstname = $(this).val();
            if(firstname != ''){
                $.ajax({
                    url:'./backCandidate/firstnamesearch.php',
                    method:'post',
                    data:{query:firstname},
                    success:function(response){
                        $(".firstname-list").html(response);
                        $(".firstname-list").show();
                        console.log(response);
                    }
                });
            }
            else{
                $(".firstname-list").html('');
            }
        });
        
  //######################################################

        $("#editlastnamesearch").keyup(function(){
            var lastname = $(this).val();
            if(lastname != ''){
                $.ajax({
                    url:'./backCandidate/lastnamesearch.php',
                    method:'post',
                    data:{query:lastname},
                    success:function(response){
                        $(".edit-lastname-list").html(response);
                        $(".edit-lastname-list").show();
                        console.log(response);
                    }
                });
            }
            else{
                $(".edit-lastname-list").html('');
            }
        });
        
        $("#editfirstnamesearch").keyup(function(){
            var firstname = $(this).val();
            if(firstname != ''){
                $.ajax({
                    url:'./backCandidate/firstnamesearch.php',
                    method:'post',
                    data:{query:firstname},
                    success:function(response){
                        $(".edit-firstname-list").html(response);
                        $(".edit-firstname-list").show();
                    }
                });
            }
            else{
                $(".edit-firstname-list").html('');
            } 
        });
        $(document).on("click","#l",function(){
            var message = $(this).text();
            var split = message.split("_");
            $("#editlastnamesearch").val(split[0]);
            $("#editfirstnamesearch").val(split[1]); 
            $(".edit-lastname-list").html('');
            $(".edit-firstname-list").html('');
        });
        $(document).on("click","#f",function(){
            var message = $(this).text();
            var split = message.split("_");
            $("#editfirstnamesearch").val(split[0]);
            $("#editlastnamesearch").val(split[1]); 
            $(".edit-lastname-list").html('');
            $(".edit-firstname-list").html('');
        });
         $("#editlastnamesearch").focus(function(){
            $(".edit-lastname-list").show();
            $(".edit-firstname-list").hide();
        });
        $("#editfirstnamesearch").focus(function(){
            $(".edit-firstname-list").show();
            $(".edit-lastname-list").hide();
        });
        $(document).on("click","#noresults",function(){
            $(".edit-firstname-list").hide();
            $(".edit-lastname-list").hide();
            $(".firstname-list").hide();
            $(".lastname-list").hide();
        });


        $("[data-toggle=tooltip]").tooltip();
  });
</script>
 <style type="text/css">
        img.imagine {
            display: block;
            max-width: 100%;
        }

        .prev {
            overflow: hidden;
            width: 160px; 
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
        
        .modal-lg{
            max-width: 1000px !important;
        }
    </style>

<title>Update Candidate Information | BUCEILS HS Online Voting System</title>
</head>

<body>

<!-- navigation and footer -->
<?php include "navAdmin.php"; ?>

<div class="Uheader" id="CM_Header">
  <h2 class="Uheader-txt">Candidate Information Management</h2>
</div>

    
    <div class = "container">
    <div class="btn-toolbar" style="margin-left: 18px;">
        <button class="btn btn-button1 btn-s" data-title="Add" data-toggle="modal" data-target="#add" data-placement="top" id="add-candidate" title="Add"> + Add New Candidate </button>      
     </div>
      <div class = "row">
        <div class="col-md-12">
            <div class ="table-responsive table-body">
            
<table class= "center" id="datatable" width="100%" cellspacing="0" cellpadding="2px">
                    <thead>
                        <tr> 

                            <th class="text-center">Upload Photo</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Position</th>    
                            <th class="text-center">Partylist</th>   
                            <th class="text-center">Platorm/s</th>
                            <th class ="text-center">Credential/s</th>
                            <th class ="text-center">Manage</th>

                        </tr> 
                    </thead> 

                    <tbody>
                          <!-- data enters here  -->                     
                    </tbody>
                </table>
            </div>
          </div>
      </div>
    </div>

<!-- /.modal-content --> 
</div>
<!-- /.modal-dialog -->  
</div>

<div class="modal fade" id="add" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title custom_align" id="HeadingAdd">Add Candidate Information</h4>
          </div>
          <form autocomplete = "off" method="post" action="backCandidate/addCandidate.php" id="addform">
              <div class="modal-body">
                  <div class="form-group">              
                      <input class="form-control" name="lastnamesearch" id="lastnamesearch" type="text" placeholder="Enter Lastname" required>
                          <div id = "show-list" class="lastname-list" style ="display:none;"></div>
                  </div>
                  <div class = "form-group">
                      <input class="form-control"  name="firstnamesearch" id="firstnamesearch" type="text" placeholder="Enter Firstname" required>
                          <div id = "show-list" class="firstname-list"style ="display:none;"></div>
                  </div>
                  <div class="form-group">
                      <label for="position"></label>
                      <select class = "select_position" id="position-add" name="positionlist" required>
                        <!-- dropdown -->
                      </select>
                  </div>
                  <div class="form-group">  
                      <input class="form-control " id= "etc-add1" name="partylist" type="text" placeholder="Enter Partylist" required>              
                  </div>
                  <div class="form-group">  
                      <textarea class="form-control " id= "etc-add2" name="platform" type="text" placeholder="Enter Platforms" required></textarea>              
                  </div>
                  <div class="form-group">  
                      <textarea class="form-control " id= "etc-add3" name="credentials" type="text" placeholder="Enter Credentials" required></textarea>
                  </div> 
              </div>
              <div class="modal-footer ">
                  <button type="submit" name="save-btn" class="btn btn-warning btn-lg" id="save-add" style="width: 100%;"><span class= "fa fa-check-circle"></span> Save</button>
                  <button type="submit" name="cancel-btn" class="btn btn-warning btn-lg" id="cancel-add" style= "width:100%;" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
              </div>
          </form>
    </div>

    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>       
    
      <div class="modal fade" id="edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title custom_align" id="HeadingEdit">Edit Candidate Information</h4>
          </div>
          <form action="backCandidate/addCandidate.php" method = "POST" autocomplete = "off" id="editform">
              <div class="modal-body">
                  <div class="form-group">    
                      <div id="cid" candidate=""></div>       
                      <input class="form-control" name="editlastnamesearch"  id="editlastnamesearch" type="text" placeholder="Enter Lastname" required>
                      <div id = "edit-show-list" class="edit-lastname-list"></div>
                  </div>
                  <div class="form-group">
                      <input class="form-control" name="editfirstnamesearch" id="editfirstnamesearch" type="text" placeholder="Enter Firstname" required>
                          <div id = "edit-show-list" class="edit-firstname-list"></div>
                  </div>
                  <div class="form-group">
                      <label for="position"></label>
                      <select class = "select_position" id="position-edit" name="editpositionlist" required>
                     
                      </select>
                  </div>
                  <div class="form-group">  
                      <input class="form-control" id="etc-edit1" name="editpartylist" type="text" placeholder="Enter Partylist" required>              
                  </div>
                  <div class="form-group">  
                      <textarea class="form-control" id="etc-edit2" name="editplatform" type="text" placeholder="Enter Platforms" required></textarea>
                      
                  </div>
                  <div class="form-group">  
                      <textarea class="form-control" id="etc-edit3" name="editcredentials" type="text" placeholder="Enter Credentials" required></textarea>
                      
                  </div>
              </div>
              <div class="modal-footer ">
                  <button type="submit" name="edit-save-btn" class="btn btn-warning btn-lg" id="save-edit" style="width: 100%;"><span class= "fa fa-check-circle"></span>Save</button>
                  <button type="submit" name="edit-cancel-btn" class="btn btn-warning btn-lg" id="cancel-edit" style= "width:100%;" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
              </div>
          </form>
      </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog -->  
    </div>       


    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
          <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title custom_align" id="HeadingDelete" candidate="">Delete this entry</h4>
    </div>
          <div class="modal-body">             
          <div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> <text class = "delete_confirm">Are you sure you want to delete <b id="delcan"></b> in position <b id="delpos"></b>?</text></div>
    </div>
    <form action="./backCandidate/confirmDeleteCandidate.php" method="POST" id="deleteForm">
        <div class="modal-footer ">
        <button type="submit" name="continue-delete-btn" class="btn btn-success" id="continue" ><span class= "fa fa-check-circle"></span><text id = "text_confirm-delete">Continue</text></button>
        <button type="button" name="cancel-delete-btn" class="btn btn-default" id= "cancel2" data-dismiss="modal"><span class="fa fa-times-circle"></span><text id = "text_confirm-delete">Cancel</text></button>
      </div> 
    </form>    
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>

    <div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Crop Image Before Upload</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="img-container">
                      <div class="row">
                          <div class="col-md-8">
                              <img src="" id="imagine" />
                          </div>
                          <div class="col-md-4">
                              <div class="prev"></div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="crop" class="btn btn-primary">Crop</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
          </div>
      </div>


    <!-- <div class="footer">
      <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
  </div> -->

<script>

    var table ="";

    function reloadTable(){
      $.ajax({
        url:'backCandidate/tableCandidate.php',
        success: function(response){
            $("tbody").html(response);
            table = $('#datatable').DataTable({
                "lengthMenu": [
                  [ 10, 25, 50, -1],
                  [ 10, 25, 50, "All"],
                  //"ordering": false          
                ],
                'columnDefs': [ {
                    'targets': [0,6,7], 
                    'orderable': false,
                }],
                'order': [[3, 'asc']] //data-order
            });
        }
      });
    }
    
  function candidateDisplay(ctl){
      editRow = $(ctl).parents("tr");
      var cols = editRow.children("td");
      var cid = editRow.attr("candid");
      var hid = $(cols[3]).attr("data-order");

      $("#cid").attr("candidate",cid);
      $("#editlastnamesearch").val($(cols[1]).text());
      $("#editfirstnamesearch").val($(cols[2]).text());
      $("#etc-edit1").val($(cols[4]).text());
      $("#etc-edit2").val($(cols[5]).text());
      $("#etc-edit3").val($(cols[6]).text());

      $.ajax({
          url:'backCandidate/addCandidate.php',
          method:'post',
          data:{dropdownedit:hid},
          success:function(response){
              console.log(response)
              $("#position-edit").html(response);
          }
      });
  }
  function candidateDelete(ctl){
      editRow = $(ctl).parents("tr");
      var cols = editRow.children("td");
      var cid = editRow.attr("candid");

      $("#HeadingDelete").attr("candidate",cid);
      $("#delcan").text($(cols[1]).text());
      $("#delpos").text($(cols[3]).text());
  }
  function formClear(){
      $("#lastnamesearch").val("");
      $("#firstnamesearch").val("");
      $("#etc-add1").val("");
      $("#etc-add2").val("");
      $("#etc-add3").val("");
  }
  function selectFalse(){
      $(".vutton").each(function() {
          $(this).parent("td").attr("select","false");    
      });
  }

    var bs_modal = $('#modal');
    var image = document.getElementById('imagine');
    var cropper,reader,file,candidate_id;

    function changePhoto(ctl){
        candidate_id = $(ctl).parents("tr").attr("candid");
    }

    $("body").on("change", ".image", function(e) {
        filesize = this.files[0].size/1024/1024;//mb 
        maxsize = 1;//mb
        if(maxsize < filesize){
          alert("Cannot upload picture higher than 1mb.");
          return;
        }
        var fileExtension = ['jpeg', 'jpg', 'png'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Formats allowed : "+fileExtension.join(', '));
            return;
        }
        if(image != null){  
            var files = e.target.files;
            var done = function(url) {
              image.src = url;
              bs_modal.modal('show');
        };


          if (files && files.length > 0) {
              file = files[0];

              if (URL) {
                  done(URL.createObjectURL(file));
              } else if (FileReader) {
                  reader = new FileReader();
                  reader.onload = function(e) {
                      done(reader.result);
                  };
                  reader.readAsDataURL(file);
              }
          }
        }
        return;
    });

    bs_modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 0 ,
            preview: '.prev'

        });
    }).on('hidden.bs.modal', function() {
        $(".image").val('');
        cropper.destroy();
        cropper = null;
    });
    $("#crop").click(function() {
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });
        console.log(canvas);

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
            var base64data = reader.result;

                $.ajax({
                    method: "POST",
                    url: "Admincand_uploadphoto.php",
                    data: {image:base64data,candidateid:candidate_id},
                    success: function(data) { 
                        bs_modal.modal('hide');
                        table.destroy();
                        reloadTable();
                        alert("success upload image");
                    }
                });
            };
        });
    });
  


  $('.ADicon').click(function () {
      $('span').toggleClass("cancel");
  });
</script>
</body> 
</html>
