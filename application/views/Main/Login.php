<div class="center-sign">

    <a href="/" class="logo pull-left">
        <img src="<?php echo base_url(); ?>assets/images/Logo_white.png" height="54" alt="Porto Admin" />
    </a>

    <div class="panel panel-sign">
        <div class="panel-title-sign mt-xl text-right">
            <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
        </div>
        <div class="panel-body"style="padding:0px">
            <div class="tabs tabs-primary" style="margin-bottom:0px">
                <div class="tab-content">
                    <div id="student_tab" class="tab-pane <?php echo $this->session->flashdata('instructor_message') == '' ? 'active' : '' ?>" style="padding:33px; padding-bottom:0px">

                        <?php if($this->session->flashdata('message')): ?>
                            <div class="alert alert-info" style="color:#ff0000">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong><?php echo $this->session->flashdata('message'); ?></strong>
                            </div>
                            <hr>
                        <?php endIf; ?>
                        <!-- Student Login Form -->
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
                                <a class="btn btn-danger mb-md ml-xs mr-xs">Connect with <i class="fa fa-google"></i>oogle account</a>
                            </div>
                            

                            <p class="text-center">Don't have an account yet? <a href="<?php echo site_url('Registration'); ?>">Activate your account!</a>

                        </form>
                        <!-- /Student Login Form -->

                    </div>
                    <div id="teacher_tab" class="tab-pane <?php echo $this->session->flashdata('instructor_message') != '' ? 'active' : '' ?>" style="padding:33px">

                        <?php if($this->session->flashdata('instructor_message')): ?>
                            <div class="alert alert-info" style="color:#ff0000">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong><?php echo $this->session->flashdata('instructor_message'); ?></strong>
                            </div>
                            <hr>
                        <?php endIf; ?>

                        <!-- Instructor Login Form -->
                        <form action="<?php echo base_url(); ?>index.php/Main/Instructor_login" method="post">
                            <div class="form-group mb-lg">
                                <label>Instructor ID</label>
                                <div class="input-group input-group-icon">
                                    <input name="instructor_id" type="text" class="form-control input-lg" placeholder="Instructor ID" />
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
                                    <a href="pages-recover-password.html" class="pull-right">Forgot Password?</a>
                                </div>
                                <div class="input-group input-group-icon">
                                    <input name="passkey" type="password" class="form-control input-lg" placeholder="Password"/>
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
                                    <button type="submit" name="login_submit_instructor" value="1" class="btn btn-primary hidden-xs">Sign In</button>
                                    <button type="submit" name="login_submit_instructor" value="1" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
                                </div>
                            </div>


                        </form>
                        <!-- /Instructor Login Form -->

                    </div>
                    <hr>
                    <p class="text-center"><u>Choose login type below</u></p>
                </div>
                <ul class="nav nav-tabs nav-justified">
                    <li class="<?php echo $this->session->flashdata('instructor_message') == '' ? 'active' : '' ?>">
                        <a href="#student_tab" data-toggle="tab" class="text-center"><i class="fa fa-graduation-cap"></i> Student</a>
                    </li>
                    <li class="<?php echo $this->session->flashdata('instructor_message') != '' ? 'active' : '' ?>">
                        <a href="#teacher_tab" data-toggle="tab" class="text-center"><i class="fa fa-group"></i>Teacher</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    
</div>