<?php $this->layout('layouts/admin', [
    'title' => 'Notifications'
]); ?>
<h3 class="page-title">Notifications</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Notification</div>
            <div class="panel-body">
                <?php
                if ($count > 0) {
                    foreach ($results as $result) { ?>
                        <h5 style="background:#ededed;padding:20px;">
                            <i class="fa fa-bell text-primary"></i>&nbsp;&nbsp;<b class="text-primary"><?= $this->e($result->time); ?></b>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $this->e($result->notification_user); ?>
                            -----> <?= $this->e($result->notification_type); ?></h5>
                        <?php $cnt++;
                    }
                } ?>
            </div>
        </div>
    </div>
</div>