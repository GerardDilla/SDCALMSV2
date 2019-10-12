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
					<li><span>My Assessments</span>
					 
					</li>
				</ol>
			</div>
		</header>
		<div id="particles-js"></div>
		<!-- start: page -->

		<h3 class="mt-lg">MY ASSESSMENTS</h3>

		<p class="mb-lg">Quizess and Tests you constructed.</p>

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

				<?php if($this->data['Assessment_List']): ?>

					<?php foreach($this->data['Assessment_List'] as $row): ?>

						<div class="col-md-4" style="margin-bottom:30px">
							<div href="#" class="panel assessmentlinks thumb-info mb-md" style="color:black;" >
								<header class="panel-heading bg-white">
									<div class="panel-heading-icon bg-primary mt-sm">
										<i class="fa fa-pencil"></i>
									</div>
								</header>
								<div class="panel-body">
									<h3 class="text-semibold mt-none text-center"><?php echo $row['AssessmentName']; ?></h3>
									<h6 class="text-center" style="color:ccc"><b>Created:</b> <?php echo $row['Date']; ?></h6>
									<hr>
									<div class="text-center">
										<a class="btn btn-success nounderlinelink" href="<?php echo base_url(); ?>index.php/Assessment/Respondents/<?php echo $row['AssessmentCode']; ?>">Review</a>
									</div>
								</div>
							</div>
						</div>
					<?php endForeach; ?>

				<?php else: ?>

					<h2>You Havent Taken Any Assessments Yet.</h2>

				<?php endIf; ?>

			</form>
			
		</div>
		<!-- end: page -->
	</section>
