<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>
<?php require_once("include/functions.php");?>
<?php confirm_adminlogged_in();?>
<!DOCTYPE html>
<html lang="en">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <?php include("./include/header3.php");?>
  <div class="container">
<?php include("include/lside1.php");?>
    <section id="content">
      <div class="inside">
      <form method="post" action="detail_customer1.php">
      <table class="list" >
      <tr>
      <td width="30%">Select Id</td>
      <td>
      <?php
				$get=mysqli_query($con,"SELECT id FROM user where prority='0' ORDER BY id ASC");
				$option = '';
				while($row = mysqli_fetch_assoc($get))
				{
					$option .= '<option value = "'.$row['id'].'">'.$row['id'].'</option>';
				}
			?>
			<select name="id" > 
				<?php echo $option; ?>
			</select></td>
            </tr><tr>
            <td></td>
            <td>
        <input type="submit" name="submit" value="Detail" onClick="change()"></td></tr>
        </table>
      </form> 
      </div>
    </section>
  </div>
</div>

<!-- END PAGE SOURCE -->