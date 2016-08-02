<?php
session_start();
function logged_in()
{
	return isset($_SESSION['sessionid']);
}
function adminlogged_in()
{
	return isset($_SESSION['sessionid1']);
}

function confirm_logged_in()
{
	if(!logged_in())
	{
		redirect_to("index.php");
	}
	elseif(adminlogeed_in())
	{
	redirect_to("wafadmin.php");
	}
	else
	{
	redirect_to("user.php");
	}
}


?>