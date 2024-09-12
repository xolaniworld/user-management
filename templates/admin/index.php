<?php $this->layout('layouts/guest', ['title' => 'Admin Login']) ?>
<?php if ($redirect === true): ?>
    <script type='text/javascript'> document.location = '/admin/dashboard'; </script>
<?php elseif($redirect === false) : ?>
    <script> alert('Invalid Details');</script>
<?php endif; ?>
<div class="login-page bk-img" style="background-image: url(img/background.jpg);">
    <div class="form-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="text-center text-bold mt-4x">Admin Login</h1>
                    <div class="well row pt-2x pb-3x bk-light">
                        <div class="col-md-8 col-md-offset-2">
                            <form method="POST" action="/admin/login">

                                <label for="" class="text-uppercase text-sm">Your Username </label>
                                <input type="text" value="admin" placeholder="Username" name="username" class="form-control mb" required>

                                <label for="" class="text-uppercase text-sm">Password</label>
                                <input type="password" value="963852741" placeholder="Password" name="password" class="form-control mb" required>
                                <button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>