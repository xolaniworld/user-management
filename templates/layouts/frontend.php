<?php $this->layout('layouts/guest', ['title' => $title]) ?>

<div class="brand clearfix">
    <h4 class="pull-left text-white text-uppercase" style="margin:20px 0px 0px 20px">
        <i class="fa fa-user"></i>&nbsp; <?= $this->e($alogin) ?>
    </h4>
    <span class="menu-btn"><i class="fa fa-bars"></i></span>
    <ul class="ts-profile-nav">
        <li class="ts-account">
            <a href="#"><img src="/img/ts-avatar.jpg" class="ts-avatar hidden-side" alt=""> Account
                <i class="fa fa-angle-down hidden-side"></i></a>
            <ul>
                <li><a href="/change-password">Change Password</a></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </li>
    </ul>
</div>

<div class="ts-main-content">
    <nav class="ts-sidebar">
        <ul class="ts-sidebar-menu">
            <li class="ts-label">Main</li>
            <li><a href="/profile"><i class="fa fa-user"></i> &nbsp;Profile</a>
            </li>
            <li><a href="/feedback"><i class="fa fa-envelope"></i> &nbsp;Feedback</a>
            </li>
            <li><a href="/notification"><i class="fa fa-bell"></i> &nbsp;Notification<sup style="color:red">*</sup></a>
            </li>
            <li><a href="/messages"><i class="fa fa-envelope"></i> &nbsp;Messages</a>
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

<?php $this->push('before_body_close') ?>
<script type="text/javascript">
    $(document).ready(function () {
        setTimeout(function() {
            $('.succWrap').slideUp("slow");
        }, 3000);
    });
</script>
<?php $this->end() ?>

