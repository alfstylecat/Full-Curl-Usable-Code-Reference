<?

//Sqlite veritabanı yedekleme
$backup = new SQLite3('backup.sqlite');
$conn->backup($backup);

//son işlem gören satır sayısını int değeri olarak döndürür
$query = $db->exec('UPDATE counter SET views=0 WHERE page="test"');
if ($query) {
    echo 'İşlem gören satır sayısı: ', $db->changes();
}

//veritabanı bağlantısını kapatır
$db = new SQLite3('mysqlitedb.db');
$db->close();

//sqlite query örneği
$db = new SQLite3('mysqlitedb.db');
$results = $db->query('SELECT bar FROM foo');
while ($row = $results->fetchArray()) {
    var_dump($row);
}

//tek sonuc döndürme query single
$db = new SQLite3('mysqlitedb.db');
var_dump($db->querySingle('SELECT username FROM user WHERE userid=1'));
print_r($db->querySingle('SELECT username, email FROM user WHERE userid=1',
      true));

//sqlite enjeksiyon önleme eski olabilir bakılacak
if (get_magic_quotes_gpc()) {
   $name = sqlite_escape_string($name);
}
$result = @$db->query("SELECT * FROM users WHERE username = '{$name}'");

Not – SQLite sorguları için dizelerinizi alıntılamak için addslashes() KULLANILMAMALIDIR; verilerinizi alırken garip sonuçlara yol açacaktır.

<//örnek
$db = new SQLite3('mydb.sq3');
$sql = "SELECT * FROM items WHERE price < 3.00";
$result = $db->query($sql);
while ($row = $result->fetchArray(SQLITE3_ASSOC)){
  echo $row['name'] . ': $' . $row['price'] . '<br/>';
}
unset($db);



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
