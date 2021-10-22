<?
/*
---Yapılanlar ve Öğrenilenler---
1- kullanıcı adını al
2- ip adresini al
3- dosyaya kaydet
4- verilerin kolay ayrıştırılabilmesi için dosyaya yazılırken ayraç olarak | karakteri kullanıldı.
5- fwrite'ın ikil kipte yazıyor olması, ikili verileri yani ascii olmayan bayt veya,
boş bayt içeren diziler ilettiğimizde sorun çıkarmadan doğru çalışacağı anlamına gelir,herhangi bir ascii karakter olması onu gözardı edeceği anlamına gelmeden,
bu sekilde veri olarak doğrular.

Yapılacaklar
1- tarih al
2- saat al
3- bulunduğu sayfayı al - $_SERVER['PHP_SELF'] bu koda bakılacak güvenlikten dolayı kullanılmayabilir
4- isteği al
5- istek tipini al
6- useragent al - $_SERVER['HTTP_USER_AGENT'] if isset kontrol
7- ülkesini al
8- isp al
9- referans urlini al - $_SERVER["HTTP_REFERER"] if isset dolumu boşmu bak boşşa boş ekle
10- kullanıcı hangi porttan bağlanıyor algıla
11- suan online olanlar
12- bugun online olanlar
13- javascriptlede ayrı bir şekilde kullanıcının bilgilerini al ve phpden alınanlarla karşılaştır
14- acceptlanguageden kullanıcının dili alınabilir get request headerdan alındı
15- cf ip country alınacak
16- log dosyasına is_writable() ve file_exis


İleri seviye yapılacaklar
1- ip adresi engelle
2- üye ise kullanıcıyı engelle
3- asnyi engelle
4- bot engelle
5- proxy algıla
6- browser türü algıla
7- bot algıla
8- crawler algıla
9- x-xss algıla
10- x-frame-options: sameorigin algıla
11- X-Content-Type-Options: nosniff algıla
12- Strict-Transport-Security algıla
13- ip aralığı yasakla
14- sadece logmu yoksa otomatik banda olsunmu seçeneği
15- beyaz listeye ekle
16- anlık trafiği göster
17- ajax ile dinamik olarak verileri göster
18- açık portları tara
19- sql enjeksiyon tara
20- bu hafta online olanlar
21- bu ay online olanlar
22- tüm zamanlarda en çok online olan gün
23- hangi ülkeden kaç kişi
24- hangi browserdan kaç kişi
25- tarayıcı çözünürlükleri
26- accept encoding gzip araştırılacak işe yarıyorsa konulacak
27- sehir alınacak
28- asn alınacak
29- vpn,proxy,tor,hosting bilgisi alınacak

---Karşılaşılan Sorunlar---
1- fwrite ve file_put_contents arasındaki farklara bakılıp en uygun olanı eklenecek.
2- her veri yazımında verilerin en soluna bir öncekinden +1 artan sayaç yapılacak simdilik bilmiyorum.
3- sürekli dosya yazımında fclose()'un kapatılıp kapatılmayacağı araştırılacak.belki sorunlara neden olabilir.
4- verileri bir diziye aktararak dosyaya kaydetme araştırılacak ayrıştırılması daha kolay olabilir.

---Denenecekler---
1- dosyadan veritabanı gibi tek tek almak istersek ilk önce fgets ile tek satır alıcaz sonra fgetc ile harf harf olacak sekilde bir sonraki satırdaki,
eğer yapmışşak id değeri alınabilir.şimdilik fikir aşamasında
2- fgets dosyadan ilk satırı okuyor, biz eğer dosyaya sondan değilde baştan veri eklemesini söyleyebilirsek fgets ile ilk satırı okuyup satırın başına geldikten sonra,
regex ile | karakterine gelene kadar olan sayısı seçip seçtikten sonra bu sayı kaç ise üzerine +1 ekleyerek bir sonraki verinin başındaki satır numarasına ekleyebiliriz.

*/

