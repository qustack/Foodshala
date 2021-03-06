<?php
  require('../../config/config.php');
  if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $addr = $_POST['addr'];
    $pwd = md5($_POST['pwd']);
    $query = "INSERT INTO restaurant(email, name, address, pwd)
		SELECT * FROM(SELECT '$email', '$name', '$addr', '$pwd') AS tmp 
		WHERE NOT EXISTS (SELECT * FROM restaurant WHERE email='$email')
    LIMIT 1";
    if(mysqli_query($conn, $query)){
      $_SESSION['rest_id'] = $_POST['email'];
      header('Location: '.'http://localhost/sandbox/Foodshala/restaurant/dashboard/inventory.php'.'');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../assets/title.png">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="register.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
      <img class="mb-4" src="logo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Create Account</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputName" class="sr-only">Restaurant name</label>
      <input type="text" name="name" id="inputName" class="form-control" placeholder="Restaurant name" required autofocus>
      <label for="inputAddr" class="sr-only">Address</label>
      <input type="text" name="addr" id="inputAddr" class="form-control" placeholder="Address" required autofocus>
      <label for="inputPassword" class="sr-only">Choose password</label>
      <input type="password" name="pwd" id="inputPassword" class="form-control" placeholder="Choose password" required>
      <div><br></div>
      <input type="submit" class="btn btn-lg btn-primary btn-block" value="Submit" name="submit">
    </form>
  </body>
</html>
