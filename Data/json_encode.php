 <?php
 
 $myfile="specialdays.txt";
 
 $data = preg_split("/\r\n/", file_get_contents($myfile));

 	
	 $handle = fopen("days_json.txt", 'a') or die('Cannot open file:  '."days_json.txt"); 
	 
	 fwrite($handle,json_encode($data));

?>