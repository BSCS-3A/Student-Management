<?php
include("genotp_studAcc.php");
include("./backStudent/back_studAccMngmt.php");
include("./backStudent/email_studAcc.php");
include("edit_studAcc.php");
include("db_conn.php");
  if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
// for button disable
$checktime = "SELECT * FROM vote_event"; 
$DnT = $connect->query($checktime);
$DTrow =  $DnT->fetch_row(); 
// row[1] = start date, row[2] = end date

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">
    <link rel="icon" href="../img/BUHS LOGO.png">
    <link rel="stylesheet" type="text/css" href="../css/admin_css/style_studAcc.css">
    <link rel="stylesheet" href="../css/admin_css/bootstrap_studAcc.css">
    <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap_studAcc.css">

    <script src="../js/jquery-1.11.1.min_studAcc.js"></script>
    <script src="../js/jquery.dataTables.min_studAcc.js"></script>
    <script src="../js/dataTables.bootstrap_studAcc.js"></script>
    <script src="../js/bootstrap.min_studAcc.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="../js/admin_session_timer.js"></script>
    <script type="text/javascript">
    // (function() {
    //     var css = document.createElement('link');
    //     css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css';
    //     css.rel = 'stylesheet';
    //     css.type = 'text/css';
    //     document.getElementsByTagName('head')[0].appendChild(css);
    // })();
    // </script>
    <title> Student Account Management | BUCEILS HS Online Voting System</title>
</head>

