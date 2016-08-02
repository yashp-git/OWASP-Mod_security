<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>

<?php confirm_adminlogged_in();?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Dashboard</title>

<script type="text/javascript" src="js/tabber.js"></script>
<link rel="stylesheet" href="css/style.css" TYPE="text/css" MEDIA="screen">

<script type="text/javascript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header3.php");?>
  <div class="container">
<?php include("include/lside.php");?>
   <section id="content">
          <div class="wrap">

        <section id="content">
        <br/><br/><br/><h4 style="margin-left:-150px;">Welcome <?php echo $_SESSION['sessionid1'] ?></h4>
			     <div class="tabbertab">
	  <h2>Search Attack Records</h2>
	  <form align="center" name="search_form" method="POST" action="attack.php">
        <font face="Calibri"> </font>
        <table align="center">
		<tr></td></br></td></tr><tr></td></br></td></tr><tr><td>Search By Client-IP: </td><td></td><td>
		<input type="text" name="search_host" value="" placeholder="255.255.255.255"  required/></td></tr>
		<tr><td></td><td>
		<br/><br/>
        <input type="submit" name="submit" value="Search HOST IP" />
		</td></tr></table>
		
	</form>
	
	
     </div>
                 
      <div class="inside">

      </div>
    </section>
  </div>
</div>
</section>
</div></div>

<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>

<!-- END PAGE SOURCE -->
                            
