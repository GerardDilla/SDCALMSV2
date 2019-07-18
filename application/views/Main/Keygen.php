<div class="center-sign">
    
    <a href="/" class="logo pull-left">
        <img src="<?php echo base_url(); ?>assets/images/logo-default.png" height="54" alt="Porto Admin" />
    </a>

    <div class="panel panel-sign">
        <div class="panel-title-sign mt-xl text-right">
            <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Account Key Generator</h2>
        </div>
        <div class="panel-body">
            <?php if($this->session->flashdata('message')): ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong><?php echo $this->session->flashdata('message'); ?></strong>
                </div>
                <hr>
            <?php endIf; ?>
            
            <form action="" method="POST">

                <div class="form-group mb-lg">
                    <label>Student Number</label>
                    <div class="input-group input-group-icon">
                        <input name="student_id" type="text" class="form-control input-lg" value="<?php echo $this->session->flashdata('prev_student_id'); ?>" placeholder="Student Number" />
                        <span class="input-group-addon">
                            <span class="icon icon-lg">
                                <i class="fa fa-user"></i>
                            </span>
                        </span>
                    </div>
                    <br>
                    <div class="checkbox-custom checkbox-default">
                        <input type="checkbox" id="checkboxExample1" name="bypass_enrolled" value="1">
                        <label for="checkboxExample1">Allow even if not enrolled in current semester <br>(Must have enrolled at least once)</label>
                    </div>
                </div>
                

                <div class="form-group mb-lg">
                    <hr>
                    <h4>Activation Code: <u><b><?php echo $this->session->flashdata('Activation_Code'); ?></b></u></h4>
                    <hr>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div style="text-align: right;">
                        
                            <button type="submit" name="keygen_submit" style="background:#00cc00; border:0px; color:#000" value="1" class="btn btn-primary btn-md">GENERATE</button>

                        </div>
                    </div>
                </div>
                

            </form>
        </div>
    </div>

</div>
