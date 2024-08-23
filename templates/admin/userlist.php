<?php $this->layout('layouts/admin', ['title' => 'Manage Users']); ?>


<h2 class="page-title">Manage Users</h2>

<!-- Zero Configuration Table -->
<div class="panel panel-default">
    <div class="panel-heading">List Users</div>
    <div class="panel-body">
        <?= $this->insert('partials/alerts_mgshow')?>
        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Designation</th>
                <th>Account</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

            <?php
            $cnt = 1;
            if ($rowCount > 0) {
                foreach ($results as $result) { ?>
                    <tr>
                        <td><?= $this->e((string)$cnt); ?></td>
                        <td>
                            <img src="<?= $this->e($result->image); ?>" style="width:50px; border-radius:50%;"/>
                        </td>
                        <td><?= $this->e($result->name); ?></td>
                        <td><?= $this->e($result->email); ?></td>
                        <td><?= $this->e($result->gender); ?></td>
                        <td><?= $this->e($result->mobile); ?></td>
                        <td><?= $this->e($result->designation); ?>
                        <td>

                            <?php if ($result->status == 1) {?>
                                <a href="userlist.php?confirm=<?= $this->e($result->id); ?>" onclick="return confirm('Do you really want to Un-Confirm the Account')">Confirmed
                                    <i class="fa fa-check-circle"></i></a>
                            <?php } else { ?>
                                <a href="userlist.php?unconfirm=<?= $this->e($result->id); ?>" onclick="return confirm('Do you really want to Confirm the Account')">Un-Confirmed
                                    <i class="fa fa-times-circle"></i></a>
                            <?php } ?>
                        </td>
                        </td>

                        <td>
                            <a href="edit-user.php?edit=<?php echo $result->id; ?>" onclick="return confirm('Do you want to Edit');">&nbsp;
                                <i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                            <a href="userlist.php?del=<?php echo $result->id; ?>&name=<?= $this->e($result->email); ?>" onclick="return confirm('Do you want to Delete');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
                        </td>
                    </tr>
                    <?php $cnt = $cnt + 1;
                }
            } ?>

            </tbody>
        </table>
    </div>
</div>
