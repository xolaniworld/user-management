<?php
$dbh = require __DIR__ . '/bootstrap.php';

if(isset($_POST['login']))
{
    $userRepository = new \UserManagement\UsersRepository($dbh);

    $login = $userRepository->login($_POST['username'], $_POST['password']);
    $results=$userRepository->getResults();
    if($login)
    {
        $_SESSION['alogin']=$_POST['username'];
        echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
    } else{

        echo "<script>alert('Invalid Details Or Account Not Confirmed');</script>";

    }

}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	
	<link rel="stylesheet" href="public/css/font-awesome.min.css">
	<link rel="stylesheet" href="public/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="public/css/bootstrap-social.css">
	<link rel="stylesheet" href="public/css/bootstrap-select.css">
	<link rel="stylesheet" href="public/css/fileinput.min.css">
	<link rel="stylesheet" href="public/css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="public/css/style.css">

</head>

<body>
	<div class="login-page bk-img">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold mt-4x">Login</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">

									<label for="" class="text-uppercase text-sm">Your Email</label>
									<input type="text" placeholder="Username" name="username" class="form-control mb" required>

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb" required>
									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
								</form>
								<br>
								<p>Don't Have an Account? <a href="register.php" >Signup</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="public/js/jquery.min.js"></script>
	<script src="public/js/bootstrap-select.min.js"></script>
	<script src="public/js/bootstrap.min.js"></script>
	<script src="public/js/jquery.dataTables.min.js"></script>
	<script src="public/js/dataTables.bootstrap.min.js"></script>
	<script src="public/js/Chart.min.js"></script>
	<script src="public/js/fileinput.js"></script>
	<script src="public/js/chartData.js"></script>
	<script src="public/js/main.js"></script>

</body>

</html>