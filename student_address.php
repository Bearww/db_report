<!DOCTYPE html>
<html>
<head>
<script
src="http://maps.googleapis.com/maps/api/js">
</script>

<script>
function initialize()
{
	var mapOpt = {
		center:new google.maps.LatLng(22.7340927,120.2814604),
		zoom:15,
		mapTypeId:google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("googleMap"),mapOpt);
	
	var addr = [];
	<?php
	
	session_start();
	
	require_once ('connMysql.php');

	require_once("login_check.php");			//login_check.php �O�Ψ��ˬd�Τ�O�_�n���F
	
	$sql = "SELECT member.addr FROM member, class_list WHERE class_list.teacher_ac='" . $_SESSION["ac"] . "'
			AND class_list.student_ac=member.ac";
	
	$result = $conn->query($sql);									// mysql_query �d��, ���o�d�ߪ����G
	
	// get data of each row
    while($row = $result->fetch_assoc()) {
		echo "addr.push(\"" . $row["addr"] . "\");";
	}
	
	?>

	var marker, infoWindow = new google.maps.InfoWindow();
	
	for(var i = 0; i < addr.length; i++) {
		geocoder.geocode({ 'address' : addr[i]}, function(results, status) {
			if(status == google.maps.GeocoderStatus.OK) {
				marker = new google.maps.Marker({
					position : results[0].geometry.location,
				});
				
				// Allow each marker to have an info window
				google.maps.event.addListener(marker, 'click', function(marker, i) {
					return function() {
						infoWindow.setContent(i);
						infoWindow.open(map, marker);
					}
				} (marker, i));
			}
		});
	}

}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="googleMap" style="width:500px;height:380px;"></div>

</body>
</html>