<div class="center-sign">
    
    <a href="/" class="logo pull-left">
        <img src="<?php echo base_url(); ?>assets/images/logo-default.png" height="54" alt="Porto Admin" />
    </a>

    <div class="panel panel-sign">
        <div class="panel-title-sign mt-xl text-right">
            <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
        </div>
        <div class="panel-body">
            <?php if($this->session->flashdata('message')): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong><?php echo $this->session->flashdata('message'); ?></strong>
                </div>
                <hr>
            <?php endIf; ?>
            
            <form action="<?php echo base_url(); ?>index.php/Main/Login" method="post">
                <div class="form-group mb-lg">
                    <label>Student Number</label>
                    <div class="input-group input-group-icon">
                        <input name="student_id" type="text" class="form-control input-lg" placeholder="Student Number" />
                        <span class="input-group-addon">
                            <span class="icon icon-lg">
                                <i class="fa fa-user"></i>
                            </span>
                        </span>
                    </div>
                </div>

                <div class="form-group mb-lg">
                    <div class="clearfix">
                        <label class="pull-left">Password</label>
                        <a href="pages-recover-password.html" class="pull-right">Lost Password?</a>
                    </div>
                    <div class="input-group input-group-icon">
                        <input name="student_password" type="password" class="form-control input-lg" placeholder="Password"/>
                        <span class="input-group-addon">
                            <span class="icon icon-lg">
                                <i class="fa fa-lock"></i>
                            </span>
                        </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="checkbox-custom checkbox-default">
                            <input id="RememberMe" name="rememberme" type="checkbox"/>
                            <label for="RememberMe">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <button type="submit" name="login_submit" value="1" class="btn btn-primary hidden-xs">Sign In</button>
                        <button type="submit" name="login_submit" value="1" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
                    </div>
                </div>

                <span class="mt-lg mb-lg line-thru text-center text-uppercase">
                    <span>or</span>
                </span>

                <div class="mb-xs text-center">
                    <a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
                    <a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
                </div>

                <p class="text-center">Don't have an account yet? <a href="pages-signup.html">Sign Up!</a>

            </form>
        </div>
    </div>

    <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
</div>