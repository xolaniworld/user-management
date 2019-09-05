<?php
include __DIR__ . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
    exit;
} else {
    if(isset($_POST['submit'])) {
	    $notificationGateway = new \Application\NotificationGateway($dbh);
	    $feedbackGateway = new \Application\FeedbackGateway($dbh);
	    $frontendFeedbackTransaction = new \Application\FrontendFeedbackTransaction($feedbackGateway, $notificationGateway, new \Application\Filesystem(ATTACHMENT_DIR));
	    $frontendFeedbackTransaction->submitFeedback($_POST['title'], $_POST['description'], $_SESSION['alogin'], $_FILES['attachment']);
	    $msg = "Feedback Send";
    }

    $headerTitle = 'Feedback';
?>
<?php
$usersGateway = new \Application\UsersGateway($dbh);
$result = $usersGateway->findAll();
		$cnt=1;	
?>
	<?php include('includes/html_header.php');?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
                       
							<div class="col-md-12">
                            <h2>Give us Feedback</h2>
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
                                    <?php include INCLUDES_DIR . 'alerts.php'?>
<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">

<div class="form-group">
    <input type="hidden" name="user" value="<?php echo htmlentities($result->email); ?>">
	<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" name="title" class="form-control" required>
	</div>

	<label class="col-sm-2 control-label">Attachment<span style="color:red"></span></label>
	<div class="col-sm-4">
	<input type="file" name="attachment" class="form-control">
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Description<span style="color:red">*</span></label>
	<div class="col-sm-10">
	<textarea class="form-control" rows="5" name="description"></textarea>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Send</button>
	</div>
</div>

</form>
									</div>
								</div>
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
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
	</script>
</body>
</html>
<?php }