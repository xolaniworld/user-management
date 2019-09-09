<?php $this->layout('layouts/frontend', [
        'title' => 'Edit Profile',
        'alogin' => $alogin
]) ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><?= $this->e($alogin) ?></div>
            <?= $this->insert('partials/alerts') ?>
            <div class="panel-body">
                <form method="post" class="form-horizontal" enctype="multipart/form-data">

                    <div class="form-group">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4 text-center">
                            <img src="images/<?= $this->e($result->image) ?>" style="width:200px; border-radius:50%; margin:10px;">
                            <input type="file" name="image" class="form-control">
                            <input type="hidden" name="image" class="form-control" value="<?= $this->e($result->image) ?>">
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="name" class="form-control" required value="<?= $this->e($result->name);?>">
                        </div>

                        <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="email" name="email" class="form-control" required value="<?= $this->e($result->email);?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="mobileno" class="form-control" required value="<?= $this->e($result->mobile);?>">
                        </div>
                        <label class="col-sm-2 control-label">Designation<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="designation" class="form-control" required value="<?= $this->e($result->designation);?>">
                        </div>
                    </div>
                    <input type="hidden" name="idedit" class="form-control" required value="<?= $this->e($result->id);?>">

                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>