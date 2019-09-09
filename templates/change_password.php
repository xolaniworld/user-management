<?php $this->layout('layouts/frontend', [
    'title' => 'User Change Password',
    'alogin' => $alogin
]) ?>
<h2 class="page-title">Change Password</h2>

<div class="row">
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">Form fields</div>
            <div class="panel-body">
                <form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
                    <?= $this->insert('partials/alerts', ['msg' => $msg, 'error' => $error]) ?>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Current Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="hr-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">New Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                        </div>
                    </div>
                    <div class="hr-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Confirm Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
                        </div>
                    </div>
                    <div class="hr-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-4">

                            <button class="btn btn-primary" name="submit" type="submit">Save changes</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>