<?
/*
---Yapılacaklar Listesi---
1- verileri ajax ile anlık çekme
2- verileri dosyanın başından değilde sonundan başlayarak çekme en başta en son olan olayın gözükmesi için



---Sorunlar Listesi---
1- listeleme yapıldığında \n satır sonu karakteri olduğu için tek 1 boş satır gözüküyor ama,
sürekli veri yazımı olduğunda şimdilik bu bir sorun teşkil etmiyor ama çaresine bakılacak.


*/



$waf_log_file = "../../waffing.txt";
$waf_log_file_open = fopen($waf_log_file, "r");
?>

//tablomuzun kötü gözükmemesi için birazcık renklendirip düzelttikki verileri rahat okuyabilelim.
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

<?
//tablomuzun başlangıcı
echo '<table style="border: 1px solid black;">';
//şimdilik 3 satırımız oldugu için 3 başlık ekledik
echo '<tr><th>No</th><th>Username</th><th>Ip Address</th></tr>';
//sayacı 1e ayarladık
$counter = 1;
//döngümüzü başlattık
while(!feof($waf_log_file_open)) {
//dosyadaki tüm verileri satır satır bir değişkene aktardık
$dizi = fgets($waf_log_file_open);
//explode fonksiyonumuzla | karakterine kadar olan kısımları böldükki tablomuzda kullanabilelim
$bol = explode('|', $dizi);
//en basa satır numaralarının gelmesi icin sayacımızı koyup böldüğümüz verileri tek tek tablo hücrelerine yerleştirdik.
echo '<tr><td>'. $counter .'</td><td>'. $bol['0'] .'</td><td>'. $bol['1'] .'</td></tr>';
//döngümüzden çıkan kaç satır varsa sayacımızı +1 arttırarak satır sayısı kadar kaç tane olduğunu yazdırdık.
$counter++;
//while döngümüzü kapattık
}
//tablomuzun bitişini yaptık
echo '</table>';
//dosyayla işimiz bittiği için dosyamızı kapattık
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
