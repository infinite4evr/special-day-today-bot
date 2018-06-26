<?php 

$handle="false";

require_once('simple_html_dom.php');

$website="https://en.wikipedia.org/wiki/List_of_commemorative_days";


$html = new simple_html_dom();

$myfile="specialdays.txt";

 $handle = fopen($myfile, 'a') or die('Cannot open file:  '.$myfile); 
 



$html->load_file($website);

$element = $html->find("li");



foreach($element  as $specialday) {
	
	/* if(strpos($html, 'New Year – January 1') !== true);
	
	{ $handle = fopen($myfile, 'a') or die('Cannot open file:  '.$myfile); }
	
	if($handle!="false");
	
	*/
	
   // fwrite($handle, $specialday->title);

         var_dump($specialday->find('div.title'));
	 
	 // if(strpos($html, 'New Year\'s Eve – December 31') == true);
	
	/* {
    	fclose($handle);
	
        $handle ="false";
	  
    } */
	

   }
       
?>