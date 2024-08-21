<?php $this->layout('layouts/frontend', [
    'title' => 'Messages',
    'alogin' => $alogin
]) ?>

<h2 class="page-title">Messages</h2>
<!-- Zero Configuration Table -->
<div class="panel panel-default">
    <div class="panel-heading">List Users</div>
    <div class="panel-body">
        <?= $this->insert('partials/alerts') ?>
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
            $cnt = 1;
            if ($count > 0) : ?>
                <?php foreach ($results as $result) : ?>
                    <tr>
                        <td><?php echo htmlentities($cnt); ?></td>
                        <td><?php echo htmlentities($result->sender); ?></td>
                        <td><?php echo htmlentities($result->feedbackdata); ?></td>
                    </tr>
                    <?php $cnt++;
                endforeach;
            endif; ?>
            </tbody>
        </table>
    </div>
</div>