<body>

    <!-- navigation bar -->
    <?php include "navAdmin.php"; ?>

    <div class="cheader">
        <h3 class="cheader-txt">STUDENT ACCOUNT MANAGEMENT</h3>
    </div>


    <!--############################################################################################################################################################################################## -->
    <!-- CONFIRMATION MESSAGE FOR EDIT AND DELETE-->
    <?php
    if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
    </div>
    <?php endif ?>
    <!--############################################################################################################################################################################################## -->

    <div class="container">
        <section>
            <div class='flex-container'>

                <button class="btn btn-button0" data-title="add" data-toggle="modal" data-target="#add"
                    data-placement="top" data-toggle="tooltip" title="Add new student" <?php 
                    $now = date("Y-m-d G:i:s"); // G for 24hr format
                    if(isset($DTrow) && $now >= $DTrow[1] && $now <= $DTrow[2] ){
                    ?> disabled <?php    
                    }?>>
                    <span class="fa fa-user-plus"></span> ADD</button>

                <button class="btn btn-button1" data-title="new" data-toggle="modal" data-target="#new"
                    data-placement="top" data-toggle="tooltip" title="Import new list" <?php 
                    $now = date("Y-m-d G:i:s"); // G for 24hr format
                    if(isset($DTrow) && $now >= $DTrow[1] && $now <= $DTrow[2] ){
                    ?> disabled <?php    
                    }?>>
                    <span class="fa fa-file-import"></span> IMPORT</button>

                <!--Edited button to be disabled during the election-->
                <button class="btn btn-button2" data-title="otp" data-toggle="modal" data-target="#otp"
                    data-placement="top" data-toggle="tooltip" title="Generate Password for this list" <?php 
                    $now = date("Y-m-d G:i:s"); // G for 24hr format
                    if(isset($DTrow) && $now >= $DTrow[1] && $now <= $DTrow[2] ){
                    ?> disabled <?php    
                    }?>>
                    <span class="fa fa-lock"></span> GENERATE PASSWORD</button>
                <!--Edited button to be disabled during the election-->


                <button class="btn btn-button3" data-title="send" data-toggle="modal" data-target="#send"
                    data-placement="top" data-toggle="tooltip" title="Send Login Credentials" <?php 
                    $now = date("Y-m-d G:i:s"); // G for 24hr format
                    if(isset($DTrow) && $now >= $DTrow[1] && $now <= $DTrow[2] ){
                    ?> disabled <?php    
                    }?>>

                    <span class="fa fa-envelope-open"></span> SEND</button>

            </div>
        </section>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table-center" id="datatable" width="100%">
                        <thead>
                            <tr>
                                <th class="min-mobile" id="tableh">STUDENT<br>ID</th>
                                <th class="min-mobile">LAST NAME</th>
                                <th class="min-mobile">FIRST NAME</th>
                                <th class="min-mobile">MIDDLE NAME</th>
                                <th class="min-mobile">GENDER</th>
                                <th class="min-mobile">EMAIL</th>
                                <th style="color:white" class="min-mobile"><select name ="lvl" id="lvl" style="background-color:#18566e;">
                                    <option value="">GRADE LEVEL</option>
                                    <option value="">ALL</option>
                                    <option value="7">Grade 7</option>
                                    <option value="8">Grade 8</option>
                                    <option value="9">Grade 9</option>
                                    <option value="10">Grade 10</option>
                                    <option value="11">Grade 11</option>
                                    <option value="12">Grade 12</option></select>
                                </th>
                                <th class="min-mobile">PASSWORD</th>
                                <th class="min-mobile">TOOLS</th>

                            </tr>
                        </thead>

                        <tbody>
                            

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div>
        <form action="create_studAcc.php" method="POST">
        <div class="modal fade" id="add" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add New Student</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input autocomplete="off" class="form-control " name="Add_ID" type="number" placeholder="Enter Student ID"
                                    required="required">
                            </div>
                            <div class="form-group">
                                <input autocomplete="off" class="form-control " name="lname" id="lname" type="text"
                                    placeholder="Enter Last Name" required="required">
                            </div>
                            <div class="form-group">
                                <input autocomplete="off" class="form-control " name="fname" id="fname" type="text"
                                    placeholder="Enter First Name" required="required">
                            </div>
                            <div class="form-group">
                                <!-- Do not require, not all students have middle name -->
                                <input autocomplete="off" class="form-control " name="Mname" id="Mname" type="text"
                                    placeholder="Enter Middle Name">
                            </div>
                            <div class="form-group">
                                <select required onchange = "enableButton()" class="form-control " name="gender" id="gender" type="text"
                                    placeholder="Enter Gender" required="required">
                                    <option value = "">Gender </option>
                                    <option value = "female">Female</option>
                                    <option value = "male">Male</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <input type="email"  pattern=".+@bicol-u.edu.ph"  autocomplete="off" class="form-control " name="bumail" id="bumail"
                                    placeholder="Enter Email" required="required">
                            </div>
                            <div class="form-group">
                            <input type="number" min="7" max="12" autocomplete="off" class="form-control " name="grade_level" id="grade_level"
                                    placeholder="Enter Grade Level" required="required">
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" name="add" class="btn btn-warning btn-lg" id="save"
                                style="width: 100%;"><span class="fa fa-check-circle"></span> Add</button>
                            <button type="button" class="btn btn-default" id="cancel" style="width:100%;"
                                data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
    </div>

    <div class="modal fade" data-backdrop="static" id="new" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">Upload File</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <span class="fa fa-exclamation-triangle"></span> WARNING! <br> 
                            By uploading a new file, the existing student record will be replaced, and all student related
                            data, such as results, list of candidates, and logs, will be deleted. <br>
                            <br>
                            <?php echo $message; ?>
                    </div>
                </div>

                <div class="modal-footer ">
                    <!-- import button -->
                    <br />
                    <form method="POST" enctype="multipart/form-data">
                        <p><label></label></p>
                        <input type="file" name="info_file" />
                        <br />
                        <button type="submit" name="upload" class="btn btn-button6"><span
                                class="fa fa-check-circle"></span> Upload</button>
                        <button class="btn btn-button4" data-dismiss="modal"><span class="fa fa-times-circle"></span>
                            Cancel</button>
                    </form>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" data-backdrop="static" id="otp" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">Once you confirm, the system will generate password for this list. Do you wish to proceed?</h4>
                    <form method="POST">
                        <div class="modal-footer ">

                            <button type="submit" name="go" class="btn btn-success" id="go"><span
                                    class="fa fa-check-circle"></span> Continue</button>
                            <button type="button" class="btn btn-default" id="cancel2" data-dismiss="modal"><span
                                    class="fa fa-times-circle"></span> Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
       <!--############################################################################################################################################################################################## -->
    <!-- SENDING EMAIL MODAL -->

    <div class="modal fade" id="send" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">Please select grade level you wish to send their login details.<br>Click Continue to proceed.</h4></div>
                    <script type="text/javascript">
                            enableButton = () => {

                                let gradeSelected = document.querySelector('#glevel');
                                let submitBtn = document.querySelector('#go2');
                                submitBtn.disabled = !gradeSelected.value;

                            }

                    </script>
                     <div class="modal-body">
                        <form method="POST">
                            <select required onchange="enableButton()" id = "glevel" name = "glevel" style="height:30px;background-color:#18566e;color:white;" />
                                <option value = "">Select Grade Level</option>
                                <option value = "7">Grade 7</option> 
                                <option value = "8">Grade 8</option>
                                <option value = "9">Grade 9</option>
                                <option value = "10">Grade 10</option>
                                <option value = "11">Grade 11</option>
                                <option value = "12">Grade 12</option>
                            </select>     </div>
                             <!-- Send Login credentials btn handler -->
                             <div class="modal-footer ">
                                    <button disabled type="submit" class="btn btn-success" id="go2" name="sendEmail" value="Continue">
                                    <span class="fa fa-check-circle"></span> Continue</type=>
                                <button type="button" class="btn btn-default" id="cancel2" data-dismiss="modal"><span
                                        class="fa fa-times-circle"></span> Cancel</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    </div>
    <!--############################################################################################################################################################################################## -->
    <!-- EDIT MODAL -->
    <form action="edit_studAcc.php" method="POST">
    <div class="modal fade" id="edit" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Edit Student Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input autocomplete="off" class="form-control " name="Update_ID" id="Update_ID" type="text" readonly="readonly"
                                required="required">
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" class="form-control " name="lname" id="elname" type="text"
                                placeholder="Enter Last Name" required="required">
                        </div>
                        <div class="form-group">
                            <input autocomplete="off" class="form-control " name="fname" id="efname" type="text"
                                placeholder="Enter First Name" required="required">
                        </div>
                        <div class="form-group">
                            <!-- Do not require, not all students have middle name -->
                            <input autocomplete="off" class="form-control " name="Mname" id="eMname" type="text"
                                placeholder="Enter Middle Name">
                        </div>
                        <div class="form-group">
                            <select required onchange = "enableButton()" class="form-control " name="gender" id="egender" type="text"
                                placeholder="Enter Gender" required="required">
                                <option value = "">Gender </option>
                                <option value = "female">Female</option>
                                <option value = "male">Male</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="email"  pattern=".+@bicol-u.edu.ph" autocomplete="off" class="form-control " name="bumail" id="ebumail" placeholder="Enter Email"
                                required="required">
                        </div>
                        <div class="form-group">
                            <input type="number" min="7" max="12" autocomplete="off" class="form-control " name="grade_level" id="egrade_level"
                                placeholder="Enter Grade Level" required="required">
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" name="save" class="btn btn-warning btn-lg" id="save"
                            style="width: 100%;"><span class="fa fa-check-circle"></span> Save</button>
                        <button type="button" class="btn btn-default" id="cancel" style="width:100%;"
                            data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
    <!--############################################################################################################################################################################################## -->
    <!-- DELETE MODAL -->
    <div class="modal fade" id="delete" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <form action="./backStudent/delete_studAcc.php" method="POST">
                    <div class="modal-body">
                        <div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Are you sure
                            you want to delete this Record?</div>
                        <input type="hidden" name="Delete_ID" id="Delete_ID">
                    </div>
                    <div class="modal-footer ">
                        <button type="submit" name="continue" class="btn btn-success" id="continue"><span
                                class="fa fa-check-circle"></span> Continue</button>
                        <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal"><span
                                class="fa fa-times-circle"></span> Cancel</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--############################################################################################################################################################################################## -->
    <!-- <div class="footer">
        <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
    </div> -->
    <!--############################################################################################################################################################################################## -->

    <!--############################################################################################################################################################################################## -->
    <!-- DELETE SCRIPT -->
    <script>
    $(document).ready(function() {
        $('#datatable').on('click', '.DeleteBtn', function() {
            $('#delete').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#Delete_ID').val(data[0]);

        });
    });
    </script>
    <!--############################################################################################################################################################################################## -->
    <!-- EDIT SCRIPT -->
    <script>
    $(document).ready(function() {
        $('#datatable').on('click', '.EditBtn', function() {
            $('#edit').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);

            $('#Update_ID').val(data[0]);
            $('#elname').val(data[1]);
            $('#efname').val(data[2]);
            $('#eMname').val(data[3]);
            $('#egender').val(data[4]);
            $('#ebumail').val(data[5]);
            $('#egrade_level').val(data[6]);

        });
    });
    </script>
    <!-- load ############################################################################################################################################################################################## -->
 <!--############################################################################################################################################################################################## -->
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
 load_data();

 function load_data(lvl)
 {
  var dataTable = $('#datatable').DataTable({
   "processing":true,
   "serverSide":true,
   "order":[],

   "ajax":{
    url:"sort_studAcc.php",
    type:"GET",
    data:{lvl:lvl}
   },
   "columnDefs":[
    {
     "targets":[6,8],
     "orderable":false,

    },
   ],
  });
 }

 $(document).on('change', '#lvl', function(){
  var category = $(this).val();
  $('#datatable').DataTable().destroy();
  if(category != '')
  {
   load_data(category);
  }
  else
  {
   load_data();
  }
 });
});
</script>
<!--################################################################################################################################################################### -->
</body>

</html>
<?php
 }else{
     header("Location: AdminLogin.php");
      exit();
 }
 ?>
