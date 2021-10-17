<?

/*
Gerektiğinde hazırda bulunması için,
kullanılan veya kullanılması düşünülen tüm curl fonksiyonları
*/


function all_curl($url) {
 //Hangi url'ye baglanacak
 $curl = curl_init($url);
 
 //Dönen veriyi değişkene aktar emri
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
 //Zaman aşımı 3 saniye
 curl_setopt($curl, CURLOPT_TIMEOUT, 3);
 
 //Http bilgisi gönderme
 curl_setopt($curl, CURLOPT_HTTPHEADER, false);
 
 curl_setopt($curl, CURLOPT_ENCODING, '');
 
 curl_setopt($curl, CURLOPT_MAXREDIRS, 5);
 
 curl_setopt($curl, CURLOPT_HTTP_VERSION, '');
 
 curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
 
 //Dönen verinin değişkene aktarılması
 $response = curl_exec($curl);
 
 $err = curl_error($curl);
 
 curl_close($curl);
 return $response;
}


