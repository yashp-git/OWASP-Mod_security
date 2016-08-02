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
		redirect_to("logout.php");
	}
}

function confirm_adminlogged_in()
{
	if(!adminlogged_in())
	{
		redirect_to("logout.php");
	}
	}

?>
