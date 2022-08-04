<html>
 <head>
  <title>My website</title>
  
  <script type="text/javascript" language="javascript">
  
	function OpenWindow() {
	 
		window.open('preview_marker.php','win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=500,directories=no,location=no') 

	}
	
	</script>
	  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	  <link rel="stylesheet" type="text/css" href="style.css" />
	<style>
	  form { display: inline; }
	  
	  #nav { padding-bottom: 37%; }
	  
	  li a { display: block; }

	</style>
	</head>
	<body>
	<?php require("phpsqlajax_dbinfo.php");?>
	<div id="container">
	<div id="header">
		<h1><a href="Home.php"><img src="logo.png" align="center" alt="logo" style="width:300px;height:60px;"></a><a href="http://gav.uop.gr/"><img src="gavlab.png" align="right" alt="logo" style="width:200px;height:55px;"></a></h1>
	</div>
    <div id="content" align="center">
		<div id="nav">
		<h3 align="center">Πλοήγηση</h3>
		<ul id="menu">
	    <li align="center"><a href="Home.php">Αρχική</a></li>
		<li align="center"><a href="Map.php">Χάρτης</a></li>
		<?php  
			SESSION_START(); 
			error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED ^ E_WARNING );  
			if($_SESSION['username'] == "admin"||$_SESSION['username'] == "username")
				echo'<li align="center"><a href="logout.php">Αποσύνδεση</a></li>'; 
			else echo' <li align="center"><a href="index.php"> Σύνδεση </a></li>';
		   ?>
		<li align="center"><a href="Contact.php">Επικοινωνία</a></li>
    </ul>
    </div>	  
    <div id="main">
		<h6 align="center">Χάρτης</h6>
	    <div align="center" id="admin_menu">
		
   <?php 
   
   	error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED ^ E_WARNING );
	SESSION_START();

	if (!empty($_POST['sub1'])) {
		
		$_SESSION['name'] = $_POST['sub1'];
	
	}

	else $_POST['sub1']=$_SESSION['name'];
	

	$con = mysqli_connect("localhost",$username1,$password1);

	mysqli_select_db($con,$database) or die(mysqli_error($con));;

	mysql_set_charset('utf8');
	mysqli_set_charset($con,'utf8');
	
	if($_SESSION['username'] == "admin"||$_SESSION['username'] == "username"){
		
		echo'<table>
			<tr>
			<th>ID</th>
			<th>Όνομα</th>
			<th>Γεωγραφικό Πλάτος</th>
			<th>Γεωγραφικό Μήκος</th>
			<th>Ιστοσελίδα/Περιεχόμενο</th>
			<th>Τελευταία επεξεργασία</th>
		</tr>
		</div>
	   </div>';
		
		 
		if (mysqli_set_charset($con, "utf8")) {

			$query = mysqli_query($con, "SELECT * FROM demo_qr_array1 WHERE name ='".$_POST['sub1']."'");
		
			while($row = mysqli_fetch_assoc($query)) {
				
			include("map_code_marker_info.php");
				
				echo '<tr>';
				echo "<td valign='top'>".$row['id']."</td>";
				echo "<td valign='top'>".$row['name']."</td>";
				echo "<td valign='top'>".$row['latitude']."</td>";
				echo "<td valign='top'>".$row['longitude']."</td>";
				
				$type=$row['type'];
				
				if($type==0){
					
						echo "<td valign='top'>".$row['content']."</td>";
			
				}
				
				else {
				
					echo "<td valign='top'>Πατήστε Preview για να δείτε το εσωτερικό περιεχομένο του επιλεγμένου σημείου</td>";
					
				}
				
				echo "<td valign='top'>".$row['last_edited']."</td>";
			} 

			echo '</tr>';
			echo '</table>';
			echo '</div>';

			echo '<br>';
			
			echo '<div align="center">';
			echo '<form align="center" id="type_form" name = "marker_list1" action="change_type.php" method="post">';
			if($type==0){
							echo '<input type="submit" value="Αλλαγή σε εσωτ. περιεχόμενο" name="change_type">';
							
					}
					else {
			
						echo '<input type="submit" value="Αλλαγή περιεχομένου σε σύνδεσμο" name="change_type">';
					
					}
				
			echo '</form>';
			
			echo '<form align="center" id="edit_form" name = "marker_list1" action="edit_init.php" method="post">';
				echo '<input type="submit" value="Επεξεργασία" name="edit">';
			echo '</form>';
			
			echo '<form align="center" onSubmit="return confirm(\'Σίγουρα θέλετε να διαγράψετε αυτό το σημείο?\')"  class = "delete" id="delete_form" name = "marker_list2" action="delete_marker.php" method="post">';
				echo '<input type="submit" value="Διαγραφή" name="edit">';
			echo '</form>';
			
			echo '<form align="center" target="_blank" id="preview_form" name = "marker_list3" action="preview_marker.php" method="post">';
				echo '<input type="submit" value="Preview" name="preview_button">';
			echo '</form>';
			
			
			echo '<form align="center" id="prev" name = "prev" action="map.php" method="post">';
				echo '<input type="submit" value="Πίσω" name="edit">';
			echo '</form>';

		}
	}
	
	?>
	<br><br>
 	</div>
    </div>
    </div>
   <div id="footer">
    Copyright &copy; 2016 ΓΑΒ LAB
   </div>
  </div>
 </body>
</html>