<?php //DISABLED YUNG BACKEND NG CAPTCHA: Remove comment tokens on line 23-27 pag babalik na yung captcha
session_start();
include ('db_conn.php');


if (isset($_POST['username']) && isset($_POST['password'])) {
    //login user function
	function loginUser($conn, $userName, $passWord){
		function validate($conn, $data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			$data = $conn->real_escape_string($data);	//added $conn->real_escape_string: escapes special characters 26/04/2021
			return $data;
		 }
	 //gets the input from the textbox in the StudentLogin.php
		 $username = validate($conn, $userName);
		 $pass = validate($conn, $passWord); //hash here
	 
		 if (empty($username)) {
			 header("Location: ..\index.php?error=E-mail is required");
			 exit();
		 }else if(empty($pass)){
			  header("Location: ..\index.php?error=Password is required");
			 exit();
		 }else{
			$sql = "SELECT * FROM `student` WHERE `bumail`='$username' AND `otp`='$pass'";
	
			$result = mysqli_query($conn, $sql);
	//check if every inputs matched if yes go directly to the dashboard
			if (mysqli_num_rows($result)===1) {
				$row = mysqli_fetch_assoc($result);
				if ($row['bumail']===$username && $row['otp']===$pass) {
					$_SESSION['bumail'] = $row['bumail'];
					$_SESSION['fname'] = $row['fname'];
					$_SESSION['mname'] = $row['Mname'];
					$_SESSION['lname'] = $row['lname'];
					$_SESSION['student_id'] = $row['student_id'];
					$_SESSION['grade_level'] = $row['grade_level']; //added for voting : 03/04/2021 , 11:48am
					$_SESSION['timestamp']=time(); //added for time session
					$student_id = $row['student_id'];
					date_default_timezone_set('Asia/Manila');
					$date = date('Y-m-d');
					$time = date('H:i:s');
					mysqli_query($conn, "INSERT INTO student_access_log(student_id,activity_description,date,time) VALUES($student_id,'Login','$date','$time')");
					header("Location: Student_studDash.php");
					 exit();
				 }else{
					 $_SESSION['incorrectTry']++;
					 header("Location: ..\index.php?error=Incorrect BU mail or Password");
					 exit();
				 }
			 }else{
				 $_SESSION['incorrectTry']++;
				 header("Location: ..\index.php?error=Incorrect BU mail or Password");
				 exit();
			 }
		 }
	}
	//end login function
	if($_SESSION['incorrectTry']>=3){
		//login with captcha
	if(isset($_POST['g-recaptcha-response'])) {
	// RECAPTCHA SETTINGS
	$captcha = $_POST['g-recaptcha-response'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$key = '6LflenwaAAAAAOH5ztqHbtQPMOp2QssNQkVim-5z';
	$url = 'https://www.google.com/recaptcha/api/siteverify';

	// RECAPTCH RESPONSE
	$recaptcha_response = file_get_contents($url.'?secret='.$key.'&response='.$captcha.'&remoteip='.$ip);
	$data = json_decode($recaptcha_response);

	if(isset($data->success) &&  $data->success === true) {
	}
	//    else {
	//      // die('Your account has been logged as a spammer, you cannot continue!');
	//      header("Location: ..\index.php?BOTerror=Oops! It seems like you logged in incorrectly 3 times. Please verify that you are not a bot by clicking the checkbox before logging in.");	
	//      exit();
	//    }
	}else {
		// die('Your account has been logged as a spammer, you cannot continue!');
		header("Location: ..\index.php?BOTerror=Oops! It seems like you logged in incorrectly 3 times. Please verify that you are not a bot by clicking the checkbox before logging in.");	
		exit();
	}
		loginUser($conn, $_POST['username'], $_POST['password']);
	}
	else{
		loginUser($conn, $_POST['username'], $_POST['password']);
	}
     
}else{
    $_SESSION['incorrectTry']++;
	header("Location: ..\index.php"); //header("Location: ..\Login UI v2\html\AdminLogin.php");
	exit();
}

?>
