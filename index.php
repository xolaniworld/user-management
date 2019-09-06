<?php
include __DIR__ . '/bootstrap.php';

if (isset($_POST['login'])) :
    $usersGateway = new \Application\UsersGateway($dbh);
    $loginTransaction = new \Application\LoginTransaction($usersGateway);
    $loginTransaction->submitLogin($_POST['username'], $_POST['password']);
    if ($loginTransaction->submitLogin($_POST['username'], $_POST['password'])) :
        $_SESSION['alogin'] = $_POST['username']; ?>
        <script type='text/javascript'> document.location = 'profile.php'; </script>
    <?php  else : ?>
        <script> alert('Invalid Details Or Account Not Confirmed');</script>
    <?php
    endif;
endif;

// Render a template
echo $templates->render('home');

/*
?>
<?php include('includes/html_header.php'); ?>
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
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
*/