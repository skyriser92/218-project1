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
$fname = $lname = $email = $password = $phone = $gender = $birthday = "";

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
	$fname = ($_POST["fname"]);
	$lname = ($_POST["lname"]);
	$Upassword = ($_POST["password"]);
	$phone = ($_POST["phone"]);
	$birthday = ($_POST["Bday"]);

	
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
					// set the PDO error mode to exception
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "INSERT INTO accounts (fname, lname, email, phone, birthday, gender, password)
					VALUES ('$fname', '$lname', '$email', '$phone', '$birthday', '$gender', '$Upassword')";
					// use exec() because no results are returned
					$conn->exec($sql);
					echo "New record created successfully";
				}
				catch(PDOException $e) {
					echo $sql . "<br>" . $e->getMessage();
				}
			}
			}
	
	/*else {
		$sql = "INSERT INTO accounts (fname, lname, email, phone, birthday, gender)
			VALUES ($fname, $lname, $email, $phone, $birthday, $gender)";
			// use exec() because no results are returned
			$conn->exec($sql);
			echo "New record created successfully";
	}*/

		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	
	}

	}
	
	
/*	else {
		$servername = "sql2.njit.edu";
		$username = "jcm44";
		$password = "lq40ntX5";
		$dbname = "jcm44";

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO accounts (fname, lname, email, phone, birthday, gender)
			VALUES ($fname, $lname, $email, $phone, $birthday, $gender)";
			// use exec() because no results are returned
			$conn->exec($sql);
			echo "New record created successfully";
		}
		catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}

		$conn = null;
	} */

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
      <label for="fname">First Name:</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" value="<?php echo $fname;?>">
    </div>
	<div class="form-group">
      <label for="lname">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" value="<?php echo $lname;?>">
    </div>
	<div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email;?>">
    </div>
	<div class="form-group">
      <label for="password">Password:</label>
      <input type="text" class="form-control" id="password" placeholder="Enter New Password" name="password" value="<?php echo $password;?>">
    </div>
    <div class="form-group">
      <label for="phone">Phone Number:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="<?php echo $phone;?>">
    </div>
	<div class="form-group">
      <label for="Bday">Birthday:</label>
      <input type="date" class="form-control" id="Bday" placeholder="Enter Birthday" name="Bday"  value="">
    </div>
	<label>Gender:</label>
    <div class="radio">
      <label><input type="radio" name="male" <?php if (isset($gender) && $gender=="male") echo "checked";?>>Male</label>
    </div>
	<div class="radio">
      <label><input type="radio" name="female" <?php if (isset($gender) && $gender=="female") echo "checked";?>>Female</label>
    </div>
	<div class="radio">
      <label><input type="radio" name="other" <?php if (isset($gender) && $gender=="other") echo "checked";?>>Other</label>
    </div>
    <button
    <button
    <button type="submit" class="btn btn-basic btn-block">Submit</button>
  </form>
</div>
</div>

</body>
</html>
