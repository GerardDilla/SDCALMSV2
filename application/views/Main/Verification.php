<script>
$(document).ready(function() {

    verify_check = Check_if_emailverified();
    verify_check.success(function(status){

        result = JSON.parse(status);

        if(result['resultcount'] != 1){

            open_verification_modal();

        }

    });
    
});
</script>
<!-- Email Verification Modal -->
<div id="emailverification" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">

                Email Verification
                <span class="searchloader">
                    <img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
                </span>

            </h2>

        </header>
        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fa fa-envelope-o"></i>
                </div>
                <div class="modal-text">
                <h4>Welcome, <?php echo $this->student_data['First_Name']; ?>!</h4>

                <?php if($this->student_data['ViaRegistration'] == 0): ?>

                    <br>
                    <p>You're one step away from accessing your Student Portal!<br>
                    We just need you to verify your email address.</p>

                    <p>To do so, type your Email Address on the field below and press 'Send'.
                    
                    <br>We will send you a link to your email that will activate your account.
                    
                    <br><br>You can refresh this page after you've clicked the link.</p>

                    <hr>

                    <span id="verification_message" style="color:green"></span>

                    <div id="verification_panel">
                        <div class="input-group input-group-icon">
                            <input type="text" class="form-control" id="emailverify" value="<?php echo $this->student_data['Email']; ?>">
                            
                            <span class="input-group-addon">
                                <span class="icon"><i class="fa fa-envelope-o"></i></span>
                            </span>
                        </div>

                        <br>

                        <div class="g-recaptcha" data-sitekey="6LdiwqwUAAAAAC2PAa16nKnU_a5KUDcK-zl0hb29" style="display: inline-block;"></div>
                    </div>

                    
                <?php elseif($this->student_data['ViaRegistration'] == 1): ?>

                    
                    <br>
                        <p>You're one step away from accessing your Student Portal!<br>
                        We just need you to verify your email address.</p>
                  
                        <p>To do so, check your registered email address and look for the email we sent you.
                        That email will contain the link to activate your account
                        
                        <br><br>You can refresh this page after you've clicked the link.</p>

                        <hr>
                        
                        <h5>Registered Email: <?php echo $this->student_data['Email']; ?></h5>

                    <br>

                <?php else: ?>

                    <p>Already verified</p>

                <?php endIf; ?>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <a href="<?php echo base_url(); ?>index.php/Main/logout" class="btn btn-default">Logout</a>

                        <button class="btn btn-primary" onclick="refreshpage()">Refresh</button>

                    <?php if($this->student_data['ViaRegistration'] == 0): ?>

                        <button id="verify_button" class="btn btn-primary" onclick="INIT_mailer()">Send</button>
                        
                    <?php endIf; ?>
                </div>
            </div>
        </footer>
    </section>
</div>

<script>
function open_verification_modal(){

    $.magnificPopup.open({

        items: {
            src: '#emailverification'
        },
        type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom',
        modal: true,
        callbacks: {

            open: function() {
                $('.inner-wrapper').css({'filter':'blur(4px)'});
                $('.header').css({'filter':'blur(4px)'});
                $.magnificPopup.instance.close = function() {

                    $('.inner-wrapper').css({'filter':'blur(0px)'});
                    $('.header').css({'filter':'blur(0px)'});
                    // Call the original close method to close the popup
                    $.magnificPopup.proto.close.call(this);
                    
                };
            }
        }

    });

}
function refreshpage(){

    location.reload();
    
}
function Check_if_emailverified(){

    return $.ajax( {
        url: '<?php echo base_url(); ?>index.php/Registration/Email_Verification_check',
        type: 'GET',
        data: { Student_Number: '<?php echo $this->student_data['Student_Number']; ?>' },

    });

}
function INIT_mailer(){

    
    email = $('#emailverify').val();

    if(email == '' || email == null){

        $('#verification_message').html('You must provide an Email Address');
        return;
    }
    
    if(grecaptcha.getResponse() == ''){

        $('#verification_message').html('Please check Capcha before sending');
        return;

    }

    $('#emailverify').prop('disabled', true);
    $('#verify_button').prop('disabled', true);
    $('#g-recaptcha-response').prop('disabled', true);


    $.ajax( {
        url: '<?php echo base_url(); ?>index.php/Registration/Init_AjaxVerification',
        type: 'GET',
        data: { 
            Student_Number: '<?php echo $this->student_data['Student_Number']; ?>',
            Email: $('#emailverify').val(),
            g_recaptcha_response: $('#g-recaptcha-response').val()
        },
        success: function(response){

            result = JSON.parse(response);

            if(result['Error'] != ''){
                $('#verification_message').html(result['Error']);

                $('#emailverify').prop('disabled', false);
                $('#verify_button').prop('disabled', false);
                $('#g-recaptcha-response').prop('disabled', false);
            }
            else if(result['Success'] == 1){


                $('#verification_message').html('<h4>'+result['Message']+'</h4>');
                $('#verification_panel').html('');
                $('#verify_button').remove();

            }
            else{
                $('#verification_message').html(result);
            }

        },
        fail: function(){

            alert('Error: request failed');
            return;

        }

    });
    

}



</script>