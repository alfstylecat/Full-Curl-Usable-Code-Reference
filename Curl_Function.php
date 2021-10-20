<?

/*
Gerektiğinde hazırda bulunması için,
kullanılan veya kullanılması düşünülen tüm curl fonksiyonları
*/


function all_curl($url) {
 
 //Her ihtimale karşı curl yüklümü değilmi bakıyoruz
 if (!function_exists('curl_init')){ 
 die('CURL Yüklü Değil!');
 }
 
 //Hangi url'ye baglanacak
 //http_build_query tam kullanımına bakılacak
 $curl = curl_init($url);
 
 //Dönen veriyi değişkene aktar emri
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
 //Yönlendirmeleri takip et
 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  
 //Göndermek istediğimiz referans bilgisi
 curl_setopt($curl, CURLOPT_REFERER, 'https://google.com');
 
 //Gönderilmek istenen tarayıcı başlığı
 curl_setopt($curl, CURLOPT_USERAGENT, '');
 
 //Sunucuda Ssl varsa devredışı bırakmak için
 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
 
 //Sunucuda Ssl varsa devredışı bırakmak için
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
 
 //Zaman aşımı 3 saniye
 curl_setopt($curl, CURLOPT_TIMEOUT, 3); //Curl işlevlerinin çalışmasına verilecek max süre saniye cinsinden
 curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3); //Bağlantının deneneceği süre saniye cinsinden
 
 //Http bilgisi gönderme - seçenekler hemen aşşağıda
 // 'content-type: application/json; charset=utf-8' - Json yanıtı istiyorsak
 // 'cache-control: no-cache' - cache yok
 // 'Accept: text/xml,application/xml,application/xhtml+xml,' - xml dosyası
 // 'text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5' - resim png dosyası
 // 'Cache-Control: max-age=0' - 
 // 'Connection: keep-alive' - 
 // 'Keep-Alive: 300' - 
 // 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7' - 
 // 'Accept-Language: en-us,en;q=0.5' - Tarayıcı dili
 // 'Pragma: ' - Tarayıcılar genellikle boş olarak algılıyor - araştırılacak
 curl_setopt($curl, CURLOPT_HTTPHEADER, false);
 
 curl_setopt($curl, CURLOPT_ENCODING, '');
 
 //İzlenecek HTTP yönlendirmelerinin azami sayısı. CURLOPT_FOLLOWLOCATION ile birlikte kullanılır. 
 //Sonsuz yönlendirmeyi engellemek için atanan öntanımlı değer 20'dir. 
 //1 atamak sonsuz yönlendirmeye izin verir, 0 ise tüm yönlendirmeleri reddeder.
 curl_setopt($curl, CURLOPT_MAXREDIRS, 5);
 
 //bağlantı için kullanılacak port
 curl_setopt($curl, CURLOPT_PORT, 443);
 
 //İstek gövdesi isteniyormu işte siteyi komple tarayıcımıza çıkarmayan meşhur kod.
 curl_setopt($curl, CURLOPT_NOBODY, false);
 
 curl_setopt($curl, CURLOPT_FAILONERROR, true);
 
 //Ayrıntılı hata denetimi veya çıktı istiyorsak, if ile $hatadenetim veri tipi dahil falseye eşit değilse
	if($hatadenetim !== false) {
	$dosya = fopen($hatadenetim,'w');
	curl_setopt($pointer, CURLOPT_VERBOSE, true);
	curl_setopt($pointer, CURLOPT_STDERR, $dosya);
	}
 
 //Tam kullanımına bakılacak
 curl_setopt($curl, CURLOPT_AUTOREFERER, true);
 
 //Http versiyonu göndermek istersek parametreler hemen aşşağıda verilmiştir.
 //CURL_HTTP_VERSION_1_1
 curl_setopt($curl, CURLOPT_HTTP_VERSION, 'parametre');
 
 //urle yapılacak isteğin çeşidi
 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
 
 //Opsiyonel seçim kimlik doğrulaması
 curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
 curl_setopt($curl, CURLOPT_USERPWD, "username:password");
 
 //Çerez belirtmek istiyorsak, genellikle 3'ü birlikte kullanılır
 curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookieyolu');
	curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie yolu');
	curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . session_id());
 
 //'veri' veya $veri, form verisi göndermek istiyorsak 2'side olması ve postun true olması gerek
 curl_setopt($curl, CURLOPT_POST, false);
 curl_setopt($curl, CURLOPT_POSTFIELDS, 'veri');
 
 //fopen() ile beraber kullanılır dosyaya yazma fonksiyonu
 curl_setopt($curl, CURLOPT_FILE, $file);
 curl_setopt($curl, CURLOPT_WRİTEHEADER, $file); //Aktarımın başlık bölümünün yazılacağı dosya

 //Dönen verinin değişkene aktarılması
 $response = curl_exec($curl);
 
 //Hata oluştu ise ekrana bastırıp fonksiyonu durduruyoruz
 $http_kodu = curl_getinfo($curl, CURLINFO_HTTP_CODE);
 echo 'Veri: ' .$http_kodu. '\n';
 echo 'Curl hatası: ' .curl_error($curl). '!!!  \n';
 if($http_code == 404)	{
	return false;
 }
 
 curl_close($curl);
 return $response;
}



