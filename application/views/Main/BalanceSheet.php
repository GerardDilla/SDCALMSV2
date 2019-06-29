
<section role="main" class="content-body">
    <header class="page-header">
        <h2><i class="fa fa-tasks"></i> YOUR BALANCE</h2>
    
        <div class="right-wrapper pull-right">
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
        <input type="hidden" name="SYlegend" id="SYlegend" value="2016-2017"> 
        <input type="hidden" name="Semlegend" id="Semlegend" value="FIRST"> 
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

                </header>
            </section>

        </div>

    </div>
  
</section>

<!-- Grading API Handler -->
<script>
$(document).ready(function() {
    Init_BalanceAPI('<?php echo base_url(); ?>index.php/API/BalanceAPI','<?php echo $this->student_data['Reference_Number']; ?>');
});
</script>
<!-- Grading API Handler -->





 
