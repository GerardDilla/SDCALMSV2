<div class="center-sign">
    
    <a href="/" class="logo pull-left">
        <img src="<?php echo base_url(); ?>assets/images/logo-default.png" height="54" alt="Porto Admin" />
    </a>

    <div class="panel panel-sign">
        <div class="panel-title-sign mt-xl text-right">
            <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Verification</h2>
        </div>
        <div class="panel-body">
            <?php if($this->session->flashdata('message')): ?>
                <div class="alert alert-info">
                    
                    <strong><?php echo $this->session->flashdata('message'); ?></strong>
                </div>
                <hr>
            <?php endIf; ?>
            
        </div>
    </div>

</div>
