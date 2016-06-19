<?php

	require_once ('connMysql.php');
	
	$N = 9;
	
	// insert to class_list
	//$query = "INSERT INTO class_list (class_year, this_year, semester, teacher_ac, student_ac, w_r) VALUES (";
	
	// insert to member
	$query = "INSERT INTO member (ac, pw, name, sex, birthday, mail, telephone, addr, in_school, left_school, state, access) VALUES (";
	
	//for($i = 1; $i <= $N; $i++) {
		// insert to class_list
		//$sql = $query . "104, 105, 1, 't4567890', 's000003" . $i . "', 1)";
		
		// insert students to member
		//$sql = $query . "'s000003" . $i . "', '1', 'student" . $i . "', 'f', '2016-06-01', '', '', '高雄市楠梓區大學南路" . $i * 100 . "號', '20160601', '20200601', 1, 'student')";
		
		// insert teachers to member
		$sql = $query . "'t4567890', '1', 'teacher2', 'f', '2016-06-01', '', '', '高雄市楠梓區大學南路', '20160601', '20200601', 1, 'teacher')"; 
		
		if ($conn->query($sql) === TRUE) {
			echo "New record created successfully<br>";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	//}

	$conn->close();
?>