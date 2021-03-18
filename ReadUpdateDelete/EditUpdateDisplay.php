<!--############################################################################################################################################################################################## -->
<!-- CONFIRMATION MESSAGE FOR EDIT AND DELETE-->
                        <?php
                            include 'edit.php';
                        ?>

                        <?php 
                        if (isset($_SESSION['message'])): ?>
                          <div class="alert alert-<?=$_SESSION['msg_type']?>">
                                <?php
                                    echo $_SESSION['message'];
                                    unset($_SESSION['message']);
                                ?>
                          </div>
                        <?php endif ?>
<!--############################################################################################################################################################################################## -->
                     <?php  # START OF CONNECTING TO DATABASE
                        $connection = mysqli_connect("localhost", "root", "");
                        $db = mysqli_select_db($connection, 'seproject');

                        $query = "SELECT * FROM stud_info";
                        $query_run = mysqli_query($connection, $query); #END OF CONNECTING TO DATABASE
                        while ($row=mysqli_fetch_array($query_run)){ #START OF FETCHING OF RECORDS FROM DATABASE
                      ?> 
                        <tr><!-- EDIT BASED ON ATTRIBUTES -->
                            <td><?php echo $row['student_id']; ?></td>
                            <td><?php echo $row['last_name']; ?></td>
                            <td><?php echo $row['first_name']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['grade_level']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td style="white-space: nowrap;">
                              <button class="btn btn-primary btn-xs EditBtn" data-title="Edit" data-toggle="modal" data-placement="top" data-toggle="tooltip" title="Edit" ><span class="fa fa-edit"></span> EDIT</button>
                              <button class="btn btn-danger btn-xs DeleteBtn" data-title="Delete" data-toggle="modal" data-placement="top" data-toggle="tooltip" title="Delete" ><span class="fa fa-trash-alt"></span> DELETE</button>
                            </td>
                        </tr>
                      <?php } ?> <!-- END FETCHING OF RECORDS FROM DATABASE -->
<!--############################################################################################################################################################################################## -->
<!-- EDIT MODAL -->
<form action="edit.php" method="POST">
      <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title custom_align" id="Heading">Edit Student Information</h4>
                </div>
                <div class="modal-body">
                <div class="form-group">
                    <input class="form-control " name="Update_ID" id="Update_ID" type="text" readonly required>
                </div>
                <div class="form-group">
                    <input class="form-control " name="last_name" id="last_name" type="text" placeholder="Enter Last Name" required>
                </div>
                <div class="form-group">              
                    <input class="form-control " name="first_name" id="first_name" type="text" placeholder="Enter First Name" required>
                </div>
                <div class="form-group">
                    <input class="form-control " name="gender" id="gender" type="text" placeholder="Enter Gender" required>
                </div>
                <div class="form-group">
                    <input class="form-control " name="grade_level" id="grade_level" type="text" placeholder="Enter Grade Level" required>
                </div>
                <div class="form-group">  
                    <input class="form-control " name="email" id="email" type="text" placeholder="Enter Email" required>              
                 </div>
            </div>
                <div class="modal-footer ">
                    <button type="submit" name = "save" class="btn btn-warning btn-lg" id ="save" style="width: 100%;"><span class= "fa fa-check-circle" ></span> Save</button>
                    <button type="button" class="btn btn-default" id="cancel" style= "width:100%;" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                </div>
            </div>
          <!-- /.modal-content --> 
          </div>
            <!-- /.modal-dialog --> 
      </div> 
</form> 
<!--############################################################################################################################################################################################## -->
<!-- DELETE MODAL -->
                          <form action="delete.php" method="POST">
                            <div class="modal-body">             
                              <div class="alert alert-danger"><span class="fa fa-exclamation-triangle"></span> Are you sure you want to delete this Record?</div>
                                <input type="hidden" name="Delete_ID" id="Delete_ID">
                            </div>
                            <div class="modal-footer ">
                              <button type="submit" name="continue" class="btn btn-success" id="continue" ><span class= "fa fa-check-circle"></span> Continue</button>
                              <button type="button" class="btn btn-default" id= "cancel" data-dismiss="modal"><span class="fa fa-times-circle"></span> Cancel</button>
                            </div>
                          </form>
<!--############################################################################################################################################################################################## -->
<!-- DELETE SCRIPT -->
                <script>
                  $(document).ready(function() {
                    $('.DeleteBtn').on('click', function() {
                      $('#delete').modal('show');

                      $tr = $(this).closest('tr');

                      var data = $tr.children("td").map(function(){
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
                    $('.EditBtn').on('click', function() {
                      $('#edit').modal('show');

                      $tr = $(this).closest('tr');

                      var data = $tr.children("td").map(function(){
                        return $(this).text();
                      }).get();

                      console.log(data);

                      $('#Update_ID').val(data[0]);
                      $('#last_name').val(data[1]);
                      $('#first_name').val(data[2]);
                      $('#gender').val(data[3]);
                      $('#grade_level').val(data[4]);
                      $('#email').val(data[5]);

                    });
                  });
                </script>
<!--############################################################################################################################################################################################## -->