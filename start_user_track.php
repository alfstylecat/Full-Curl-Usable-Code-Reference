<?
/*
Yapılanlar
1- kullanıcı adını al
2- ip adresini al
3- dosyaya kaydet

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
26- 
*/

$waf_username = "";
$waf_ip_address = "";
