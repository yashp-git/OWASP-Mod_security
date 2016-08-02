#!/usr/local/bin/php -q
<?php

//$page = $_SERVER['PHP_SELF'];
//$sec = "60";
//header("Refresh: $sec; url=$page");


$mod_er = fopen("/var/www/waf/error_log/mod_sec_error.log","r");
$mod_cus = fopen("/var/www/waf/custom_log/mod_sec_custom.log","r");
$file1 = "/var/www/waf/custom_log/mod_sec_custom.log";
$file = "/var/www/waf/error_log/mod_sec_error.log";
$conn = mysqli_connect("localhost","root","root","priwaf");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// keywords are between *
$str1 = $mod_er;
$str2 = $mod_cus;
$bfile=filesize($file);
$cfile=filesize($file1);

$query="select size from log_file order by time_insert desc limit 1";
$result_set = mysqli_query($conn,$query);
$result=mysqli_fetch_row($result_set);
#echo $result[0];

$query1="select csize from clog_file order by time_cinsert desc limit 1";
$result_set1 = mysqli_query($conn,$query1);
$result1=mysqli_fetch_row($result_set1);

fseek($str2,$result1[0],SEEK_SET);					
fseek($str1,$result[0],SEEK_SET);
while(($line = fgets($mod_er)) !== false){
	
	if(preg_match('/(\[[S|M|T|W|F][\s\w\d\:\.]+\])\s(\[\:\w+\])\s(\[pid[\s\d]+\])\s(\[client[\d\s\.]+\])([\w\s\:\d\(\)]+)\.(\sPattern\smatch\s\"[\(\?\w\d\)\=\<\\\+\[\"\:\-\'\/\;\,\.\]\>\|]+(?=\s)[\w\s\:\.]+)\s(\[file[\s\"\/\w\.]+\])\s(\[line[\s\"\d]+\])\s(\[id[\s\"\d]+\])\s(\[msg[\s\"\w]+\])\s(\[hostname[\s\"\d\.]+\])\s(\[uri[\s\/\w\"\d\.]+\])\s(\[unique_id[\s\/\w\"\d\@\#\$\%\^\&\*\!]+\])/',$line,$match))
		{ 
		
	$match[6]=base64_encode($match[6]);
	$sql = "INSERT INTO error_log (found_time, error, pid, client, log, pattern, file, line, id, msg, host, uri, unique_id)
VALUES ('$match[1]','$match[2]','$match[3]','$match[4]','$match[5]','$match[6]','$match[7]','$match[8]','$match[9]','$match[10]','$match[11]','$match[12]','$match[13]')";
	
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

}

while(($line1 = fgets($mod_cus)) !== false){

        if(preg_match('/([\d]{1,3}\.[\d]{1,3}\.[\d]{1,3}\.[\d]{1,3})[\s\-]+(\[[\d\/\w\:\s\-]+\])\s(\"[\w\s\/\.\?\=\%]+\")\s([\d\s]+)\s(\"[\-\/\.\w\:]+\")\s(\"[\w\/\.\s\(\;\)\,]+\")/',$line1,$match1))
                {

       // $match[6]=base64_encode($match[6]);
        $sql1 = "INSERT INTO custom_log (client_ip, found_time, method, status_code, host_ip, request_header)
VALUES ('$match1[1]','$match1[2]','$match1[3]','$match1[4]','$match1[5]','$match1[6]')";

if ($conn->query($sql1) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
}

}



$conn->query("INSERT INTO log_file(size)VALUES('$bfile')");
$conn->query("INSERT INTO clog_file(csize)VALUES('$cfile')");

?>




