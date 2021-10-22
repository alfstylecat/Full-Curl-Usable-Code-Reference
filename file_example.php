<?
///$myfile = fopen("nameEmail.txt", "w") or die("Unable to open file");
$myfile = fopen("nameEmail.txt", "a") or die("Unable to open file");
$out = $_POST['name'] . "|" . $_POST['email'];
$out .= "\n";
fwrite($myfile, $out);
fclose($myfile);

$myfile = fopen("poem.txt", "r") or die("Unable to open file");
$poem = fread($myfile, filesize("poem.txt"));
fclose($myfile);
$poem = str_replace("\n" , "<br/>", $poem);

//save csv
 $out = $_POST['name'] . "," . $_POST['email'] . "," . $_POST['phone'] . "\n";
$myfile = fopen("director.csv", "a") or die("Unable to open file");
fwrite($myfile, $out);
fclose($myfile);

//read csv
$out = $_POST['name'] . "," . $_POST['email'] . "," . $_POST['phone'] . "\n";
$myfile = fopen("directory.csv", "a") or die("Unable to open file");
fwrite($myfile, $out);
fclose($myfile);
$myfile = fopen("directory.csv", "r") or die("Unable to open file");
print("<table>");
while(($data = fgetcsv($myfile, 1000, ","))!== FALSE){
print("<tr>");
for($x =0; $x < count($data); $x++)
{
print("<td>");
print($data[$x]);
print("</td>");
}
print("</tr>");
}
print("</table>");
fclose($myfile);
$_POST['name']= null;
} else
{
$myfile = fopen("directory.csv", "r") or die("Unable to open file");
print("<table>");
while(($data = fgetcsv($myfile, 1000, ","))!== FALSE){
print("<tr>");
for($x =0; $x < count($data); $x++)
{
print("<td>");
print($data[$x]);
print("</td>");
}
print("</tr>");
}
print("</table>");
fclose($myfile);
$_POST['name']= null;
}


//save cookie
$cookieName = "userID";
$cookieValue = "mlassoff";
$cookieExpires = time() + (60 * 60 * 24 * 30);
setcookie($cookieName, $cookieValue, $cookieExpires, "/");

//kontrol cookie
$cookieName = "userID";
if(!isset($_COOKIE[$cookieName]))
{
$out = "No User ID set";
} else
{
$out = $_COOKIE[$cookieName];
}

//delete cookie
$cookieName = "userID";
setcookie($cookieName, "", time()-3600, "/");

if(!isset($_COOKIE[$cookieName]))
{
$out = "No User ID set";
} else
{
$out = $_COOKIE[$cookieName];
}

session_start();
$_SESSION["userID"] = "10105";
$_SESSION["userNickName"] = "Animal";

session_start();
$id = $_SESSION["userID"];
$nick = $_SESSION["userNickName"];

session_start();
unset($_SESSION["userID"]);
unset($_SESSION["userNickName"]);

//dosyanın birşeyler silme örnek kod altındaki yorum
//You forgot the $ from a couple of your $array references. (See lines 7 and 8.)
//Also look into the unset function. It would allow you to drop the entire line from the array, 
//rather than just clearing out the text and leaving an empty line in the output.
//reading the file contents into an array
$array=file('filename.txt');
//deleting 
for($i=0;$i<count($array);$i++){
 if(array[$i]==$text_to_delete)
      array[$i]='';
}
//write the new data to the file
$file=fopen('filename.txt','w');
fwrite($file,implode('\n',$array));
fclose($file);

//dosya kullanarak kaç kişi online
$file = "users.ini";
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();
$content = @file_get_contents($file);
$new_content = $ip." = ".$time;
$content .= $new_content."\r\n";
@file_put_contents($file,$content);

$users = @parse_ini_file($file);
$count = 0;
foreach($users as $ip=>$time){
	if($time >= time() - 300){ // past 3 minutes
		$count++;
	}
}
echo $count;

//user online 2
$config = array(
				user_time => time(),
				user_ip => $_SERVER['REMOTE_ADDR'];
				file_name => 'users.txt'
				);
				
				
$new_line = $config['user_ip'] . "|" . $config['user_time'] . "\r\n";

file_put_contents($config['file_name'], $new_line); //Write File

$online_file = file_get_contents($config['file_name']);
$online_file = explode("\r\n", $online_file);

foreach($online_file as $online_users)
{
	$users = explode("|", $online_users);
	if($users[1] >= time() - 300)
	{
		$online++;
	}
}

echo $online;

//eşleşen diziyi silme eski kod revize edilecek
// this function will delete a line in a file
// if it equals the $text_to_delete parameter
// created by Rodger Benham from 
function del_line_in_file($filename, $text_to_delete)
{
  // $file_contents = file_get_contents('blocked.squid');
  // split the string up into an array
  $file_array = array();
	
  $file = fopen($filename, 'rt');
  if($file)
  {
    while(!feof($file))
    {
      $val = fgets($file);
      if(is_string($val))
        array_push($file_array, $val);
    }	
    fclose($file);
  }
	
  // delete from file
  for($i = 0; $i < count($file_array); $i++)
  {
    if(strstr($file_array[$i], $text_to_delete))
    {
      if($file_array[$i] == $text_to_delete . "n") $file_array[$i] = '';
    }
  }
	
  // write it back to the file
  $file_write = fopen($filename, 'wt');	
  if($file_write)
  {
    fwrite($file_write, implode("", $file_array));
    fclose($file_write);
  }
}

// example usage
del_line_in_file("blocked.txt", "sex.com");

//bir oturumdaki sayfa görüntülenme sayısı
session_start();
if(isset($_SESSION['view']))
{
    $_SESSION['view']=$_SESSION['view']+1;
}
else
{
    $_SESSION['view']=1;
}
print "Page Views This Session:".$_SESSION['view'];

//kaç kullanıcı çevrimiçi
$file = "users.ini";
$ip = $_SERVER['REMOTE_ADDR'];
$time = time();
$content = @file_get_contents($file);
$new_content = $ip." = ".$time;
$content .= $new_content."rn";
@file_put_contents($file,$content);

$users = @parse_ini_file($file);
$count = 0;
foreach($users as $ip=>$time){
	if($time >= time() - 500){
		$count++;
	}
}
echo "We have <b>$count</b> visitors now";

//tablo oluşturma
if(!file_exists("read_me.txt"))
    {
        echo "The file from above cannot be found!";
        exit;
    }
    
    $fp = fopen("read_me.txt", "r");
    
    if(!$fp)
    {
        echo "Somehow the file cannot be opened! :)";
        exit;
    }
    echo "<table border = 4>";
    $counter = 1;
    while(!feof($fp))
    {
        $zeile = fgets($fp);
        echo "<tr><td>$counter</td>";
        echo "<td>$zeile</td>";
        $counter++;
    }
        echo "</table>";
    fclose($fp)
