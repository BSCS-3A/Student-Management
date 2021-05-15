<?php
// MONITORING GROUP

require 'db_conn.php';						// Link to database
require './backMonitor/student_count.php';			// Link to queries
require './backMonitor/fetch_date.php';				// Link to queries in date
require './backMonitor/fetch_report.php';			// Link to queries in archive
require_once('../other/TCPDF-main/tcpdf.php'); 			// Include the main TCPDF library

//---------------------Create header and footer
class PDF extends TCPDF { 
	public function Header(){
		if (count($this->pages) === 1){ //displays header on first page only    
			
			//BU Seal
			$imageFile= K_PATH_IMAGES.'Slide11.png';
			$this->Image($imageFile,20,8,20,'','png','','T',false,300,'',false,false,0,false,false,false);
			
			//BUCEILS Seal
			$imageFile= K_PATH_IMAGES.'Slide22.png';
			$this->Image($imageFile,41,8,20,'','png','','T',false,300,'',false,false,0,false,false,false);
			
			//SSG Seal
			$imageFile= K_PATH_IMAGES.'Slide44.png';
			$this->Image($imageFile,63,8,20,'','png','','T',false,300,'',false,false,0,false,false,false);

			//Header text
			$this->SetFont('times','B',12);
			$this->Cell(96.5,3, 'COMMISSION ON ELECTION (COMELEC)',0,1,'R'); 
			$this->SetFont('times','',12);
			$this->Cell(170,3, 'BICOL UNIVERSITY INTEGRATED LABORATORY',0,1,'R'); 
			$this->Cell(171,3, 'SCHOOL (BUCEILS) HIGH SCHOOL DEPARTMENT',0,1,'R'); 
			$this->SetFont('times','I',12);
			$this->Cell(149.5,3,'Bicol University Main Campus, Legazpi City',0,1,'R'); 
	}//end if
}//end header


	public function Footer(){
			$this->SetY(-20); 	
			$this->Cell(190,5,'Page '.$this->getAliasNumPage().' of '.$this->getAliasNbPages(),0,false,'R',0,'',0, false,'T','M');	//page number		
	}//end footer
}//end class


