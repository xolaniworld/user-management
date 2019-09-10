<?php $this->layout('layouts/admin', ['title' => 'Edit Admin']); ?>

<h3 class="page-title">Manage Admin</h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Edit Info</div>
            <?= $this->insert('partials/alerts'); ?>
            <div class="panel-body">
                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="name" class="form-control" required value="<?= $this->e($result->username); ?>">
                        </div>
                        <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="email" name="email" class="form-control" required value="<?= $this->e($result->email); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-primary" name="submit" type="submit">Save
                                Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
