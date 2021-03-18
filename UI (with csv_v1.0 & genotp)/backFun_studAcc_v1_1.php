<?php
    include("genotp.php");
    // database connection
    include("connect.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta charset="utf-8">
        <link rel="icon" href="assets/img/buceils-logo.png">
        <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/dataTables.bootstrap.css">
        <link rel="stylesheet" href="assets/css/font-awesome.css">
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>    
        <script type="text/javascript"> (function() { var css = document.createElement('link'); css.href = 'https://use.fontawesome.com/releases/v5.1.0/css/all.css'; css.rel = 'stylesheet'; css.type = 'text/css'; document.getElementsByTagName('head')[0].appendChild(css); })(); </script>   
        <title> Student Account Management</title>
    </head>
    <body>
        <nav>
            <input id="nav-toggle" type="checkbox">
            <div class="logo">
                <h2>BUCEILS HS</h2>
                <h3>ONLINE VOTING SYSTEM</h3>
            </div>
            <label for="btn" class="icon"><span class="fa fa-bars"></span></label>
            <input type="checkbox" id="btn">
            <ul>
                <li>
                    <label for="btn-1" class="show">ACCOUNTS</label>
                    <a href="#">ACCOUNTS</a>
                    <input type="checkbox" id="btn-1">
                    <ul>
                        <li><a href="important.html">Students</a></li>
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

    <div class="cheader">
        <h3>STUDENT ACCOUNT MANAGEMENT</h3>
    </div>
    <div class="container">
        <section> 
            <div class="btn-toolbar">

            <!-- import button -->
            <br />
            <form  method="POST" enctype="multipart/form-data">
            <p><label>Please Select File(Only CSV Format)</label></p>
            <input type="file" name="info_file" required="required" accept=".csv">
            
            <input type="submit" name="upload" class="btn btn-button1" value="Upload" />
            </form>
            <!--  -->

            <input id="file-input" type="file" name="name" style="display: none;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />        
            
            <button class="btn btn-button2"  data-title="otp" data-toggle="modal" data-target="#otp"data-placement="top" data-toggle="tooltip" title="Generat OTP for this list"><span class="fa fa-lock"></span> GENERATE OTP</button>

            </div>
        </section>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">            
                    <table class= "center" id="datatable" width="100%" cellspacing="0" cellpadding="2px">
                        <thead>
                            <tr>
                                 <!--Table Heads  -->
                                <th class="text-center">FIRST NAME</th>
                                <th class="text-center">MIDDLE NAME</th>
                                <th class="text-center">LAST NAME</th>
                                <th class="text-center">GENDER</th>
                                <th class="text-center">BU MAIL</th>
                                <th class="text-center">GRADE LEVEL</th>    
                                <th class="text-center">OTP</th>   
                                <th class="text-center">VOTING STATUS</th>   
                                <th class="text-center">TOOLS</th>

                                <tbody>
                                    <tr>
                                        <!-- Example Student Info -->
                                        <td>2018-CS-100363</td>
                                        <td>James</td>
                                        <td>Lebron</td>
                                        <td>8 A</td>
                                        <td>Lebron</td>
                                        <td>8 A</td>
                                        <td>8 A</td>
                                        <td>ajnchs@bicol-u.edu.ph</td>
                                        
                                        <td style="white-space: nowrap;">
                                        <!-- Edit Button -->
                                        <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" data-toggle="tooltip" title="Edit" ><span class="fa fa-edit"></span> EDIT</button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  data-placement="top" data-toggle="tooltip" title="Delete" ><span class="fa fa-trash-alt"></span> DELETE</button>
                                        </td>
                                    </tr>

                                  <!-- Student Info from database -->
                            <?php
                                    while($row = mysqli_fetch_array($result)){
                                    echo '
                                    <tr>
                                        <td>'.$row["fname"].'</td>
                                        <td>'.$row["Mname"].'</td>
                                        <td>'.$row["lname"].'</td>
                                        <td>'.$row["gender"].'</td>
                                        <td>'.$row["bumail"].'</td>
                                        <td>'.$row["grade_level"].'</td>
                                        <td>'.$row["otp"].'</td>
                                        <td>'.$row["voting_status"].'</td>
                                        '
                            ?>
                                        <td style="white-space: nowrap;">
                            
                                        <!-- Edit Button -->
                                        <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" data-placement="top" data-toggle="tooltip" title="Edit" ><span class="fa fa-edit"></span> EDIT</button>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete"  data-placement="top" data-toggle="tooltip" title="Delete" ><span class="fa fa-trash-alt"></span> DELETE</button>
                                        </td>
                            <?php
                                    '</tr>';
                                    }
                            ?>
                                </tbody>
                            </tr>
                        </thead> 
                    </table>
                </div>
            </div>
        </div>
    </div>

    
  
    <div class="modal fade" id="otp" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                    <h4 class="modal-title custom_align" id="Heading">Generate New One Time Password for this list?</h4>
                    <form method = "POST" >
                    <div class="modal-footer ">
                        <button type="submit" name="go" class="btn btn-success" id="go"><span class= "fa fa-check-circle"></span> Continue</button>
                        <button type="button" class="btn btn-default" id= "cancel2" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                    </div>
                     </form>                   
                </div>
            </div>
  <!-- /.modal-content --> 
        </div>
  <!-- /.modal-dialog --> 
    </div>
      <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading">Edit Student Information</h4>

                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Enter Student ID">
                        </div>
                        <div class="form-group">              
                            <input class="form-control " type="text" placeholder="Enter Lastname">
                        </div>
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Enter Firstname">
                        </div>
                        <div class="form-group">
                            <input class="form-control " type="text" placeholder="Enter Grade and Section">
                        </div>
                        <div class="form-group">  
                            <input class="form-control " type="text" placeholder="Enter BU Email">              
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="button" class="btn btn-warning btn-lg" id="save" style="width: 100%;"><span class= "fa fa-check-circle"></span> Save</button>

                        <button type="button" class="btn btn-default" id="cancel" style= "width:100%;" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                    </div>

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
                        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                    </div>

                    <div class="modal-body">             
                        <div class="alert alert-danger">
                            <span class="fa fa-exclamation-triangle"></span> Are you sure you want to delete this Record?
                        </div>
                    </div>

                    <div class="modal-footer ">
                        <button type="button" class="btn btn-success" id="continue" ><span class= "fa fa-check-circle"></span> Continue</button>
                        <button type="button" class="btn btn-default" id= "cancel2" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                    </div>

                </div>
          <!-- /.modal-content --> 
            </div>
            <!-- /.modal-dialog --> 
        </div>
        <div class="footer">
            <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
        </div>

            <script>$(document).ready(function() {
                $('#datatable').DataTable( {
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                } );
                $("[data-toggle=tooltip]").tooltip();
                } );</script>
    </body>        
</html>