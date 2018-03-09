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
// define variables and set to empty values

//Validation of email
$emailErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


}

<div style="margin-top:20px">
<div style="width:400px; margin:auto; background-color:white; padding:8px; border:solid; border-color:#cccccc">
  <h2 style="text-align:center">Sign Up Form</h2>
  
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
      <label for="fname">First Name:</label>
      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
    </div>
	<div class="form-group">
      <label for="lname">Last Name:</label>
      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
    </div>
	<div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="phone">Phone Number:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone">
    </div>
	<div class="form-group">
      <label for="Bday">Birthday:</label>
      <input type="date" class="form-control" id="Bday" placeholder="Enter Birthday" name="Bday">
    </div>
	<label>Gender:</label>
    <div class="radio">
      <label><input type="radio" name="male">Male</label>
    </div>
	<div class="radio">
      <label><input type="radio" name="female">Female</label>
    </div>
	<div class="radio">
      <label><input type="radio" name="other">Other</label>
    </div>
    <button
    <button
    <button type="submit" class="btn btn-basic btn-block">Submit</button>
  </form>
</div>
</div>

</body>
</html>
