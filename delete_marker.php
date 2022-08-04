 <?php
 	error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
	require("phpsqlajax_dbinfo.php");
	SESSION_START();
	if($_SESSION['username'] == "admin"||$_SESSION['username'] == "username"){

	$con = mysqli_connect("localhost",$username1,$password1,$database);
	
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	mysqli_set_charset($con,'utf8');
	
	 
	if (mysqli_set_charset($con, "utf8")) {
	
		$sql1 = "DELETE FROM demo_qr_array1 WHERE name='" . $_SESSION['name'] . "'"; //delete from array1

			if (mysqli_query($con, $sql1)) { //successful delete
			
				header( "refresh:0; url=map.php" );
				
		} else {
				echo'<br>';
				echo "Error deleting record: " . mysqli_error($con);
			}
		}
	}
		 
	?>