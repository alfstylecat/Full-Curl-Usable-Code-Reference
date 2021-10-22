<?
$waf_log_file = "../../waffing.txt";
$waf_log_file_open = fopen($waf_log_file, "r");



echo '<table style="border: 1px solid black;">';
echo '<tr><th>No</th><th>Username</th><th>Ip Address</th></tr>';
$counter = 1;
while(!feof($waf_log_file_open)) {
$dizi = fgets($waf_log_file_open);
$bol = explode('|', $dizi);
echo '<tr><td>'. $counter .'</td><td>'. $bol['0'] .'</td><td>'. $bol['1'] .'</td></tr>';
$counter++;
}
echo '</table>';
fclose($waf_log_file_open);






//1.versiyon
/*
while($all_log_read = fgets($waf_log_file_open)) {
	echo $all_log_read ."<br>";
}
*/

//2.versiyon
/*
echo '<table style="border: 1px solid black;">';
$counter = 1;
while(!feof($waf_log_file_open)) {
$dizi = fgets($waf_log_file_open);
echo '<tr><td>'. $counter .'</td>';
echo '<td>'. $dizi .'</td></tr>';
$counter++;
}
echo '</table>';
*/
