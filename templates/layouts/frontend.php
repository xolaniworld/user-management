<?php $this->layout('layouts/frontend', ['title' => 'User Profile']) ?>
<?php $this->start('accountactions') ?>
<div class="brand clearfix">
    <h4 class="pull-left text-white text-uppercase" style="margin:20px 0px 0px 20px">
        <?php /*<i class="fa fa-user"></i>&nbsp; <?= isset($_SESSION['alogin']) ? htmlentities($_SESSION['alogin']) : ''; */ ?>
        <i class="fa fa-user"></i>&nbsp; <?= $this->e($alogin) ?>
    </h4>
    <span class="menu-btn"><i class="fa fa-bars"></i></span>
    <ul class="ts-profile-nav">
        <li class="ts-account">
            <a href="#"><img src="/img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account
                <i class="fa fa-angle-down hidden-side"></i></a>
            <ul>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
<?php $this->stop() ?>
