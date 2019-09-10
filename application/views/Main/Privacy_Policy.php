<script>
$(document).ready(function() {

    open_verification_modal();

});
</script>



<!-- Modal -->
<div id="PrivacyPolicyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Privacy Policy Agreement</h4>
                <span class="searchloader">
                    <img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
                </span>
            </div>
            <div class="modal-body" style="padding-bottom:5px;">
                <div id="PolicyContainer" style="overflow-y: scroll; max-height:300px; padding: 15px 0px 5px 0px; color:#000">
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
            </div>
            <div class="modal-footer" style="margin-top:0px;">
            <h4 style="color:green" id="policy_message"></h4>
                <div class="row">
                    <div class="col-md-12 text-right">

                        <a href="<?php echo base_url(); ?>index.php/Main/logout" class="btn btn-default">Logout</a>
                        <button class="btn btn-success" onclick="Init_privacypolicy_agree()">Proceed</button>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function open_verification_modal(){

    $('.inner-wrapper').css({'filter':'blur(4px)'});
    $('.header').css({'filter':'blur(4px)'});
    $('#PrivacyPolicyModal').modal('show');

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
                
                
                $('#PrivacyPolicyModal').modal('hide');
             

            }
 

        },
        fail: function(){

            alert('Error: request failed');
            return;

        }

    });

}

</script>