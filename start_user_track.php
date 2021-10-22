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

//Sitemdeki kullaniciyi esitlemek icin.
$waf_username = "Otherusername";
//Kullanicinin ip adresini aliyoruz.
$waf_ip_address = $_SERVER['REMOTE_ADDR'];
//Log dosyasini degiskene aktariyoruz.
$waf_log_file = "waffing.txt";

//Log dosyasi sadece yazmak icin aciliyor.
$waf_log_file_open = fopen($waf_log_file, "a");
//Yazilacak veriler degiskene aktariliyor.
$waf_log_write_data = $waf_username ."|". $waf_ip_address ."\n";
//Degiskene aktarilan veriler log dosyasina yaziliyor.
fwrite($waf_log_file_open, $waf_log_write_data);
//Verilerin yazilmasindan sonra dosya kapatiliyor.
fclose($waf_log_file_open);
