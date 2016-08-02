<?php

$log_directory = '/var/www/waf/rules/';

$results_array = array();

if (is_dir($log_directory))
{
        if ($handle = opendir($log_directory))
        {
                //Notice the parentheses I added:
                while(($file = readdir($handle)) !== FALSE)
                {
                        $results_array[] = $file;
                }
                closedir($handle);
        }
}
?>
<html>
<form action="delete.php" method="post">
Which File do you want Delete to?<br /><br /><br /><br />
<?php
foreach($results_array as $value)
{
        echo '<input type="checkbox" name="formDoor[]" value="'.$value.'">'.$value.'</br>';
}
?>
<input type="submit" name="formSubmit" value="Submit" />
</form>
</html>
<?php
  if(isset($_POST['formSubmit']))
  {
  if(!empty($_POST['formDoor'])){
        foreach($_POST['formDoor'] as $selected){
	echo "<script>alert('File Deleted Successfully...!!');</script>";
        unlink($log_directory.$selected);
        }
}
        }
?>
