<?php require_once("include/temp_session.php");?>
<?php require_once("include/functions.php");?>
<?php

	session_destroy();
	redirect_to("index.php?logout=1");
?>
