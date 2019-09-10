<?php $this->layout('layouts/admin', ['title' => 'Edit Admin']); ?>

<h2>Reply Feedback</h2>
<div class="panel panel-default">
    <div class="panel-heading">Edit Info</div>
    <?= $this->insert('partials/alerts') ?>
    <div class="panel-body">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">

            <div class="form-group">
                <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
                <div class="col-sm-4">
                    <input type="text" name="email" class="form-control" readonly required value="<?php echo htmlentities($replyto); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Message<span style="color:red">*</span></label>
                <div class="col-sm-6">
                    <textarea name="message" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </div>

            <input type="hidden" name="editid" class="form-control" required value="<?php echo htmlentities($result->id); ?>">

            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <button class="btn btn-primary" name="submit" type="submit">Send
                        Reply
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