//---------------------Create new PDF document
$pdf = new PDF('p', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle('BUCEILS SSG ELECTION REPORT'); 			
$pdf->setFooterFont(Array('times', '', '12'));
$pdf->SetMargins(21.20, 20, 25);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// -------------------Add page
$pdf->AddPage();
$pdf->SetFont('times','',12);
ob_start();	
	
	//date generated
	date_default_timezone_set("Asia/Manila");
	$today=date("F j, Y");	
	$acadyear=date("Y");	

	$pdf->Ln(23); 
	$pdf->Cell(40,5,''.$today,0,0,'L');

	$queryVoteEvent=mysqli_query($conn, "SELECT * FROM vote_event"); 
		while($dataRead=mysqli_fetch_array($queryVoteEvent)){ 
			$pdf->Ln(15);
			$pdf->SetFont('times','B',12);
			$pdf->Multicell(170,2, 'DECLARATION OF RESULTS FOR BICOL UNIVERSITY INTEGRATED LABORATORY SCHOOL (BUCEILS) SUPREME STUDENT GOVERNMENT (SSG) ELECTION FOR A.Y. '.$acadyear.'-'.($acadyear+1),0,'C',0,1,'','',true); 

			$pdf->Ln(10); 
			$pdf->SetFont('times','',12);
			$pdf->Multicell(170,2, 'We, the Commission on Election (COMELEC), hereby announce the results of the Student Council Election for the Academic Year '.$acadyear.'-'.($acadyear+1) .' held between '.date('F j, Y', strtotime($dataRead['start_date'])).' ('.date('g:i A', strtotime($dataRead['start_date'])). ') to '.date('F j, Y', strtotime($dataRead['end_date'])).' ('.date('g:i A', strtotime($dataRead['end_date'])) .') using the BUCEILS Online Voting System. Below is a table of the summary of results:																																																																																																																																																',0,'J',0,1,'','',true); //empty space is for justify 
		}//end while 


// -------------------Display table 
	$pdf->Ln(5); 
	$pdf->SetFillColor(224,235,255);
	$pdf->SetFont('times','B',12);
	
		//column titles
		$pdf->Cell(65,10.8,'CANDIDATES',1,0,'C',1);
		$pdf->Cell(88,5,'YEAR LEVEL VOTES',1,0,'C',1);
		$pdf->Cell(17,10.8,'TOTAL',1,0,'C',1);
		$pdf->Cell(0,5,'',0,1);  //spacer
		$pdf->Cell(65,5,'',0,0); //spacer
		$pdf->Cell(14.7,5,'7',1,0,'C',1);     
		$pdf->Cell(14.7,5,'8',1,0,'C',1);   
		$pdf->Cell(14.7,5,'9',1,0,'C',1);   
		$pdf->Cell(14.6,5,'10',1,0,'C',1);   
		$pdf->Cell(14.6,5,'11',1,0,'C',1);   
		$pdf->Cell(14.7,5,'12',1,1,'C',1);

$query=mysqli_query($conn, "SELECT candidate.candidate_id, candidate.student_id, candidate.position_id, candidate.total_votes, student.lname, student.fname, student.mname, candidate_position.heirarchy_id, candidate_position.position_name FROM candidate INNER JOIN student ON candidate.student_id = student.student_id INNER JOIN candidate_position ON candidate.position_id = candidate_position.heirarchy_id ORDER BY heirarchy_id"); 

		$flag = 0;
		$temp = 0;
		while($data=mysqli_fetch_array($query))
		{ 	
			if($temp==0 || $temp!=$data['heirarchy_id']){
				$flag = 0;
			}
			if($flag==0){
				$pdf->SetFont('','B',12);
				$pdf->SetFillColor(224,235,255);
				$pdf->Cell(170,5, strtoupper($data['position_name']),1,1,'L',1);	//print position name once
				$flag = 1;
				$sumGrade7 = 0;
				$sumGrade8 = 0;
				$sumGrade9 = 0;
				$sumGrade10 = 0;
				$sumGrade11 = 0;
				$sumGrade12 = 0;

				// Max votes per position to determine tie
					$pos_id = $data['position_id'];
					$rowSQL = mysqli_query($conn, "SELECT MAX(total_votes) AS tempWinner FROM candidate WHERE position_id = '$pos_id'");
			        list($max) = mysqli_fetch_row($rowSQL);
			}//end if

			$string = '';
			// if candidate is winner, set fill color to green
				if (isWinner($conn, $data['fname'], $data['mname'], $data['lname'], $last_election_date))
				{
					$pdf->SetFillColor(144,238,144);
					$color = 1;
					if (numTie($conn, $pos_id, $max)>1)
					{ // add '+1' beside votes if winner in tie
						$string = ' +1';
					}
				} else {
					$color = 0;
				}

				//concat last name, first name, middle name
				if(empty($data['mname']))
					$data['fullname']=$data['lname'].", ".$data['fname'];
				else 														//gets first letter middle initial 
					$data['fullname']=$data['lname'].", ".$data['fname']." ".mb_substr($data['mname'],0,1).".";

					//display full name w/ resize condition
					if(strlen($data['fullname'])<40){
						$pdf->SetFont('','',12); 
						$pdf->Cell(65,5,$data['fullname'],1,0,'L',$color);			
					}else{ 
						$pdf->SetFont('','',10); 
						$pdf->Cell(65,5,$data['fullname'],1,0,'L',$color);			
					}

//----------NUMBER OF VOTES RECEIVED PER CANDIDATE PER GRADE LEVEL
			$id = $data['candidate_id'];
			for($i = 7,$j=0; $i <=12;$i++, $j++)
			{
				$result = mysqli_query($conn,"SELECT * FROM vote INNER JOIN student ON vote.student_id = student.student_id where candidate_id = '$id' and grade_level = '$i' and status='Voted' ");
				$votesReceived[$j] = mysqli_num_rows($result);
			}
				$votesReceivedTotal= $votesReceived[0]+$votesReceived[1]+$votesReceived[2]+$votesReceived[3]+$votesReceived[4]+$votesReceived[5];

				$pdf->Cell(14.7,5,$votesReceived[0],1,0,'C',$color);  		//column total grade 7 vote
				$pdf->Cell(14.7,5,$votesReceived[1],1,0,'C',$color);   		//column total grade 8 vote
				$pdf->Cell(14.7,5,$votesReceived[2],1,0,'C',$color);  		//column total grade 9 vote
				$pdf->Cell(14.6,5,$votesReceived[3],1,0,'C',$color);		//column total grade 10 vote
				$pdf->Cell(14.6,5,$votesReceived[4],1,0,'C',$color);   		//column total grade 11 vote
				$pdf->Cell(14.7,5,$votesReceived[5],1,0,'C',$color);  		//column total grade 12 vote
				$pdf->Cell(17,5,$votesReceivedTotal.$string,1,1,'C',$color);
			
				$sumGrade7+=$votesReceived[0];
				$sumGrade8+=$votesReceived[1];
				$sumGrade9+=$votesReceived[2];
				$sumGrade10+=$votesReceived[3];
				$sumGrade11+=$votesReceived[4];
				$sumGrade12+=$votesReceived[5];

				$temp = $data['heirarchy_id'];

//----------DISPLAYS ABSTAIN
$queryGroup=mysqli_query($conn, "SELECT max(student_id) as last FROM candidate group by position_id");
while($lastCandidate = mysqli_fetch_array($queryGroup)){
		if($data['student_id']==$lastCandidate['last']){ 
			$pdf->SetFont('','',12);
			$pdf->Cell(65,5, 'ABSTAIN',1,0,'L',0);					

				//calculates number of abstained per grade level
				$abstainedGrade7=$enrolled[0]-$sumGrade7;
				$abstainedGrade8=$enrolled[1]-$sumGrade8;
				$abstainedGrade9=$enrolled[2]-$sumGrade9;
				$abstainedGrade10=$enrolled[3]-$sumGrade10;
				$abstainedGrade11=$enrolled[4]-$sumGrade11;
				$abstainedGrade12=$enrolled[5]-$sumGrade12;
				
				//displays abstain
				$pdf->Cell(14.7,5,$abstainedGrade7,1,0,'C',0);  			//column total grade 7 vote
				$pdf->Cell(14.7,5,$abstainedGrade8 ,1,0,'C',0);   			//column total grade 8 vote
				$pdf->Cell(14.7,5,$abstainedGrade9,1,0,'C',0);  			//column total grade 9 vote
				$pdf->Cell(14.6,5,$abstainedGrade10,1,0,'C',0);				//column total grade 10 vote
				$pdf->Cell(14.6,5,$abstainedGrade11,1,0,'C',0);   			//column total grade 11 vote
				$pdf->Cell(14.7,5,$abstainedGrade12,1,0,'C',0);  			//column total grade 12 vote
				$pdf->Cell(17,5,$abstainedGrade7+$abstainedGrade8+$abstainedGrade9+$abstainedGrade10+$abstainedGrade11+$abstainedGrade12,1,1,'C',0); 										
		}//end if
	}//end while	
}//end while

//----------DISPLAYS NUMBER OF ENROLLED STUDENTS 
				$pdf->SetFont('','B',12);
				$pdf->Cell(170,5,'' ,1,1,'C',0); 				//empty row spacer	
				$pdf->Cell(65,5,'Number of Enrolled Students:',1,0,'L',0);		
		
				$pdf->Cell(14.7,5,$enrolled[0],1,0,'C',0);     	//enrolled grade 7
				$pdf->Cell(14.7,5,$enrolled[1],1,0,'C',0);   	//enrolled grade 8
				$pdf->Cell(14.7,5,$enrolled[2],1,0,'C',0);   	//enrolled grade 9
				$pdf->Cell(14.6,5,$enrolled[3],1,0,'C',0);   	//enrolled grade 10
				$pdf->Cell(14.6,5,$enrolled[4],1,0,'C',0);   	//enrolled grade 11
				$pdf->Cell(14.7,5,$enrolled[5],1,0,'C',0);  	//enrolled grade 12
				$pdf->Cell(17,5,$enrolled[6],1,1,'C',0); 		//total enrolled	

//----------DISPLAYS NUMBER OF VOTES RECEIVED 
	$sumNumberOfVotes=$studVoted[0]+$studVoted[1]+$studVoted[2]+$studVoted[3]+$studVoted[4]+$studVoted[5];

				$pdf->Cell(65,5,'Number of Votes Received:',1,0,'L',0);	
				$pdf->Cell(14.7,5,$studVoted[0],1,0,'C',0);     		//received grade 7
				$pdf->Cell(14.7,5,$studVoted[1],1,0,'C',0);   			//received grade 8
				$pdf->Cell(14.7,5,$studVoted[2],1,0,'C',0);   			//received grade 9
				$pdf->Cell(14.6,5,$studVoted[3],1,0,'C',0);   			//received grade 10
				$pdf->Cell(14.6,5,$studVoted[4],1,0,'C',0);   			//received grade 11
				$pdf->Cell(14.7,5,$studVoted[5],1,0,'C',0);  			//received grade 12
				$pdf->Cell(17,5,($sumNumberOfVotes),1,1,'C',0); 		//total received	

// -------------------Display Text
	$pdf->Ln(10); 
	$pdf->SetFont('','',12);
	$pdf->Multicell(170,2, 'In the event of a tie between candidates vying for the same position, an additional point, indicated by the plus one (+1) symbol beside the original vote count, was given to the candidate who won the toss coin. Leading candidate/s who failed to meet the minimum number of votes required to meet the electoral quota shall not be elected to the position he/she/they are running for. The newly elected candidates’ names are highlighted in the table.                                                             ',0,'J',0,1,'','',true); 

// -------------------Display Signatory
	$pdf->Ln(10); 
	$pdf->SetFont('','B',12);
	$pdf->Cell(20,1,'Certified true and correct by:',0,0);
	$pdf->Ln(5);

$fileJson = file_get_contents('../other/sig_array.json');
             $decoded = json_decode($fileJson, true);
             $id = explode(",",$decoded);
             $id = array_filter($id);
             $in = '(' . implode(',', $id) .')';

			$querySignatory=mysqli_query($conn, "SELECT * FROM admin WHERE admin_id IN". $in);
			while ($resSignatory = mysqli_fetch_array($querySignatory)){ 
				$pdf->Ln(15); 					//space between lines 
				$pdf->SetFont('','',12);			//format
                $pdf->Cell(20,5,strtoupper($resSignatory['admin_lname']).", ".strtoupper($resSignatory['admin_fname']),0,1);
 				$pdf->SetFont('','BI',12);			//format
 				$pdf->Cell(20,5,strtoupper($resSignatory['comelec_position']),0,1);
            }

// -------------------Output PDF
ob_end_clean();
$pdf->Output('Official Election Result.pdf', 'I');
