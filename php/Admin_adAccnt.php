<?php // SESSION ISSUE, details at last part
session_start();
include('db_conn.php');
if (isset($_SESSION['admin_id']) && isset($_SESSION['username'])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <link rel="icon" href="../img/BUHS LOGO.png">
        <link rel="stylesheet" type="text/css" href="../css/admin_css/style1_addAdmin.css">
        <link rel="stylesheet" href="../css/admin_css/bootstrap_addAdmin.css">
        <link rel="stylesheet" href="../css/admin_css/dataTables.bootstrap_addAdmin.css">
        <link rel="stylesheet" href="../css/admin_css/font-awesome.css">

        <script src="../js/jquery-1.11.1.min_addAdmin.js"></script>
        <script src="../js/jquery.dataTables.min_addAdmin.js"></script>
        <script src="../js/dataTables.bootstrap_addAdmin.js"></script>
        <script src="../js/popper.min_addAdmin.js"></script>
        <script src="../js/bootstrap.min_addAdmin.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script src="../js/a076d05399_addAdmin.js"></script>
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
        <!--additional scripts-->
        <script src="../js/bootstrap-show-password.min_addAdmin.js"></script>
        <!--<script src="../assets/js/customized.js"></script>-->
        <link rel="stylesheet" href="../css/admin_css/customized_addAdmin.css">

        <!--for upload photo crop-->
        <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js">
        <script src="../js/cropper.js"></script>

        <title>Admin Account Management | BUCEILS HS Online Voting System</title>
    </head>

    <!-- navigation, footer, log sessions -->
    <?php include "navAdmin.php" ?>

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
    </style>

    <style type="text/css">
        img.imagine_edit {
            display: block;
            max-width: 100%;
        }

        .prev_edit {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }
    </style>

    <body>
        <div class="cheader" id="Dheader">
            <h3 class="Dheader-txt">ADMINISTRATOR ACCOUNT MANAGEMENT</h3>
        </div>
        <div class="container">
            <section>
                <div class="btn-toolbar">
                    <button name="AddAccountButton" class="btn btn-button2" data-title="otp" data-toggle="modal" data-target="#otp" data-placement="top" data-toggle="modal" title="Add Account" <?php if ($_SESSION['admin_position'] == "Admin") {
                                                                                                                                                                                                    ?> disabled <?php
                                                                                                                                                                                                            } ?>>

                        <span class="fa fa-user-plus"></span> ADD ACCOUNT</button>
                </div>
                <?php //echo("{$_SESSION['admin_position']}") 
                ?>
            </section>
            <!--######################################################################################################################################################################################-->
            <!-- TABLE -->
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table-center" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">NO.</th>
                                    <th style="display:none;"></th>
                                    <th class="text-center">FIRST NAME</th>
                                    <th class="text-center">MIDDLE NAME</th>
                                    <th class="text-center">LAST NAME</th>
                                    <th class="text-center">EMAIL ADDRESS</th>
                                    <th class="text-center">COMELEC POSITION</th>
                                    <th class="text-center">ADMIN POSITION</th>
                                    <th class="text-center">ACTION</th>
                                    <th style="display:none;"></th>
                                    <th style="display:none;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Create connection
                                include 'db_conn.php';

                                $query = "SELECT * FROM admin";
                                $query_run = mysqli_query($conn, $query);

                                while ($row = mysqli_fetch_array($query_run)) { #START FETCHING OF RECORDS FROM DATABASE
                                ?>
                                    <tr>
                                        <td></td>
                                        <td style="display:none;"><?php echo $row['admin_id']; ?></td>
                                        <td><?php echo $row['admin_fname']; ?></td>
                                        <td><?php echo $row['admin_mname']; ?></td>
                                        <td><?php echo $row['admin_lname']; ?></td>
                                        <td style="word-wrap: break-word"><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['comelec_position']; ?></td>
                                        <td><?php echo $row['admin_position']; ?></td>
                                        <td style="display:none;"><?php echo $row['password']; ?></td>
                                        <td style="display:none;"><?php echo $row['photo']; ?></td>
                                        <td style="white-space: nowrap;">
                                            <button class="btn btn-primary btn-xs editbtn" data-title="Edit" name="editinfo" data-toggle="modal" data-target="#edit" data-placement="top" data-toggle="tooltip" title="Edit" <?php if ($_SESSION['admin_position'] == "Admin") {
                                                                                                                                                                                                                                ?> disabled <?php
                                                                                                                                                                                                                                        } ?>>
                                                <span class="fa fa-edit"></span> EDIT</button>
                                            <button class="btn btn-danger btn-xs deletebtn" data-title="Delete" data-toggle="modal" data-target="#delete" <?php if ($_SESSION['admin_position'] == "Admin") {
                                                                                                                                                            ?> disabled <?php
                                                                                                                                                                    } ?>><span class="fa fa-trash"></span> DELETE</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!--######################################################################################################################################################################################-->
        <!-- ADD MODAL -->
        <div class="modal fade" id="otp" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">REGISTER</h4>
                    </div>

                    <form id="add_form" action="backAdmin/backFun_adAccnts_v0_1.php" autocomplete="off" method="POST">
                        <div class="modal-body">
                            <textarea style="display:none;" name="base64" id="base64"></textarea>
                            <div class="form-group">
                                <input class="form-control" name="admin_fname" type="text" placeholder="Firstname" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="admin_mname" type="text" placeholder="Middle Name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="admin_lname" type="text" placeholder="Surname" required>
                            </div>

                            <div class="form-group">
                                <input class="form-control" name="username" type="email" aria-describedby="emailHelp" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="comelec_position" type="text" placeholder="COMELEC Position" required>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Admin Position:</label>
                                <select class="form-control" name="admin_position" id="sel1" required>
                                    <option value="" disabled selected><\choose></option>
                                    <option>Admin</option>
                                    <option>Head Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" data-toggle="password" placeholder="*********" onChange="onChange()" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password:</label>
                                <input type="password" name="conpassword" class="form-control" data-toggle="password" placeholder="*********" onChange="onChange()" required>
                            </div>
                            <div class="container">
                                <label for="photo" width="70%">Upload photo</label><br />
                                <input type="file" name="image" id="my_image" required><br />
                                <span id="admin_newupload_errorloc" class="error"></span>
                            </div>
                            <div class="modal-footer ">
                                <button type="submit" name="saveAccount" class="btn btn-success" id="go"><span class="fa fa-check-circle"></span> Save Account</button>
                                <button type="button" class="btn btn-default" id="cancel2" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <!--######################################################################################################################################################################################-->
        <!-- EDIT MODAL -->
        <form action="./backAdmin/backFun_editAccnts_v0_1.php" autocomplete="off" method="POST">
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <textarea style="display:none;" name="base64_edit" id="base64_edit"></textarea>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading">Edit Admin Information</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="update_id" id="update_id">
                            <div class="form-group">
                                <label>First Name:</label>
                                <input class="form-control" name="admin_fname" id="admin_fname" type="text" placeholder="Firstname" required>
                            </div>
                            <div class="form-group">
                                <label>Middle Name:</label>
                                <input class="form-control" name="admin_mname" id="admin_mname" type="text" placeholder="Middle Name">
                            </div>
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input class="form-control" name="admin_lname" id="admin_lname" type="text" placeholder="Surname" required>
                            </div>
                            <div class="form-group">
                                <label>Username (e-mail):</label>
                                <input class="form-control" name="username" id="username" type="email" aria-describedby="emailHelp" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group">
                                <label>COMELEC Position:</label>
                                <input class="form-control" name="comelec_position" id="comelec_position" type="text" placeholder="COMELEC Position" required>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Admin Position:</label>
                                <select class="form-control" name="admin_position" id="admin_position" required>
                                    <option value="" disabled selected><\choose></option>
                                    <option>Admin</option>
                                    <option>Head Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password: <span class="label label-warning">Type new password</span></label>
                                <input type="password" name="password" id="password" class="form-control" data-toggle="password" placeholder="*********" onChange="onChange()">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password:</label>
                                <input type="password" name="conpassword" id="conpassword" class="form-control" data-toggle="password" placeholder="*********" onChange="onChange()">
                            </div>
                            <div class="container">
                                <label for="photo" width="70%">Upload photo</label><br />
                                <input type="file" name="my_image_edit" id="my_image_edit"><br />
                                <span id="admin_newupload_errorloc" class="error"></span>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-success" name="updateData" id="go"><span class="fa fa-check-circle"></span> Update Account</button>
                            <button type="button" class="btn btn-default" id="cancel2" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </form>
        <!--######################################################################################################################################################################################-->
        <!-- DELETE MODAL -->
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                    </div>
                    <form action="./backAdmin/backFun_delAccnts_v0_1.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="Delete_ID" id="Delete_ID">
                            <div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Are you sure you want to delete this account?</div>
                        </div>
                        <div class="modal-footer ">
                            <button type="submit" class="btn btn-success" name="yes_delete" id="continue"><span class="fa fa-check-circle"></span> Yes</button>
                            <button type="button" class="btn btn-default" id="no" data-dismiss="modal"><span class="fa fa-times-circle"></span> No</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--######################################################################################################################################################################################-->
        <!-- CROP MODAL -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
        <!--######################################################################################################################################################################################-->
        <!-- CROP MODAL FOR EDIT -->
        <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                    <img src="" id="imagine_edit" />
                                </div>
                                <div class="col-md-4">
                                    <div class="prev_edit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop_edit" class="btn btn-primary">Crop</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal_edit">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="footer">
        <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
    </div> -->

        <!-- DATATABLES JAVASCRIPT -->
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    "lengthMenu": [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ]
                });
                $("[data-toggle=tooltip]").tooltip();
            });
        </script>

        <!-- DELETE SCRIPT -->
        <script>
            $(document).ready(function() {
                $('#datatable').on('click', '.deletebtn', function() {

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#Delete_ID').val(data[1]);

                });
            });
        </script>

        <!-- EDIT and UPDATE SCRIPT -->
        <script>
            $(document).ready(function() {
                $('#datatable').on('click', '.editbtn', function() {

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#update_id').val(data[1]);
                    $('#admin_fname').val(data[2]);
                    $('#admin_mname').val(data[3]);
                    $('#admin_lname').val(data[4]);
                    $('#username').val(data[5]);
                    $('#comelec_position').val(data[6]);
                    $('#admin_position').val(data[7]);
                    $('#base64_edit').val(data[9]);
                });
            });
        </script>


        <!-- JS FOR CLEARING INPUT IN TEXT FIELDS -->
        <script>
            $('#otp').on('hidden.bs.modal', function(e) {
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end()
                    .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })
        </script>

        <!-- CONFIRM PASSWORD -->
        <script>
            function onChange() {
                const password = document.querySelector('input[name=password]');
                const confirm = document.querySelector('input[name=conpassword]');
                if (confirm.value === password.value) {
                    confirm.setCustomValidity('');
                } else {
                    confirm.setCustomValidity('Passwords do not match');
                }
            }
        </script>

        <!-- CROP BEFORE UPLOAD FOR ADD-->
        <script>
            (function() {
                var bs_modal = $('#modal');
                var image = document.getElementById('imagine');
                var cropper, reader, file;

                $("body").on("change", "#my_image", function(e) {
                    filesize = this.files[0].size / 1024 / 1024; //mb 
                    maxsize = 1; //mb
                    if (maxsize < filesize) {
                        alert("Cannot upload picture higher than 1mb.");
                        return;
                    }
                    var fileExtension = ['jpeg', 'jpg', 'png'];
                    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                        alert("Formats allowed : " + fileExtension.join(', '));
                        return;
                    }
                    if (image != null) {
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
                        viewMode: 0,
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
                            $("#base64").val(base64data);
                        };
                    });
                    bs_modal.modal('hide');
                });
            })();
        </script>

        <!-- CROP BEFORE UPLOAD FOR EDIT-->
        <script>
            (function() {
                var bs_modal = $('#modal_edit');
                var image = document.getElementById('imagine_edit');
                var cropper, reader, file;

                $("body").on("change", "#my_image_edit", function(e) {
                    filesize = this.files[0].size / 1024 / 1024; //mb 
                    maxsize = 1; //mb
                    if (maxsize < filesize) {
                        alert("Cannot upload picture higher than 1mb.");
                        return;
                    }
                    var fileExtension = ['jpeg', 'jpg', 'png'];
                    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                        alert("Formats allowed : " + fileExtension.join(', '));
                        return;
                    }
                    if (image != null) {
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
                        viewMode: 0,
                        preview: '.prev_edit'
                    });
                }).on('hidden.bs.modal', function() {
                    $(".image").val('');
                    cropper.destroy();
                    cropper = null;
                });
                $("#crop_edit").click(function() {
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
                            $("#base64_edit").val(base64data);
                        };
                    });
                    bs_modal.modal('hide');
                });
            })();
        </script>
    </body>

    </html>

<?php

} else {
    // session issue, after add/edit/delete, logout after lol 
    // status: fixed and applied 05/01/2021 9:53pm
    header("Location: AdminLogin.php");
    exit();
}
?>