<?
//Bilgi - yapılan testlerde proxy algılama denilen hiçbir fonksiyon çalışmamaktadır.
//ya başka türlü deneme yapılacak yada proxy algılamak için 3. parti siteler kullanılacak
echo "orjinal ip adresim = 0.0.0.0";

echo "<br>Remote_addr". $_SERVER["REMOTE_ADDR"];

echo "<br>Orjinal sunucumun ip adresi". $_SERVER["SERVER_ADDR"];

echo "<br>İnternet ip adres http_client_ip ". $_SERVER['HTTP_CLIENT_IP'];

echo "<br>proxy server adres x forwarded for ". $_SERVER['HTTP_X_FORWARDED_FOR'];

echo "<br>cloudflareden doğru ip adresi alma ". $_SERVER['HTTP_CF_CONNECTING_IP'];

echo "<br>bilinmiyor x forwarded". $_SERVER['HTTP_X_FORWARDED'];

echo "<br>bilinmiyor forwarded". $_SERVER['HTTP_FORWARDED'];

echo "<br>getenv remote addr getenv bakılacak ". getenv('REMOTE_ADDR');

echo "<br>yapılan isteğin türü ". $_SERVER['REQUEST_METHOD'];

echo "<br>yapılan isteğin unix zaman damgası ". $_SERVER['REQUEST_TIME'];

echo "<br> kendi eklediğim zaman damgası ". time();

echo "<br>bağlantı yapılan port ". $_SERVER["REMOTE_PORT"];

echo "<br>bağlantı yapılan host ". $_SERVER["REMOTE_HOST"];

echo "<br>istek yapılan url ". $_SERVER["REQUEST_URI"];

echo "<br>bilinmiyor ". $_SERVER["QUERY_STRING"];

echo "<br>gelinen referans bağlantısı ". $_SERVER["HTTP_REFERER"];

echo "<br>istemci tarafı kullanıcının useragentini almak ". $_SERVER["HTTP_USER_AGENT"];
