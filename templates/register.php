<?php $this->layout('layouts/guest', ['title' => 'Register']) ?>
    <div class="login-page bk-img">
        <div class="form-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center text-bold mt-2x">Register</h1>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif ?>
                        <div class="hr-dashed"></div>
                        <div class="well row pt-2x pb-3x bk-light text-center">
                            <form method="post" class="form-horizontal" enctype="multipart/form-data" name="regform" onSubmit="return validate();">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Name<span style="color:red">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <label class="col-sm-1 control-label">Email<span style="color:red">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" name="email" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Password<span style="color:red">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="password" name="password" class="form-control" id="password" required>
                                    </div>

                                    <label class="col-sm-1 control-label">Designation<span style="color:red">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="text" name="designation" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Gender<span style="color:red">*</span></label>
                                    <div class="col-sm-5">
                                        <select name="gender" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <label class="col-sm-1 control-label">Phone<span style="color:red">*</span></label>
                                    <div class="col-sm-5">
                                        <input type="number" name="mobileno" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-1 control-label">Avtar<span style="color:red">*</span></label>
                                    <div class="col-sm-5">
                                        <div><input type="file" name="image" class="form-control"></div>
                                    </div>
                                </div>

                                <br>
                                <button class="btn btn-primary" name="submit" type="submit">Register</button>
                            </form>
                            <br>
                            <br>
                            <p>Already Have Account? <a href="index.php">Signin</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->push('before_body_close') ?>
    <script type="text/javascript">
        function validate() {
            var extensions = new Array("jpg", "jpeg");
            var image_file = document.regform.image.value;
            var image_length = document.regform.image.value.length;
            var pos = image_file.lastIndexOf('.') + 1;
            var ext = image_file.substring(pos, image_length);
            var final_ext = ext.toLowerCase();
            for (i = 0; i < extensions.length; i++) {
                if (extensions[i] == final_ext) {
                    return true;

                }
            }
            alert("Image Extension Not Valid (Use Jpg,jpeg)");
            return false;
        }

    </script>
<?php $this->end() ?>