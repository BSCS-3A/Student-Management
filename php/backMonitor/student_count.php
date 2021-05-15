<?php
    // require 'db_connection.php';
    require 'db_conn.php';
    require 'fetch_candidates.php';    
    
    $query = "SELECT grade_level, COUNT(*) as students_voted FROM student GROUP BY grade_level";

    $result = mysqli_query($conn, $query);
    
    $records = array();
	  while($record=mysqli_fetch_array($result)){
      $records[] = array( 
        "grade_level"=>$record['grade_level'],
        "students_voted"=>$record['students_voted']
      );
	  }
    
    $total_students = 0;
    foreach($records as $record){
        if($record['grade_level']==7){
            $total_grade7 = $record['students_voted'];
        }
        if($record['grade_level']==8){
            $total_grade8 = $record['students_voted'];
        }
        if($record['grade_level']==9){
            $total_grade9 = $record['students_voted'];
        }
        if($record['grade_level']==10){
            $total_grade10 = $record['students_voted'];
        }
        if($record['grade_level']==11){
            $total_grade11 = $record['students_voted'];
        }
        if($record['grade_level']==12){
            $total_grade12 = $record['students_voted'];
        }

        $total_students += $record['students_voted'];
    }


    // STUDENT POPULATION COUNTERS USED IN front_Report_v11_0.php AND generate-pdf.php
        // Counts per year-level and overall enrolled student
            $queryEnrolled=mysqli_query($conn, "SELECT sum(case when grade_level = '7' then 1 else 0 end) AS g7,
                sum(case when grade_level = '8' then 1 else 0 end) AS g8,
                sum(case when grade_level = '9' then 1 else 0 end) AS g9,
                sum(case when grade_level = '10' then 1 else 0 end) AS g10,
                sum(case when grade_level = '11' then 1 else 0 end) AS g11,
                sum(case when grade_level = '12' then 1 else 0 end) AS g12,
                count(student_id) AS totalEnrolled FROM student");
            $enrolled = mysqli_fetch_array($queryEnrolled);
            // accessed through: $enrolled[0] --> g7, $enrolled[1] --> g8 ... $enrolled[6] --> total

?>
