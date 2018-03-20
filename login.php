<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#e6e6e6">

<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
// define variables and set to empty values

//Validation of email
$emailErr = "";
$email = $Upassword = "";


class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} 
	else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format"; 
		}
	}
	

	
	$Upassword = ($_POST["password"]);
	
	if (!empty($_POST["email"])) {
		$servername = "sql2.njit.edu";
		$username = "jcm44";
		$password = "lq40ntX5";
		$dbname = "jcm44";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			echo "Connected Successfully! <br>";
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare("SELECT email FROM accounts WHERE email = '$email'"); 
			$stmt->execute();

			// set the resulting array to associative
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

			$v = '';
			foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
				echo $v;
			}

			if ($v != '') {
				$conn = null;
				$servername = "sql2.njit.edu";
				$username = "jcm44";
				$password = "lq40ntX5";
				$dbname = "jcm44";
				
				try {
					$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
					echo "Connected Successfully! <br>";
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare("SELECT password FROM accounts WHERE email = '$Upassword'"); 
					$stmt->execute();

					// set the resulting array to associative
					$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

					$v = '';
					foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
						echo $v;
					}

					if ($v != ''){
						$conn = null;
						header( 'Location: success.html' );
					}
					else{
						echo "<br>Password is incorrect";
					}
				}
				catch(PDOException $e) {
					echo "Error: " . $e->getMessage();
				}
			}
			else {
				echo "<br>Email Incorrect";		
			}
			
			
		}		
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div style="margin-top:20px">
<div style="width:400px; margin:auto; background-color:white; padding:8px; border:solid; border-color:#cccccc">
  <h2 style="text-align:center">Sign Up Form</h2>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php echo $email;?>">
    </div>
	<div class="form-group">
      <label for="Upassword">Password:</label>
      <input type="password" class="form-control" id="Upassword" placeholder="Enter Password" name="Upassword" value="<?php echo $Upassword;?>">
    </div>
	    <button
    <button
    <button type="submit" class="btn btn-basic btn-block">Submit</button>
  </form>
</div>
</div>

</body>
</html>
