<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href='<?= base_url('assets/vendor/fullcalendar-5.11.3/lib/main.css') ?>' rel='stylesheet' />
<script src='<?= base_url('assets/vendor/fullcalendar-5.11.3/lib/main.js') ?>'></script>
<style>
	.fc-today-button.fc-button.fc-button-primary{
		display:none;
	}
	.fc-prev-button.fc-button.fc-button-primary{
		display:none;
	}
	.fc-next-button.fc-button.fc-button-primary{
		display:none;
	}
	/* .fc-toolbar-chunk{
		display:none;
	} */
</style>
<input type="hidden" id="base_url" value="<?= base_url(); ?>">
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Dashboard</h2>
					
			<div class="right-wrapper pull-right" style="padding-right:20px">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
						   <i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Dashboard</span></li>
				</ol>
			</div>
	</header>
	<div id="particles-js"></div>
            <!-- start: page -->
                   <div class="row">
                       <div class="col-md-7">
                            <section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title red-bold" >  <i class="fa fa-graduation-cap black"  aria-hidden="true"></i> Academic Info</h2>	
								</header>
								<div class="panel-body">
									 <div class="col-md-5">
										<div id="userbox" class="userbox">
												<a href="#" data-toggle="dropdown">
													<figure class="profile-picture">
														<img src="<?php echo base_url(); ?>personaldata/Profilepicture/default.png" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
													</figure>
													<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
														<span class="name"><?php echo $this->user_data['Full_Name']; ?></span>
														<span class="name"><?php echo $this->user_data['Student_Number']; ?></span>
													</div>
												</a>
										</div>
									 </div>
									 <div class="col-md-4">
									   <!-- Inputs for Sched -->
										<input type="hidden" value="<?php echo '2012-2013' ?>" id="Sched_sy">
										<input type="hidden" value="<?php echo 'SECOND'; ?>" id="Sched_sem">
									   <!-- Inputs for Balance -->
										<input type="hidden" value="<?php echo $this->legends['School_Year']; ?>" id="SYlegend">
										<input type="hidden" value="<?php echo $this->legends['Semester']; ?>" id="Semlegend">
									   <p>Academic Year:<span class="red-bold"> <?php echo $this->legends['School_Year']; ?></span></p>
									   <p class="acad-semester">Semester:     <span  class="red-bold"> <?php echo $this->legends['Semester']; ?></span></p>
									 </div>
									 <div class="col-md-3">
									 </div>
								</div>
                            </section>
                            
                            <section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title blue">  <i class="fa  fa-list-alt black"  aria-hidden="true"></i> Classes</h2>
									<span class="searchloader">
										<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
									</span>
								</header>
								<div class="panel-body">
								        <div class="table-responsive" id="Schedule_dash">
											<table class="table table-bordered mb-none" id="schedule_main">
												<thead>
													<tr>
														<th>Course Title</th>
														<th>Day</th>
														<th>Time</th>						
													</tr>
												</thead>
												<tbody id="Schedule_dash_table">
												
												</tbody>
											</table>
										</div>
								</div>
							</section>

							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title green">  <i class="fa fa-money black"  aria-hidden="true"></i> Balance</h2>
									<span class="searchloader">
										<img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
									</span>
								</header>
								<div class="panel-body">
								        <div class="table-responsive">
											<table class="table table-bordered mb-none">
												<thead>
													<tr>
													    <th></th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="sem-balance">Semestral Balance</td>
														<td class="balance-amount" id="dash_sem-balance">0.00</td>
													</tr>
													<tr>
													   <td class="outstanding-balance">PREVIOUS BALANCE :</td>
														<td class="balance-amount" id="dash_oustanding-balance">0.00</td>
													</tr>
												</tbody>
											</table>
										</div>
								</div>
							</section>

                        </div>
                     <div class="col-md-5">
						<section class="panel">
							<div class="panel-body">
							<h3>Events</h3>
							<hr>
							<div align="center" class="calendar-title">

							</div>
							
							<div align="right">
								<select name="filterDayType" id="filterDayType">
									<option value="dayGridMonth">Month</option>
									<option value="dayGridWeek">Day</option>
									<option value="timeGridWeek">Time</option>
								</select>
							</div>
							<br>
							<div align="right"><button class="btn btn-dark btn-sm">Today</button>&nbsp;<button class="btn btn-info btn-sm">Prev</button>&nbsp;<button class="btn btn-info btn-sm">Next</button></div>
							<div id="calendar"></div>
							</div>
						</section>
                     </div>
                </div>
			<!-- end: page -->
</section>    

<!-- Balance API Handler -->
<script>
$(document).ready(function() {
    DashboardStart('<?php echo base_url(); ?>','<?php echo $this->user_data['Reference_Number']; ?>','<?php echo $this->legends['School_Year']; ?>','<?php echo $this->legends['Semester']; ?>');
	
});

</script>
<script src='<?= base_url('assets/javascripts/dashboard_calendar.js') ?>' defer></script>
<!-- Balance API Handler -->
