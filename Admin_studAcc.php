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
$row =  $DnT->fetch_row(); 
// row[1] = start date, row[2] = end date

// for disable delete when student is candidate
$checkcandidate = "SELECT * FROM candidate"; 
$candid = mysqli_query($connect,$checkcandidate);
$Cand = mysqli_fetch_array($candid);
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
    <link rel="stylesheet" href="../css/admin_css/font-awesome_studAcc.css">

    <script src="../js/jquery-1.11.1.min_studAcc.js"></script>
    <script src="../js/jquery.dataTables.min_studAcc.js"></script>
    <script src="../js/dataTables.bootstrap_studAcc.js"></script>
    <script src="../js/bootstrap.min_studAcc.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script type="text/javascript" src="../js/admin_session_timer.js"></script>
    <script type="text/javascript">
    (function() {
        var css = document.createElement('link');
        css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css';
        css.rel = 'stylesheet';
        css.type = 'text/css';
        document.getElementsByTagName('head')[0].appendChild(css);
    })();
    </script>
    <title> Student Account Management | BUCEILS HS Online Voting System</title>
</head>

<body>

    <!-- navigation bar -->
    <?php include "navAdmin.php"; ?>

    <div class="cheader">
        <h3>STUDENT ACCOUNT MANAGEMENT</h3>
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
                    if($now >= $row[1] && $now <= $row[2] ){
                    ?> disabled <?php    
                    }?>>
                    <span class="fa fa-user-plus"></span> ADD</button>

                <button class="btn btn-button1" data-title="new" data-toggle="modal" data-target="#new"
                    data-placement="top" data-toggle="tooltip" title="Import new list" <?php 
                    $now = date("Y-m-d G:i:s"); // G for 24hr format
                    if($now >= $row[1] && $now <= $row[2] ){
                    ?> disabled <?php    
                    }?>>
                    <span class="fa fa-file-import"></span> IMPORT</button>

                <!--Edited button to be disabled during the election-->
                <button class="btn btn-button2" data-title="otp" data-toggle="modal" data-target="#otp"
                    data-placement="top" data-toggle="tooltip" title="Generate OTP for this list" <?php 
                    $now = date("Y-m-d G:i:s"); // G for 24hr format
                    if($now >= $row[1] && $now <= $row[2] ){
                    ?> disabled <?php    
                    }?>>
                    <span class="fa fa-lock"></span> GENERATE OTP</button>
                <!--Edited button to be disabled during the election-->


                <button class="btn btn-button3" data-title="send" data-toggle="modal" data-target="#send"
                    data-placement="top" data-toggle="tooltip" title="Send Login Credentials" <?php 
                    $now = date("Y-m-d G:i:s"); // G for 24hr format
                    if($now >= $row[1] && $now <= $row[2] ){
                    ?> disabled <?php    
                    }?>>

                    <span class="fa fa-envelope-open"></span> SEND</button>

            </div>
        </section>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table-center" id="datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th class="min-mobile">STUDENT ID</th>
                                <th class="min-mobile">LAST NAME</th>
                                <th class="min-mobile">FIRST NAME</th>
                                <th class="min-mobile">MIDDLE NAME</th>
                                <th class="min-mobile">GENDER</th>
                                <th class="min-mobile">BU EMAIL</th>
                                <th class="min-mobile">GRADE LEVEL</th>
                                <th class="min-mobile">OTP</th>
                                <th class="min-mobile">TOOLS</th>

                            </tr>
                        </thead>

                        <tbody>
                            <!-- Student Info from database -->
                            <?php
                            while ($studrow = mysqli_fetch_array($result)) {
                                echo '
                            <tr>
                                <td>' . $studrow["student_id"] . '</td>
                                <td>' . $studrow["lname"] . '</td>
                                <td>' . $studrow["fname"] . '</td>
                                <td>' . $studrow["Mname"] . '</td>
                                <td>' . $studrow["gender"] . '</td>
                                <td>' . $studrow["bumail"] . '</td>
                                <td>' . $studrow["grade_level"] . '</td>
                                <td>' . $studrow["otp"] . '</td>
                                    '
                            ?>
                            <td style="white-space: nowrap;">
                            <?php
                            //$Cand = mysqli_fetch_array($candid);
                            echo $studrow['student_id'];
                            echo $Cand['student_id'];
                            ?>

                                <?php   // for button disable inside table
                                    $DnT = $connect->query($checktime);
                                    $row =  $DnT->fetch_row(); 
                                ?>

                                <!-- Edit Button -->
                                <button class="btn btn-primary btn-xs EditBtn" data-title="Edit" data-toggle="modal"
                                    data-placement="top" data-toggle="tooltip" title="Edit" <?php 
                                        $now = date("Y-m-d G:i:s"); // G for 24hr format
                                        if($now >= $row[1] && $now <= $row[2] ){
                                        ?> disabled <?php    
                                        }?>>

                                    <span class="fa fa-edit"></span> EDIT</button>

                                <!-- Delete Button -->
                                <button class="btn btn-danger btn-xs DeleteBtn" data-title="Delete" data-toggle="modal"
                                    data-placement="top" data-toggle="tooltip" title="Delete" <?php 
                                        $now = date("Y-m-d G:i:s"); // G for 24hr format
                                        if($now >= $row[1] && $now <= $row[2] ){
                                        ?> disabled <?php    
                                        }?>
                                        <?php
                                            if($Cand['student_id']==$studrow['student_id'] ){
                                        ?> disabled <?php
                                        }?>>

                                    <span class="fa fa-trash-alt"></span> DELETE</button>
                            </td>

                            <?php
                                '</tr>';
                            }
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div>
        <form autocomplete="off" action="create_studAcc.php" method="POST">
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Add New Student</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input class="form-control " name="Add_ID" id="Add_ID" type="text" placeholder="Enter Student ID"
                                    required="required">
                            </div>
                            <div class="form-group">
                                <input  class="form-control " name="lastname" id="lastname" type="text"
                                    placeholder="Enter Last Name" required="required">
                            </div>
                            <div class="form-group">
                                <input  class="form-control " name="firstname" id="firstname" type="text"
                                    placeholder="Enter First Name" required="required">
                            </div>
                            <div class="form-group">
                                <!-- Do not require, not all students have middle name -->
                                <input  class="form-control " name="Midname" id="Midname" type="text"
                                    placeholder="Enter Middle Name">
                            </div>
                            <div class="form-group">
                                <input  class="form-control " name="Gender" id="Gender" type="text"
                                    placeholder="Enter Gender" required="required">
                            </div>
                            <div class="form-group">
                                <input  class="form-control " name="Bumail" id="Bumail" type="text"
                                    placeholder="Enter Email" required="required">
                            </div>
                            <div class="form-group">
                                <input class="form-control " name="Grade_level" id="Grade_level" type="text"
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

    <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">Upload File</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> WARNING! <br> By
                        uploading a new file, the existing student record will be replaced, and all student related
                        data, such as results, list of candidates, and logs, will be deleted. <br><br><b>Select a new
                            file (Only in CSV Format)</b></div>
                </div>

                <div class="modal-footer ">

                    <!-- import button -->
                    <br />
                    <form method="POST" enctype="multipart/form-data">
                        <p><label></label></p>
                        <input type="file" name="info_file" />

                        <?php //echo $message; ?>

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

    <div class="modal fade" id="otp" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">Once you confirm, the system will generate one
                        time password for this list. Do you wish to proceed?</h4>
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
    <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">Once you confirm, the student will receive their
                        login details.<br>Do you wish to proceed?</h4>

                    <!-- Send Login credentials btn handler -->
                    <div class="modal-footer ">

                        <form method="POST">
                            <button type="submit" class="btn btn-success" id="go2" name="sendEmail"
                                value="Continue"><span class="fa fa-check-circle"></span> Continue</button>
                            <button type="button" class="btn btn-default" id="cancel2" data-dismiss="modal"><span
                                    class="fa fa-times-circle"></span> Cancel</button>

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
    <form autocomplete="off" action="edit_studAcc.php" method="POST">
        <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Edit Student Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input  class="form-control " name="Update_ID" id="Update_ID" type="text" readonly="readonly"
                                required="required">
                        </div>
                        <div class="form-group">
                            <input class="form-control " name="lname" id="lname" type="text"
                                placeholder="Enter Last Name" required="required">
                        </div>
                        <div class="form-group">
                            <input  class="form-control " name="fname" id="fname" type="text"
                                placeholder="Enter First Name" required="required">
                        </div>
                        <div class="form-group">
                            <!-- Do not require, not all students have middle name -->
                            <input  class="form-control " name="Mname" id="Mname" type="text"
                                placeholder="Enter Middle Name">
                        </div>
                        <div class="form-group">
                            <input  class="form-control " name="gender" id="gender" type="text"
                                placeholder="Enter Gender" required="required">
                        </div>
                        <div class="form-group">
                            <input  class="form-control " name="bumail" id="bumail" type="text" placeholder="Enter Email"
                                required="required">
                        </div>
                        <div class="form-group">
                            <input  class="form-control " name="grade_level" id="grade_level" type="text"
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
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
    <!-- DATABLE SCRIPT -->
    <script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });
        $("[data-toggle=tooltip]").tooltip();
    });
    </script>

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
            $('#lname').val(data[1]);
            $('#fname').val(data[2]);
            $('#Mname').val(data[3]);
            $('#gender').val(data[4]);
            $('#bumail').val(data[5]);
            $('#grade_level').val(data[6]);

        });
    });
    </script>
    <!--############################################################################################################################################################################################## -->
</body>

</html>
<?php
 }else{
     header("Location: AdminLogin.php");
      exit();
 }
 ?>