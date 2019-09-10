<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title><?= $this->e($title) ?></title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #dd3d36;
            color: #fff;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #5cb85c;
            color: #fff;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style>
</head>
<body>
<div class="brand clearfix">
    <h4 class="pull-left text-white" style="margin:20px 0px 0px 20px"><i class="fa fa-rocket"></i>&nbsp; Armentum</h4>
    <span class="menu-btn"><i class="fa fa-bars"></i></span>
    <ul class="ts-profile-nav">

        <li class="ts-account">
            <a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account <i class="fa fa-angle-down hidden-side"></i></a>
            <ul>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
<div class="ts-main-content">
    <nav class="ts-sidebar">
        <ul class="ts-sidebar-menu">

            <li class="ts-label">Main</li>
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li><a href="userlist.php"><i class="fa fa-users"></i> Userlist</a>
            </li>
            <li><a href="profile.php"><i class="fa fa-user"></i> &nbsp;Profile</a>
            </li>
            <li><a href="feedback.php"><i class="fa fa-envelope"></i> &nbsp;Feedback</a>
            </li>
            <li><a href="notification.php"><i class="fa fa-bell"></i> &nbsp;Notification <sup style="color:red">*</sup></a>
            </li>
            <li><a href="deleteduser.php"><i class="fa fa-user-times"></i> &nbsp;Deleted Users</a>
            </li>
            <li><a href="download.php"><i class="fa fa-download"></i> &nbsp;Download Users-List</a>
            </li>
        </ul>
        <p class="text-center" style="color:#ffffff; margin-top: 100px;">© Ajay</p>
    </nav>
    <div class="content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <?= $this->section('content') ?>
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
        setTimeout(function () {
            $('.succWrap').slideUp("slow");
        }, 3000);
    });
</script>
<?= $this->section('before_body_close') ?>
</body>
</html>