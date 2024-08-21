<?php $this->layout('layouts/admin', [
    'title' => 'Manage Feedback'
]) ?>

<h2 class="page-title">Manage Feedback</h2>

<!-- Zero Configuration Table -->
<div class="panel panel-default">
    <div class="panel-heading">List Users</div>
    <div class="panel-body">
        <?= $this->insert('partials/alerts_mgshow', compact('msg')) ?>
        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>User Email</th>
                <th>Title</th>
                <th>Feedback</th>
                <th>Attachment</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            <?php if($count > 0) { ?>
                <?php foreach($results as $result) { ?>
                    <tr>
                        <td><?= $this->e($cnt);?></td>
                        <td><?= $this->e($result->sender);?></td>
                        <td><?= $this->e($result->title);?></td>
                        <td><?= $this->e($result->feedbackdata);?></td>
                        <td><a href="../attachment/<?= $this->e($result->attachment);?>" ><?= $this->e($result->attachment);?></a></td>
                        <td>
                            <a href="sendreply.php?reply=<?= $this->e($result->sender) ?>">&nbsp; <i class="fa fa-mail-reply"></i></a>&nbsp;&nbsp;
                        </td>
                    </tr>
                    <?php $cnt++; } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>