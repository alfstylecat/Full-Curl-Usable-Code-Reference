<?
//kullanılacak veritabanı gerekli düzeltmeler ve eklemeler yapılması gerek
//id int, not null, auto increment
//username text
//ip_address text
//country text
//user_referrer text
CREATE TABLE "users" (
	"id"	INTEGER UNIQUE,
	"user_name"	TEXT,
	"ip_address"	TEXT,
    "request_url" ?,
    "request_size" ?,
    "timestamp" TİMESTAMP,
    "http_status_code" ?,
    "http_method" ?,
    "user_country" ?,
    "user_agent"	TEXT,
    "user_referrer" ?,
    "user_port" ?,
    "request_method" ?,
    "server_protocol" ?,
	PRIMARY KEY("id" AUTOINCREMENT)
);

//sqlite3 nesnesi olusturarak sqlite3 veritabani baglantisi aciyoruz
$db = new SQLite3('test.db');

//sqlite3 exec() veritabanindan sorgu yurutme create,insert,update,delete vb.
$db->exec("CREATE TABLE Cars(id INTEGER PRIMARY KEY, isim METİN, fiyat INT)");
$db->exec("INSERT INTO arabalar(ad, fiyat) DEĞERLER('Audi', 52642)");

//veritabaninda tablo olusturma 3 alan id name price integer primary key otomatik olarak arttirma
$db->exec("CREATE TABLE cars(id INTEGER PRIMARY KEY, name TEXT, price INT)");

//Sqlite veritabanı yedekleme
$backup = new SQLite3('backup.sqlite');
$conn->backup($backup);

//son işlem gören satır sayısını int değeri olarak döndürür
$query = $db->exec('UPDATE counter SET views=0 WHERE page="test"');
if ($query) {
    echo 'İşlem gören satır sayısı: ', $db->changes();
}

//son eklenen satirin kimligine alma
$last_row_id = $db->lastInsertRowID();
echo "The last inserted row Id is $last_row_id";

//veritabanı bağlantısını kapatır
$db = new SQLite3('mysqlitedb.db');
$db->close();

//sqlite query örneği
$db = new SQLite3('mysqlitedb.db');
$results = $db->query('SELECT bar FROM foo');
while ($row = $results->fetchArray()) {
    var_dump($row);
}

//sqlite query 2
$rows = $db->query('SELECT * FROM cars');
foreach ($rows as $row) {
    $id = $row->id;
    $name = $row->name;
    $price = $row->price;
    echo "$id $name $price \n";
}

//sorgu query 2 olusturma ve donen degerleri alma
$res = $db->query('SELECT * FROM cars');
while ($row = $res->fetchArray()) {
    echo "{$row['id']} {$row['name']} {$row['price']} \n";
}

//tek sonuc döndürme query single
$db = new SQLite3('mysqlitedb.db');
var_dump($db->querySingle('SELECT username FROM user WHERE userid=1'));
print_r($db->querySingle('SELECT username, email FROM user WHERE userid=1',
      true));
//tek sonuc 2
$versiyon = $db->querySingle('SELECT SQLITE_VERSION()');
      
      
      

//sqlite enjeksiyon önleme eski olabilir bakılacak
if (get_magic_quotes_gpc()) {
   $name = sqlite_escape_string($name);
}
$result = @$db->query("SELECT * FROM users WHERE username = '{$name}'");

//sqlite escape string guvenlik
$db = new SQLite3('test.db');
$sql = "SELECT name FROM cars WHERE name = 'Audi'";
$escaped = SQLite3::escapeString($sql);
var_dump($sql);
var_dump($escaped);



Not – SQLite sorguları için dizelerinizi alıntılamak için addslashes() KULLANILMAMALIDIR; verilerinizi alırken garip sonuçlara yol açacaktır.

<//örnek sintesisdigital
$db = new SQLite3('mydb.sq3');
$sql = "SELECT * FROM items WHERE price < 3.00";
$result = $db->query($sql);
while ($row = $result->fetchArray(SQLITE3_ASSOC)){
  echo $row['name'] . ': $' . $row['price'] . '<br/>';
}
unset($db);


//bağlantı tablo oluşturma sorgu oluşturma listeleme
$db= new SQLite3("../db/mydb.sqlite");//asuming you created a folder "db" in the root of your home drive and your database files is called "test.db".
//$db->exec('CREATE TABLE table1(id INTEGER PRIMARY KEY NOT NULL, value TEXT)');
//Uncomment the line above to create the  Table, do it only once.
$string_to_insert=$db->escapeString(date("r" ,time()));//Important to escape any strings before inserting them into a query since they can contain an illegal character 
//or can be used for "sting insertion" hacks.
$db->exec("INSERT INTO table1 (value) VALUES ('$string_to_insert')");
$sql_select='SELECT * FROM table1 ORDER BY ID DESC';
$result=$db->query($sql_select);
echo "<table border='1'>";
echo "<tr>";
$numColumns=$result->numColumns();
for ($i = 0; $i < $numColumns; $i++)
{
    $colname=$result->columnName($i);
    echo "<th>$colname</th>";
}
echo "</tr>";
while($row = $result->fetchArray(SQLITE3_NUM))
{
    echo "<tr>";
    for ($i = 0; $i < $numColumns; $i++)
    {
        $value=$row[$i];
        echo "<th>$value</th>";
    }
    echo "</tr>";
}
echo "</table>";
$sql_clean="DELETE FROM table1 WHERE ID<(SELECT MAX(ID) FROM table1)-20";//Keeps only the last 20 entries in the table.
$db->exec($sql_clean);



SQLite3::CREATE_INDEX	Index Name	Table Name
SQLite3::CREATE_TABLE	Table Name	null
SQLite3::CREATE_TEMP_INDEX	Index Name	Table Name
SQLite3::CREATE_TEMP_TABLE	Table Name	null
SQLite3::CREATE_TEMP_TRIGGER	Trigger Name	Table Name
SQLite3::CREATE_TEMP_VIEW	View Name	null
SQLite3::CREATE_TRIGGER	Trigger Name	Table Name
SQLite3::CREATE_VIEW	View Name	null
SQLite3::DELETE	Table Name	null
SQLite3::DROP_INDEX	Index Name	Table Name
SQLite3::DROP_TABLE	Table Name	null
SQLite3::DROP_TEMP_INDEX	Index Name	Table Name
SQLite3::DROP_TEMP_TABLE	Table Name	null
SQLite3::DROP_TEMP_TRIGGER	Trigger Name	Table Name
SQLite3::DROP_TEMP_VIEW	View Name	null
SQLite3::DROP_TRIGGER	Trigger Name	Table Name
SQLite3::DROP_VIEW	View Name	null
SQLite3::INSERT	Table Name	null
SQLite3::PRAGMA	Pragma Name	First argument passed to the pragma, or null
SQLite3::READ	Table Name	Column Name
SQLite3::SELECT	null	null
SQLite3::TRANSACTION	Operation	null
SQLite3::UPDATE	Table Name	Column Name
SQLite3::ATTACH	Filename	null
SQLite3::DETACH	Database Name	null
SQLite3::ALTER_TABLE	Database Name	Table Name
SQLite3::REINDEX	Index Name	null
SQLite3::ANALYZE	Table Name	null
SQLite3::CREATE_VTABLE	Table Name	Module Name
SQLite3::DROP_VTABLE	Table Name	Module Name
SQLite3::FUNCTION	null	Function Name
SQLite3::SAVEPOINT	Operation	Savepoint Name
SQLite3::RECURSIVE	null	null
