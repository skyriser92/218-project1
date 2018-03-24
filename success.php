<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Successful</title>
</head>
<body>
<div style="text-align:center; margin-top:30px">
	<h1>You have Successfully logged in!!!</h1>
<div style="width:320px; margin:auto;">
<?php
echo "<table>";
 echo "<tr><th>Firstname</th><th>Lastname</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

$servername = "sql2.njit.edu";
$username = "jcm44";
$password = "lq40ntX5";
$dbname = "jcm44";
$email = $_SESSION["email"];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	echo "Connected Successfully! <br>";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT fname, lname FROM accounts WHERE email = '$email'"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }

}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 
</div>

</div>
</body>
</html>