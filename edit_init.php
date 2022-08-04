<html>
 <head>
 <style>
	li a { display: block; }
 </style>
 <script type="text/javascript" language="javascript">
 
 function OpenWindow() {
	 
	window.open('edit_1.php','win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=1076,height=500,directories=no,location=no') 

 }
 
</script>
  <title>Edit content</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />
 </head>
 
 <body>
 <div id="container">
   <div id="header">
    <h1><a href="Home.php"><img src="logo.png" align="center" alt="logo" style="width:300px;height:60px;"></a><a href="http://gav.uop.gr/"><img src="gavlab.png" align="right" alt="logo" style="width:200px;height:55px;"></a></h1>

   </div>
   
    <div id="content">
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
     <h6 align="center">Επεξεργασία:</h6>
	 
	<div align="center" id="admin_menu">


 <?php
 	require("phpsqlajax_dbinfo.php");
	error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
	SESSION_START();
	if($_SESSION['username'] == "admin"||$_SESSION['username'] == "username"){

	//echo $_SESSION['name'] ;
	
	$con = mysqli_connect("localhost",$username1,$password1);

	mysqli_select_db($con,$database) or die(mysqli_error($con));
	//mysql_set_charset('utf8');
	mysqli_set_charset($con,'utf8');

	if (mysqli_set_charset($con, "utf8")) {

		$query = mysqli_query($con, "SELECT type,content FROM demo_qr_array1 WHERE name ='".$_SESSION['name']."'");
	
		while($row = mysqli_fetch_assoc($query)) {
			echo '<br>';
			$type=$row['type'];
			if($type == 0) {

				echo '<form action="edit_init.php" method="post">';
				echo 'Εισαγάγετε το νέο σύνδεσμο για το στοιχείο '."".$_SESSION['name'].":";
				echo '<br>';echo '<br>';
			
				$k=$row['content'];
				echo "<input type='text' name='newlink' size ='80' value='$k'/>"; 
				echo '<br>';echo '<br>';

				echo '<input type="submit" name="submit" value="ΟΚ">';
				echo '</form>';
				echo '<form align="center" id="prev" name = "prev" action="marker_info.php" method="post">';
					echo '<input type="submit" value="Πίσω" name="edit">';
				echo '</form>';

				if(isset($_POST['submit'])){
					if (empty($_POST['newlink'])) {
						//	header( "refresh:0; url=edit_init.php" );
							echo '<br><span style="color:#8A0808;text-align:center;">Παρακαλώ πληκτρολογήστε το καινούργιο σύνδεσμο.</span>';
						}
						
						else {
							$query1 = mysqli_query($con, "UPDATE demo_qr_array1 SET content='".$_POST['newlink']."' WHERE name ='".$_SESSION['name']."'");
	
							if($query1) {
								header( "refresh:0; url=marker_info.php" );
						}
					}
				}
			}
	
			else  { 
				echo '<script type="text/javascript">',
				'OpenWindow();',
				'</script>';
				echo '</form>';}
			//	header( "refresh:0; url=map.php" );
			} 
		}				//	header( "refresh:0; url=map.php" );

	}
	
 ?>
	  
	 </div>
    </div>
   </div>
   <div id="footer">
    Copyright &copy; 2016 ΓΑΒ LAB
   </div>
  </div>
 </body>
</html>