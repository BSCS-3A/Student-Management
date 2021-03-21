<?php
    include('print.php');
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
    
    <title> Vote Summary</title>
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
    <div class="cheader">
        <h3>VOTE SUMMARY</h3>
    </div>
    <div class="container">
       <section> <form method="POST" action="print.php">
        <button name="prnt" id="prnt" class="btn btn-button1" type="submit" data-placement="top" data-toggle="tooltip" title="Print Vote Summary"><span class="fa fa-print"></span> PRINT SUMMARY</button>    
     </form>        
     </section>
              <div class="row">
              <div class="col-md-12">
     <div class="table-responsive">            
      <table class= "center" id="datatable" width="100%" cellspacing="0" cellpadding="0">
                          <thead>
                              <tr> 
                                  <th rowspan="2" colspan="1" class="text-center">STUDENT <span class="fa fa-info-circle" data-placement="top" data-toggle="tooltip" title="Student Name is encrypted for privacy purposes."></span></th>
                                  <th rowspan="2" colspan="1" class="text-center">PRESIDENT</th>
                                  <th rowspan="2" colspan="1" class="text-center">VICE PRESIDENT</th>
                                  <th rowspan="2" colspan="1" class="text-center">SECRETARY</th>    
                                  <th rowspan="2" colspan="1" class="text-center">TREASURER</th>
                                  <th rowspan="2" colspan="1" class="text-center">AUDITOR</th>
                                  <th rowspan="1" colspan="6" class="text-center">REPRESENTATIVES</th>
                              </tr>
                              <tr>
                                <th class="text-center">7</th>    
                                <th class="text-center">8</th>  
                                <th class="text-center">9</th>  
                                <th class="text-center">10</th>  
                                <th class="text-center">11</th>  
                                <th class="text-center">12</th> 
                            </tr>
                          </thead>      
                          <tbody>
                             
                          <?php
	                        $db = mysqli_connect('localhost', 'root', '', 'finaldatabase');
	                        //get the all votes of each student (discard abstain)
	                        $sqlget = "SELECT vote.student_id, vote.status, vote.candidate_id, student.fname FROM vote INNER JOIN student ON vote.student_id = student.student_id WHERE vote.status = 1";  
	                        $query = mysqli_query($db,$sqlget);	
	                        $name = "";
	                        $pos = array_fill(0,11,0);
	                        $flname = array_fill(0,11," ");
	                        $flag = 0;
 	                        while($row = mysqli_fetch_array($query)){
	    	                if($row['student_id']!=$name && $flag == 0){?>
		                    <tr><td><?php echo md5($row['student_id'])?></td><?php
		                    $flag = 1;
		                    $name=$row['student_id'];
		                    $sqlget2 = "SELECT student_id, position_id FROM candidate WHERE candidate_id = ".$row['candidate_id'];
		                    $query2 = mysqli_query($db,$sqlget2);
		                    $row2 = mysqli_fetch_array($query2);
		                    $sqlget3 = "SELECT fname,lname FROM student WHERE student_id = ".$row2['student_id'];
		                    $query3 = mysqli_query($db,$sqlget3);
		                    $row3 = mysqli_fetch_array($query3);
		                    $ho = $row2['position_id']-1;
		                    $pos[$ho] = 1;
		                    $flname[$ho] = $row3['fname']." ".$row3['lname'];
		                    }
		
		                    else if($row['student_id']!=$name && $flag == 1){
			                    for($x = 0; $x < 11; $x++){	
				                    if($pos[$x]==1){?>
                                    <td><?php echo $flname[$x];?></td><?php
			                         }
			                        else{?>
                                    <td><?php echo "Abstained";?></td><?php
			                         }
                            }?></tr><tr><?php
		                    $name=$row['student_id'];?>
                            <td><?php echo md5($row['student_id'])?></td><?php
			                unset($pos);
			                unset ($flname);
			                $pos = array_fill(0,11,0);
			                $flname = array_fill(0,11," ");
			                $sqlget2 = "SELECT student_id, position_id FROM candidate WHERE candidate_id = ".$row['candidate_id'];
                            $query2 = mysqli_query($db,$sqlget2);
                            $row2 = mysqli_fetch_array($query2);
                            $sqlget3 = "SELECT fname,lname FROM student WHERE student_id = ".$row2['student_id'];
                            $query3 = mysqli_query($db,$sqlget3);
                            $row3 = mysqli_fetch_array($query3);
                            $ho = $row2['position_id']-1;
                            $pos[$ho] = 1;
                            $flname[$ho] = $row3['fname']." ".$row3['lname'];
                        }

                            else if ($row['student_id'] == $name){
                            $sqlget2 = "SELECT student_id, position_id FROM candidate WHERE candidate_id = ".$row['candidate_id'];
                            $query2 = mysqli_query($db,$sqlget2);
                            $row2 = mysqli_fetch_array($query2);
                            $sqlget3 = "SELECT fname,lname FROM student WHERE student_id = ".$row2['student_id'];
                            $query3 = mysqli_query($db,$sqlget3);
                            $row3 = mysqli_fetch_array($query3);
                            $ho = $row2['position_id']-1;
                            $pos[$ho] = 1;
                            $flname[$ho] = $row3['fname']." ".$row3['lname'];
                        }
                    }
                    
                            for($x = 0; $x < 11; $x++){	
                                if($pos[$x]==1){?>
		                       <td><?php echo $flname[$x];?></td><?php
		                       }
		                       else{
                                ?>
			                    <td><?php echo "Abstained";?></td><?php
		                       }
                            }
                            ?></tr>

                          </tbody>
                      </table>
     </div>
          </div>
          </div>
      </div>
    </div>
    <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title custom_align" id="Heading">Import new list?</h4>
      <div class="modal-footer ">
      <button type="button" class="btn btn-success" id="go" ><span class="glyphicon glyphicon-ok-sign"></span> Continue</button>
      <button type="button" class="btn btn-default" id= "cancel2" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
    </div>
      </div>
    </div>
    <!-- /.modal-content --> 
    </div>
    <!-- /.modal-dialog --> 
  </div>


  <div class="footer">
    <p class="footer-txt">BS COMPUTER SCIENCE 3A © 2021</p>
</div>

        </script>
    <script>$(document).ready(function() {     
        $('#datatable').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        } );
        $("[data-toggle=tooltip]").tooltip();
        } );</script>
    
</body>

</html>