<?php
    include_once "db_conn.php";
    session_start();

    
    if(isset($_POST['image'])){
        $candidateid = $_POST['candidateid'];
        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = "../user/img/".uniqid('',true).'.jpg';

        
        $slqphotofind = "SELECT `photo` FROM `candidate` WHERE `candidate_id`= '$candidateid'"; 
        $resultphotofind= mysqli_query($conn,$slqphotofind);
        $rowfindphoto = mysqli_fetch_assoc($resultphotofind);

        // pasok na sa database 
        $sql = "UPDATE `candidate` SET `photo` = '$image_name' WHERE `candidate_id` = $candidateid";
        $result = mysqli_query($conn,$sql);
        if($result){
            if(!empty($rowfindphoto['photo'])){//if has photo delete photo in directory
                $path = $rowfindphoto['photo'];
                unlink($path);
            }
            file_put_contents($image_name, $data);
            echo "upload successful";
            //lagay logs
        }


/*      $file = $_FILES['image']; 
        
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = array("jpg","png");
        echo $file;
    
        if(in_array($fileActualExt,$allowedExt)){
            if($fileError === 0){
                if($fileSize < 500000){
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $url= "../user/img/".$fileNameNew;
                    $fileDestination = mysqli_real_escape_string($conn,$url);
                    
                    $sql = "UPDATE candidate SET photo = '$fileDestination' WHERE candidate.candidate_id = $candidateid";
                    $result = mysqli_query($conn,$sql);
                    if($result){//if query successful
                        if(move_uploaded_file($fileTmpName,$fileDestination)){//if upload file successfull
                            echo "success";
                            $_SESSION['message']="upload photo succesfull";
                        }else{
                            $sqlremove = "UPDATE candidate SET photo = '' WHERE candidate.candidate_id = $candidateid";
                            mysqli_query($conn,$sqlremove); 
                            echo "failed to upload picture to website";   
                        }
//edit                        
                    }else{ 
                        echo "<script>alert('query failed please try again'); 
                            window.location.href= 'Admin_candidate.php';
                            </script>"; 
                    }
                    
                }else{
                    echo "<script>alert('file is too big'); 
                            window.location.href= 'Admin_candidate.php';
                            </script>";
                }
            }else{
                echo "<script>alert('error uploading file'); 
                        window.location.href= 'Admin_candidate.php';
                        </script>"; 
            }
        }else{
            echo "<script>alert('file not supported'); 
                    window.location.href= 'Admin_candidate.php';
                    </script>"; 
        }
//edit
    }
    if(isset($_POST['change'])){
        $change_id=$_GET['id'];
        header("Location:Admin_candidate.php?change=".$change_id."");
    }
    if(isset($_POST['cancel'])){
        $_SESSION['message'] = "cancelled changing of photo";
        header("Location:Admin_candidate.php");
    }

*/
}
?>