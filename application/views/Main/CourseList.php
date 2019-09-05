<section role="main" class="content-body" data-base_url='<?php echo base_url(); ?>'>
		<header class="page-header">
			<h2>My Courses <i class="fa fa-home"></i></h2>
		
			<div class="right-wrapper pull-right" style="padding-right:20px">
				<ol class="breadcrumbs">
					<li>
						<a href="index.html">
							<i class="fa fa-home"></i>
						</a>
					</li>
					<li><span>My Courses</span></li>
					</li>
				</ol>
			</div>
		</header>
		<div id="particles-js"></div>
		<!-- start: page -->
		<h3 class="mt-lg">MY CLASSES</h3>

		<p class="mb-lg">Online Classrooms for currently Enrolled Subjects.</p>

		<div class="row">

			<div class="col-md-3">
				<div class="input-group mb-md">
					<input type="text" placeholder="Search by Name..." class="form-control">
					<span class="input-group-btn">
						<button class="btn btn-success" type="button">Search</button>
					</span>
				</div>
			</div>
			<div class="col-md-2">
				<div class="input-group btn-group" style="width:100%" >
					<span class="input-group-addon">
						<i class="fa fa-th-list"></i>
					</span>
					<select class="form-control" multiple="multiple" data-plugin-multiselect="" id="ms_example4" style="display: none;">
						<option value="pending">Pending</option>
						<option value="finished">Finished</option>
						<option value="pending">Passed</option>
						<option value="pending">Failed</option>
					</select>
				</div>
			</div>

		</div>

		<?php if($this->session->flashdata('message')): ?>
			<div class="well warning">
				<h3><?php echo $this->session->flashdata('message'); ?></h3>
			</div>
		<?php endIf; ?>

		<hr>

		<div class="row">

			<form action="<?php echo base_url(); ?>index.php/Assessment/PreAssessment" method="post">


					<div class="col-md-6 col-lg-6 col-xl-3">
						<section class="panel">
							<header class="panel-heading bg-primary">
								<div class="panel-heading-icon">
									<i class="fa fa-globe" style="line-height:2"></i>
								</div>
							</header>
							<div class="panel-body text-center">
								<h3 class="text-semibold mt-sm text-center">Simple Block Title</h3>
								<p class="text-center">Nullam quiris risus eget urna mollis ornare vel eu leo. Soccis natoque penatibus et magnis dis parturient montes. Soccis natoque penatibus et magnis dis parturient montes.</p>
							</div>
						</section>
					</div>


					<!--<h2>No Subjects found</h2>-->

			</form>
			
		</div>
		<!-- end: page -->
	</section>

	<!-- JS for portfolio page -->
	<script src="<?php echo base_url(); ?>assets/javascripts/portfolio.js"></script>