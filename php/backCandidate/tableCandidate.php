<?php 
    include_once '../db_conn.php';
    session_start();

    $sql = "SELECT * FROM ((candidate INNER JOIN student ON candidate.student_id = student.student_id) INNER JOIN candidate_position ON candidate.position_id = candidate_position.position_id)";
    $result = mysqli_query($conn,$sql);
    $numrows = mysqli_num_rows($result);
    $string="";

    if($numrows > 0){
      while( $row = mysqli_fetch_assoc($result)){
        if(!empty($row['photo'])){  
            $string .= "<tr candid ='".$row['candidate_id']."'><td style='text-align:middle;'><div class = 'inp_container'><div class = 'button-wrap'><label class = 'button' for ='image' onclick='changePhoto(this)'>Change Photo</label><input type='file' id = image name='image' class='image' style='display:none;'>";
        }else{
            $string .= "<tr candid ='".$row['candidate_id']."'><td style='text-align:middle;'><div class = 'inp_container'><div class = 'button-wrap'><label class = 'button' for ='image' onclick='changePhoto(this)'>Upload Photo</label><input type='file' id = image name='image' class='image' style='display:none;'>";
        }

        $string .= "<td>".$row['lname']."</td>
            <td>".$row['fname']."</td>
            <td data-order='".$row['heirarchy_id']."'>".$row['position_name']."</td>
            <td>".$row['party_name']."</td>
            <td>".$row['platform_info']."</td>
            <td>".$row['credentials']."</td>
            <td style='white-space: nowrap;'>
                <button class='btn btn-primary btn-xs' data-title='Edit' data-target='#edit' data-placement='top' data-toggle='modal' title='Edit' onclick='candidateDisplay(this)'><span class='fa fa-edit'></span> EDIT</button>
                <button class='btn btn-danger btn-xs' data-title='Delete' data-target='#delete' data-placement='top' data-toggle=modal title='Delete' onclick='candidateDelete(this)'><span class='fa fa-trash-alt'></span> DELETE</button>
            </td>
        </tr>";
      }
      echo $string;
    }






  /*  while( $row = mysqli_fetch_assoc($result)){
?>
    <tr>
      <form action="Admincand_uploadphoto.php?id=<?php echo $row['candidate_id']?>" method="POST" enctype="multipart/form-data">
      <?php 
            if(!(empty($row['photo'])||isset($_GET['change']))){//if has photo change photo and has $get change variable
              echo '<td><button name="change">Change Photo</button></td>';
            }
          elseif(isset($_GET['change'])&&$_GET['change']==$row['candidate_id']){
              echo '<td style="text-align:left;"><input type="file" name="datafile"><button name="uploadphoto">Apply Changes</button><button name="cancel" >cancel</button></td>';
          }
          elseif(isset($_GET['change'])&&$_GET['change']!=$row['candidate_id']){
              if(empty($row['photo'])){ //denden was here
                  echo '<td style="text-align:left;"><input type="file" name="datafile"><button name="uploadphoto">Upload</button></td>';
              }else{
                  echo '<td><button name="change">Change Photo</button></td>';
              }
              
          }
            else{
                echo '<td style="text-align:left;"><input type="file" name="datafile"><button name="uploadphoto">Upload</button></td>';
            }
        ?>
            
        </form>
        <td><?php echo $row['lname'];?></td>
        <td><?php echo $row['fname'];?></td>
        <td><?php echo $row['position_name'];?></td>
        <td><?php echo $row['party_name'];?></td>
        <td><?php echo $row['platform_info'];?></td>
        <td><?php echo $row['credentials'];?></td>
        <td style="white-space: nowrap;">
            <button class="btn btn-primary btn-xs" data-title="Edit" data-target="#edit" data-placement="top" data-toggle="tooltip" title="Edit" ><span class="fa fa-edit"></span> <a href="backPos/editCandidate.php?id=<?php echo $row['candidate_id']?>">EDIT</a></button>
            <button class="btn btn-danger btn-xs" data-title="Delete" data-target="#delete"  data-placement="top" data-toggle="tooltip" title="Delete" ><span class="fa fa-trash-alt"></span><a href="backPos/deleteCandidate.php?id=<?php echo $row['candidate_id']?>">DELETE</a></button>
        </td>
    </tr>
<?php
    }
}*/
?>      
