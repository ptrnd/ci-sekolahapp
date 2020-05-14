<div class="login-box">
    <div class="login-logo">
        <b>Admin</b>LTE
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <div class="alert alert-info" role="alert">
                <?php
                if (isset($pesan)) {
                    echo $pesan;
                } else {
                    echo "Masukkan username dan password anda.";
                }
                ?>
            </div>
            <?= form_open('login/proses_login'); ?>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="user" class="form-control" placeholder="Username" value="<?php echo set_value('user'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="pass" class="form-control" placeholder="Password" value="<?php echo set_value('pass'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <?= form_close(); ?>
            <!-- <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p> -->
            <p class="mb-0">
                <a href="<?= base_url() ?>login/register" class="text-center">Register a new membership</a>
            </p>


        </div>
        <!-- /.login-card-body -->
    </div>

</div>
<!-- /.login-box -->