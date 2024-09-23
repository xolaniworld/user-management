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
                                <label for="username" class="text-uppercase text-sm">Your Email</label>
                                <input type="text" id="username" placeholder="Username" name="username" class="form-control mb" required>

                                <label for="password" class="text-uppercase text-sm">Password</label>
                                <input type="password" id="password" placeholder="Password" name="password" class="form-control mb" required>
                                <button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
                            </form>
                            <br>
                            <p>Don't Have an Account? <a href="/register" >Signup</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
