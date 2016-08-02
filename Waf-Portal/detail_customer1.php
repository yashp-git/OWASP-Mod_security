<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>
<?php require_once("include/functions.php");?>
<?php confirm_adminlogged_in();?>
<!DOCTYPE html>
<html lang="en">
<?php
	if(isset($_POST['submit']))
	{
	$id=$_POST['id'];
	$_SESSION['customerid']=$id;

	$query="select * from customer_detail where userid='".$id."'";
	$query1="select * from user_detail where userid='".$id."'";
	$query_result=mysqli_query($con,$query);
	$query_result1=mysqli_query($con,$query1);
	if(mysqli_num_rows($query_result)==0)
	{
		mysqli_query($con,"insert into customer_detail (userid) values ('".$id."')");	
	}
	if(mysqli_num_rows($query_result1)==0)
	{
		mysqli_query($con,"insert into user_detail (userid) values ('".$id."')");
	}
	if($query_result||$query_result1)
	{
		$query_fetch=mysqli_fetch_array($query_result);
		$query_fetch1=mysqli_fetch_array($query_result1);
		echo "<script> change() </script>";
	}
	else
		echo "error";
	}
	else
	{
		redirect_to("detail_customer.php");
	}
?>
<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header3.php");?>
  <div class="container">
<?php include("include/lside1.php");?>
    <section id="content">
      <div class="inside">
      <form method="post" action="detail_customer1.php">
      <h2>User<span>Details</span></h2>
			<table class="list" cellspacing="2" cellpadding="2">
			<tr><td>UserID</td><td>:<label><?php echo $id ?></label></td></tr>
			<tr><td>CustomerID</td><td>:<label><?php echo $query_fetch1['CustomerID'] ?></label></td></tr>
			<tr><td>Name</td><td>:<label><?php echo $query_fetch1['Name'] ?></label></td></tr>
			<tr><td>Address</td><td>:<label><?php echo $query_fetch1['address'] ?></label></td></tr>
			<tr><td>Mobile</td><td>:<label><?php echo $query_fetch1['mobileno'] ?></label></td></tr>
			<tr><td>Date</td><td>:<label><?php echo $query_fetch1['date'] ?></label></td></tr>
			<tr><td>Ip</td><td>:<label><?php echo $query_fetch1['ip'] ?></label></td></tr>
			<tr><td>URL</td><td>:<label><?php echo $query_fetch1['url'] ?></label></td></tr>
			</table>
      </form> 
      </div>
    </section>
  </div>
</div>
<script type="text/javascript"> Cufon.now(); 

{
	document.getElementById("content")='';
}
</script>
<!-- END PAGE SOURCE -->
