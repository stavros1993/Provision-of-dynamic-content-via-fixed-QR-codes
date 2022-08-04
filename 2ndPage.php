<HTML>
<TITLE>
ADDING TO DB
</TITLE>
<head>
<script type="text/javascript">

window.opener.location.replace("marker_info.php"); //Redirect edw afou kleisei to popup
window.close;

</script>
</head>
<body>
<?php
		require("phpsqlajax_dbinfo.php");

		SESSION_START();

		echo $_POST['content'];
	
		if (empty($_POST['content'])) { 
		
		 header( "refresh:0; url=edit_1.php" );
		 die();
		}
	
		$code = $_POST['content'];
		
		$con = mysqli_connect("localhost",$username1,$password1,$database);

		mysqli_set_charset($con,'utf8');
		
		if (mysqli_set_charset($con, "utf8")) {
			if (empty($_POST['content'])){ echo "<p> Please enter </p>";
				header( "refresh:0; url=edit_1.php" );
		}	else {

			echo $_POST['content'];
		
				if ($result = mysqli_query($con, "SELECT * FROM demo_qr_array1 WHERE name ='".$_SESSION['name']."'")) {
					
					$query = mysqli_query($con, "UPDATE demo_qr_array1 SET html_code='".$code."' WHERE name ='".$_SESSION['name']."'");
					echo "<script>window.close();</script>";
					header( "refresh:0; url=marker_info.php" );
								
					mysqli_free_result($result);

				} else {

						echo "Can't execute query";
						header( "refresh:0; url=marker_info.php" );
						
				}
			}

		}
	
	header( "refresh:0; url=marker_info.php" );
?>
    </div>
   </div>
  </div>
 </body>
</html>