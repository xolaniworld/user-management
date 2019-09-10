<?php $this->layout('layouts/guest', ['title' => 'Login']) ?>
<div class="login-page bk-img">
    <div class="form-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="text-center text-bold mt-4x">Login</h1>
                    <div class="well row pt-2x pb-3x bk-light">
                        <div class="col-md-8 col-md-offset-2">
                            <form method="post">
                                <label for="" class="text-uppercase text-sm">Your Email</label>
                                <input type="text" placeholder="Username" name="username" class="form-control mb" required>

                                <label for="" class="text-uppercase text-sm">Password</label>
                                <input type="password" placeholder="Password" name="password" class="form-control mb" required>
                                <button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
                            </form>
                            <br>
                            <p>Don't Have an Account? <a href="register.php" >Signup</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->push('before_body_close') ?>
    <?php if ($redirect !== null) :?>
        <?php if ($redirect === true) :?>
            <script type='text/javascript'> document.location = 'profile.php'; </script>
        <?php else: ?>
            <script> alert('Invalid Details Or Account Not Confirmed');</script>
        <?php endif; ?>
    <?php endif; ?>
<?php $this->end() ?>
