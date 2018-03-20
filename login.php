<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign Up</title>
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
	
	function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
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

			if ($v != ''){
				echo "<br>Email has already been used.";		
			}
			else{
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
						echo "<br>Password is incorrect";		
					}
					else{
					$conn = null;
					header( 'Location: index.html' );
					}
				}
			}
				
		}		
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
}
?>

<div style="margin-top:20px">
<div style="width:400px; margin:auto; background-color:white; padding:8px; border:solid; border-color:#cccccc">
  <h2 style="text-align:center">Sign Up Form</h2>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <label for="fname">First Name:</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" value="<?php echo $fname;?>">
    </div>
	<div class="form-group">
      <label for="lname">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" value="<?php echo $lname;?>">
    </div>
	    <button
    <button
    <button type="submit" class="btn btn-basic btn-block">Submit</button>
  </form>
</div>
</div>

</body>
</html>
