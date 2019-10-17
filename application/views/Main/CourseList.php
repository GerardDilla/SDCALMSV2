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

				<?php if($this->data['Subjects']): ?>
				<?php $colorcount = 0;?>
					<?php foreach($this->data['Subjects'] as $key => $subject): ?>

						<a href="<?php echo base_url(); ?>index.php/Course/index/<?php echo $subject['Sched_Code']; ?>" style="color:#000; text-decoration: none; max-height:250px; min-height:250px" type="submit" class="col-md-6 col-lg-6 col-xl-3">
							<section class="panel">
								<header class="panel-heading bg-primary" style="background-color:#<?php echo $this->randcolors[$colorcount]; ?>">
									<div class="panel-heading-icon">
										<i class="fa fa-book" style="line-height:2"></i>
									</div>
								</header>
								<div class="panel-body text-center">
									<h3 class="text-semibold mt-sm text-center"><?php echo $subject['Course_Title']; ?></h3>
									<?php if($this->user_data['UserType'] == 1): ?>
										<p class="text-center"><?php echo $subject['Instructor_Name']; ?></p>
									<?php endIf; ?>
									<?php if($this->user_data['UserType'] == 2): ?>
										<p class="text-center">Sched Code: <?php echo $subject['Sched_Code']; ?>::</p>
									<?php endIf; ?>
								</div>
							</section>
							<?php 
								if($colorcount != 6){
									$colorcount++;
								}else{
									$colorcount = 0;
								}
							?>
						</a>
						<!--<h2>No Subjects found</h2>-->
					<?php endForeach; ?>
				<?php endIf; ?>
			
		</div>
		<!-- end: page -->
	</section>

	<!-- JS for portfolio page -->
	<script src="<?php echo base_url(); ?>assets/javascripts/portfolio.js"></script>