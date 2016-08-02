<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>
<?php require_once("include/functions.php");?>
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
  <?php include("./include/header1.php");?>
  <div class="container">
<!--?php include("include/lside.php");?-->
   <section id="content">
	  <div class="wrap">
    
        <section id="content">
        <br/><br/><br/><h4 style="margin-left:50px;">Welcome <?php echo $_SESSION['sessionid1'] ?></h4>
		 <div class="tabber">

     <div class="tabbertab">
	  <h2>Search By Customer ID</h2>
	  <form align="center" name="search_form" method="POST" action="export.php">
        <font face="Calibri"> </font>
        <table align="center"><tr><td>Search By Customer-ID: </td><td></td><td>
		<input type="text" name="search_customer" value="" placeholder="007"/></td></tr>
		<tr><td>Date: </td><td></td><td><input type="text" name="date" value="" placeholder="1993-12-12" /></td></tr><tr><td></td><td>
		<br/><br/>
        <input type="submit" name="search" value="Search CustomerID" />
		</td></tr></table>
		
	</form>
	
	
     </div>

     <div class="tabbertab">
	  <h2>Search By URL</h2>
	  <form align="center" name="search_form" method="POST" action="export.php">
        <font face="Calibri"> </font>
        <table align="center"><tr><td>Search By URL: </td><td></td><td>
		<input type="text" name="search_url" value="" placeholder="www.indusface.com" /></td></tr>
		<tr><td>Date: </td><td></td><td><input type="datetime" name="date" value="" placeholder="1993-12-12" /></td></tr><tr><td></td><td>
		<br/><br/>
        <input type="submit" name="search" value="Search URL"> </input></td></tr></table>
	</form>
     </div>
</div>
<br>
      
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