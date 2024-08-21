<?php $this->layout('layouts/admin', [
    'title' => 'Deleted Users'
]) ?>

<h2 class="page-title">Deleted Users</h2>

<!-- Zero Configuration Table -->
<div class="panel panel-default">
    <div class="panel-heading">List Users</div>
    <div class="panel-body">
        <?= $this->insert('partials/alerts_mgshow') ?>
        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Delete Time</th>
            </tr>
            </thead>

            <tbody>
            <?php if($count > 0) : ?>
                <?php foreach($results as $result): ?>
                    <tr>
                        <td><?= $this->e($cnt);?></td>
                        <td><?= $this->e($result->email);?></td>
                        <td><?= $this->e($result->deltime);?></td>
                    </tr>
                    <?php $cnt++; ?>
                <?php endforeach;?>
            <?php endif;?>
            </tbody>
        </table>
    </div>
</div>
