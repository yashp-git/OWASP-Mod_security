<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>

<?php confirm_adminlogged_in();?>

<html>
<title>Priwaf Dashboard</title>
 <?php include("./include/header3.php");?>

<head>

<style>
panel{
float:left;
margin-top:0;
padding-top:0;
margin-left:10px;
}
#datatable,td,tr,tbody
{
border:1px black solid;
text-align:justify;
padding:0px;
}

ul{
margin-bottom:0px;
padding:0px;
border:2 black;
}
container1{margin-top:10; padding:0;}
#main-menu{
padding:0px;
margin:0 0 0 700px;
}
</style>
</head>
<body>
<div class="container1">
        <h3 class="title" style="line-height:35px;">priWAF Records</h3>


<div class="panel">
<table id="datatable" class="table" cellpadding="0" cellspacing="0">
<tbody>
                <tr>
                <td>Found_time</td>
                <td>Error</td>
                <td>Pid</td>
                <td>Attacker_IP</td>
				<td>Log-Description</td>
                <td>Pattern Matched</td>
                <td>File</td>
                <td>Line</td>
                <td>Rule_ID</td>
                <td>Message</td>
                <td>Host_IP</td>
                <td>URI</td>
                <td>Unique_ID</td>
            </tr>

<?php
if(isset($_POST['submit'])){

		$searchString = "";
        if(!empty($_POST['search_host']))
                {
				
            $searchString = "WHERE host LIKE '%{$_POST['search_host']}%'";
			$query="SELECT found_time,error,pid,client,log,pattern,file,line,id,msg,host,uri,unique_id FROM error_log WHERE host LIKE '%{$_POST['search_host']}%' order by time_found DESC ";
			$rs=mysqli_query($con,$query);
			
while($row=mysqli_fetch_array($rs)){
		echo "<tr align=\"center\">";
		echo "<td>".htmlentities($row[0])."</td>";
        echo "<td>".htmlentities($row[1])."</td>";
        echo "<td>".htmlentities($row[2])."</td>";
        echo "<td>".htmlentities($row[3])."</td>";
        echo "<td>".htmlentities($row[4])."</td>";
        echo "<td>".base64_decode($row[5])."</td>";
        echo "<td>".htmlentities($row[6])."</td>";
        echo "<td>".htmlentities($row[7])."</td>";
        echo "<td>".htmlentities($row[8])."</td>";
        echo "<td>".htmlentities($row[9])."</td>";
        echo "<td>".htmlentities($row[10])."</td>";
        echo "<td>".htmlentities($row[11])."</td>";
        echo "<td>".htmlentities($row[12])."</td>";
        echo "</tr>\n";
			
        }
	}
       else{
                echo "Enter Incomplete Inputs";}
			}

?>

 </tbody>
 </table>


</div>
</div>
</body>
</html>
<script type="text/javascript"> Cufon.now(); </script>
