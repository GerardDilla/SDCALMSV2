<section role="main" class="content-body" data-base_url='<?php echo base_url(); ?>'>
		<header class="page-header">
			<h2>Assessments <i class="fa fa-home"></i></h2>
		
			<div class="right-wrapper pull-right" style="padding-right:20px">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>Pages</span></li>
					<li><span>User Profile</span>
					</li>
				</ol>
			</div>
		</header>
		<div id="particles-js"></div>
		<!-- start: page -->

		<div class="row">
			<div class="col-md-12" style="background-color: rgba(255,255,255, 0.7); color: ccc;  font-weight: bold; z-index: 2; padding: 20px; padding-top: 100px; padding-bottom: 100px; text-align: center;">
				<div class="row">
					<div class="col-md-3">
						<h1 style="font-size:650%">
							<div class="panel-heading-icon bg-primary mt-sm">
								<i class="fa fa-pencil"></i>
							</div>
						</h1>
					</div>
					<div class="col-md-9" style="text-align:left">

						<?php if($this->session->flashdata('message')): ?>
							<div class="well warning">
								<h3><?php echo $this->session->flashdata('message'); ?></h3>
							</div>
						<?php endIf; ?>


						<?php if($this->data['Assessment_Data']): ?>
							<h2 style="text-transform:uppercase">
								<?php echo $this->data['Assessment_Data'][0]['AssessmentName']; ?>
							</h2>
								<p>BY: <?php echo $this->data['Assessment_Data'][0]['Instructor_Name']; ?></p>
							<hr>
								<p style="font-weight: normal;"><?php echo $this->data['Assessment_Data'][0]['Description']; ?></p>
							<hr>
							<h4 style="text-transform:uppercase">
								<b>Details</b>
							</h4>
							<table cellpadding="100" style="font-size:15px; font-weight: normal;">
								<tr>
									<td>Start Time:</td>
									<td><u> <?php echo $this->data['Assessment_Data'][0]['StartDate']; ?></span></u></td>
								</tr>
								<tr>
									<td>End Time:</td>
									<td><u> <?php echo $this->data['Assessment_Data'][0]['EndDate']; ?></span></u></td>
								</tr>
								<tr>
									<td>Time Limit:</td>
									<td><u> <?php echo $this->data['Assessment_Data'][0]['Timelimit']; ?> Minutes</span></u></td>
								</tr>
							</table>
							<br><br>
							<form action="<?php echo base_url(); ?>index.php/Assessment/ExamStart" method="POST">

								<button class="btn btn-lg btn-default" name="AssessmentCode" value="<?php echo $this->data['Assessment_Data'][0]['AssessmentCode']; ?>">Take Exam <i class="fa fa-play"></i></button>
								<button class="btn btn-lg btn-info" name="AssessmentCode" value="<?php echo $this->data['Assessment_Data'][0]['AssessmentCode']; ?>">Review Results <i class="fa fa-book"></i></button>

							</form>
						<?php else: ?>
							<h1>Invalid Assessment Code</h1>
						<?php endIf; ?>
					</div>
				</div>
			</div>
		</div>

		<!-- end: page -->
	</section>


</div>