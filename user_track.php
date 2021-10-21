<?

1- javascript local storage ve session storage'ye key=>value atayarak bir sonrakinde değerlerin aynı olup olmadıgı kontrol edilebilir.
aynı değerleri php tarafındada session cookie vasıtasıyla 4ün birden kontrolu sağlanabilir.
2- blob.text() veya filereader() javascript ile dosyaya yazma ve okuma blob yerel file uzak sunucu kapsamlı araştırma yapılacak.
3- https://www.delftstack.com/howto/javascript/javascript-read-file-line-by-line/ - satır satır dosya okuma
4- https://www.delftstack.com/howto/javascript/detect-mobile-browser-javascript/ - javascript ile mobile browser detection
5- \n yeni satır oluşturmak için \r işaretciyi sıfırlar ve soldan başlatan satırbaşı döndürür kullanımı \r\n yalnız "" çift tırnak içinde kullanılması gerekir.
6- http client - tam olarak anlamadım araştırılacak

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



$username = "koray";
$userbrowseragent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.81 Safari/537.36";
