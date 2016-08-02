<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>
<?php require_once("include/functions.php");?>
<?php confirm_adminlogged_in();?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>WAF-Dashboard</title>

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
<?php include("include/lside1.php");?>

   <section id="content">
	  <div class="wrap">
    	 <!--button id="reload" name="reload" value="reload"/-->

        <section id="content">
        <br/><br/><br/><h4 style="margin-left:-150px;">Welcome <?php echo $_SESSION['sessionid1'] ?></h4>
</div>
</section>
</div></div>

<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>

<!-- END PAGE SOURCE -->
