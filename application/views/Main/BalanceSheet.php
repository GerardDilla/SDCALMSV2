
<section role="main" class="content-body">
    <header class="page-header">
        <h2><i class="fa fa-list-alt"></i>  BALANCE</h2>
    
        <div class="right-wrapper pull-right" style="padding-right:20px">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Grades</span></li>
            </ol>
            <a class="sidebar-right-toggle"></a>
            
        </div>
    </header>
    <div id="particles-js"></div>
    <div class="row">

        <!--Legends input -->
        <input type="hidden" name="SYlegend" id="SYlegend" value="<?php echo $this->legends['School_Year']; ?>"> 
        <input type="hidden" name="Semlegend" id="Semlegend" value="<?php echo $this->legends['Semester']; ?>"> 
        <!--Legends input -->

        <h3 class="message_box"></h3>

        <div class="col-md-12" style="padding:10px">
            <section class="panel shadowed-box">
                <header class="panel-heading">

                    <h2 class="panel-title">
                    <b>YOUR BALANCE AS OF</b>:
                        <hr>
                        <div class="row" style="font-size:120%">
                            <div class="col-md-6">
                            <h3> <span style="color:#009933"><b>SCHOOL YEAR</b></span>: <u><?php echo $this->legends['School_Year']; ?></u></h3>
                            <span class="separator"></span>
                            </div>
                            <div class="col-md-6">
                            <h3> <span style="color:#009933"><b>SEMESTER</b></span>: <u><?php echo $this->legends['Semester']; ?></u></h3>
                            </div>
                        </div>
                        <hr>
                    </h2>

                    <p class="panel-subtitle">
                    Your balance is displayed based on the current School year and Semester
                    </p>
                    <!--
                    <table class="table table-striped" id="balance_table">
                        <thead>
                            <tr>
                            <th></th>
                            <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr class="balance_upper">
                        <td>Total Assesment</td>
                        <td class="balance_upper_value" id="sem_balance"><b>0.00</b></td>
                        </tr>
                        <tr class="balance_upper">
                            <td>Payments</td>
                            <td class="balance_upper_value" id="sem_paid">0.00</td>
                        </tr>
                        <tr class="balance_lower">
                            <td>Semestral Balance :</td>
                            <td class="balance_lower_value" id="sem_total_balance">
                                    0.00  
                            </td>
                        </tr>
                        <tr class="balance_lower">
                            <td>Previous Balance :</td>
                            <td class="balance_lower_value" id="previous_balance">
                                    0.00
                            </td>
                        </tr>
                        <tr class="balance_lower">
                            <td>OUTSTANDING BALANCE :</td>
                            <td class="balance_lower_value" id="outstanding_balance">
                                    0.00
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    --> 

                    <table class="table table-striped" style="color:#666">
                        <thead>
                            <tr>
                            <th></th>
                            <th>Amount</th>
                            <th>Remaining</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td style="background-color:#55c2ac; color:#FFF;">Upon Registration</td>
                        <td style="font-weight: 700; color: #800; text-align:right;"  id="uponregistration"></td>
                        <td style="background-color:#ccc; font-weight: 700; color: #800; text-align:right;"  id="uponregistrationbalance"></td>
                        </tr>
                        <tr>
                        <td style="background-color:#55c2ac; color:#FFF;">Prelim</td>
                        <td style="font-weight: 700; color: #800; text-align:right;"  id="prelim"></td>
                        <td style="background-color:#ccc; font-weight: 700; color: #800; text-align:right;"  id="prelimbalance"></td>
                        </tr>
                        <tr>
                        <td style="background-color:#55c2ac; color:#FFF;">Midterm</td>
                        <td style="font-weight: 700; color: #800; text-align:right;"  id="midterm"></td>
                        <td style="background-color:#ccc; font-weight: 700; color: #800; text-align:right;"  id="midtermbalance"></td>
                        </tr>
                        <tr>
                        <td style="background-color:#55c2ac; color:#FFF;">Finals</td>
                        <td style="font-weight: 700; color: #800; text-align:right;"  id="finals"></td>
                        <td style="background-color:#ccc; font-weight: 700; color: #800; text-align:right;"  id="finalsbalance"></td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="table table-striped" style="color:#666">
                        <thead>
                            <tr>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td style="background-color:#16A085; color:#FFF;">Total Assesment</td>
                        <td style="font-weight: 700; color: #800; text-align:right;"  id="sem_balance"></td>
                        </tr>
                        <tr>
                            <td style="background-color:#16A085; color:#FFF;">Payments</td>
                            <td style="font-weight: 700; color: #800; text-align:right;"  id="sem_paid"></td>
                        </tr>
                        <tr>
                        <td style="background-color:#666; color:#FFF; text-align: center;">Semestral Balance :</td>
                        <td style="background-color:#666; color:#FFF; text-align:right; font-weight: 700;" id="sem_total_balance">

                        </td>
                        </tr>
                        <tr>
                        <td style="background-color:#666; color:#FFF; text-align: center;">Previous Balance :</td>
                        <td style="background-color:#666; color:#FFF; text-align:right; font-weight: 700;" id="previous_balance">

                        </td>
                        </tr>
                        <tr>
                        <td style="background-color:#666; color:#FFF; text-align: center;">OUTSTANDING BALANCE :</td>
                        <td style="background-color:#666; color:#FFF; text-align:right; font-weight: 700;" id="outstanding_balance">
                            
                        </td>
                        </tr>
                        </tbody>
                    </table>

                </header>
            </section>

        </div>

    </div>
  
</section>

<!-- Balance API Handler -->
<script>
$(document).ready(function() {
    Init_BalanceAPI('<?php echo base_url(); ?>index.php/API/BalanceAPI','<?php echo $this->user_data['Reference_Number']; ?>',$('#SYlegend').val(),$('#Semlegend').val());
});
</script>
<!-- Balance API Handler -->





 