<?
/*
$waf_username       = $user['username'];
$waf_ip_address     = $_SERVER['REMOTE_ADDR'];
$waf_cf_ip          = $_SERVER['HTTP_CF_CONNECTING_IP'];

if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $waf_mix = $_SERVER['HTTP_CLIENT_IP'];
} elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    // When website is behind CloudFlare
    $waf_mix = $_SERVER['HTTP_CF_CONNECTING_IP']; 
} elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $waf_mix = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
    $waf_mix = $_SERVER['HTTP_X_FORWARDED'];
} elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
    $waf_mix = $_SERVER['HTTP_FORWARDED_FOR'];
} elseif (isset($_SERVER['HTTP_FORWARDED'])) {
    $waf_mix = $_SERVER['HTTP_FORWARDED'];
} elseif (isset($_SERVER['REMOTE_ADDR'])) {
    $waf_mix = $_SERVER['REMOTE_ADDR'];
}



//$waf_user_agent     = $_SERVER['HTTP_USER_AGENT']; daha sonra parse edilip eklenecek
$waf_request_uri    = $_SERVER['REQUEST_URI'];
$waf_referrer       = $_SERVER['HTTP_REFERER'];
$waf_query_string   = $_SERVER['QUERY_STRING'];
$waf_request_method = $_SERVER["REQUEST_METHOD"];
$waf_log_file       = "waffing.txt";

$waf_log_file_open = fopen($waf_log_file, "a");
$waf_log_write_data = $waf_username ."|". $waf_ip_address ."|". $waf_cf_ip ."|". $waf_mix ."|". $waf_request_uri ."|". $waf_referrer ."|". $waf_query_string ."|". $waf_request_method ."\n";
fwrite($waf_log_file_open, $waf_log_write_data);
fclose($waf_log_file_open);
*/

$waf_user = $user['username'];
$waf_1 = $_SERVER['SERVER_PORT']; //hep 443 portu şimdilik kaldırılacak,detaylı
$waf_2 = $_SERVER['HTTPS']; //hep on yani açık görünüyor şimdilik kaldırılacak,sonra detaylı araştırma
$waf_3 = $_SERVER['SERVER_SIGNATURE']; //hep boş görünüyor
$waf_4 = $_SERVER['SERVER_PROTOCOL']; //hep http/1.1 bizim serverınsa kaldırılacak gereksiz
$waf_5 = $_SERVER['HTTP_CF_IPCOUNTRY']; //cloudflare varsa kullanıcının ülkesini verir - kalıyor
$waf_6 = $_SERVER['HTTP_CF_CONNECTING_IP']; //cloudflare üzerinden kullanıcının ip adresini verir - kalıyor
$waf_7 = $_SERVER['HTTP_CLIENT_IP']; //kullanıcının internet ip adresini verir şimdilik kalıyor
$waf_8 = $_SERVER['HTTP_X_FORWARDED_FOR']; //proxy arkasındaki gerçek ipyi verir şimdilik kalıyor
$waf_9 = $_SERVER['HTTP_X_FORWARDED_PROTO']; //hep https gösteriyor şimdilik kaldırılacak
$waf_10 = $_SERVER['HTTP_REFERER']; //kullanıcı nerden geldi - kalıyor
$waf_11 = $_SERVER['HTTP_USER_AGENT']; //kullanıcının browser bilgisi kalıyor
$waf_12 = $_SERVER['HTTP_ACCEPT']; //bakılacak
$waf_14 = $_SERVER['HTTP_ACCEPT_ENCODING']; //hep gzip şimdilik kaldırılacak
$waf_15 = $_SERVER['HTTP_ACCEPT_LANGUAGE']; //kullanıcının ülkesini ve dilini verir kalıyor
$waf_19 = $_SERVER['REMOTE_ADDR']; //kullanıcının ip adresini verir kalıyor
$waf_20 = $_SERVER['REQUEST_URI']; //tam anlamadım ama kalıyor
$waf_21 = $_SERVER['REQUEST_METHOD']; //hep get şimdilik kaldırılacak
$waf_22 = $_SERVER['REQUEST_TIME']; //istek unix zaman dilimi kalıyor
$waf_23 = $_SERVER['REQUEST_SCHEME'];
$waf_24 = $_SERVER['QUERY_STRING']; //&veri=123 olan kısmı verir
$waf_25 = $_SERVER['PHP_SELF']; //hep index.php kaldırılacak
$waf_26 = $_SERVER['SCRIPT_NAME']; //hep index.php kaldırılacak
$waf_27 = getenv('REMOTE_ADDR'); //daha çözemedim kalıyor
$waf_28 = time(); //kendi belirttiğim zaman dilimi

$waf_log_file       = "testwaffing.txt";
$waf_log_file_open = fopen($waf_log_file, "a");
$waf_log_write_data = $waf_user ."|". $waf_1 ."|". $waf_2 ."|". $waf_3 ."|". $waf_4 ."|". $waf_5 ."|". $waf_6 ."|". $waf_7 ."|". $waf_8 ."|". $waf_9 ."|". $waf_10 ."|". $waf_11 ."|". $waf_12 ."|". $waf_14 ."|". $waf_15 ."|". $waf_19 ."|". $waf_20 ."|". $waf_21 ."|". $waf_22 ."|". $waf_23 ."|". $waf_24 ."|". $waf_25 ."|". $waf_26 ."|". $waf_27 ."|". $waf_28 ."\n";
fwrite($waf_log_file_open, $waf_log_write_data);
fclose($waf_log_file_open);
