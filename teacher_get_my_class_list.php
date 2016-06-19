<?php

	session_start();							//用來暫存用戶的資料

	require_once ('connMysql.php');

	require_once("login_check.php");			//login_check.php 是用來檢查用戶是否登錄了

	$ac=$_SESSION['ac'];	
	
    $sql = "SELECT cl.this_year, cl.class_year, cl.semester FROM class_list as cl, member as m
			where m.ac = cl.student_ac and cl.teacher_ac = '".$ac."'  
			ORDER BY this_year DESC, semester DESC";
	
	$result=$conn->query($sql);
	


?>

<html>
	<head>
	<link href="style_test.css" rel="stylesheet">
	</head>
<body>
	<table width="800" border="0" align="center" cellpadding="4" cellspacing="0">
		  <td>
			<table>
				<?php
					$num_rows = $result->num_rows;	
					if ($num_rows==0)
						echo "目前尚未建立關於你的導生名單";
					for($i=1;$i<=$num_rows;$i++) 
					{
						$row=$result->fetch_array();				//rs 在這裏, fetch_assoc 的 index 只能用字串, 而 fetch_array 能用數字和字串作 index
						$now = $row['this_year'];
						$year = $row ['class_year'];
						$months = $row['semester'];
				?>
				  <tr>
					<th>
						<?php 
							echo "{$now} 年度   $year";
						?>
						級導生名單
						<?php
							if ($months==1)
								echo " (上學期)";
							else
								echo " (下學期)";
						?>
					</th>
					
					<th>
					<p>--------------------------------------------------------</p>
					</th>
					<th>
					<?php
						$teacher_talking_list_link = "<a href=\"teacher_talking_list.php?class_year=".$year.
																						"&now=".$now.
																						"&sem=".$months.
																						"\">查看/編輯會談記錄</a>";
						
						echo $teacher_talking_list_link;
						
					?>
					</th>
				  </tr>
				<?php
					}
				?>
			</table>
		  </td>
	</table>
</body>


</html>