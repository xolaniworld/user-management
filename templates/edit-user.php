<?php $this->layout('layouts/admin', [
    'title' => 'Edit User'
]) ?>

<h3 class="page-title">Edit User : <?= $this->e($result->name); ?></h3>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Edit Info</div>
            <?= $this->insert('partials/alerts'); ?>
            <div class="panel-body">
                <form method="post" class="form-horizontal" enctype="multipart/form-data" name="imgform">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Name<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="name" class="form-control" required value="<?= $this->e($result->name); ?>">
                        </div>
                        <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="email" name="email" class="form-control" required value="<?= $this->e($result->email); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Gender<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <select name="gender" class="form-control" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <label class="col-sm-2 control-label">Designation<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="text" name="designation" class="form-control" required value="<?= $this->e($result->designation); ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label">Image<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="file" name="image" class="form-control">
                        </div>

                        <label class="col-sm-2 control-label">Mobile No.<span style="color:red">*</span></label>
                        <div class="col-sm-4">
                            <input type="number" name="mobileno" class="form-control" required value="<?= $this->e($result->mobile); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <img src="../images/<?= $this->e($result->image); ?>" width="150px"/>
                            <input type="hidden" name="image" value="<?= $this->e($result->image); ?>">
                            <input type="hidden" name="idedit" value="<?= $this->e($result->id); ?>">
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