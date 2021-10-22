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
