<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>
<?php confirm_adminlogged_in();?>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>RULES-Dashboard</title>
</head>
<body>
<?php

if(isset($_SESSION['customerid'])){
		$id=$_SESSION['customerid'];
		$query="select CustomerID from user_detail where userid = '".$id."'";
		
		$query_result=mysqli_query($con,$query);
		
			
			$query_fetch=mysqli_fetch_array($query_result);
			
			
			$customerid=$query_fetch[0];
		
		$query1="select CustomerId, URL, Bip, RuleConf from rules where CustomerId = '".$customerid."'";
		$query1_result=mysqli_query($con,$query1);
		$query1_fetch=mysqli_fetch_array($query1_result);
			
			$customerid1=$query1_fetch[0];
			$url=$query1_fetch[1];
			$bip=$query1_fetch[2];
			$ruleconf=$query1_fetch[3];
			echo $customerid1;
		//unset($_SESSION['customerid']);
	} else {
		header('Location: detail_customer.php');

	}
	
	
	if(isset($_POST['submit'])){
   //Fetching variables of the form which travels in URL
    $customerid = htmlentities($_POST['Customer_ID']);
    $url = htmlentities($_POST['URL']);
    $bip = htmlentities($_POST['BlackIp']);
    $ruleconf = base64_encode($_POST['RuleConf']);
	
	//second time
	if($customerid1 !=''){
	//Insert Query of SQL
	//$sql="insert into rules(CustomerId, URL, Bip, RuleConf) values ('$customerid', ' $url', '$bip', '$ruleconf')";
	//$query2="update rules set CustomerId='".$customerid."',URL='".$url."',Bip='".$bip."',RuleConf='".$ruleconf."'"
	 if($con->query("update rules set URL='".$url."',Bip='".$bip."',RuleConf='".$ruleconf."' WHERE CustomerId='".$customerid1."'")=== TRUE)
	
	//if($con->query("insert into rules(CustomerId, URL, Bip, RuleConf) values ('$customerid', ' $url', '$bip', '$ruleconf')")=== TRUE)
	{
	//write file configuration
	$myfile = fopen("/var/www/waf/rules/rule.{$_POST['URL']}.conf", "w") or die("Unable to open file!");
	$txt = base64_decode($ruleconf);
	fwrite($myfile, $txt);
	fclose($myfile);
	
		//write file blacklist file
	$myfile1 = fopen("/var/www/waf/blacklist_ip/blackip.{$_POST['URL']}.txt", "w") or die("Unable to open file!");
	$txt1 = $bip;
	fwrite($myfile1, $txt1);
	fclose($myfile1);



	echo "<script>alert('Data Updated successfully...!!');</script>";
	}
	else{
	echo "<script>alert('ERROR!! Unable to update ....!!');</script>";
		}
	}
	//first time
	else{
	//Insert Query of SQL
	//$sql="insert into rules(CustomerId, URL, Bip, RuleConf) values ('$customerid', ' $url', '$bip', '$ruleconf')";
	//$query2="update rules set CustomerId='".$customerid."',URL='".$url."',Bip='".$bip."',RuleConf='".$ruleconf."'"
	 if($con->query("insert into rules(CustomerId, URL, Bip, RuleConf) values ('$customerid', ' $url', '$bip', '$ruleconf')")=== TRUE)
	
	//if($con->query("insert into rules(CustomerId, URL, Bip, RuleConf) values ('$customerid', ' $url', '$bip', '$ruleconf')")=== TRUE)
	{
	//write file configuration
	$myfile = fopen("/var/www/waf/rules/rule.{$_POST['URL']}.conf", "w") or die("Unable to open file!");
	$txt = base64_decode($ruleconf);
	fwrite($myfile, $txt);
	fclose($myfile);
	
		//write file blacklist file
	$myfile1 = fopen("/var/www/waf/blacklist_ip/blackip.{$_POST['URL']}.txt", "w") or die("Unable to open file!");
	$txt1 = $bip;
	fwrite($myfile1, $txt1);
	fclose($myfile1);



	echo "<script>alert('Data Inserted successfully...!!');</script>";
	}
	else{
	echo "<script>alert('ERROR!! Unable to Insert....!!');</script>";
		}
	}
}
	
?>	

<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header3.php");?>
  <div class="container">
<?php include("include/lside2.php");?>
    <section id="content">
      <div class="inside" align="center">
	  
			<form action="rules.php" method="post">
			<table class="rules" cellspacing="12" cellpadding="10">
			<tr>
			
			<td><b>Customer ID*:</td>
			<td><input type=text size="30" name="Customer_ID" value="<?php echo htmlentities($customerid);?>" required></td>
			</tr>
			<tr>
			<td><b>URL*:</td>
			<td><input type=text size="30" name="URL" value="<?php echo htmlentities($url);?>" required></td>
			</tr>
			<tr>
			<td><b>IP-BlackList*:</td>
			<td><textarea rows="3" cols="32" name="BlackIp" required><?php echo htmlentities($bip);?></textarea></td>
			</tr>
			<tr>
			<tr>
			<td><b>Rule Configuration*:</td>
			<td><textarea rows="8" cols="32" name="RuleConf" required><?php echo base64_decode($ruleconf);?></textarea></td>
			</tr>
			<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Submit"></td>
			
			</tr>
			</table>
			</form>
			
      </div>
    </section>
  </div>
</div>

<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
