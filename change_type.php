<?php 
	require("phpsqlajax_dbinfo.php");
	SESSION_START();
	error_reporting(0);

	if($_SESSION['username'] == "admin"||$_SESSION['username'] == "username"){

	$k = $_SESSION['name'];

	$con = mysqli_connect("localhost",$username1,$password1);

	mysqli_select_db($con,$database) or die(mysqli_error($con));;

	mysqli_set_charset($con,'utf8');

	if (mysqli_set_charset($con, "utf8")) {

		$type_retrieval = mysqli_query($con, "SELECT type,content FROM demo_qr_array1 WHERE name ='".$k."'");
	
		while($row = mysqli_fetch_assoc($type_retrieval)) {
		
			$type=$row['type'];
			if($type == 0) {
				$new_type=1; //0->1
			}
			else $new_type=0; //1->0

			$update_type = mysqli_query($con, "UPDATE demo_qr_array1 SET type ='".$new_type."' WHERE name ='".$_SESSION['name']."'");
			header( "refresh:0; url=marker_info.php" );
			
			} 
		}	
	}
?>