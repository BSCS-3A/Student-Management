
<?php
//fetch.php
include "db_conn.php";
$checktime = "SELECT * FROM vote_event"; 
$DnT = $connect->query($checktime);
$rowx =  $DnT->fetch_row(); 
$column = array("student.student_id", "student.fname", "student.Mname", "student.lname", "student.bumail");
$query = "
 SELECT * FROM student";

$query .= " WHERE ";
if(isset($_POST["lvl"]) AND $_POST["lvl"] != 1)
{
 $query .= "grade_level = ".$_POST["lvl"]." AND";
}
else{
 $query .= "grade_level < '10' AND ";
}

if(isset($_POST["search"]["value"]))
{
 $query .= '(student_id LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR lname LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR Mname LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR fname LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR gender LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR bumail LIKE "%'.$_POST["search"]["value"].'%" ';
 $query .= 'OR otp LIKE "%'.$_POST["search"]["value"].'%") ';
}


$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result= mysqli_query($connect, $query);

$data = array();

while($row = mysqli_fetch_array($result))
{
    $now = date("Y-m-d G:i:s");
    $checkcandidate = "SELECT * FROM candidate WHERE student_id =".$row['student_id'];
    $candid = mysqli_query($connect,$checkcandidate);
    $xzzz = mysqli_fetch_array($candid);

 $sub_array = array();
 $sub_array[] = $row["student_id"];
 $sub_array[] = $row["lname"];
 $sub_array[] = $row["fname"];
 $sub_array[] = $row["Mname"];
 $sub_array[] = $row["gender"];
 $sub_array[] = $row["bumail"];
 $sub_array[] = $row["grade_level"];
 $sub_array[] = $row["otp"];
 if($now >= $rowx[1] && $now <= $rowx[2]){
 $sub_array[] = '<button disabled class="btn btn-primary btn-xs EditBtn" data-title="Edit" data-toggle="modal"
    data-placement="top" data-toggle="tooltip" title="Edit"><span class="fa fa-edit"></span> EDIT</button> 
                <button disabled class="btn btn-danger btn-xs DeleteBtn" data-title="Delete" data-toggle="modal"
    data-placement="top" data-toggle="tooltip" title="Delete"><span class="fa fa-trash-alt"></span> DELETE</button> ';
 }
 else{
     if(isset($xzzz['student_id']) && $xzzz['student_id'] == $row['student_id']){
    $sub_array[] = '<button disabled class="btn btn-primary btn-xs EditBtn" data-title="Edit" data-toggle="modal"
    data-placement="top" data-toggle="tooltip" title="Edit"><span class="fa fa-edit"></span> EDIT</button>
                    <button disabled class="btn btn-danger btn-xs DeleteBtn" data-title="Delete" data-toggle="modal"
    data-placement="top" data-toggle="tooltip" title="Delete"><span class="fa fa-trash-alt"></span> DELETE</button> ';
     }
     else{
        $sub_array[] = '<button class="btn btn-primary btn-xs EditBtn" data-title="Edit" data-toggle="modal"
        data-placement="top" data-toggle="tooltip" title="Edit"><span class="fa fa-edit"></span> EDIT</button> 
                        <button class="btn btn-danger btn-xs DeleteBtn" data-title="Delete" data-toggle="modal"
        data-placement="top" data-toggle="tooltip" title="Delete"><span class="fa fa-trash-alt"></span> DELETE</button>';
     }
 }
 
                          
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM student";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);

echo json_encode($output);

?>
