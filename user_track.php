<?

1- javascript local storage ve session storage'ye key=>value atayarak bir sonrakinde değerlerin aynı olup olmadıgı kontrol edilebilir.
aynı değerleri php tarafındada session cookie vasıtasıyla 4ün birden kontrolu sağlanabilir.
2- blob.text() veya filereader() javascript ile dosyaya yazma ve okuma blob yerel file uzak sunucu kapsamlı araştırma yapılacak.
3- https://www.delftstack.com/howto/javascript/javascript-read-file-line-by-line/ - satır satır dosya okuma
4- https://www.delftstack.com/howto/javascript/detect-mobile-browser-javascript/ - javascript ile mobile browser detection
5- \n yeni satır oluşturmak için \r işaretciyi sıfırlar ve soldan başlatan satırbaşı döndürür kullanımı \r\n yalnız "" çift tırnak içinde kullanılması gerekir.
6- http client - tam olarak anlamadım araştırılacak
7- Mobilmi diye kod yazarken mobi kelimesinin kullanılması neredeyse yeterli
8- psr1 psr17 gibi araştır
9- program iskeleti veya ön hazırlık gibibirşey araştır
10- http viewer, curl http viewer
10- Network monitors (also known as reverse-firewalls)

---Ternary operator
$can_vote = ($age>17 ? true : false);
---Syntax---
fopen($fileName, $mode, $path, $context);
r - Sadece oku
r+ - Oku ve yaz
w	- Sadece yaz. Dosya yoksa, oluşturmayı deneyin.
w+ - Oku ve yaz. Dosya yoksa, oluşturmayı deneyin.
a	- Ekle.
a+ - Oku ve ekle.
x - Yalnızca oluşturun ve yazın.
x+	- Oluşturun ve okuyun ve yazın

fwrite($fileName, $info, $length);
$fileName -	zorunlu -	Yazılacak dosyadır.
$info	- zorunlu	- Dosyaya yazılacak olan bilgidir.
$length	- isteğe bağlı	- Dosyaya yazılacak bayt sayısıdır.

fclose($fileName);
$filename - zorunlu - kapatılacak dosya
true - success
false - failed

---Dosya Yazma---
$myfile = fopen("myfile.txt", "w"); 
$bytes = fwrite($myfile, "This is a program"); 
fclose($myfile);

---Dosya Okuma---
$txt_file = fopen('abc.txt','r');
$a = 1; //Her satıra sayı atamak için
while ($line = fgets($txt_file)) {
 echo($a." ".$line)."<br>";
 $a++;
}
fclose($txt_file);

---Json çıktısını sıralı oluşturma---
$jsonString ='{
    "firstName":"Olivia",
    "lastName":"Mason",
    "dateOfBirth": "19-09-1999"
}';
$data = json_decode($jsonString, true);
foreach ($data as $key=> $data1) {
    echo $key, " : ";
    echo $data1, "\n";
}

---basit kullancı hit sayma---
if (empty($_SESSION['count'])) {
   $_SESSION['count'] = 1;
} else {
   $_SESSION['count']++;
}

foreach (getallheaders() as $name => $value) {
    echo "$name: $value\n<br>";
}



$timeout = 300; // 5 minutes
$time = time();
$ip = $_SERVER["REMOTE_ADDR"];
$file = "users.txt";
$arr = file($file);
$users = 0;

for ($i = 0; $i < count($arr); $i++){
    if ($time - intval(substr($arr[$i], strpos($arr[$i], "    ") + 4)) > $timeout){
        unset($arr[$i]);
        $arr = array_values($arr);
        file_put_contents($file, implode($arr)); // 'Glue' array elements into string
    }
    $users++;
}

echo $users;

// Only add entry if user isn't already there, otherwise just edit timestamp
for ($i = 0; $i < count($arr); $i++){
    if (substr($arr[$i], 0, strlen($ip)) == $ip){
        $arr[$i] = substr($arr[$i], 0, strlen($ip))."    ".$time."\n";
        $arr = array_values($arr);
        file_put_contents($file, implode($arr)); // 'Glue' array elements into string
        exit;   
    }
}

file_put_contents($file, $ip."    ".$time."\n", FILE_APPEND);


function get_ip() {
		$mainIp = '';
		if (getenv('HTTP_CLIENT_IP'))
			$mainIp = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$mainIp = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$mainIp = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$mainIp = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$mainIp = getenv('REMOTE_ADDR');
		else
			$mainIp = 'UNKNOWN';
		return $mainIp;
	}

if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    // When website is behind CloudFlare
    $ip = $_SERVER['HTTP_CF_CONNECTING_IP']; 
} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED'];
} elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_FORWARDED'])) {
    $ip = $_SERVER['HTTP_FORWARDED'];
} elseif (isset($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
}

//buda işe yaramadı
function GetIP(){
 if(getenv("HTTP_CLIENT_IP")) {
 $ip = getenv("HTTP_CLIENT_IP");
 } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 $ip = getenv("HTTP_X_FORWARDED_FOR");
 if (strstr($ip, ',')) {
 $tmp = explode (',', $ip);
 $ip = trim($tmp[0]);
 }
 } else {
 $ip = getenv("REMOTE_ADDR");
 }
 return $ip;
}

//ip engelleme
$engellenmisIP = array("::1", "127.0.0.1");
if (in_array($ipAdresi, $engellenmisIP)) {
  # Burada engelenen IP adresi ile ilgili farklı işlemler yapılabilir.
  echo "Engellenmiş IP";
} else {
  # Burada da diğer işlemler yapılabilir.
  echo "Hoşgeldiniz";
}

  $http_client_ip       = $_SERVER['HTTP_CLIENT_IP'];        // Internet ip address
  $http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];  // checking for proxy server
  $remote_addr          = $_SERVER['REMOTE_ADDR']; //

  if(!empty($http_client_ip)){
    $ip = $http_client_ip;
  }elseif(!empty($http_x_forwarded_for)){
    $ip = $http_x_forwarded_for;
  }else{
    $ip = $remote_addr;
  }

  echo $ip;

session fingerprint ve bazı güvenlikler
https://www.generacodice.com/en/articolo/23988/PHP-Session-Security?a=r

//sayfaya ilk kezmi gelinmiş yoksa daha öncede gelinmişmi
$yenilendi_mi = (isset($_SERVER['HTTP_CACHE_CONTROL'])
                &&
                $_SERVER['HTTP_CACHE_CONTROL'] == 'max-age=0');
if($yenilendi_mi) {
  echo 'Bu sayfa yenilenmiş.';
} else {
  echo 'Bu sayfa ilk kez ziyaret edilmiş ve yenilenmemiş.';
}



$username = "koray";
$userbrowseragent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36";
