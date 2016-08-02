<?php require_once("include/temp_session.php");?>
<?php require_once("include/connection.php");?>
<?php include("excelwriter.class.php");?>
<?php require("html2pdf/html2fpdf.php");?>

<?php confirm_logged_in();?>


<title>Indusface Dashboard</title>
 <?php include("./include/header4.php");?>

<style>
panel-body{
float:left;
margin-top:0;
padding-top:0;
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

 <div class="container1">
 	<h3 class="panel-title" style="line-height:35px;">Indusface Records</h3>
					
	<h4><div class="option">
							<ul class="download">
							<li id="main-menu" class="export-download" align="right">Download
							<ul class="dropdown-menu" id="export-menu" border="3">
						    <li id="export-to-excel"><a href="reports_backup/xls/report_<?php echo $_SESSION['sessionid'];?>_xls.xls">Export to EXCEL</a></li>
							<li id="export-to-csv"><a href="reports_backup/csv/report_<?php echo $_SESSION['sessionid'];?>_csv.csv">Export to CSV</a></li>
						    <!--li id="export-to-pdf"><a href="reports_backup/pdf/report_--><!--?php echo $_SESSION['sessionid'];?--><!--_pdf.pdf">Export to PDF</a></li-->
							</ul>
							</li>
							</ul>
						
					</div>
					</h4>

			
<div class="panel-body">
<table id="datatable" class="table-striped" cellpadding="0" cellspacing="0">
<tbody>	          
		<tr>
        <td>CustomerID</td>
        <td>AlertID</td>
        <td>FoundDate</td>
		<td>Description</td>
		<td>URL</td>
		<td>Method</td>
		<td>Para</td>
		<td>ReqHeader</td>
		<td>Replay_TIME</td>
		<td>HTTP_RESPONSE_CODE</td>
		<td>RawLog</td>
		<td>Rule</td>
		<td>Unique_ID</td>
	    </tr>

<?php

	ini_set('max_execution_time', 600);   
	if (!$link = mysql_connect("54.224.77.103","yash1","ycHyyPmfGtVxRrYa")) {
        echo "Cannot connect to db server";
    } elseif (!mysql_select_db("IGReplay")) {
        echo "Cannot select database";
    } else { 
        $searchString = "";
        if(!empty($_POST['search_customer']))
/*
							<li id="export-to-pdf"><a href="reports_backup/pdf/report_><?php echo $_SESSION['sessionid'];?>_pdf.pdf">Export to PDF</a></li>
*/	
	{
            $searchString = "WHERE CustomerID = '{$_POST['search_customer']}'";
        }elseif(!empty($_POST['search_url'])){
			$searchString = "WHERE URL = '{$_POST['search_url']}'";
		}
		elseif(!empty($_POST['search_customer_letest']))
		{
            $searchString = "WHERE CustomerID = '{$_POST['search_customer_letest']}'";
        }elseif(!empty($_POST['search_url_letest'])){
			$searchString = "WHERE URL = '{$_POST['search_url_letest']}'";
		}
		
		else{
		echo "Enter Incomplete Inputs";}
        if (!$rs = mysql_query("SELECT CustomerID,AlertID,FoundDate,Description,URL,Method,Para,ReqHeader,Replay_TIME,HTTP_RESPONSE_CODE,RawLog,Rule,Unique_ID FROM SigReplayStatus $searchString order by FoundDate DESC limit 15")) {
            echo "Cannot parse query";
        } elseif (mysql_num_rows($rs) == 0) {
            echo "No records found";
			
        } 
		else {
          $count=0;
		  $excel=new ExcelWriter("reports_backup/xls/report_{$_SESSION['sessionid']}_xls.xls");
		  
	  
	  if($excel==false )	
		  echo $excel->error;
		  $myArr=array("CustomerID","AlertID","FoundDate","Description","URL","Method","Para","ReqHeader","Replay_TIME","HTTP_RESPONSE_CODE","RawLog","Rule","Unique_ID");
		  $excel->writeLine($myArr);

		  while($row = mysql_fetch_array($rs)){
		
		
		 
		 		 
	echo "<tr align=\"center\">";
	echo "<td>".htmlentities($row[0])."</td>";
    echo "<td>".htmlentities($row[1])."</td>";
    echo "<td>".htmlentities($row[2])."</td>";
	echo "<td>".htmlentities($row[3])."</td>";
	echo "<td>".htmlentities($row[4])."</td>";
	echo "<td>".htmlentities($row[5])."</td>";
	echo "<td>".htmlentities($row[6])."</td>";
	echo "<td>".htmlentities($row[7])."</td>";
	echo "<td>".htmlentities($row[8])."</td>";
	echo "<td>".htmlentities($row[9])."</td>";
	echo "<td>".htmlentities($row[10])."</td>";
	echo "<td>".htmlentities($row[11])."</td>";
	echo "<td>".htmlentities($row[12])."</td>";
	echo "</tr>\n";
	


$excel->writeRow(); 
$excel->writeCol(htmlentities($row[0]));
$excel->writeCol(htmlentities($row[1]));
$excel->writeCol(htmlentities($row[2]));
$excel->writeCol(htmlentities($row[3]));
$excel->writeCol(htmlentities($row[4]));
$excel->writeCol(htmlentities($row[5]));
$excel->writeCol(htmlentities($row[6]));
$excel->writeCol(htmlentities($row[7]));
$excel->writeCol(htmlentities($row[8]));
$excel->writeCol(htmlentities($row[9]));
$excel->writeCol(htmlentities($row[10]));
$excel->writeCol(htmlentities($row[11]));
$excel->writeCol(htmlentities($row[12]));
	
	$inspector[$count++] = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12]);
	}
 	
	$data = array();
	for($i=0;$i<=mysql_num_rows($rs);$i++){
	$data = $inspector;
	$buffer = file_get_contents("export1.php");
	
	}
	$fp = fopen("reports_backup/csv/report_{$_SESSION['sessionid']}_csv.csv", 'w');
	fputcsv($fp,$myArr);
	foreach ($data as $fields) {
    fputcsv($fp, $fields);
	}
		fclose($fp);
	
	}
  		

		 
	}
 ?>

 </tbody>
 </table>


</div>
</div>
<!--?php

$htmlFile = "export.php";

$pdf = new HTML2FPDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->WriteHTML($buffer);
$pdf->Output("reports_backup/pdf/report_{$_SESSION['sessionid']}_pdf.pdf", 'F');

?-->

<script type="text/javascript"> Cufon.now(); </script>

