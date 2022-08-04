<HTML>
<TITLE> Admin Page </TITLE>
<HEAD> <U><B> Παρακαλώ εισαγάγετε το περιεχόμενο για το: 
<script type="text/javascript">

window.opener.location.replace("marker_info.php"); //Redirect edw afou kleisei to popup
window.close;

</script>

<HEAD>

<?php
	require("phpsqlajax_dbinfo.php");
	SESSION_START(); 
	$con = mysqli_connect("localhost",$username1,$password1);
	echo $_SESSION['name']; 
	mysqli_select_db($con,$database) or die(mysqli_error($con));;
	mysqli_set_charset($con,'utf8');
	
?>

<BR><BR>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>
<body>
	<BR>
	<form action="2ndPage.php" method="post">
	<div>
	<textarea class = "ckeditor"  id="content" name="content"> 
  	  
 <?php 		
 
	$query = mysqli_query($con, "SELECT html_code FROM demo_qr_array1 WHERE name ='".$_SESSION['name']."'");

	if ($query) { 
	
		while($row = mysqli_fetch_array($query)){ 
			echo $row['0'];
		}
	}	else echo "Error while updating";	
?>
      </textarea> 
      <script type="text/javascript">
         CKEDITOR.replace( 'content' );
      </script>
	  <BR>
      <input type="submit" value="Submit"/>
	  </div>
    </form>
</body>
</html>