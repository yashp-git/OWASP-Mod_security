<html>
<head>
<title>Indusface</title>
</head>
<body>
<table border="2">
<tr>
<td align="center">Indusface DATA</td>
</tr>
<tr>
    <td>
      <table border="1">
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
        if(!empty($_POST['search_customer']) && !empty($_POST['date']))
		{
            $searchString = "WHERE CustomerID LIKE '%{$_POST['search_customer']}%' AND FoundDate LIKE '%{$_POST['date']}%'";
        }
		else{
		echo "Enter Incomplete Inputs";}
        if (!$rs = mysql_query("SELECT CustomerID,AlertID,FoundDate,Description,URL,Method,Para,ReqHeader,Replay_TIME,HTTP_RESPONSE_CODE,RawLog,Rule,Unique_ID FROM SigReplayStatus $searchString")) {
            echo "Cannot parse query";
        } elseif (mysql_num_rows($rs) == 0) {
            echo "No records found";
        } 
		else {
            
			    while ($row = mysql_fetch_array($rs)) {
                echo "<tr align=\"center\">";
    echo "<td>$row[0]</td>";
    echo "<td>$row[1]</td>";
    echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>$row[4]</td>";
	echo "<td>$row[5]</td>";
	echo "<td>$row[6]</td>";
	echo "<td>$row[7]</td>";
	echo "<td>$row[8]</td>";
	echo "<td>$row[9]</td>";
	echo "<td>$row[10]</td>";
	echo "<td>$row[11]</td>";
	echo "<td>$row[12]</td>";
	echo "</tr>\n";
            }
         }
    }
    ?>
	
	</table>
  </td>
</tr>
</table>


</body>
</html>