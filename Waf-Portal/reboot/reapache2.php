<?php require_once("../include/temp_session.php");?>
<?php require_once("../include/connection.php");?>
<?php require_once("../include/functions.php");?>
<?php confirm_adminlogged_in();?>

<html lang="en">
<head>
    <title>Restarting Appache</title>
</head>
<body>
<!-- Progress bar holder -->
</br></br></br></br></br></br></br></br></br></br>
<div id="progress" style="width:80%;margin-left:150;margin-right:150;border:1px solid #ccc;"></div>
<!-- Progress information -->
<div align="center" id="information" style="font-family:verdana;font-size:20px;color:#33ff00"></div>
<div align="center" style="font-family:verdana;font-size:30px;color:#33ff00">
<a href="../rules.php">OK</a></div>
<?php
// Total processes
exec('sudo at -f file now');
$total = 5;
// Loop through process
for($i=1; $i<=$total; $i++){
    // Calculate the percentation
    $percent = intval($i/$total * 100)."%";
    
    // Javascript for updating the progress bar and information
    echo '<script language="javascript">
    document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#33ff00;\">&nbsp;</div>";
    document.getElementById("information").innerHTML="Server Restarting";
    </script>';
    

// This is for the buffer achieve the minimum size in order to flush data
    echo str_repeat(' ',1024*64);
    

// Send output to browser immediately
    flush();
    

// Sleep one second so we can see the delay
    sleep(1);
}
// Tell user that the process is completed
echo '<script language="javascript">document.getElementById("information").innerHTML="Server Restarted"</script>';
?>

</body>
</html>


