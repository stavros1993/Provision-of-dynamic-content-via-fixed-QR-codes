<html>
<head>
<title> Preview </title>
</head>
<body>

<form action = "preview_marker.php" method = "GET">
	<input type = "text" name = "id" style="display:none;">
	<input type = "submit" style="display:none;">
</form>

<?php // den doulevei to preview_marker.php?id=

	require("phpsqlajax_dbinfo.php");
	session_start();
	error_reporting(0);
	ini_set('display_errors', 0);
	
	$con = mysqli_connect("localhost",$username1,$password1,$database);





	if (mysqli_set_charset($con, "utf8")) {
		
		if(isset($_GET['id'])){

			$id = htmlentities($_GET['id'], ENT_QUOTES, 'UTF-8');
		}	
		
		$q1 = mysqli_query($con, "SELECT id FROM demo_qr_array1 WHERE name ='".$_SESSION['name']."'");

		while($row = mysqli_fetch_assoc($q1)) {
		
			$id=$row['id'];
		
		}
		$query = mysqli_query($con, "SELECT type,content FROM demo_qr_array1 WHERE id ='".$id."'");
	
		while($row = mysqli_fetch_assoc($query)) {
		
		
			$type=$row['type'];
			$content=$row['content'];	
			
			
			if($type == 0) {
				
				
				//$id = htmlentities($_GET['id'], ENT_QUOTES, 'UTF-8');

				header('Location: '.$content);
			}
			else {
				
				
				$query = mysqli_query($con, "SELECT html_code FROM demo_qr_array1 WHERE id = '$id'");
			
				if($query === FALSE) { 

					die(mysql_error()); // TODO: better error handling
				}

				while($row = mysqli_fetch_array($query))
				{
					$html = $row['html_code'];
					echo $html;
				}
					echo '</div>';
			}

		}
	}

?>

</body>
</html>