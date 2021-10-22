<?
/*
---Yapılacaklar Listesi---
1- verileri ajax ile anlık çekme
2- verileri dosyanın başından değilde sonundan başlayarak çekme en başta en son olan olayın gözükmesi için



---Sorunlar Listesi---
1- listeleme yapıldığında \n satır sonu karakteri olduğu için tek 1 boş satır gözüküyor ama,
sürekli veri yazımı olduğunda şimdilik bu bir sorun teşkil etmiyor ama çaresine bakılacak.


*/



<!DOCTYPE html>
<html>
<head>
<title>Waffing Logs Page</title>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<style>
body {
	margin: 0;
	padding: 0;
}
table, th, td {
	border: 2px solid #a1a1a1;
	border-collapse: collapse;
	text-align: center;
}
th, td {
	background: #c1c1c1;
	color: black;
	padding: 0;
}
</style>
</head>
<body>



<?

$waf_log_file = "../../waffing.txt";
$waf_log_file_open = fopen($waf_log_file, "r");


echo '<table id="waffing_log" style="border: 1px solid black;"><thead>';
echo '<tr>
<th>No</th>
<th>Username</th>
<th>Waf_1</th>
<th>Waf_2</th>
<th>Waf_3</th>
<th>Waf_4</th>
<th>Waf_5</th>
<th>Waf_6</th>
<th>Waf_7</th>
<th>Waf_8</th>
<th>Waf_9</th>
<th>Waf_10</th>
<th>Waf_11</th>
<th>Waf_12</th>
<th>Waf_13</th>
<th>Waf_14</th>
<th>Waf_15</th>
<th>Waf_16</th>
<th>Waf_17</th>
<th>Waf_18</th>
<th>Waf_19</th>
<th>Waf_20</th>
<th>Waf_21</th>
<th>Waf_22</th>
<th>Waf_23</th>
<th>Waf_24</th>
<th>Waf_25</th>
<th>Waf_26</th>
<th>Waf_27</th>
<th>Waf_28</th>
</tr></thead><tbody>';
$counter = 1;
while(!feof($waf_log_file_open)) {
$dizi = fgets($waf_log_file_open);
$bol = explode('|', $dizi);
echo '<tr>
<td>'. $counter .'</td>
<td>'. $bol['0'] .'</td>
<td>'. $bol['1'] .'</td>
<td>'. $bol['2'] .'</td>
<td>'. $bol['3'] .'</td>
<td>'. $bol['4'] .'</td>
<td>'. $bol['5'] .'</td>
<td>'. $bol['6'] .'</td>
<td>'. $bol['7'] .'</td>
</tr>';
$counter++;
}
echo '</tbody></table>';
fclose($waf_log_file_open);
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#waffing_log').DataTable({
					"pageLength": 20
				
				});
} );
</script>

</body>
</html>
