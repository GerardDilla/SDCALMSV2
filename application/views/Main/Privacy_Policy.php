<script>
$(document).ready(function() {

    open_verification_modal();

});
</script>
<!-- Email Verification Modal -->
<div id="privacy_policy_agreement" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">

                Privacy Policy Agreement
                <span class="searchloader">
                    <img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
                </span>

            </h2>

        </header>
        <div class="panel-body">
            <div class="modal-wrapper">

                <div class="modal-text">
                
                    <div id="PolicyContainer" style="overflow-y: scroll; max-height:300px; padding: 15px 0px 15px 0px; color:#000">
                        <p>
                            I <u><strong><?php echo $this->student_data['Full_Name']; ?></strong></u> of legal age, hereby voluntarily and knowingly authorize St. Dominic College of Asia to collect, process or release my personal and sensitive information that may be used for internal and external school official and legal transactions.
                            I agree on the following conditions:
                        </p>
                        <ol>
                            <li>Personal Information will be released unless written notice of revocation is received by the Data Privacy Office of St. Dominic College of Asia.</li>
                            <li>Personal information may be released for school official and legal purposes only.</li>
                            <li>Sensitive information will be kept confidential unless the school deemed it necessary to release on valid and legal purposes only. </li>
                            <li>Updating and modifying of incorrect, inaccurate or incomplete personal information will be done upon submission of letter of request to St. Dominic College of Asia.</li>
                            <li>St. Dominic College of Asia and its officials and employees are not held liable for the collection and release of any information that I voluntarily provided.</li>
                        </ol>
                        <p>
                        I have read this form, understood its contents and consent to the collecting, processing and releasing of my personal data. I understand that my consent does not preclude the existence of other criteria for lawful processing of personal data, and does not waive any of my rights under the Data Privacy Act of 2012 and other applicable laws.
                        </p>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input id="agree" type="checkbox" value="1">
                            I agree to the terms and conditions.
                        </label>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input id="parent_agree" type="checkbox" value="1">
                            I allow my Parents / Guardian to access my information.
                        </label>
                    </div>
                    <hr>
                    <h4 style="color:green" id="policy_message"></h4>

                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">

                    <a href="<?php echo base_url(); ?>index.php/Main/logout" class="btn btn-default">Logout</a>
                    <button class="btn btn-success" onclick="Init_privacypolicy_agree()">Proceed</button>

                </div>
            </div>
        </footer>
    </section>
</div>
<!-- End Modal -->

<script>
function open_verification_modal(){

    $.magnificPopup.open({

        items: {
            src: '#privacy_policy_agreement'
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

function Init_privacypolicy_agree(agree = '', parent_agree = ''){

    if($('#agree').is(":checked")){
        agree = 1;
    }
    if($('#parent_agree').is(":checked")){
        parent_agree = 1;
    }

    $.ajax( {
        url: '<?php echo base_url(); ?>index.php/PrivacyPolicy',
        type: 'GET',
        data: { 
            Reference_Number: '<?php echo $this->student_data['Reference_Number']; ?>',
            agree: agree,
            parent_agree: parent_agree
        },
        success: function(response){

            result = JSON.parse(response);

            if(result['Error'] != ''){

                $('#policy_message').html(result['Error']);

            }
            else if(result['Success'] == 1){


                $('#policy_message').html(result['Message']);
                $('.inner-wrapper').css({'filter':'blur(0px)'});
                $('.header').css({'filter':'blur(0px)'});
                $.magnificPopup.proto.close.call('#privacy_policy_agreement');
             

            }
 

        },
        fail: function(){

            alert('Error: request failed');
            return;

        }

    });

}

</script>