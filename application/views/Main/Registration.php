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
                    <label>SDCA Email</label>
                    <div class="input-group input-group-icon">
                        <input name="student_id" type="text" class="form-control input-lg" placeholder="Ex: johndoe@sdca.edu.ph" />
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

                <div class="form-group mb-lg">
                    <div class="clearfix">
                        <label class="pull-left">Retype Password</label>
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
                    <div class="col-md-12">
                        <div style="text-align: center;">
                        <form action="?" method="POST">
                            <div class="g-recaptcha" data-sitekey="6LdiwqwUAAAAAC2PAa16nKnU_a5KUDcK-zl0hb29" style="display: inline-block;"></div>
                            <br/>
                            <input type="submit" value="Submit">
                        </form>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <button type="submit" name="login_submit" value="1" class="btn btn-primary hidden-xs">Sign In</button>
                        <button type="submit" name="login_submit" value="1" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    
</div>