--- İşe Yarar Hızlı Kullanım Fonksiyonlar ---
 
 //En Çok Kullanılacak fonksiyon
 function get_json_curl($url) {
  $curl = curl_init($url);
  //curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
  $response = curl_exec($curl);
  curl_close($curl);
  return $response;
}
 
//Ip adresinden ulke kodu alma
//Şimdilik çok az değiştirildi json_decode bölümü düzeltilecek
function get_country(){
$ip = $_SERVER['REMOTE_ADDR'];
$request = curl_get('http://ip2country.sourceforge.net/ip2c.php?ip='.$ipForCo.'&format=JSON');
$jsonresponse = json_decode($request, true);
return $jsonresponse['country_code'];
}
echo get_ountry();

//Curl isteğini dosyaya yazma düzenlenecek
function save_data_to_file_w_curl($url,$fname) {
  $timeout=5;
  $path = $fname;
 
  $fp = fopen($path, 'w');
  $ch = curl_init($url);
  //curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );//sometimes you may need this.
  curl_setopt($ch, CURLOPT_FILE, $fp);
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt( $ch, CURLOPT_ENCODING, "" );
  curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
  curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
  curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );

  $response = curl_exec($ch);
  //echo print_r(curl_getinfo($ch),true);//just for checking
  if(!$response)$response=print_r(curl_getinfo($ch),true);
  curl_close($ch);
  fclose($fp);
  return $response;//true or array with CURL INFO
}



//Curl aktarımına bir progress ekler
function getFile(){
  $fp = fopen ("output.html", 'w+');
  $curl = curl_init();
  curl_setopt($curl,CURLOPT_URL,'http://www.mashable.com/');
  curl_setopt($curl, CURLOPT_TIMEOUT, 1000);
  curl_setopt($curl, CURLOPT_FILE, $fp);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($curl, CURLOPT_NOPROGRESS, 0);
  curl_setopt($curl, CURLOPT_PROGRESSFUNCTION, 'curl_progress_callback');

  $result = curl_exec($curl);
  fclose($fp);
}
function curl_progress_callback($dltotal, $dlnow, $ultotal, $ulnow){
    echo "$dltotal\n";
    echo "$dlnow\n";
}
getFile();

---Useragent Servisleri ve Curl İstek Örnekleri---
 1- https://user-agents.net/parser/action=parse&format=json&string= //post isteği direk api link json xml ile değiştirilebilir

$useragent = $_SERVER['HTTP_USER_AGENT'];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://user-agents.net/parser');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 5);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_POSTFIELDS, 'action=parse&string='. $useragent .'&format=json');
$response = curl_exec($curl);
curl_close($curl);
echo $response;





---Ip api servisleri---
1- http://ip-api.com


//Yapılan bir teste göre fgc ve curl hız karşılaştırması
//file_get_contents zamanı = 1.80259204
//curl zamanı = 0.93235898
//curl yeniden başlatma ile = 1.72597504
