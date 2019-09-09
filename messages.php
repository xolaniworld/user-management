<?php
include __DIR__ . '/bootstrap.php';

if(\Application\Authentication::isNotLoggedIn()) {
    header('location:index.php');
} else {
    $headerTitle = 'Messages';
    $reciver = $_SESSION['alogin'];
    $feedbackGateway = new \Application\FeedbackGateway($dbh);
    list($results, $count) = $feedbackGateway->findByReciver($reciver);
    $cnt=1;

    // Render a template
    echo $templates->render('messages', [
        'alogin' => $reciver,
        'results' => $results,
        'count' => $count
    ]);
    /*
    ?>
    <?php include('includes/html_header.php'); ?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Messages</h2>
						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">List Users</div>
							<div class="panel-body">
                                <?= $this->section('')?>
                                <?php include INCLUDES_DIR . 'alerts_mgshow.php'; ?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										       <th>#</th>
												<th>User</th>
												<th>Message</th>
										</tr>
									</thead>
									<tbody>

<?php 
$reciver = $_SESSION['alogin'];
$feedbackGateway = new \Application\FeedbackGateway($dbh);
list($results, $count) = $feedbackGateway->findByReciver($reciver);
$cnt=1;
if($count > 0) {
foreach($results as $result) { ?>
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->sender);?></td>
											<td><?php echo htmlentities($result->feedbackdata);?></td>
										</tr>
										<?php $cnt++; }} ?>
									</tbody>
								</table>
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
<?php */ }