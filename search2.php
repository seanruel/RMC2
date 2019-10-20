<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biz";
$datatable = "table 1";

function highlight_word( $Businessname, $word) {
    $replace = '<span style="background-color: #FF0;">' . $word . '</span>'; // create replacement
    $Businessname = str_replace( $word, $replace, $Businessname ); // replace content
    return $Businessname; // return highlighted data
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search</title>
<style>
body {
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;	
}
.wrapper {
	max-width:600px;
}
</style>
</head>

<body>
<div class="wrapper">
<form action="search2.php" method="get">
Search: <input type="text" name="findme" value="<?php echo $_GET["findme"]; ?>" /><input type="submit" value="Search" /><br />
<input name="show" type="radio" value="1"<?php if ($_GET["show"]=='1' or !isset($_GET["show"])) echo ' checked="checked"'; ?> />Show all news 
<input name="show" type="radio" value="2"<?php if ($_GET["show"]=='2') echo ' checked="checked"'; ?> />Show news that match search criteria
</form>
<hr>
<?php
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if ($_GET["show"]=='2') {
	$sql = "SELECT * FROM ".$datatable." WHERE Businessname LIKE '%".$conn->real_escape_string($_GET["findme"])."%'";
} else {
	$sql = "SELECT * FROM ".$datatable;
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if ($_GET["findme"]<>'') {
			echo highlight_word($row["Businessname"], $_GET["findme"]);
		} else {
	        echo $row["Businessname"];
		}
		echo "<hr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

</div>
</body>
</html>